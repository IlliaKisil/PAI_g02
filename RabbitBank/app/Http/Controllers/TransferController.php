<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\DB;

class TransferController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','verified']);
    }
    
    public function index()
    {
        $userId = Auth::user()->id;
        $db = DB::table('credit_cards')->where('user_id',$userId)->get();
        
        //return $db;
        return view('transfer',['db' => $db]);
    }

    public function confirming(Request $req){
        $userId = Auth::user()->id;
        $db = DB::table('credit_cards')->where('user_id',$userId)->get();
        $dbAll = DB::table('credit_cards')->get();

        $balance = $db[0]->balance;



        $valid = $req->validate([
            'selectedCard' => 'required',
            'recipient_card_number' => 'required|min:16|max:16',
            'amount' => "required|numeric|between:1,$balance",
        ]);
        
        $amount = $valid['amount'];
        $bankName = "Incorrect";
        $recipientCard = $valid['recipient_card_number'];
        $firstNumbers = substr($recipientCard,0,6);

        

        if($firstNumbers == '466666'){
            foreach($dbAll as $card){
                if($card->card_number == $recipientCard){
                    $bankName = "RABBIT BANK";
                }
            }
        }else{
            try {
                @$jsonResponse = file_get_contents("https://lookup.binlist.net/$firstNumbers");
                if ($jsonResponse == FALSE)
                {
                   // throw the exception or just deal with it
                }else{
                    $response = json_decode($jsonResponse,true);
                    $bankName =  $response['bank']['name'];
                }
            } catch (Exception $e) {
                echo 'Error'; 
            }
        }

        if($bankName == 'Incorrect'){
            
            return redirect('/transfer/confirming/canceled');
        }
        
        $guardCode = rand(10000,99999);
        $details = [
            'title' => 'RabbitBank - Guard Code',
            'body' => "Your code to make transaction to $recipientCard on $amount$ is:",
            'code' => "$guardCode",
        ];
    
        \Mail::to(Auth::user()->email)->send(new \App\Mail\CodeGuard($details));
        
        DB::table('transactions')->insert([
            'user_id'=>Auth::user()->id,
            'from'=>$db[0]->card_number,
            'to'=>$valid['recipient_card_number'],
            'amount'=>$valid['amount'],
            'receiving_bank'=>$bankName,
            'code'=>$guardCode,
            'confirmed'=>false,
            ]);

        return view ('confirming',['data' => $valid,'bankName' => $bankName]);
    }

    public function success(Request $req){

        $userId = Auth::user()->id;
        $db = DB::table('transactions')->where(['user_id'=>$userId,'confirmed'=>false])->get();
        $guardCode = $db[0]->code;

        DB::table('transactions')->where('user_id',"$userId")->update(['confirmed'=>-1,]);
        $valid = $req->validate([
            // 'codeguard' => "required|in:$guardCode",
            'codeguard' => "required",
        ]);
        if($valid['codeguard'] != $guardCode){
            
            return redirect('/transfer')->withErrors(['codeguard' => 'Codeguard is incorrect']);
        }

        if($db[0]->receiving_bank == 'RABBIT BANK'){
            //отнимает у отправителя
            DB::update('update credit_cards set balance = balance - ? where user_id = ?', [$db[0]->amount, $userId]);

            //получает id отправителя + прибавляет
            $recipientId = DB::select('select user_id from credit_cards where card_number = ?', [$db[0]->to]);
            DB::update('update credit_cards set balance = balance + ? where user_id = ?', [$db[0]->amount, $recipientId[0]->user_id]);
        }else{
            //отнимает у отправителя
            DB::update('update credit_cards set balance = balance - ? where user_id = ?', [$db[0]->amount, $userId]);
        }
        
        
        
        DB::table('transactions')->where('user_id',"$userId")->update(['confirmed'=>true,]);
        return view('success');
        
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth','verified']);
    }

    public function index(){
        if(Auth::user()->IsAdmin == 0){
            return redirect()->action([HomeController::class, 'index']);
        }
        

        $db = DB::table('users')
        ->join('credit_cards','users.id','credit_cards.user_id')
        ->get();

        //return $db;
        return view('adminhome',['db'=>$db]);
    }
    public function processing(Request $req){

        $id = $req->input('hidden_id');
        $newBalance = $req->input('balance');
        
        DB::update('update credit_cards set balance = ? where user_id = ?', [$newBalance, $id]);


        return redirect()->action([AdminController::class, 'index']);
    }
    public function transactions(){

        if(Auth::user()->IsAdmin == 0){
            return redirect()->action([HomeController::class, 'index']);
        }

        $db = DB::table('transactions')->get();

        return view('admintransactions',['db'=>$db]);
    }
    public function adduser(){
        if(Auth::user()->IsAdmin == 0){
            return redirect()->action([HomeController::class, 'index']);
        }
        
        return view('addusers');
    }
    public function addinguser(Request $req){
        $name = $req->input('name');
        $email = $req->input('email');
        $password = $req->input('password');

        $smth = User::create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password),
            
        ]);

        $сurrentUser = DB::select('select id from users where name = ?', [$name]);
        foreach($сurrentUser as $x){
            $randomBalance = rand(1000, 10000) / 10;

            $numberWithZero = sprintf("%010d",$x->id);
            $cardNumber = "466666{$numberWithZero}";

            DB::table('credit_cards')->insert(['card_number'=>$cardNumber,'balance'=>$randomBalance,'user_id'=>$x->id]);
        }

        return redirect()->action([AdminController::class, 'adduser']);
    }
}


<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //sprawdzenie czy uzytkownik jest zalogowany i jego mail jest potdwierdzenie
        $this->middleware(['auth','verified']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        
        $userId = Auth::user()->id;
        
        //pobranie baz danych kartami kredytowymi i historiej
        $db = DB::table('credit_cards')->where('user_id',$userId)->get();
        
        $history = DB::table('transactions')->where(['confirmed'=>true])->orderBy('created_at', 'desc')->get();
        
        //wysylanie do view - home
        return view('home',['db' => $db,'history'=>$history]);
    }
}

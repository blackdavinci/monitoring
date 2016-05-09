<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
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
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	if(Auth::user()->role=='admin' && Auth::user()->statut==1){
    		return redirect(route('user.index'));
    	}elseif(Auth::user()->role=='emp' ){
            if(Auth::user()->id_sup!=0){
                return redirect(route('objectif.index'));
            }else{
                return redirect(route('employe.index'));
            }
    	}
        
    }
}

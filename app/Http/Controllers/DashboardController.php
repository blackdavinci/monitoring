<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\User;
use App\Objectif;

use DB;
use Auth;
use JavaScript;

class DashboardController extends Controller
{
	/* Authentification function */
    
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(){
    	
    	if(Auth::user()->role=='emp' && Auth::user()->statut==1){
    	  $users = User::with('objectifs','rendements')->where('id_sup',Auth::user()->id)->get();
    	  JavaScript::put([
    	        'foo' => 'bar',
    	        'user' => User::first(),
    	        'age' => 29
    	    ]);

    	  return view('user.dashboard',compact('users'));
    	}elseif(Auth::user()->role=='admin' && Auth::user()->statut==1){
    	    return view('user.index');
    	}elseif(Auth::user()->statut==0){
    	    return redirect('/logout')->withErrors('Compte désactivé');
    	}
    }
}

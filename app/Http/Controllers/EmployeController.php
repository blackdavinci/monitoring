<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Http\Requests\CreateScoreRequest;
use DB;
use Auth;

use App\User;
use App\Objectif;
use App\Score;
use DateTime;


class EmployeController extends Controller
{
    
    /* Authentification function */
    
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    
    public function index()
    {
        
        if(Auth::user()->role=='emp' && Auth::user()->statut==1){
           $users = DB::table('users')->where('etat',0)
                                    ->where('role','emp')
                                    ->where('id_sup',Auth::user()->id)
                                    ->orderBy('created_at','asc')->get();
           return view('user.emp-list',compact('users'));
        }elseif(Auth::user()->role=='admin' && Auth::user()->statut==1){
            return view('user.index');
        }elseif(Auth::user()->statut==0){
            return redirect('/logout')->withErrors('Compte désactivé');
        }
        
    }

    /**
     * Display a employer profil.
     *
     * @return \Illuminate\Http\Response
     */

    
    public function profil($id)
    {
        
        if(Auth::user()->role=='emp' && Auth::user()->statut==1){
           $employe = User::findOrFail($id);
                   $objectifs = Objectif::where('user_id',$id)->where('etat',0)->orderBy('note','asc')->get();
                   $dt = new DateTime($employe->date_embauche);
                   $date =  $dt->format('d.m.Y');
                   if($employe->id_sup!=0){
                        $superviseur = User::findOrFail($employe->id_sup);
                   }
            return view('user.profil',compact('employe','date','superviseur','objectifs'));
        }elseif(Auth::user()->role=='admin' && Auth::user()->statut==1){
            return view('user.index');
        }elseif(Auth::user()->statut==0){
            return redirect('/logout')->withErrors('Compte désactivé');
        }
    }



    /**
     * Display a employer goals.
     *
     * @return \Illuminate\Http\Response
     */

    public function objectifs($id)
    {
        
        if(Auth::user()->role=='emp' && Auth::user()->statut==1){
           // $objectif = DB::table('objectifs')->where('id_user',$id)->get();
           $objectifs = Objectif::with('score')->where('user_id',$id)->where('etat',0)->orderBy('an','desc')->get();
           $employe = User::findOrFail($id);
           return view('user.emp-objectifs',compact('objectifs','employe'));
        }elseif(Auth::user()->role=='admin' && Auth::user()->statut==1){
            return view('user.index');
        }elseif(Auth::user()->statut==0){
            return redirect('/logout')->withErrors('Compte désactivé');
        }
    }
    
    


    
}

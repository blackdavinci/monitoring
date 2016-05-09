<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\CreateUserRequest;

use App\Http\Requests;
use App\User;

use DB;
use Carbon\Carbon;
use DateTime;
use Auth;

class UserController extends Controller
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
        if(Auth::user()->role=='admin' && Auth::user()->statut==1){
            $users = DB::table('users')->where('etat',0)->orderBy('created_at','asc')->get();
            return view('admin.users-list',compact('users'));
        }elseif(Auth::user()->role='emp' && Auth::user()->statut==1){
            return redirect(route('employe.index'));
        }elseif(Auth::user()->statut==0){
            return view('/logout')->withErrors('Compte désactivé');
        }
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         
        if(Auth::user()->role=='admin' && Auth::user()->statut==1){
            $users = DB::table('users')->select('id','nom','prenom')->get();
            
             return view('admin.create-user',compact('users'));
        }elseif(Auth::user()->role='emp' && Auth::user()->statut==1){
            return redirect(route('employe.index'));
        }
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateUserRequest $request)
    {
        
        $dt = new DateTime($request->input('date_embauche'));
        $date =  $dt->format('Y/m/d');

        $id = DB::table('users')->insertGetId(
            ['nom' => $request['nom'], 
            'prenom' => $request['prenom'],
            'poste' => $request['poste'],
            'matricule' => $request['matricule'], 
            'role' => $request['role'],
            'date_embauche' => $date,
            'id_sup' => $request['id_sup'],
            'login' => $request['login'],
            'password' => bcrypt('12345678'),
        ]);

        if($request->input('id_sup')!=0){
            $user = User::findOrFail($request->input('id_sup'));
            $user->update(['sup_state'=>1]);
        }

        return redirect(route('user.show',$id));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        if(Auth::user()->role=='admin' && Auth::user()->statut==1){
            $employe = User::findOrFail($id);
            $dt = new DateTime($employe->date_embauche);
            $date =  $dt->format('d.m.Y');
            if($employe->id_sup!=0){
                 $superviseur = User::findOrFail($employe->id_sup);
            }
            return view('admin.profil',compact('employe','date','superviseur'));
        }elseif(Auth::user()->role='emp' && Auth::user()->statut==1){
            return view('user.profil',compact('employe','date','superviseur'));
        }elseif(Auth::user()->statut==0){
            return redirect('/logout');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        

        if(Auth::user()->role=='admin' && Auth::user()->statut==1){
            $employe = DB::table('users')->where('id',$id)->first();
            $users_list = DB::table('users')->select('id','nom','prenom')
                                            ->where('role','emp')
                                            ->where('id','!=',$id)
                                            ->get();
            $users [0] = 'Aucun';
            foreach ($users_list as $key => $value) {
                $users[$value->id] = $value->nom.' '.$value->prenom;
            }
           return view('admin.edit-profil',compact('employe','users'));
        }elseif(Auth::user()->role='emp' && Auth::user()->statut==1){
            return view('user.profil',compact('employe','date','superviseur'));
        }elseif(Auth::user()->statut==0){
            return redirect('/logout');
        }
        
    }

     /**
     * Function for delete all checked user
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deleteAll()
    {
        $employe = DB::table('users')->where('id',$id)->first();
        $users_list = DB::table('users')->select('id','nom','prenom')->where('role','sup')->get();
        foreach ($users_list as $key => $value) {
            $users[$value->id] = $value->nom.' '.$value->prenom;
        }
        return view('admin.edit-profil',compact('employe','users'));
    }

    /**
     * Show the form for editing the login & Password.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit_login_mdp($id)
    {
        $employe = DB::table('users')->select('id','nom','prenom','login','password')->where('id',$id)->first();
        return view('admin.edit-identifiant',compact('employe'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $employe = User::findOrFail($id);
        $ex_sup = $employe->id_sup;
        // Mise à jour Activation / Désactivation
        if($request->input('action')=='statut'){
            $employe->update(['statut'=>$request->input('statut')]);
        }elseif($request->input('action')=='update'){
        // Mise à jour données employé(e)s
            $dt = new DateTime($request->input('date_embauche'));
            $date =  $dt->format('Y/m/d');
            DB::table('users')->where('id',$id)
                                    ->update(['nom' => $request['nom'],
                                                'prenom' => $request['prenom'],
                                                'poste'=>$request['poste'],
                                                'matricule'=>$request['matricule'],
                                                'date_embauche'=>$date,
                                                'role'=>$request['role'],
                                                'id_sup'=>$request['id_sup'],
                                    ]);
            if($request->input('id_sup')!=0){
                $user = User::findOrFail($request->input('id_sup'));
                $user->update(['sup_state'=>1]);
            }
        
            $users = DB::table('users')->where('id_sup',$ex_sup)->get();
            $row = count($users);

            if($row==0){
                $ex_user = User::findOrFail($ex_sup);
                $ex_user->update(['sup_state'=>0]);
            }

        }elseif($request->input('action')=='identifiant'){
            $employe->update(['login'=>$request['login'], 'password'=>bcrypt($request['password'])]);
        }
        if(Auth::user()->role=='admin' && Auth::user()->statut==1){
             return  redirect(route('user.show', $id));
        }elseif(Auth::user()->role=='emp' && Auth::user()->statut==1){
             return  redirect(route('employe.profil', $id)); 
        }
       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        $employe = User::findOrFail($id);
        $employe->update(['etat'=>1]);
        return redirect(route('user.index'));    
    }
}

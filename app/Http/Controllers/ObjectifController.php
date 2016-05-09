<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\CreateObjectifRequest;

use App\Objectif;
use App\User;
use App\Score;
use App\Rendement;

use DB;
use Auth;
use Carbon\Carbon;
use JavaScript;
use DateTime;

class ObjectifController extends Controller
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
            $objectifs =  Objectif::where('etat',0)->where('user_id',Auth::user()->id)->orderBy('note','asc')->get();
            return view('user.mes-objectifs',compact('objectifs'));
        }elseif(Auth::user()->role=='admin' && Auth::user()->statut==1){
            return view('user.index');
        }elseif(Auth::user()->statut==0){
            return redirect('/logout')->withErrors('Compte désactivé');
        }
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        if(Auth::user()->role=='emp' && Auth::user()->statut==1){
            return view('user.create-objectif');
        }elseif(Auth::user()->role=='admin' && Auth::user()->statut==1){
            return view('user.index');
        }elseif(Auth::user()->statut==0){
            return redirect('/logout')->withErrors('Compte désactivé');
        }

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateObjectifRequest $request)
    {
      

        if(Auth::user()->role=='emp' && Auth::user()->statut==1){
           $data = $request->all();
           $titre = $request->input('titre');
           $description = $request->input('description');
           for ($i=0; $i <= count($data['designation'])-1 ; $i++) { 
               $indicateurs [$data['designation'][$i]] = $data['point'][$i];
           }
           
           $dt = new DateTime($request->input('echeance'));
           $date =  $dt->format('Y/m/d');

           $now = Carbon::today();
           $an = $now->year;

           $id = DB::table('objectifs')->insertGetId(
               ['titre' => $titre, 'description' => $description,'echeance'=>$date,'an'=>$an,'user_id'=>Auth::user()->id]);

           $objectifs = Objectif::where('user_id',Auth::user()->id)->where('an','2016')->get();
           $row = count($objectifs);
           $objectif = Objectif::findOrFail($id);

           
           if($row==1){

               // Findind Score Id
           $scores = Score::get();
           $score_id=0;
           if(count($scores)!=0){
               foreach ($scores as $key => $value) {
                       if($objectif->note==$value->score_start || $objectif->note==$value->score_end){
                           $score_id = $value->id;
                       }else{
                           $score_min[$value->id] =abs($objectif->note - ($value->score_start+$value->score_end));
                       }
                        $score_max[$key] = $value->score_end; 
                   }
                   $pt_max = max($score_max);
                   if($score_id==0){
                      $min = min($score_min);
                     
                      foreach ($score_min as $key => $value) {
                          if($value==$min){
                              $score_id = $key;
                          }
                      } 
                   }
                   DB::table('rendements')->insertGetId(
                   ['moyenne' => $objectif['note'], 'an' => $an,'user_id'=>Auth::user()->id,'score_id'=>$score_id,
                   'pt_max'=>$pt_max]);
                   $objectif->update(['score_id'=>$score_id]);
               }
           }else{
               $rendement = Rendement::where('user_id',$objectif->user_id)->where('an',$an)->first();
               
               $moyenne = ($rendement->moyenne+$objectif->note)/ 2;
               $rendement->update(['moyenne'=>$moyenne]);
           }
           
           foreach ($indicateurs as $key => $value) {
               DB::table('indicateurs')->insertGetId(
               ['designation' => $key, 'point' => $value,'objectif_id'=>$id]);
           }
           
           return redirect(route('objectif.show',$id));
        }elseif(Auth::user()->role=='admin' && Auth::user()->statut==1){
            return view('user.index');
        }elseif(Auth::user()->statut==0){
            return redirect('/logout')->withErrors('Compte désactivé');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
        if(Auth::user()->role=='emp' && Auth::user()->statut==1){
           $objectif = Objectif::with('score','user')->findOrFail($id);
           $commentaires = DB::table('commentaires')->where('objectif_id',$id)->where('etat',0)->get();
           $row_comments = count($commentaires);
           $indicateurs = DB::table('indicateurs')->where('objectif_id',$id)->get();
           if($objectif->id_score!=0){
               $score = DB::table('scores')->where('id_score',$objectif->id_score)->get();
           }else{
               $score = 0;
           }

           return view('user.detail-objectif',compact('objectif','commentaires','indicateurs','score','row_comments'));
        }elseif(Auth::user()->role=='admin' && Auth::user()->statut==1){
            return view('user.index');
        }elseif(Auth::user()->statut==0){
            return redirect('/logout')->withErrors('Compte désactivé');
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
        
        if(Auth::user()->role=='emp' && Auth::user()->statut==1){
            $objectif = Objectif::findOrFail($id); 
            $indicateurs = DB::table('indicateurs')->where('objectif_id',$id)->get();
            return view('user.edit-objectif',compact('objectif','indicateurs'));
        }elseif(Auth::user()->role=='admin' && Auth::user()->statut==1){
            return view('user.index');
        }elseif(Auth::user()->statut==0){
            return redirect('/logout')->withErrors('Compte désactivé');
        }
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
        
        $now = Carbon::today();
        $an = $now->year;
        if($request->input('action')=='update'){
            // Mise à jour objectif
            if($objectif->valider==1){
                return redirect(route('objectif.show',$id));
            }else{
               $data = $request->all();
               
               $dt = new DateTime($request->input('echeance'));
               $date =  $dt->format('Y/m/d');
               
               DB::table('objectifs')
                               ->where('id', $id)
                               ->update(['titre' => $request->input('titre'), 
                                       'description' => $request->input('description'),
                                       'echeance' => $date,
                               ]);
               for ($i=0; $i <=count($data['id_indic'])-1 ; $i++) { 
                   DB::table('indicateurs')->where('id',$data['id_indic'][$i])
                                           ->update(['designation' => $data['designation'][$i], 
                                                       'point' => $data['point'][$i],
                                                   ]);
               } 
            }
            
        }elseif($request->input('action')=='statut'){
            $objectif = Objectif::findOrFail($id);
            $objectif->update(['statut'=>1]);
        }elseif($request->input('action')=='valider'){
            $objectif = Objectif::findOrFail($id);
            $objectif->update(['valider'=>1]);
        }elseif($request->input('action')=='note'){

            $objectif = Objectif::findOrFail($id);
            $score = Score::get();
            $objectif->update(['note'=>$request['note'],'comment_evaluation'=>$request['comment_evaluation']]);

            $rendement = Rendement::where('user_id',$objectif->user_id)->where('an',$an)->first();

            $objectifs_row = Objectif::where('user_id',$objectif->user_id)->where('an','2016')->get();
            $row = count($objectifs_row);
            $somme = 0;
            foreach ($objectifs_row as $key => $value) {
                $somme += $value->note;
            }
            $moyenne = $somme/$row;
            $rendement->update(['moyenne'=>$moyenne]);

            // Findind Score Id

            $scores = Score::get();
            $score_id_objectif =0;
            $score_id_rendement =0;

            if(count($scores)!=0){
                foreach ($scores as $key => $value) {
                    if($objectif->note==$value->score_start|| $objectif->note==$value->score_end){
                        $score_id_objectif= $value->id;
                        $score_id_rendement = $value->id;
                    }else{
                        $score_min_objectif[$value->id] =abs($objectif->note - ($value->score_start+$value->score_end));
                        $score_min_rendement[$value->id] =abs($moyenne - ($value->score_start+$value->score_end));
                    }
                      
                }

                if($score_id_objectif==0){
                   $min_objectif = min($score_min_objectif);
                  
                   foreach ($score_min_objectif as $key => $value) {
                       if($value==$min_objectif){
                           $score_id_objectif = $key;
                       }
                   }
                }

                if($score_id_rendement==0){
                      $min_rendement = min($score_min_rendement);
                     
                      foreach ($score_min_rendement as $key => $value) {
                          if($value==$min_rendement){
                              $score_id_rendement = $key;
                          }
                      }
                }
                    
                    $rendement->update(['score_id'=>$score_id_rendement]);
                    $objectif->update(['score_id'=>$score_id_objectif]);
                }

            }

    
        return redirect(route('objectif.show',$id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $objectif = Objectif::findOrFail($id);
        $objectif->update(['etat'=>1]);
        return redirect(route('objectif.index')); 
    }
}

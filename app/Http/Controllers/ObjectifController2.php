<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\CreateObjectifRequest;

use App\Objectif;
use App\User;

use DB;
use Auth;
use Carbon\Carbon;
use JavaScript;
use DateTime;

class ObjectifController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $objectifs =  Objectif::where('etat',0)->orderBy('created_at','asc')->get();
        return view('user.mes-objectifs',compact('objectifs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.create-objectif');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateObjectifRequest $request)
    {
        $data = $request->all();
        $titre = $request->input('titre');
        $description = $request->input('description');
        for ($i=0; $i <= count($data['designation'])-1 ; $i++) { 
            $indicateurs [$data['designation'][$i]] = $data['point'][$i];
        }
        
        $dt = new DateTime($request->input('echeance'));
        $date =  $dt->format('Y/m/d');


        dd();
        $now = Carbon::today();
        $an = $now->year;

        $id = DB::table('objectifs')->insertGetId(
            ['titre' => $titre, 'description' => $description,'echeance'=>$date,'an'=>$an]);

        // $objectifs = Objectif::where('user_id',Auth::user()->id)->where('an','2016')->get();
        // $row = count($objectifs);
        if($row==1){
            DB::table('rendements')->insertGetId(
            ['moyenne' => $objectif['note'], 'an' => $an,'id_user'=>Auth::user()->id,'score_id'=>$score_id]);
        }
        
        foreach ($indicateurs as $key => $value) {
            DB::table('indicateurs')->insertGetId(
            ['designation' => $key, 'point' => $value,'id_objectif'=>$id]);
        }
        

        return redirect(route('objectif.show',$id));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $objectif = Objectif::with('score')->findOrFail($id);
        $commentaires = DB::table('commentaires')->where('id_objectif',$id)->get();
        $indicateurs = DB::table('indicateurs')->where('id_objectif',$id)->get();
        if($objectif->id_score!=0){
            $score = DB::table('scores')->where('id_score',$objectif->id_score)->get();
        }else{
            $score = 0;
        }

        
        return view('user.detail-objectif',compact('objectif','commentaires','indicateurs','score'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $objectif = Objectif::findOrFail($id); 
        $indicateurs = DB::table('indicateurs')->where('id_objectif',$id)->get();
        return view('user.edit-objectif',compact('objectif','indicateurs'));
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
        
        if($request->input('action')=='update'){
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

        }elseif($request->input('action')=='statut'){
            $objectif = Objectif::findOrFail($id);
            $objectif->update(['statut'=>1]);
        }elseif($request->input('action')=='note'){
            $objectif = Objectif::findOrFail($id);
            $score = Score::get();
            $objectif->update(['note'=>$request['note'],'comment_evaluation'=>$request['comment_evaluation']]);

            // $rendement = Rendement::where('user_id',Auth::user()->id)->where('an',$an)->get();
        
            $moyenne = ($rendement->moyenne+$objectif->note)/ 2;

            // Findind Score Id
            $scores = Score::get();
            foreach ($scores as $key => $value) {
                $score_min[$value->id] = abs($moyenne - $value->score_end);
            }
            $min_array = min($score_data);
            // Mise à jour rendement annuel
            $rendement->update(['moyenne'=>$moyenne,'score_id'=>$score_id]);
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

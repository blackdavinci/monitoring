<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\CreateScoreRequest;

use App\Score;
use App\User;
use App\Rendement;
use App\Objectif;
use DB;
use Auth;

class ScoreController extends Controller
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
        $scores = Score::where('etat',0)->get();
        
        return view('user.list-score',compact('scores'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.create-score');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateScoreRequest $request)
    {
        
        $data = $request->all();
        for ($i=0; $i <= count($data['designation'])-1 ; $i++) { 
            DB::table('scores')->insertGetId(['designation' => $data['designation'][$i], 
                                        'score_start' => $data['score_start'][$i],
                                        'score_end'=>$data['score_end'][$i]
                                        ]);
        }
        
        return redirect(route('score.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CreateScoreRequest $request, $id)
    {
        $score = Score::findOrFail($id);
        $score->update(['designation'=>$request['designation'],
                        'score_start'=>$request['score_start'],
                        'score_end'=>$request['score_end']]);
        return redirect(route('score.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $score = Score::findOrFail($id);
        $score->update(['etat'=>'1']);
        return redirect(route('score.index'));
    }
}

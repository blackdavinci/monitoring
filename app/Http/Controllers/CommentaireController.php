<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\CreateCommentaireRequest;

use App\Commentaire;

class CommentaireController extends Controller
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
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateCommentaireRequest $request)
    {
        //
        
        Commentaire::create($request->all());
        return redirect(route('objectif.show',$request->input('objectif_id')));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
    public function update(CreateCommentaireRequest $request, $id)
    {
        $commentaire = Commentaire::findOrFail($id);
        $commentaire->update(['titre'=>$request['titre'],'comments'=>$request['comments']]);
        return redirect(route('objectif.show',$request->input('objectif_id')));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $commentaire = Commentaire::findOrFail($id);
        $commentaire->update(['etat'=>1]);
        return redirect(route('objectif.show',$commentaire->objectif_id));
    }
}

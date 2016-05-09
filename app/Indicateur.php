<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Indicateur extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['designation','point','etat','objectif_id'];
    
    public function objectif(){

		return $this->belongsTo('App\Objectif');
	}
}

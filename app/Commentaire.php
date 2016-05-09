<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Commentaire extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['titre','comments','objectif_id','etat'];
    
    public function objectif(){

		return $this->belongsTo('App\Objectif');
	}
}

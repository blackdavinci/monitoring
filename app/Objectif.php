<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Objectif extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['titre','description','echeance','valider','an','etat','statut','user_id','score_id','indicateur_id','comment_evaluation','note','comment_objectif_1','comment_objectif_2'];
    
    public function commenatires(){

		return $this->hasMany('App\Commentaire');
	}

	public function indicateurs(){

		return $this->hasMany('App\Indicateur');
	}

	public function user(){

		return $this->belongsTo('App\User');
	}

	public function score(){

		return $this->belongsTo('App\Score');
	}
}

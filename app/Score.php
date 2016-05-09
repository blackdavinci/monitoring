<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Score extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['designation','score_start','score_end','etat'];
    
    public function objectifs(){

		return $this->hasMany('App\Objectif');
	}

	public function rendements(){

		return $this->hasMany('App\Rendement');
	}

}

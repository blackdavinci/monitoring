<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rendement extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['moyenne','user_id','score_id','an','pt_max'];

    public function user(){

		return $this->belongsTo('App\User');
	}

	 public function score(){

		return $this->belongsTo('App\Score');
	}

}

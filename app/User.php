<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['nom','prenom','poste','matricule','date_embauche','role','id_sup','sup_state','login','password',
    'etat','statut'];
    protected $dates = ['date_embauche'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */

     public function objectifs(){

        return $this->hasMany('App\Objectif');
    }

    public function rendements(){

        return $this->hasMany('App\Rendement');
    }

    protected $hidden = [
        'password', 'remember_token',
    ];
}

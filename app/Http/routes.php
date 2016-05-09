<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


Route::get('/','HomeController@index');

// Routes User

Route::get('user/deleteAll',['uses'=>'UserController@deleteAll', 'as'=>'user.delete-all']);

Route::get('user/{id}/edit-login',['uses'=>'UserController@edit_login_mdp','as'=>'user.edit-login']); 

Route::resource('user','UserController');

// Route Objectif

Route::resource('objectif','ObjectifController');

// Route Commentaire

Route::resource('commentaire','CommentaireController');

// Route Score

Route::resource('score','ScoreController');

// Route Superviseur

Route::get('employes',['uses'=>'EmployeController@index', 'as'=>'employe.index']);

Route::get('profil-employe/{id}',['uses'=>'EmployeController@profil', 'as'=>'employe.profil']);

Route::get('employe-objectifs/{id}',['uses'=>'EmployeController@objectifs', 'as'=>'employe.objectifs']);

// Route Dashboard

Route::get('dashboard',['as'=>'dashboard.index','uses'=>'DashboardController@index']);

// Route Authentification

Route::auth();

Route::get('/home', 'HomeController@index');

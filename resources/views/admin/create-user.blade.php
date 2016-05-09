@extends('template-admin')

<!-- Page Header -->
@section('page-header','Ajout d\'utilisateur')

<!-- Content -->
@section('content')

<!-- Content -->
	<div class="row">
	<div class="col-md-12">
			@if (count($errors) > 0)
				<div class="alert alert-danger">
				    <ul>
				        @foreach ($errors->all() as $error)
						    <li>{{ $error }}</li>
				        @endforeach
				    </ul>
				</div>
			@endif
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			
			<form action="{{route('user.store')}}" method="POST" class="form-horizontal"  novalidate>
				<input type="hidden" name="_token" value="{{ csrf_token() }}">

			  <div class="form-group">
			    <label for="nom" class="col-sm-2 control-label">Nom</label>
			    <div class="col-sm-5">
			      <input type="text" class="form-control" id="nom" placeholder="Nom" name="nom" value="{{ old('nom') }}" ng-model="nom" required>
			    </div>
			    <div class="col-sm-5">
			    	
			    </div>
			  </div>
			  <div class="form-group">
			    <label for="prenom" class="col-sm-2 control-label">Prénom</label>
			    <div class="col-sm-5">
			      <input type="text" class="form-control" id="prenom" placeholder="Prénom" name="prenom" value="{{ old('prenom') }}" ng-model="prenom">
			    </div>
			  </div>
			  <div class="form-group">
			    <label for="nom" class="col-sm-2 control-label">Fonction / Poste</label>
			    <div class="col-sm-5">
			      <input type="text" class="form-control" id="poste" placeholder="Fonction / Poste" name="poste" value="{{ old('poste') }}" ng-model="poste">
			    </div>

			  </div>
			  <div class="form-group">
			    <label for="matricule" class="col-sm-2 control-label">Matricule</label>
			    <div class="col-sm-5">
			      <input type="text" class="form-control" id="matricule" placeholder="Numéro matricule" name="matricule" value="{{ old('matricule') }}" ng-model="matricule">
			    </div>
			  </div>
			  <div class="form-group">
			    <label for="matricule" class="col-sm-2 control-label">Date d'embauche</label>
			    <div class="col-sm-5">
			      <input type="text" class="form-control date-select"  name="date_embauche" value="{{ old('date_embauche') }}" ng-model="date_embauche">
			    </div>
			  </div>
			  <div class="form-group">
			    <label for="role" class="col-sm-2 control-label">Rôle</label>
			    <div class="col-sm-5">
			    	<select name="role" ng-model="role" id="role" class="form-control" value="{{ old('role') }}">
			    		<option value="admin">Administrateur</option>
			    		<option value="emp" selected>Employé(e)</option>
			    	</select>
			    </div>
			  </div>
			  <div class="form-group" ng-show="role=='emp'">
			    <label for="emp-sup" class="col-sm-2 control-label">Superviseur</label>
			    <div class="col-sm-5">
			    	<select name="id_sup" id="emp-sup" class="form-control" value="{{ old('id_sup') }}" 
			    	ng-required="role=='emp'" ng-model="idsup">
			    		<option value="0">Aucun</option>
			    		@foreach($users as $user)
			    			<option value="{{$user->id}}">{{$user->nom.' '.$user->prenom}}</option>
			    		@endforeach
			    	</select>
			    </div>
			  </div>
			  <div class="form-group">
			    <label for="login" class="col-sm-2 control-label">Login</label>
			    <div class="col-sm-5">
			      <input type="text" class="form-control" id="login" placeholder="Login" name="login" value="{{ old('login') }}" ng-model="login">
			    </div>
			  </div>
			  <div class="form-group">
			    <div class="col-sm-offset-2 col-sm-2">
			      <button type="submit" class="btn btn-success" ng-disabled="userForm.nom.$dirty && userForm.nom.$invalid">
			      	<b class="title-Upper">Ajouter</b>
			      </button>
			    </div>
			    <div class=" col-sm-4">
			      <button type="reset" class="btn btn-warning"><b class="title-Upper">Réinitialiser</b></button>
			    </div>
			  </div>
			</form>
		</div>
	</div>
@endsection
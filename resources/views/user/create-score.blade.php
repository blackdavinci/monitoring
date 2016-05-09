@extends('template-user')

<!-- Page Header -->
@section('page-header','Ajout d\'Appréciation ')

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
			
			<form action="{{route('score.store')}}" method="POST" class="form-horizontal"  novalidate>
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
			  <div class="form-group" ng-controller="MainCtrl as main">
			    <label for="prenom" class="col-sm-2 control-label">Appréciation(s)</label>
			   
			    <div class="col-sm-6">
			    <div ng-repeat="choice in main.choices">
			    	<div class="col-sm-4 padding-left-off">
			    		<p></p>
			    		<input type="text" class="form-control" name="designation[]" placeholder="Désignation" required>
			    	</div>
			    	<div class="col-sm-3">
			    		<p></p>
			    		<input type="number" min="0" name="score_start[]" id="point_d" placeholder="Début" class="form-control" required>
			    	</div>
			    	<div class="col-sm-3">
			    		<p></p>
			    		<input type="number" min="1" name="score_end[]" id="point_f" placeholder=" Fin" class="form-control" required>
			    	</div>
					<div class="col-md-1" ng-if="choice.id!='choice1'">
						<p></p>
						<a class="btn btn-danger" ng-click="main.removeChoice()">
						  <i class="fa fa-minus" title="Delete" aria-hidden="true"></i>
						  <span class="sr-only">Delete</span>
						</a>
					</div>
					<div class="col-md-1" >
						<p></p>
						<a class="btn btn-primary" ng-click="main.addNewChoice()">
						  <i class="fa fa-plus" title="Delete" aria-hidden="true"></i>
						  <span class="sr-only">Add</span>
						</a>
					</div>
				</div>	
			    </div>
			  </div>
			  
			  <div class="form-group">
			    <div class="col-sm-offset-2 col-sm-12">
			      <button type="submit" class="btn btn-success btn-form" ng-disabled="userForm.nom.$dirty && userForm.nom.$invalid">
			      	<b class="title-Upper">Enregistrer</b>
			      </button>
			    
			      <button type="reset" class="btn btn-warning btn-form"><b class="title-Upper">Réinitialiser</b></button>
			      <a class="btn btn-danger" href="{{route('score.index')}}">Annuler</a>
			  </div>
			</form>
		</div>
	</div>
@endsection
@extends('template-user')

<!-- Page Header -->
@section('page-header','Nouveau commentaire')

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
			<form action="{{route('objectif.store')}}" method="POST" class="form-horizontal"  novalidate>
				<input type="hidden" name="_token" value="{{ csrf_token() }}">

			  <div class="form-group">
			    <label for="nom" class="col-sm-2 control-label">Titre</label>
			    <div class="col-sm-5">
			      <input type="text" class="form-control" id="titre" placeholder="Titre" name="titre" value="{{ old('titre') }}" ng-model="titre" required>
			    </div>
			    <div class="col-sm-5">
			    	
			    </div>
			  </div>
			  <div class="form-group">
			    <label for="prenom" class="col-sm-2 control-label">Commenatiare</label>
			    <div class="col-sm-5">
			      <textarea name="comments" class="form-control" rows="10" required></textarea>
			    </div>
			  </div>
			  <div class="form-group">
			    <div class="col-sm-offset-2 col-sm-2">
			      <button type="submit" class="btn btn-success" ng-disabled="userForm.nom.$dirty && userForm.nom.$invalid">
			      	<b class="title-Upper">Enregistrer</b>
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
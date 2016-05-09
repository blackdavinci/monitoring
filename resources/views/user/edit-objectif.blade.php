@extends('template-user')

<!-- Page Header -->
@section('page-header')
	Modification objectif Utilisateur {{$objectif->titre}}
@endsection

<!-- Content -->
@section('content-menu')
<!-- Menu  -->
	<div class="row">
		<div class="col-md-12 top-menu-content">			
			<!-- Actions -->
			<div class="col-md-6 btn-action-menu-left">
				<ul class="head-menu">
					<li>
						<a href="{{ route('objectif.show',[$objectif->id])}}" class="btn btn-bloc btn-danger title-Upper">
							<b><i class="fa fa-arrow-left fa-fw" aria-hidden="true"></i> Annuler</b>
						</a>
					</li>
				</ul>
			</div>
		</div>
	</div>

@endsection

@section('content')
<!-- Content -->
{!! Form::open(['method' =>'put','route' =>['objectif.update',$objectif->id],'class'=>'form-horizontal','novalidate']) !!}

	<input type="hidden" name="_token" value="{{ csrf_token() }}">
	<input type="hidden" name="action" value="update">
	<div class="row">
		<!-- Ligne Infos Employé à Editer-->
			<div class="col-md-12 content-row-padding">
				<div class="row">
					<div class="col-md-12"><span class="info-head-title title-Upper label label-primary">Données objectif</span><p></p></div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<div class="col-md-8 info-data title-Upper">Titre <p></p></div>
						<div class="col-md-8">
							<input type="text" class="form-control" name="titre" value="{{$objectif->titre}}"  required>
							<p></p>
						</div>

						<div class="col-md-8 info-data title-Upper">Description <p></p></div>
						<div class="col-md-8">
							<textarea name="description" class="form-control" rows="10">{{$objectif->description}}</textarea>
							<p></p>
						</div>

						<div class="col-md-12 info-data title-Upper">Indicateurs <p></p></div>
						<div class="col-md-12">
							@foreach($indicateurs as $indicateur)
								<div class="col-sm-5 padding-left-off">
									<input type="hidden" name="id_indic[]" value="{{$indicateur->id}}"/>
									<p></p>
									<input type="text" class="form-control" name="designation[]" placeholder="Désignation" value="{{$indicateur->designation}}">
								</div>
								<div class="col-sm-3">
									<p></p>
									<input type="number" min="1" name="point[]" id="point" class="form-control" value="{{$indicateur->point}}">
								</div>
							@endforeach


						</div>

						<div class="col-md-8 info-data title-Upper"><p></p>Echéance <p></p></div>
						<div class="col-md-8">
							{{--*/ 
								$dt = new DateTime($objectif->echeance);
	        					$echeance =  $dt->format('d-m-Y');
        					/*--}}
							<input type="text" class="form-control date-select"  name="echeance" value="{{$echeance }}">
							<p></p>
						</div>
						<div class="col-md-8">
							<button type="submit" class="btn btn-success">
								<b class="title-Upper">Enregistrer</b>
							</button>
						</div>
					</div>
				</div>
			</div>
	</div>
</form>
@endsection
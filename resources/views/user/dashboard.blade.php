@extends('template-user')

<!-- Page Header -->
@section('page-header','Tableau de Bord')

<!-- Content -->
@section('content-menu')
<!-- Menu  -->
	<div class="row">
		<!-- Actions -->
			<div class="col-md-12 btn-action-menu-right">
				<ul class="head-menu">
					<li>
						<a href="{{ route('score.create')}}" class="btn btn-block btn-primary title-Upper">
							<b><i class="fa fa-plus fa-fw" aria-hidden="true"></i> Nouvelle Appréciation</b>
						</a>
					</li>
				</ul>
			</div>
		</div>
	<p></p>
@endsection

@section('content')

<!-- Content -->
	<div class="row">
		<div class="col-md-12">
		<!-- Variable Année -->
		{{--*/ $now = date('Y'); $marquer = 0; /*--}}
			@foreach($users as $user)
				<div class="col-md-12">
					<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
					  <div class="panel panel-default">
					    <div class="panel-heading" role="tab" id="heading{{$user->id}}">
					      <h4 class="panel-title">
					        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse{{$user->id}}" aria-expanded="true" aria-controls="collapseOne">
					          <strong>{{$user->nom.' '.$user->prenom}}</strong><span class="badge pull-right">4</span>
					        </a>
					      </h4>
					    </div>
					    <div id="collapse{{$user->id}}" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="heading{{$user->id}}">
					      <div class="panel-body">
					      	<div class="row">
					      		<div class="col-md-12">
					      			<table class="table table-hover" id="table-user-list">
					      				<thead>
					      					<tr>
					      						<th><i class="fa fa-play fa-fw" aria-hidden="true"></i> En cours </th>
					      						<th><i class="fa fa-close fa-fw" aria-hidden="true"></i> Non validé(s)</th>
					      						<th><i class="fa fa-archive fa-fw" aria-hidden="true"></i> Archivé(s)</th>
					      						<th><i class="fa fa-line-chart fa-fw" aria-hidden="true"></i> Rendement(s)</th>
					      						<th><i class="fa fa-calendar fa-fw" aria-hidden="true"></i> Année</th>
					      					</tr>
					      				</thead>
					      				<tbody>
					      				</tbody>
					      			</table>
					      		</div>
					      	</div>
					      </div>
					    </div>
					  </div>
					</div>
				</div>
				
			@endforeach
		</div>
	</div>
@endsection

@include ('footer')
@extends('template-user')

<!-- Page Header -->
@section('page-header')
	Profil Employé(e) {{$employe->nom.' '.$employe->prenom}}
@endsection

<!-- Content -->
@section('content-menu')
<!-- Menu  -->
	<div class="row">
		<div class="col-md-12 top-menu-content">
			<!-- Infos menu -->
			<div class="col-md-12">
				<div class="masthead clearfix">
				  <div class="inner">
				    <nav>
				      <ul class="nav masthead-nav">
				        <li class="active"><a href="{{route('employe.profil',[$employe->id])}}">Informations</a></li>
				        <li class=""><a href="{{route('employe.objectifs',[$employe->id])}}">Objectif(s)</a></li>
				      </ul>
				    </nav>
				  </div>
				</div>
			</div>
		</div>
	</div>
	@if(Auth::user()->id == $employe->id || Auth::user()->role=='admin')
		<div class="row">
			<div class="col-md-12 top-menu-content">
				<!-- Infos menu -->
				
				
				<!-- Actions -->
				
				<div class="col-md-12 btn-action-menu-right">
					<ul class="head-menu">
						<li>
							<a href="{{ route('user.edit-login',[$employe->id])}}" class="btn btn-bloc btn-info title-Upper">
								<b><i class="fa fa-edit fa-fw" aria-hidden="true"></i> Modifier Identifiants</b>
							</a>
						</li>
					</ul>
				</div>
			</div>
		</div>
	@endif
@endsection

@section('content')

<!-- Modal de confirmation de suppression d'utilisateur -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Suppression d'utilisateur</h4>
      </div>
      <div class="modal-body">
        Voulez-vous vraimment supprimer l'utilisateur <strong>{{ $employe->nom.' '.$employe->prenom }}</strong> ?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Annuler</button>
        <div class="pull-right" style="margin-left:5px;">
	        {!! Form::open(['method' =>'delete','route' =>['user.destroy',$employe->id]]) !!}
	        	<input type="hidden" name="action" value='suppression'/>
	        	{!! Form::submit('Supprimer',['class'=>'btn btn-danger'])!!}
	      	{!! Form::close() !!}
      	</div>
      </div>
    </div>
  </div>
</div>

<!-- Content -->
	<div class="row">
		<!-- Ligne Infos Employé -->
			<div class="col-md-12 content-row-padding">
			@if($employe->id == Auth::user()->id)
				<div class="row">
					<div class="col-md-12 title-bottom-border">
						<span class="info-head-title title-Upper">Mes informations</span>
					</div>
				</div>
			@endif
				<div class="row">
					<div class="col-md-12">
						<table class="table table-noborder">
							<tr>
								<td><span class="title-data title-Upper">Nom</span></td>
								<td><span class="info-data">{{$employe->nom}}</span></td>
							</tr>
							<tr>
								<td><span class="title-data title-Upper">Prénom</span></td>
								<td><span class="info-data">{{$employe->prenom}}</span></td>
							</tr>
							<tr>
								<td><span class="title-data title-Upper">Poste</span></td>
								<td><span class="info-data">{{$employe->poste}}</span></td>
							</tr>
							<tr>
								<td><span class="title-data title-Upper">Matricule</span></td>
								<td><span class="info-data">{{$employe->matricule}}</span></td>
							</tr>
							<tr>
								<td><span class="title-data title-Upper">Date d'embauche</span></td>
								<td>
									<span class="info-data">{{$date}}</span>
								</td>
							</tr>
							<tr>
								<td><span class="title-data title-Upper">Rôle</span></td>
								<td>
									<span class="info-data">
										@if($employe->role=='admin')
											Administrateur
										@elseif($employe->role=='emp')
											Employé(e)
										@endif
									</span>
								</td>
							</tr>
							<tr>
								<td><span class="title-data title-Upper">Superviseur</span></td>
								<td>
									@if($employe->id_sup!='0')
									<span class="info-data">
										{{$superviseur->nom.' '.$superviseur->prenom}}
									</span>
									@else
										<span class="info-data">Non supervisé(e)</span>
									@endif
								</td>
							</tr>
							<tr>
								<td><span class="title-data title-Upper">Login</span></td>
								<td><span class="info-data">{{$employe->login}}</span></td>
							</tr>
						</table>
					</div>
				</div>
			</div>
	</div>
	@if($employe->id_sup== Auth::user()->id)
		<div class="row content-row-padding">
			<div class="col-md-12">
				<p class="info-head-title title-Upper title-bottom-border">Objectif(s)</p>
				<p></p>
			</div>
			
			@foreach($objectifs as $objectif)
				@if($objectif->statut==0)
					<div class="col-md-4 objectif-data">
						<div class="col-md-12">
							<h4 class="title-Upper">
								<a href="{{route('objectif.show',[$objectif->id])}}">
									<b>
										<span class="label @if($objectif->note!=0) label-primary @else label-success @endif">
											 {{$objectif->titre}}
											 @if($objectif->valider==1)
											 	<i class="fa fa-check fa-fw" aria-hidden="true"></i>
											 @else
												<i class="fa fa-close fa-fw" aria-hidden="true"></i>
											 @endif
										 </span>
									</b>
								</a>
							</h4>
							<span class="date-info">
									{{--*/ 
										$dt_add = new DateTime($objectif->created_at);
			       						$dt_ajout =  $dt_add->format('d.m.Y');
		        					/*--}}
									Ajouté le ({{$dt_ajout}})
							</span>
						</div>
						<div class="col-md-12">
							{{--*/ $description = substr($objectif->description,0,40) /*--}}
							{{$description.'......'}}
						</div>
					</div>
				@endif
			@endforeach
		</div>
	@endif
@endsection
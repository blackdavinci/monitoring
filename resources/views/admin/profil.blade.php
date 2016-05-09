@extends('template-admin')

<!-- Page Header -->
@section('page-header')
	Profil Utilisateur {{$employe->nom.' '.$employe->prenom}}
@endsection

<!-- Content -->
@section('content-menu')
<!-- Menu  -->
	<div class="row">
		<div class="col-md-12 top-menu-content">
			<!-- Infos menu -->
			<div class="col-md-3">
				<div class="masthead clearfix">
				  <div class="inner">
				    <nav>
				      <ul class="nav masthead-nav">
				        <li class="active"><a href="#">Informations utilisateur</a></li>
				      </ul>
				    </nav>
				  </div>
				</div>
			</div>
			
			<!-- Actions -->
			<div class="col-md-9 btn-action-menu-right">
				<ul class="head-menu">
					<li>
						<button type="button" class="btn btn-bloc btn-danger title-Upper" data-toggle="modal"
						 data-target="#deleteModal">
							<b><i class="fa fa-remove fa-fw" aria-hidden="true"></i> Supprimer</b>
						</button>
					</li>
					<li>
						<a href="{{ route('user.edit',[$employe->id])}}" class="btn btn-bloc btn-primary title-Upper">
							<b><i class="fa fa-edit fa-fw" aria-hidden="true"></i> Modifier</b>
						</a>
					</li>
					<li>
						<a href="{{ route('user.edit-login',[$employe->id])}}" class="btn btn-bloc btn-info title-Upper">
							<b><i class="fa fa-edit fa-fw" aria-hidden="true"></i> Modifier Identifiants</b>
						</a>
					</li>
					<li>
						@if($employe->statut=='1')
						<button type="button" class="btn btn-bloc btn-warning title-Upper" data-toggle="modal"
						 data-target="#desactivateModal">
							<b><i class="fa fa-ban fa-fw" aria-hidden="true"></i> Désactiver</b>
						</button>
						@else
						<button type="button" class="btn btn-bloc btn-success title-Upper" data-toggle="modal"
						 data-target="#desactivateModal">
							<b><i class="fa fa-circle-o fa-fw" aria-hidden="true"></i> Activer</b>
						</button>
						@endif

					</li>
				</ul>
			</div>
		</div>
	</div>
@endsection

@section('content')

<!-- Modal de confirmation de Désaction/Activation d'utilisateur-->
<div class="modal fade" id="desactivateModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">
         	@if($employe->statut=='1')
         		Désactivation d'utilisateur
         	@else
         		Activation d'utilisateur
         	@endif
        </h4>
      </div>
      <div class="modal-body">
      	@if($employe->statut=='1')
      		Voulez-vous vraimment désactiver l'utilisateur <strong>{{ $employe->nom.' '.$employe->prenom }}</strong> ?
      	@else
      		Voulez-vous vraimment activer l'utilisateur <strong>{{ $employe->nom.' '.$employe->prenom }}</strong> ?
      	@endif
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Annuler</button>
        <div class="pull-right" style="margin-left:5px;">
	        {!! Form::open(['method' =>'put','route' =>['user.update',$employe->id]]) !!}
	        	<input type="hidden" name="action" value='statut'/>
	        	@if($employe->statut=='0')
	        		<input type="hidden" name="statut" value="1">
	        		{!! Form::submit('Activer',['class'=>'btn btn-warning'])!!}
	        	@else
	        		<input type="hidden" name="statut" value="0">
	        		{!! Form::submit('Désactiver',['class'=>'btn btn-warning'])!!}
	        	@endif
	      		
	      	{!! Form::close() !!}
      	</div>
      </div>
    </div>
  </div>
</div>

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
				<div class="row">
					<div class="col-md-12"><span class="info-head-title title-Upper">Informations Employé</span></div>
				</div>
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
@endsection
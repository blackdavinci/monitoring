@extends('template-admin')

<!-- Page Header -->
@section('page-header','Utilisateurs')

<!-- Content -->
@section('content-menu')
<!-- Menu  -->
	<div class="row">
		<!-- Actions -->
			<div class="col-md-12 btn-action-menu-right">
				<ul class="head-menu">
					<li>
						<a href="{{ route('user.create')}}" class="btn btn-block btn-primary title-Upper">
							<b><i class="fa fa-plus fa-fw" aria-hidden="true"></i> Ajouter Utilisateur</b>
						</a>
					</li>
					<li>
						<a href="{{ route('user.delete-all')}}" class="btn btn-bloc btn-primary title-Upper">
							<b><i class="fa fa-edit fa-fw" aria-hidden="true"></i> Supprimer</b>
						</a>
					</li>
					<li>
						<button type="button" class="btn btn-bloc btn-warning title-Upper" data-toggle="modal"
						 data-target="#desactivateModal">
							<b><i class="fa fa-ban fa-fw" aria-hidden="true"></i> Désactiver</b>
						</button>
					</li>
					<li>
						<button type="button" class="btn btn-bloc btn-success title-Upper" data-toggle="modal"
						 data-target="#desactivateModal">
							<b><i class="fa fa-circle-o fa-fw" aria-hidden="true"></i> Activer</b>
						</button>
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
			<div class="table-responsive">
				<form>
					<table class="table table-hover" id="table-user-list">
						<thead>
							<tr>
								<th>
									<input  type="checkbox" name="layout" id="1" value="option" ng-model="allselect">
								</th>
								<th>Nom & Prénom </th>
								<th>Fonction / Poste</th>
								<th>Matricule</th>
								<th>Date d'embauche</th>
								<th>Rôle</th>
								<th>Statut</th>
								<th colspan="2">Actions</th>
							</tr>
						</thead>
						<tbody>
						@foreach($users as $user)
							<tr class="ligne-user-info">
								<td>
									<input  type="checkbox" name="layout" id="1" value="{{$user->id}}"  ng-checked="allselect">
								</td>
								<td class="info-table">
									<a href="{{route('user.show',[$user->id])}}">{{$user->nom.' '.$user->prenom}}</a>
								</td>
								<td class="info-table">{{$user->poste}}</td>
								<td class="info-table">{{$user->matricule}}</td>
								<td class="info-table">
									{{--*/ 
										$dt = new DateTime($user->date_embauche);
	        							$date =  $dt->format('d.m.Y');
        							/*--}}
									{{$date}}
									
								</td>
								<td class="info-table">
									@if($user->role=='admin') 
										Administrateur
									@else
										Employé(e)@if($user->sup_state==1) <b>[Sup]</b>@endif
									@endif
								</td>
								<td class="info-table">@if($user->statut==0) Désactivé @else Activé @endif</td>
								<td class="">
									<a href="{{route('user.edit',[$user->id])}}" class="btn-action">
										<i class="fa fa-edit fa-1x" aria-hidden="true"></i>
									</a>
								</td>
								<td>
									<a href="" class="btn-action" data-toggle="modal"
						 data-target="#deleteModal{{$user->id}}">
										<i class="fa fa-trash fa-1x" aria-hidden="true"></i>
									</a>
								</td>
							</tr>
							<!-- Modal de confirmation de suppression d'utilisateur -->
							<div class="modal fade" id="deleteModal{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
							  <div class="modal-dialog">
							    <div class="modal-content">
							      <div class="modal-header">
							        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							        <h4 class="modal-title" id="myModalLabel">Suppression d'utilisateur</h4>
							      </div>
							      <div class="modal-body">
							        Voulez-vous vraimment supprimer l'utilisateur <strong>{{ $user->nom.' '.$user->prenom }}</strong> ?
							      </div>
							      <div class="modal-footer">
							        <button type="button" class="btn btn-primary" data-dismiss="modal">Annuler</button>
							        <div class="pull-right" style="margin-left:5px;">
								        {!! Form::open(['method' =>'delete','route' =>['user.destroy',$user->id]]) !!}
								        	<input type="hidden" name="action" value='suppression'/>
								        	{!! Form::submit('Supprimer',['class'=>'btn btn-danger'])!!}
								      	{!! Form::close() !!}
							      	</div>
							      </div>
							    </div>
							  </div>
							</div>
						@endforeach
						</tbody>
					</table>
				</form>
			</div>
		</div>
	</div>
	
@endsection
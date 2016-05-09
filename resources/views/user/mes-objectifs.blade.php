@extends('template-user')

<!-- Page Header -->
@section('page-header','Mes objectifs')

<!-- Content -->
@section('content-menu')
<!-- Menu  -->
	<div class="row">
		<!-- Actions -->
			<div class="col-md-12 btn-action-menu-right">
				<ul class="head-menu">
					<li>
						<a href="{{ route('objectif.create')}}" class="btn btn-block btn-primary title-Upper">
							<b><i class="fa fa-plus fa-fw" aria-hidden="true"></i> Nouvel objectif</b>
						</a>
					</li>
				@foreach($objectifs as $objectif)
					<li ng-show="deleteaction{{$objectif->id}}">
						<a href="}" class="btn btn-bloc btn-danger title-Upper">
							<b><i class="fa fa-trash fa-fw" aria-hidden="true"></i> Supprimer</b>
						</a>
					</li>
				@endforeach
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
								<th>Titre</th>
								<th>Description</th>
								<th>Date d'ajout</th>
								<th>Statut</th>
								<th colspan="2">Actions</th>
							</tr>
						</thead>
						<tbody>
						@foreach($objectifs as $objectif)
							<tr class="ligne-user-info">
								<td>
									<input  type="checkbox" name="layout" id="1" value="{{$objectif->id}}"  ng-checked="allselect" ng-model="deleteaction{{$objectif->id}}">
								</td>
								<td class="info-table">
									<a href="{{route('objectif.show',[$objectif->id])}}">{{$objectif->titre}}</a>
								</td>
								<td class="info-table">
									{{--*/ $description = substr($objectif->description,0,40) /*--}}
									{{ $description.'......'}}
								</td>
								<td class="info-table">
									{{--*/ 
										$dt = new DateTime($objectif->created_at);
	        							$date =  $dt->format('d.m.Y H:i:s');
        							/*--}}
									{{$date}}
									
								</td>
								<td>
									@if($objectif->valider==0) 
										<span class="label label-warning">Non validé</span>
									@elseif($objectif->note==0 && $objectif->valider==1) 
										<span class="label label-success">En cours</span>
									@elseif($objectif->note!=0 && $objectif->valider==1)
										<span class="label label-primary">Archivé</span>
									@endif
								</td>
								@if($objectif->valider==0)
									<td class="">
										<a href="{{route('objectif.edit',[$objectif->id])}}" class="btn-action">
											<i class="fa fa-edit fa-1x" aria-hidden="true"></i>
										</a>
									</td>
									<td>
										<a href="" class="btn-action" data-toggle="modal"
							 data-target="#deleteModal{{$objectif->id}}">
											<i class="fa fa-trash fa-1x" aria-hidden="true"></i>
										</a>
									</td>
								@else
									<td colspan="2">&nbsp;</td>
								@endif
							</tr>
		
						<!-- Modal de confirmation de suppression d'objectif -->
						<div class="modal fade" id="deleteModal{{$objectif->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
						  <div class="modal-dialog">
						    <div class="modal-content">
						      <div class="modal-header">
						        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						        <h4 class="modal-title" id="myModalLabel">Suppression d'objectif</h4>
						      </div>
						      <div class="modal-body">
						        Voulez-vous vraimment supprimer l'objectif <strong>{{ $objectif->titre }}</strong> ?
						      </div>
						      <div class="modal-footer">
						        <button type="button" class="btn btn-primary" data-dismiss="modal">Annuler</button>
						        <div class="pull-right" style="margin-left:5px;">
							        {!! Form::open(['method' =>'delete','route' =>['objectif.destroy',$objectif->id]]) !!}
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
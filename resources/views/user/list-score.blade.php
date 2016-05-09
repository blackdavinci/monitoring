@extends('template-user')

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
			<div class="table-responsive">
				<form>
					<table class="table table-hover" id="table-user-list">
						<thead>
							<tr>
								<th>Appréciation</th>
								<th>Début</th>
								<th>Fin</th>
								<th colspan="2">Actions</th>
							</tr>
						</thead>
						<tbody>
						@foreach($scores as $score)
							<tr class="ligne-user-info">
								<td class="info-table">{{$score->designation}}</td>
								<td class="info-table">{{$score->score_start}}</td>
								<td class="info-table">{{$score->score_end}}</td>
								<td class="">
									<a href="" class="btn-action" data-toggle="modal"
						 data-target="#editModal{{$score->id}}">
										<i class="fa fa-edit fa-1x" aria-hidden="true"></i>
									</a>
								</td>
								<td>
									<a href="" class="btn-action" data-toggle="modal"
						 data-target="#deleteModal{{$score->id}}">
										<i class="fa fa-trash fa-1x" aria-hidden="true"></i>
									</a>
								</td>
							</tr>
							<!-- Modal de confirmation de suppression d'appréciation -->
							<div class="modal fade" id="deleteModal{{$score->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
							  <div class="modal-dialog">
							    <div class="modal-content">
							      <div class="modal-header">
							        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							        <h4 class="modal-title" id="myModalLabel">Suppression d'appréciation</h4>
							      </div>
							      <div class="modal-body">
							        Voulez-vous vraimment supprimer l'appréciation <strong>{{ $score->designation }}</strong> ?
							      </div>
							      <div class="modal-footer">
							        <button type="button" class="btn btn-primary" data-dismiss="modal">Annuler</button>
							        <div class="pull-right" style="margin-left:5px;">
								        {!! Form::open(['method' =>'delete','route' =>['score.destroy',$score->id]]) !!}
								        	<input type="hidden" name="action" value='suppression'/>
								        	{!! Form::submit('Supprimer',['class'=>'btn btn-danger'])!!}
								      	{!! Form::close() !!}
							      	</div>
							      </div>
							    </div>
							  </div>
							</div>

							<!-- Modal de modification d'appréciation -->
							<div class="modal fade" id="editModal{{$score->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
							  <div class="modal-dialog">
							  {!! Form::open(['method' =>'PUT','route' =>['score.update',$score->id]]) !!}
							    <div class="modal-content">
							      <div class="modal-header">
							        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							        <h4 class="modal-title" id="myModalLabel">Modification d'appréciation</h4>
							      </div>
							      <div class="modal-body">
							      <div class="row">
							      <div class="col-md-12">
								  	<div class="col-sm-4 padding-left-off">
								  		<p></p>
								  		<input type="text" class="form-control" name="designation" placeholder="Désignation" value="{{$score->designation}}" required>
								  	</div>
								  	<div class="col-sm-3">
								  		<p></p>
								  		<input type="number" min="0" name="score_start" id="point_d" placeholder="Début" class="form-control" value="{{$score->score_start}}" required>
								  	</div>
								  	<div class="col-sm-3">
								  		<p></p>
								  		<input type="number" min="1" name="score_end" id="point_f" placeholder=" Fin" class="form-control" value="{{$score->score_end}}" required>
								  	</div>
								  	</div>
									</div>
							      </div>
							      <div class="modal-footer">
							        <button type="button" class="btn btn-primary" data-dismiss="modal">Annuler</button>
							        <div class="pull-right" style="margin-left:5px;">
								        {!! Form::submit('Enregistrer',['class'=>'btn btn-success'])!!}
							      	</div>
							      </div>
							    </div>
							    {!! Form::close() !!}
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
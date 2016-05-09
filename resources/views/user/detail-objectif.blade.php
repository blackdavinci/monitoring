@extends('template-user')

<!-- Page Header -->
@section('page-header')
	Détail Objectif {{$objectif->titre}}
@endsection

<!-- Content -->
@section('content-menu')
<!-- Menu  -->
<div class="row">		
	<!-- Actions -->
	<div class="col-md-12 btn-action-menu-right">
		<ul class="head-menu">
			@if($objectif->valider==0)
					@if($objectif->user_id==Auth::user()->id)
						<li>
							<button type="button" class="btn  btn-danger title-Upper" data-toggle="modal"
							 data-target="#deleteModal">
								<b><i class="fa fa-remove fa-fw" aria-hidden="true"></i> Supprimer</b>
							</button>
						</li>
						<li>
							<a href="{{ route('objectif.edit',[$objectif->id])}}" class="btn  btn-primary title-Upper">
								<b><i class="fa fa-edit fa-fw" aria-hidden="true"></i> Modifier</b>
							</a>
						</li>
					@endif
				@endif
				@if($objectif->valider==0 )
					@if($objectif->user->id_sup==Auth::user()->id)
						<li>
							<button type="button" class="btn  btn-success title-Upper" data-toggle="modal"
							 data-target="#validate">
								<b><i class="fa fa-check fa-fw" aria-hidden="true"></i> Valider</b>
							</button>
						</li>
					@endif
				@endif

				@if($objectif->valider==1)
				@if($objectif->user_id==Auth::user()->id)
					<li>
						<button type="button" class="btn  btn-success title-Upper" data-toggle="modal"
						 data-target="#addComment" @if($objectif->note!=0 || $row_comments ==2) disabled @endif>
							<b><i class="fa fa-plus fa-fw" aria-hidden="true"></i> Ajouter un commenatire</b>
						</button>
					</li>
				@endif
				@if($objectif->user->id_sup==Auth::user()->id)
					<li>
						<button type="button" class="btn  btn-danger title-Upper" data-toggle="modal"
						 data-target="#addNote">
							<b><i class="fa fa-pencil fa-fw" aria-hidden="true"></i> Evaluer</b>
						</button>
					</li>
				@endif
				@endif
			
		</ul>
	</div>
</div>
	
@endsection

@section('content')


<!-- Modal de validation d'objectif -->
<div class="modal fade" id="validate" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Suppression d'objectif</h4>
      </div>
      <div class="modal-body">
        Voulez-vous vraimment valider cet objectif <strong>{{ $objectif->titre }}</strong> ?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Annuler</button>
        <div class="pull-right" style="margin-left:5px;">
	        {!! Form::open(['method' =>'PUT','route' =>['objectif.update',$objectif->id]]) !!}
	        	<input type="hidden" name="action" value='valider'/>
	        	{!! Form::submit('Valider',['class'=>'btn btn-success'])!!}
	      	{!! Form::close() !!}
      	</div>
      </div>
    </div>
  </div>
</div>

<!-- Modal de confirmation de suppression d'objectif -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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

<!-- Modal d'ajout de commentaire d'objectif -->
<div class="modal fade" id="addComment" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
  {!! Form::open(['method' =>'POST','route' =>['commentaire.store']]) !!}
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Nouveau commentaire d'objectif</h4>
      </div>
      <div class="modal-body">
	  	<div class="form-group">
	  	    <label for="titre">Titre</label>
	  	    <input type="text" class="form-control" name="titre" id="titre" placeholder="Titre commenatire" value="{{old('titre')}}">
	  	  </div>
	  	  <div class="form-group">
	  	    <label for="exampleInputPassword1">Commenatire</label>
	  	    <textarea name="comments" class="form-control" rows="10" required></textarea>
	  	  </div>
			
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Annuler</button>
        <div class="pull-right" style="margin-left:5px;">

        		{!! Form::hidden('objectif_id',$objectif->id) !!}
	        	{!! Form::submit('Ajouter',['class'=>'btn btn-success'])!!}
      	</div>
      </div>
    </div>
    {!! Form::close() !!}
  </div>
</div>

<!-- Modal Evaluation d'objectif -->
<div class="modal fade" id="addNote" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
  {!! Form::open(['method' =>'PUT','route' =>['objectif.update',$objectif->id]]) !!}
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Evaluation de l'objectif</h4>
      </div>
      <div class="modal-body">
	      <div class="row">
			  	<div class="form-group">
			  	    <div class="col-md-12">
			  	    	<div class="col-md-12">
			  	    	<label for="note">Note</label>
			  	    	</div>
			  	    	<div class="col-md-4">
			  	    	<input type="number" min="0" name="note" id="note" placeholder="Note de l'objectif" class="form-control" ng-model="note" required>
			  	    	</div>
			  	    	<div class="col-md-6" ng-model="note">
			  	    	<% note %> 
			  	    	</div>
			  	    </div>
			  	</div>
		  	</div>
		  	<div class="row">
			  	<div class="form-group">
				  	<div class="col-md-12">
				  		<div class="col-md-12">
					  	  <label for="comment"><p></p>Commenatire</label>
					  	  <textarea name="comment_evaluation" class="form-control" id="comment" rows="10" required></textarea>
				  	  	</div>
				  	</div>	
			  	</div>
	    	</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Annuler</button>
        <div class="pull-right" style="margin-left:5px;">
        		{!! Form::hidden('action','note') !!}
	        	{!! Form::submit('Enregistrer',['class'=>'btn btn-success'])!!}
      	</div>
      </div>
    </div>
    {!! Form::close() !!}
  </div>
</div>



<!-- Content -->
	<div class="row">
		<!-- Ligne Infos Employé -->
			<div class="col-md-12 content-row-padding">
				<div class="row">
					<div class="col-md-12">
						<p class="info-head-title title-Upper title-bottom-border">Données objectif</p>
						<p></p>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<div class="col-md-6 info-data title-Upper">Titre <p></p></div>
						<div class="col-md-6">
							<p class="label label-warning title-Upper label-note pull-right">
								Evaluation Objectif -
								@if($objectif->note!=0)
									Evalué <br/> 
									{{$objectif->note}} - {{$objectif->score->designation}}
								@else
									Non évalué
								@endif
							</p>
						</div>
						<div class="col-md-12">{{$objectif->titre}}<p></p></div>

						<div class="col-md-12 info-data title-Upper">Description <p></p></div>
						<div class="col-md-12">{{$objectif->description}}<p></p></div>

						<div class="col-md-12 info-data title-Upper">Indicateurs <p></p></div>
						<div class="col-md-12">
							@foreach($indicateurs as $indicateur)
							<div class="col-md-4 ">
									<span class="title-data label label-info">
										{{$indicateur->designation}} 
										<i class="fa fa-remove fa-minus" aria-hidden="true"></i>&nbsp;
										{{$indicateur->point}}
									</span>
									<p></p>
							</div>
							@endforeach
						</div>

						<div class="col-md-12 info-data title-Upper">Echéance <p></p></div>
						<div class="col-md-12">
							{{--*/ 
								$dt = new DateTime($objectif->echeance);
	        					$echeance =  $dt->format('d.m.Y');
        					/*--}}
							<b>{{$echeance}}</b>
							<p></p>
						</div>
					</div>
				</div>
			</div>
		
		<!-- Ligne Activités Récentes -->
		<div class="col-md-12 content-row-padding">
			<div class="row">
				<div class="col-md-12">
					<p></p>
					<p class="info-head-title title-Upper title-bottom-border">
						Commenatire(s) Objectif(s)
					</p>
					<p></p>
				</div>
			</div>
			<div class="row">
			@foreach($commentaires as $commentaire)
				<div class="col-md-6 frame-comment">
					<div class="col-md-10">
						<h5>
							<a href=""><b>{{$commentaire->titre}}</b></a>
							<span class="date-info">
								{{--*/ 
									$dt_add = new DateTime($commentaire->created_at);
	        						$dt_ajout =  $dt_add->format('d.m.Y');
        						/*--}}
								- Ajouté le ({{$dt_ajout}})
							</span>
						</h5>
					</div>
					@if($objectif->note==0 && Auth::user()->id==$objectif->user_id)
						<div class="col-md-1">
							<a href="#" data-toggle="modal"
						 data-target="#editComment{{$commentaire->id}}"><i class="fa fa-pencil fa-1x" aria-hidden="true"></i>
						 	</a>
						 </div>
						 <div class="col-md-1">
						 	<a href="#" data-toggle="modal"
						 data-target="#deleteComment{{$commentaire->id}}"><i class="fa fa-trash fa-1x" aria-hidden="true"></i>
						 	</a>
						</div>
					@endif
					<div class="col-md-12">
						{{--*/ $comment = substr($commentaire->comments,0,100) /*--}}
						{{$commentaire->comments}}
						
					</div>
				</div>

				<!-- Modal de modification de commentaire d'objectif -->
				<div class="modal fade" id="editComment{{$commentaire->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				  <div class="modal-dialog">
				  {!! Form::open(['method' =>'PUT','route' =>['commentaire.update',$commentaire->id]]) !!}
				    <div class="modal-content">
				      <div class="modal-header">
				        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				        <h4 class="modal-title" id="myModalLabel">Modification commentaire d'objectif</h4>
				      </div>
				      <div class="modal-body">
					  	<div class="form-group">
					  	    <label for="titre">Titre</label>
					  	    <input type="text" class="form-control" name="titre" id="titre" placeholder="Titre commenatire" 
					  	    value="{{$commentaire->titre}}">
					  	  </div>
					  	  <div class="form-group">
					  	    <label for="exampleInputPassword1">Commenatire</label>
					  	    <textarea name="comments" class="form-control" rows="10" required>{{$commentaire->comments}}</textarea>
					  	  </div>
							
				      </div>
				      <div class="modal-footer">
				        <button type="button" class="btn btn-primary" data-dismiss="modal">Annuler</button>
				        <div class="pull-right" style="margin-left:5px;">

				        		{!! Form::hidden('objectif_id',$objectif->id) !!}
					        	{!! Form::submit('Enregistrer',['class'=>'btn btn-success'])!!}
				      	</div>
				      </div>
				    </div>
				    {!! Form::close() !!}
				  </div>
				</div>

				<!-- Modal de confirmation de commentaire -->
				<div class="modal fade" id="deleteComment{{$commentaire->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				  <div class="modal-dialog">
				    <div class="modal-content">
				      <div class="modal-header">
				        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				        <h4 class="modal-title" id="myModalLabel">Suppression de commentaire</h4>
				      </div>
				      <div class="modal-body">
				        Voulez-vous vraimment supprimer le commentaire <strong>{{ $commentaire->titre }}</strong> ?
				      </div>
				      <div class="modal-footer">
				        <button type="button" class="btn btn-primary" data-dismiss="modal">Annuler</button>
				        <div class="pull-right" style="margin-left:5px;">
					        {!! Form::open(['method' =>'delete','route' =>['commentaire.destroy',$commentaire->id]]) !!}
					        	<input type="hidden" name="action" value='suppression'/>
					        	{!! Form::hidden('objectif_id',$objectif->id) !!}
					        	{!! Form::submit('Supprimer',['class'=>'btn btn-danger'])!!}
					      	{!! Form::close() !!}
				      	</div>
				      </div>
				    </div>
				  </div>
				</div>
			@endforeach
			</div>
		</div>
	</div>
@endsection
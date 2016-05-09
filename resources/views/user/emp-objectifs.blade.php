@extends('template-user')

<!-- Page Header -->
@section('page-header')
	Profil Employé(e) {{$employe->nom.' '.$employe->prenom}} - Objectif(s)
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
				        <li class=""><a href="{{route('employe.profil',[$employe->id])}}">Informations</a></li>
				        <li class="active"><a href="{{route('employe.objectifs',[$employe->id])}}">Objectif(s)</a></li>
				      </ul>
				    </nav>
				  </div>
				</div>
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
			
					<!-- <div class="col-md-12">
						<span class="info-head-title title-Upper label label-success">En cours</span>
						<p></p>
					</div> -->
				</div>
				<div class="row">
					<!-- Variable Année -->
					{{--*/ $now = date('Y'); $marquer = 0; /*--}}
					<div class="col-md-12">
					@foreach($objectifs as $objectif)
						@if($now != $objectif->an)
							{{--*/ $now = $objectif->an; $marquer = 0; /*--}}
						@endif
						@if($now == $objectif->an &&  $marquer == 0)
							{{--*/ $date = $objectif->an /*--}}
							<a href="#" class="link-an" id="an{{$objectif->an}}">
								<div class="col-md-12 title-bottom-border line-year" style="margin-bottom: 15px">
									<span class="info-head-title title-Upper">{{$date}}</span>
								</div>
							</a>
							{{--*/ $marquer = 1; /*--}}
						@endif
					<div class="cadre-objectif-{{$objectif->an}}" >
						<div class="col-md-4 objectif-data">
							<div class="col-md-12">
								<h4 class="title-Upper">
									<a href="{{route('objectif.show',[$objectif->id])}}">
										<b>
											<span class="label 
												@if($objectif->valider==0) label-warning 
												@elseif($objectif->note==0 && $objectif->valider==1) label-success 
												@elseif($objectif->note!=0 && $objectif->valider==1) label-primary 
												@endif">
												 {{$objectif->titre}}

												 @if($objectif->valider==0) 
												 	<i class="fa fa-close fa-fw" aria-hidden="true"></i>
												 @elseif($objectif->note==0 && $objectif->valider==1) 
												 	<i class="fa fa-check fa-fw" aria-hidden="true"></i>
												 @elseif($objectif->note!=0 && $objectif->valider==1)
												 	<i class="fa fa-check fa-fw" aria-hidden="true"></i>						
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
					</div>
					@endforeach
				</div>
			</div>
	</div>
@endsection
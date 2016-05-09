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
								<th>Nom & Prénom </th>
								<th>Fonction / Poste</th>
								<th>Matricule</th>
								<th>Date d'embauche</th>
								<th>Statut</th>
							</tr>
						</thead>
						<tbody>
						@foreach($users as $user)
							<tr class="ligne-user-info">
								<td class="info-table">
									<a href="{{route('employe.profil',[$user->id])}}">{{$user->nom.' '.$user->prenom}}</a>
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
								<td class="info-table">@if($user->statut==0) Désactivé @else Activé @endif</td>
							</tr>
						@endforeach
						</tbody>
					</table>
				</form>
			</div>
		</div>
	</div>
@endsection
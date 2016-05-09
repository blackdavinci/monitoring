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
			<!-- Actions -->
			<div class="col-md-6 btn-action-menu-left">
				<ul class="head-menu">
					<li>
						<a href="{{ route('user.show',[$employe->id])}}" class="btn btn-bloc btn-danger title-Upper">
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
{!! Form::open(['method' =>'put','route' =>['user.update',$employe->id],'class'=>'form-horizontal','novalidate']) !!}

	<input type="hidden" name="_token" value="{{ csrf_token() }}">
	<input type="hidden" name="action" value="update">
	<div class="row">
		<!-- Ligne Infos Employé à Editer-->
			<div class="col-md-12 content-row-padding">
				<div class="row">
					<div class="col-md-12"><span class="info-head-title title-Upper">Informations Employé</span></div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<table class="table table-noborder">
							<tr>
								<td><span class="title-data title-Upper">Nom</span></td>
								<td>
									<div class="col-md-6">
									<span class="info-data">
										<input type="text" class="form-control" id="nom"  name="nom" value="{{$employe->nom}}" required>
									</span>
									</div>
								</td>
							</tr>
							<tr>
								<td><span class="title-data title-Upper">Prénom</span></td>
								<td>
									<div class="col-md-6">
									<span class="info-data">
										<input type="text" class="form-control" id="prenom"  name="prenom" value="{{$employe->prenom}}" required>
									</span>
									</div>
								</td>
							</tr>
							<tr>
								<td><span class="title-data title-Upper">Poste</span></td>
								<td>
									<div class="col-md-6">
									<span class="info-data">
										<input type="text" class="form-control" id="poste"  name="poste" value="{{$employe->poste}}" required>
									</span>
									</div>
								</td>
							</tr>
							<tr>
								<td><span class="title-data title-Upper">Matricule</span></td>
								<td>
									<div class="col-md-6">
									<span class="info-data">
										<input type="text" class="form-control" id="matricule"  name="matricule" value="{{$employe->matricule}}" required>
									</span>
									</div>
								</td>
							</tr>
							<tr>
								<td><span class="title-data title-Upper">Date d'embauche</span></td>
								<td>
									<div class="col-md-6">
									<span class="info-data">
									{{--*/ 
										$dt = new DateTime($employe->date_embauche);
			        					$date_embauche =  $dt->format('d-m-Y');
		        					/*--}}
										<input type="text" class="form-control date-select"  name="date_embauche" 
										value="{{$date_embauche}}" required>
									</span>
									</div>
								</td>
							</tr>
							<tr>
								<td><span class="title-data title-Upper">Rôle</span></td>
								<td>
									<span class="info-data">
										<div class="col-md-6" >
											{!! Form::select('role',['admin'=>'Administrateur','emp'=>'Employé(e)'],$employe->role,['class' =>'form-control','id'=>'role-select']) !!}
										</div>
									</span>
								</td>
							</tr>
							<tr  id="superviseur-select">
								<td><span class="title-data title-Upper">Superviseur</span></td>
								<td>
									<div class="col-md-6">
										{!! Form::select('id_sup',$users,$employe->id_sup,['class' =>'form-control','id'=>'sup-select']) !!}
									</div>
								</td>
							</tr>
							<tr>
								<td></td>
								<td>
									<div class="col-md-6">
										<button type="submit" class="btn btn-success">
											<b class="title-Upper">Enregistrer</b>
										</button>
									</div>
									
								</td>
							</tr>
						</table>
					</div>
				</div>
			</div>
	</div>
</form>
@endsection
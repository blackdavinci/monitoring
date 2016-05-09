@extends('template-admin')

<!-- Page Header -->
@section('page-header')
	Mise à jour identifiants Utilisateur {{$employe->nom.' '.$employe->prenom}}
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
	<input type="hidden" name="action" value="identifiant">
	<div class="row">
		<!-- Ligne Infos Employé à Editer-->
			<div class="col-md-12 content-row-padding">
				<div class="row">
					<div class="col-md-12"><span class="info-head-title title-Upper">Identifiants</span></div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<table class="table table-noborder">
							<tr>
								<td><span class="title-data title-Upper">Login</span></td>
								<td>
									<div class="col-md-6">
									<span class="info-data">
										<input type="text" class="form-control" id="login"  name="login" value="{{$employe->login}}" required>
									</span>
									</div>
								</td>
							</tr>
							<tr>
								<td><span class="title-data title-Upper">Nouveau mot de passe</span></td>
								<td>
									<div class="col-md-6">
									<span class="info-data">
										<input type="password" class="form-control" id="password"  name="password"  required>
									</span>
									</div>
								</td>
							</tr>
							
							<tr>
								<td></td>
								<td>
									<div class="col-md-6">
										<button type="submit" class="btn btn-success">
											<b class="title-Upper">Mettre à jour</b>
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
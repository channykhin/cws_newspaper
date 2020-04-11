@extends('backend.app')
@section('content')
	<section id="block-header">
		<div class="row">
			<div class="col-md-12">
				<h4>
					<i class="fa fa-exclamation"></i>Roles
				</h4>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<ol class="breadcrumb">
					<li><a href="{{route('UserDashboard')}}">Dashboard</a></li>
					<li><a href="{{route('RolesIndex')}}">Roles</a></li>
					<li>View Role</li>
				</ol>
			</div>
		</div>
	</section>	
	<section id="block-body">
		<div class="row user-view">
			<div class="col-md-2">
			</div>
			<div class="col-md-8">
				<div class="panel panel-default panel-body">
					<div class="table-responsive">
						<table class="table table-hover view">
							<tr>
								<td>ID :</td>
								<td>{{$roles->id}}</td>
							</tr>
							<tr>
							<tr>
								<td>Name :</td>
								<td>{{$roles->name}}</td>
							</tr>
							<tr>
								<td>Description :</td>
								<td>{{$roles->description}}</td>
							</tr>
							<tr>
								<td>Priority :</td>
								<td>{{$roles->priority}}</td>
							</tr>
							<tr>
								<td>Users :</td>
								<td>
									@foreach($roles->users as $user)
										<a href="{{ route('UsersView' ,$user->id) }}" target="_blank" class="label label-default" style="text-transform: capitalize;">{{$user->first_name}} {{$user->last_name}}</a>
									@endforeach
								</td>
							</tr>
						</table>
					</div>
				</div>
			</div>
			<div class="col-md-2">
			</div>
		</div>
	</section>
@endsection
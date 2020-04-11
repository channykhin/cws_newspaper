@extends('backend.app')
@section('content')
	@if(Auth::user()->role_id == 1)
		<section id="block-header">
			<div class="row">
				<div class="col-md-12">
					<h4>
						<i class="fa fa-exclamation"></i>Roles
						<span class="pull-right">
							<a href="{{route('RolesCreate')}}" class="btn btn-primary">Add New Roles</a>
						</span>
					</h4>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<ol class="breadcrumb">
						<li><a href="{{route('UserDashboard')}}">Dashboard</a></li>
						<li>Roles</li>
					</ol>
				</div>
			</div>
		</section>	
		<div class="row">
			<div class="col-md-12">	@include('blocks.flash_message_success')</div>
		</div>
		<section id="block-body">
			<div class="row">
				<div class="col-md-12">
					<div class="content">
						<div class="table-responsive">
							<table class="table table-striped table-hover">
								<thead>
									<tr>
										<td>ID</td>
										<td>Name</td>
										<td>Description</td>
										<td>Priority</td>
										<td><a href="{{route('UserPermissionIndex')}}">Users <i class="fa fa-share"></i></a></td>
										<td>Actions</td>
									</tr>
								</thead>
								<tbody>
									@foreach($roles as $role)
										<tr>
											<td>{{$role->id}}</td>
											<td>{{$role->name}}</td>
											<td>{{str_limit($role->description,20,"...")}}</td>
											<td>{{$role->priority}}</td>
											<td>{{$role->users->count()}}</td>
											<td>
												<div class="btn-group">
													<a href="{{route('RolesView', $role->id)}}" class="btn btn-default btn-xs">View</a>
													<a href="{{route('RolesEdit', $role->id)}}" class="btn btn-primary btn-xs">Edit</a>
												</div>
											</td>
										</tr>
									@endforeach
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</section>
	@else 
		<div class="alert alert-danger" role="alert">
			Access denied!
		</div>
	@endif
@endsection
@section('javascript')
  @parent
    <script type="text/javascript">
	    window.setTimeout(function () {
		    $(".alert-success").fadeTo(500, 0).slideUp(500, function () {
		        $(this).remove();
		    });
		}, 5000);
    </script>
@endsection
@extends('backend.app')
@section('content')
	@if(Auth::user()->role_id == 1)
		<section id="block-header">
			<div class="row">
				<div class="col-md-12">
					<h4>
						<i class="fa fa-user"></i>Users
						<span class="pull-right">
							<a href="{{route('UsersCreate')}}" class="btn btn-primary">Add New Users</a>
						</span>
					</h4>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<ol class="breadcrumb">
						<li><a href="{{route('UserDashboard')}}">Dashboard</a></li>
						<li>Users</li>
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
					<div class="header">
						<div class="row">
							<div class="col-md-6">
								<ul class="list-inline">
									<li>All ({{$users_a->count()}})</li>
									<li>Publish ({{$users_p->count()}})</li>
								</ul>
							</div>
							<div class="col-md-6">
								<ul class=" list-inline form pull-right">
									<li>
										<form class="form-inline" role="form">
											<div class="form-group">
											<select class="form-control input-sm" name="filter">
												<option disabled selected>All Role...</option>
												@foreach($roles as $role)
													<option value="{{$role->id}}">{{$role->name}}</option>
												@endforeach
											</select>
												<span>
													<button type="sybmit" class="btn btn-default btn-sm">Filter</button>
												</span>
											</div>
										</form>
									</li>
									<li>
										<form class="form-inline" role="form">
											<div class="form-group">
												<input type="text"  name="search" class="form-control input-sm" placeholder="Enter text..." value=""><span>
													<button type="sybmit" class="btn btn-default btn-sm">Search</button>
												</span>
											</div>
										</form>
									</li>
								</ul>
							</div>
						</div>
					</div>
					<div class="content">
						<div class="table-responsive">
							<table class="table table-striped table-hover">
								<thead>
									<tr>
										<td>ID</td>
										<td>Email</td>
										<td>Usernme</td>
										<td><a href="{{route('RolesIndex')}}">Roles <i class="fa fa-share"></i></a></td>
										<td>Status</td>
										<td>Profile</td>
										<td>Last logged in</td>
										<td>Actions</td>
									</tr>
								</thead>
								<tbody>
									@if($users->count() > 0)
										@foreach($users as $user)
											<tr>
												<td>{{$user->id}}</td>
												<td>{{$user->email}}</td>
												<td>{{$user->username}}</td>
												<td>
													<label class="label label-default">{{ $user->roles->name }}</label>
												</td>
												<td>
													@if($user->status > 0)
														<a href="{{route('UsersUnpublish', $user->id)}}">Unpublish</a>
													@else 
														<a href="{{route('UsersPublish', $user->id)}}">Publish</a>
													@endif
												</td>
												<td>
													@if($user->profile)
														<img src="/images/profiles/{{$user->profile}}" class="profile-bg"/>
													@else
														<img src="/images/profiles/profile-bg.jpeg" class="profile-bg"/>
													@endif
												</td>
												<td>
													@if(Auth::check())
														@if(Auth::user()->online == $user->online)
															<i class="fa fa-circle" style="color: green;"></i>Active
														@elseif($user->last_logged)
															{{$user->last_logged->diffForHumans()}}
														@else
															Never
														@endif
													@endif
												</td>
												<td>
													<div class="btn-group">
														<a href="{{route('UsersView', $user->id)}}" class="btn btn-default btn-xs">View</a>
														<a href="{{route('UsersEdit', $user->id)}}" class="btn btn-primary btn-xs">Edit</a>
														<a href="{{route('UsersDestroy', $user->id)}}" class="btn btn-danger btn-xs" id="delete-btn">Delete</a>
														@if(Auth::user()->role_id != $user->role_id)
															<a href="{{route('UsersChangePassword', $user->id)}}" class="btn btn-success btn-xs" id="delete">Change Password</a>
														@elseif(Auth::user()->id == $user->id)
															<a href="{{route('UsersChangePassword', $user->id)}}" class="btn btn-success btn-xs" id="delete">Change Password</a>
														@endif
													</div>
												</td>
											</tr>
										@endforeach
									@else 
									<tr>
										<td colspan="9" class="text-center text-danger">No data found!</td>
									</tr>
									@endif
								</tbody>
							</table>
						</div>
					</div>
					<div class="page">
						@include('pagination.custom', ['paginator' => $users])
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
        var deleter = {
	        linkSelector : "a#delete-btn",
	        init: function() {
	            $(this.linkSelector).on('click', {self:this}, this.handleClick);
	        },
	        handleClick: function(event) {
	            event.preventDefault();
	            var self = event.data.self;
	            var link = $(this);
	            swal({
	                title: "Are you sure?",
					text: "You will not be able to recover this record!",
					type: "warning",
					showCancelButton: true,
					confirmButtonClass: "btn-danger",
					confirmButtonText: "Yes, delete it!",
					cancelButtonText: "Cancel",
					confirmButtonColor: '#3085d6',
					cancelButtonColor: '#d33',
					closeOnConfirm: false,
					closeOnCancel: false
	            },
	            function(isConfirm){
	                if(isConfirm){
	                	swal("Deleted!", "Your record has been deleted.", "success");
	                	window.location = link.attr('href');
	                }
	                else{
	                    swal("cancelled", "record deletion Cancelled", "error");
	                }
	            });
	        },
	    };
	    deleter.init();
	    window.setTimeout(function () {
		    $(".alert-success").fadeTo(500, 0).slideUp(500, function () {
		        $(this).remove();
		    });
		}, 5000);
    </script>
@endsection
@extends('backend.app')
@section('content')
	<section id="block-header">
		<div class="row">
			<div class="col-md-12">
				<h4>
					<i class="fa fa-user"></i>Account Setting
				</h4>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<ol class="breadcrumb">
					<li><a href="{{route('UserDashboard')}}">Dashboard</a></li>
					<li><a href="{{route('UserPermissionIndex')}}">Users</a></li>
					<li>Account Setting</li>
				</ol>
			</div>
		</div>
	</section>	
	<div class="row">
		<div class="col-md-12">	@include('blocks.flash_message_success')</div>
	</div>
	<section id="block-body">
		<div class="row user-view">
			<div class="col-md-3">
				<div class="panel panel-default panel-body">
					<header>
						{{ $users->first_name }} {{ $users->last_name }}
					</header>
					<div class="content">
						@if($users->profile)
							<img src="/images/profiles/{{$users->profile}}" class="profile-view"/>
						@else
							<img src="/images/profiles/profile-bg.jpeg" class="profile-view"/>
						@endif
						<p>{{ $users->roles->name }}</p>
					</div>
					<footer class="btn-group">
						<a href="{{route('UsersProfileEdit', $users->id)}}" class="btn btn-default btn-sm"><i class="fa fa-pencil"></i>Edit</a>
						<a href="{{route('UsersProfilePasswordEdit', $users->id)}}" class="btn btn-default btn-sm"><i class="fa fa-key"></i>Change Password</a>
					</footer>
				</div>
				<a href="{{ route('UsersActivity', $users->id) }}" class="btn btn-default btn-block btn-sm"><i class="fa fa-check"></i>View all activity</a>
			</div>
			<div class="col-md-9">
				<div class="panel panel-default panel-body">
					<div class="table-responsive">
						<table class="table table-hover view">
							<tr>
								<td>ID :</td>
								<td>{{$users->id}}</td>
							</tr>
							<tr>
							<tr>
								<td>First Name :</td>
								<td>{{$users->first_name}}</td>
							</tr>
							<tr>
								<td>Last Name :</td>
								<td>{{$users->last_name}}</td>
							</tr>
							<tr>
								<td>Email :</td>
								<td>{{$users->email}}</td>
							</tr>
							<tr>
								<td>Phone Number :</td>
								<td>{{$users->phone}}</td>
							</tr>
							<tr>
								<td>Username :</td>
								<td>{{$users->username}}</td>
							</tr>
							<tr>
								<td>Status :</td>
								<td>
									@if($users->status > 0)
										Publish
									@else 
										Unpublish
									@endif
								</td>
							</tr>
							<tr>
								<td>Last Logged in :</td>
								<td>
									@if(Auth::check())
										@if(Auth::user()->online == $users->online)
											<i class="fa fa-circle" style="color: green;"></i>Active
										@elseif($users->last_logged)
											{{$users->last_logged>diffForHumans()}}
										@else
											Never
										@endif
									@endif
								</td>
							</tr>
							<tr>
								<td>Created At :</td>
								<td>
									@if($users->created_at)
										{{$users->created_at->toDayDateTimeString()}}
									@endif
								</td>
							</tr>
							<tr>
								<td>Last Update :</td>
								<td>
									@if($users->updated_at)
										{{$users->updated_at->toDayDateTimeString()}}
									@endif
								</td>
							</tr>
						</table>
					</div>
				</div>
			</div>
		</div>
	</section>
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
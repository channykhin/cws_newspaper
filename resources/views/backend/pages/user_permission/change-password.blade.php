@extends('backend.app')
@section('content')
	@if(Auth::user()->role_id == 1)
	<section id="block-header">
		<div class="row">
			<div class="col-md-12">
				<h4>
					<i class="fa fa-key"></i>Change Password
					<span class="pull-right">
						<a href="{{route('UserPermissionIndex')}}" class="btn btn-danger">Back</a>
					</span>
				</h4>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<ol class="breadcrumb">
					<li><a href="{{route('UserDashboard')}}">Dashboard</a></li>
					<li><a href="{{route('UserPermissionIndex')}}">User</a></li>
					<li>Change Password</li>
				</ol>
			</div>
		</div>
	</section>	
	<section id="block-body">
			<div class="row">
				<div class="col-md-4"></div>
				<div class="col-md-4">
					<div>@include('blocks.flash_message_success')</div>
					<div>@include('blocks.flash_message_warning')</div>
					<div class="form">
						{!! Form::open(['route' => ['UsersChangePasswordUpdate', $users->id], 'files' => true])  !!}
							<div class="form-group">
							    {!! Form::label('current_password', 'Current Password') !!}
							    {!! Form::password('current_password', ['class' => 'form-control']) !!}
							    @if($errors->has('current_password'))
									<p class="error">{{ $errors->first('current_password')}}</p>
								@endif
							</div>
							<div class="form-group">
							    {!! Form::label('new_password', 'New Password') !!}
							    {!! Form::password('new_password', ['class' => 'form-control']) !!}
							    @if($errors->has('new_password'))
									<p class="error">{{ $errors->first('new_password')}}</p>
								@endif
							</div>
							<div class="form-group">
							    {!! Form::label('confirm_password', 'Confirm Password') !!}
							    {!! Form::password('confirm_password', ['class' => 'form-control']) !!}
							    @if($errors->has('confirm_password'))
									<p class="error">{{ $errors->first('confirm_password')}}</p>
								@endif
							</div>
							<div class="form-group">
								<label></label>
								<button class="btn btn-success btn-sm btn-block">Save</button>
							</div>
	       				{!! Form::close() !!}
					</div>
				</div>
				<div class="col-md-4"></div>
			</div>
	</section>
	@else
		<div class="alert alert-danger" role="alert">
			Access denied! <a href="{{ route('UserPermissionIndex') }}"><i></i>Back</a>
		</div>
	@endif
@endsection
@section('javascript')
  @parent
    <script type="text/javascript">
	    window.setTimeout(function () {
		    $(".alert-danger").fadeTo(500, 0).slideUp(500, function () {
		        $(this).remove();
		    });
		}, 5000);
	    window.setTimeout(function () {
		    $(".alert-warning").fadeTo(500, 0).slideUp(500, function () {
		        $(this).remove();
		    });
		}, 5000);
    </script>
@endsection
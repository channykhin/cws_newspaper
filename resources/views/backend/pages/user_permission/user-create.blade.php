@extends('backend.app')
@section('content')
	<section id="block-header">
		<div class="row">
			<div class="col-md-12">
				<h4>
					<i class="fa fa-user"></i> Add New User
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
					<li>Add New User</li>
				</ol>
			</div>
		</div>
	</section>	
	<section id="block-body">
       {!! Form::open(['route'=> 'UsersStore', 'files' => true])  !!}
			<div class="form">
				<div class="row">
					<div class="col-md-8">
						<div class="panel panel-default panel-body">
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label>
											First Name	
										</label>
										<input type="text" name="first_name" class="form-control" autocomplete="off" autofocus="">
									    @if($errors->has('first_name'))
											<p class="error">{{ $errors->first('first_name')}}</p>
										@endif
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label>
											Last Name	
										</label>
										<input type="text" name="last_name" class="form-control">
									    @if($errors->has('last_name'))
											<p class="error">{{ $errors->first('last_name')}}</p>
										@endif
									</div>
								</div>
							</div>
							<div class="form-group">
								<label>
									Email	
								</label>
								<input type="text" name="email" class="form-control" autocomplete="off">
							    @if($errors->has('email'))
									<p class="error">{{ $errors->first('email')}}</p>
								@endif
							</div>
							<div class="form-group">
								<label>
									Phone	
								</label>
								<input type="text" name="phone" class="form-control" autocomplete="off">
							    @if($errors->has('phone'))
									<p class="error">{{ $errors->first('phone')}}</p>
								@endif
							</div>
							<div class="form-group">
								<label>
									Username	 
								</label>
								<input type="text" name="username" class="form-control" autocomplete="off">
							    @if($errors->has('username'))
									<p class="error">{{ $errors->first('username')}}</p>
								@endif
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label>
											Password	
										</label>
										<input type="password" name="password" class="form-control">
									    @if($errors->has('password'))
											<p class="error">{{ $errors->first('password')}}</p>
										@endif
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label>
											Confirm Password	
										</label>
										<input type="password" name="confirm_password" class="form-control">
									    @if($errors->has('confirm_password'))
											<p class="error">{{ $errors->first('confirm_password')}}</p>
										@endif
									</div>
								</div>
							</div>
							<div class="form-group">
								<label>
									Display Name	
								</label>
								<input type="text" name="display_name" class="form-control" autocomplete="off">
							    @if($errors->has('display_name'))
									<p class="error">{{ $errors->first('display_name')}}</p>
								@endif
							</div>
						</div>
					</div>
					<div class="col-md-4">
						<div class="panel panel-body panel-default">
							<div class="form-group">
								<label>
									Roles	
								</label>
								<select class="form-control" name="role_id">
									<option disabled selected>Choose Role...</option>
									@foreach($roles as $role)
										<option value="{{$role->id}}">{{$role->name}}</option>
									@endforeach
								</select>
							    @if($errors->has('role_id'))
									<p class="error">{{ $errors->first('role_id')}}</p>
								@endif
							</div>
							<div class="form-group">
								<label>
									Featured Image	
								</label>
            					<input id="image" name="profile" type="file" accept="image/*" class="file-loading" data-show-upload="false">
							    @if($errors->has('profile'))
									<p class="error">{{ $errors->first('profile')}}</p>
								@endif
							</div>
							<div class="form-group">
								<label>
									Publish	
								</label>
								<input type="checkbox" name="status" value="1" style="margin-left: 15px;">
							    @if($errors->has('status'))
									<p class="error">{{ $errors->first('status')}}</p>
								@endif
							</div>
							<hr>
							<div class="form-group">
								<label></label>
								<button class="btn btn-success btn-sm btn-block form-control">Save</button>
							</div>
						</div>
					</div>
				</div>
			</div>
       {!! Form::close() !!}
	</section>
@endsection
@section('javascript')
  @parent
  <script>
    $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
    $("#image").fileinput({

      initialPreviewConfig: [

      ],// server upload action
      uploadAsync: true,
      previewFileType: "image",
      showRemove: false,
      showCaption: false,
      browseClass: "btn btn-default btn-block",
      browseIcon: "<i class='fa fa-image'></i>"
    }).on("filebatchselected", function(event, files) {
      $("#image").fileinput("upload");
    });
    $("#image").on("filepredelete", function(jqXHR) {
      var abort = true;
      if (confirm("Are you sure you want to delete this image?")) {
        abort = false;
      }
      return abort;
    });
  </script>
@endsection
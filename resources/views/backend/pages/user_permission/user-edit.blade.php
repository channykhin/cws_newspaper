@extends('backend.app')
@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@stop
@section('content')
	<section id="block-header">
		<div class="row">
			<div class="col-md-12">
				<h4>
					<i class="fa fa-user"></i> Edit User
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
					<li>Edit User</li>
				</ol>
			</div>
		</div>
	</section>	
	<section id="block-body">
       {!! Form::model($users, ['route'=> ['UserUpdate', $users->id], 'files' => true])  !!}
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
										{!! Form::text('first_name',null,['class' => 'form-control', 'autocomplete' => 'off', 'autofocus' => '']) !!}
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
										{!! Form::text('last_name',null,['class' => 'form-control', 'autocomplete' => 'off']) !!}
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
								{!! Form::text('email',null,['class' => 'form-control', 'autocomplete' => 'off']) !!}
							    @if($errors->has('email'))
									<p class="error">{{ $errors->first('email')}}</p>
								@endif
							</div>
							<div class="form-group">
								<label>
									Phone	
								</label>
								{!! Form::text('phone',null,['class' => 'form-control', 'autocomplete' => 'off']) !!}
							    @if($errors->has('phone'))
									<p class="error">{{ $errors->first('phone')}}</p>
								@endif
							</div>
							<div class="form-group">
								<label>
									Display Name	
								</label>
								{!! Form::text('display_name',null,['class' => 'form-control', 'autocomplete' => 'off']) !!}
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
									<option selected value="{{$users->role_id}}">{{$users->roles->name}}</option>
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
                      			{!! Form::checkbox('status', '1') !!}
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
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
    $("#image").fileinput({
      uploadUrl: "{{route('UserUploadImage', $users->id)}}",
      uploadAsync: true,
      imagePreview: true,
      previewFileType: "image",
      showRemove: false,
      browseClass: "btn btn-default btn-block",
	  showCaption: false,
      initialPreview: [
      	@if($users->profile)
		"<img src='/images/profiles/{{ $users->profile }}' class='file-preview-image' alt=''  width='100%'>",
		@endif
      ],        
      initialPreviewConfig: [
            {caption: "{{$users->img}}", width: "120px", url: "{{route('UserDestroyImage')}}", key: {{$users->id}}},
        ],
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
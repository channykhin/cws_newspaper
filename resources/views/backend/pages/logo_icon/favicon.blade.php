@extends('backend.app')
@section('content')
	<section id="block-header">
		<div class="row">
			<div class="col-md-12">
				<h4>
					<i class="fa fa-logo"></i>Add New Favicon
				</h4>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<ol class="breadcrumb">
					<li><a href="{{route('UserDashboard')}}">Dashboard</a></li>
					<li><a href="{{route('LogoIconIndex')}}">Logo & Favicon</a></li>
					<li>Add New Favicon</li>
				</ol>
			</div>
		</div>
	</section>	
	<div class="row">
		<div class="col-md-12">	@include('blocks.flash_message_success')</div>
	</div>
	<section id="block-body" style="margin-top: 40px">
		<div class="content>
			<div class="row">
				<div class="col-md-4"></div>
				<div class="col-md-4">
					{!! Form::open(['route'=> 'FaviconStore', 'files' => true])  !!}
						<input id="image" name="img" type="file" accept="image/*" class="file-loading" data-show-upload="false">
					    @if($errors->has('img'))
							<p class="error">{{ $errors->first('img')}}</p>
						@endif
						<div class="form-group">
							<label></label>
							<button class="btn btn-success btn-sm btn-block form-control">Save</button>
						</div>
       				{!! Form::close() !!}
				</div>
				<div class="col-md-4"></div>
			</div>
		</div>
	</section>
@endsection
@section('javascript')
  @parent
  <script>
  	$(document).on('ready', function() {
	    $("#image").fileinput({
	        previewFileType: "image",
	        browseClass: "btn btn-success",
	        browseLabel: "Browse",
	        browseIcon: "<i class=\"fa fa-image\"></i> ",
	        removeClass: "btn btn-danger",
	        removeLabel: "Delete",
	        removeIcon: "<i class=\"fa fa-trash\"></i> ",
	        uploadClass: "btn btn-info",
	        uploadLabel: "Upload",
	        uploadIcon: "<i class=\"fa fa-upload\"></i> ",
	        showCaption: false,
	    });
	});
  </script>
@endsection
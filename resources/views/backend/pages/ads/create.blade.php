@extends('backend.app')
@section('content')
	<section id="block-header">
		<div class="row">
			<div class="col-md-12">
				<h4>
					<i class="bookmark"></i> Add New Ads
					<span class="pull-right">
						<a href="{{route('AdsIndex')}}" class="btn btn-danger">Back</a>
					</span>
				</h4>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<ol class="breadcrumb">
					<li><a href="{{route('UserDashboard')}}">Dashboard</a></li>
					<li><a href="{{route('AdsIndex')}}">Ads</a></li>
					<li>Add New Ads</li>
				</ol>
			</div>
		</div>
	</section>	
	<section id="block-body">
		<div class="row">
			<div class="col-md-3"></div>
			<div class="col-md-6">
				<div class="form">
       				{!! Form::open(['route'=> 'AdsStore', 'files' => true, 'class' => 'form-horizontal'])  !!}
						<div class="form-group">
							<label class="col-sm-2">
								Pages 	
							</label>
							<div class="col-sm-10">
								<select class="form-control" name="page">
									<option selected disabled="">Select Page</option>
									<option value="Home Page">Home Page</option>
									<option value="Categories Page">Categories Page</option>
									<option value="Sub Categories Page">Sub Categories Page</option>
									<option value="Tag Page">Tag Page</option>
									<option value="All Pages">All Pages</option>
								</select>
							    @if($errors->has('page'))
									<p class="error">{{ $errors->first('page')}}</p>
								@endif
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2">
								Positions 	
							</label>
							<div class="col-sm-10">
								<select class="form-control" name="position">
									<option selected disabled="">Select Position</option>
									<option value="Next Logo">Next Logo</option>
									<option value="Bottom Menu">Under Menu</option>
									<option value="Pop up">Pop up</option>
									<option value="Both Sides">Both Sides</option>
									<option value="Aside Right">Aside Right</option>
									<option value="Under Categories Type">Under Categories Type</option>
									<option value="Under Article Title">Under Article Title</option>
									<option value="Footer">Footer</option>
								</select>
							    @if($errors->has('page'))
									<p class="error">{{ $errors->first('page')}}</p>
								@endif
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2">
								Sizes	
							</label>
							<div class="col-sm-10">
								<select class="form-control" name="size">
									<option selected disabled="">Select Size</option>
									<option value="360 x 360">360 x 360</option>
									<option value="1080 x 120">1080 x 120</option>
									<option value="720 x 120">720 x 120</option>
									<option value="600 x 120">600 x 120</option>
									<option value="600 x 600">600 x 600</option>
									<option value="120 x 1080">120 x 1080</option>
								</select>
							    @if($errors->has('size'))
									<p class="error">{{ $errors->first('size')}}</p>
								@endif
							</div>
						</div>
							<div class="form-group">
								<label class="col-sm-2">
									Image	
								</label>
								<div class="col-sm-10">
	            					<input id="image" name="img" type="file" accept="image/*" class="file-loading" data-show-upload="false">
								    @if($errors->has('img'))
										<p class="error">{{ $errors->first('img')}}</p>
									@endif
								</div>
							</div>
						<div class="form-group">
							<label class="col-sm-2">
								Name	
							</label>
							<div class="col-sm-10">
								<input type="text" name="name" class="form-control" autocomplete="off">
							    @if($errors->has('name'))
									<p class="error">{{ $errors->first('name')}}</p>
								@endif
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2">
								URL 	
							</label>
							<div class="col-sm-10">
								<input type="text" name="url" class="form-control" autocomplete="off">
							    @if($errors->has('url'))
									<p class="error">{{ $errors->first('url')}}</p>
								@endif
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2">
								Price ($) 	
							</label>
							<div class="col-sm-10">
								<input type="text" name="price" class="form-control" autocomplete="off">
							    @if($errors->has('price'))
									<p class="error">{{ $errors->first('price')}}</p>
								@endif
							</div>
						</div>
							<div class="form-group">
								<label class="col-sm-2">
									Publish	
								</label>
								<div class="col-sm-10">
									<input type="checkbox" name="status" value="1">
								    @if($errors->has('status'))
										<p class="error">{{ $errors->first('status')}}</p>
									@endif
								</div>
							</div>
						<div class="form-group">
							<div class="col-sm-2"></div>
							<div class="col-sm-10">
								<button class="btn btn-success btn-sm btn-block">Save</button>
							</div>
						</div>
       				{!! Form::close() !!}
				</div>
			</div>
			<div class="col-md-3"></div>
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
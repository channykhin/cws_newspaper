@extends('backend.app')
@section('content')
	<section id="block-header">
		<div class="row">
			<div class="col-md-12">
				<h4>
					<span class="glyphicon glyphicon-folder-tags"></span> Add New Articles
					<span class="pull-right">
						<a href="{{route('ArticlesIndex')}}" class="btn btn-danger">Back</a>
					</span>
				</h4>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<ol class="breadcrumb">
					<li><a href="{{route('UserDashboard')}}">Dashboard</a></li>
					<li><a href="{{route('ArticlesIndex')}}">Articles</a></li>
					<li>Add New Articles</li>
				</ol>
			</div>
		</div>
	</section>	
	<section id="block-body">
       {!! Form::open(['route'=> 'ArticlesStore', 'files' => true])  !!}
			<div class="form">
				<div class="row">
					<div class="col-md-8">
						<div class="panel panel-default panel-body">
							<div class="form-group">
								<label>
									Title	
								</label>
								<input type="text" name="title" class="form-control" autofocus autocomplete="off">
							    @if($errors->has('title'))
									<p class="error">{{ $errors->first('title')}}</p>
								@endif
							</div>
							<div class="form-group">
								<label>
									Slug	
								</label>
								<input type="text" name="slug" class="form-control" autofocus autocomplete="off">
							    @if($errors->has('slug'))
									<p class="error">{{ $errors->first('slug')}}</p>
								@endif
							</div>
							<div class="form-group">
								<label>
									Short Description	
								</label>
								<textarea name="short_desc" class="form-control" rows="5"></textarea>
							    @if($errors->has('short_desc'))
									<p class="error">{{ $errors->first('short_desc')}}</p>
								@endif
							</div>
							<div class="form-group">
								<label>
									Body	
								</label> 
								<textarea name="body" class="form-control" rows="5" id="my-editor"></textarea>
							    @if($errors->has('body'))
									<p class="error">{{ $errors->first('body')}}</p>
								@endif
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label>
											Author	
										</label>
										<select class="form-control" name="author">
											<option disabled selected>Choose Auhtor...</option>
											@foreach($authors as $author)
												<option value="{{$author->display_name}}">{{$author->display_name}}</option>
											@endforeach
										</select>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label>
											Reference	
										</label>
										<input type="text" name="reference" class="form-control">
									    @if($errors->has('reference'))
											<p class="error">{{ $errors->first('reference')}}</p>
										@endif
									</div>
								</div>
							</div>
							<div class="form-group">
								<label>
									Links reference	 
								</label>
								<input type="text" name="reference_link" class="form-control" autocomplete="off">
							    @if($errors->has('reference_link'))
									<p class="error">{{ $errors->first('reference_link')}}</p>
								@endif
							</div>
						</div>
					</div>
					<div class="col-md-4">
						<div class="panel panel-body panel-default">
							<div class="form-group">
								<label>
									Categories	
								</label>
								<select class="form-control" name="categories_id">
									<option disabled selected>Choose Categories...</option>
									@foreach($categories as $category)
										<option value="{{$category->id}}">{{$category->name}}</option>
									@endforeach
								</select>
							    @if($errors->has('categories_id'))
									<p class="error">{{ $errors->first('categories_id')}}</p>
								@endif
							</div>
							<div class="form-group">
								<label>
									Sub Categories	
								</label>
								<select class="form-control" name="sub_categories_id">
									<option disabled selected>Choose Sub Categories...</option>
									@foreach($categories as $category)
										<optgroup label="* {{$category->name}}">
											@foreach($category->subcategories as $sub)
												<option value="{{$sub->id}}">{{$sub->name}}</option>
											@endforeach	
										</optgroup>
									@endforeach
									<option value="0">Null</option>
								</select>
							    @if($errors->has('sub_categories_id'))
									<p class="error">{{ $errors->first('sub_categories_id')}}</p>
								@endif
							</div>
							<div class="form-group">
								<label>
									Tags	
								</label>
								<select class="form-control select2-multi" name="tags[]" multiple="multiple">
									@foreach($tags as $tag)
										<option value="{{$tag->id}}">{{$tag->name}}</option>
									@endforeach
								</select>
							    @if($errors->has('tags'))
									<p class="error">{{ $errors->first('tags')}}</p>
								@endif
							</div>
							<div class="form-group">
								<label>
									Thumbnail image
								</label>
            					<input id="image" name="img" type="file" accept="image/*" class="file-loading " data-show-upload="false">
							    @if($errors->has('img'))
									<p class="error">{{ $errors->first('img')}}</p>
								@endif
							</div>
							<div class="form-group">
								<label>
									Featured image
								</label>
            					<input id="image1" name="img_slider" type="file" accept="image/*" class="file-loading " data-show-upload="false">
							    @if($errors->has('img_slider'))
									<p class="error">{{ $errors->first('img_slider')}}</p>
								@endif
							</div>
							<div class="form-group">
								<label>
									Publish	
								</label>
								<input type="checkbox" name="status" value="1" class="form-control checkbox ">
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
	    $("#image1").fileinput({
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
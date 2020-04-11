@extends('backend.app')
@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@stop
@section('content')
	<section id="block-header">
		<div class="row">
			<div class="col-md-12">
				<h4>
					<span class="glyphicon glyphicon-folder-tags"></span> Edit Articles
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
					<li>Edit Articles</li>
				</ol>
			</div>
		</div>
	</section>	
	<section id="block-body">
       {!! Form::model($articles, ['route'=> ['ArticlesUpdate', $articles->id], 'files' => true])  !!}
			<div class="form">
				<div class="row">
					<div class="col-md-8">
						<div class="panel panel-default panel-body">
							<div class="form-group">
								<label>
									Title	
								</label>
								{!! Form::text('title',null,['class' => 'form-control', 'autocomplete' => 'off']) !!}
							    @if($errors->has('title'))
									<p class="error">{{ $errors->first('title')}}</p>
								@endif
							</div>
							<div class="form-group">
								<label>
									Slug	
								</label>
								{!! Form::text('slug',null,['class' => 'form-control', 'autocomplete' => 'off']) !!}
							    @if($errors->has('slug'))
									<p class="error">{{ $errors->first('slug')}}</p>
								@endif
							</div>
							<div class="form-group">
								<label>
									Short Description	
								</label>
								{!! Form::textarea('short_desc',null,['class' => 'form-control', 'rows' => '5']) !!}
							    @if($errors->has('short_desc'))
									<p class="error">{{ $errors->first('short_desc')}}</p>
								@endif
							</div>
							<div class="form-group">
								<label>
									Body	
								</label> 
								{!! Form::textarea('body',null,['class' => 'form-control', 'rows' => '15', 'id' => 'my-editor']) !!}
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
											<option selected disabled value="{{$articles->author}}">{{$articles->author}}</option>
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
										{!! Form::text('reference',null,['class' => 'form-control']) !!}
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
								{!! Form::text('reference_link',null,['class' => 'form-control']) !!}
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
									<option selected value="{{$articles->categories_id}}">{{$articles->categories->name}}</option>
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
									@if($articles->sub_categories_id)
										<option selected value="{{$articles->subcategories->id}}">{{$articles->subcategories->name}}</option>
									@else
										<option value="0">Null</option>
									@endif
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
								{{ Form::label('tags', 'Tags') }}
								{{ Form::select('tags[]', $tags, null, ['class' => ' select2-multi form-control', 'multiple' => 'multiple']) }}
							    @if($errors->has('tags'))
									<p class="error">{{ $errors->first('tags')}}</p>
								@endif
							</div>
							<div class="form-group">
								<label>
									Thumbnail image
								</label>
            					<input id="image" name="img" type="file" accept="image/*" class="file-loading" data-show-upload="false">
							    @if($errors->has('img'))
									<p class="error">{{ $errors->first('img')}}</p>
								@endif
							</div>
							<div class="form-group">
								<label>
									Featured image
								</label>
            					<input id="image1" name="img_slider" type="file" accept="image/*" class="file-loading" data-show-upload="false">
							    @if($errors->has('img_slider'))
									<p class="error">{{ $errors->first('img_slider')}}</p>
								@endif
							</div>
							<div class="form-group">
								<label style="margin-right: 5px;">
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
      uploadUrl: "{{route('ArticsleUploadImage', $articles->id)}}",
      uploadAsync: true,
      imagePreview: true,
      previewFileType: "image",
      showRemove: false,
      browseClass: "btn btn-default btn-block",
	  showCaption: false,
      initialPreview: [
      	@if($articles->img)
		"<img src='/images/posts/{{$articles->categories->dir}}/{{ $articles->img }}' class='file-preview-image' alt=''  width='100%'>",
		@endif
      ],        
      initialPreviewConfig: [
            {caption: "{{$articles->img}}", width: "120px", url: "{{route('ArticlesDestroyImage')}}", key: {{$articles->id}}},
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


    $("#image1").fileinput({
      uploadUrl: "{{route('ArticsleUploadImage1', $articles->id)}}",
      uploadAsync: true,
      imagePreview: true,
      previewFileType: "image",
      showRemove: false,
      browseClass: "btn btn-default btn-block",
	  showCaption: false,
      initialPreview: [
      	@if($articles->img_slider)
		"<img src='/images/posts/{{$articles->categories->dir}}/{{ $articles->img_slider }}' class='file-preview-image' alt=''  width='100%'>",
		@endif
      ],        
      initialPreviewConfig: [
            {caption: "{{$articles->img_slider}}", width: "120px", url: "{{route('ArticlesDestroyImage1')}}", key: {{$articles->id}}},
        ],
    }).on("filebatchselected", function(event, files) {
      $("#image1").fileinput("upload");
    });
    $("#image1").on("filepredelete", function(jqXHR) {
      var abort = true;
      if (confirm("Are you sure you want to delete this image?")) {
        abort = false;
      }
      return abort;
    });

 	$('.select2-multi').select2().val({!! json_encode($articles->tags()->getRelatedIds()) !!}).trigger('change');
  </script>
@endsection
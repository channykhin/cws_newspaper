@extends('backend.app')
@section('content')
	<section id="block-header">
		<div class="row title">
			<div class="col-md-12">
				<h4>
					Posts
					<span class="pull-right">
						<a href="{{route('ArticlesCreate')}}" class="btn btn-default">Add New Articles</a>
					</span>
				</h4>
			</div>
		</div>
	</section>	
	<div class="row">
		<div class="col-md-12">	@include('blocks.flash_message_success')</div>
	</div>
	<section id="block-body">
		<div class="header">
			<div class="row">
				<div class="col-md-2">
					<ul class="list-inline">
						<li>All ({{$articles_a->count()}})</li>
						<li>Publish ({{$articles_p->count()}})</li>
					</ul>
				</div>
				<div class="col-md-10">
					<ul class="list-inline form pull-right">
						<li>
							<form class="form-inline" role="form">
								<div class="form-group">
								<select class="form-control input-sm" name="filter0">
									<option disabled selected>All Categories...</option>
									@foreach($categories as $category)
										<option value="{{$category->id}}">{{$category->name}}</option>
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
								<select class="form-control input-sm" name="filter1">
									<option disabled selected>All Sub Categories...</option>
									@foreach($sub_categories as $sub_category)
										<option value="{{$sub_category->id}}">{{$sub_category->name}}</option>
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
							<td>Title</td>
							<td>Image </td>
							<td>Categories</td>
							<td>Sub Categories</td>
							<td>Tags</td>
							<td>Status</td>
							<td>Date</td>
							<td>Views</td>
							<td>Actions</td>
						</tr>
					</thead>
					<tbody>
						@if($articles->count() > 0)
							@foreach($articles as $article)
								<tr>
									<td>{{$article->id}}</td>
									<td>{{str_limit($article->title,20,"...")}}</td>
									<td><img src="/images/posts/{{$article->categories->dir}}/{{$article->img}}" alt="" width="100px"></td>
									<td>{{$article->categories->name}}</td>
									<td>
										@if($article->sub_categories_id)
											{{$article->subcategories->name}}
										@endif
									</td>
									<td>
										@if($article->tags->count() > 0)
											@foreach($article->tags as $tag)
												<label class="label label-default">{{$tag->name}}</label>
											@endforeach
										@else

										@endif
									</td>
									<td>
										@if($article->status > 0)
											<a href="{{route('ArticlesUnpublish', $article->id)}}">Unpublish</a>
										@else 
											<a href="{{route('ArticlesPublish', $article->id)}}">Publish</a>
										@endif
									</td>
									<td>
										@if($article->created_at)
											{{$article->created_at->diffForHumans()}}</td>
										@endif
									<td>{{$article->views}}</td>
									<td>
										<div class="btn-group">
											<a href="{{route('ArticlesView', $article->id)}}" class="btn btn-default btn-xs">View</a>
											<a href="{{route('ArticlesEdit', $article->id)}}" class="btn btn-primary  btn-xs">Edit</a>
											<a href="{{route('ArticlesDestroy', $article->id)}}" class="btn btn-danger btn-xs" id="delete-btn">Delete</a>
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
			@include('pagination.custom', ['paginator' => $articles])
		</div>
	</section>
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
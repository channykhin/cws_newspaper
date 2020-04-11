@extends('backend.app')
@section('content')
	<section id="block-header">
		<div class="row">
			<div class="col-md-12">
				<h4>
					<span class="glyphicon glyphicon-tags"></span> Tags
					<span class="pull-right">
						<a href="{{route('TagsCreate')}}" class="btn btn-primary">Add New Tags</a>
					</span>
				</h4>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<ol class="breadcrumb">
					<li><a href="{{route('UserDashboard')}}">Dashboard</a></li>
					<li>Tags</li>
				</ol>
			</div>
		</div>
	</section>	
	<div class="row">
		<div class="col-md-12">	@include('blocks.flash_message_success')</div>
	</div>
	<section id="block-body">
		<div class="header">
			<div class="row">
				<div class="col-md-6">
					<ul class="list-inline">
						<li>All ({{$tags_a->count()}})</li>
						<li>Publish ({{$tags_p->count()}})</li>
					</ul>
				</div>
				<div class="col-md-6">
					<div class="form pull-right">
						<form class="form-inline" role="form">
							<div class="form-group">
								<input type="text"  name="search" class="form-control input-sm" placeholder="Enter text..." value=""><span>
									<button type="sybmit" class="btn btn-default btn-sm">Search</button>
								</span>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
		<div class="content">
			<div class="table-responsive">
				<table class="table table-striped table-hover">
					<thead>
						<tr>
							<td>ID</td>
							<td>Name</td>
							<td>Slug</td>
							<td>Created At</td>
							<td>Status</td>
							<td>Articles</td>
							<td>Actions</td>
						</tr>
					</thead>
					<tbody>
						@if($tags->count() > 0)
							@foreach($tags as $tag)
								<tr>
									<td>{{$tag->id}}</td>
									<td>{{$tag->name}}</td>
									<td>{{$tag->slug}}</td>
									<td>{{$tag->created_at->diffForHumans()}}</td>
									<td>
										@if($tag->status > 0)
											<a href="{{route('TagsUnpublish', $tag->id)}}">Unpublish</a>
										@else 
											<a href="{{route('TagsPublish', $tag->id)}}">Publish</a>
										@endif
									</td>
									<td>{{$tag->articles->count()}}</td>
									<td>
										<div class="btn-group">
											<a href="{{route('TagsView', $tag->id)}}" class="btn btn-default btn-xs">View</a>
											<a href="{{route('TagsEdit', $tag->id)}}" class="btn btn-primary  btn-xs">Edit</a>
                                            <a href="{{ route('TagsDestroy' ,$tag->id) }}" class="btn btn-danger btn-xs" id="delete-btn">Delete</a>
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
			@include('pagination.custom', ['paginator' => $tags])
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
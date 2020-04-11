@extends('backend.app')
@section('content')
	<section id="block-header">
		<div class="row">
			<div class="col-md-12">
				<h4>
					Categories
					<span class="pull-right">
						<a href="{{route('CategoriesCreate')}}" class="btn btn-primary">New Categories</a>
						<a href="{{route('SubCategoriesCreate')}}" class="btn btn-primary">New Sub Categories</a>
					</span>
				</h4>
			</div>
		</div>
	</section>	
	<div class="row">
		<div class="col-md-12">	@include('blocks.flash_message_success')</div>
	</div>
	<section id="block-body">
		<div class="row">
			<div class="col-md-12">
				<div class="header">
					<div class="row">
						<div class="col-md-6">
							<ul class="list-inline">
								<li>All ({{$categories_a->count()}})</li>
								<li>Publish ({{$categories_p->count()}})</li>
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
									<td>Order</td>
									<td>Name</td>
									<td>Status</td>
									<td><a href="{{route('SubCategoriesIndex')}}">Sub Categories <i class="fa fa-share"></i></a></td>
									<td>Created_At</td>
									<td>Articles</td>
									<td>Actions</td>
								</tr>
							</thead>
							<tbody>
								@if($categories->count() > 0)
									@foreach($categories as $category)
										<tr>
											<td>{{$category->order}}</td>
											<td>{{$category->name}}</td>
											<td>
												@if($category->status > 0)
													<a href="{{route('CategoriesUnpublish', $category->id)}}">Unpublish</a>
												@else 
													<a href="{{route('CategoriesPublish', $category->id)}}">Publish</a>
												@endif
											</td>
											<td>
												@if($category->subcategories)
													@foreach($category->subcategories as $sub)
														<label class="label label-default">{{ $sub->name }}</label>
													@endforeach
												@endif
											</td>
											<td>{{$category->created_at->diffForHumans()}}</td>
											<td>{{$category->articles->count()}}</td>
											<td>
												<div class="btn-group">
													<a href="{{route('CategoriesView', $category->id)}}" class="btn btn-default btn-xs">View</a>
													<a href="{{route('CategoriesEdit', $category->id)}}" class="btn btn-primary  btn-xs">Edit</a>
													@if(Auth::user()->role_id == 1)
														<a href="{{route('CategoriesDestroy', $category->id)}}" class="btn btn-danger btn-xs" id="delete-btn">Delete</a>
													@endif
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
					@include('pagination.custom', ['paginator' => $categories])
				</div>
			</div>
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
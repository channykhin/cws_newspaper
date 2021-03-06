@extends('backend.app')
@section('content')
	<section id="block-header">
		<div class="row">
			<div class="col-md-12">
				<h4>
					<span class="glyphicon glyphicon-folder-open"></span>Show Sub Categories
					<span class="pull-right">
						<a href="{{route('SubCategoriesIndex')}}" class="btn btn-danger">Back</a>
						<a href="{{route('SubCategoriesCreate')}}" class="btn btn-primary">Add New Sub Categories</a>
					</span>
				</h4>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<ol class="breadcrumb">
					<li><a href="{{route('UserDashboard')}}">Dashboard</a></li>
					<li><a href="{{route('SubCategoriesIndex')}}">Sub Categories</a></li>
					<li>Show Sub Categories</li>
				</ol>
			</div>
		</div>
	</section>	
	<section id="block-body">
		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-default">
					<div class="panel-heading">
						Sub Categories details <span class="pull-right" style="margin-top: -3px;">
							<a href="{{route('SubCategoriesEdit', $subcategories->id)}}" class="btn btn-primary btn-xs">Edit</a>
							@if(Auth::user()->role_id == 1)
								<a href="{{route('SubCategoriesDestroy', $subcategories->id)}}" class="btn btn-danger btn-xs" id="delete-btn">Delete</a>
							@endif
						</span>
					</div>
					<div class="panel-body">
						<div class="table-responsive">
							<table class="table table-hover view">
								<tr>
									<td>Name :</td>
									<td>{{$subcategories->name}}</td>
								</tr>
								<tr>
									<td>Slug :</td>
									<td>{{$subcategories->slug2}}</td>
								</tr>
								<tr>
									<td>URL :</td>
									<td><a href="" target="_blank"></a></td>
								</tr>
								<tr>
									<td>Order :</td>
									<td>{{$subcategories->order}}</td>
								</tr>
								<tr>
									<td>Status :</td>
									<td>
										@if($subcategories->status > 0)
											Publish
										@else 
											Unpublish
										@endif
									</td>
								</tr>
								<tr>
									<td>Created At :</td>
									<td>
										@if($subcategories->created_at)
											{{$subcategories->created_at->toDayDateTimeString()}}
										@endif
									</td>
								</tr>
								<tr>
									<td>Last Update:</td>
									<td>
										@if($subcategories->updated_at)
											{{$subcategories->updated_at->toDayDateTimeString()}}
										@endif
									</td>
								</tr>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-default">
					<div class="panel-heading">
						Articles ({{$subcategories->articles->count()}})
					</div>
					<div class="panel-body">
						<div class="table-responsive">
							<table class="table table-hover view">
								@foreach($articles as $article)
								<tr>
									<td>{{$article->id}}</td>
									<td>{{str_limit($article->title,20,"...")}}</td>
									<td>
										<div class="btn-group">
											<a href="{{route('ArticlesView', $article->id)}}" class="btn btn-default btn-xs">View</a>
											<a href="{{route('ArticlesEdit', $article->id)}}" class="btn btn-primary btn-xs">Edit</a>
											<a href="{{route('ArticlesDestroy', $article->id)}}" class="btn btn-danger btn-xs" id="delete-btn">Delete</a>
										</div>
									</td>
								</tr>
								@endforeach
							</table>
							<div class="text-center">
								{{ $articles->links() }}
							</div>
						</div>
					</div>
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
    </script>
@endsection
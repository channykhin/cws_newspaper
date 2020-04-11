@extends('backend.app')
@section('content')
	<section id="block-header">
		<div class="row">
			<div class="col-md-12">
				<h4>
					<i class="fa fa-bookmark"></i>Advertisments
					<span class="pull-right">
						<a href="{{route('AdsCreate')}}" class="btn btn-primary">New Ads</a>
					</span>
				</h4>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<ol class="breadcrumb">
					<li><a href="{{route('UserDashboard')}}">Dashboard</a></li>
					<li>Ads</li>
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
				<div class="col-md-2">
					<ul class="list-inline">
						<li>All ({{$ads_a->count()}})</li>
						<li>Publish ({{$ads_p->count()}})</li>
					</ul>
				</div>
				<div class="col-md-10">
					<ul class="list-inline form pull-right">
						<li>
							<form class="form-inline" role="form">
								<div class="form-group">
								<select class="form-control input-sm" name="filter0">
									<option disabled selected>All Pages...</option>
									<option value="Home Page">Home Page</option>
									<option value="Categories Page">Categories Page</option>
									<option value="Sub Categories Page">Sub Categories Page</option>
									<option value="Tag Page">Tag Page</option>
									<option value="All Pages">All Pages</option>
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
									<option disabled selected>All Positions...</option>
									<option value="Next Logo">Next Logo</option>
									<option value="Bottom Menu">Bottom Menu</option>
									<option value="Bottom Menu">Bottom Menu</option>
									<option value="Pop up">Pop up</option>
									<option value="Both Sides">Both Sides</option>
									<option value="Aside Right">Aside Right</option>
									<option value="Under Categories Type">Under Categories Type</option>
									<option value="Under Article Title">Under Article Title</option>
									<option value="Footer">Footer</option>
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
							<td>Name</td>
							<td>Position</td>
							<td>Page</td>
							<td>Size</td>
							<td>Price</td>
							<td>Status</td>
							<td>Actions</td>
						</tr>
					</thead>
					<tbody>
						@if($ads->count() > 0)
							@foreach($ads as $ad)
								<tr>
									<td>{{$ad->id}}</td>
									<td>{{$ad->name}}</td>
									<td>{{$ad->position}}</td>
									<td>{{$ad->page}}</td>
									<td>{{$ad->size}}</td>
									<td>{{$ad->price}}</td>
									<td>
										@if($ad->status > 0)
											<i class="fa fa-circle" style="color: green"></i>
										@else 
											<i class="fa fa-circle" style="color: red"></i>
										@endif
									</td>
									<td>
										<div class="btn-group">
											<a href="{{route('AdsView', $ad->id)}}" class="btn btn-default btn-xs">View</a>
											<a href="{{route('AdsEdit', $ad->id)}}" class="btn btn-primary  btn-xs">Edit</a>
											<a href="{{route('AdsDestroy', $ad->id)}}" class="btn btn-danger btn-xs" id="delete-btn">Delete</a>
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
			@include('pagination.custom', ['paginator' => $ads])
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
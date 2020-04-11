@extends('backend.app')
@section('content')
	<section id="block-header">
		<div class="row">
			<div class="col-md-12">
				<h4>
					<span class="glyphicon glyphicon-book"></span> Show Articles
					<span class="pull-right">
						<a href="{{route('ArticlesCreate')}}" class="btn btn-primary">Add New Articles</a>
					</span>
				</h4>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<ol class="breadcrumb">
					<li><a href="{{route('UserDashboard')}}">Dashboard</a></li>
					<li><a href="{{route('ArticlesIndex')}}">Articles</a></li>
					<li>Show Articles</li>
				</ol>
			</div>
		</div>
	</section>	
	<section id="block-body">
		<div class="row">
			<div class="col-md-8">
				<div class="panel panel-default panel-body">
					<header style="margin-bottom: 39px;">
						<h3 style="border-bottom: 1px solid #ddd;padding-bottom: 19px;margin-bottom: 19px;">{{ $articles->title }}</h3>
						<ul class="list-inline">
							<li>
								<i class="fa fa-folder-open"></i>{{ $articles->categories->name }}
								@if($articles->subcategories)
									<span>, {{ $articles->subcategories->name }}</span>
								@endif
							</li>
							<li>
								@if($articles->created_at)
									<i class="fa fa-calendar"></i>{{$articles->created_at->toDayDateTimeString()}}
								@endif
							</li>
							<li style="text-transform: capitalize;"><i class="fa fa-user"></i>{{ $articles->users->first_name }} {{ $articles->users->last_name }}</li>
							<li><i class="fa fa-eye"></i>{{ $articles->views }}</li>
						</ul>
					</header>
					<div class="content" style="border-bottom: 1px solid #ddd;padding-bottom: 19px;margin-bottom: 19px;">
						<img src="/images/posts/{{$articles->categories->dir}}/{{$articles->img}}" width="100%">
						<div style="text-align: justify;text-indent: 10px;line-height: 27px;font-size: 15px;margin-top: 19px;">{!! $articles->body !!}</div>
					</div>
					<footer>
						<ul class="list-inline">
							<li style="text-transform: capitalize;">កែសម្រួល៖ 
							@if($articles->author)
								{{ $articles->author }}
							@else
								{{ $articles->users->first_name }} {{ $articles->users->last_name }} 
							@endif
							</li>
							@if($articles->reference)
								<li>, ប្រភព៖ <a href="{{ $articles->reference_link }}" target="_blank">{{ $articles->reference }}</a></li>
							@endif
						</ul>
						<p style="font-size: 15px;"><i class="fa fa-tags"></i> ពាក្យទាកទង៖ 
							<span>
								@foreach($articles->tags as $tag)
									<label class="label label-default">{{ $tag->name }}</label>
								@endforeach
							</span>
						</p>
					</footer>
				</div>
			</div>
			<div class="col-md-4">
				<div class="text-center panel panel-default panel-body">
					<a href="{{route('ArticlesEdit', $articles->id)}}" class="btn btn-primary btn-sm btn-block">Edit</a>
					<a href="{{route('ArticlesDestroy', $articles->id)}}" class="btn btn-danger btn-sm btn-block" id="delete-btn">Delete</a>
					<hr style="margin-top: 12px;">
					<a href="{{route('ArticlesIndex')}}" class="btn btn-default btn-sm btn-block">View All <i class="fa fa-angle-double-right"></i></a>
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
@extends('backend.app')
@section('content')
	<section id="block-header">
		<div class="row">
			<div class="col-md-12">
				<h4>
					<i class="fa fa-check"></i>User Activity
					<span class="pull-right">
						<a href="{{route('UserPermissionIndex')}}" class="btn btn-danger">Back</a>
					</span>
				</h4>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<ol class="breadcrumb">
					<li><a href="{{route('UserDashboard')}}">Dashboard</a></li>
					<li><a href="{{route('UserPermissionIndex')}}">Users</a></li>
					<li>User Activity</li>
				</ol>
			</div>
		</div>
	</section>	
	<section id="block-body">
		@if($articles->count() > 0)
			<div class="row">
				<div class="col-md-12 ">
					<div class="panel panel-default">
						<div class="panel-heading">
							<h5><i class="fa fa-book"></i>Articles ({{ $articles_a->count() }})</h5>
						</div>
						<div class="panel-body">
							<div class="table-responsive">
								<table class="table table-striped table-hover">
									<thead>
										<tr>
											<td>ID</td>
											<td>Title</td>
											<td>Categories</td>
											<td>Sub Categories</td>
											<td>Tags</td>
											<td>Status</td>
											<td>Date</td>
											<td>Views</td>
											<td></td>
										</tr>
									</thead>
									<tbody>
										@if($articles->count() > 0)
											@foreach($articles as $article)
												<tr>
													<td>{{$article->id}}</td>
													<td>{{str_limit($article->title,20,"...")}}</td>
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
															{{$article->created_at->toDayDateTimeString()}}</td>
														@endif
													<td>{{$article->views}}</td>
													<td>
														<div class="btn-group">
															<a href="{{route('ArticlesView', $article->id)}}" class="btn btn-default btn-xs">View</a>
															<a href="{{route('ArticlesEdit', $article->id)}}" class="btn btn-primary  btn-xs">Edit</a>
															<a href="{{route('ArticlesDestroy', $article->id)}}" class="btn btn-danger btn-xs" id="delete">Delete</a>
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
							<div class="footer text-center">
								{{$articles->links()}}
							</div>
						</div>
					</div>
				</div>
			</div>
		@endif
		@if($categories->count() > 0)
			<div class="row">
				<div class="col-md-12 ">
					<div class="panel panel-default">
						<div class="panel-heading">
							<h5><i class="fa fa-folder-open"></i>Categories ({{ $categories_a->count() }})</h5>
						</div>
						<div class="panel-body">
							<div class="table-responsive">
								<table class="table table-striped table-hover">
									<thead>
										<tr>
											<td>Order</td>
											<td>Name</td>
											<td>Status</td>
											<td><a href="{{route('SubCategoriesIndex')}}">Sub Categories <i class="fa fa-share"></i></a></td>
											<td>Articles</td>
											<td></td>
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
													<td>{{$category->articles->count()}}</td>
													<td>
														<div class="btn-group">
															<a href="{{route('CategoriesView', $category->id)}}" class="btn btn-default btn-xs">View</a>
															<a href="{{route('CategoriesEdit', $category->id)}}" class="btn btn-primary  btn-xs">Edit</a>
															@if(Auth::user()->role_id == 1)
																<a href="{{route('CategoriesDestroy', $category->id)}}" class="btn btn-danger btn-xs" id="delete">Delete</a>
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
							<div class="footer text-center">
								{{$categories->links()}}
							</div>
						</div>
					</div>
				</div>
			</div>
		@endif
		@if($tags->count() > 0)
			<div class="row">
				<div class="col-md-12 ">
					<div class="panel panel-default">
						<div class="panel-heading">
							<h5><i class="fa fa-tags"></i>Tags ({{ $tags_a->count() }})</h5>
						</div>
						<div class="panel-body">
							<div class="table-responsive">
								<table class="table table-striped table-hover">
									<thead>
										<tr>
											<td>ID</td>
											<td>Name</td>
											<td>Slug</td>
											<td>Status</td>
											<td>Articles</td>
											<td></td>
										</tr>
									</thead>
									<tbody>
										@if($tags->count() > 0)
											@foreach($tags as $tag)
												<tr>
													<td>{{$tag->id}}</td>
													<td>{{$tag->name}}</td>
													<td>{{$tag->slug}}</td>
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
															<a href="{{route('TagsDestroy', $tag->id)}}" class="btn btn-danger btn-xs" id="delete">Delete</a>
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
							<div class="footer text-center">
								{{$tags->links()}}
							</div>
						</div>
					</div>
				</div>
			</div>
		@endif
	</section>
@endsection
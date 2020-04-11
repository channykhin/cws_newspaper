@extends('backend.app')
@section('content')
	<section id="block-header">
		<div class="row">
			<div class="col-md-12">
				<h4>
					<span class="glyphicon glyphicon-folder-open"></span> Add New Sub Categories
					<span class="pull-right">
						<a href="{{route('SubCategoriesIndex')}}" class="btn btn-danger">Back</a>
					</span>
				</h4>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<ol class="breadcrumb">
					<li><a href="{{route('UserDashboard')}}">Dashboard</a></li>
					<li><a href="{{route('SubCategoriesIndex')}}">Sub Categories</a></li>
					<li>Add New Sub Categories</li>
				</ol>
			</div>
		</div>
	</section>	
	<section id="block-body">
		<div class="row">
			<div class="col-md-3"></div>
			<div class="col-md-6">
				<div class="form">
					<form method="POST" action="{{route('SubCategoriesStore')}}" role="form" class="form-horizontal">
		  				<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<div class="form-group">
							<label class="col-sm-2">
								Categories 	
							</label>
							<div class="col-sm-10">
								<select class="form-control" name="categories_id">
									@foreach($categories as $category)
										<option value="{{$category->id}}">{{$category->name}}</option>
									@endforeach
								</select>
							    @if($errors->has('categories_id'))
									<p class="error">{{ $errors->first('categories_id')}}</p>
								@endif
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2">
								Name	
							</label>
							<div class="col-sm-10">
								<input type="text" name="name" class="form-control" autofocus autocomplete="off">
							    @if($errors->has('name'))
									<p class="error">{{ $errors->first('name')}}</p>
								@endif
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2">
								Slug	
							</label>
							<div class="col-sm-10">
								<input type="text" name="slug2" class="form-control" autocomplete="off">
							    @if($errors->has('slug2'))
									<p class="error">{{ $errors->first('slug2')}}</p>
								@endif
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2">
								Order	
							</label>
							<div class="col-sm-10">
								<select class="form-control" name="order">
									<option disabled>Select number to order...</option>
									<option value="0">0</option>
									<option value="1">1</option>
									<option value="2">2</option>
									<option value="3">3</option>
									<option value="4">4</option>
									<option value="5">5</option>
									<option value="6">6</option>
									<option value="7">7</option>
									<option value="8">8</option>
									<option value="9">9</option>
								</select>
							    @if($errors->has('order'))
									<p class="error">{{ $errors->first('order')}}</p>
								@endif
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 label-checkbox">
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
					</form>
				</div>
			</div>
			<div class="col-md-3"></div>
		</div>
	</section>
@endsection
@extends('backend.app')
@section('content')
	<section id="block-header">
		<div class="row">
			<div class="col-md-12">
				<h4>
					<span class="glyphicon glyphicon-folder-open"></span> Update Categories
					<span class="pull-right">
						<a href="{{route('CategoriesIndex')}}" class="btn btn-danger">Back</a>
					</span>
				</h4>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<ol class="breadcrumb">
					<li><a href="{{route('UserDashboard')}}">Dashboard</a></li>
					<li><a href="{{route('CategoriesIndex')}}">Categories</a></li>
					<li>Update Categories</li>
				</ol>
			</div>
		</div>
	</section>	
	<section id="block-body">
		<div class="row">
			<div class="col-md-3"></div>
			<div class="col-md-6">
				<div class="form">
					{!! Form::model($categories, ['route' => ['CategoriesUpdate', $categories->id], 'class' => 'form-horizontal', 'files' => 'true']) !!}
						<div class="form-group">
							<label class="col-sm-2">
								Name	
							</label>
							<div class="col-sm-10">
								{!! Form::text('name',null,['class' => 'form-control', 'autocomplete' => 'off']) !!}
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
								{!! Form::text('slug',null,['class' => 'form-control', 'autocomplete' => 'off']) !!}
							    @if($errors->has('slug'))
									<p class="error">{{ $errors->first('slug')}}</p>
								@endif
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2">
								Directory	
							</label>
							<div class="col-sm-10">
								{!! Form::text('dir',null,['class' => 'form-control', 'autocomplete' => 'off']) !!}
							    @if($errors->has('dir'))
									<p class="error">{{ $errors->first('dir')}}</p>
								@endif
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2">
								Order	
							</label>
							<div class="col-sm-10">
								<select class="form-control" name="order">
									<option value="{{$categories->order}}" selected>{{$categories->order}}</option>
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
								<input type="checkbox" name="status" {{ $categories_status }} value="1">
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
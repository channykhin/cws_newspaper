@extends('backend.app')
@section('content')
	@if(Auth::user()->role_id == 1)
		<section id="block-header">
			<div class="row">
				<div class="col-md-12">
					<h4>
						<i class="fa fa-exclamation"></i> Add New Roles
						<span class="pull-right">
							<a href="{{route('RolesIndex')}}" class="btn btn-danger">Back</a>
						</span>
					</h4>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<ol class="breadcrumb">
						<li><a href="{{route('UserDashboard')}}">Dashboard</a></li>
						<li><a href="{{route('RolesIndex')}}">Roles</a></li>
						<li>Add New Roles</li>
					</ol>
				</div>
			</div>
		</section>	
		<section id="block-body">
			<div class="row">
				<div class="col-md-3"></div>
				<div class="col-md-6">
					<div class="form">
						<form method="POST" action="{{route('RolesStore')}}" role="form" class="form-horizontal">
			  				<input type="hidden" name="_token" value="{{ csrf_token() }}">
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
									Description	
								</label>
								<div class="col-sm-10">
									<textarea name="description" rows="5" class="form-control"></textarea>
								    @if($errors->has('description'))
										<p class="error">{{ $errors->first('description')}}</p>
									@endif
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 label-checkbox">
									Priority	
								</label>
								<div class="col-sm-10">
									<input type="text" name="priority" class="form-control" autocomplete="off">
								    @if($errors->has('priority'))
										<p class="error">{{ $errors->first('priority')}}</p>
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
	@else 
		<div class="alert alert-danger" role="alert">
			Access denied!
		</div>
	@endif
@endsection
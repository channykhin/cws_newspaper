@extends('backend.app')
@section('content')
	@if(Auth::user()->role_id == 1)
		<section id="block-header">
			<div class="row">
				<div class="col-md-12">
					<h4>
						<i class="fa fa-exclamation"></i> Edit Role
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
						<li>Edit Role</li>
					</ol>
				</div>
			</div>
		</section>	
		<section id="block-body">
			<div class="row">
				<div class="col-md-3"></div>
				<div class="col-md-6">
					<div class="form">
						{!! Form::model($roles, ['route'=> ['RolesUpdate', $roles->id], 'class' => 'form-horizontal', 'files' => true])  !!}
							<div class="form-group">
								<label class="col-sm-2">
									Name	
								</label>
								<div class="col-sm-10">
									{!! Form::text('name',null,['class' => 'form-control']) !!}
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
									{!! Form::textarea('description',null,['class' => 'form-control', 'rows' => '5']) !!}
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
									{!! Form::text('priority',null,['class' => 'form-control']) !!}
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
       					{!! Form::close() !!}
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
@extends('backend.app')
@section('content')
	<section id="block-header">
		<div class="row">
			<div class="col-md-12">
				<h4>
					<span class="glyphicon glyphicon-tags"></span> Update Tags
					<span class="pull-right">
						<a href="{{route('TagsIndex')}}" class="btn btn-danger">Back</a>
					</span>
				</h4>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<ol class="breadcrumb">
					<li><a href="{{route('UserDashboard')}}">Dashboard</a></li>
					<li><a href="{{route('TagsIndex')}}">Tags</a></li>
					<li>Update Tags</li>
				</ol>
			</div>
		</div>
	</section>	
	<section id="block-body">
		<div class="row">
			<div class="col-md-3"></div>
			<div class="col-md-6">
				<div class="form">
       				{!! Form::model($tags, ['route'=> ['TagsUpdate', $tags->id], 'class' => 'form-horizontal', 'files' => true])  !!}
						<div class="form-group">
							<label class="col-sm-2">
								Name	
							</label>
							<div class="col-sm-10">
								{!! Form::text('name',null,['class' => 'form-control', 'autofocus' => '']) !!}
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
								{!! Form::text('slug',null,['class' => 'form-control']) !!}
							    @if($errors->has('slug'))
									<p class="error">{{ $errors->first('slug')}}</p>
								@endif
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 label-checkbox">
								Publish	
							</label>
							<div class="col-sm-10">
                      			{!! Form::checkbox('status', '1') !!}
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
       				{!! Form::close() !!}
				</div>
			</div>
			<div class="col-md-3"></div>
		</div>
	</section>
@endsection
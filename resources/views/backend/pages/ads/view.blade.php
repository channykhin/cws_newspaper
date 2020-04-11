@extends('backend.app')
@section('content')
	<section id="block-header">
		<div class="row">
			<div class="col-md-12">
				<h4>
					<i class="fa fa-bookmark"></i>Ads Detail 
					<span class="pull-right">
						<a href="{{route('AdsIndex')}}" class="btn btn-danger">Back</a>
					</span>
				</h4>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<ol class="breadcrumb">
					<li><a href="{{route('UserDashboard')}}">Dashboard</a></li>
					<li><a href="{{route('AdsIndex')}}">Ads</a></li>
					<li>Ads Detail</li>
				</ol>
			</div>
		</div>
	</section>	
	<section id="block-body">
		<div class="row ads-view">
			<div class="col-md-6">
				<div class="ads">
					<img src="/images/ads/{{$ads->img}}">
				</div>
			</div>
			<div class="col-md-6">
				<div class="panel panel-default panel-body">
					<div class="table-responsive">
						<table class="table table-hover view">
							<tr>
								<td>ID :</td>
								<td>{{$ads->id}}</td>
							</tr>
							<tr>
							<tr>
								<td>Name :</td>
								<td>{{$ads->name}}</td>
							</tr>
							<tr>
								<td>URL :</td>
								<td><a href="{{$ads->url}}" target="_blank">{{$ads->url}}</a></td>
							</tr>
							<tr>
								<td>Position :</td>
								<td>{{$ads->position}}</td>
							</tr>
							<tr>
								<td>Page :</td>
								<td>{{$ads->page}}</td>
							</tr>
							<tr>
								<td>Size :</td>
								<td>{{$ads->size}}</td>
							</tr>
							<tr>
								<td>Price :</td>
								<td>{{$ads->price}}$</td>
							</tr>
							<tr>
								<td>Status :</td>
								<td>
									@if($ads->status > 0)
										<i class="fa fa-circle" style="color: green"></i>
									@else 
										<i class="fa fa-circle" style="color: red"></i>
									@endif
								</td>
							</tr>
							<tr>
								<td>Created At :</td>
								<td>
									@if($ads->created_at)
										{{$ads->created_at->toDayDateTimeString()}}
									@endif
								</td>
							</tr>
							<tr>
								<td>Last Update:</td>
								<td>
									@if($ads->updated_at)
										{{$ads->updated_at->toDayDateTimeString()}}
									@endif
								</td>
							</tr>
						</table>
					</div>
				</div>
			</div>
		</div>
	</section>
@endsection
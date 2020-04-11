@extends('backend.app')
@section('content')
	@if(Auth::user()->role_id == 1)
		System setting
	@else 
		<div class="alert alert-danger" role="alert">
			Access denied!
		</div>
	@endif
@endsection
@if(Session::has('Danger'))
	<div class="alert alert-danger" role="alert">
	  {{Session::get('Danger')}}
	</div>
@endif
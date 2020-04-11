@extends('backend.app')
@section('content')
 	@include('blocks.flash_message_success')
 	<h2>Dashboard</h2>
@endsection
@section('javascript')
  @parent
    <script type="text/javascript">
	    window.setTimeout(function () {
		    $(".alert-success").fadeTo(500, 0).slideUp(500, function () {
		        $(this).remove();
		    });
		}, 5000);
    </script>
@endsection
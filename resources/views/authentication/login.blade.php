@extends('authentication.app')
@section('content')
<div class="form">
	@include('blocks.flash_message_success')
	@include('blocks.flash_message_danger')
	@include('blocks.flash_message_warning')
	<div id="login">   
	  	<h1><i class="fa fa-user"></i> login</h1>
		<form role="form" method="post" action="{{ route('postUserLogin')}}">
		  	<input type="hidden" name="_token" value="{{ csrf_token() }}">
		    <div class="field-wrap">
			    <input type="text" autocomplete="off" name="a" autofocus placeholder="Username / Email" />
			     @if($errors->has('a'))
						<p class="error">{{ $errors->first('a')}}</p>
				 @endif
		  	</div>
		  	<div class="field-wrap">
			    <input type="password" placeholder="Password" autocomplete="off" name="b" autofocus />
			     @if($errors->has('b'))
						<p class="error">{{ $errors->first('b')}}</p>
				 @endif
		  	</div>
		  	<div>
				<p class="forgot">
					<a href="{{route('getUserRegister')}}" class="pull-left">Don't have an account?</a>
					<span>
						<a href="{{route('getUserResetPassword')}}" class="pull-right">Forgot Password ?</a>
					</span>
				</p>
		  	</div>
		  	<button class="btn btn-primary btn-block">Login</button>
		</form>
	</div>
</div> <!-- /form -->
<div class="footer">
	<a href="{{route('HomePage')}}"><i class="fa fa-arrow-left"></i> Back to site</a>
</div>
@endsection
@section('javascript')
  @parent
    <script type="text/javascript">
	    window.setTimeout(function () {
		    $(".alert-danger").fadeTo(500, 0).slideUp(500, function () {
		        $(this).remove();
		    });
		}, 5000);
	    window.setTimeout(function () {
		    $(".alert-warning").fadeTo(500, 0).slideUp(500, function () {
		        $(this).remove();
		    });
		}, 5000);
    </script>
@endsection
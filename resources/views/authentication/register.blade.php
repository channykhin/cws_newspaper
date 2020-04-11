@extends('authentication.app')
@section('content')
<div class="form">
	<div id="login">   
	  	<h1><i class="fa fa-user"></i> Registration</h1>
		<form role="form" method="post" action="{{ route('postUserRegister')}}">
		  	<input type="hidden" name="_token" value="{{ csrf_token() }}">
			<div class="top-row">
			    <div class="field-wrap">
			      <input type="text" placeholder="First Name" autocomplete="off" name="first_name" autofocus/>
			     @if($errors->has('first_name'))
						<p class="error">{{ $errors->first('first_name')}}</p>
				 @endif
			    </div>
			    <div class="field-wrap">
			      <input type="text" placeholder="Last Name" autocomplete="off" name="last_name" />
			     @if($errors->has('last_name'))
						<p class="error">{{ $errors->first('last_name')}}</p>
				 @endif
			    </div>
			</div>
			<div class="field-wrap">
			  <input type="text" autocomplete="off" name="username" placeholder="Username" />
		     @if($errors->has('username'))
					<p class="error">{{ $errors->first('username')}}</p>
			 @endif
			</div><div class="field-wrap">
				<input type="text" autocomplete="off" name="email" placeholder="Email" />
				 @if($errors->has('email'))
						<p class="error">{{ $errors->first('email')}}</p>
				 @endif
			</div>
		  	<div class="field-wrap">
			    <input type="password" placeholder="Password" autocomplete="off" name="password"/>
			     @if($errors->has('password'))
						<p class="error">{{ $errors->first('password')}}</p>
				 @endif
		  	</div>
		  	<div class="field-wrap">
			    <input type="password" autocomplete="off" name="confirm_password" placeholder="Confirm_Password" />
			    @if($errors->has('confirm_password'))
						<p class="error">{{ $errors->first('confirm_password')}}</p>
				@endif
			</div>
		  	<div>
				<p class="forgot">
					<a href="{{route('getUserLogin')}}" class="pull-left">Already have an account?</a>
				</p>
		  	</div>
		  	<button class="btn btn-primary btn-block">Register</button>
		</form>
	</div>
</div> <!-- /form -->
<div class="footer">
	<a href="{{route('HomePage')}}"><i class="fa fa-arrow-left"></i> Back to site</a>
</div>
@stop
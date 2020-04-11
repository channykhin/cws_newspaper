@extends('backend.app')
@section('content')
	<section id="block-header">
		<div class="row">
			<div class="col-md-12">
				<h4>
					<i class="fa fa-image"></i> Logo & Favicon
				</h4>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<ol class="breadcrumb">
					<li><a href="{{route('UserDashboard')}}">Dashboard</a></li>
					<li>Logo & Favicon	</li>
				</ol>
			</div>
		</div>
	</section>	
	<div class="row">
		<div class="col-md-12">	@include('blocks.flash_message_success')</div>
	</div>
	<section id="block-body">
		<div class="content logo-favicon">
			<div class="row">
				<div class="col-md-6">
					<header>
						<h4>Logo</h4>
					</header>
					<div class="logo">
						@foreach($logos as $logo)
							<img src="/images/logo/{{$logo->img}}">
						@endforeach
					</div>
					<footer>
						<a href="{{ route('LogoCreate') }}" class="btn btn-default">Change</a>
					</footer>
				</div>
				<div class="col-md-6">
					<header>
						<h4>Favicon</h4>
					</header>
					<div class="favicon">
						@foreach($favicons as $favicon)
							<img src="/images/icon/{{$favicon->img}}">
						@endforeach
					</div>
					<footer>
						<a href="{{ route('FaviconCreate') }}" class="btn btn-default">Change</a>
					</footer>
				</div>
			</div>
		</div>
	</section>
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
<!DOCTYPE html>
<html lang="{{ App::getLocale() }}">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
@foreach($favicons as $favicon)
	<link rel="shortcut icon" href="/images/icon/{{$favicon->img}}" type="image/x-icon">
@endforeach
<title>{{ (isset($title)? $title. '' : 'TumPor Khmer') }}</title>
<!-- CSS -->
{!! Html::style('/css/bootstrap.min.css') !!}
{!! Html::style('/css/authentication.css') !!}
{!! Html::style('/css/font-awesome.min.css') !!}
@yield('css')
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
<script type="text/javascript" src="/js/html5shiv.min.js"></script>
<script type="text/javascript" src="/js/respond.min.js"></script>
<![endif]-->
</head>
<body>
	<div class="container">
		@yield('content')
	</div>
<!-- JS -->
 {!! Html::script('/js/jquery.min.js') !!}
 {!! Html::script('/js/bootstrap.min.js') !!}
 {!! Html::script('/js/respond.min.js') !!}
 {!! Html::script('/js/moment.js') !!}
 @yield('javascript')
</body>
</html>
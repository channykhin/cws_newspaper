<!DOCTYPE html>
<html lang="{{ App::getLocale() }}">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
@foreach($favicons as $favicon)
	<link rel="shortcut icon" href="/images/icon/{{$favicon->img}}" type="image/x-icon">
@endforeach
<title>{{ (isset($title)? $title. ' - User Dashboard' : 'Official Blog') }}</title>
<!-- GOOGLE FONT -->
<link href="https://fonts.googleapis.com/css2?family=Battambang&display=swap" rel="stylesheet"> 
<!-- CSS -->
{!! Html::style('/css/bootstrap.min.css') !!}
{!! Html::style('/css/admin.css') !!}
{!! Html::style('/css/sidebar.css') !!}
{!! Html::style('/css/select2.min.css') !!}
{!! Html::style('/css/font-awesome.min.css') !!}
{!! HTML::style('/css/fileinput.min.css') !!}
{!! HTML::style('/css/sweetalert.css') !!}
@yield('css')
<!--[if lt IE 9]>
<script type="text/javascript" src="/js/html5shiv.min.js"></script>
<script type="text/javascript" src="/js/respond.min.js"></script>
<![endif]-->
</head>
<body>
	<!-- START HEADER SECTION -->
	<header>
		@include('backend.layouts.header')
	</header><!-- END HEADER SECTION -->
    <!-- START PAGE WRAPPER -->
    <div class="page-wrapper chiller-theme toggled">
        <a id="show-sidebar" class="btn btn-sm btn-dark" href="#">
        <i class="fa fa-bars"></i>
        </a>
        <!-- STAT MAIN SIDEBAR  -->
        @include('backend.layouts.sidebar')<!-- END MAIN SIDEBAR  -->
        <!-- START MAIN CONTENT  -->
        <div class="page-content">
            <div class="container-fluid">
                @yield('content')
            </div>
        </div>
        <!-- END MAIN CONTENT  -->
    </div><!-- END PAGE WRAPPER -->
<!-- JS -->
 {!! Html::script('/ckeditor/ckeditor.js') !!}
 {!! Html::script('/js/jquery.min.js') !!}
 {!! Html::script('/js/bootstrap.min.js') !!}
 {!! Html::script('/js/sidebar.js') !!}
 {!! Html::script('/js/respond.min.js') !!}
 {!! Html::script('/js/moment.js') !!}
 {!! Html::script('/js/select2.min.js') !!}
 {!! HTML::script('/js/fileinput.min.js') !!}
 {!! HTML::script('/js/sweetalert.min.js') !!}
 <script type="text/javascript">
 	$('.select2-multi').select2();
    CKEDITOR.replace( 'my-editor', {
      filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
      filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token={{csrf_token()}}',
      filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
      filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token={{csrf_token()}}'
    });
 </script>
 @yield('javascript')
</body>
</html>
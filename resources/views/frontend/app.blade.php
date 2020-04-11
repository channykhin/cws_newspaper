<!DOCTYPE html>
<html lang="{{ App::getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="TumPor Khmer is the most visited and popular Khmer website in Cambodia!" />
    <meta name="keywords" content="breaking News, Entertainment, Technology, Life, Sport." /> 
    @foreach($favicons as $favicon)
        <link rel="shortcut icon" href="/images/icon/{{$favicon->img}}" type="image/x-icon"> 
    @endforeach
    <title>{{ (isset($title)? $title. ' | TumPor Khmer' : 'Official Blog') }}</title>
    <!-- CSS -->
    {!! Html::style('/css/bootstrap.min.css') !!} 
    {!! Html::style('/css/carouseller.css') !!} 
    {!! Html::style('/css/featured.css') !!} 
    {!! Html::style('/css/font-awesome.min.css') !!} 
    {!! Html::style('/css/style.css') !!} 
    {!! Html::style('/css/layout.css') !!} 
    {!! Html::style('/css/responsive.css') !!} 
    @yield('css')
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    {!! Html::script('/js/respond.min.js') !!}
    {!! Html::script('/js/html5shiv.min.js') !!}
	<![endif]-->
</head>
<body>
    <!-- START HEADER -->
    <header>
        @include('frontend.layouts.header') 
    </header>
    <!-- END HEADER -->
    <!-- START BODY WRAPPER -->
    <section id="body-wrapper">
        <div class="container">
            @if (Request::is('/'))
                @include('frontend.blocks.featured-post')
            @endif
            <div class="row">
                <!-- START MAIN BODY -->
                <div class="col-md-8">
                    <section id="main-body">
                        @yield('content')
                    </section>
                </div>
                <!-- END MAIN CONTENT -->
                <!-- START MAIN SIDEBAR -->
                <div class="col-md-4">
                    <section id="main-sidebar">
                        @section('sidebar')                                        
                            @include('frontend.layouts.aside-right') 
                        @show
                    </section>
                </div>
                <!-- END MAIN CONTENT -->
            </div>
        </div>
    </section>
    <!-- END MAIN BODY -->
    <!-- START FOOTER -->
    <footer>
        <div class="container">
            @include('frontend.layouts.footer')
        </div>
    </footer>
    <!-- END FOOTER -->
    <!-- JS -->
    {!! Html::script('/js/jquery.min.js') !!}
    {!! Html::script('/js/jquery-1.11.1.min.js') !!}
    {!! Html::script('/js/bootstrap.min.js') !!} 
    {!! Html::script('/js/moment.js') !!} 
    {!! Html::script('/js/jquery.slidizle.js') !!}
    <script type="text/javascript">
        $(document).ready(function(){
            $(".dropdown").hover(            
                function() {
                    $('.dropdown-menu', this).not('.in .dropdown-menu').stop(true,true).slideDown("400");
                    $(this).toggleClass('open');        
                },
                function() {
                    $('.dropdown-menu', this).not('.in .dropdown-menu').stop(true,true).slideUp("400");
                    $(this).toggleClass('open');       
                }
            );
        });
        $('#myCarousel').carousel({
            interval: 4000
        }); $(function () {
    $('body, .navbar-collapse form[role="search"] button[type="reset"]').on('click keyup', function(event) {
      console.log(event.currentTarget);
      if (event.which == 27 && $('.navbar-collapse form[role="search"]').hasClass('active') ||
        $(event.currentTarget).attr('type') == 'reset') {
        closeSearch();
      }
    });
    function closeSearch() {
            var $form = $('.navbar-collapse form[role="search"].active')
        $form.find('input').val('');
      $form.removeClass('active');
    }
    $(document).on('click', '.navbar-collapse form[role="search"]:not(.active) button[type="submit"]', function(event) {
      event.preventDefault();
      var $form = $(this).closest('form'),
        $input = $form.find('input');
      $form.addClass('active');
      $input.focus();

    });
    });
    </script>
    @yield('javascript')
</body>
</html>

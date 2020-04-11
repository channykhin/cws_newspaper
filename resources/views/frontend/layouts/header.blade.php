<section id="header-top">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="logo">
                    @foreach($logos as $logo)
                        <a href="{{route('HomePage')}}">
                            <img src="/images/logo/{{$logo->img}}">
                        </a>
                    @endforeach
                </div>
            </div>
            <div class="col-md-8">  
                <div class="ads-next-top-logo">
                    @foreach($ads_a1 as $a1)
                        <img src="/images/ads/{{$a1->img}}">
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
<section id="header-bottom">
    <div>
        @include('frontend.blocks.nav')
    </div>
</section>
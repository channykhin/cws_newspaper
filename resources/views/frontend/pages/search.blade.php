@extends('frontend.app')
@section('content')
    <div class="block-by-keyword">
        <header>
            <h2 class="header-text"><span>លទ្ធផលស្វែងរក</span></h2>
        </header>
        @if($articles->count() > 0)
            <div class="alert alert-info search-result"> សរុប : {{$articles->count()}} : ចំនួនលទ្ធផលស្វែងរកនៃពាក្យ : {{$keyword}}</div>
        @else 
            <div class="alert alert-danger search-result"> មិនមានលទ្ធផលស្វែងរកនៃពាក្យ : {{$keyword}}</div>
        @endif
        <div class="content">
            @foreach ($articles->chunk(3) as $chunk)
                <div class="row">
                    @foreach ($chunk as $article)
                        <div class="col-sm-4">
                            <article>
                                <a href="" class="thumb">
                                    <img src="/images/posts/{{$article->categories->dir}}/{{$article->img}}"
                                </a>
                                <h6 class="title">
                                    <a href="">
                                        {{ $article->title }}
                                    </a>
                                </h6>
                                <p><i class="fa fa-clock-o"></i>{{str_replace($en,$kh,$article->created_at->diffForHumans())}}<span><i class="fa fa-eye"></i>{{$article->views}}</span></p>
                            </article>
                        </div>
                    @endforeach
                </div>
            @endforeach
        </div>
    </div>
@endsection
@extends('frontend.app')
@section('content')
    <div class="article-by-cate block-categories">
        <header>
        	<h2 class="header-text"><span>{{$cate->name}}</span></h2>
        </header>
        <div class="content">
            @foreach ($articles->chunk(3) as $chunk)
                <div class="row">
                    @foreach ($chunk as $article)
                        <div class="col-sm-4">
                            <article> 
                                <a href="{{route('ArticleDetail', $article->id)}}" class="thumb">
                                    <img src="/images/posts/{{$article->categories->dir}}/{{$article->img}}"
                                </a>
                                <h6 class="title">
                                    <a href="{{route('ArticleDetail', $article->id)}}">
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
	<div class="page">
		@include('pagination.custom', ['paginator' => $articles])
	</div>
@endsection
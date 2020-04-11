<div id="myCarousel" class="carousel slide">
	<div class="carousel-inner">
		@foreach($featured_post1 as $post)
			<article class="item active">
				<a href="{{route('ArticleDetail', $post->id)}}"><img src="images/posts/{{$post->categories->dir}}/{{$post->img_slider}}"></a>
				<div class="carousel-caption">
					<a href="{{route('ArticleDetail', $post->id)}}"><h3>{{$post->title}}</h3></a>
					<p><a href="{{route('getArticleByCate', $post->categories->slug)}}" class="btn btn-danger btn-sm">{{$post->categories->name}}</a><span><i class="fa fa-clock-o"></i>{{str_replace($en,$kh,$article->created_at->diffForHumans())}}</span></p>
				</div>
			</article>
		@endforeach
		@foreach($featured_post2 as $post)
			<article class="item">
				<a href="{{route('ArticleDetail', $post->id)}}"><img src="images/posts/{{$post->categories->dir}}/{{$post->img_slider}}"></a>
				<div class="carousel-caption">
					<a href="{{route('ArticleDetail', $post->id)}}"><h3>{{$post->title}}</h3></a>
					<p><a class="btn btn-danger btn-sm">{{$post->categories->name}}</a><span><i class="fa fa-clock-o"></i>{{str_replace($en,$kh,$article->created_at->diffForHumans())}}</span></p>
				</div>
			</article>
		@endforeach
	</div>
</div>


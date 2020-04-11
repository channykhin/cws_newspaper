@extends('frontend.app')
@section('sidebar')
	@parent
		@include('frontend.blocks.recent-post')
@endsection	
@section('content')
    <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5571ad6a7bb1677f"></script>
	<div class="article-detail">
		<header>
			<h2>{{ $articles->title }}</h2>
			<hr>
			<ul class="list-inline author">
			    <li><a href="{{route('getArticleByCate', $articles->categories->slug)}}">{{ $articles->categories->name }}</a> 
			    @if($articles->subcategories)
			    	<span><i class="fa fa-angle-right"></i><a href="{{route('getArticleBySubCate', [$articles->categories->slug,$articles->subcategories->name])}}">{{ $articles->subcategories->name }}</a></span>
			    @endif	
				</li>
			    <li><i class="fa fa-clock-o"></i>{{str_replace($en, $kh, $articles->created_at->diffForHumans())}}</li>
			    <li><i class="fa fa-eye"></i>{{ $articles->views }}</li>
			    <li class="social-share pull-right">
                	<div class="addthis_inline_share_toolbox_x6yk" style="margin-top: -10px;"></div>
			    </li>
			</ul>
			<hr>
		</header>
		<div class="content">
			<p>{!! $articles->body !!}</p>
		</div>
		<footer>
			<ul class="list-inline">
			    @if ($articles->author)
			    	<li>កែសម្រួលដោយ៖ {{ $articles->author }}</li>
			    @endif
			    @if ($articles->reference)
			    	<li>ប្រភព៖ <a href="{{ $articles->reference_link }}" target="_blank">{{ $articles->reference }}</a>,</li>
			    @endif
			    <li class="pull-right"><div class="addthis_inline_share_toolbox_x6yk" style="margin-top: -10px;"></div></li>
			</ul>
			@if ($articles->tags->count() > 0)
				<div class="tag">
					<h4><i class="fa fa-tags"></i>ពាក្យទាក់ទង៖ 
						<span>
							@foreach ($articles->tags as $tag)
								<span href="" class="label label-default label-sm">{{ $tag->name }}</span>
							@endforeach
						</span>
					</h4>
				</div>
			@endif
		</footer>
	</div>
	<div class="related-post">
		
	</div>
@endsection
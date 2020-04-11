<div class="aside recent-post">
  <div class="content">
      <header>
         <h3 class="header-text"><span>អត្ថបទថ្មីៗ</span></h3>
      </header>
      <div class="article">
        <ul class="list-unstyled">
          @foreach ($recent_post as $article)
              <li>
                  <a href="{{route('ArticleDetail', $article->id)}}"><img src="/images/posts/{{ $article->categories->dir }}/{{ $article->img }}" alt=""></a>
                  <div class="title">
                      <a href="{{route('ArticleDetail', $article->id)}}">{{str_limit($article->title,40,"...")}}</a>
                      <p><i class="fa fa-clock-o"></i>{{str_replace($en, $kh, $article->created_at->diffForHumans())}}<span><i class="fa fa-eye"></i>{{$article->views}}</span></p>
                    </div>
              </li>
          @endforeach
        </ul>
      </div>
  </div>
</div>
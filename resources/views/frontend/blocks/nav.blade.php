<nav class="navbar navbar-inverse">
    <div class="container">
        <div class="navbar-header">
            <button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".js-navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>
        <div class="collapse navbar-collapse js-navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="{{ Route::currentRouteName() == 'HomePage' ? 'active' : '' }}"><a href="{{ route('HomePage') }}"><i class="fa fa-home fa-lg"></i></a></li>
                @foreach($menus as $menu)
                    @if($menu->subcategories->count() > 0)
                    <li class="dropdown ">
                        <a href="{{route('getArticleByCate', $menu->slug)}}" >{{ $menu->name }}<i class="fa fa-angle-down"></i>
                        </a>
                        <ul class="dropdown-menu">
                            @foreach($menu->subcategories as $submenu)
                            <li><a href="{{route('getArticleBySubCate',[$menu->slug,$submenu->name])}}">{{ $submenu->name }}</a></li>
                            @endforeach
                        </ul>
                    </li>
                    @else
                    <li><a href="{{route('getArticleByCate', $menu->slug)}}">{{ $menu->name }}</a></li>
                    @endif
                @endforeach   
            </ul>
            <form action="{{route('SearchKeyword')}}" class="navbar-form" role="search">
              <div class="input-group">
                <input type="text" class="form-control" name="keyword" placeholder="ស្វែងរក" autocomplete="off">
                <span class="input-group-btn">
                  <button type="submit" class="btn btn-default pull-right" style="background: #480f15; color: #fff">
                    <span class="fa fa-search fa-lg">
                      <span class="sr-only">Search</span>
                    </span>
                  </button>
                  <button type="reset" class="btn btn-default pull-right">
                    <span class="fa fa-close fa-lg">
                      <span class="sr-only">Close</span>
                    </span>
                  </button>
                </span>
              </div>
            </form>
        </div><!-- /.nav-collapse -->
    </div>
</nav>
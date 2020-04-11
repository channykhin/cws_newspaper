<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
	<div class="container">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse">
				<span class="sr-only">Toggle Navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a href="{{route('HomePage')}}" target="_blank" class="navbar-brand">TumPor <span>Khmer</span></a>
		</div>
		<div class="collapse navbar-collapse" id="navbar-collapse">
			<ul class="nav navbar-nav">
				<li class="{{Request::is($menu == 'home') ? " active " : " " }}">
					<a href="{{route('UserDashboard')}}"><i class="fa fa-dashboard"></i>Dashboard</a>
				</li>
				<li class="dropdown  {{Request::is($dropdown == 'menu') ? " active " : " " }}">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						<i class="fa fa-plus"></i>Content
				        <b class="caret"></b>
					</a>
					<ul class="dropdown-menu">
						<li class="{{Request::is($menu == 'article') ? " active " : " " }}">
							<a href="{{route('ArticlesIndex')}}"><i class="fa fa-book"></i>Articles</a>
						</li>
						<li class="{{Request::is($menu == 'categories') ? " active " : " " }}">
							<a href="{{route('CategoriesIndex')}}"><i class="fa fa-folder-open"></i>Categories</a>
						</li>
						<li class="{{Request::is($menu == 'tag') ? " active " : " " }}">
							<a href="{{route('TagsIndex')}}"><i class="fa fa-tags"></i>Tags</a>
						</li>
					</ul>
				</li>
				<li class="dropdown  {{Request::is($dropdown1 == 'menu') ? " active " : " " }}">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						<i class="fa fa-plus"></i>Images
				        <b class="caret"></b>
					</a>
					<ul class="dropdown-menu">
						<li class="{{Request::is($menu == 'ads') ? " active " : " " }}">
							<a href="{{route('AdsIndex')}}"><i class="fa fa-bookmark"></i>Advertisments</a>
						</li>
						<li class="{{Request::is($menu == 'logo') ? " active " : " " }}">
							<a href="{{route('LogoIconIndex')}}"><i class="fa fa-image"></i>Logo & Favicon</a>
						</li>	
					</ul>
				</li>
				<li class="{{Request::is($menu == 'report') ? " active " : " " }}">
					<a href="{{route('ReportsIndex')}}"><i class="fa fa-exclamation-circle"></i>Reports</a>
				</li>
				<li class="{{Request::is($menu == 'user') ? " active " : " " }}">
					<a href="{{route('UserPermissionIndex')}}"><i class="fa fa-users"></i>Users & Permissions</a>
				</li>
			</ul>
			<div class="navbar-right">
				<ul class="nav navbar-nav">
					<li class="dropdown {{Request::is($dropdown2 == 'menu') ? " active " : " " }}">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
							@if(Auth::check())
								@if(Auth::user()->profile)
									<img src="/images/profiles/{{Auth::user()->profile}}" class="profile-bg"	/>
								@else
									<img src="/images/profiles/profile-bg.jpeg" class="profile-bg"/>
								@endif
						            <span class=" user-nav">
						            {{Auth::user()->display_name}}
						            </span>
					        @endif 
					        <b class="caret"></b>
						</a>
						<ul class="dropdown-menu">
							<li class="{{Request::is($menu == 'account') ? " active " : " " }}"><a href="{{route('AccountSetting')}}"><i class="fa fa-cog"></i>Account setting</a></li>
							<li class="{{Request::is($menu == 'system') ? " active " : " " }}"><a href="{{route('System')}}"><i class="fa fa-cogs"></i>System setting</a></li>
							<li class="divider"></li>
							<li><a href="{{route('getUserLogout')}}"><i class="fa fa-sign-out"></i>Log out</a></li>
						</ul>
					</li>
				</ul>
			</div>
		</div>
	</div>
</nav>
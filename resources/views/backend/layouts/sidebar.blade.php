<nav id="sidebar" class="sidebar-wrapper">
  <div class="sidebar-content">
    <div class="sidebar-brand">
      <a href="#">CWS News</a>
      <div id="close-sidebar">
        <i class="fa fa-times"></i>
      </div>
    </div>
    <!-- sidebar-menu  -->
    <div class="sidebar-menu">
      <ul>
        <li>
          <a href="{{route('UserDashboard')}}">
            <i class="fa fa-tachometer"></i>
            <span>Dashboard</span>
          </a>
        </li>
        <li class="{{Request::is($menu == 'article') ? " active " : " " }}">
          <a href="{{route('ArticlesIndex')}}"><i class="fa fa-edit"></i> <span>Posts</span></a>
        </li>
        <li class="{{Request::is($menu == 'categories') ? " active " : " " }}">
          <a href="{{route('CategoriesIndex')}}"><i class="fa fa-folder-open"></i> <span>Categories</span></a>
        </li>
        <li class="{{Request::is($menu == 'tag') ? " active " : " " }}">
          <a href="{{route('TagsIndex')}}"><i class="fa fa-tags"></i> <span>Tags</span></a>
        </li>
        <li class="{{Request::is($menu == 'tag') ? " active " : " " }}">
          <a href="{{route('UserPermissionIndex')}}"><i class="fa fa-users"></i> <span>User & Roles</span></a>
        </li>
        <li>
          <a href="#">
            <i class="fa fa-paint-brush"></i>
            <span>Appearance</span>
          </a>
        </li>
        <li>
          <a href="#">
            <i class="fa fa-wrench"></i>
            <span>Tool</span>
          </a>
        </li>
        <li>
        <li>
          <a href="#">
            <i class="fa fa-bar-chart"></i>
            <span>Statistics</span>
          </a>
        </li>
        <li>
          <a href="#">
            <i class="fa fa-cog"></i>
            <span>Setting</span>
          </a>
        </li>
        <li>
          <a href="{{route('getUserLogout')}}">
            <i class="fa fa-power-off"></i>
            <span>Logout</span>
          </a>
        </li>
      </ul>
    </div>
  </div>
  <div class="sidebar-footer">
    <a href="">Developed by CWS</a>
  </div>
</nav>
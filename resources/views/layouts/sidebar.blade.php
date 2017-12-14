<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
      <div class="pull-left image">
        <img src="{{ Auth::user()->profile_pictures }}" class="img-circle" alt="User Image">
      </div>
      <div class="pull-left info">
        <p>{{ Auth::user()->name }}</p>
        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
      </div>
    </div>
    <!-- search form -->
    <form action="{{ route('users.searchuser') }}" method="get" class="sidebar-form" accept-charset="utf-8">
      <div class="input-group">
        <input type="text" name="u" class="form-control" placeholder="Search...">
        <span class="input-group-btn">
              <button type="submit" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
              </button>
            </span>
      </div>
    </form>

    <!-- /.search form -->
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu" data-widget="tree">
      <li class="header">MAIN NAVIGATION</li>
      <li><a href="{{ url('/') }}"><i class="fa fa-book"></i> <span>Dashboard</span></a></li>
      <li><a href="{{ url('#') }}"><i class="fa fa-book"></i> <span>My Videos</span></a></li>
      <li class="header">Action</li>
      <li><a href="{{ url('/live') }}"><i class="fa fa-circle-o text-red"></i> <span>Live Now</span></a></li>
    </ul>
  </section>
  <!-- /.sidebar -->
</aside>

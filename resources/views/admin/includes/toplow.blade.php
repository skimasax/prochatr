  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar" style="overflow-y: auto;height: 100vh;">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="{{ asset('report') }}/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>{{session('thisname')}}</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">Services</li>
        <li class="active treeview menu-open">
          <a href="#">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{route('main.admin.index')}}"><i class="fa fa-circle-o"></i> <span>Home</span> 
            <span class="pull-right-container">
              <small class="label pull-right bg-red"></small>
            </span>
            </a></li>
          </ul>
        </li>
        <li class="active"><a href="{{ route('main.admin.unregistered') }}"><i class="ion-ios-people"></i> &nbsp;&nbsp;&nbsp;Unregistered Users</a></li>
        <li class="header">Others</li>
        <li><a href="{{ route('main.admin.index') }}"><i class="ion ion-ios-locked text-red"></i> <span>Lock APP</span></a></li>       
        <li class="header">Administrator</li>
        <li id="openadds"><a href="#"><i class="ion ion-android-contacts text-aqua"></i> <span>Add user</span>
            <span class="pull-right-container">
              <small class="label pull-right bg-green">Create</small>
            </span>
          </a>
        </li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
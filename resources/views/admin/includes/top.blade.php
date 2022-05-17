<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <header class="main-header">

    <!-- Logo -->
    <a href="{{route('main.admin.index')}}?refresh=true&set=no_redirect" class="logo" style="position: fixed;">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>ADM</b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Prochatr</b></span>
    </a>

    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-fixed-top">
      <!-- Sidebar toggle button-->    
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button" style="text-transform: uppercase; font-weight: bold;">
        &nbsp;&nbsp;Ebenezer Babalola
      </a>
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Messages: style can be found in dropdown.less-->
{{--  --}}
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="{{ asset('report') }}/dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
              <span class="hidden-xs">{{session('thisname')}}</span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="{{ asset('report') }}/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">

                <p>
                  {{session('thisname')}} - Web Developer
                  <small>AgentID: {{ session('thisuser') }}</small>
                </p>
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="#" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  <a href="{{ route('main.admin.logout') }}" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>

    </nav>
  </header>
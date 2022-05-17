<body>
  <!--<div id="preloader"></div>-->
  <header id="header" class="fixed-top">
    <div class="container">

      <div class="logo float-left">
        <!-- Uncomment below if you prefer to use an image logo -->
        <!-- <h1 class="text-light"><a href="#header"><span>NewBiz</span></a></h1> -->
        <a href="#intro" class="scrollto"><img src="{{ asset('asset/img/logo/pname.png') }}" alt="" class="img-fluid"></a>
      </div>

      <nav class="main-nav float-right d-none d-lg-block">
        <ul>
          @if($title == "Prochatr - Instant Message and Notifications to your connections")
          <li class="active"><a href="#intro">Home</a></li>
          <li><a href="#about">About Us</a></li>
          <li><a href="#services">How it Works</a></li>
          <li><a href="#business">For Business</a></li>
          <li class="drop-down"><a href="#">Service</a>
            <ul>
              <li><a href="https://www.pro-executes.com/" style="color: #fff !important;" target="_blank">Leads</a></li>
              <!--<li><a href="https://www.getverifiedpro.com/" style="color: #fff !important;" target="_blank">Profile Verification</a></li>-->
              <li><a href="#" style="color: #fff !important;" target="_blank">Profile Verification</a></li>
              <li><a href="#clients" style="color: #fff !important;" target="_blank">Professionals Space</a></li>

            </ul>
          </li>
          <!--<li class="drop-down"><a href="#">Professionals Space</a>-->
          <!--  <ul>-->
          <!--    <li><a href="https://rtohomeweb.com/" style="color: #fff !important;" target="_blank">RTO Home Web</a></li>-->
          <!--    <li><a href="https://saveonautorepair.ca/" style="color: #fff !important;" target="_blank">Vimfile</a></li>-->
          <!--  </ul>-->
          <!--</li>-->
          <li><a href="#contact">Contact</a></li>
          @elseif($title == "Prochatr - Privacy" || $title == "Prochatr - Terms of Use" || $title == "Reset Password" || $title == "Google Contacts" || $title == "Invites" || $title == "Google Signin Error" || $title == "Prochatr - Professional Space")
          <li><a href="{{ route('main.index') }}">Return Home</a></li>
          @else
          <li><a href="{{ route('main.index') }}">Return Home</a></li>
          <li><a href="#invite" id="invitebtn">Tell a Friend</a></li>
          <li><a href="#" id="logout">Logout</a></li>
          <li class="active"><a href="#" class="capitalize">Welcome, <span id="top_name">{{ session('prochatr_firstname')." ".session('prochatr_lastname') }}</span></a></li>
          @endif
        {{-- </ul> --}}
      </nav>
      {{-- .main-nav --}}

    </div>
  </header>

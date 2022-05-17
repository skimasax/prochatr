  <style type="text/css" media="screen">
    #intro{background: #cccccc0f !important;}
  </style>
<section id="intro" class="clearfix intro-dash">

    <div class="container">

      <style>
        .intro-info {
             background: transparent !important; 
        }
      </style>

      <div class="intro-info dashboard">
{{-- 
        <span>Dashboard</span>

        <br /> --}}

        @if(session('prochatr_image') == "profile.png" || null == session('prochatr_image'))

            <img src="{{ asset('asset/img/user.png') }}" class="profile_dash" alt="Profile avatar" />

        @else

            <img src="{{ session('prochatr_image') }}" class="profile_dash" alt="Profile avatar" />

        @endif

        <center>

          <br />

          <h3>Meet some of the best professionals in your industry</h3>

          <a href="{{ route('main.myindustrylist') }}" title="Proceed to list"><button class="btn btn-success" type="button">View Your List</button></a>

        </center>

      </div>


    </div>

  </section><!-- #intro -->
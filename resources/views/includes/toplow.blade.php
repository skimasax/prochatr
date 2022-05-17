<section id="intro" class="clearfix">

    <div class="container">

    <style>
      .intro-info {
         background: transparent !important; 
      }
      #intro{padding: 145px 0 120px 0;}
    </style>

{{--       <div class="intro-img">

        <img src="{{ asset('asset/img/intro-img.svg') }}" alt="" class="img-fluid">

      </div> --}}



      <div class="intro-info">

        <br />

        <h2>Start new<br>conversation with<br><span>other professionals!</span></h2>

        <div>

          <a href="#signup" rel="modal:open" class="btn-get-started">Get Started For FREE</a>

          @if(null != session('prochatr_login_id'))

          <a href="{{ route('main.dashboard') }}" class="btn-services" alt="Return back to dashboard">Dashboard</a>

          @else

          <a href="#login" id="openLogin" rel="modal:open" class="btn-services">Log In</a>

          @endif

        </div>

      </div>



    <div class="slide">

      <ul>


        <li data-bg="{{ asset('asset/img/slide2.jpeg') }}"></li>
        <li data-bg="{{ asset('asset/img/bg.jpg') }}"></li>

        {{-- <li data-bg=""></li> --}}

      </ul>

    </div>



    </div>





  </section><!-- #intro -->
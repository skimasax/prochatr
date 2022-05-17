@extends('layouts.default')
@section('content')

  @include('includes.toplow_plain')

  <main id="main">
    <section id="dashboard_options">
      <div class="container">
        <div class="row about-container">

          <div class="col-md-10 col-lg-10 wow bounceInDown">
            <div class="box">
              <h4 class="title"><span>Google Signin Error <img src="{{ asset('asset/img/google.png') }}" style="width: 40px; position: absolute; left: 10px;"></span></h4>
              <p class="description">Appears to be an issue authenticating your account with provider. <br />Please try again later.</p>
              <br />
              <b />
              <p class="description text-danger">{{ $error }}.</p>
              <h5 style="font-size: 13px;"></h5>
              <hr />
              <center>
                <p>What next?</p>
              <a href="https://accounts.google.com/o/oauth2/auth?client_id=950089246071-4n54jjosvme0oufrgh3huq362rra7uqg.apps.googleusercontent.com&redirect_uri=https://prochatr.com/app/oauth&scope=https://www.google.com/m8/feeds/&response_type=code"><button type="button" class="btn btn-success btn-sm pull-right col-sm-3 pull-left" id="updatemypassword"><img src="{{ asset('asset/img/loader.svg') }}" alt="" class="loaderabs disp-0" style="margin-left: -40px; margin-top: -13px;" /> Retry <img src="{{ asset('asset/img/google.png') }}" style="width: 28px;"></button></a>&nbsp;&nbsp;
              <a href="{{ route('main.dashboard') }}"><button type="button" class="btn btn-danger btn-sm pull-right col-sm-3" id="updatemypassword"><img src="{{ asset('asset/img/loader.svg') }}" alt="" class="loaderabs disp-0" style="margin-left: -40px; margin-top: -13px;" /> Return to dashboard </button></a>
            </center>
            </div>
          </div>

        </div>

      </div>

    </section>
    
    {{-- <center><p class="wow bounceInUp"><b>Powered by Prochatr</b></p></center> --}}
  </main>


    @include('includes.modal')
    @include('includes.bottom')
    @include('includes.footer')
@stop
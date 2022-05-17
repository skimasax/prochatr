@extends('layouts.default')
@section('content')

  @include('includes.toplow_plain')

  <main id="main">

    <section id="dashboard_options">
      <div class="container">
        <div class="row about-container">

          <div class="col-md-10 col-lg-10 wow bounceInDown">
            <div class="box">
              <div class="icon"><i class="ion-key" style="color: #ff689b; margin-left: 20px;"></i></div>
              <h4 class="title"><span>Update Password</span></h4>
              <p class="description">Forgotten your account credentials or password? You can recover it by resetting it here.</p>
              <br />
              <b />
              <p class="description text-danger">Kindly be reminded that once you update your password.<br />Your old password would not be used to access your account.</p>
              <h5 style="font-size: 13px;"></h5>
              <hr />
              <div class="form-group row">
                <label for="reset_account_email" class="col-sm-3 col-form-label text-center">New password</label>
                <div class="col-sm-9">
                  <input type="email" class="form-control text-center" id="reset_account_password" required="" autofocus="">
                </div>
              </div>
              <button type="button" class="btn btn-danger btn-md pull-right col-sm-9" id="updatemypassword"><img src="{{ asset('asset/img/loader.svg') }}" alt="" class="loaderabs disp-0" style="margin-left: -40px; margin-top: -13px;" /> UPDATE ACCOUNT</button>
              <center><small id="reseterr" class="text-info"></small></center>
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
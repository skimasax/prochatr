@extends('layouts.default')
@section('content')

  @include('includes.toplow_plain')

  <main id="main">

    <section id="dashboard_options">
      <div class="container">

        <div class="row about-container">

          <div class="col-md-10 col-lg-10">
            <div class="box">
              <div class="icon"><i class="ion-key" style="color: #ff689b; margin-left: 20px;"></i></div>
              <h4 class="title"><span>Reset Password</span></h4>
              <p class="description">Forgotten your account credentials or password? You can recover it by resetting it here.</p>
              <br />
              <b />
              <p class="description text-danger">An email would be sent to your provided address to confirm account ownership and to complete your reset passoword process..</p>
              <h5 style="font-size: 13px;"></h5>
              <hr />
              <div class="form-group row">
                <label for="reset_account_email" class="col-sm-3 col-form-label text-center">Account Email</label>
                <div class="col-sm-9">
                  <input type="email" class="form-control text-center" id="reset_account_email" placeholder="Email here..." required="" autofocus="">
                </div>
              </div>

              <button type="button" class="btn btn-success btn-md pull-right col-sm-9" id="sendresetmail"><img src="{{ asset('asset/img/loader.svg') }}" alt="" class="loaderabs disp-0" style="margin-left: -40px; margin-top: -13px;" />SEND RESET LINK</button>
              <center><small id="reseterr" class="text-info"></small></center>

            </div>
          </div>

        </div>








<br />






        <div class="row about-container">

          <div class="col-md-10 col-lg-10">
            <div class="box">
              <div class="form-group row">
                <label class="col-sm-3 text-center">OR Login <br />With your Security Question & Answer
                  <br />
                  <br />
                  <br />
                  <img src="{{ asset('asset/img/security.png') }}" style="margin-top: -30px; width: 120px;">
                  <center><small id="reseterrsecurity" class="text-info"></small></center>
                </label>
                <div class="col-sm-9">
                  <label class="col-sm-12" for="accusername" style="padding-left: 0px;">Account Username/Email</label>
                  <input type="text" class="form-control col-sm-12" id="accusername" placeholder="Username/Email">
                  <br />                  
                  <label class="col-sm-12" for="security" style="padding-left: 0px;">Security Question</label>
                  <input type="text" class="form-control col-sm-12" id="accsecurity" value="" placeholder="No security question set ...." disabled="">
                  <br />
                  <label for="answer" class="col-sm-12" style="padding-left: 0px;">Security Answer</label>
                  <input type="text" class="form-control col-sm-12" id="accanswer" placeholder="Your security answer here ...." required="">

                  <br />
                  <button type="button" class="btn btn-primary btn-md pull-right col-sm-12" id="commandlogin">
                    <img src="{{ asset('asset/img/loader.svg') }}" alt="" class="loaderabs disp-0" style="margin-left: -40px; margin-top: -13px;" />LOG IN
                  </button>

                </div>
              </div>


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
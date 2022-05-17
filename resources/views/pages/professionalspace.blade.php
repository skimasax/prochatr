@extends('layouts.default')
@section('content')

    @include('includes.toplow')

  <main id="main">

    <!--==========================
      Clients Section
    ============================-->
    <section id="clients">

      <div class="container">
        <div class="section-header mb-5">
          <h3 style="color: #000 !important">Professionals Space</h3>
        </div>


        <div class="row no-gutters clients-wrap wow fadeInUp">

        @if (count($companylogo) > 0)
            @foreach ($companylogo as $companylogos)
                <div class="col-lg-3 col-md-4 col-xs-6" onclick="window.open('{{ $companylogos->website }}', '_blank')">
                    <div class="client-logo">
                    <img src="/companylogo/{{ $companylogos->logo }}" class="img-fluid" alt="">
                    </div>
                </div>
            @endforeach

            <div class="col-lg-3 col-md-4 col-xs-6" onclick="window.open('https://www.jscglobalaccountingservices.com/', '_blank')">
                <div class="client-logo">
                <img src="{{ asset('asset/img/Affiliate/JSClogo.png') }}" class="img-fluid" alt="">
                </div>
            </div>

            <div class="col-lg-3 col-md-4 col-xs-6" onclick="window.open('https://vimfile.com/', '_blank')">
                <div class="client-logo">
                <img src="{{ asset('asset/img/Affiliate/logo_black.png') }}" class="img-fluid" alt="">
                </div>
            </div>

            <div class="col-lg-3 col-md-4 col-xs-6" onclick="window.open('https://protech.exbc.ca/', '_blank')">
                <div class="client-logo">
                <img src="{{ asset('asset/img/Affiliate/protech.png') }}" class="img-fluid" alt="">
                </div>
            </div>

            <div class="col-lg-3 col-md-4 col-xs-6" onclick="window.open('https://rtohomeweb.com/', '_blank')">
                <div class="client-logo">
                <img src="{{ asset('asset/img/Affiliate/rto.png') }}" class="img-fluid" alt="">
                </div>
            </div>
        @else

        <div class="col-lg-3 col-md-4 col-xs-6" onclick="window.open('https://www.jscglobalaccountingservices.com/', '_blank')">
            <div class="client-logo">
              <img src="{{ asset('asset/img/Affiliate/JSClogo.png') }}" class="img-fluid" alt="">
            </div>
          </div>

          <div class="col-lg-3 col-md-4 col-xs-6" onclick="window.open('https://vimfile.com/', '_blank')">
            <div class="client-logo">
              <img src="{{ asset('asset/img/Affiliate/logo_black.png') }}" class="img-fluid" alt="">
            </div>
          </div>

          <div class="col-lg-3 col-md-4 col-xs-6" onclick="window.open('https://protech.exbc.ca/', '_blank')">
            <div class="client-logo">
              <img src="{{ asset('asset/img/Affiliate/protech.png') }}" class="img-fluid" alt="">
            </div>
          </div>

          <div class="col-lg-3 col-md-4 col-xs-6" onclick="window.open('https://rtohomeweb.com/', '_blank')">
            <div class="client-logo">
              <img src="{{ asset('asset/img/Affiliate/rto.png') }}" class="img-fluid" alt="">
            </div>
          </div>


        @endif



        </div>


      </div>

    </section>

  </main>


    @include('includes.modal')

    @include('includes.bottom')

    @include('includes.footer')
@stop

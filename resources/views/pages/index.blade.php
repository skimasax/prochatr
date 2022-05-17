@extends('layouts.default')
@section('content')

    @include('includes.toplow')

  <main id="main">

    <!--==========================
      About Us Section
    ============================-->
    <section id="about">
      <div class="container">

        <header class="section-header">
          <h3>Welcome to Prochatr for Professionals</h3>
          <hr />
          <h3>About Us</h3>
        </header>

        <div class="row about-container">

          <div class="col-lg-6 content order-lg-1 order-2">
            <p>
              With the aim to connect you with other professionals and providing effective communication for your connections and businesses.
            </p>

            <div class="icon-box wow fadeInUp">
              <div class="icon"><i class="fa fa-shopping-bag"></i></div>
              <h4 class="title"><a href="">Instant Message</a></h4>
              <p class="description">Avenue to smartly communicate with other professionals in realtime.</p>
            </div>

            <div class="icon-box wow fadeInUp" data-wow-delay="0.2s">
              <div class="icon"><i class="fa fa-photo"></i></div>
              <h4 class="title"><a href="">Share</a></h4>
              <p class="description">Send and Receive multimedia as images, files and sound anytime.</p>
            </div>

            <div class="icon-box wow fadeInUp" data-wow-delay="0.4s">
              <div class="icon"><i class="fa fa-bar-chart"></i></div>
              <h4 class="title"><a href="">Notification</a></h4>
              <p class="description">You matter, so get your connections prompted immediately that you are available.</p>
            </div>

{{--             <div class="icon-box wow fadeInUp">
              <div class="icon"><i class="fa fa-shopping-bag"></i></div>
              <h4 class="title"><a href="">Create professional group</a></h4>
              <p class="description">Avenue to smartly communicate with other professionals in realtime.</p>
            </div>

            <div class="icon-box wow fadeInUp" data-wow-delay="0.4s">
              <div class="icon"><i class="fa fa-bar-chart"></i></div>
              <h4 class="title"><a href="">Multi Channel</a></h4>
              <p class="description">Make Voice and Video Call.</p>
            </div>

            <div class="icon-box wow fadeInUp" data-wow-delay="0.4s">
              <div class="icon"><i class="fa fa-bar-chart"></i></div>
              <h4 class="title"><a href="">Organise</a></h4>
              <p class="description">Organise online Meeting and Conferences.</p>
            </div> --}}

          </div>

          <div class="col-lg-6 background order-lg-2 order-1 wow fadeInUp">
            <img src="{{ asset('asset/img/about-img.svg') }}" class="img-fluid" alt="">
          </div>
        </div>

        <div class="row about-extra">
          <div class="col-lg-6 wow fadeInUp">
            <img src="{{ asset('asset/img/about-extra-2.svg') }}" class="img-fluid" alt="">
          </div>
          <div class="col-lg-6 wow fadeInUp pt-5 pt-lg-0">
            <h4>Lets Collaborate.</h4>
            <h3>Are you new?</h3>
            <p>
             We have the professionals you need so you dont have to worry about getting connections.
            </p>
            <p>
             Do you have preferences already? Then go on and invite them. Lets create a bigger community.
            </p>
            <p>
             You can relax and get notified promptly when you have a new chat from a collaborator or a new message from a co-professional.
            </p>
            <p>
             Just log in and stay connected to partners around you.
            </p>
          </div>
        </div>

      </div>
    </section><!-- #about -->

    <!--==========================
      Services Section
    ============================-->
    <section id="services" class="section-bg">
      <div class="container">

        <header class="section-header">
          <h3>How it works</h3>
          <p>The process is quite simple and easy. Just a few steps and you are connecting. Just like that.</p>
        </header>

        <div class="row">

          <div class="col-md-6 col-lg-5 offset-lg-1 wow bounceInUp" data-wow-duration="1.4s">
            <div class="box">
              <div class="icon"><i class="ion-ios-analytics-outline" style="color: #ff689b;"></i></div>
              <h4 class="title"><a href="">1. Login</a></h4>
              <p class="description">Once you have registered successfully you can proceed to login.</p>
            </div>
          </div>
          <div class="col-md-6 col-lg-5 wow bounceInUp" data-wow-duration="1.4s">
            <div class="box">
              <div class="icon"><i class="ion-ios-bookmarks-outline" style="color: #e9bf06;"></i></div>
              <h4 class="title"><a href="">2. Choose a Connection</a></h4>
              <p class="description">Invite a preference or choose from our enormous connection list.</p>
            </div>
          </div>

          <div class="col-md-6 col-lg-5 offset-lg-1 wow bounceInUp" data-wow-delay="0.1s" data-wow-duration="1.4s">
            <div class="box">
              <div class="icon"><i class="ion-ios-paper-outline" style="color: #3fcdc7;"></i></div>
              <h4 class="title"><a href="">3. Message</a></h4>
              <p class="description">Compose your message to initiate a chat.</p>
            </div>
          </div>
          <div class="col-md-6 col-lg-5 wow bounceInUp" data-wow-delay="0.1s" data-wow-duration="1.4s">
            <div class="box">
              <div class="icon"><i class="ion-ios-speedometer-outline" style="color:#41cf2e;"></i></div>
              <h4 class="title"><a href="">4. Share</a></h4>
              <p class="description">Push your files into your chat.</p>
            </div>
          </div>

          <div class="col-md-6 col-lg-5 offset-lg-1 wow bounceInUp" data-wow-delay="0.2s" data-wow-duration="1.4s">
            <div class="box">
              <div class="icon"><i class="ion-ios-world-outline" style="color: #d6ff22;"></i></div>
              <h4 class="title"><a href="">5. Export</a></h4>
              <p class="description">Export your chat history anytime.</p>
            </div>
          </div>
          <div class="col-md-6 col-lg-5 wow bounceInUp" data-wow-delay="0.2s" data-wow-duration="1.4s">
            <div class="box">
              <div class="icon"><i class="ion-ios-clock-outline" style="color: #4680ff;"></i></div>
              <h4 class="title"><a href="">6. Smile</a></h4>
              <p class="description">Thats all.</p>
            </div>
          </div>

        </div>

      </div>
    </section><!-- #services -->

    <!--==========================
      Why Us Section
    ============================-->
    <section id="why-us" class="wow fadeIn">
      <div class="container">
        <header class="section-header">
          <h3>Why choose us?</h3>
          <p>We are creating a community for professionals.</p>
        </header>

        <div class="row row-eq-height justify-content-center">

          <div class="col-lg-4 mb-4">
            <div class="card wow bounceInUp">
                <i class="fa fa-diamond"></i>
              <div class="card-body">
                <h5 class="card-title">We want to help</h5>
                <p class="card-text">Created to bridge the gap between professionals, we are here for you.</p>
              </div>
            </div>
          </div>

          <div class="col-lg-4 mb-4">
            <div class="card wow bounceInUp">
                <i class="fa fa-language"></i>
              <div class="card-body">
                <h5 class="card-title">Helping you to Grow 24/7</h5>
                <p class="card-text">Our service is available just whenever you need it.</p>
              </div>
            </div>
          </div>

          <div class="col-lg-4 mb-4">
            <div class="card wow bounceInUp">
                <i class="fa fa-object-group"></i>
              <div class="card-body">
                <h5 class="card-title">You want to fly</h5>
                <p class="card-text">Afterall business needs to boom as best as possible. </p>
              </div>
            </div>
          </div>

        </div>

      </div>
    </section>

    <!--==========================
      Clients Section
    ============================-->
{{--     <section id="testimonials" class="section-bg">
      <div class="container">

        <header class="section-header">
          <h3>Testimonials</h3>
        </header>

        <div class="row justify-content-center">
          <div class="col-lg-8">

            <div class="owl-carousel testimonials-carousel wow fadeInUp">

              <div class="testimonial-item">
                <img src="{{ asset('asset/img/testimonial-1.jpg') }}" class="testimonial-img" alt="">
                <h3>Ebenezer Babalola</h3>
                <h4>Software &amp; Expert</h4>
                <p>
                  Its good to have a solution that is geared towards professionals.
                </p>
              </div>

              <div class="testimonial-item">
                <img src="{{ asset('asset/img/testimonial-2.jpg') }}" class="testimonial-img" alt="">
                <h3>John Smith</h3>
                <h4>C.E.O, Innovator</h4>
                <p>
                  Effective communication has always been a need. Good to know you are ready to help.
                </p>
              </div>

              <div class="testimonial-item">
                <img src="{{ asset('asset/img/testimonial-3.jpg') }}" class="testimonial-img" alt="">
                <h3>Adenuga Adebambo</h3>
                <h4>Product Manager</h4>
                <p>
                  Its a solution i would like to work with. Gives me a new sense of purpose.
                </p>
              </div>

            </div>

          </div>
        </div>


      </div>
    </section> --}}
    <!-- #testimonials -->

    <!--==========================
      Prochatr for Business Section
    ============================-->
    <section id="business" class="section-bg">
      <div class="container">

        <header class="section-header">
          <h3>Prochatr for Business</h3>
          <p>Introducing to your business. Improved specially for you.</p>
        </header>

        <div class="row">

          <div class="col-md-6 col-lg-5 offset-lg-1 wow bounceInUp" data-wow-duration="1.4s">
            <div class="box">
              <h4 class="title"><span>Increase your upline</span></h4>
              <p class="description">Increase your business turnover and sales with our upline embedded solution that connects your business operations with your sales efforts to the targeted markets.</p>
            </div>
          </div>
          <div class="col-md-6 col-lg-5 wow bounceInUp" data-wow-duration="1.4s">
            <div class="box">
              <h4 class="title"><span>Improved team collaboration</span></h4>
              <p class="description">Collaboration is now on the go. Improve collaboration within your team members with the most effective collaboration tool for communication.</p>
            </div>
          </div>

          <div class="col-md-6 col-lg-5 offset-lg-1 wow bounceInUp" data-wow-delay="0.1s" data-wow-duration="1.4s">
            <div class="box">
              <h4 class="title"><span href="">Improved efficiency at workplace</span></h4>
              <p class="description">Efficiency at workplace starts with effective communication. Improve the efficiency at your workplace with instant messaging system.</p>
            </div>
          </div>
          <div class="col-md-6 col-lg-5 wow bounceInUp" data-wow-delay="0.1s" data-wow-duration="1.4s">
            <div class="box">
              <h4 class="title"><span>Corporate privacy</span></h4>
              <p class="description">If your corporate privacy is a concern, Prochatr for Business end to end, strong SHA2 and 2048- bit encryption protects communication within your business. Prochatr for Business is a closed end-to-end, secured instant messaging between you and your team. Prochatr for Business server version is another layer of protection that gives you much rest of mind. No more threat of corporate espionage!</p>
            </div>
          </div>

          <div class="col-md-12 text-center col-lg-12 wow bounceInDown" data-wow-delay="0.1s" data-wow-duration="1.4s">
            <div class="box">
              <a href="#contact"><button class="btn btn-primary btn-md" href="#contact">REQUEST FOR DEMO</button></a>
            </div>
          </div>

        </div>

      </div>
    </section><!-- #Prochatr for Business -->

    <!--==========================
      Portfolio Section
    ============================-->
  {{--
  <section id="portfolio" class="clearfix">
      <div class="container">

        <header class="section-header">
          <h3 class="section-title">Our Portfolio</h3>
        </header>

        <div class="row">
          <div class="col-lg-12">
            <ul id="portfolio-flters">
              <li data-filter="*" class="filter-active">All</li>
              <li data-filter=".filter-mobile">Mobile</li>
              <li data-filter=".filter-desktop">Desktop</li>
              <li data-filter=".filter-web">Web</li>
            </ul>
          </div>
        </div>

        <div class="row portfolio-container">

          <div class="col-lg-4 col-md-6 portfolio-item filter-mobile">
            <div class="portfolio-wrap">
              <img src="{{ asset('asset/img/portfolio/mobile1.PNG') }}" class="img-fluid" alt="">
              <div class="portfolio-info">
                <h4><a href="#">Mobile 1</a></h4>
                <p>Mobile</p>
                <div>
                  <a href="{{ asset('asset/img/portfolio/mobile1.PNG') }}" data-lightbox="portfolio" data-title="Mobile 1" class="link-preview" title="Preview"><i class="ion ion-eye"></i></a>
                  <a href="#" class="link-details" title="More Details"><i class="ion ion-android-open"></i></a>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 portfolio-item filter-web" data-wow-delay="0.1s">
            <div class="portfolio-wrap">
              <img src="{{ asset('asset/img/portfolio/mobile2.PNG') }}" class="img-fluid" alt="">
              <div class="portfolio-info">
                <h4><a href="#">Mobile 2</a></h4>
                <p>Mobile</p>
                <div>
                  <a href="{{ asset('asset/img/portfolio/mobile2.PNG') }}" class="link-preview" data-lightbox="portfolio" data-title="Mobile 2" title="Preview"><i class="ion ion-eye"></i></a>
                  <a href="#" class="link-details" title="More Details"><i class="ion ion-android-open"></i></a>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 portfolio-item filter-mobile" data-wow-delay="0.2s">
            <div class="portfolio-wrap">
              <img src="{{ asset('asset/img/portfolio/mobile3.PNG') }}" class="img-fluid" alt="">
              <div class="portfolio-info">
                <h4><a href="#">Mobile 3</a></h4>
                <p>Mobile</p>
                <div>
                  <a href="{{ asset('asset/img/portfolio/mobile3.PNG') }}" class="link-preview" data-lightbox="portfolio" data-title="Mobile 3" title="Preview"><i class="ion ion-eye"></i></a>
                  <a href="#" class="link-details" title="More Details"><i class="ion ion-android-open"></i></a>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 portfolio-item filter-mobile" data-wow-delay="0.2s">
            <div class="portfolio-wrap">
              <img src="{{ asset('asset/img/portfolio/mobile4.PNG') }}" class="img-fluid" alt="">
              <div class="portfolio-info">
                <h4><a href="#">Mobile 4</a></h4>
                <p>Mobile</p>
                <div>
                  <a href="{{ asset('asset/img/portfolio/mobile4.PNG') }}" class="link-preview" data-lightbox="portfolio" data-title="Mobile 4" title="Preview"><i class="ion ion-eye"></i></a>
                  <a href="#" class="link-details" title="More Details"><i class="ion ion-android-open"></i></a>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 portfolio-item filter-mobile" data-wow-delay="0.2s">
            <div class="portfolio-wrap">
              <img src="{{ asset('asset/img/portfolio/mobile5.PNG') }}" class="img-fluid" alt="">
              <div class="portfolio-info">
                <h4><a href="#">Mobile 5</a></h4>
                <p>Mobile</p>
                <div>
                  <a href="{{ asset('asset/img/portfolio/mobile5.PNG') }}" class="link-preview" data-lightbox="portfolio" data-title="Mobile 5" title="Preview"><i class="ion ion-eye"></i></a>
                  <a href="#" class="link-details" title="More Details"><i class="ion ion-android-open"></i></a>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 portfolio-item filter-desktop">
            <div class="portfolio-wrap">
              <img src="{{ asset('asset/img/portfolio/desktop1.PNG') }}" class="img-fluid" alt="">
              <div class="portfolio-info">
                <h4><a href="#">Desktop 1</a></h4>
                <p>Desktop</p>
                <div>
                  <a href="{{ asset('asset/img/portfolio/desktop1.PNG') }}" class="link-preview" data-lightbox="portfolio" data-title="Desktop 1" title="Preview"><i class="ion ion-eye"></i></a>
                  <a href="#" class="link-details" title="More Details"><i class="ion ion-android-open"></i></a>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 portfolio-item filter-desktop" data-wow-delay="0.1s">
            <div class="portfolio-wrap">
              <img src="{{ asset('asset/img/portfolio/desktop2.PNG') }}" class="img-fluid" alt="">
              <div class="portfolio-info">
                <h4><a href="#">Desktop 2</a></h4>
                <p>Desktop</p>
                <div>
                  <a href="{{ asset('asset/img/portfolio/desktop2.PNG') }}" class="link-preview" data-lightbox="portfolio" data-title="Desktop 2" title="Preview"><i class="ion ion-eye"></i></a>
                  <a href="#" class="link-details" title="More Details"><i class="ion ion-android-open"></i></a>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 portfolio-item filter-desktop" data-wow-delay="0.2s">
            <div class="portfolio-wrap">
              <img src="{{ asset('asset/img/portfolio/desktop3.PNG') }}" class="img-fluid" alt="">
              <div class="portfolio-info">
                <h4><a href="#">Desktop 3</a></h4>
                <p>Desktop</p>
                <div>
                  <a href="{{ asset('asset/img/portfolio/desktop3.PNG') }}" class="link-preview" data-lightbox="portfolio" data-title="Desktop 3" title="Preview"><i class="ion ion-eye"></i></a>
                  <a href="#" class="link-details" title="More Details"><i class="ion ion-android-open"></i></a>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 portfolio-item filter-desktop">
            <div class="portfolio-wrap">
              <img src="{{ asset('asset/img/portfolio/desktop4.PNG') }}" class="img-fluid" alt="">
              <div class="portfolio-info">
                <h4><a href="#">Desktop 4</a></h4>
                <p>Desktop</p>
                <div>
                  <a href="{{ asset('asset/img/portfolio/desktop4.PNG') }}" class="link-preview" data-lightbox="portfolio" data-title="Desktop 4" title="Preview"><i class="ion ion-eye"></i></a>
                  <a href="#" class="link-details" title="More Details"><i class="ion ion-android-open"></i></a>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 portfolio-item filter-desktop" data-wow-delay="0.1s">
            <div class="portfolio-wrap">
              <img src="{{ asset('asset/img/portfolio/desktop5.PNG') }}" class="img-fluid" alt="">
              <div class="portfolio-info">
                <h4><a href="#">Desktop 5</a></h4>
                <p>Desktop</p>
                <div>
                  <a href="{{ asset('asset/img/portfolio/desktop5.PNG') }}" class="link-preview" data-lightbox="portfolio" data-title="Desktop 5" title="Preview"><i class="ion ion-eye"></i></a>
                  <a href="#" class="link-details" title="More Details"><i class="ion ion-android-open"></i></a>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 portfolio-item filter-desktop" data-wow-delay="0.2s">
            <div class="portfolio-wrap">
              <img src="{{ asset('asset/img/portfolio/desktop6.PNG') }}" class="img-fluid" alt="">
              <div class="portfolio-info">
                <h4><a href="#">Desktop 6</a></h4>
                <p>Desktop</p>
                <div>
                  <a href="{{ asset('asset/img/portfolio/desktop6.PNG') }}" class="link-preview" data-lightbox="portfolio" data-title="Desktop 6" title="Preview"><i class="ion ion-eye"></i></a>
                  <a href="#" class="link-details" title="More Details"><i class="ion ion-android-open"></i></a>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 portfolio-item filter-desktop" data-wow-delay="0.2s">
            <div class="portfolio-wrap">
              <img src="{{ asset('asset/img/portfolio/desktop7.PNG') }}" class="img-fluid" alt="">
              <div class="portfolio-info">
                <h4><a href="#">Desktop 7</a></h4>
                <p>Desktop</p>
                <div>
                  <a href="{{ asset('asset/img/portfolio/desktop7.PNG') }}" class="link-preview" data-lightbox="portfolio" data-title="Desktop 7" title="Preview"><i class="ion ion-eye"></i></a>
                  <a href="#" class="link-details" title="More Details"><i class="ion ion-android-open"></i></a>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 portfolio-item filter-desktop" data-wow-delay="0.2s">
            <div class="portfolio-wrap">
              <img src="{{ asset('asset/img/portfolio/desktop8.PNG') }}" class="img-fluid" alt="">
              <div class="portfolio-info">
                <h4><a href="#">Desktop 8</a></h4>
                <p>Desktop</p>
                <div>
                  <a href="{{ asset('asset/img/portfolio/desktop8.PNG') }}" class="link-preview" data-lightbox="portfolio" data-title="Desktop 8" title="Preview"><i class="ion ion-eye"></i></a>
                  <a href="#" class="link-details" title="More Details"><i class="ion ion-android-open"></i></a>
                </div>
              </div>
            </div>
          </div>

        </div>

      </div>
    </section>
    --}}
    <!-- #portfolio -->

    <!--==========================
      Clients Section
    ============================-->
    <section id="clients" class="section-bg">

      <div class="container">
        <div class="section-header">
          <h3 style="color: #fff !important">Professionals Space</h3>
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
        @if (count($companylogo) > 8)
        <div class="col-md-12 text-center col-lg-12 wow bounceInDown" data-wow-delay="0.1s" data-wow-duration="1.4s">
            <div class="box">
              <a href="{{ route('main.professionalspace') }}"><button class="btn btn-primary btn-md" href="{{ route('main.professionalspace') }}">SEE MORE</button></a>
            </div>
          </div>
        @endif
      </div>

    </section>

    @include('includes.contact')

  </main>


    @include('includes.modal')

    @include('includes.bottom')

    @include('includes.footer')
@stop

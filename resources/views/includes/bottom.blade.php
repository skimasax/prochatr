
<footer id="footer">
    <div class="footer-top">
      <div class="container">
        <div class="row">

          <div class="col-lg-4 col-md-6 footer-info">
            <h3>Prochatr</h3>
            <p>Start new conversation with other professionals.<br /><br />With the aim to connect you with other professionals and providing effective communication for your connections and businesses.</p>
          </div>

          <div class="col-lg-2 col-md-6 footer-links">
            <h4>Site Map</h4>
            <ul>
              <li class="active"><a href="#intro">Home</a></li>
              <li><a href="#about">About us</a></li>
              <li><a href="#services">How it Works</a></li>
              <li><a href="#">Advertise</a></li>
              <li><a href="{{ route('main.terms') }}">Terms of service</a></li>
              <li><a href="{{ route('main.privacy') }}">Privacy policy</a></li>
            </ul>
          </div>

          <div class="col-lg-3 col-md-6 footer-contact">
            <h4>Contact Us</h4>
            <p style="text-transform: uppercase;">
              Professionals' File Inc. <br>10, GEORGE ST. NORTH
              BRAMPTON, ON L6X 1R2<br>
              Canada. <br>
            </p>
              {{-- <strong>Phone:</strong> +1 437 925 8344<br> --}}
              <p>
                <strong>Email:</strong> info@prochatr.com<br>
              </p>

            <div class="social-links">
              <a href="https://twitter.com/prochatr1" target="_BLANK" class="twitter"><i class="fa fa-twitter"></i></a>
              <a href="https://www.facebook.com/Prochatr-2367897976601385/" target="_BLANK" class="facebook"><i class="fa fa-facebook"></i></a>
              <a href="https://www.instagram.com/prochatr/" target="_BLANK" class="instagram"><i class="fa fa-instagram"></i></a>
              {{-- <a href="#" class="google-plus"><i class="fa fa-google-plus"></i></a> --}}
              <a href="https://www.linkedin.com/company/prochatr/?viewAsMember=true" target="_BLANK" class="linkedin"><i class="fa fa-linkedin"></i></a>
            </div>

          </div>

          <div class="col-lg-3 col-md-6 footer-newsletter">
            <h4>Our Newsletter</h4>
            <p>Get information about updates, offers and other solutions for your use first hand now.</p>
            <form action="" method="post">
              <input type="email" name="email" id="subscribe_email"  placeholder="Email"/><img src="{{ asset('asset/img/loader.svg') }}" alt="" class="loaderabs disp-0" /><input type="submit" value="Subscribe" id="subscribe">
              <small id="errShow" class="col-md-12 text-danger"></small>
            </form>
          </div>

      <div class="copyright col-md-12" style="padding: 5px;">
        &copy; Copyright {{ date('Y') }}. <strong>Prochatr</strong>. <br />All Rights Reserved
      </div>

        </div>
      </div>
    </div>

{{--     <div class="container">
      <div class="copyright">
        &copy; Copyright {{ date('Y') }}. <strong>Prochatr</strong>. All Rights Reserved
      </div>
      <div class="credits"> --}}
        <!--
          All the links in the footer should remain intact.
          You can delete the links only if you purchased the pro version.
          Licensing information: https://bootstrapmade.com/license/
          Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/buy/?theme=NewBiz
        -->
        <!-- Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a> -->

{{--       </div>
    </div>
  </footer> --}}
  <!-- #footer -->

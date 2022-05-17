    <!--==========================
      Contact Section
    ============================-->
    <section id="contact">
      <div class="container-fluid">

        <div class="section-header">
          <h3>Contact Us</h3>
        </div>

        <div class="row wow fadeInUp">

          <div class="col-lg-6">
            <div class="map mb-4 mb-lg-0">
              <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2885.207855840294!2d-79.76331278450118!3d43.68544197912022!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x882b1597c120173b%3A0x8c0309afa99d74d2!2s10+George+St+N%2C+Brampton%2C+ON+L6X+1R2%2C+Canada!5e0!3m2!1sen!2sng!4v1560930986109!5m2!1sen!2sng" frameborder="0" style="border:0; width: 100%; height: 312px;" allowfullscreen></iframe>
            </div>
          </div>

          <div class="col-lg-6">
            <div class="row">
              <div class="col-md-6 info">
                <i class="ion-ios-location-outline"></i>
                <p style="text-transform: uppercase;">Professionals' File Inc.<br /> 10, GEORGE ST. NORTH BRAMPTON, ON L6X 1R2, Canada</p>
              </div>
              <div class="col-md-6 info">
                <i class="ion-ios-email-outline"></i>
                <p>info@prochatr.com</p>
              </div>
{{--               <div class="col-md-3 info">
                <i class="ion-ios-telephone-outline"></i>
                <p>+1 437 925 8344</p>
              </div> --}}
            </div>

            <div class="form">
              <div id="sendmessage">Your message has been sent. Thank you!</div>
              <div id="errormessage"></div>
              <form action="{{ route('main.Contact') }}" method="post" role="form" class="contactForm">
                <div class="form-row">
                  <div class="form-group col-lg-6">
                    <input type="text" name="name" class="form-control" id="contact_name" placeholder="Your Name" data-rule="minlen:4" data-msg="Please enter at least 4 chars" />
                    <div class="validation"></div>
                  </div>
                  <div class="form-group col-lg-6">
                    <input type="email" class="form-control" name="email" id="contact_email" placeholder="Your Email" data-rule="email" data-msg="Please enter a valid email" />
                    <div class="validation"></div>
                  </div>
                </div>                
                <div class="form-row">
                  <div class="form-group col-lg-4">
                    <input type="text" name="city" class="form-control" id="contact_city" placeholder="Your City" data-rule="minlen:4" data-msg="Please enter a valid city" />
                    <div class="validation"></div>
                  </div>
                  <div class="form-group col-lg-4">
                    <input type="text" class="form-control" name="state" id="contact_state" placeholder="Your State" data-rule="minlen:4" data-msg="Please enter a valid state" />
                    <div class="validation"></div>
                  </div>                  
                  <div class="form-group col-lg-4">
                    <input type="text" class="form-control" name="country" id="contact_country" placeholder="Your Country" data-rule="minlen:4" data-msg="Please enter a valid country" />
                    <div class="validation"></div>
                  </div>
                </div>
                <div class="form-group">
                  <input type="text" class="form-control" name="subject" id="contact_subject" placeholder="Subject" data-rule="minlen:4" data-msg="Please enter at least 8 chars of subject" />
                  <div class="validation"></div>
                </div>
                <div class="form-group">
                  <textarea class="form-control" name="message" id="contact_message" rows="5" data-rule="required" data-msg="Please write something for us" placeholder="Message"></textarea>
                  <div class="validation"></div>
                </div>
                <div class="text-center"><img src="{{ asset('asset/img/loader.svg') }}" alt="" class="loaderabs disp-0" /><button type="submit" title="Send Message">Send Message</button></div>

              </form>
            </div>
          </div>

        </div>

      </div>
    </section><!-- #contact -->
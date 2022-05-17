<input type="hidden" name="login_id" value="{{ time() }}" id="login_id" />
<div id="errorSubscribe" class="modal dosubscribe">
	<center>
		<img src="{{ asset('asset/img/logo/pname.png') }}" alt="" class="img-fluid adjustlogin">
	<h4 style="margin-top: -35px;" id="resTitle">Subscription</h4>
	<hr />
	<div class="container-fluid">

		<div class="row">
			{{-- Network Build up --}}
			<div class="col-md-12" style="float: left;">
				<img src="{{ asset('asset/img/subscribe.png') }}" alt="" class="img-fluid" style="width: 100px; height: 100px; border-radius: 100px;">
				<br />
				<br />
				<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_BLANK">
				<input type="hidden" name="cmd" value="_s-xclick">
				<input type="hidden" name="hosted_button_id" value="SH8EH74FN37GG">
				<table>
				<tr><td class="text-center"><input type="hidden" name="on0" value="Upgrade NOW"></td></tr>
				<tr><td><select name="os0" style="height: 40px; border-radius: 10px; margin: 10px;">
					<option value="Monthly">Monthly : $5.00 CAD - monthly</option>
					<option value="Annually">Annually : $50.00 CAD - monthly</option>
				</select> </td></tr>
				</table>
				<input type="hidden" name="currency_code" value="CAD">
				<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_subscribeCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
				<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
				</form>
			</div>
		</div>

	</div>
	</center>
</div>
<div id="errorFetch" class="modal showfetch">

	<center>
		<img src="{{ asset('asset/img/logo/pname.png') }}" alt="" class="img-fluid adjustlogin">
	<h4 style="margin-top: -35px;" id="resTitle"></h4>
	<br />
	<div class="container-fluid">


		<div class="row" id="resFirst">
			{{-- Network Build up --}}
			<div class="col-md-6" style="float: left;">
				<img src="{{ asset('asset/img/logo/pname.png') }}" alt="" class="img-fluid" style="width: 100px; height: 100px; border-radius: 100px; background: #000;">
				<br />
				<br />
				<b id="addC"></b>
				<br />
				Add Contact
			</div>
			<div class="col-md-6" style="float: right;">
				<img src="{{ asset('asset/img/logo/pname.png') }}" alt="" class="img-fluid" style="width: 100px; height: 100px; border-radius: 100px; background: #000;">
				<br />
				<br />
				<b id="invitePop"></b>
				<br />
				invite
			</div>
		</div>

		{{-- <div class="row" id="resSecond"> --}}
			{{-- Professional Supports --}}
{{-- 			<div class="col-md-6" style="float: left;">
				<img src="{{ asset('asset/img/logo/pname.png') }}" alt="" class="img-fluid" style="width: 100px; height: 100px; border-radius: 100px; background: #000;">
				<br />
				<br />
				<b id="sCon"></b>
				<br />
				Suggested Connections
			</div>
			<div class="col-md-6" style="float: right;">
				<img src="{{ asset('asset/img/logo/pname.png') }}" alt="" class="img-fluid" style="width: 100px; height: 100px; border-radius: 100px; background: #000;">
				<br />
				<br />
				<b id="pCon"d></b>
				<br />
				Prochatr Connections
			</div>
		</div> --}}

		<div class="row" id="resThird">
			{{-- Appropriate use of Tools --}}
			<div class="col-md-6" style="float: left; margin-bottom: 23px;">
				<img src="{{ asset('asset/img/logo/pname.png') }}" alt="" class="img-fluid" style="width: 100px; height: 100px; border-radius: 100px; background: #000;">
				<br />
				<br />
				<b id="group"></b>
				<br />
				Group
			</div>
			<div class="col-md-6" style="float: right; margin-bottom: 23px;">
				<img src="{{ asset('asset/img/logo/pname.png') }}" alt="" class="img-fluid" style="width: 100px; height: 100px; border-radius: 100px; background: #000;">
				<br />
				<br />
				<b id="vCall"></b>
				<br />
				Voice Call
			</div>
			<div class="col-md-6" style="float: left; margin-bottom: 23px;">
				<img src="{{ asset('asset/img/logo/pname.png') }}" alt="" class="img-fluid" style="width: 100px; height: 100px; border-radius: 100px; background: #000;">
				<br />
				<br />
				<b id="iMessaging"></b>
				<br />
				Instant Messaging
			</div>
			<div class="col-md-6" style="float: right; margin-bottom: 23px;">
				<img src="{{ asset('asset/img/logo/pname.png') }}" alt="" class="img-fluid" style="width: 100px; height: 100px; border-radius: 100px; background: #000;">
				<br />
				<br />
				<b id="vMessaging"></b>
				<br />
				Video Messaging
			</div>
			<div class="col-md-12" style="margin: auto; margin-bottom: 23px;">
				<img src="{{ asset('asset/img/logo/pname.png') }}" alt="" class="img-fluid" style="width: 100px; height: 100px; border-radius: 100px; background: #000;">
				<br />
				<br />
				<b id="cMessaging"></b>
				<br />
				Conference Messaging
			</div>
		</div>



	</div>
	</center>
</div>
{{-- Error MOdal --}}
<div id="error" class="modal">

	<center>
	<img src="{{ asset('asset/img/logo/pname.png') }}" alt="" class="img-fluid adjustlogin">
	<br />
	<img src="{{ asset('asset/img/error.svg') }}" alt="" class="img-fluid adjusterror">
	<h3>Application Error</h3>
	<hr />
	Access Denied. Please kindly login
	</center>
</div>

{{-- Update Modal --}}
<div id="error" class="modal updatepassword">

	<center>
	<img src="{{ asset('asset/img/logo/pname.png') }}" alt="" class="img-fluid adjustlogin">
	<br />
	<img src="{{ asset('asset/img/refresh-shield.png') }}" style="margin-top: -30px;">
	<br />
	<br />
	<h3>Update Password</h3>
	<hr />
	<input class="form-control" type="password" name="prev_password" id="prev_password" placeholder="Previous password" />
	<br />
	<input class="form-control" type="password" name="new_password" id="new_password" placeholder="New Password" />

  	<small id="passwordHelpBlock" class="form-text text-muted text-center">
	  <span style="font-weight: bold; color: #004a99bf;">Your next login would be using the new password.</span>
	</small>
	<br />
	<div class="errresponseUpdatePassword text-danger text-center disp-0" style="font-size: 13px;"></div>
	<img src="{{ asset('asset/img/loader.svg') }}" alt="" class="loaderabs disp-0" />
	<button type="submit" class="btn btn-primary pull-right" id="updatepasswordform">UPDATE PASSWORD &nbsp;<img src="{{ asset('asset/img/loaders/Cube-1s-200px.svg') }}"></button>
	<hr />
	<br />
    <span class="text-primary" style="color: #004a99bf !important;">Having trouble? Forgot previous Password?</span>
    <br />
    <br />
    <a href="{{ route('main.resetpassword') }}" target="_BLANK" class="btn btn-success pull-right" style="width: 100%; color: #000;">Reset Password</a>

	</center>
</div>

{{-- Security Modal --}}
<div id="error" class="modal editsecurity">

	<center>
	<img src="{{ asset('asset/img/logo/pname.png') }}" alt="" class="img-fluid adjustlogin">
	<br />
	<img src="{{ asset('asset/img/security.png') }}" style="margin-top: -30px; width: 120px;">
	<br />
	<br />
	<h3>Edit Security Question</h3>
	<small class="text-info">You dont have to reset all the time when you lose your password</small>
	<hr />
	<label for="new_security" class="col-sm-12 text-left" style="padding-left:0px;">New Security Question</label>
	<input class="form-control" type="text" name="new_security" id="new_security" placeholder="E.g What is your year of birth" />
	<br />
	<label for="new_security" class="col-sm-12 text-left" style="padding-left:0px;">New Security Answer</label>
	<input class="form-control" type="text" name="new_answer" id="new_answer" placeholder="1984" />
	<br />

	<div class="errresponseeditsecurity text-danger text-center disp-0" style="font-size: 13px;"></div>

	<button type="submit" class="btn btn-primary pull-right col-sm-12" id="editsecuritybtn"><img src="{{ asset('asset/img/loader.svg') }}" alt="" class="loaderabs disp-0" />SAVE</button>


	</center>
</div>

{{-- Alternate Email Modal --}}
<div id="error" class="modal editalternate">

	<center>
	<img src="{{ asset('asset/img/logo/pname.png') }}" alt="" class="img-fluid adjustlogin">
	<br />
	<img src="{{ asset('asset/img/google.png') }}" style="margin-top: -30px;">
	<br />
	<br />
	<h3>Edit Alternate Email</h3>
	<small class="text-info">Log in faster and manage multiple accounts</small>
	<hr />
	<input class="form-control text-center" type="email" name="alternate_email" id="alternate_email" placeholder="*******@gmail.com" />
	<br />

  	<small id="passwordHelpBlock" class="form-text text-muted text-center">
	  <span style="font-weight: bold; color: #004a99bf;">You can Sign in with Google to have access to multiple accounts.</span>
	</small>
	<br />
	<div class="errresponseeditatlernate text-danger text-center disp-0" style="font-size: 13px;"></div>

	<button type="submit" class="btn btn-primary pull-right col-sm-12" id="editatlernateform"><img src="{{ asset('asset/img/loader.svg') }}" alt="" class="loaderabs disp-0" />SAVE</button>


	</center>
</div>

{{-- Login Form --}}
<div id="login" class="modal">

	<form>
	{{-- <center><img src="{{ asset('asset/img/logo/pname.png') }}" alt="" class="img-fluid adjustlogin"></center> --}}
	<h3>Login</h3>
	<hr />
	  <div class="form-group row">
	    <label for="login_username" class="col-sm-3 col-form-label">Username</label>
	    <div class="col-sm-9">
	      <input type="text" class="form-control" id="login_username" placeholder="Email/Login ID" required="">
	    </div>
	  </div>

	  <div class="form-group row">
	    <label for="login_password" class="col-sm-3 col-form-label">Password</label>
	    <div class="col-sm-9">
	      <input type="password" class="form-control" id="login_password" placeholder="Password" required="">
	    </div>
	  </div>

	  <div class="errresponselogin text-danger text-center disp-0"><p></p></div>

	  <div class="form-group row">
	    <div class="col-sm-12 col-xs-12 text-center">
	      <input type="checkbox" class="" id="block" name="block" title="Stay logged in" style="width: 15px; margin-top: 10px; cursor: pointer;">
	      <label for="block" class="" style="font-size: 14px;">Keep me logged in</label>
	    </div>
	  </div>
	    <button type="submit" class="btn btn-primary pull-right" style="width: 100%;">Log in <img src="{{ asset('asset/img/loaders/Cube-1s-200px.svg') }}"></button><img src="{{ asset('asset/img/loader.svg') }}" alt="" class="loaderabs disp-0" />
	    <br />
	    <br />
	    <br />
	    <center>
		    <span class="text-primary">Having trouble logging in?
		    	<a href="{{ route('main.resetpassword') }}" class="text-danger"><b>Reset here</b></a>
		    </span>
		    <br />
		    <br />
		    <a type="button" href="#signup" rel="modal:open" class="btn btn-success" style="width: 100%;">Create an Account</a>
	    </center>

	    <br />
	</form>
		<br />
</div>

{{-- Invite Form --}}
<div id="invite" class="modal">

	<form id="inviteform">
		<div class="intro-img text-center">
			<img src="{{ asset('asset/img/logo/pname.png') }}" alt="" class="img-fluid adjust">
		</div>
	<h4 class="text-center">Invite Professionals</h4>
	<hr />
	  <div class="form-group row">
	    <div class="col-sm-12">
	      <textarea class="form-control" id="invite_email" required="" rows="4" placeholder="topsy@friend.com, rack@coworker.com..."></textarea>
	      <small id="passwordHelpBlock" class="form-text text-muted text-center">
		  <span style="font-weight: bold; color: #004a99bf;">separate multiple emails with a comma.</span>
		  <br />
		  <span id="inviteinfo"></span>
		</small>
	    </div>
	  </div>
	  	<img src="{{ asset('asset/img/loader.svg') }}" alt="" class="loaderabs disp-0" />
	    <button type="button" class="btn btn-primary pull-right send_invite"><span>Send</span> Invitation</button>
	</form>

<center>
<br /><br />
<br />
Wish to sync with your accounts?
<br />
<br />
<a href="https://accounts.google.com/o/oauth2/auth?client_id=950089246071-4n54jjosvme0oufrgh3huq362rra7uqg.apps.googleusercontent.com&redirect_uri=https://prochatr.com/app/oauth&scope=https://www.google.com/m8/feeds/&response_type=code"><button type="button" class="btn btn-xs import" style="background: #000; color: #FFF;"><img src="{{ asset('asset/img/loader.svg') }}" alt="" class="loaderabs disp-0" />Google<img src="{{ asset('asset/img/google.png') }}" style="width: 28px;"></button></a><button type="button" class="btn btn-info btn-xs import excel"><img src="{{ asset('asset/img/loader.svg') }}" alt="" class="loaderabs disp-0" />Excel<img src="{{ asset('asset/img/excel.png') }}" style="width: 28px;"></button>
</center>
		<br />
</div>

{{-- Sign up Form --}}
<div id="signup" class="modal">

<div class="container-fluid register">
                <div class="row">
                    <div class="col-md-3 register-left">
                        <img src="https://image.ibb.co/n7oTvU/logo_white.png" alt=""/>
                        <h3>Welcome</h3>
                        <p>You are 20 seconds away from joining the best growing network for professionals.</p>
                        <a type="button" href="#login" rel="modal:open" class="btn btn-primary" style="width: 100%; margin-bottom: 5px;">Login</a><br/>
                    </div>
                    <div class="col-md-9 register-right">
                        <ul class="nav nav-tabs nav-justified" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link reg-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Sign Up</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link reg-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Account Setup</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link reg-link" id="finish-tab" data-toggle="tab" href="#finish" role="tab" aria-controls="finish" aria-selected="false">Finish</a>
                            </li>
                        </ul>
                        <br />
                        <div class="tab-content" id="myTabContent">
                            <div class="stage1 tab-pane fade show active">
                            	<input type="hidden" id="signupForm" value="{{ route('main.register') }}">
                                <h3 class="register-heading">Sign Up</h3>
                                <div class="row register-form">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="register_firstname" id="register_firstname" placeholder="First Name *" value="" />
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="register_lastname" id="register_lastname" placeholder="Last Name *" value="" />
                                        </div>
                                        <div class="form-group">
                                            <input type="email" class="form-control" placeholder="Email *" name="register_email" id="register_email" value="" />
                                        </div>
                                        <div class="form-group">
                                            <input type="number" class="form-control" name="register_phone" id="register_phone"  placeholder="Phone *" value="" />
                                        </div>
                                        <div class="form-group">
					                        <select id="gender" class="form-control">
					                            <option value="Male" selected="">Male</option>
					                            <option value="Female">Female</option>
					                        </select>
                                        </div>
                                        <div class="form-group">
                                            <select class="form-control" id="register_country" name ="register_country"></select>
                                        </div>

                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <select class="form-control" id="register_state" name="register_state" placeholder="State *" value="">
				      						</select>
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="register_city" id="register_city" placeholder="City *" value="" />
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="register_profession" id="register_profession" placeholder="Your profesion *" value="" />
                                        </div>
                                        <div class="form-group">
                                            <input type="text" name="register_position" id="register_position" class="form-control" placeholder="Your Position *" value="" />
                                        </div>
                                        <div class="form-group">
                                            <input type="text" name="register_company" id="register_company" class="form-control" placeholder="Your Company *" value="" />
                                        </div>
                                        <div class="form-group">
                                            <select class="form-control" id="register_industry" name="register_industry">
                                                <option value="">Select Industry</option>
                                                <option value='Accounting'>Accounting</option>
                                                <option value='Airlines/Aviation'>Airlines/Aviation</option>
                                                <option value='Alternative Dispute Resolution'>Alternative Dispute Resolution</option>
                                                <option value='Alternative Medicine'>Alternative Medicine</option>
                                                <option value='Animation'>Animation</option>
                                                <option value='Apparel & Fashion'>Apparel & Fashion</option>
                                                <option value='Architecture & Planning'>Architecture & Planning</option>
                                                <option value='Arts and Crafts'>Arts and Crafts</option>
                                                <option value='Automotive'>Automotive</option>
                                                <option value='Aviation & Aerospace'>Aviation & Aerospace</option>
                                                <option value='Banking'>Banking</option>
                                                <option value='Biotechnology'>Biotechnology</option>
                                                <option value='Broadcast Media'>Broadcast Media</option>
                                                <option value='Building Materials'>Building Materials</option>
                                                <option value='Business Supplies and Equipment'>Business Supplies and Equipment</option>
                                                <option value='Capital Markets'>Capital Markets</option>
                                                <option value='Chemicals'>Chemicals</option>
                                                <option value='Civic &  Social Organization'>Civic & Social Organization</option>
                                                <option value='Civil Engineering'>Civil Engineering</option>
                                                <option value='Commercial Real Estate'>Commercial Real Estate</option>
                                                <option value='Computer & Network Security'>Computer & Network Security</option>
                                                <option value='Computer Games'>Computer Games</option>
                                                <option value='Computer Hardware'>Computer Hardware</option>
                                                <option value='Computer Networking'>Computer Networking</option>
                                                <option value='Computer Software'>Computer Software</option>
                                                <option value='Construction'>Construction</option>
                                                <option value='Consumer Electronics'>Consumer Electronics</option>
                                                <option value='Consumer Goods'>Consumer Goods</option>
                                                <option value='Consumer Services'>Consumer Services</option>
                                                <option value='Cosmetics'>Cosmetics</option>
                                                <option value='Dairy'>Dairy</option>
                                                <option value='Defense & Space'>Defense & Space</option>
                                                <option value='Design'>Design</option>
                                                <option value='Education Management'>Education Management</option>
                                                <option value='E-Learning'>E-Learning</option>
                                                <option value='Electrical/Electronic Manufacturing'>Electrical/Electronic Manufacturing</option>
                                                <option value='Entertainment'>Entertainment</option>
                                                <option value='Environmental Services'>Environmental Services</option>
                                                <option value='Events Services'>Events Services</option>
                                                <option value='Executive Office'>Executive Office</option>
                                                <option value='Facilities Services'>Facilities Services</option>
                                                <option value='Farming'>Farming</option>
                                                <option value='Financial Services'>Financial Services</option>
                                                <option value='Fine Art'>Fine Art</option>
                                                <option value='Fishery'>Fishery</option>
                                                <option value='Food & Beverages'>Food & Beverages</option>
                                                <option value='Food Production'>Food Production</option>
                                                <option value='Fund-Raising'>Fund-Raising</option>
                                                <option value='Furniture'>Furniture</option>
                                                <option value='Gambling & Casinos'>Gambling & Casinos</option>
                                                <option value='Glass, Ceramics & Concrete'>Glass, Ceramics & Concrete</option>
                                                <option value='Government Administration'>Government Administration</option>
                                                <option value='Government Relations'>Government Relations</option>
                                                <option value='Graphic Design'>Graphic Design</option>
                                                <option value='Health, Wellness and Fitness'>Health, Wellness and Fitness</option>
                                                <option value='Higher Education'>Higher Education</option>
                                                <option value='Hospital &amp; Health Care'>Hospital &amp; Health Care</option>
                                                <option value='Hospitality'>Hospitality</option>
                                                <option value='Human Resources'>Human Resources</option>
                                                <option value='Import and Export'>Import and Export</option>
                                                <option value='Individual & Family Services'>Individual & Family Services</option>
                                                <option value='Industrial Automation'>Industrial Automation</option>
                                                <option value='Information Services'>Information Services</option>
                                                <option value='Information Technology and Services'>Information Technology and Services</option>
                                                <option value='Insurance'>Insurance</option>
                                                <option value='International Affairs'>International Affairs</option>
                                                <option value='International Trade and Development'>International Trade and Development</option>
                                                <option value='Internet'>Internet</option>
                                                <option value='Investment Banking'>Investment Banking</option>
                                                <option value='Investment Management'>Investment Management</option>
                                                <option value='Judiciary'>Judiciary</option>
                                                <option value='Law Enforcement'>Law Enforcement</option>
                                                <option value='Law Practice'>Law Practice</option>
                                                <option value='Legal Services'>Legal Services</option>
                                                <option value='Legislative Office'>Legislative Office</option>
                                                <option value='Leisure, Travel & Tourism'>Leisure, Travel & Tourism</option>
                                                <option value='Libraries'>Libraries</option>
                                                <option value='Logistics and Supply Chain'>Logistics and Supply Chain</option>
                                                <option value='Luxury Goods & Jewelry'>Luxury Goods & Jewelry</option>
                                                <option value='Machinery'>Machinery</option>
                                                <option value='Management Consulting'>Management Consulting</option>
                                                <option value='Maritime'>Maritime</option>
                                                <option value='Marketing and Advertising'>Marketing and Advertising</option>
                                                <option value='Market Research'>Market Research</option>
                                                <option value='Mechanical or Industrial Engineering'>Mechanical or Industrial Engineering</option>
                                                <option value='Media Production'>Media Production</option>
                                                <option value='Medical Devices'>Medical Devices</option>
                                                <option value='Medical Practice'>Medical Practice</option>
                                                <option value='Mental Health Care'>Mental Health Care</option>
                                                <option value='Military'>Military</option>
                                                <option value='Mining & Metals'>Mining & Metals</option>
                                                <option value='Motion Pictures and Film'>Motion Pictures and Film</option>
                                                <option value='Museums and Institutions'>Museums and Institutions</option>
                                                <option value='Music'>Music</option>
                                                <option value='Nanotechnology'>Nanotechnology</option>
                                                <option value='Newspapers'>Newspapers</option>
                                                <option value='Nonprofit Organization Management'>Nonprofit Organization Management</option>
                                                <option value='Oil & Energy'>Oil & Energy</option>
                                                <option value='Online Media'>Online Media</option>
                                                <option value='Outsourcing/Offshoring'>Outsourcing/Offshoring</option>
                                                <option value='Package/Freight Delivery'>Package/Freight Delivery</option>
                                                <option value='Packaging and Containers'>Packaging and Containers</option>
                                                <option value='Paper & Forest Products'>Paper & Forest Products</option>
                                                <option value='Performing Arts'>Performing Arts</option>
                                                <option value='Pharmaceuticals'>Pharmaceuticals</option>
                                                <option value='Philanthropy'>Philanthropy</option>
                                                <option value='Photography'>Photography</option>
                                                <option value='Plastics'>Plastics</option>
                                                <option value='Political Organization'>Political Organization</option>
                                                <option value='Primary/Secondary Education'>Primary/Secondary Education</option>
                                                <option value='Printing'>Printing</option>
                                                <option value='Professional Training & Coaching'>Professional Training & Coaching</option>
                                                <option value='Program Development/Software Engineering '>Program Development/Software Engineering</option>
                                                <option value='Public Policy'>Public Policy</option>
                                                <option value='Public Relations and Communications'>Public Relations and Communications</option>
                                                <option value='Public Safety'>Public Safety</option>
                                                <option value='Publishing'>Publishing</option>
                                                <option value='Railroad Manufacture'>Railroad Manufacture</option>
                                                <option value='Ranching'>Ranching</option>
                                                <option value='Real Estate'>Real Estate</option>
                                                <option value='Recreational Facilities and Services'>Recreational Facilities and Services</option>
                                                <option value='Religious Institutions'>Religious Institutions</option>
                                                <option value='Renewables & Environment'>Renewables & Environment</option>
                                                <option value='Research'>Research</option>
                                                <option value='Restaurants'>Restaurants</option>
                                                <option value='Retail'>Retail</option>
                                                <option value='Security and Investigations'>Security and Investigations</option>
                                                <option value='Semiconductors'>Semiconductors</option>
                                                <option value='Shipbuilding'>Shipbuilding</option>
                                                <option value='Sporting Goods'>Sporting Goods</option>
                                                <option value='Sports'>Sports</option>
                                                <option value='Staffing and Recruiting'>Staffing and Recruiting</option>
                                                <option value='Supermarkets'>Supermarkets</option>
                                                <option value='Telecommunications'>Telecommunications</option>
                                                <option value='Textiles'>Textiles</option>
                                                <option value='Think Tanks'>Think Tanks</option>
                                                <option value='Tobacco'>Tobacco</option>
                                                <option value='Translation and Localization'>Translation and Localization</option>
                                                <option value='Transportation/Trucking/Railroad'>Transportation/Trucking/Railroad</option>
                                                <option value='Utilities'>Utilities</option>
                                                <option value='Venture Capital & Private Equity'>Venture Capital & Private Equity</option>
                                                <option value='Veterinary'>Veterinary</option>
                                                <option value='Warehousing'>Warehousing</option>
                                                <option value='Wholesale'>Wholesale</option>
                                                <option value='Wine and Spirits'>Wine and Spirits</option>
                                                <option value='Wireless'>Wireless</option>
                                                <option value='Writing and Editing'>Writing and Editing</option>

                                            </select>
                                        </div>

										<script language="javascript">
											populateCountries("register_country", "register_state");
										</script>

										{{-- <br /> --}}
									    <div class="errresponse text-danger text-center disp-0"><p></p></div>
									    <img src="{{ asset('asset/img/loader.svg') }}" alt="" class="loaderabs disp-0" />
										<button type="submit" class="btnRegister btn btn-primary pull-right">Continue to next
											<img src="{{ asset('asset/img/loader.svg') }}" alt="" class="loaderabs disp-0" />
										</button>

                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade show" id="stage2">
                                <h3  class="register-heading">Account Setup</h3>
                                <div class="row register-form">
                                    <div class="col-md-6">
									  <div class="form-group row">
									    <label for="account_username" class="col-sm-12 col-form-label">Username</label>
									    <div class="col-sm-12">
									      <input type="text" class="form-control" id="account_username" placeholder="" required="">
									    </div>
									  </div>

									  <div class="form-group row">
									    <label for="account_password" class="col-sm-12 col-form-label">Password</label>
									    <div class="col-sm-12">
									      <input type="password" class="form-control" id="account_password" placeholder="Password" required="">
									    </div>
									  </div>
                                    </div>
                                    <div class="col-md-6">
										  <div class="form-group row">
										    <label for="security" class="col-sm-12 col-form-label">Set Security Question
										    	<br />
										    	<span class="text-danger" style="font-size: 13px;">* Helps you access your account without reset</span></label>
										    <div class="col-sm-12">
										      <input type="text" class="form-control" id="security" placeholder="E.g Your year of birth" required="">
										    </div>
										  </div>

										  <div class="form-group row">
										    <label for="answer" class="col-sm-12 col-form-label">Set Security Answer</label>
										    <div class="col-sm-12">
										      <input type="text" class="form-control" id="answer" placeholder="1984" required="">
										    </div>
										  </div>

									    <div class="errresponseaccount text-danger text-center disp-0"><p></p></div>
									  	<img src="{{ asset('asset/img/loader.svg') }}" alt="" class="loaderabs disp-0" />
									    <button type="submit" class="btn btn-primary pull-right" style="width: 100%;">Finish <img src="{{ asset('asset/img/loaders/Cube-1s-200px.svg') }}" class="disp-0"></button>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade show" id="stage3">
                                <h3  class="register-heading">Account Setup</h3>
                                <div class="row register-form" style="padding-top: 0px;">
                                    <div class="col-md-12">
									  <span id="demo3"></span>
										<form>
											<div class="intro-img">
												<center><img src="{{ asset('asset/img/done.png') }}" alt="" class="img-fluid"></center>
											</div>
											<br />
											<br />

										<center>
											<h3>Sign Up & Account Setup Completed</h3>
											<hr />
											<img src="{{ asset('asset/img/loader.svg') }}" alt="" class="loaderabs disp-0" />
											<button type="button" class="btn btn-success btn-md" title="Proceed to Application" id="launch">Launch</button>
											<button type="button" class="btn btn-info btn-md" title="Restart Signup" id="retry">Restart</button>
											<button type="button" class="btn btn-danger btn-md closeAll" title="Close: Would login later to application">Exit</button>
										</center>
										</form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

</div>



<div id="profile" class="modal">
	<center>
	<br />
	<br />
	<br />
	<img src="{{ asset('asset/img/testimonial-2.jpg') }}" id="profileresimage" alt="{{ ucwords('Ola') }}"  style="width: 160px; height: 160px; border-radius: 1000px; margin-top: -50px;box-shadow: 0px 0px 30px #004a99c2;">
	<br />
	<br />
	<h4 class="fancy"><span id="profileresfirstname"></span>&nbsp;&nbsp;<span id="profilereslastname"></span></h4>
	</center>
	<hr />
    <table class="table update_table text-center">
      <tr>
        <td class="text-left" style="padding: 1px;">Profession</td>
      </tr>
      <tr>
      	<td style="padding: 1px;">&nbsp;&nbsp;&nbsp;&nbsp;<span id="profileresprofession"></span></td>
      </tr>
      <tr>
        <td class="text-left" style="padding: 1px;">City</td>
      </tr>
      <tr>
        <td style="padding: 1px;">
          &nbsp;&nbsp;&nbsp;&nbsp;<span id="profilerescity"></span>
          <span id="profileresstate"></span>
        </td>
      </tr>
      <tr>
        <td class="text-left" style="padding: 1px;">Country</td>
      </tr>
      <tr>
      	<td style="padding: 1px;">&nbsp;&nbsp;&nbsp;&nbsp;<span id="profilerescountry"></span></td>
      </tr>
    </table>

	<br />
</div>

{{-- Message  --}}
<div id="message" class="modal" style="padding: 8px;">

	<form>
	<center class="fancy">
		<br />
		<br />
		<br />
		<img src="{{ asset('asset/img/testimonial-2.jpg') }}" id="contactimage{{ 1 }}" alt="{{ ucwords('Ola') }}"  style="width: 160px; height: 160px; border-radius: 1000px; margin-top: -50px;box-shadow: 0px 0px 30px #004a99c2;">
		<br/>
		<br/>
		<span id="messagefirstname"></span> <span id="messagefirstname"></span>
		<br />
		<span id="messageprofession"></span>
		<br />
		<span id="messagestate"></span> <span id="messagecountry"></span>
	</center>

	<br />
	  <div class="form-group row">
	    <div class="col-sm-12">
	      <textarea name="message" id="composemessage" placeholder="Send a message now {{ ucwords(session('prochatr_firstname')) }}..." class="form-control" rows="6" style="resize: none;" class="fancy"></textarea>
	    </div>
	  </div>
	  <img src="{{ asset('asset/img/loader.svg') }}" alt="" class="loaderabs disp-0" />
	    <button type="button" onclick="sendMessage()" class="btn btn-primary pull-right" style="width: 100%;">Submit </button>
	</form>
	<br />
	<br />
	<br />
</div>

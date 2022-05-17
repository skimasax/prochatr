@extends('layouts.default')
@section('content')

    @include('includes.toplow_dashboard')
<style type="text/css" media="screen">
  .noshow > hr,.noshow > small{display: none;}
</style>
  <main id="main">

    <section id="dashboard_options">
        @if ($companylogo == "")
            {{-- Trigger Toast For Company Image upload --}}
            <button type="button" class="disp-0" onclick="uploadLogo('{{ session('prochatr_login_id') }}')" id="coylogobtn">Click Modal</button>
        @endif

      <div class="container">
        <div class="row about-container">
          <div class="col-md-6 col-lg-5 offset-lg-1 wow " id="component1" data-wow-duration="1.4s">
            <div class="box">
              <div class="icon"><i class="ion-ios-people" style="color: #ff689b;"></i></div>
              <h4 class="title"><span>Add Contacts</span></h4>
              <p class="description">Increase your reach by adding prochatr users to your connection list.</p>
            </div>
          </div>

          <div class="col-md-6 col-lg-5 wow " id="component2" data-wow-duration="1.4s">
            <div class="box">
              <div class="icon"><i class="ion-ios-bookmarks-outline" style="color: #e9bf06;"></i></div>
              <h4 class="title"><span>Invite</span></h4>
              <p class="description">Invite a preference or invite from our enormous connection list.</p>
            </div>
          </div>

          <div class="col-md-6 col-lg-5 offset-lg-1 wow " id="component3" data-wow-delay="0.1s" data-wow-duration="1.4s">
            <div class="box">
              <div class="icon"><i class="ion-ios-paper-outline" style="color: #3fcdc7;"></i></div>
              <h4 class="title"><span>Account</span></h4>
              <p class="description">Change your prochatr information to be more up to date.</p>
            </div>
          </div>

          <div class="col-md-6 col-lg-5 wow " id="component4" data-wow-delay="0.2s" data-wow-duration="1.4s">
            <div class="box">
              <div class="icon"><i class="ion-ios-world-outline" style="color: #d6ff22;"></i></div>
              <h4 class="title"><span>Connections</span></h4>
              <p class="description">View all you contacts. Know who you have in your connection network.</p>
            </div>
          </div>

          <div class="col-md-6 col-lg-5 offset-lg-1 wow " id="component5" data-wow-delay="0.2s" data-wow-duration="1.4s">
            <div style="width: 110px; background: #cb2027; position: absolute; z-index: 1; color: #FFF; right: 40px; text-align: center; border-radius: 0px 0px 10px 10px; font-weight: bold;">Coming soon</div>
            <div class="box">
              <div class="icon"><i class="ion-android-chat" style="color: #ff5722c2;"></i></div>
              <h4 class="title"><span>Groups</span></h4>
              <p class="description">Check existing groups and see their users.</p>
            </div>
          </div>

          <div class="col-md-6 col-lg-5 wow " id="component6" data-wow-delay="0.2s" data-wow-duration="1.4s">
            <div style="width: 110px; background: #cb2027; position: absolute; z-index: 1; color: #FFF; right: 40px; text-align: center; border-radius: 0px 0px 10px 10px; font-weight: bold;">Coming soon</div>
            <div class="box">
              <div class="icon"><i class="ion-android-call" style="color: #607d8bd4;"></i></div>
              <h4 class="title"><span>Call</span></h4>
              <p class="description">Call your contacts now.</p>
            </div>
          </div>

          <div class="col-md-6 col-lg-5 offset-lg-1 wow " id="component7" data-wow-delay="0.2s" data-wow-duration="1.4s">
            <div class="box">
              <div class="icon"><i class="ion-android-settings" style="color: #03a9f4;"></i></div>
              <h4 class="title"><span>Settings</span></h4>
              <p class="description">Prevent login to your account and set your privacy setting amidst others.</p>
            </div>
          </div>

          <div class="col-md-6 col-lg-5 wow " id="component8" data-wow-delay="0.2s" data-wow-duration="1.4s">
            <div class="box">
              <div class="icon"><i class="ion-android-chat" style="color: #4caf50c7;"></i></div>
              <h4 class="title"><span>Chat</span></h4>
              <p class="description">Proceed to the chat environment. See your chats, respond in realtime, create groups.</p>
            </div>
          </div>

          <div class="col-md-6 col-lg-5 offset-lg-1 wow " id="component9" data-wow-delay="0.2s" data-wow-duration="1.4s">
            <div class="box">
              <div class="icon"><i class="ion-android-cloud" style="color: #cb2027b8;"></i></div>
              <h4 class="title"><span>Suggestions & Update</span></h4>
              <p class="description">Find out people who matches your needs and update your needs.</p>
            </div>
          </div>

          <div class="col-md-6 col-lg-5 wow " id="component10" data-wow-delay="0.2s" data-wow-duration="1.4s">
            <div class="box">
              <div class="icon"><i class="ion-android-desktop" style="color: #afac4cd1;"></i></div>
              <h4 class="title"><span>More Connections</span></h4>
              <p class="description">Find out connections you might be interested in accross all interest.</p>
            </div>
          </div>

        </div>
      </div>

      {{-- Components --}}
      <div class="container-fluid disp-0 wow " id="components">
        {{-- <center><img src="{{ asset('asset/img/logo/pname.png') }}" alt="" class="img-fluid adjustlogin"></center> --}}
        <div class="row about-container text-center disp-0 component1">
          {{-- <div class="col-md-12 col-sm-12 col-xs-12 label"><h5>Add Contacts</h5></div> --}}
          <div class="col-md-12" style="background: #EEE; padding: 10px;">
            <div class="container-fluid">
              <div class="row addContact addC">
                {{-- <div style="position: absolute; width: auto; padding: 10px; background: #eeeeee; margin-top: -50px; margin-left: -5px; border-radius: 10px 10px 0px 0px;">Prochatr Users</div> --}}
                <div class="col-md-6">
                  <span class="toggleAdd toggleAdd1"><img src="{{ asset('asset/img/toggle-on.png') }}" style="width: 60px;"></span>
                  <span class="titleName"><span>Prochatr Users</span></span>
                  <span id="itemremoved"></span>
                  {{-- Check Subscription --}}
                  @if($checkSubscription = App\Active::where('login_id', session('prochatr_login_id'))->get())
                  @endif
                  {{-- End of Global Subscription Check --}}
                  @if(count($checkSubscription) > 0)
                  @if($UserList = App\Personal_detail::join('accounts', 'accounts.login_id', '=', 'personal_details.user_id')->where('accounts.login_id', '!=', session('prochatr_login_id'))->get())

                    @if(count($UserList) > 0)
                      @foreach($UserList as $user)
                      <!-- Left-aligned -->
                      @if($NonConnected = App\Connection::where('connection_id', $user->user_id)->where('connections.login_id', session('prochatr_login_id'))->get())
                      @if( count($NonConnected) < 1 )
                      <div class="media add" id="media{{ $user->login_id }}">
                          <div class="media-left">
                            @if($user->image == "profile.png" || null == $user->image)
                                <img src="{{ asset('asset/img/user.png') }}" id="contactimage{{ $user->login_id }}" alt="{{ ucwords($user->firstname) }}" class="media-object" />
                            @else
                                <img src="{{ $user->image }}" id="contactimage{{ $user->login_id }}" alt="{{ ucwords($user->firstname) }}" class="media-object" />
                            @endif

                          </div>
                          <div class="media-body dash">
                            <h4 class="media-heading">
                              <span id="contactfirstname{{ $user->login_id }}">{{ ucwords($user->firstname) }}</span>
                              <span id="contactlastname{{ $user->login_id }}">{{ ucwords($user->lastname) }}</span>
                              <br />
                              {{-- <div class="{{ $user->state }}"></div> --}}
                              <span class="badge @if($user->state == "Online") badge-success @else badge-warning @endif">
                                @if($user->state == "Online") Online @else Offline @endif
                              </span>
                              <small id="contactprofession{{ $user->login_id }}"  class="noshow">
                                {{ ucwords($user->profession) }}
                                @if(null != $user->profession)
                                <hr />
                                <small> At {{ ucwords($user->company) }}</small>
                                @endif
                              </small>
                              <br />
                              <small id="contactcity{{ $user->login_id }}">{{ ucwords($user->city) }}</small>
                              <small id="contactstate{{ $user->login_id }}">{{ ucwords($user->country) }}</small>
                            </h4>
                          </div>
                          <button class="btn btn-xs btn-danger" onclick="showProfile('{{ $user->login_id }}', 'contact')" style="border-radius: 10px 0px 0px 10px;">Profile</button>
                          <button class="btn btn-xs btn-success" id="{{ $user->login_id }}" onclick="addThis('{{ $user->login_id }}')" style="border-radius: 0px 10px 10px 0px;">Add</button>
                      </div>
                      @else
                      @endif
                      @endif
                      @endforeach
                      <br />
                      <a href="{{ route('main.setup', '_connection=true') }}"target="_BLANK"><button class="btn btn-primary" type="button">View More Connections</button></a>
                    @else
                    <div id="addInfo">
                      <img src="{{ asset('asset/img/empty-box.png') }}">
                      <br />
                      <br />
                      No User Found
                      <hr />
                      import from other sources?
                      <br />
                      <br />
                      <a href="https://accounts.google.com/o/oauth2/auth?client_id=950089246071-4n54jjosvme0oufrgh3huq362rra7uqg.apps.googleusercontent.com&redirect_uri=https://prochatr.com/app/oauth&scope=https://www.google.com/m8/feeds/&response_type=code"><button type="button" class="btn btn-xs import" style="background: #000; color: #FFF;">Google<img src="{{ asset('asset/img/google.png') }}" style="width: 28px;"></button></a><button type="button" class="btn btn-info btn-xs import excel">Excel<img src="{{ asset('asset/img/excel.png') }}" style="width: 28px;"></button>
                    </div>
                    @endif
                  @endif
                  @else

                  

                    

                  {{-- IF Subscription is Null --}}
                    <div id="addInfo">
                      <img src="{{ asset('asset/img/subscribe.png') }}" style="width: 100px; height: 100px; border-radius: 100px;">
                      <br />
                      <br />
                      Thousands of Users Awaiting you
                      <br />
                      <br />
                      <button type="button" class="btn btn-primary" onclick="triggerSubscribe()">SUBSCRIBE NOW</button>
                      <hr />
                      Import from other sources?
                      <br />
                      <br />
                      <a href="https://accounts.google.com/o/oauth2/auth?client_id=950089246071-4n54jjosvme0oufrgh3huq362rra7uqg.apps.googleusercontent.com&redirect_uri=https://prochatr.com/app/oauth&scope=https://www.google.com/m8/feeds/&response_type=code"><button type="button" class="btn btn-xs import" style="background: #000; color: #FFF;">Google<img src="{{ asset('asset/img/google.png') }}" style="width: 28px;"></button></a><button type="button" class="btn btn-info btn-xs import excel">Excel<img src="{{ asset('asset/img/excel.png') }}" style="width: 28px;"></button>
                      
                    </div>

                    <div class="col-md-12">
            
                      <div class="table table-responsive">
                        <table class="table table-striped table-bordered" id="myTable">
                          <thead>
                            <tr>
                              <th>#</th>
                              <th>Name</th>
                              {{-- <th>Email</th> --}}
                              <th>Company</th>
                              <th>Position</th>
                              <th>Action</th>
                            </tr>
                          </thead>
            
                          <tbody>
                            @if (count($linkedinlist) > 0) 
                            @php
                              $i = 1;    
                            @endphp
                            @foreach ($linkedinlist as $item)
                            <tr>
                              <td>{{ $i++ }}</td>
                              <td>{{ $item->First_Name.' '.$item->Last_Name }}</td>
                              {{-- <td>{{ $item->Email_Address }}</td> --}}
                              <td>{{ $item->Company }}</td>
                              <td>{{ $item->Position }}</td>
                              <td>
                                <button class="btn btn-primary btn-block" onclick="triggerSubscribe()">Connect</button>
                              </td>
                            </tr>
                            @endforeach
          
                            @else
                                <tr>
                                  <td colspan="6" align="center">No record</td>
                                </tr>
                            @endif
                            
                          </tbody>
                        </table>
                      </div>
                    
                    </div>

                  @endif
                  {{-- END OF LIST --}}

                </div>

                
                <div class="col-md-6">
                  <span class="toggleAdd toggleAdd2"><img src="{{ asset('asset/img/toggle-on.png') }}" style="width: 60px;"></span>
                  <span class="titleName"><span>My Connections</span></span>
                  <span id="iteminsert"></span>

                  @if($UserList = App\Personal_detail::join('connections', 'connections.connection_id', '=', 'personal_details.user_id')->where('connections.connection_id', '!=', session('prochatr_login_id'))->where('connections.login_id', session('prochatr_login_id'))->get())
                    @if(count($UserList) > 0)
                      @foreach($UserList as $user)
                      <!-- Left-aligned -->
                      <div class="media add" id="media{{ $user->user_id }}">
                          <div class="media-left">
                            {{-- <div class="{{ $user->state }}"></div> --}}
                            @if($user->image == "profile.png" || null == $user->image)
                                <img src="{{ asset('asset/img/user.png') }}" id="contactimage{{ $user->user_id }}" alt="{{ ucwords($user->firstname) }}" class="media-object">
                            @else
                                <img src="{{ $user->image }}" id="contactimage{{ $user->user_id }}" alt="{{ ucwords($user->firstname) }}" class="media-object">
                            @endif
                          </div>
                          <div class="media-body dash">
                            <h4 class="media-heading">
                              <span id="contactfirstname{{ $user->user_id }}">{{ ucwords($user->firstname) }}</span>
                              <span id="contactlastname{{ $user->user_id }}">{{ ucwords($user->lastname) }}</span>
                              <br />
                              <span class="badge @if($user->state == "Online") badge-success @else badge-warning @endif">
                                @if($user->state == "Online") Online @else Offline @endif
                              </span>
                              <small id="contactprofession{{ $user->user_id }}"  class="noshow">
                                {{ ucwords($user->profession) }}
                                @if(null != $user->profession)
                                <hr />
                                <small> At {{ ucwords($user->company) }}</small>
                                @endif
                              </small>
                              <br />
                              <small id="contactcity{{ $user->user_id }}">{{ ucwords($user->city) }}</small>
                              <small id="contactstate{{ $user->user_id }}">{{ ucwords($user->country) }}</small>

                            </h4>
                          </div>
                          <button class="btn btn-xs btn-success" onclick="showProfile('{{ $user->user_id }}', 'contact')" style="border-radius: 10px 0px 0px 10px;">View</button>
                          <button class="btn btn-xs btn-danger" id="{{ $user->user_id }}" onclick="removeThis('{{ $user->user_id }}')" style="border-radius: 0px 10px 10px 0px;">Remove</button>
                      </div>
                      @endforeach
                    @else
                    <div id="removeInfo">
                      <br />
                      <div class="col-md-12 text-center">
                        <h1>::0::</h1>
                      </div>
                      <img src="{{ asset('asset/img/empty-box.png') }}">
                      <br />
                      <br />
                      No User Found In Your Connection List
                      <hr />
                      Add From Our Database
                      <br />or<br />import from other sources?
                      <br />
                      <br />
                      <a href="https://accounts.google.com/o/oauth2/auth?client_id=950089246071-4n54jjosvme0oufrgh3huq362rra7uqg.apps.googleusercontent.com&redirect_uri=https://prochatr.com/app/oauth&scope=https://www.google.com/m8/feeds/&response_type=code"><button type="button" class="btn btn-xs import" style="background: #000; color: #FFF;"><img src="{{ asset('asset/img/loader.svg') }}" alt="" class="loaderabs disp-0" />Google<img src="{{ asset('asset/img/google.png') }}" style="width: 28px;"></button></a><button type="button" class="btn btn-info btn-xs import excel"><img src="{{ asset('asset/img/loader.svg') }}" alt="" class="loaderabs disp-0" />Excel<img src="{{ asset('asset/img/excel.png') }}" style="width: 28px;"></button>
                    </div>

                    @endif
                  @endif
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="row about-container text-center disp-0 component2" style="background: #FFF;">
          <div class="col-md-12 label"><h5>Invite</h5><hr /></div>
          <div class="col-md-4 col-sm-5" style="margin: auto;"></div>
        </div>

        <div class="row about-container text-center disp-0 component3">
          <div class="col-md-12" style="background: #EEE; padding: 10px;">
            <div class="container-fluid">
              <div class="row addContact editThis">
                @if($UserList = App\Personal_detail::join('accounts', 'accounts.login_id', '=', 'personal_details.user_id')->where('accounts.login_id', session('prochatr_login_id'))->limit(1)->get())
                  @if(count($UserList) > 0)
                <div class="col-md-3" style="height: 93vh; padding: 0px; overflow-y: auto;">
                  <center>
                    <div style="background: #EEE; height: 190px;margin-bottom: 65px;">
                      <img src="@if(session('prochatr_image') == "profile.png") {{ asset('asset/img/user.png') }} @else {{ session('prochatr_image') }} @endif" id="profileimage" class="img img-responsive" alt="" />
                    </div>

                    <div style="" title="Use a preferred image" id="changeimage">Change</div>
                    <div style="" title="Replace profile image with default" id="resetimage">Remove</div>
                    <table class="table update_table">
                      <tr>
                        <td class="text-left"><img src="{{ asset('asset/img/user.png') }}" style="width: 13px; margin-right: 5px;" />Name</td>
                        <td class="text-right">
                          <span id="profilefirstname" class="text-right">{{ $UserList[0]->firstname }}</span>
                          <span id="profilelastname" class="text-right">{{ $UserList[0]->lastname }}</span>
                        </td>
                      </tr>
                      <tr>
                        <td class="text-left"><img src="{{ asset('asset/img/attachment.svg') }}" style="width: 13px; margin-right: 5px;" />Profession</td><td class="text-right"><span id="profession" class="text-right">{{ $UserList[0]->profession }}</span></td>
                      </tr>
                      <tr>
                        <td class="text-left"><img src="{{ asset('asset/img/network.svg') }}" style="width: 13px; margin-right: 5px;" />City</td>
                        <td class="text-right">
                          <span id="profilecity" class="text-right">{{ $UserList[0]->city }}</span>
                        </td>
                      </tr>
                      <tr>
                        <td class="text-left"><img src="{{ asset('asset/img/network.svg') }}" style="width: 13px; margin-right: 5px;" />Province/State</td>
                        <td class="text-right">
                          <span id="profilestate" class="text-right">{{ $UserList[0]->cstate }}</span>
                        </td>
                      </tr>
                      <tr>
                        <td class="text-left"><img src="{{ asset('asset/img/hat.svg') }}" style="width: 13px; margin-right: 5px;" />Country</td><td class="text-right"><span id="country" class="text-right">{{ $UserList[0]->country }}</span></td>
                      </tr>
                      <tr>
                        <td class="text-left"><img src="{{ asset('asset/img/shield.svg') }}" style="width: 13px; margin-right: 5px;" />PIN</td><td class="text-right"><span id="name" class="text-right">{{ $UserList[0]->login_id }}</span></td>
                      </tr>
                    </table>



                  <hr>
                    <div style="margin-top: -30px;">

                      <img src="https://image.flaticon.com/icons/svg/745/745003.svg" alt="" style="width: 100px; height: 100px; float: left;">
                  @if($BadgePoint = App\Badge::where('login_id', session('prochatr_login_id'))->get())
                    @if(count($BadgePoint) > 0)
                    <?php
                    $badgevalue = ($BadgePoint[0]->Invite+$BadgePoint[0]->Contact+$BadgePoint[0]->Voice+$BadgePoint[0]->Video+$BadgePoint[0]->Messaging+$BadgePoint[0]->Groups+$BadgePoint[0]->Conference)/100;

                    $badgeindex = ($BadgePoint[0]->Invite+$BadgePoint[0]->Contact+$BadgePoint[0]->Voice+$BadgePoint[0]->Video+$BadgePoint[0]->Messaging+$BadgePoint[0]->Groups+$BadgePoint[0]->Conference)/(100*2);
                    ?>
                    @else
                    <?php $badgevalue = 0; $badgeindex = 0; ?>
                    @endif
                  @endif
                      <br />Badge Points: <span style="font-weight: bold; font-size: 20px;">{{ $badgevalue }}</span>
                      <br/>All Time Index: <span style="font-weight: bold; font-size: 20px;">{{ $badgeindex }}</span>
                      <br />
                    </div>

                  </center>
                </div>
                <div class="col-md-6" style="background: transparent;">

<!-- Material form register -->
<div class="card">

    <h5 class="card-header info-color white-text text-center py-4">
        <strong>Edit Information</strong>
    </h5>

    <!--Card content-->
    <div class="card-body px-lg-5 pt-0">
      <br />
        <!-- Form -->
        <form action="#" class="text-center" style="color: #757575;" id="update_form">

          <fieldset class="the-fieldset">
              <legend class="the-legend">Personal Details</legend>
              <div class="form-row editrows">
                  <div class="col">
                      <!-- First name -->
                      <div class="md-form text-left">
                        <label for="update_firstname">First name</label>
                        <input type="text" id="update_firstname" class="form-control" value="{{ $UserList[0]->firstname }}">
                      </div>
                  </div>
                  <div class="col">
                      <!-- Last name -->
                      <div class="md-form text-left">
                        <label for="update_lastname">Last name</label>
                        <input type="text" id="update_lastname" class="form-control" value="{{ $UserList[0]->lastname }}">
                      </div>
                  </div>
              </div>
          </fieldset>
          <br>
          <fieldset class="the-fieldset">
              <legend class="the-legend">Contact Details</legend>
              <div class="form-row editrows">
                  <div class="col">
                      <!-- First name -->
                      <div class="md-form text-left">
                        <label for="update_email">Email</label>
                        <input type="email" id="update_email" class="form-control" value="{{ $UserList[0]->email }}">
                      </div>
                  </div>
                  <div class="col">
                      <!-- Last name -->
                      <div class="md-form text-left">
                        <label for="update_phone">Phone</label>
                        <input type="number" id="update_phone" class="form-control" value="{{ $UserList[0]->phone }}">
                      </div>
                  </div>
              </div>
          </fieldset>
          <br>
          <fieldset class="the-fieldset">
              <legend class="the-legend">Occupational Details</legend>
              <div class="form-row editrows">
                  <div class="col-12">
                      <!-- First name -->
                      <div class="md-form text-left">
                        <label for="update_company">Company</label>
                        <input type="text" id="update_company" class="form-control" value="{{ $UserList[0]->company }}">
                      </div>
                  </div>
                  <div class="col">
                      <!-- First name -->
                      <div class="md-form text-left">
                        <label for="update_profession">Profession</label>
                        <input type="text" id="update_profession" class="form-control" value="{{ $UserList[0]->profession }}">
                      </div>
                  </div>
                  <div class="col">
                      <!-- Last name -->
                      <div class="md-form text-left">
                        <label for="update_position">Position</label>
                        <input type="text" id="update_position" class="form-control" value="{{ $UserList[0]->position }}">
                      </div>
                  </div>
              </div>
               @if ($companylogo != "")
              <div class="form-row editrows">
                  <div class="col-12">
                      <!-- First name -->
                      <div class="md-form text-left">
                        <label for="update_company">Update Company Logo</label>
                        {{-- Trigger Toast For Company Image upload --}}

                            <button class="btn btn-outline-info btn-rounded btn-block my-4 waves-effect z-depth-0" type="button" onclick="uploadLogo('{{ session('prochatr_login_id') }}')">Open dialog</button>
                      </div>
                  </div>

              </div>
              @endif
          </fieldset>
          <br>
          <fieldset class="the-fieldset">
              <legend class="the-legend">Location Details</legend>
              <div class="form-row editrows">
                  <div class="col-12">
                      <!-- First name -->
                      <div class="md-form text-left">
                        <label for="update_country">Country</label>
                        <input type="text" id="update_country" class="form-control" value="{{ $UserList[0]->country }}">
                      </div>
                  </div>
              </div>
              <div class="form-row editrows">
                  <div class="col">
                      <!-- First name -->
                      <div class="md-form text-left">
                        <label for="update_state">Province/State</label>
                        <input type="text" id="update_state" class="form-control" value="{{ $UserList[0]->cstate }}">
                      </div>
                  </div>
                  <div class="col">
                      <!-- Last name -->
                      <div class="md-form text-left">
                        <label for="update_city">City</label>
                        <input type="text" id="update_city" class="form-control" value="{{ $UserList[0]->city }}">
                      </div>
                  </div>
              </div>
          </fieldset>

            <!-- Sign up button -->
            <button class="btn btn-outline-info btn-rounded btn-block my-4 waves-effect z-depth-0" type="button">Update</button>

            <hr>

            <!-- Terms of service -->
            <p>By clicking
                <em>update</em> your published information would be updated
                <a href="{{ route('main.terms') }}" target="_blank">terms of service</a>

        </form>
        <!-- Form -->

    </div>

</div>
<!-- Material form register -->

                </div>
                <div class="col-md-3 hidden-sm hidden-xs" style="backgroudnd: url('https://www.sccpre.cat/mypng/detail/25-257320_sunny-sky-products-graphic-design.png'); background-size: contain;">
                  <div class="container-fluid">
                    <div class="row">
                      <div class="col-md-12" style="padding: 10px; background: #000; color: #FFF;">Activity Thread</div>
                    </div>
                    <div class="row text-center">

                @if($BadgeList = App\Thread::where('receiver_id', session('prochatr_login_id'))->orWhere('my_id', session('prochatr_login_id'))->limit(100)->get())
                  @if(count($BadgeList) > 0)

                      @foreach($BadgeList as $thread)
                        @if($thread->action == "New Chat")
                          <div class="col-md-12" style="padding: 10px; background: #EEE;">
                            <span class="badge badge-pill badge-primary pull-left">{{ $thread->action }}</span>

                            @if(session('prochatr_login_id') != $thread->my_id)

                             @if($BadgeName = App\Personal_detail::where('user_id', $thread->my_id)->get())
                              @if(null != $BadgeName)
                                <div style="margin-top: -5px; padding-bottom: 5px;" class="col-md-12">{{ ucwords($BadgeName[0]->firstname)." ".ucwords($BadgeName[0]->lastname) }}</div>
                              @else
                                Anonymous
                              @endif
                             @endif

                            @endif

                            @if(session('prochatr_login_id') != $thread->receiver_id)

                             @if($BadgeName = App\Personal_detail::where('user_id', $thread->receiver_id)->get())
                              @if(null != $BadgeName)
                                <div style="margin-top: -5px; padding-bottom: 5px;">{{ ucwords($BadgeName[0]->firstname)." ".ucwords($BadgeName[0]->lastname) }}</div>
                              @else
                                Anonymous
                              @endif
                             @endif

                            @endif

                            <div class="col-md-12 badge badge-pill badge-dark pull-right" style="padding: 10px; border-radius: 4px;"><i>{{ 'New Chat created with you' }}</i> <hr />@ {{ $thread->created_at }}</div>
                          </div>
                        @endif

                        @if($thread->action == "Quote")
                          <div class="col-md-12" style="padding: 10px; background: #EEE;">
                            <span class="badge badge-pill badge-danger pull-left">Quote</span>

                            @if(session('prochatr_login_id') != $thread->my_id)

                             @if($BadgeName = App\Personal_detail::where('user_id', $thread->my_id)->get())
                              @if(null != $BadgeName)
                                <div style="margin-top: -5px; padding-bottom: 5px;">{{ ucwords($BadgeName[0]->firstname)." ".ucwords($BadgeName[0]->lastname) }}</div>
                              @else
                                Anonymous
                              @endif
                             @endif

                            @endif

                            @if(session('prochatr_login_id') != $thread->receiver_id)

                             @if($BadgeName = App\Personal_detail::where('user_id', $thread->receiver_id)->get())
                              @if(null != $BadgeName)
                                <div style="margin-top: -5px; padding-bottom: 5px;">{{ ucwords($BadgeName[0]->firstname)." ".ucwords($BadgeName[0]->lastname) }}</div>
                              @else
                                Anonymous
                              @endif
                             @endif

                            @endif

                            <div class="col-md-12 badge badge-pill badge-dark pull-right" style="padding: 10px; border-radius: 4px;">
                              <i>"{{ $thread->activity }}"</i>
                              <hr />@ {{ $thread->created_at }}
                            </div>
                          </div>
                        @endif

                        @if($thread->action == "Read")
                          <div class="col-md-12" style="padding: 10px; background: #EEE;">
                            <span class="badge badge-pill badge-success pull-left">Read</span>

                            @if(session('prochatr_login_id') != $thread->my_id)

                             @if($BadgeName = App\Personal_detail::where('user_id', $thread->my_id)->get())
                              @if(null != $BadgeName)
                                <div style="margin-top: -5px; padding-bottom: 5px;">{{ ucwords($BadgeName[0]->firstname)." ".ucwords($BadgeName[0]->lastname) }}</div>
                              @else
                                Anonymous
                              @endif
                             @endif

                            @endif

                            @if(session('prochatr_login_id') != $thread->receiver_id)

                             @if($BadgeName = App\Personal_detail::where('user_id', $thread->receiver_id)->get())
                              @if(null != $BadgeName)
                                <div style="margin-top: -5px; padding-bottom: 5px;">{{ ucwords($BadgeName[0]->firstname)." ".ucwords($BadgeName[0]->lastname) }}</div>
                              @else
                                Anonymous
                              @endif
                             @endif

                            @endif

                            <div class="col-md-12 badge badge-pill badge-dark pull-right" style="padding: 10px; border-radius: 4px;"><i>"Where are you now oh?"</i> <hr />@ {{ $thread->created_at }}</div>
                          </div>
                        @endif
                      @endforeach
                  @else
<div id="removeInfos" style="margin: auto;"><br><div class="col-md-12 wow flipInX text-center" style="visibility: hidden; animation-name: none;"><h1>::0::</h1></div><img src="https://img.icons8.com/doodle/96/000000/empty-box.png"><br>No Activity Identified<hr>Add Contacts From Our Database <br>or<br>import from other sources?<br><br><a href="https://accounts.google.com/o/oauth2/auth?client_id=950089246071-4n54jjosvme0oufrgh3huq362rra7uqg.apps.googleusercontent.com&amp;redirect_uri=https://prochatr.com/app/oauth&amp;scope=https://www.google.com/m8/feeds/&amp;response_type=code"><button type="button" class="btn btn-warning btn-xs import">Google<img src="../asset/img/google.png" style="width: 28px;"></button></a><button type="button" class="btn btn-info btn-xs import excel">Excel<img src="../asset/img/excel.png" style="width: 28px;"></button></div>
                  @endif
                @endif

                    </div>

                  </div>
                </div>
          @endif
          @endif
              </div>
            </div>
          </div>
        </div>

        <div class="row about-container text-center disp-0 component4">
          {{-- <div class="col-md-12 label"><h5>My Connections</h5></div> --}}
          <div class="col-md-12" style="background: transparent; padding: 10px;">
            <div class="container-fluid">
              <div class="row addContact mycon">

                <div class="col-md-4">
                  <span class="toggleConnection toggleAdd2"><img src="{{ asset('asset/img/toggle-on.png') }}" style="width: 60px;"></span>
                  <span class="titleName"><span>My Connections</span></span>
                  <br />
                  <span id="iteminserted"></span>
                  @if($UserList = App\Personal_detail::join('connections', 'connections.connection_id', '=', 'personal_details.user_id')->where('connections.connection_id', session('prochatr_login_id'))->orwhere('connections.login_id', session('prochatr_login_id'))->get())
                    @if(count($UserList) > 0)
                      @foreach($UserList as $user)
                      <!-- Left-aligned -->
                      @if($user->login_id == session('prochatr_login_id'))
                      <div class="media conn" id="media{{ $user->user_id }}">
                          <div class="media-left">
                            {{-- <div class="{{ $user->state }}"></div> --}}
                            @if($user->image == "profile.png" || null == $user->image)
                                <img src="{{ asset('asset/img/user.png') }}" id="connectionimage{{ $user->user_id }}" alt="{{ ucwords($user->firstname) }}" class="media-object">
                            @else
                                <img src="{{ $user->image }}" id="connectionimage{{ $user->user_id }}" alt="{{ ucwords($user->firstname) }}" class="media-object">
                            @endif
                          </div>
                          <div class="media-body dash">
                            <h4 class="media-heading">
                              <span id="connectionfirstname{{ $user->user_id }}">{{ ucwords($user->firstname) }}</span>
                              <span id="connectionlastname{{ $user->user_id }}">{{ ucwords($user->lastname) }}</span>
                              <br />
                              <span class="badge @if($user->state == "Online") badge-success @else badge-warning @endif">
                                @if($user->state == "Online") Online @else Offline @endif
                              </span>
                              <small id="connectionprofession{{ $user->user_id }}">{{ ucwords($user->profession) }}</small>
                              <br />
                              <small id="connectioncity{{ $user->user_id }}">{{ ucwords($user->city) }}</small>
                              <small id="connectionstate{{ $user->user_id }}">{{ ucwords($user->country) }}</small>
                              <br />
                              @if($user->action == 0)
                              <small style="color: red; font-weight: bold;">Invitation: Pending</small>
                              @else
                              <small style="color: green; font-weight: bold;">Invitation: Accepted </small>
                              @endif
                            </h4>
                          </div>
                          <button class="btn btn-xs btn-danger" onclick="showProfile('{{ $user->user_id }}', 'connection')" style="border-radius: 10px 0px 0px 10px;">Profile</button>
                          <button class="btn btn-xs btn-success" onclick="showMessage('{{ $user->user_id }}', 'connection')" style="border-radius: 0px 10px 10px 0px;">Message</button>
                      </div>
                      @else
@if($NextUserList = App\Personal_detail::where('user_id', $user->login_id)->get()[0])
  @if($NextUserList && $user->action == 0)
    <div class="media conn" id="media{{ $NextUserList->user_id }}">
        <div class="media-left">
          {{-- <div class="{{ $user->state }}"></div> --}}
          @if($NextUserList->image == "profile.png" || null == $NextUserList->image)
              <img src="{{ asset('asset/img/user.png') }}" id="connectionimage{{ $NextUserList->user_id }}" alt="{{ ucwords($NextUserList->firstname) }}" class="media-object">
          @else
              <img src="{{ $NextUserList->image }}" id="connectionimage{{ $NextUserList->user_id }}" alt="{{ ucwords($NextUserList->firstname) }}" class="media-object">
          @endif
        </div>
        <div class="media-body dash">
          <h4 class="media-heading">
            <span id="connectionfirstname{{ $NextUserList->user_id }}">{{ ucwords($NextUserList->firstname) }}</span>
            <span id="connectionlastname{{ $NextUserList->user_id }}">{{ ucwords($NextUserList->lastname) }}</span>
            <br />
            <span class="badge @if($NextUserList->state == "Online") badge-success @else badge-warning @endif">
              @if($NextUserList->state == "Online") Online @else Offline @endif
            </span>
            <small id="connectionprofession{{ $NextUserList->user_id }}">{{ ucwords($NextUserList->profession) }}</small>
            <br />
            <small id="connectioncity{{ $NextUserList->user_id }}">{{ ucwords($NextUserList->city) }}</small>
            <small id="connectionstate{{ $NextUserList->user_id }}">{{ ucwords($NextUserList->country) }}</small>
          </h4>
        </div>
        <button class="btn btn-xs btn-danger" onclick="showProfile('{{ $NextUserList->user_id }}', 'connection')" style="border-radius: 10px 0px 0px 10px;">Profile</button>
        <button class="btn btn-xs btn-info" id="accept{{ $NextUserList->user_id }}" onclick="accept('{{ $NextUserList->user_id }}', 'connection')" style="border-radius: 0px 10px 10px 0px;">Accept Now</button>
        <button class="btn btn-xs btn-success disp-0" id="accepted{{ $NextUserList->user_id }}" onclick="showMessage('{{ $NextUserList->user_id }}', 'connection')" style="border-radius: 0px 10px 10px 0px;">Message</button>
    </div>
  @else
<!--User Missing ...-->
  @endif
@endif
                      @endif

                      @endforeach
                    @else
                    <div id="removeInfo">
                      <br />
                      <img src="{{ asset('asset/img/empty-box.png') }}" style="background: #FFF; border-radius: 1000px; padding: 20px;">
                    </div>

                    @endif
                  @endif
                </div>
                <div class="col-md-4" style="background: #eeeeee;">
                  <span class="toggleConnection toggleAdd1"><img src="{{ asset('asset/img/toggle-on.png') }}" style="width: 60px;"></span>
                  {{-- <span class="titleName"><span>My Connections</span></span> --}}
                  <br />
                  <span id="itemremovedhere"></span>

                  @if($UserList = App\Personal_detail::join('connections', 'connections.connection_id', '=', 'personal_details.user_id')->where('connections.connection_id', '!=', session('prochatr_login_id'))->where('connections.login_id', session('prochatr_login_id'))->get())
                    @if(count($UserList) > 0)
                      <div id="addInfo">
                        <br />
                        <img src="{{ asset('asset/img/empty-box.png') }}">
                        <br />
                        Welcome, <span id="nameconnections">{{ session('prochatr_firstname') }}</span>
                        <br />
                        Appears here you have <span class="conCount">{{count($UserList)}}</span> Connection already.
                        <hr />
                        You can add to your connections by using "Add Contacts" option on the menu to pick from our list.
                        <br />
                        <br />
                        OR
                        <BR />
                        <BR />
                        Interested in importing from other sources?<br /><br />
                      <a href="https://accounts.google.com/o/oauth2/auth?client_id=950089246071-4n54jjosvme0oufrgh3huq362rra7uqg.apps.googleusercontent.com&redirect_uri=https://prochatr.com/app/oauth&scope=https://www.google.com/m8/feeds/&response_type=code"><button type="button" class="btn btn-xs import" style="background: #000; color: #FFF;">Google<img src="{{ asset('asset/img/google.png') }}" style="width: 28px;"></button></a><button type="button" class="btn btn-info btn-xs import excel">Excel<img src="{{ asset('asset/img/excel.png') }}" style="width: 28px;"></button>
                        <br />
                      </div>
                    @else
                      <div id="addInfo">
                        <br />
                        <img src="{{ asset('asset/img/empty-box.png') }}">
                        <br />
                        No User Found
                        <hr />
                        You can add to your connections in the "Add Contacts" option on the menu to pick from our list.
                        <br />
                        <br />
                        OR
                        <br />
                        <br />
Interested in importing from other sources?<br /><br />
                      <a href="https://accounts.google.com/o/oauth2/auth?client_id=950089246071-4n54jjosvme0oufrgh3huq362rra7uqg.apps.googleusercontent.com&redirect_uri=https://prochatr.com/app/oauth&scope=https://www.google.com/m8/feeds/&response_type=code"><button type="button" class="btn btn-xs import" style="background: #000; color: #FFF;">Google<img src="{{ asset('asset/img/google.png') }}" style="width: 28px;"></button></a><button type="button" class="btn btn-info btn-xs import excel">Excel<img src="{{ asset('asset/img/excel.png') }}" style="width: 28px;"></button>
<br />
                      </div>
                    @endif
                  @endif
                  {{-- END OF LIST --}}

                </div>
                <div class="col-md-4">
                  <span class="titleName"><span>My Invites</span></span>
                  <br />
                  <br />
                  <img class="plusabs" src="{{ asset('asset/img/plus.png') }}" />
                  <img src="{{ asset('asset/img/excel.png') }}" class="import excel" title="Import from Excel" style="width: 40px; position: relative; border-radius: 100px;">
                  &nbsp;&nbsp;
                  <img class="plusabs" src="{{ asset('asset/img/plus.png') }}" />
                  <a href="https://accounts.google.com/o/oauth2/auth?client_id=950089246071-4n54jjosvme0oufrgh3huq362rra7uqg.apps.googleusercontent.com&redirect_uri=https://prochatr.com/app/oauth&scope=https://www.google.com/m8/feeds/&response_type=code"><img src="{{ asset('asset/img/google.png') }}" title="Import from Google" style="width: 40px; position: relative; border-radius: 100px;"></a>
                  <br />
                  <br />
                  <div class="container-fluid" style="max-height: 480px; overflow-y: auto;">
                    @if(count($data) > 0)
                    <span style="padding: 10px; border-radius: 10px 10px 0px 0px; background: #EEE;">Found {{ count($data) }}</span>
                    <?php $i=0;?>
                    <?php $clickpos=0;?>
                      @foreach($data as $thisdata)
                      <?php $i=$i+1;?>
                      <div class="row" style="padding: 10px; cursor: pointer; background: #EEE;">
                        <span id="iteminvite"></span>
                        <div class="col-sm-2">
                        @if($user = \App\Http\Controllers\AjaxController::getUser($thisdata->email))

                          @if(count($user) > 0)
                            @if($user[0]->image != "profile.png")
                              <img src="{{ $user[0]->image }}" style="width: 34px; position: relative; border-radius: 100px;">
                            @else
                              <img src="{{ asset('asset/img/user.png') }}" style="width: 34px; position: relative; border-radius: 100px;">
                            @endif
                          @else
                            <img src="{{ $thisdata->image }}" style="width: 34px; position: relative; border-radius: 100px;">
                          @endif

                        @endif

                        </div>
                        <div class="col-sm-7 text-left">
                          {{ ucwords($thisdata->name) }}
                          <br />

                          @if(count($user) < 1)
                          <?php $clickpos = $clickpos+1;?>
                          <span style="font-size: 12px;" id="time{{ $clickpos }}">
                            @if($thisdata->count > 0)
                            Invited {{ $thisdata->count }} time(s)
                            @endif
                          </span>
                          <input type="hidden" name="invite{{ $clickpos }}" id="inviteListedInput{{ $clickpos }}" value="{{ $thisdata->email }}" />
                          @endif
                        </div>
                        <div class="col-sm-3 text-center">
                        @if($user = \App\Http\Controllers\AjaxController::getUser($thisdata->email))

                          @if(count($user) > 0)
                            <button type="button" class="btn btn-xs btn-success" title="Signed up user" style="padding: 4px; width: 70px;">Active</button>
                          @else
                            @if($thisdata->count < 1)
                              <button type="button" class="btn btn-xs btn-danger triggerinvite" title="Not invited yet" style="padding: 4px; width: 70px;" id="inviteListedLoader{{ $clickpos }}"><img src="{{ asset('asset/img/loader.svg') }}" alt="" class="loaderabs disp-0" />Invite +</button>
                            @else
                              <button type="button" class="btn btn-xs btn-warning triggerinvite" title="Invited {{ $thisdata->count }} time(s)" style="padding: 4px; width: 70px;" id="inviteListedLoader{{ $clickpos }}"><img src="{{ asset('asset/img/loader.svg') }}" alt="" class="loaderabs disp-0" />Retry +</button>
                            @endif
                          @endif

                        @endif
                        </div>
                      </div>
                      @endforeach
                    @else
                    <img src="https://img.icons8.com/cotton/64/000000/user-male-circle.png" class="center">
                    <br />
                    <h6 class="text-primary">No Invite Sent</h6>
                    @endif
                  </div>

                </div>



              </div>
            </div>
          </div>
        </div>

        <div class="row about-container text-center disp-0 component7">
          {{-- <div class="col-md-12 label"><h5>Settings</h5></div> --}}
          <div class="col-md-12" style="background: #EEE; padding: 10px;">
            <div class="container-fluid">
              <div class="row addContact myset">
                <div class="col-md-6">

                      <div id="addInfo">
                       <div class="icon" style="position: relative; padding: 10px;"><i class="ion-android-settings" style="color: #658eea;"></i></div>
                        Hello, <span id="namesettings">{{ session('prochatr_firstname') }}</span>
                        <br />
                        <br />
                        You can make changes to your chat environment here with a few clicks
                        <hr />
                        You can add to your connections by using "Add Contacts" option on the menu to pick from our list.
                        <br />
                        <br />
                        OR
                        <br />
                        <br />
                          Interested in importing from other sources?<br /><br />
                      <a href="https://accounts.google.com/o/oauth2/auth?client_id=950089246071-4n54jjosvme0oufrgh3huq362rra7uqg.apps.googleusercontent.com&redirect_uri=https://prochatr.com/app/oauth&scope=https://www.google.com/m8/feeds/&response_type=code"><button type="button" class="btn btn-xs import" style="background: #000; color: #FFF;">Google<img src="{{ asset('asset/img/google.png') }}" style="width: 28px;"></button></a><button type="button" class="btn btn-info btn-xs import excel">Excel<img src="{{ asset('asset/img/excel.png') }}" style="width: 28px;"></button>
                        <br />
                      </div>
                  {{-- END OF LIST --}}

                </div>
                <div class="col-md-6">
                  <span class="titleName"><span>Settings</span></span>
                <br />
                <br />
                <table class="table update_table">

          <fieldset class="the-fieldset-settings">
              <legend class="the-legend">Chat Mode</legend>
              <div class="form-row editrows">
                  <div class="col">
                      <!-- First name -->
                      <div class="md-form text-center">
                        <label for="chatmode">Light</label>
                      </div>
                  </div>
                  <div class="col">
                      <!-- Last name -->
                      <div class="md-form text-center">
                        <label class="switch">
                          <input id="chatmode" name="chatmode" type="checkbox" <?php if(1 == "off"){echo "checked='checked'";}else{echo "checked='checked'";}?> >
                          <span class="slider round"></span>
                        </label>
                      </div>
                  </div>
                  <div class="col">
                      <!-- Last name -->
                      <div class="md-form text-center">
                        <label for="chatmode">Dark</label>
                      </div>
                  </div>
              </div>
          </fieldset>

          <fieldset class="the-fieldset-settings">
              <legend class="the-legend">Mail Notification</legend>
              <div class="form-row editrows">
                  <div class="col">
                      <!-- First name -->
                      <div class="md-form text-center">
                        <label for="mailtoggle">On</label>
                      </div>
                  </div>
                  <div class="col">
                      <!-- Last name -->
                      <div class="md-form text-center">
                        <label class="switch">
                          <input id="mailtoggle" name="mailtoggle" type="checkbox" <?php if(1 == "on"){echo "checked='checked'";}?> >
                          <span class="slider round"></span>
                        </label>
                      </div>
                  </div>
                  <div class="col">
                      <!-- Last name -->
                      <div class="md-form text-center">
                        <label for="mailtoggle">Off</label>
                      </div>
                  </div>
              </div>
          </fieldset>

          <fieldset class="the-fieldset-settings">
              <legend class="the-legend">Desktop Prompt</legend>
              <div class="form-row editrows">
                  <div class="col">
                      <!-- First name -->
                      <div class="md-form text-center">
                        <label for="prompttoggle">On</label>
                      </div>
                  </div>
                  <div class="col">
                      <!-- Last name -->
                      <div class="md-form text-center">
                        <label class="switch">
                          <input id="prompttoggle" name="prompttoggle" type="checkbox" <?php if(1 == "off"){echo "checked='checked'";}else{echo "checked='checked'";}?> >
                          <span class="slider round"></span>
                        </label>
                      </div>
                  </div>
                  <div class="col">
                      <!-- Last name -->
                      <div class="md-form text-center">
                        <label for="prompttoggle">Off</label>
                      </div>
                  </div>
              </div>
          </fieldset>

          <fieldset class="the-fieldset-settings">
              <legend class="the-legend">Account</legend>
              <div class="form-row editrows">
                  <div class="col">
                      <!-- First name -->
                      <div class="md-form text-center">
                        <label for="blocktoggle">Activate</label>
                      </div>
                  </div>
                  <div class="col">
                      <!-- Last name -->
                      <div class="md-form text-center">
                        <label class="switch">
                          <input id="blocktoggle" name="blocktoggle" type="checkbox" <?php if(1 == "on"){echo "checked='checked'";}?> >
                          <span class="slider round"></span>
                        </label>
                      </div>
                  </div>
                  <div class="col">
                      <!-- Last name -->
                      <div class="md-form text-center">
                        <label for="blocktoggle">Block</label>
                      </div>
                  </div>
              </div>
          </fieldset>

                </table>

                <div class="text-left col-md-12"><b>Others <i class="ion-android-settings pull-right" style="color: #658eea; margin-top: -8px; font-size: 28px;"></i></b></div>
                <hr />
                <div class="container-fluid">

                  <div class="row"><div class="col-md-6 text-left" style="background: #EEE; padding: 10px; border-radius: 10px 10px 0px 0px">Update Password</div></div>
                  <div class="row">
                    <div class="col-md-12 text-left" style="background: #FFF; padding: 10px;">Forgotten your account credentials or password? You can update or reset it here.</div>
                  </div>
                  <div class="row">
                    <div class="col-md-12 text-center" style="background: #EEE; padding: 10px; border-radius: 0px 0px 10px 10px;"><button type="button" class="btn btn-success btn-sm" id="updatepassword">UPDATE PASSWORD</button></div>
                  </div>
                  <br />
                  <div class="row"><div class="col-md-6 text-left" style="background: #EEE; padding: 10px; border-radius: 10px 10px 0px 0px">Alternate Email</div></div>
                  <div class="row">
                    <div class="col-md-12 text-left" style="background: #FFF; padding: 10px;">Provide your google alternate email so you can login faster and manage multiple accounts.</div>
                  </div>
                  <div class="row">
                    <div class="col-md-12 text-center" style="background: #EEE; padding: 10px; border-radius: 0px 0px 10px 10px;"><button type="button" class="btn btn-primary btn-sm" id="editalternate">EDIT ALTERNATE EMAIL</button></div>
                  </div>
                  <br />
                  <div class="row"><div class="col-md-6 text-left" style="background: #EEE; padding: 10px; border-radius: 10px 10px 0px 0px">Change Security Question</div></div>
                  <div class="row">
                    <div class="col-md-12 text-left" style="background: #FFF; padding: 10px;">Edit your security question here for faster access to your account.</div>
                  </div>
                  <div class="row">
                    <div class="col-md-12 text-center" style="background: #EEE; padding: 10px; border-radius: 0px 0px 10px 10px;"><button type="button" class="btn btn-danger btn-sm" id="editsecurity">EDIT SECURITY QUESTION</button></div>
                  </div>

                </div>

                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="row about-container text-center disp-0 component6">
          {{-- <div class="col-md-12 label"><h5>Call</h5></div> --}}
          <div class="col-md-12" style="background: #EEE; padding: 10px;">
            <div class="container-fluid">
              <div class="row addContact mycall">
                <div class="col-md-6">
                  {{-- <span class="titleName"><span>Calls</span></span> --}}
                  <span class="toggleCall toggleAdd2"><img src="{{ asset('asset/img/call.png') }}" style="width: 60px;"></span>
                      <div id="addInfo">
                       <div class="icon" style="position: relative; padding: 10px;transform: rotate(135deg);"><i class="ion-ios-telephone" style="color: #658eea;"></i></div>
                        Hello, <span id="namecall">{{ session('prochatr_firstname') }}</span>
                        <br />
                        <br />
                        Appears here you have <span class="conCount">{{count($UserList)}}</span> Connection(s) which you can connect with using the voice and video call feature.
                        <hr />
                        You can add to your connections by using "Add Contacts" option on the menu to pick from our list.
                        <br />
                        <br />
                        OR
                        <br />
                        <br />
                          Interested in importing from other sources?<br /><br />
                      <a href="https://accounts.google.com/o/oauth2/auth?client_id=950089246071-4n54jjosvme0oufrgh3huq362rra7uqg.apps.googleusercontent.com&redirect_uri=https://prochatr.com/app/oauth&scope=https://www.google.com/m8/feeds/&response_type=code"><button type="button" class="btn btn-xs import" style="background: #000; color: #FFF;">Google<img src="{{ asset('asset/img/google.png') }}" style="width: 28px;"></button></a><button type="button" class="btn btn-info btn-xs import excel">Excel<img src="{{ asset('asset/img/excel.png') }}" style="width: 28px;"></button>
                        <br />
                      </div>

                </div>
                <div class="col-md-6">
                  <span class="titleName"><span>Calls</span></span>
                  <span class="toggleCall toggleAdd1"><img src="{{ asset('asset/img/call.png') }}" style="width: 60px;"></span>
                  <span id="iteminsertedCall"></span>
                  @if($UserList = App\Personal_detail::join('connections', 'connections.connection_id', '=', 'personal_details.user_id')->where('connections.connection_id', '!=', session('prochatr_login_id'))->where('connections.login_id', session('prochatr_login_id'))->get())
                    @if(count($UserList) > 0)
                      @foreach($UserList as $user)
                      <!-- Left-aligned -->
                      <div class="media conncall" id="media{{ $user->user_id }}">
                          <div class="media-left">
                            {{-- <div class="{{ $user->state }}"></div> --}}
                            @if($user->image == "profile.png" || null == $user->image)
                                <img src="{{ asset('asset/img/user.png') }}" id="callimage{{ $user->user_id }}" alt="{{ ucwords($user->firstname) }}" class="media-object">
                            @else
                                <img src="{{ $user->image }}" id="callimage{{ $user->user_id }}" alt="{{ ucwords($user->firstname) }}" class="media-object">
                            @endif
                          </div>
                          <div class="media-body dash">
                            <h4 class="media-heading">
                              <span id="callfirstname{{ $user->user_id }}">{{ ucwords($user->firstname) }}</span>
                              <span id="calllastname{{ $user->user_id }}">{{ ucwords($user->lastname) }}</span>
                              <br />
                              <span class="badge @if($user->state == "Online") badge-success @else badge-warning @endif">
                                @if($user->state == "Online") Online @else Offline @endif
                              </span>
                              <small id="callprofession{{ $user->user_id }}">{{ ucwords($user->profession) }}</small>
                              <br />
                              <small id="callcity{{ $user->user_id }}">{{ ucwords($user->city) }}</small>
                              <small id="callstate{{ $user->user_id }}">{{ ucwords($user->country) }}</small>
                            </h4>
                          </div>

                          <button title="Make Voice Call" class="btn btn-xs btn-danger" style="border-radius: 10px 0px 0px 10px; padding: 5px; padding-left: 13px; padding-right: 13px;" onclick="badge('Voice')"><div><i class="ion-ios-telephone"></i></div></button>
                          <button title="Make Video Call" class="btn btn-xs btn-success" style="border-radius: 0px 10px 10px 0px; padding: 5px; padding-left: 13px; padding-right: 13px;" onclick="badge('Video')"><div><i class="ion-ios-videocam"></i></div></button>
                      </div>
                      @endforeach
                    @else
                    <div id="removeInfo">
                      <br />
                      <br />
                      <br />
                      <br />
                      <br />
                      <br />
                      <img src="{{ asset('asset/img/empty-box.png') }}" style="background: #FFF; border-radius: 1000px; padding: 20px;">
                    </div>

                    @endif
                  @endif
                </div>
              </div>
            </div>
          </div>
        </div>



        <div class="row about-container text-center disp-0 component5">
          <div class="col-md-12 label"><h5>Groups</h5></div>
        </div>

        <span id="closeDash" title="Close"><img src="{{ asset('asset/img/delete-sign.png') }}"></span>
      </div>

    </section>

    {{-- <center><p class="wow "><b>Powered by Prochatr</b></p></center> --}}
  </main>


    @include('includes.modal')
    {{-- @include('includes.bottom') --}}
    @include('includes.footer')
@stop

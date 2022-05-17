@extends('layouts.default')
@section('content')

  <!--@include('includes.toplow_plain')-->

  <main id="main">
      <br />
    <section id="dashboard_options">
      <div class="container">
        <div class="row about-container">

          <div class="col-md-10 col-lg-10 wow bounceIninvitewn">
            <div class="box" style="padding: 0px;">

              <h4 class="title" style="padding-top: 15px;"><div style="margin-left: 15px; color: #1c4fc3;"> {{ session('data')['title']['$t'] }}
              <br />
              <span style="font-size: 12px; font-weight: normal;">Author Email: {{ session('data')['author'][0]['email']['$t'] }}</span>   
              <br/>
              <span style="font-size: 12px; font-weight: normal;">Last Updated: {{ session('data')['updated']['$t'] }}</span>

              <img src="{{ asset('asset/img/google.png') }}" style="width: 40px; position: absolute; left: 10px;"></div></h4>
              <p class="description" style="margin-left: 58px;">Here are the connections we found for you. <span id="reseterr" class="pull-right disp-0"></span>&nbsp; &nbsp;</p>



            <form id="inviteformcontact">
              <div class="container-fluid" style="max-height: 300px; overflow-y: auto; overflow-x: hidden; border-top: 2px solid #000; padding-top: 6px;">
                  <?php $j = 0;?>
                @for($i=0; $i<=sizeof(session('data')['entry']); $i++)
                    @if(isset(session('data')['entry'][$i]['gd$email'][0]['address']))
                    <?php $j = $j + 1; ?>
                        <div class="row" style="padding: 0; border-bottom:2px solid #FFF;">
                          <div class="col-md-1 col-sm-1 col-xs-1" style="width: auto; background: #f7f8fa;">{{ $j }}</div>
                          <div class="col-md-1 col-sm-1 col-xs-1 d-none d-md-block"><img src="
                                  @if(isset(session('data')['entry'][$i]['gd$name']['gd$fullName']['$t']))
                                  {{ asset('asset/img/google.png') }}
                                  @else
                                  {{ asset('asset/img/user.png') }}
                                  @endif
                                  " style="width: 24px; border-radius: 100px; object-fit: cover;"></div>
                          <div class="col-md-10 col-sm-11 col-xs-11" style="width: auto;"><i class="ion-android-close" style="display: none;"></i>&nbsp;&nbsp;
                              
                                  @if(isset(session('data')['entry'][$i]['gd$name']['gd$fullName']['$t']))
                                  <label for="invite{{$j}}" id="inviteName{{$j}}" title="Google contact" style="background: #28a7456b; border-radius: 10px; padding-right: 10px; padding-left: 10px;">{{ session('data')['entry'][$i]['gd$name']['gd$fullName']['$t'] }}</label>
                                  @else
                                  <label for="invite{{$j}}" id="inviteName{{$j}}" title="Unknown contact" style="background: #dc354552; border-radius: 10px; padding-right: 10px; padding-left: 10px;">{{ session('data')['entry'][$i]['gd$email'][0]['address'] }}</label>
                                  @endif
                              
                            <input type="checkbox" name="invite{{$j}}" id="invite{{$j}}" class="" value="{{ session('data')['entry'][$i]['gd$email'][0]['address'] }}" style="width: 40px; float: right;" />
                          </div>
                        </div> 
                    @endif
                @endfor
              </div>
            </form>
            
            
            
            
              <p>
                <button type="button" class="btn btn-primary col-md-4 col-sm-3 col-xs-3 pull-right" id="inviteall" style="width: auto; margin: 1px;">Invite All ({{ $j }}) <img src="{{ asset('asset/img/loader.svg') }}" alt="" class="loaderabs disp-0" style="margin-left: -40px; margin-top: -13px;" />
                </button>                  
                <button type="button" class="btn btn-info col-md-4 col-sm-9 col-xs-9 pull-right" id="invite" style="width: auto; margin: 1px;">Invite Selected <img src="{{ asset('asset/img/loader.svg') }}" alt="" class="loaderabs disp-0" style="margin-left: -40px; margin-top: -13px;" />
                </button>  
              </p>
              <hr />
              <br />
              <div class="col-md-12 text-right">
              <a href="https://accounts.google.com/o/oauth2/auth?client_id=950089246071-4n54jjosvme0oufrgh3huq362rra7uqg.apps.googleusercontent.com&redirect_uri=https://prochatr.com/app/oauth&scope=https://www.google.com/m8/feeds/&response_type=code"><button type="button" class="btn btn-success"><img src="{{ asset('asset/img/loader.svg') }}" alt="" class="loaderabs disp-0" style="margin-left: -40px; margin-top: -13px;" /> Retry 
                <img src="{{ asset('asset/img/google.png') }}" style="width: 12px;">
              </button></a>              

              <a href="{{ route('main.dashboard') }}"><button type="button" class="btn btn-danger"><img src="{{ asset('asset/img/loader.svg') }}" alt="" class="loaderabs disp-0" style="margin-left: -40px; margin-top: -13px;" /> Return <i class="ion-android-arrow-back"></i>
              </button></a>              
              <br />
              <br />
              </div>
            </div>
          </div>

        </div>

      </div>

    </section>
  </main>


    @include('includes.modal')
    @include('includes.bottom')
    @include('includes.footer')
@stop
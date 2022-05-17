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

              <h4 class="title" style="padding-top: 15px;"><div style="margin-left: 15px; color: #1c4fc3;"> {{ ucwords(session('prochatr_firstname')." ".session('prochatr_lastname')) }}
              <br />
              <span style="font-size: 12px; font-weight: bold;">Invites</span>

              <img src="{{ asset('asset/img/excel.png') }}" style="width: 40px; position: absolute; left: 10px; border-radius: 100px;"></div></h4>
              <p class="description" style="margin-left: 58px;">Here are your most recent imported contacts. <span id="reseterr" class="pull-right disp-0"></span>&nbsp; &nbsp;</p>



            <form id="inviteformcontact">
              <div class="container-fluid" style="max-height: 300px; overflow-y: auto; overflow-x: hidden; border-top: 2px solid #000; padding-top: 6px;">
                <?php $i=0;?>
                @foreach($data as $thisdata)
                  <?php $i=$i+1;?>
                  @if($user = \App\Http\Controllers\AjaxController::getUser($thisdata->email))
                    @if(count($user) > 0)
                      <div class="row" style="padding: 0; border-bottom:2px solid #FFF;">
                        <div class="col-md-1 col-sm-1 col-xs-1" style="width: auto; background: #f7f8fa;">{{ $i }}</div>
                        <div class="col-md-1 col-sm-1 col-xs-1 d-none d-md-block">
                          @if($user[0]->image != "profile.png")
                            <img src="{{ $user[0]->image }}" style="width: 24px; border-radius: 100px; object-fit: cover;">
                          @else
                            <img src="{{ asset('asset/img/user.png') }}" style="width: 24px; border-radius: 100px; object-fit: cover;">
                          @endif
                        </div>
                        <div class="col-md-10 col-sm-10 col-xs-10" style="width: auto;"><i class="ion-android-close"></i>&nbsp;&nbsp;
                            
                                @if(isset($thisdata->name))
                                <label for="invite{{$i}}" title="Signed up" style="background: #28a7456b; border-radius: 10px; padding-right: 10px; padding-left: 10px;">{{ ucwords($thisdata->name) }}</label>
                                @else
                                <label for="invite{{$i}}" title="Signed up" style="background: #28a7456b; border-radius: 10px; padding-right: 10px; padding-left: 10px;">{{ $thisdata->email }}</label>
                                @endif
                          <input type="checkbox" name="invite{{$i}}" id="invite{{$i}}" class="" value="{{ $thisdata->email }}" style="width: 40px; float: right;" />
                        </div>
                      </div>
                    @else
                    <div class="row" style="padding: 0; border-bottom:2px solid #FFF;">
                      <div class="col-md-1 col-sm-1 col-xs-1" style="width: auto; background: #f7f8fa;">{{ $i }}</div>
                      <div class="col-md-1 col-sm-1 col-xs-1 d-none d-md-block">
                        <img src="{{ $thisdata->image }}" style="width: 24px; border-radius: 100px; object-fit: cover;">
                      </div>
                      <div class="col-md-10 col-sm-10 col-xs-10" style="width: auto;"><i class="ion-android-close"></i>&nbsp;&nbsp;
                          
                          @if(isset($thisdata->email))
                          <label for="invite{{$i}}" id="inviteName{{$i}}" title="Invited {{ ucwords($thisdata->name." ".$thisdata->email)." ".$thisdata->count." times" }}" style="background: #dc354552; border-radius: 10px; padding-right: 10px; padding-left: 10px;">{{ ucwords($thisdata->name) }}</label>
                          @else
                          <label for="invite{{$i}}" id="inviteName{{$i}}" title="Invited {{ ucwords($thisdata->name." ".$thisdata->email)." ".$thisdata->count." times" }}" style="background: #dc354552; border-radius: 10px; padding-right: 10px; padding-left: 10px;">{{ $thisdata->email }}</label>
                          @endif

                        <input type="checkbox" name="invite{{$i}}" id="invite{{$i}}" class="" value="{{ $thisdata->email }}" style="width: 40px; float: right;" />
                      </div>
                    </div>
                    @endif
                  @endif
                @endforeach

              </div>
            </form>
            
            
            
            
              <p>
                <button type="button" class="btn btn-primary col-md-4 col-sm-3 col-xs-3 pull-right" id="inviteallExcel" style="width: auto; margin: 1px;">Invite All ({{ $i }}) <img src="{{ asset('asset/img/loader.svg') }}" alt="" class="loaderabs disp-0" style="margin-left: -40px; margin-top: -13px;" />
                </button>                  
                <button type="button" class="btn btn-info col-md-4 col-sm-9 col-xs-9 pull-right" id="inviteExcel" style="width: auto; margin: 1px;">Invite Selected <img src="{{ asset('asset/img/loader.svg') }}" alt="" class="loaderabs disp-0" style="margin-left: -40px; margin-top: -13px;" />
                </button>  
              </p>
              <hr />
              <br />
              <div class="col-md-12 text-right">
              <a href="https://accounts.google.com/o/oauth2/auth?client_id=950089246071-4n54jjosvme0oufrgh3huq362rra7uqg.apps.googleusercontent.com&redirect_uri=https://prochatr.com/app/oauth&scope=https://www.google.com/m8/feeds/&response_type=code"><button type="button" class="btn btn-success import excel"><img src="{{ asset('asset/img/loader.svg') }}" alt="" class="loaderabs disp-0" style="margin-left: -40px; margin-top: -13px;" /> Add 
                <img src="{{ asset('asset/img/excel.png') }}" style="width: 16px;">
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
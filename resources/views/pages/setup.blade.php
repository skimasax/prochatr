@extends('layouts.default')
@section('content')

    @include('includes.toplow_setup')
<style type="text/css" media="screen">
  .noshow > hr,.noshow > small{display: none;}
</style>
  <main id="main">
    <input type="hidden" name="need" id="need" value="" />
    <span class="pagenumlast disp-0">{{ count($data) }}</span>
    <section id="dashboard_options_setup">
      <div class="container">
        <div class="row about-container">
          <a href="{{ route('main.dashboard', '_connection=set') }}" class="col-md-12"><div class="col-md-12 text-center alert alert-danger" style="padding: 10px;margin-top: -50px;border-radius: 0px;">Return to Dashboard</div></a>

        {{-- Check Subscription --}}
        @if($checkSubscription = App\Active::where('login_id', session('prochatr_login_id'))->get())
        @endif
        {{-- End of Global Subscription Check --}}
        @if(count($checkSubscription) > 0)

        @if(count($data) > 0)
        <div class="col-md-12">
          <h5 class="text-left" style="margin-right: 10px; margin-left: 10px;">Add Connections
            <br />
            <span style="font-size: 14px;">Want connections based on your need? <a href="{{ route('main.userinterest') }}" style="cursor: pointer;">Check here</a></span>
          </h5>
          {{-- <h4 class="text-right"></h4> --}}
          <br /></div>
        
        <?php $i=0;?>
          @foreach($data as $connection)
          <div class="col-md-4 wow load_result" id="result{{ $connection->user_id }}" data-wow-duration="1.4s">
            <div class="box">
              <div class="icon"><img src="{{ asset('asset/img/logo/plogo.png') }}" alt="" class="iconImg"></div>
              <h4 class="title" title="{{ $connection->firstname." ".$connection->lastname }}"><span>{{ str_limit($connection->firstname." ".$connection->lastname, 14) }}</span></h4>
              @if(strlen($connection->company) > 4 && strlen($connection->profession) > 4)
                <p class="description">{{ str_limit($connection->profession." At ". $connection->company, 18) }}</p>
              @elseif(strlen($connection->company) > 4 && strlen($connection->position) > 4)
                <p class="description">{{ str_limit($connection->position." At ". $connection->company, 18) }}</p>              
              @elseif(strlen($connection->company) > 4 && !$connection->position)
                <p class="description">{{ str_limit("Works At". $connection->company, 18) }}</p>              
              @elseif(!$connection->company && strlen($connection->position) > 4)
                <p class="description">{{ str_limit("Works As". $connection->position, 18) }}</p>
              @elseif(strlen($connection->company) > 4 && !$connection->profession)
                <p class="description">{{ str_limit("Works At". $connection->company, 18) }}</p>
              @elseif(!$connection->company && strlen($connection->profession) > 4)
                <p class="description">{{ str_limit("Works As". $connection->profession, 18) }}</p>
              @else
                <p class="description">Employed</p>
              @endif
             <button type="button" class="btn btn-sm btn-primary pull-right addCon" onclick="addCon({{ $connection->user_id }})" data="{{ $connection->user_id }}" title="Add to connection" style="margin-top: 5px;"><img src="{{ asset('asset/img/loading.gif') }}" alt="" class="loading disp-0">Add +</button>
            </div>
          </div>
          @endforeach

        @else
          <div class="col-md-12 wow" data-wow-duration="1.4s">
            <div class="box">
              <div class="icon"><img src="{{ asset('asset/img/lock.png') }}" alt="" style="width: 80px; height: 70px; border-radius: 0px 30px 30px 0px; background: #f6f6f2; object-fit: cover;"></div>
              <center><h4 class="title"><span>Ooops</span></h4>
              <p class="description">No Connection Available !!!
              <br />
              <br />
              <a href="{{ route('main.dashboard', '_connection=set') }}" target="_BLANK"><button class="btn btn-primary" type="button">Return to Dashboard</button></a>
              </p></center>
            </div>
          </div>
        @endif

        @else


        <div class="row">
          {{-- IF Subscription is Null --}}


          {{-- Show list of available Linked in List --}}

          <div class="col-md-8" style="margin-top: 180px;">
            
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

          <div class="col-md-4">


          <div id="addInfo" class="text-center">
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
        </div>

        </div>

          


        @endif

        </div>

      @if(count($data) > 0 && count($checkSubscription) > 0)
        <div class="row" id="loadmore">
          <div class="col-md-12 wow" data-wow-duration="1.4s">
            <div class="box">
              <div class="icon"><img src="{{ asset('asset/img/more.png') }}" alt="" style="width: 80px; height: 70px; border-radius: 0px 30px 30px 0px; background: #f6f6f2; object-fit: cover;"></div>
              <center><h4 class="title"><span>Click/Scroll down to load more</span></h4>
              <p class="description message"></p></center>
            </div>
          </div>
        </div>
      @endif

      </div>

    <br />
    <br />

    </section>
    
    {{-- <center><p class="wow "><b>Powered by Prochatr</b></p></center> --}}
  </main>


    @include('includes.modal')
    {{-- @include('includes.bottom') --}}

    @include('includes.footer')
@stop
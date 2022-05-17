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
          <a href="{{ route('main.dashboard', '_connection=set') }}" class="col-md-12" style="padding: 0px;"><div class="col-md-12 text-center alert alert-danger" style="padding: 10px;margin-top: -50px;border-radius: 0px;">Return to Dashboard</div></a>
        @if(count($data) > 0)

        <div class="col-md-12">
          <h5 class="text-left" style="margin-right: 10px; margin-left: 10px;">Related Connections
            <br />
            <span style="font-size: 14px;">Want connections based on your need? <a href="{{ route('main.userinterest') }}" style="cursor: pointer;">Check here</a></span>
          </h5>
          {{-- <h4 class="text-right"></h4> --}}
          <br /></div>

        <?php $i=0;?>
          @foreach($data as $connection)
          <?php $i=$i+1;?>
            <div class="col-md-4 {{ 'pick'.$connection->user_id }} wow animated" id="resultInd" data-wow-duration="1.4s" style="visibility: visible; animation-duration: 1.4s;" pos="{{ $i }}">
              <div class="boxEdit">
                <div class="icon"><img src="{{ asset('asset/img/logo/plogo.png') }}" alt="" class="iconImg"></div>
                <div class="open" title="View More Details For {{ $connection->firstname." ".$connection->lastname }}" style="bottom: -20px; right: 0; padding: 20px; border-radius: 30px 30px 0px 0px; margin-right: -27px; background: #2d5b98; position: absolute; transform: rotate(-40deg); text-align: center; font-size: 13px; color: #FFF;" onclick="moreDetails({{ $connection->user_id }})">View More <br /><i class="fa fa-plus"></i></div>
                <div class="close" title="Close Details For {{ $connection->firstname." ".$connection->lastname }}" style="bottom: -20px; right: 0; padding: 20px; border-radius: 30px 30px 0px 0px; margin-right: -27px; background: #2d5b98; position: absolute; transform: rotate(-40deg); text-align: center; font-size: 13px; color: #FFF; z-index: 10;" onclick="lessDetails({{ $connection->user_id }})">View Less <br /><i class="fa fa-minus"></i></div>
                <h4 class="title" title="{{ $connection->firstname." ".$connection->lastname }}"><span>{{ $connection->firstname." ".$connection->lastname }}</span></h4>

                              
                  <p class="description">Experience: <b>{{ $connection->experience }} (Yrs)</b> | Rating: <b>{{ ($connection->Invite+$connection->Contact+$connection->Voice+$connection->Video+$connection->Messaging+$connection->Groups+$connection->Conference)/(100*2) }}</b></p>
                  
                    <hr />    
                      <a href="#" title="Network Build up" class="btn btn-sm btn-success" style="margin:2px; width: 100%;" onclick="fetchCalc({{ $connection->login_id }}, 'Network Build up')">Network Build up</a>
                      <!--<a href="#" title="Network Build up" class="btn btn-sm btn-primary" style="margin:2px; width: 100%;" onclick="fetchCalc({{ $connection->login_id }}, 'Professional Supports')">Professional Supports</a>-->
                      <a href="#" title="Network Build up" class="btn btn-sm btn-danger" style="margin:2px; width: 100%;" onclick="fetchCalc({{ $connection->login_id }}, 'Appropriate use of Tools')">Appropriate use of Tools</a>
                    <div id="dump{{ $connection->user_id }}" class="dumpFocus"></div>
              </div>
            </div>
          @endforeach

        @else
          <div class="col-md-12 wow" data-wow-duration="1.4s">
            <div class="box">
              <div class="icon"><img src="{{ asset('asset/img/lock.png') }}" alt="" style="width: 80px; height: 70px; border-radius: 0px 30px 30px 0px; background: #f6f6f2; object-fit: cover;"></div>
              <center><h4 class="title"><span>Ooops</span></h4>
              <p class="description">No User Available !!!
              <br />
              <br />
              <a href="{{ route('main.dashboard', '_connection=set') }}" target="_BLANK"><button class="btn btn-primary" type="button">Return to Dashboard</button></a>
              </p></center>
            </div>
          </div>
        @endif

        </div>

      @if(count($data) > 0)
{{--         <div class="row" id="loadmore">
          <div class="col-md-12 wow" data-wow-duration="1.4s">
            <div class="box">
              <div class="icon"><img src="{{ asset('asset/img/more.png') }}" alt="" style="width: 80px; height: 70px; border-radius: 0px 30px 30px 0px; background: #f6f6f2; object-fit: cover;"></div>
              <center><h4 class="title"><span>Refresh List</span></h4>
              <p class="description message"></p></center>
            </div>
          </div>
        </div> --}}
      @endif

      </div>

    <br />
    <br />

    </section>
    
    {{-- <center><p class="wow "><b>Powered by Prochatr</b></p></center> --}}
  </main>


    @include('includes.modal')
    @include('includes.bottom')
    @include('includes.footer')
@stop
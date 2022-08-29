@extends('layouts.default')
@section('content')

@include('includes.toplow_userinterest')
<style type="text/css" media="screen">
    .noshow>hr,
    .noshow>small {
        display: none;
    }
</style>
<main id="main">


    <span class="pagenumlast disp-0">{{ count($data) }}</span>
    <section id="dashboard_options_setup">
        <div class="container">
            @if($UserInterest = App\Interest::where('login_id', session('prochatr_login_id'))->get())
            @if(null != $UserInterest[0]->offer)
            <div class="row about-container">
                <a href="{{ route('main.dashboard') }}?redirect=true" class="col-md-12">
                    <div class="col-md-12 text-center alert alert-danger"
                        style="padding: 10px;margin-top: -50px;border-radius: 0px;">Return to Dashboard</div>
                </a>
            </div>
            @endif
            @endif
            <div class="row about-container" id="list">

                <div class="col-md-4">
                    <h4>Kindly fill the form to easily match you.</h4>
                    <h6>Looking to find professionals that can meet your need</h6>
                    <div class="row">
                        @if($UserInterest = App\Interest::where('login_id', session('prochatr_login_id'))->get())
                        <div class="col-md-12"
                            style="border-radius: 10px; background: #00000005; padding-bottom: 10px;">
                            {{-- {{ $UserInterest }} --}}
                            <div class="form-group row">
                                <label for="aboutme" class="col-xs-6 col-sm-6 col-md-6 col-form-label">About Me</label>
                                <div class="col-md-12">
                                    <textarea id="aboutme" placeholder="Write in maximum of 200 words about yourself"
                                        rows="4"
                                        class="form-control">@if($UserInterest && count($UserInterest) > 0 ) {{ $UserInterest[0]->about }} @endif</textarea>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="experience" class="col-md-12 col-form-label">Years of Experience</label>
                                <div class="col-md-12">
                                    <select id="experience" class="form-control">
                                        @for($i=1;$i<=70; $i++) <option value="{{ $i }}" @if($UserInterest &&
                                            count($UserInterest)> 0) selected='' @endif>{{ $i }}</option>
                                            @endfor
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="offer" class="col-md-12 col-form-label">What I have to offer</label>
                                <div class="col-md-12">
                                    <select id="offer" class="form-control">
                                        <option value="Coaching/Mentorship" @if($UserInterest && count($UserInterest)> 0
                                            && "Coaching/Mentorship"== $UserInterest[0]->offer) selected=''
                                            @endif>Coaching/Mentorship</option>
                                        <option value="Internship" @if(count($UserInterest)> 0 && "Internship"==
                                            $UserInterest[0]->offer) selected='' @endif>Internship</option>
                                        <option value="Collaboration" @if(count($UserInterest)> 0 && "Collaboration"==
                                            $UserInterest[0]->offer) selected='' @endif>Collaboration</option>
                                        <option value="Training" @if(count($UserInterest)> 0 && "Training"==
                                            $UserInterest[0]->offer) selected='' @endif>Training</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="need" class="col-md-12 col-form-label">What I need</label>
                                <div class="col-md-12">
                                    <select id="need" class="form-control">
                                        <option value="Coaching/Mentorship" @if($UserInterest && count($UserInterest)> 0
                                            && "Coaching/Mentorship"== $UserInterest[0]->need) selected=''
                                            @endif>Coaching/Mentorship</option>
                                        <option value="Internship" @if(count($UserInterest)> 0 && "Internship"==
                                            $UserInterest[0]->need) selected='' @endif>Internship</option>
                                        <option value="Collaboration" @if(count($UserInterest)> 0 && "Collaboration"==
                                            $UserInterest[0]->need) selected='' @endif>Collaboration</option>
                                        <option value="Training" @if(count($UserInterest)> 0 && "Training"==
                                            $UserInterest[0]->need) selected='' @endif>Training</option>
                                    </select>
                                </div>
                            </div>
                            <button type="button" class="form-control btn btn-primary" id="saveInterest">Save &
                                continue</button>
                            @endif
                        </div>
                    </div>
                </div>
















                <div class="col-md-8">
                    <div class="row about-container">

                     

                        {{-- Check Subscription --}}
                        @if($checkSubscription = App\Active::where('login_id', session('prochatr_login_id'))->get())
                        @endif
                        {{-- End of Global Subscription Check --}}
                        @if(count($checkSubscription) > 0)

                        @if(count($data) > 0)
                        <div class="col-md-12">
                            <h5 class="text-left" style="margin-right: 10px; margin-left: 10px;">Suggestion(s) For You
                                <i class="fa fa-window-maximize pull-right maximizeList" title="Expand List"></i>
                                <i class="fa fa-window-minimize pull-right minimizeList" title="Normalize Page"
                                    style="margin-top: -5px;"></i>
                                <img src="" alt="">
                                <br />
                                <span style="font-size: 12px;">The following matches what you need..</span>
                                {{-- <a href="{{ route('main.dashboard', '_connection=set') }}" title=""
                                class="pull-right" style="cursor: pointer;"><button type="button"
                                    class="btn btn-sm btn-danger">Exit >></button></a> --}}
                            </h5>
                            {{-- <h4 class="text-right"></h4> --}}
                            <br />
                        </div>

                        <?php $i=0;?>
                        @foreach($data as $connection)
                        <div class="col-md-4 wow load_result" id="result{{ $connection->user_id }}"
                            data-wow-duration="1.4s">
                            <div class="box">
                                <div class="icon"><img src="{{ asset('asset/img/logo/plogo.png') }}" alt=""
                                        class="iconImg"></div>
                                <h4 class="title" title="{{ $connection->firstname." ".$connection->lastname }}">
                                    <span>{{ str_limit($connection->firstname." ".$connection->lastname, 14) }}</span>
                                </h4>

                                @if(strlen($connection->company) > 4 && strlen($connection->profession) > 4)

                                <p class="description">
                                    {{ str_limit($connection->profession." At ". $connection->company, 18) }}</p>

                                @elseif(strlen($connection->company) > 4 && strlen($connection->position) > 4)

                                <p class="description">
                                    {{ str_limit($connection->position." At ". $connection->company, 18) }}</p>

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
                                <button type="button" class="btn btn-sm btn-primary pull-right addCon"
                                    onclick="addCon({{ $connection->user_id }})" data="{{ $connection->user_id }}"
                                    title="Add to connection" style="margin-top: 5px;"><img
                                        src="{{ asset('asset/img/loading.gif') }}" alt="" class="loading disp-0">Add
                                    +</button>
                            </div>
                        </div>
                        @endforeach

                        @else
                        <div class="col-md-12 wow" data-wow-duration="1.4s">
                            <div class="box">
                                <div class="icon"><img src="{{ asset('asset/img/lock.png') }}" alt=""
                                        style="width: 80px; height: 70px; border-radius: 0px 30px 30px 0px; background: #f6f6f2; object-fit: cover;">
                                </div>
                                <center>
                                    <h4 class="title"><span>Ooops</span></h4>
                                    <p class="description">No Connection Available !!!
                                        <br />
                                        <br />
                                        <a href="{{ route('main.dashboard', '_connection=set') }}"
                                            target="_BLANK"><button class="btn btn-primary" type="button">Return to
                                                Dashboard</button></a>
                                    </p>
                                </center>
                            </div>
                        </div>
                        @endif

                        @else
                        {{-- IF Subscription is Null --}}
                        <div id="addInfo" class="text-center">

                            @if (session('success'))
                                <div class="alert alert-success">
                                  {{ session('success') }}
                                </div>

                            @elseif (session('error'))

                            <div class="alert alert-danger">
                              {{ session('error') }}
                            </div>

                            @endif

                            @php
                              request()->session()->forget(['success', 'error']);
                            @endphp


                            <img src="{{ asset('asset/img/subscribe.png') }}"
                                style="width: 100px; height: 100px; border-radius: 100px;">
                            <br />
                            <br />
                            Thousands of Users Awaiting you
                            <br />
                            <br />


                            @if ($check = App\Subscribe::where('email', $data['userdetails']->email)->first())



                                @else

                                <button type="button" class="btn btn-primary" onclick="triggerSubscribe()">SUBSCRIBE
                                    NOW</button>
                                    <hr />

                                
                            @endif

                            
                            @if($user = App\Subscribe::where('email', $data['userdetails']->email)->where('expiry', '<', date('Y-m-d', strtotime(now())))->first())

                            
                            <button type="button" class="btn btn-primary" onclick="triggerSubscribe()">SUBSCRIBE
                                NOW</button>
                                <hr />
                            
                            @endif
                           
                            Import from other sources?
                            <br />
                            <br />
                            <a
                                href="https://accounts.google.com/o/oauth2/auth?client_id=950089246071-4n54jjosvme0oufrgh3huq362rra7uqg.apps.googleusercontent.com&redirect_uri=https://prochatr.com/app/oauth&scope=https://www.google.com/m8/feeds/&response_type=code"><button
                                    type="button" class="btn btn-xs import"
                                    style="background: #000; color: #FFF;">Google<img
                                        src="{{ asset('asset/img/google.png') }}"
                                        style="width: 28px;"></button></a><button type="button"
                                class="btn btn-info btn-xs import excel">Excel<img
                                    src="{{ asset('asset/img/excel.png') }}" style="width: 28px;"></button>
                        </div>
                        @endif

                    </div>

                    @if(count($data) > 0 && count($checkSubscription) > 0)
                    <div class="row" id="loadmore">
                        <div class="col-md-12 wow" data-wow-duration="1.4s">
                            <div class="box">
                                <div class="icon"><img src="{{ asset('asset/img/more.png') }}" alt=""
                                        style="width: 80px; height: 70px; border-radius: 0px 30px 30px 0px; background: #f6f6f2; object-fit: cover;">
                                </div>
                                <center>
                                    <h4 class="title"><span>Click/Scroll down to load more</span></h4>
                                    <p class="description message"></p>
                                </center>
                            </div>
                        </div>
                    </div>
                    @endif

                </div>
            </div>























        </div>
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
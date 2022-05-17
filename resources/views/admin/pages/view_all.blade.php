@extends('admin.layouts.default')


@section('content')
{{-- Menu Right --}}
@include('admin.includes.toplow')

<br />
<br />
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">      <br />
      <br />
      <h1>
        User Details
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ route('main.admin.index') }}?refresh=true&self="><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">


















      {{-- Agent Transaction Summary --}}
      <h4 class="centersm">{{ $result[0]->firstname." ".$result[0]->lastname }} - {{ $result[0]->state }}</h4>
      <br />
      <div class="row">
        <div class="col-md-12 text-center" id="">


















<div class="col-md-12" style="padding-left: 0px;">

    @if(1)

    {{-- Agent Scope --}}
    @if(1)

      @if($result)

        @if(count($result) > 0)

        <div class="col-md-4 text-center" style="padding: 0px;">
          <img src="{{ asset('asset') }}/img/logo/plogo.png" alt="" width="300">

            <button type="button" class="btn btn-danger col-md-6" style="border-radius: 0px;" title="Remove user record from list">DELETE</button>
            <button type="button" class="btn btn-success col-md-6" style="border-radius: 0px;" title="Chat with user using Messaging">CHAT</button>

        </div>
        <div class="col-md-8">
          <table class="table table-responsive text-left">
            <th colspan="2" style="background: #000; color: #FFF; font-weight: bold; height: 40px;">Personal Details</th>
            <tr><td class="text-right">Firstname</td><td>{{ $result[0]->firstname }}</td></tr>
            <tr><td class="text-right">Lastname</td><td>{{ $result[0]->lastname }}</td></tr>
            <tr><td class="text-right">Email</td><td>{{ $result[0]->email }}</td></tr>
            <tr><td class="text-right">Phone</td><td>{{ $result[0]->phone }}</td></tr>
            <tr><td class="text-right">Position</td><td>{{ $result[0]->position }}</td></tr>
            <tr><td class="text-right">Company</td><td>{{ $result[0]->company }}</td></tr>
           @if ($companylogo != "")
           @if ($companylogo[0]->status == 0)
               <tr><td class="text-right">Coy. Logo</td>
                <td><a href="/companylogo/{{ $companylogo[0]->logo }}" target="_blank" style="color: navy; font-weight: bold;">View</a></td>
                </tr>
           <tr>
               <td class="text-right">&nbsp;</td>
                <td align="center"><button class="btn btn-primary" onclick="activateSpace('{{ $companylogo[0]->login_id }}')" id="btnactivate">Activate Professional Space</button></td>
                </tr>
           @else
                <tr><td class="text-right">View Logo</td>
                <td><a href="/companylogo/{{ $companylogo[0]->logo }}" target="_blank" style="color: green; font-weight: bold;">Activated logo</a></td>
                </tr>
           @endif

            @else
            <tr><td class="text-right">View Logo</td>
                <td>No logo upload</td>
            </tr>
            @endif

            <tr><td class="text-right">City</td><td>{{ $result[0]->city }}</td></tr>
            <tr><td class="text-right">Profession</td><td>{{ $result[0]->profession }}</td></tr>
            <tr><td class="text-right">Country</td><td>{{ $result[0]->country }}</td></tr>






            <th colspan="2" style="background: #000; color: #FFF; font-weight: bold; height: 40px;">Messaging Details</th>
            <tr><td class="text-right">Last Seen</td><td>{{ $result[0]->activity }}</td></tr>
            <tr><td class="text-right">Notification</td><td>{{ $result[0]->notification }}</td></tr>
            <tr><td class="text-right">User Role</td><td>{{ $result[0]->user_role }}</td></tr>




            <th colspan="2" style="background: #000; color: #FFF; font-weight: bold; height: 40px;">Connection Details</th>
            <tr><td class="text-right">Last Seen</td><td>{{ $result[0]->activity }}</td></tr>
            <tr><td class="text-right">Notification</td><td>{{ $result[0]->notification }}</td></tr>
            <tr><td class="text-right">User Role</td><td>{{ $result[0]->user_role }}</td></tr>



          </table>
        </div>

        @else
        <table class="table table-responsive">
          <tr>
            <td colspan="5" class="text-center">Oops ... No transaction found !!!
              <hr />
              <img src="https://www.fresnounified.org/schools/thomas/PublishingImages/calendar.png" alt="" width="300">
              <br />
              <br />
            Kindly use the calendar on the menu to select other dates
            </td>
          </tr>
        </table>
        @endif

      @endif


    {{-- Merchant Scope --}}
    @elseif(session('thiscategory') == "Merchant")


    {{-- Manager Scope --}}
    @elseif(session('thiscategory') == "Manager")

    @endif


    {{-- All Fails : No User--}}
    @else
      <th class="text-center">
        <img src="{{ asset('error.png') }}" alt="">
        <br />
        Oops ... No record found for anonymous user !!!
        <hr />
        Kindly Sign in
      </th>
    @endif

</div>























        </div>
      </div>

























    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
    @include('admin.includes.bottom')

    @include('admin.includes.footer')
@stop

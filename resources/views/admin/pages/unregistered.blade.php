@extends('admin.layouts.default')


@section('content')
{{-- Menu Right --}}
@include('admin.includes.toplow')

<br />
<br />
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <br />
      <br />
      <h1>
        All Unregistered Users
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ route('main.admin.index') }}?refresh=true&self="><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">


















      {{-- Agent Transaction Summary --}}
      <br />
      <div class="row">
        <div class="col-md-12 text-center" id="">


















<div class="col-md-12" style="padding-left: 0px;">

  <table class="table @if(null != session('thisuser')) table-responsive @endif" id="" style="background: #FFF;">
    @if(1)

    {{-- Agent Scope --}}
    @if(1<2)

      @if($reg = \App\Http\Controllers\AdminController::getAll())

        @if(count($reg) > 0)
          <tr>
            <td>#</td>
            <td>Image</td>
            <td class="text-left">Lastname</td>
            <td class="text-left">Firstname</td>
            <td class="text-left">Email</td>
            <td class="text-left">&nbsp;</td>
          </tr>

          <?php $total = 0;?>
          @foreach($reg as $regrecord)
          <?php $total = $total+1;?>
            <tr>
                <td>{{ $total }}</td>
                <td><img src="{{ asset('asset') }}/img/logo/plogo.png" class="user-image" alt="User Image" style="width: 40px; border-radius: 100px;"></td>
                <td class="text-left">{{ $regrecord->firstname }}</td>
                <td class="text-left">{{ $regrecord->lastname }}</td>
                <td class="text-left">{{ $regrecord->email }}</td>
                <td class="text-center"><a href="{{ route('main.admin.details') }}?profile_id={{ $regrecord->user_id }}" target="_BLANK">View Details</a></td>
              
            </tr>
          @endforeach
        @else
          <tr>
            <td colspan="5" class="text-center">Oops ... No transaction found !!!        
              <hr />
              <img src="https://www.fresnounified.org/schools/thomas/PublishingImages/calendar.png" alt="" width="300">
              <br />
              <br />
            Kindly use the calendar on the menu to select other dates
            </td>
          </tr>
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
        Kindly Sign In
      </th>
    @endif
  </table>


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
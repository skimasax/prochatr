@extends('layouts.default')


@section('content')
{{-- Menu Right --}}
@include('includes.toplow')

<br />
<br />
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
        <small>Version 1.0</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ route('reporting') }}?refresh=true&self="><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">




















      <!-- Info boxes -->
      <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="ion ion-android-add"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Inflows</span>
              <span class="info-box-number" id="inflowtotal">0</span>
              <span class="info-box-number" id="inflowpercentage">0<small>%</small></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-red"><i class="fa ion-android-remove"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Outflows</span>
              <span class="info-box-number" id="outflowtotal">0</span>
              <span class="info-box-number" id="outflowpercentage">0%</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <!-- fix for small devices only -->
        <div class="clearfix visible-sm-block"></div>

        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-green"><i class="ion ion-ios-cart-outline"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Transactions</span>
              <span class="info-box-number" id="transaction">0</span>
              <span class="info-box-number" id="transactionpercentage">0%</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="ion ion-android-people"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Members</span>
              <span class="info-box-number" id="membertotal">0</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->





      {{-- Agent Transaction Summary --}}
      <h4 class="centersm">Transaction Summary (Date: {{ app('request')->input('date') }})</h4>
      <br />
      <div class="row">
        <div class="col-md-12 text-center" id="reloads">


















<div class="col-md-12" style="padding-left: 0px;">

  <table class="table @if(null != session('thisuser')) table-responsive @endif" id="report_table" style="background: #FFF;">
    @if(null != session('thisuser'))

    {{-- Agent Scope --}}
    @if(session('thiscategory') == "Agent")

      @if($result)

        @if(count($result) > 0)
          <tr>
            <td>#</td>
            <td class="text-left">TransactionId</td>
            <td>(+) Inflow <BR />(#)</td>
            <td>(-) Outflow <BR />(#)</td>
            <td>Net Amount <BR />(#)</td>
            <td>Running Balance <BR />(#)</td>
            <td>Transaction Date</td>
          </tr>

          <?php $agentcount = -1; $Inflow=0; $Outflow=0; $running = 0; $totalnet = 0;?>
          @foreach($result as $agentrecord)
          <?php 
            $agentcount = $agentcount+1; 
            $net = $agentrecord->Inflow-$agentrecord->Outflow;
            $totalnet = $net+$totalnet;
            $Inflow = $Inflow+$agentrecord->Inflow;
            $Outflow = $Outflow+$agentrecord->Outflow;

            if($agentcount == 1){
              $running = $net;
            }
            else{
              $running = $running+$net;
            }
            
          ?>
            <tr>

                <td>{{ $agentcount+1 }}</td>
                <td class="text-left">{{ $agentrecord->TransactionId }}</td>
                <td>{{ number_format($agentrecord->Inflow, 2) }}</td>
                <td>{{ number_format($agentrecord->Outflow, 2) }}</td>
                <td>{{ number_format($net, 2) }}</td>
                <td>{{ number_format($running, 2) }}</td>
                <td>{{ $agentrecord->TransactionDate }}</td>
              
            </tr>
          @endforeach
            <tr>

                <td>&nbsp;</td>
                <td class="text-right">Total</td>
                <td>{{ number_format($Inflow, 2) }}</td>
                <td>{{ number_format($Outflow, 2) }}</td>
                <td>{{ number_format($totalnet, 2) }}</td>
                <td>{{ number_format($running, 2) }}</td>
                <td></td>
              
            </tr>
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
        Kindly Sign in
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
    @include('includes.bottom')

    @include('includes.footer')
@stop
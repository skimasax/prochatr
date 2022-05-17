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
        Dashboard
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ route('main.admin.index') }}?refresh=true&self="><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">















      {{-- Registered Users Summary --}}
      <h4 class="centersm">Registered Users</h4>
      <br />
      <div class="row">
        <div class="col-md-12 text-center" id="reloads">
          <img src="{{ asset('load.svg') }}" alt="">
          <br />
          Loading Data ...
        </div>
      </div>


























    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
    @include('admin.includes.bottom')

    @include('admin.includes.footer')
@stop
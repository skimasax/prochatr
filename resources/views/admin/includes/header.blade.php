 <!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>@if(null != session('thisuser')) Prochatr | {{ session('thisusername') }} @else Prochatr | Dashboard @endif</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    {{-- CSRF HEADER --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Favicons -->
    <link href="{{ asset('asset/img/logo/plogo.png') }}" rel="icon">
    <link href="{{ asset('asset/img/logo/plogo.png') }}" rel="apple-touch-icon">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="{{ asset('report') }}/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('report') }}/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{ asset('report') }}/bower_components/Ionicons/css/ionicons.min.css">
  <!-- fullCalendar -->
  <link rel="stylesheet" href="{{ asset('report') }}/bower_components/fullcalendar/dist/fullcalendar.min.css">
  <link rel="stylesheet" href="{{ asset('report') }}/bower_components/fullcalendar/dist/fullcalendar.print.min.css" media="print">
  <!-- jvectormap -->
  <link rel="stylesheet" href="{{ asset('report') }}/bower_components/jvectormap/jquery-jvectormap.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('report') }}/dist/css/AdminLTE.min.css">
    <!-- Select2 -->
  <link rel="stylesheet" href="{{ asset('report') }}/bower_components/select2/dist/css/select2.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="{{ asset('report') }}/dist/css/skins/_all-skins.min.css">
  <link rel="stylesheet" href="{{ asset('report') }}/self/style.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
  <!-- jQuery Modal -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" />
  
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/css/iziToast.min.css" integrity="sha256-f6fW47QDm1m01HIep+UjpCpNwLVkBYKd+fhpb4VQ+gE=" crossorigin="anonymous" />


  <!-- Google Font -->
  <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
        <?php use \App\Http\Controllers\HomeController; ?>
        <style type="text/css">
          .main-sidebar{position: fixed;}
          #report_table > tbody > tr:nth-child(1){background: #00c0ef; font-weight: bold; color: #FFF;}
          #report_table > tbody > tr:last-child{background: #00c0ef; font-weight: bold; color: #FFF;}
          #report_table > tbody > tr > td:nth-child(1){background: #3c8dbc; font-weight: bold; color: #FFF;}
          #reloads{padding-right: 0px;}
          .close-modal {top: 10px !important; right: 10px !important;}
          .fc-past{cursor: pointer;}
          .fc-past:hover{color: red !important; font-weight: bold; border-top:3px solid red;}
          @media (max-width: 991px) {
            .centersm{text-align: center;}
          }
        </style>
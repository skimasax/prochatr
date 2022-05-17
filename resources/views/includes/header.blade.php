<!DOCTYPE html>
<html lang="en"> 
    <head>
    <meta charset="utf-8">
    <title>{{ $title }} </title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">
    {{-- CSRF HEADER --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Favicons -->
    <link href="{{ asset('asset/img/logo/plogo.png') }}" rel="icon">
    <link href="{{ asset('asset/img/logo/plogo.png') }}" rel="apple-touch-icon">
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Tangerine">
    <!-- Google Fonts -->
    <link href="{{ asset('asset/css/fonts.css') }}" rel="stylesheet">

    <!-- Bootstrap CSS File -->
    <link href="{{ asset('asset/lib/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css"/>


    <!-- Libraries CSS Files -->
    <link href="{{ asset('asset/lib/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('asset/lib/animate/animate.min.css') }}" rel="stylesheet">
    <link href="{{ asset('asset/lib/ionicons/css/ionicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('asset/lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">
    <link href="{{ asset('asset/lib/lightbox/css/lightbox.min.css') }}" rel="stylesheet">
    {{-- JQuery Modal CSS --}}
    <link rel="stylesheet" href="{{ asset('asset/css/jquery.modal.min.css') }}" />
    <!-- Main Stylesheet File -->
    <link href="{{ asset('asset/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('asset/css/jquerysctipttop.css') }}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="{{ asset('slider/demo/css/index.css') }}" />
    <link rel="stylesheet" href="{{ asset('slider/demo/css/jquery.slide.css') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/css/iziToast.css" integrity="sha256-pODNVtK3uOhL8FUNWWvFQK0QoQoV3YA9wGGng6mbZ0E=" crossorigin="anonymous" />
    <!--Sharethis Dependecy Install-->
    <script type='text/javascript' src='//platform-api.sharethis.com/js/sharethis.js#property=5cfe53124351e9001264ffdb&product=social-ab' async='async'></script>
  <script src="{{asset('asset/js/countries.js')}}"></script>

{{-- Sign up --}}
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->
<style type="text/css">
.load_result{padding:0px;}
.title{text-transform: capitalize;}
#intro-setup{padding: 90px; padding-bottom: 40px; background: url({{ asset('asset/img/network.png') }}) !important; text-align: center;padding-left: 30px; padding-right: 30px;} 
/*.intro-info > span{color: #000 !important;}*/
.intro-info{background: #fff !important;}
/*#intro-setup{padding: 90px; padding-bottom: 40px; background: #000 !important; text-align: center;padding-left: 30px; padding-right: 30px;} */
#intro-setup > div > div > span{color: #1b4cbc;} 
#intro-setup > div > div > h4{color: #000;} 
.iconImg{width: 80px; height: 70px; border-radius: 0px 30px 30px 0px; background: #f6f6f2; object-fit: cover;}
.loading{width: 40px; height: 40px; left: 0px; bottom: 0px; position: absolute;}
.register{
    background: -webkit-linear-gradient(left, #cb2027, #00c6ff);
    height: 100vh;
    padding: 3%;
}
.register-left{
    text-align: center;
    color: #fff;
    margin-top: 4%;
}
.register-left input{
    border: none;
    border-radius: 1.5rem;
    padding: 2%;
    width: 60%;
    background: #f8f9fa;
    font-weight: bold;
    color: #383d41;
    margin-top: 30%;
    margin-bottom: 3%;
    cursor: pointer;
}
.register-right{
    background: #f8f9fa;
    border-top-left-radius: 10% 0%;
    border-bottom-left-radius: 10% 50%;
}
.register-left img{
    margin-top: 15%;
    margin-bottom: 5%;
    width: 25%;
    -webkit-animation: mover 2s infinite  alternate;
    animation: mover 1s infinite  alternate;
}
@-webkit-keyframes mover {
    0% { transform: translateY(0); }
    100% { transform: translateY(-20px); }
}
@keyframes mover {
    0% { transform: translateY(0); }
    100% { transform: translateY(-20px); }
}
.register-left p{
    font-weight: lighter;
    padding: 12%;
    margin-top: -9%;
}
.register .register-form{
    padding: 10%;
    padding-bottom: 13px;
    /*margin-top: 10%;*/
}
.btnRegister{
    float: right;
    margin-top: 10%;
    border: none;
    border-radius: 1.5rem;
    padding: 2%;
    background: #0062cc;
    color: #fff;
    font-weight: 600;
    width: 50%;
    cursor: pointer;
}
.register .nav-tabs{
    margin-top: 3%;
    border: none;
    background: #0062cc;
    border-radius: 1.5rem;
    width: 28%;
    float: right;
}
.register .nav-tabs .nav-link{
    padding: 2%;
    height: 34px;
    font-weight: 600;
    color: #fff;
    border-top-right-radius: 1.5rem;
    border-bottom-right-radius: 1.5rem;
}
.register .nav-tabs .nav-link:hover{
    border: none;
}
.register .nav-tabs .nav-link.active{
    width: 100%;
    color: #0062cc;
    border: 2px solid #0062cc;
    border-top-left-radius: 1.5rem;
    border-bottom-left-radius: 1.5rem;
}
.register-heading{
    text-align: center;
    margin-top: 8%;
    margin-bottom: -15%;
    color: #495057;
}
.register .nav-tabs{width: 100% !important; height: auto !important}
.card-header{background: #1b4d90;}
</style>
{{-- END of Signup --}}
    <?php use \App\Http\Controllers\AjaxController; ?>
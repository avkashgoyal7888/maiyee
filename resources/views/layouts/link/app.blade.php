<!DOCTYPE html>
<html class="no-js" lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="x-ua-compatible" content="ie=edge">
<!-- <title>Welcome To Maiyee</title> -->
<meta name="description" content="description">
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- Favicon -->
<link rel="shortcut icon" href="https://res.cloudinary.com/dzujz2mkt/image/upload/v1688378123/maiyee.png" />
<!-- Plugins CSS -->
<link rel="stylesheet" href="{{asset('front/assets/css/plugins.css')}}">
<!-- Bootstap CSS -->
<link rel="stylesheet" href="{{asset('front/assets/css/bootstrap.min.css')}}">
<!-- Main Style CSS -->
<link rel="stylesheet" href="{{asset('front/assets/css/style.css')}}">
<link rel="stylesheet" href="{{asset('front/assets/css/responsive.css')}}">
<!-- Footer Style CSS -->
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
@yield('css')

</head>
<body class="template-index">
<section class="home2-default">
<div class="pageWrapper">
<div id="page-content">
    <!--Home slider-->
    @yield('content') 
    <!--End Featured Product-->
    
</div>
    <!--Scoll Top-->
    <span id="site-scroll"><i class="icon anm anm-angle-up-r"></i></span>
    <!--End Scoll Top-->
</div>
</div>
</div>
    
     <!-- Including Jquery -->
     <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
     <script src="{{asset('front/assets/js/vendor/modernizr-3.6.0.min.js')}}"></script>
     <script src="{{asset('front/assets/js/vendor/jquery.cookie.js')}}"></script>
     <script src="{{asset('front/assets/js/vendor/wow.min.js')}}"></script>
     <!-- Including front/g Javascript -->
     <script src="{{asset('front/assets/js/bootstrap.min.js')}}"></script>
     <script src="{{asset('front/assets/js/plugins.js')}}"></script>
     <script src="{{asset('front/assets/js/popper.min.js')}}"></script>
     <script src="{{asset('front/assets/js/lazysizes.js')}}"></script>
     <script src="{{asset('front/assets/js/main.js')}}"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
     @yield('js')
</div>
</section>
</body>

</html>
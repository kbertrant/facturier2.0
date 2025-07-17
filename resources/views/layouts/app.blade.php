<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Votre facturier 2.0') }} @yield('title')</title>

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="../assets/img/favicon/favicon.ico" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet"
    />

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/boxicons.css')}}" />
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css')}}" />
    <link rel="stylesheet" href="{{ asset('assets/css/lineicons.css')}}" />
    <link rel="stylesheet" href="{{ asset('assets/css/animate.cs')}}" />
    <link rel="stylesheet" href="{{ asset('assets/css/main.css')}}" />
    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/core.css')}}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/theme-default.css')}}" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('assets/css/demo.css')}}" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css')}}" />

    <!-- Page CSS -->
    <!-- Page -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/page-auth.css')}}" />
    <!-- Helpers -->
    <script src="{{ asset('assets/vendor/js/helpers.js')}}"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="../assets/js/config.js"></script>
    <!-- Scripts -->
    {{-- @vite(['resources/sass/app.scss', 'resources/js/app.js']) --}}
    <style>
        .pageLoader{
          background: url(assets/img/Iphone-spinner-2.gif) no-repeat center center;
          position: fixed;
          top: 0;
          left: 0;
          height: 100%;
          width: 100%;
          z-index: 9999999;
          background-color: #ffffff8c;
  
        }
        .single_price_plan {
    position: relative;
    z-index: 1;
    border-radius: 0.5rem 0.5rem 0 0;
    -webkit-transition-duration: 500ms;
    transition-duration: 500ms;
    margin-bottom: 50px;
    background-color: #ffffff;
    padding: 3rem 4rem;
}
@media only screen and (min-width: 992px) and (max-width: 1199px) {
    .single_price_plan {
        padding: 3rem;
    }
}
@media only screen and (max-width: 575px) {
    .single_price_plan {
        padding: 3rem;
    }
}
.single_price_plan::after {
    position: absolute;
    content: "";
    background-image: url("https://bootdey.com/img/half-circle-pricing.png");
    background-repeat: repeat;
    width: 100%;
    height: 17px;
    bottom: -17px;
    z-index: 1;
    left: 0;
}
.single_price_plan .title {
    text-transform: capitalize;
    -webkit-transition-duration: 500ms;
    transition-duration: 500ms;
    margin-bottom: 2rem;
}
.single_price_plan .title span {
    color: #ffffff;
    padding: 0.2rem 0.6rem;
    font-size: 12px;
    text-transform: uppercase;
    background-color: #2ecc71;
    display: inline-block;
    margin-bottom: 0.5rem;
    border-radius: 0.25rem;
}
.single_price_plan .title h3 {
    font-size: 1.25rem;
}
.single_price_plan .title p {
    font-weight: 300;
    line-height: 1;
    font-size: 14px;
}
.single_price_plan .title .line {
    width: 80px;
    height: 4px;
    border-radius: 10px;
    background-color: #3f43fd;
}
.single_price_plan .price {
    margin-bottom: 1.5rem;
}
.single_price_plan .price h4 {
    position: relative;
    z-index: 1;
    font-size: 2.4rem;
    line-height: 1;
    margin-bottom: 0;
    color: #3f43fd;
    display: inline-block;
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-color: transparent;
    background-image: -webkit-gradient(linear, left top, right top, from(#e24997), to(#2d2ed4));
    background-image: linear-gradient(90deg, #e24997, #2d2ed4);
}
.single_price_plan .description {
    position: relative;
    margin-bottom: 1.5rem;
}
.single_price_plan .description p {
    line-height: 16px;
    margin: 0;
    padding: 10px 0;
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-align: center;
    -ms-flex-align: center;
    -ms-grid-row-align: center;
    align-items: center;
}
.single_price_plan .description p i {
    color: #2ecc71;
    margin-right: 0.5rem;
}
.single_price_plan .description p .lni-close {
    color: #e74c3c;
}
.single_price_plan.active,
.single_price_plan:hover,
.single_price_plan:focus {
    -webkit-box-shadow: 0 6px 50px 8px rgba(21, 131, 233, 0.15);
    box-shadow: 0 6px 50px 8px rgba(21, 131, 233, 0.15);
}
.single_price_plan .side-shape img {
    position: absolute;
    width: auto;
    top: 0;
    right: 0;
    z-index: -2;
}

.section-heading h3 {
    margin-bottom: 1rem;
    font-size: 3.125rem;
    letter-spacing: -1px;
}

.section-heading p {
    margin-bottom: 0;
    font-size: 1.25rem;
}

.section-heading .line {
    width: 120px;
    height: 5px;
    margin: 30px auto 0;
    border-radius: 6px;
    background: #2d2ed4;
    background: -webkit-gradient(linear, left top, right top, from(#e24997), to(#2d2ed4));
    background: linear-gradient(to right, #e24997, #2d2ed4);
}
.red-star {
  color: red;
}
      </style>
</head>
<body>
    <div  class="pageLoader" id="pageLoaders"></div>
    
            @yield('content')
        
    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="{{ asset('assets/vendor/libs/jquery/jquery.js')}}"></script>
    <script src="{{ asset('assets/vendor/libs/popper/popper.js')}}"></script>
    <script src="{{ asset('assets/vendor/js/bootstrap.js')}}"></script>
    <script src="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js')}}"></script>

    <script src="{{ asset('assets/vendor/js/menu.js')}}"></script> 
    <!-- endbuild -->

    <!-- Vendors JS -->

    <!-- Main JS -->
    <script src="{{ asset('assets/js/main.js')}}"></script> 
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{ asset('assets/js/wow.min.js')}}"></script>
    <script src="{{ asset('assets/js/main2.js')}}"></script>
    <!-- Page JS -->
</body>
<script type="text/javascript">
    $(window).on('beforeunload', function(){
          $('#pageLoaders').show();
      });
      $(window).bind("pageshow", function(event) {
        $("#pageLoaders").hide();
      });
   $(document).ready(function() { 
        let token = $('#csrf').html();
        $.ajax({ 
            type:'POST', 
            url:'/ajax', 
            data: {_token: token, my_data: 'john'}
        }); 
    }); 
    </script>
</html>

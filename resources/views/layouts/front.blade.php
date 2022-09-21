<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width,initial-scale=1">
   <!-- CSRF Token -->
   <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>@yield('title')</title>
  <!-- Iconic Fonts -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="{{asset('vendors/iconic-fonts/font-awesome/css/all.min.css')}}" rel="stylesheet">
  <link rel="stylesheet" href="{{asset('vendors/iconic-fonts/flat-icons/flaticon.css')}}">
  <link rel="stylesheet" href="{{asset('vendors/iconic-fonts/cryptocoins/cryptocoins.css')}}">
  <link rel="stylesheet" href="{{asset('vendors/iconic-fonts/cryptocoins/cryptocoins-colors.css')}}">
  <!-- Bootstrap core CSS -->
  <link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet">
  <!-- jQuery UI -->
  <link href="{{asset('assets/css/jquery-ui.min.css')}}" rel="stylesheet">

  <!-- Greendash styles -->
  <link href="{{asset('assets/css/style.css')}}" rel="stylesheet">
  <!-- Favicon -->
  <link rel="icon" type="image/png" sizes="32x32" href="{{asset('favicon.ico')}}">
  @yield('head')
</head>

<body class="ms-body ms-aside-left-open ms-primary-theme ">

    @include('frontend.sections.loader')

    @include('frontend.sections.sidebar-left')


  <!-- Main Content -->
  <main class="body-content">

    @include('frontend.sections.header')

    <!-- Body Content Wrapper -->
    <div class="ms-content-wrapper">
        @include('frontend.sections.flashmessage')
        @yield('content')
    </div>

  </main>




  <!-- SCRIPTS -->
  <!-- Global Required Scripts Start -->
  <script src="{{ asset('assets/js/jquery-3.3.1.min.js')}}"></script>
  <script src="{{ asset('assets/js/popper.min.js')}}"></script>
  <script src="{{ asset('assets/js/bootstrap.min.js')}}"></script>
  <script src="{{ asset('assets/js/perfect-scrollbar.js')}}"> </script>
  <script src="{{ asset('assets/js/jquery-ui.min.js')}}"> </script>
  <!-- Global Required Scripts End -->

  <!-- Page Specific Scripts Start -->
    @stack('scripts')
  <!-- Page Specific Scripts End -->

  <!-- Greendash core JavaScript -->
  <script src="{{ asset('assets/js/framework.js') }}"></script>

  <!-- Settings -->
  <script src="{{ asset('assets/js/settings.js') }}"></script>

  <!--Start of Tawk.to Script-->
<script type="text/javascript">
    var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
    (function(){
    var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
    s1.async=true;
    s1.src='https://embed.tawk.to/6086967662662a09efc227be/1f46rngfd';
    s1.charset='UTF-8';
    s1.setAttribute('crossorigin','*');
    s0.parentNode.insertBefore(s1,s0);
    })();
    </script>
    <!--End of Tawk.to Script-->

</body>

</html>

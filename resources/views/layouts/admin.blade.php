<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>@yield('title')</title>
    <!-- Iconic Fonts -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="{{ asset('vendors/iconic-fonts/font-awesome/css/all.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('vendors/iconic-fonts/flat-icons/flaticon.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/iconic-fonts/cryptocoins/cryptocoins.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/iconic-fonts/cryptocoins/cryptocoins-colors.css') }}">
    <!-- Bootstrap core CSS -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- jQuery UI -->
    <link href="{{ asset('assets/css/jquery-ui.min.css') }}" rel="stylesheet">
    @yield('head')
    <!-- Greendash styles -->
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
    <!-- Icon styles -->
    <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet">
    <!-- Favicon -->
    <link rel="icon" type="image/png"  href="{{ asset('favicon.png') }}">

</head>

<body class="ms-body ms-aside-left-open ms-primary-theme ">

    @include('admin.sections.loader')

    @include('admin.sections.sidebar-left')


    <!-- Main Content -->
    <main class="body-content">

        @include('admin.sections.header')

        <!-- Body Content Wrapper -->
        <div class="ms-content-wrapper">
            @include('admin.sections.flashmessage')
            @yield('content')
        </div>

    </main>




    <!-- SCRIPTS -->
    <!-- Global Required Scripts Start -->
    <script src="{{ asset('assets/js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('assets/js/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('assets/js/jquery-ui.min.js') }}"></script>
    <!-- Global Required Scripts End -->

    <!-- Page Specific Scripts Start -->
    @stack('scripts')
    <!-- Page Specific Scripts End -->

    <!-- Greendash core JavaScript -->
    <script src="{{ asset('assets/js/framework.js') }}"></script>

    <!-- Settings -->
    <script src="{{ asset('assets/js/settings.js') }}"></script>
    <script>
        function executeQuery() {
            $.ajax({
                url: "{{route('admin.check-notifications')}}",
                method: 'get',
                success: function(data){
                   $('#notification-count').text(data);
                }
            });

        };

        $(document).ready(function(){
            setInterval(executeQuery,3000);
        });
    </script>

</body>

</html>

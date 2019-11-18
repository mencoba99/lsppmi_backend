<!DOCTYPE html>

<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
    <html lang="{{ config('app.locale') }}">
            <!--<![endif]-->
            <!-- BEGIN HEAD -->
        
            <head>
                <meta charset="utf-8" />
                <title>{{ config('app.name', '') }}</title>
                
                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <meta content="width=device-width, initial-scale=1" name="viewport" />
                <meta content="Aplikasi SIAK - TICMI" name="description" />
                <meta content="" name="author" />
                
                <!-- CSRF Token -->
                <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- after login -->
       {{--  @if(Auth::check()) --}}
            <!-- BEGIN GLOBAL MANDATORY STYLES -->
            <!-- TICMI ASSETS -->
            {{-- <link href="https://ticmi.co.id/assets/psp/css/lib/libs.css"rel="stylesheet">
            <link href="https://ticmi.co.id/assets/psp/css/theme.css"rel="stylesheet">
            <link href="https://ticmi.co.id/assets/psp/css/default.css"rel="stylesheet"> --}}
            <!-- END TICMI ASSETS -->
            <!-- FAVICON -->
            <link rel="shortcut icon" href="favicon.png">
            {{-- <link rel="apple-touch-icon" sizes="57x57" href="https://ticmi.co.id/assets/psp/favicon/apple-icon-57x57.png">
            <link rel="apple-touch-icon" sizes="60x60" href="https://ticmi.co.id/assets/psp/favicon/apple-icon-60x60.png">
            <link rel="apple-touch-icon" sizes="72x72" href="https://ticmi.co.id/assets/psp/favicon/apple-icon-72x72.png">
            <link rel="apple-touch-icon" sizes="76x76" href="https://ticmi.co.id/assets/psp/favicon/apple-icon-76x76.png">
            <link rel="apple-touch-icon" sizes="114x114" href="https://ticmi.co.id/assets/psp/favicon/apple-icon-114x114.png">
            <link rel="apple-touch-icon" sizes="120x120" href="https://ticmi.co.id/assets/psp/favicon/apple-icon-120x120.png">
            <link rel="apple-touch-icon" sizes="144x144" href="https://ticmi.co.id/assets/psp/favicon/apple-icon-144x144.png">
            <link rel="apple-touch-icon" sizes="152x152" href="https://ticmi.co.id/assets/psp/favicon/apple-icon-152x152.png">
            <link rel="apple-touch-icon" sizes="180x180" href="https://ticmi.co.id/assets/psp/favicon/apple-icon-180x180.png">
            <link rel="icon" type="image/png" sizes="192x192"  href="https://ticmi.co.id/assets/psp/favicon/android-icon-192x192.png">
            <link rel="icon" type="image/png" sizes="32x32" href="https://ticmi.co.id/assets/psp/favicon/favicon-32x32.png">
            <link rel="icon" type="image/png" sizes="96x96" href="https://ticmi.co.id/assets/psp/favicon/favicon-96x96.png">
            <link rel="icon" type="image/png" sizes="16x16" href="https://ticmi.co.id/assets/psp/favicon/favicon-16x16.png"> --}}
            <link rel="manifest" href="https://ticmi.co.id/assets/psp/favicon/manifest.json">
            <meta name="msapplication-TileColor" content="#ffffff">
            <meta name="msapplication-TileImage" content="https://ticmi.co.id/assets/psp/favicon/ms-icon-144x144.png">
            <meta name="theme-color" content="#ffffff">
            <!-- END FAVICON -->
            <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
            <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/fontawesome.min.css"rel="stylesheet">
            <link href="https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.4.1/css/simple-line-icons.min.css"rel="stylesheet">
            <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap-grid.min.css"rel="stylesheet">
            <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-switch/3.3.4/css/bootstrap2/bootstrap-switch.min.css"rel="stylesheet">
            <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/css/select2.min.css"rel="stylesheet" type="text/css" />
            <link href="https://cdnjs.cloudflare.com/ajax/libs/select2-bootstrap-css/1.4.6/select2-bootstrap.min.css"rel="stylesheet" type="text/css" />
            <link href="https://ticmi.co.id/assets/theme/global/plugins/own_config/tambahan.css"rel="stylesheet">
            <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css" />
            <!-- END GLOBAL MANDATORY STYLES -->
            
            <!-- BEGIN THEME GLOBAL STYLES -->
            <link href="https://ticmi.co.id/assets/theme/global/css/components.min.css"rel="stylesheet">
            <link href="https://ticmi.co.id/assets/theme/global/css/plugins.min.css"rel="stylesheet">
            <!-- END THEME GLOBAL STYLES -->
            
            <!-- BEGIN THEME LAYOUT STYLES -->
            <link href="https://ticmi.co.id/assets/theme/layouts/layout4/css/layout.min.css"rel="stylesheet">
            <link href="https://ticmi.co.id/assets/theme/layouts/layout4/css/themes/default.min.css"rel="stylesheet">
            <link href="https://ticmi.co.id/assets/theme/layouts/layout4/css/custom.min.css"rel="stylesheet">
            <!-- END THEME LAYOUT STYLES -->
            <!-- YAJRA DATATABLES -->
            <link rel="stylesheet" href="https://datatables.yajrabox.com/highlight/styles/zenburn.css">
            <!-- <link rel="shortcut icon" href="favicon.ico" /> -->
            <link rel="stylesheet" type="text/css" href="https://ticmi.co.id/assets/fullcalendar/fullcalendar.min.css">
            <!-- <link href="https://ticmi.co.id/assets/fullcalendar/fullcalendar.print.css"rel="stylesheet" media="print" /> -->
            <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
            
            <!-- jquery -->
            {{-- <script src="https://ticmi.co.id/assets/theme/global/plugins/jquery.min.js"></script> --}}
            <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
            <!-- <script src="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.js"></script> -->
            <script src="https://ticmi.co.id/assets/fullcalendar/fullcalendar.min.js"></script>
            <!--[if lt IE 9]>
            <script src="https://ticmi.co.id/assets/theme/global/plugins/respond.min.js"></script>
            <script src="https://ticmi.co.id/assets/theme/global/plugins/excanvas.min.js"></script>
            <script src="https://ticmi.co.id/assets/theme/global/plugins/ie8.fix.min.js"></script>
            <![endif]-->


            <!-- BEGIN CORE PLUGINS -->
            <script src="https://ticmi.co.id/assets/theme/global/plugins/bootstrap/js/bootstrap.min.js"></script>
            <script src="https://ticmi.co.id/assets/theme/global/plugins/js.cookie.min.js"></script>
            <script src="https://ticmi.co.id/assets/theme/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js"></script>
            <script src="https://ticmi.co.id/assets/theme/global/plugins/jquery.blockui.min.js"></script>
            <script src="https://ticmi.co.id/assets/theme/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
            <!-- END CORE PLUGINS -->

            <script src="https://ticmi.co.id/assets/theme/global/plugins/bootstrap-tabdrop/js/bootstrap-tabdrop.js"type="text/javascript"></script>

            <!-- BEGIN THEME GLOBAL SCRIPTS -->
            <script src="https://ticmi.co.id/assets/theme/global/scripts/app.min.js"></script>
            <!-- END THEME GLOBAL SCRIPTS -->
            <script type="text/javascript" src="https://ticmi.co.id/assets/js/script.js"></script>
            <!-- BEGIN THEME LAYOUT SCRIPTS -->
            <script src="https://ticmi.co.id/assets/theme/layouts/layout4/scripts/layout.min.js"></script>
            <script src="https://ticmi.co.id/assets/theme/layouts/layout4/scripts/demo.min.js"></script>
            <script src="https://ticmi.co.id/assets/theme/layouts/global/scripts/quick-sidebar.min.js"></script>
            <script src="https://ticmi.co.id/assets/theme/layouts/global/scripts/quick-nav.min.js"></script>
            <script src="https://ticmi.co.id/assets/theme/global/plugins/select2/js/select2.full.min.js"type="text/javascript"></script>
            <script src="https://ticmi.co.id/assets/theme/pages/scripts/components-select2.min.js"type="text/javascript"></script>
            <script src="https://ticmi.co.id/assets/theme/global/plugins/jquery-number/jquery.number.js"type="text/javascript"></script>
            <script src="https://ticmi.co.id/vendor/jsvalidation/js/jsvalidation.js" type="text/javascript"></script>
            <script src="https://ticmi.co.id/assets/theme/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"type="text/javascript"></script>
            <!-- END THEME LAYOUT SCRIPTS -->
            
            <!-- Scripts -->
            <script>
                window.Laravel = {!! json_encode([
                    'csrfToken' => csrf_token(),
                ]) !!};
            </script>
            <style>
            .page-header-fixed .page-container
            {
                background: #ffffff !important;
            }
            </style>
            <body class="page-container-bg-solid page-header-fixed page-sidebar-closed-hide-logo">
                {{-- <section class="relative bg-light typo-dark parallax-bg bg-cover overlay white md" data-background="https://ticmi.co.id/assets/images/ticmi/library-ticmi-small.jpg" data-stellar-background-ratio="0.5" style="background-image: url(&quot;https://ticmi.co.id/assets/images/ticmi/library-ticmi-small.jpg&quot;); background-position: -15.75px -43px;"> --}}
                @include('layouts.header')
                <!-- BEGIN CONTAINER -->
                <div class="page-container">
                    @if(Auth::check())
                        @include('layouts.ujian.sidebar')
                    @endif
    </head>
    <!-- END HEAD -->


            @yield('content')

    
    <!-- after login -->
    @if(Auth::check())
        </div>
         <!-- END CONTAINER -->
        @include('layouts.ujian.footer')
    @endif
    
    </body>
</html>
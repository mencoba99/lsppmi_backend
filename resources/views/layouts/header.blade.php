<!DOCTYPE html>
<html lang="en">

<!-- begin::Head -->
<head>

    <!--begin::Base Path (base relative path for assets of this page) -->
    <base href="../">

    <!--end::Base Path -->
    <meta charset="utf-8" />
    <title>LSPPMI | Dashboard</title>
    <meta name="description" content="Latest updates and statistic charts">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!--begin::Fonts -->
    <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js"></script>
    <script>
        WebFont.load({
            google: {
                "families": ["Poppins:300,400,500,600,700", "Roboto:300,400,500,600,700"]
            },
            active: function() {
                sessionStorage.fonts = true;
            }
        });
    </script>

    <!--end::Fonts -->

    <!--begin::Page Vendors Styles(used by this page) -->
    <link href="{{ Storage::url('vendors/custom/fullcalendar/fullcalendar.bundle.css') }}" rel="stylesheet" type="text/css" />
    {{-- <link href="{{ Storage::url('css/jstree.bundle.css') }}" rel="stylesheet" type="text/css" /> --}}
 
    <!--end::Page Vendors Styles -->

    <!--begin::Global Theme Styles(used by all pages) -->
   
    <link href="{{ asset('assets/vendors/global/vendors.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ Storage::url('css/demo7/style.bundle.css') }}" rel="stylesheet" type="text/css" />
   
    <link href="{{ asset('assets/vendors/global/datatable/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="http://static.jstree.com/3.0.0-beta3/assets/dist/themes/default/style.min.css" rel="stylesheet" type="text/css" />
   
    <!--end::Global Theme Styles -->

    <!--begin::Layout Skins(used by all pages) -->

    <!--end::Layout Skins -->
    <link rel="shortcut icon" href="{{ Storage::url('media/logos/favicon.ico') }}" />
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js" ></script>
    @stack('style')
</head>

<!-- end::Head -->

<!DOCTYPE html>
<html lang="en">

<!-- begin::Head -->
<head>

    <!--begin::Base Path (base relative path for assets of this page) -->
    <base href="../">

    <!--end::Base Path -->
    <meta charset="utf-8" />
    <title>LSPPMI | {{ GeneralHelper::getPageTitle() }}</title>
    <meta name="description" content="Latest updates and statistic charts">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

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
    <link href="{{ Storage::url('assets/backend/vendors/custom/fullcalendar/fullcalendar.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ Storage::url('assets/backend/vendors/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />


    <!--end::Page Vendors Styles -->

    <!--begin::Global Theme Styles(used by all pages) -->
    <link href="{{ asset('assets/vendors/global/vendors.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ Storage::url('assets/backend/css/demo7/style.bundle.css') }}" rel="stylesheet" type="text/css" />

    <!--end::Global Theme Styles -->
    @stack('style')

    <!--begin::Layout Skins(used by all pages) -->
    <link href="{{ asset('assets/css/lsppmi-custom.css') }}" rel="stylesheet" type="text/css" />

    <!--end::Layout Skins -->
    <link rel="shortcut icon" href="{{ Storage::url('assets/backend/media/logos/favicon.ico') }}" />
</head>

<!-- end::Head -->

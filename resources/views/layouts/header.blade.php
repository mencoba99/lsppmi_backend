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
    <link href="{{ asset('assets/css/lsppmi-custom.css') }}" rel="stylesheet" type="text/css" />
    {{-- <link href="{{ Storage::url('assets/backend/vendors/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
 --}}

    <!--end::Page Vendors Styles -->

    <!--begin::Global Theme Styles(used by all pages) -->
    <link href="{{ asset('assets/vendors/global/vendors.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ Storage::url('assets/backend/css/demo7/style.bundle.css') }}" rel="stylesheet" type="text/css" />

    <link href="{{ asset('assets/vendors/global/datatable/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
    {{-- <link href="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.3.8/themes/default/style.min.css" rel="stylesheet" type="text/css" /> --}}
   
    <!--end::Global Theme Styles -->
    @stack('style')
    <style>
            .centerdiv {
                position: absolute;
                top: 50%;
                left: 50%;
                -moz-transform: translateX(-50%) translateY(-50%);
                -webkit-transform: translateX(-50%) translateY(-50%);
                transform: translateX(-50%) translateY(-50%);
                z-index: 999;
            }

            .google-loader {
  display: block;
}

.google-loader span {
  display: inline-block;
  margin-top: 10px;
  height: 20px;
  width: 20px;
  border-radius: 50%;
}

.google-loader span:not(:first-child) {
  margin-left: 10px;
}

.google-loader span:nth-child(1) {
  background: #4285F4;
  animation: move 1s ease-in-out -0.25s infinite alternate;
}

.google-loader span:nth-child(2) {
  background: #DB4437;
  animation: move 1s ease-in-out -0.5s infinite alternate;
}

.google-loader span:nth-child(3) {
  background: #F4B400;
  animation: move 1s ease-in-out -0.75s infinite alternate;
}

.google-loader span:nth-child(4) {
  background: #0F9D58;
  animation: move 1s ease-in-out -1s infinite alternate;
}

@keyframes move {
  from {
    transform: translateY(-10px);
  }
  to {
    transform: translateY(5px);
  }
}
h1 {
  font-family: "Montserrat", sans-serif;
  font-size: 4em;
  text-align: center;
  letter-spacing: -8px;
  margin-top: 0;
}

h1 span:first-child {
  color: #4285F4;
}

h1 span:nth-child(2) {
  color: #DB4437;
}

h1 span:nth-child(3) {
  color: #F4B400;
}

h1 span:nth-child(4) {
  color: #4285F4;
}
h1 span:nth-child(5) {
  color: #0F9D58;
}

h1 span:last-child {
  color: #DB4437;
  transform: rotate(-20deg);
  display: inline-block;
}
        </style>
    <!--begin::Layout Skins(used by all pages) -->
  

    <!--end::Layout Skins -->
    <link rel="shortcut icon" href="{{ Storage::url('assets/backend/media/logos/favicon.ico') }}" />
</head>

<!-- end::Head -->

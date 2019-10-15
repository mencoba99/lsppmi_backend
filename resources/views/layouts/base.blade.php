@include('layouts.header')
<!-- begin::Body -->
<body class="kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--fixed kt-header-mobile--fixed kt-subheader--enabled kt-subheader--transparent kt-aside--enabled kt-aside--fixed kt-aside--minimize kt-page--loading">

<!-- begin:: Page -->

<!-- begin:: Header Mobile -->
<div id="kt_header_mobile" class="kt-header-mobile  kt-header-mobile--fixed ">
    <div class="kt-header-mobile__logo">
        <a href="demo7/index.html">
            <img alt="Logo" src="{{ Storage::url('media/logos/logo-6.png') }}" />
        </a>
    </div>
    <div class="kt-header-mobile__toolbar">
        <button class="kt-header-mobile__toolbar-toggler kt-header-mobile__toolbar-toggler--left" id="kt_aside_mobile_toggler"><span></span></button>
        <button class="kt-header-mobile__toolbar-toggler" id="kt_header_mobile_toggler"><span></span></button>
        <button class="kt-header-mobile__toolbar-topbar-toggler" id="kt_header_mobile_topbar_toggler"><i class="flaticon-more"></i></button>
    </div>
</div>

<!-- end:: Header Mobile -->


<div class="kt-grid kt-grid--hor kt-grid--root">
    <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--ver kt-page">

        @include('layouts.sidemenu')

        <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-wrapper" id="kt_wrapper">

            @include('layouts.header-menu')

            <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor">

                <!-- begin:: Content -->
                {!! GeneralHelper::getBreadcrumb() !!}
                @yield('content', 'Default Content')

                <!-- end:: Content -->
            </div>

            <!-- begin:: Footer -->
            @include('layouts.footer')
            <!-- end:: Footer -->
        </div>
    </div>
</div>

<!-- end:: Page -->

@include('layouts.widget')

{!! Form::input('hidden','base_url',url('/')) !!}
{!! Form::input('hidden','_token',csrf_token()) !!}
<!-- begin::Global Config(global config for global JS sciprts) -->
<script>
    var KTAppOptions = {
        "colors": {
            "state": {
                "brand": "#22b9ff",
                "light": "#ffffff",
                "dark": "#282a3c",
                "primary": "#5867dd",
                "success": "#34bfa3",
                "info": "#36a3f7",
                "warning": "#ffb822",
                "danger": "#fd3995"
            },
            "base": {
                "label": ["#c5cbe3", "#a1a8c3", "#3d4465", "#3e4466"],
                "shape": ["#f0f3ff", "#d9dffa", "#afb4d4", "#646c9a"]
            }
        }
    };
</script>

<!-- end::Global Config -->

<!--begin::Global Theme Bundle(used by all pages) -->
{{--<script src="./assets/vendors/global/vendors.bundle.js" type="text/javascript"></script>--}}
{{--<script src="./assets/js/demo7/scripts.bundle.js" type="text/javascript"></script>--}}
<script src="{{ asset('assets/vendors/global/vendors.bundle.js') }}" type="text/javascript"></script>
<script src="{{ Storage::url('js/scripts.bundle.js') }}" type="text/javascript"></script>

<!--end::Global Theme Bundle -->

<!--begin::Page Vendors(used by this page) -->
<script src="{{ Storage::url('vendors/custom/fullcalendar/fullcalendar.bundle.js') }}" type="text/javascript"></script>
<script src="//maps.google.com/maps/api/js?key=AIzaSyBTGnKT7dt597vo9QgeQ7BFhvSRP4eiMSM" type="text/javascript"></script>
<script src="{{ Storage::url('vendors/custom/gmaps/gmaps.js') }}" type="text/javascript"></script>

<!--end::Page Vendors -->

<!--begin::Page Scripts(used by this page) -->
<script src="{{ Storage::url('js/pages/dashboard.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/js/lsppmi-custom.js') }}" type="text/javascript"></script>

@stack('script')

<!--end::Page Scripts -->

<script type="text/javascript">
    $(document).ready(function () {
    })
</script>
</body>

<!-- end::Body -->
</html>

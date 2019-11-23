<?php echo $__env->make('layouts.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<!-- begin::Body -->
<body class="kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--fixed kt-header-mobile--fixed kt-subheader--enabled kt-subheader--transparent kt-aside--enabled kt-aside--fixed kt-aside--minimize kt-page--loading">

<!-- begin:: Page -->

<!-- begin:: Header Mobile -->
<div id="kt_header_mobile" class="kt-header-mobile  kt-header-mobile--fixed ">
    <div class="kt-header-mobile__logo">
        <a href="demo7/index.html">
            <img alt="Logo" src="<?php echo e(Storage::url('assets/backend/media/logos/logo-6.png')); ?>" />
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

        <?php echo $__env->make('layouts.sidemenu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-wrapper" id="kt_wrapper">

            <?php echo $__env->make('layouts.header-menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

            <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor">

                <!-- begin:: Content -->
            <?php echo GeneralHelper::getBreadcrumb(); ?>

            <?php echo $__env->yieldContent('content', 'Default Content'); ?>

            <!-- end:: Content -->
            </div>

            <!-- begin:: Footer -->
        <?php echo $__env->make('layouts.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <!-- end:: Footer -->
        </div>
    </div>
</div>

<!-- end:: Page -->

<?php echo $__env->make('layouts.widget', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php echo Form::input('hidden','base_url',url('/')); ?>

<?php echo Form::input('hidden','_token',csrf_token()); ?>

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
                "danger": "#FD3943"
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
<script src="<?php echo e(asset('assets/vendors/global/vendors.bundle.js')); ?>" type="text/javascript"></script>
<script src="<?php echo e(Storage::url('assets/backend/js/scripts.bundle.js')); ?>" type="text/javascript"></script>


<!--end::Global Theme Bundle -->

<!--begin::Page Vendors(used by this page) -->
<script src="<?php echo e(Storage::url('assets/backend/vendors/custom/fullcalendar/fullcalendar.bundle.js')); ?>" type="text/javascript"></script>
<script src="//maps.google.com/maps/api/js?key=AIzaSyBTGnKT7dt597vo9QgeQ7BFhvSRP4eiMSM" type="text/javascript"></script>
<script src="<?php echo e(Storage::url('assets/backend/vendors/custom/gmaps/gmaps.js')); ?>" type="text/javascript"></script>

<!--end::Page Vendors -->

<!--begin::Page Scripts(used by this page) -->
<script src="<?php echo e(Storage::url('assets/backend/js/jstree.bundle.js')); ?>" type="text/javascript"></script>
<script src="<?php echo e(Storage::url('assets/backend/js/treeview.js')); ?>" type="text/javascript"></script>


<script src="<?php echo e(Storage::url('assets/backend/js/pages/dashboard.js')); ?>" type="text/javascript"></script>
<script src="<?php echo e(asset('assets/js/lsppmi-custom.js')); ?>" type="text/javascript"></script>

<?php echo $__env->yieldPushContent('script'); ?>

<!--end::Page Scripts -->

<script type="text/javascript">
    $(document).ready(function () {
    })
</script>
</body>

<!-- end::Body -->
</html>
<?php /**PATH /var/www/resources/views/layouts/base.blade.php ENDPATH**/ ?>
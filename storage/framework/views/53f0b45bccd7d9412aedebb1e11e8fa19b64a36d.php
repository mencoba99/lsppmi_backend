<!DOCTYPE html>
<html lang="en">

<!-- begin::Head -->
<head>

    <!--begin::Base Path (base relative path for assets of this page) -->
    <base href="../">

    <!--end::Base Path -->
    <meta charset="utf-8" />
    <title>LSPPMI | <?php echo e(GeneralHelper::getPageTitle()); ?></title>
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
    <link href="<?php echo e(Storage::url('assets/backend/vendors/custom/fullcalendar/fullcalendar.bundle.css')); ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo e(Storage::url('assets/backend/vendors/custom/datatables/datatables.bundle.css')); ?>" rel="stylesheet" type="text/css" />


    <!--end::Page Vendors Styles -->

    <!--begin::Global Theme Styles(used by all pages) -->
    <link href="<?php echo e(asset('assets/vendors/global/vendors.bundle.css')); ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo e(Storage::url('assets/backend/css/demo7/style.bundle.css')); ?>" rel="stylesheet" type="text/css" />

    <!--end::Global Theme Styles -->
    <?php echo $__env->yieldPushContent('modal-style'); ?>

<!--begin::Layout Skins(used by all pages) -->
    <link href="<?php echo e(asset('assets/css/lsppmi-custom.css')); ?>" rel="stylesheet" type="text/css" />

    <!--end::Layout Skins -->
    <link rel="shortcut icon" href="<?php echo e(Storage::url('assets/backend/media/logos/favicon.ico')); ?>" />
</head>

<!-- end::Head -->


<div class="kt-grid kt-grid--hor kt-grid--root">
    <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--ver kt-page">
        <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-wrapper" id="kt_wrapper">

            <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor">

                <!-- begin:: Content -->
            <?php echo $__env->yieldContent('content', 'Default Content'); ?>

            <!-- end:: Content -->
            </div>
        </div>
    </div>
</div>



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


<script src="<?php echo e(asset('assets/vendors/global/vendors.bundle.js')); ?>" type="text/javascript"></script>
<script src="<?php echo e(Storage::url('assets/backend/js/scripts.bundle.js')); ?>" type="text/javascript"></script>

<!--end::Global Theme Bundle -->

<!--begin::Page Vendors(used by this page) -->
<script src="<?php echo e(Storage::url('vendors/custom/fullcalendar/fullcalendar.bundle.js')); ?>" type="text/javascript"></script>
<script src="//maps.google.com/maps/api/js?key=AIzaSyBTGnKT7dt597vo9QgeQ7BFhvSRP4eiMSM" type="text/javascript"></script>
<script src="<?php echo e(Storage::url('assets/backend/vendors/custom/gmaps/gmaps.js')); ?>" type="text/javascript"></script>

<!--end::Page Vendors -->

<!--begin::Page Scripts(used by this page) -->
<script src="<?php echo e(Storage::url('assets/backend/js/pages/dashboard.js')); ?>" type="text/javascript"></script>
<script src="<?php echo e(asset('assets/js/lsppmi-custom.js')); ?>" type="text/javascript"></script>

<?php echo $__env->yieldPushContent('modal-script'); ?>

<!--end::Page Scripts -->
</body>

<!-- end::Body -->
</html>
<?php /**PATH /var/www/resources/views/layouts/modal/base.blade.php ENDPATH**/ ?>
<!-- begin:: Aside -->
<button class="kt-aside-close " id="kt_aside_close_btn"><i class="la la-close"></i></button>
<div class="kt-aside  kt-aside--fixed  kt-grid__item kt-grid kt-grid--desktop kt-grid--hor-desktop" id="kt_aside">

<!-- begin:: Brand -->
    <div class="kt-aside__brand kt-grid__item " id="kt_aside_brand">
        <div class="kt-aside__brand-logo">
            <a href="{{ route('dashboard') }}">
                <img alt="Logo" src="{{ Storage::url('assets/backend/media/logos/logo-7.png') }}" />
            </a>
        </div>
    </div>
    <!-- end:: Brand -->
    <!-- begin:: Aside Menu -->
    <div class="kt-aside-menu-wrapper kt-grid__item kt-grid__item--fluid" id="kt_aside_menu_wrapper">
        <div id="kt_aside_menu" class="kt-aside-menu  kt-aside-menu--dropdown " data-ktmenu-vertical="1" data-ktmenu-dropdown="1" data-ktmenu-scroll="0">
        <ul class="kt-menu__nav ">
            <li class="kt-menu__item {{ ($currentRoute->action['as'] == 'dashboard') ? 'kt-menu__item--open kt-menu__item--here':'' }}">
                <a href="{{ route('dashboard') }}" class="kt-menu__link"><i class="kt-menu__link-icon flaticon2-protection"></i><span class="kt-menu__link-text">Dashboard</span><i class="kt-menu__ver-arrow la la-angle-right"></i></a>
            </li>
        </ul>
        </div>
    </div>
    <!-- end:: Aside Menu -->
</div>
<div class="kt-aside-menu-overlay"></div>
<!-- end:: Aside -->

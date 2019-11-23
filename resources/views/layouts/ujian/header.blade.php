<link href="https://ticmi.co.id/assets/psp/css/custom.css" rel="stylesheet">
<style>
a.plain{
    background-color: none;
}
</style>

    <!-- Header Begins -->
    <header id="header" class="default-header colored flat-menu">
    <div class="header-top">
            <div class="container">
                <nav>
                    <ul class="nav nav-pills nav-top">
                        <li class="phone">
                            <span><i class="fa fa-envelope"></i> <a href="mailto:info@ujianstandarprofesi.com?subject=Hello From Website">info@ujianstandarprofesi.com</a> </span>
                        </li>
                        <li class="phone">
                            <span><i class="fa fa-phone"></i>0800 100 9000 (Toll Free)</span>
                        </li>
                    </ul>
                </nav>
  
                <ul class="social-icons color">
                    <li class="facebook"><a href="# target="_blank" title="Facebook">Facebook</a></li>
                    <li class="twitter"><a href="#" target="_blank" title="Twitter">Twitter</a></li>
                    <li class="youtube"><a href="#" target="_blank" title="Youtube">Youtube</a></li>
                    <li class="instagram"><a href="#" target="_blank" title="Instagram">Instagram</a></li>
                </ul>
            </div>
        </div>
        <div class="container">
            <div class="logo header">
                <a href="{{ url('/') }}">
                    <img alt="PSP" width="100" height="73" data-sticky-width="90" data-sticky-height="66" data-sticky-padding="20" src="{{ url('assets/psp/images/default/psp-logo.png') }}">
                </a>
            </div>
            <button class="btn btn-responsive-nav btn-inverse" data-toggle="collapse" data-target=".nav-main-collapse"><i class="fa fa-bars"></i></button>
        </div>
        <div class="navbar-collapse nav-main-collapse collapse">
            <div class="container">
            <nav class="nav-main mega-menu">
                    <ul class="nav nav-pills nav-main" id="mainMenu">
                        <li class="dropdown  {{ empty($routename) || ($routename == 'home') ? 'active':'' }}">
                            <a class="disabled sticky-menu-active {{ empty($routename) || ($routename == 'home') ? 'active':'' }}" href="{{ url('/') }}" onclick="ga('send', 'event', 'Header Menu', 'home', '{{ url()->current() }}' );"> Home </a>
                        </li>
                        <li class="dropdown {{ ($routename == 'profil' || $routename == 'tujuan' || $routename == 'sejarah' || $routename == 'dasar-hukum' || $routename == 'pihak-ketiga' || $routename == 'penutup') ? 'active' : ''}}">
                            <a class="dropdown-toggle sticky-menu-active {{ ($routename == 'profil' || $routename == 'tujuan' || $routename == 'sejarah' || $routename == 'dasar-hukum' || $routename == 'pihak-ketiga' || $routename == 'penutup') ? 'active':'' }}" href="#">Tentang Kami<i class="fa fa-caret-down"></i></a>
                            <ul class="dropdown-menu">
                                <li><a href="{{ url('profil') }}" onclick="ga('send', 'event', 'Header Menu', 'profil', '{{ url()->current() }}' );">Profil</a></li>
                                <li><a href="{{ url('tujuan') }}" onclick="ga('send', 'event', 'Header Menu', 'tujuan', '{{ url()->current() }}' );">Tujuan</a></li>
                                <li><a href="{{ url('sejarah') }}" onclick="ga('send', 'event', 'Header Menu', 'sejarah', '{{ url()->current() }}' );">Sejarah </a></li>
                                <li><a href="{{ url('dasar-hukum') }}" onclick="ga('send', 'event', 'Header Menu', 'dasar-hukum', '{{ url()->current() }}' );">Dasar Hukum</a></li>
                                <li><a href="{{ url('pihak-ketiga') }}" onclick="ga('send', 'event', 'Header Menu', 'pihak-ketiga', '{{ url()->current() }}' );">Pihak Ketiga</a></li>
                                <li><a href="{{ url('penutup') }}" onclick="ga('send', 'event', 'Header Menu', 'penutup', '{{ url()->current() }}' );">Penutup</a></li>
                            </ul>
                        </li>
                        <li class="dropdown {{ ($routename == 'wppe' || $routename == 'wmi' || $routename == 'wpee') ? 'active':'' }}">
                            <a class="dropdown-toggle sticky-menu-active {{ ($routename == 'wppe' || $routename == 'wmi' || $routename == 'wpee') ? 'active':'' }}" href="#">Ujian Sertifikasi<i class="fa fa-caret-down"></i></a>
                            <ul class="dropdown-menu">
                                <li><a href="{{ url('wppe') }}" onclick="ga('send', 'event', 'Header Menu', 'wppe', '{{ url()->current() }}' );">WPPE (Wakil Perantara Pedagang Efek)</a></li>
                                <li><a href="{{ url('wmi') }}" onclick="ga('send', 'event', 'Header Menu', 'wmi', '{{ url()->current() }}' );">WMI (Wakil Manajer Investasi)</a></li>
                                <li><a href="{{ url('wpee') }}" onclick="ga('send', 'event', 'Header Menu', 'wpee', '{{ url()->current() }}' );">WPEE (Wakil Penjamin Emisi Efek)</a></li>
                            </ul>
                        </li>                        
                        <li class="dropdown {{ ($routename == 'hubungi-kami') ? 'active':'' }}">
                            <a href="{{ url('hubungi-kami') }}" class="disabled active sticky-menu-active" onclick="ga('send', 'event', 'Header Menu', 'hubungi-kami', '{{ url()->current() }}' )">Hubungi Kami</a>
                        </li>
                        @if(Auth::check())
                            <li class="dropdown ">
                                <a class="dropdown-toggle mobile-redirect" href="#">
                                    <i class="fa fa-user"></i>
                                    <i class="fa fa-angle-down"></i>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a href="{{ url('dashboard') }}" onclick="ga('send', 'event', 'Header Menu', 'dashboard', '{{ url()->current() }}' )">Dashboard</a></li>
                                    <li><a href="{{ url('profile') }}" onclick="ga('send', 'event', 'Header Menu', 'profile', '{{ url()->current() }}' )">Profile</a></li>
                                    <li><a href="{{ url('password') }}" onclick="ga('send', 'event', 'Header Menu', 'password', '{{ url()->current() }}' )">Ubah Password</a></li>
                                    <li><a href="{{ url('sertifikasi') }}" onclick="ga('send', 'event', 'Header Menu', 'sertifikasi', '{{ url()->current() }}' )">Sertifikasi</a></li>
                                    <li><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a> </li>
                                   
                                </ul>
                            </li>
                        @else
                           
                        @endif
                    </ul>
                </nav>
            </div>
        </div>
    </header><!-- Header Ends -->
@if(Auth::check())
    <div id="dashboard-banner" class="page-header typo-dark" style="background: url('https://ticmi.co.id/assets/images/banner/profile.jpg') top right no-repeat">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <!-- Page Header Wrapper -->
                    <div class="page-header-wrapper">
                        <!-- Title & Sub Title -->
                        <h3 class="title">Dashboard</h3>
                        <h4 class="sub-title">Hallo {{ Auth::user()->nama }}</h4>
                    </div><!-- Page Header Wrapper -->
                </div><!-- Coloumn -->
            </div><!-- Row -->
        </div><!-- Container -->
    </div>
@endif
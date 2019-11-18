<div class="page-sidebar-wrapper">
        <div class="page-sidebar the-sidebar navbar-collapse collapse">
            <ul class="page-sidebar-menu   " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">

                <li class="nav-item {{ Request::path() == 'dashboard' ? 'active open' : '' }}">
                    <a href="{{ URL::to('dashboard') }}" class="nav-link nav-toggle">
                        <i class="icon-home"></i>
                        <span class="title">Dashboard</span>
                        {{-- <span class="selected"></span> --}}
                    </a>
                </li>
                <li class="nav-item {{ Request::path() == 'profile' ? 'active open' : '' }}">
                    <a href="{{ URL::to('profile') }}" class="nav-link nav-toggle">
                        <i class="icon-user"></i>
                        <span class="title">Profile</span>
                    </a>
                </li>
                <li class="nav-item {{ Request::path() == 'password' ? 'active open' : '' }}">
                    <a href="{{ URL::to('password') }}" class="nav-link nav-toggle">
                        <i class="icon-key"></i>
                        <span class="title">Ubah Password</span>
                    </a>
                </li>
                <li class="nav-item sertifikasi {{ Request::path() == 'sertifikasi' ? 'active open' : '' }}">
                    <a href="{{ URL::to('sertifikasi') }}" class="nav-link nav-toggle">
                        <i class="icon-graduation"></i>
                        <span class="title">Sertifikasi</span>
                    </a>
                </li>  
                <li class="nav-item  ">
                 <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="icon-logout"></i>
                    <span class="title">Logout</span>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                        
                 </a>
                </li>          
            </ul>
        </div>
        <!-- END SIDEBAR -->
    </div>
    <!-- END SIDEBAR -->
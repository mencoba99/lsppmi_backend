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
                        @canany(['User', 'Role', 'Permission'])
                            <li class="kt-menu__item  kt-menu__item--submenu kt-menu__item--submenu-fullheight {{ in_array('pengaturan-aplikasi', $prefix) ? 'kt-menu__item--open kt-menu__item--here':'' }}" aria-haspopup="true" data-ktmenu-submenu-toggle="click" data-ktmenu-dropdown-toggle-class="kt-aside-menu-overlay--on"><a href="javascript:;" class="kt-menu__link kt-menu__toggle"><i class="kt-menu__link-icon flaticon2-settings"></i><span class="kt-menu__link-text">Pengaturan Aplikasi</span><i class="kt-menu__ver-arrow la la-angle-right"></i></a>
                                <div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
                                    <div class="kt-menu__wrapper">
                                        <ul class="kt-menu__subnav">
                                            <li class="kt-menu__item  kt-menu__item--parent kt-menu__item--submenu-fullheight" aria-haspopup="true"><span class="kt-menu__link"><span class="kt-menu__link-text">Pengaturan Aplikasi</span></span></li>
                                            <li class="kt-menu__item  kt-menu__item--submenu kt-menu__item--open {{ in_array('manajemen-user', $prefix) ? 'kt-menu__item--here':'' }}" aria-haspopup="true" data-ktmenu-submenu-toggle="click" data-ktmenu-submenu-mode="accordion"><a href="javascript:;" class="kt-menu__link kt-menu__toggle"><span class="kt-menu__link-text">Manajemen User</span><i class="kt-menu__ver-arrow la la-angle-right"></i></a>
                                                <div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
                                                    <ul class="kt-menu__subnav">
                                                        @can('User')
                                                            <li class="kt-menu__item {{ ($routeName == 'user.index') ? 'kt-menu__item--active':'' }}" aria-haspopup="true"><a href="{{ route('user.index') }}" class="kt-menu__link "><span class="kt-menu__link-text">User</span></a></li>
                                                        @endcan
                                                        @can('Role')
                                                            <li class="kt-menu__item {{ ($routeName == 'role.index') ? 'kt-menu__item--active':'' }}" aria-haspopup="true"><a href="{{ route('role.index') }}" class="kt-menu__link "><span class="kt-menu__link-text">Role</span></a></li>
                                                        @endcan
                                                        @can('Permission')
                                                            <li class="kt-menu__item {{ ($routeName == 'permission.index') ? 'kt-menu__item--active':'' }}" aria-haspopup="true"><a href="{{ route('permission.index') }}" class="kt-menu__link "><span class="kt-menu__link-text">Permission</span></a></li>
                                                        @endcan
                                                    </ul>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </li>
                        @endcanany
                        @canany(['Assessor','Tempat Uji Kompetensi (TUK)','Provinsi','Kota'])
                        <li class="kt-menu__item  kt-menu__item--submenu kt-menu__item--submenu-fullheight {{ in_array('data-master', $prefix) ? 'kt-menu__item--open kt-menu__item--here':'' }}" aria-haspopup="true" data-ktmenu-submenu-toggle="click" data-ktmenu-dropdown-toggle-class="kt-aside-menu-overlay--on"><a href="javascript:;" class="kt-menu__link kt-menu__toggle"><i class="kt-menu__link-icon la la-database"></i><span class="kt-menu__link-text">Data Master</span><i class="kt-menu__ver-arrow la la-angle-right"></i></a>
                            <div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
                                <div class="kt-menu__wrapper">
                                    <ul class="kt-menu__subnav">
                                        <li class="kt-menu__item  kt-menu__item--parent kt-menu__item--submenu-fullheight" aria-haspopup="true"><span class="kt-menu__link"><span class="kt-menu__link-text">Data Master</span></span></li>
                                        <li class="kt-menu__item  kt-menu__item--submenu kt-menu__item--open {{ in_array('manajemen-kelas', $prefix) ? 'kt-menu__item--here':'' }}" aria-haspopup="true" data-ktmenu-submenu-toggle="click" data-ktmenu-submenu-mode="accordion"><a href="javascript:;" class="kt-menu__link kt-menu__toggle"><span class="kt-menu__link-text">Manajemen Kelas</span><i class="kt-menu__ver-arrow la la-angle-right"></i></a>
                                            <div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
                                                <ul class="kt-menu__subnav">
                                                    @can('Assessor')
                                                        <li class="kt-menu__item {{ ($routeName == 'assessor.index') ? 'kt-menu__item--active':'' }}" aria-haspopup="true"><a href="{{ route('assessor.index') }}" class="kt-menu__link "><span class="kt-menu__link-text">Assessor</span></a></li>
                                                    @endcan
                                                    @can('Tempat Uji Kompetensi (TUK)')
                                                        <li class="kt-menu__item {{ ($routeName == 'tuk.index') ? 'kt-menu__item--active':'' }}" aria-haspopup="true"><a href="{{ route('tuk.index') }}" class="kt-menu__link "><span class="kt-menu__link-text">TUK</span></a></li>
                                                    @endcan
                                                    @can('Provinsi')
                                                        <li class="kt-menu__item {{ ($routeName == 'master.provinsi') ? 'kt-menu__item--active':'' }}" aria-haspopup="true"><a href="{{ route('master.provinsi') }}" class="kt-menu__link "><span class="kt-menu__link-text">Provinsi</span></a></li>
                                                    @endcan
                                                    @can('Kota')
                                                        <li class="kt-menu__item {{ ($routeName == 'master.kota') ? 'kt-menu__item--active':'' }}" aria-haspopup="true"><a href="{{ route('master.kota') }}" class="kt-menu__link "><span class="kt-menu__link-text">Kabupaten/Kota</span></a></li>
                                                    @endcan
                                                </ul>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </li>
                        @endcanany
                        <li class="kt-menu__item  kt-menu__item--submenu  kt-menu__item--submenu-fullheight" aria-haspopup="true" data-ktmenu-submenu-toggle="click" data-ktmenu-dropdown-toggle-class="kt-aside-menu-overlay--on"><a target="_blank" href="javascript:;" class="kt-menu__link kt-menu__toggle"><i class="kt-menu__link-icon flaticon2-analytics-2"></i><span class="kt-menu__link-text">Customers</span><i class="kt-menu__ver-arrow la la-angle-right"></i></a>
                            <div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
                                <div class="kt-menu__wrapper">
                                    <ul class="kt-menu__subnav">
                                        <li class="kt-menu__item  kt-menu__item--parent kt-menu__item--submenu-fullheight" aria-haspopup="true"><span class="kt-menu__link"><span class="kt-menu__link-text">Manajemen Assessmen</span></span></li>
                                        <li class="kt-menu__item  kt-menu__item--submenu kt-menu__item--open {{ in_array('cbt', $prefix) ? 'kt-menu__item--here':'' }}" aria-haspopup="true" data-ktmenu-submenu-toggle="click" data-ktmenu-submenu-mode="accordion"><a href="javascript:;" class="kt-menu__link kt-menu__toggle"><i class="kt-menu__link-icon flaticon-event-calendar-symbol"><span></span></i><span class="kt-menu__link-text">Manajemen Kelas</span><i class="kt-menu__ver-arrow la la-angle-right"></i></a>
                                            <div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
                                                <ul class="kt-menu__subnav">
                                                    <li class="kt-menu__item {{ ($routeName == 'ujian-komputer.kategori') ? 'kt-menu__item--active':'' }}" aria-haspopup="true"><a href="{{ route('ujian-komputer.kategori') }}" class="kt-menu__link "><span class="kt-menu__link-text">Jadwal Kelas</span></a></li>
                                                    <li class="kt-menu__item {{ ($routeName == 'ujian-komputer.program') ? 'kt-menu__item--active':'' }}" aria-haspopup="true"><a href="{{ route('ujian-komputer.program') }}" class="kt-menu__link "><span class="kt-menu__link-text">Program</span></a></li>
                                                    <li class="kt-menu__item {{ ($routeName == 'ujian-komputer.management') ? 'kt-menu__item--active':'' }}" aria-haspopup="true"><a href="{{ route('ujian-komputer.management') }}" class="kt-menu__link "><span class="kt-menu__link-text">Management</span></a></li>
                                                </ul>
                                            </div>
                                        </li>
                                        <li class="kt-menu__item  kt-menu__item--submenu kt-menu__item--open {{ in_array('cbt', $prefix) ? 'kt-menu__item--here':'' }}" aria-haspopup="true" data-ktmenu-submenu-toggle="click" data-ktmenu-submenu-mode="accordion"><a href="javascript:;" class="kt-menu__link kt-menu__toggle"><i class="kt-menu__link-icon flaticon-imac"><span></span></i><span class="kt-menu__link-text">Ujian Komputer</span><i class="kt-menu__ver-arrow la la-angle-right"></i></a>
                                            <div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
                                                <ul class="kt-menu__subnav">
                                                    <li class="kt-menu__item {{ ($routeName == 'ujian-komputer.kategori') ? 'kt-menu__item--active':'' }}" aria-haspopup="true"><a href="{{ route('ujian-komputer.kategori') }}" class="kt-menu__link "><span class="kt-menu__link-text">Kategori</span></a></li>
                                                    <li class="kt-menu__item {{ ($routeName == 'ujian-komputer.program') ? 'kt-menu__item--active':'' }}" aria-haspopup="true"><a href="{{ route('ujian-komputer.program') }}" class="kt-menu__link "><span class="kt-menu__link-text">Program</span></a></li>
                                                    <li class="kt-menu__item {{ ($routeName == 'ujian-komputer.management') ? 'kt-menu__item--active':'' }}" aria-haspopup="true"><a href="{{ route('ujian-komputer.management') }}" class="kt-menu__link "><span class="kt-menu__link-text">Management</span></a></li>

                                                </ul>
                                            </div>
                                        </li>
                                        <li class="kt-menu__item  kt-menu__item--submenu kt-menu__item--open {{ in_array('materi', $prefix) ? 'kt-menu__item--here':'' }}" aria-haspopup="true" data-ktmenu-submenu-toggle="click" data-ktmenu-submenu-mode="accordion"><a href="javascript:;" class="kt-menu__link kt-menu__toggle"><i class="kt-menu__link-icon flaticon-file-1"><span></span></i><span class="kt-menu__link-text">Materi</span><i class="kt-menu__ver-arrow la la-angle-right"></i></a>
                                            <div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
                                                <ul class="kt-menu__subnav">
                                                    <li class="kt-menu__item {{ ($routeName == 'materi.pembuatan-modul') ? 'kt-menu__item--active':'' }}" aria-haspopup="true"><a href="{{ route('materi.pembuatan-modul') }}" class="kt-menu__link "><span class="kt-menu__link-text">Pembuatan Modul</span></a></li>
                                                    <li class="kt-menu__item {{ ($routeName == 'materi.pembuatan-submodul') ? 'kt-menu__item--active':'' }}" aria-haspopup="true"><a href="{{ route('materi.pembuatan-submodul') }}" class="kt-menu__link "><span class="kt-menu__link-text">Pembuatan Submodul</span></a></li>
                                                    <li class="kt-menu__item {{ ($routeName == 'materi.jenis-soal') ? 'kt-menu__item--active':'' }}" aria-haspopup="true"><a href="{{ route('materi.jenis-soal') }}" class="kt-menu__link "><span class="kt-menu__link-text">Jenis Soal</span></a></li>
                                                    <li class="kt-menu__item {{ ($routeName == 'materi.pembuatan-soal') ? 'kt-menu__item--active':'' }}" aria-haspopup="true"><a href="{{ route('materi.pembuatan-soal') }}" class="kt-menu__link "><span class="kt-menu__link-text">Pembuatan Soal</span></a></li>
                                                </ul>
                                            </div>
                                        </li>

                                    </ul>
                                </div>
                            </div>
                        </li>
                        <li class="kt-menu__item">
                            <a href="{{ route('logout') }}" class="kt-menu__link"><i class="kt-menu__link-icon flaticon-logout"></i><span class="kt-menu__link-text">Logout</span><i class="kt-menu__ver-arrow la la-angle-right"></i></a>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- end:: Aside Menu -->

        </div>
        <div class="kt-aside-menu-overlay"></div>

        <!-- end:: Aside -->

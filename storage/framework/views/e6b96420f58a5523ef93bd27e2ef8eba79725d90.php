<!-- begin:: Aside -->
<button class="kt-aside-close " id="kt_aside_close_btn"><i class="la la-close"></i></button>
<div class="kt-aside  kt-aside--fixed  kt-grid__item kt-grid kt-grid--desktop kt-grid--hor-desktop" id="kt_aside">

<!-- begin:: Brand -->
    <div class="kt-aside__brand kt-grid__item " id="kt_aside_brand">
        <div class="kt-aside__brand-logo">
            <a href="<?php echo e(route('dashboard')); ?>">
                <img alt="Logo" src="<?php echo e(Storage::url('assets/backend/media/logos/logo-7.png')); ?>" />
            </a>
        </div>
    </div>
    <!-- end:: Brand -->
    <!-- begin:: Aside Menu -->
    <div class="kt-aside-menu-wrapper kt-grid__item kt-grid__item--fluid" id="kt_aside_menu_wrapper">
        <div id="kt_aside_menu" class="kt-aside-menu  kt-aside-menu--dropdown " data-ktmenu-vertical="1" data-ktmenu-dropdown="1" data-ktmenu-scroll="0">
        <ul class="kt-menu__nav ">
            <li class="kt-menu__item <?php echo e(($currentRoute->action['as'] == 'dashboard') ? 'kt-menu__item--open kt-menu__item--here':''); ?>">
                <a href="<?php echo e(route('dashboard')); ?>" class="kt-menu__link"><i class="kt-menu__link-icon flaticon2-protection"></i><span class="kt-menu__link-text">Dashboard</span><i class="kt-menu__ver-arrow la la-angle-right"></i></a>
            </li>
            <li class="kt-menu__item  kt-menu__item--submenu  kt-menu__item--submenu-fullheight" aria-haspopup="true" data-ktmenu-submenu-toggle="click" data-ktmenu-dropdown-toggle-class="kt-aside-menu-overlay--on"><a target="_blank" href="javascript:;" class="kt-menu__link kt-menu__toggle"><i class="kt-menu__link-icon flaticon2-user"></i><span class="kt-menu__link-text">Peserta</span><i class="kt-menu__ver-arrow la la-angle-right"></i></a>
                <div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
                    <div class="kt-menu__wrapper">
                        <ul class="kt-menu__subnav">
                            <li class="kt-menu__item  kt-menu__item--parent kt-menu__item--submenu-fullheight" aria-haspopup="true"><span class="kt-menu__link"><span class="kt-menu__link-text">Manajemen Peserta</span></span></li>
                            <li class="kt-menu__item  kt-menu__item--submenu kt-menu__item--open <?php echo e(in_array('cbt', $prefix) ? 'kt-menu__item--here':''); ?>" aria-haspopup="true" data-ktmenu-submenu-toggle="click" data-ktmenu-submenu-mode="accordion"><a href="javascript:;" class="kt-menu__link kt-menu__toggle"><i class="kt-menu__link-icon flaticon-event-calendar-symbol"><span></span></i><span class="kt-menu__link-text">Pendaftaran</span><i class="kt-menu__ver-arrow la la-angle-right"></i></a>
                                <div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
                                    <ul class="kt-menu__subnav">
                                        <li class="kt-menu__item <?php echo e(($routeName == 'ujian-komputer.kategori') ? 'kt-menu__item--active':''); ?>" aria-haspopup="true"><a href="<?php echo e(route('peserta.pendaftaran')); ?>" class="kt-menu__link "><span class="kt-menu__link-text">Peserta</span></a></li>
                                        <li class="kt-menu__item <?php echo e(($routeName == 'ujian-komputer.program') ? 'kt-menu__item--active':''); ?>" aria-haspopup="true"><a href="<?php echo e(route('peserta.pendaftaran.sertifikasi')); ?>" class="kt-menu__link "><span class="kt-menu__link-text">Sertifikasi</span></a></li>
                                        <li class="kt-menu__item <?php echo e(($routeName == 'ujian-komputer.management') ? 'kt-menu__item--active':''); ?>" aria-haspopup="true"><a href="<?php echo e(route('peserta.pendaftaran.sertifikasi.pembayaran')); ?>" class="kt-menu__link "><span class="kt-menu__link-text">Pembayaran</span></a></li>
                                    </ul>
                                </div>
                            </li>
                            <!-- <li class="kt-menu__item  kt-menu__item--submenu kt-menu__item--open <?php echo e(in_array('cbt', $prefix) ? 'kt-menu__item--here':''); ?>" aria-haspopup="true" data-ktmenu-submenu-toggle="click" data-ktmenu-submenu-mode="accordion"><a href="javascript:;" class="kt-menu__link kt-menu__toggle"><i class="kt-menu__link-icon flaticon-imac"><span></span></i><span class="kt-menu__link-text">Pembayaran</span><i class="kt-menu__ver-arrow la la-angle-right"></i></a>
                                <div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
                                    <ul class="kt-menu__subnav">
                                        <li class="kt-menu__item <?php echo e(($routeName == 'ujian-komputer.kategori') ? 'kt-menu__item--active':''); ?>" aria-haspopup="true"><a href="<?php echo e(route('ujian-komputer.kategori')); ?>" class="kt-menu__link "><span class="kt-menu__link-text">Kategori</span></a></li>
                                        <li class="kt-menu__item <?php echo e(($routeName == 'ujian-komputer.program') ? 'kt-menu__item--active':''); ?>" aria-haspopup="true"><a href="<?php echo e(route('ujian-komputer.program')); ?>" class="kt-menu__link "><span class="kt-menu__link-text">Program</span></a></li>
                                        <li class="kt-menu__item <?php echo e(($routeName == 'ujian-komputer.management') ? 'kt-menu__item--active':''); ?>" aria-haspopup="true"><a href="<?php echo e(route('ujian-komputer.management')); ?>" class="kt-menu__link "><span class="kt-menu__link-text">Management</span></a></li>
                                    </ul>
                                </div>
                            </li> -->
                        </ul>
                    </div>
                </div>
            </li>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['User', 'Role', 'Permission'])): ?>
            <li class="kt-menu__item  kt-menu__item--submenu kt-menu__item--submenu-fullheight <?php echo e(in_array('pengaturan-aplikasi', $prefix) ? 'kt-menu__item--open kt-menu__item--here':''); ?>" aria-haspopup="true" data-ktmenu-submenu-toggle="click" data-ktmenu-dropdown-toggle-class="kt-aside-menu-overlay--on"><a href="javascript:;" class="kt-menu__link kt-menu__toggle"><i class="kt-menu__link-icon flaticon2-settings"></i><span class="kt-menu__link-text">Pengaturan Aplikasi</span><i class="kt-menu__ver-arrow la la-angle-right"></i></a>
                <div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
                    <div class="kt-menu__wrapper">
                        <ul class="kt-menu__subnav">
                            <li class="kt-menu__item  kt-menu__item--parent kt-menu__item--submenu-fullheight" aria-haspopup="true"><span class="kt-menu__link"><span class="kt-menu__link-text">Pengaturan Aplikasi</span></span></li>
                            <li class="kt-menu__item  kt-menu__item--submenu kt-menu__item--open <?php echo e(in_array('manajemen-user', $prefix) ? 'kt-menu__item--here':''); ?>" aria-haspopup="true" data-ktmenu-submenu-toggle="click" data-ktmenu-submenu-mode="accordion"><a href="javascript:;" class="kt-menu__link kt-menu__toggle"><span class="kt-menu__link-text">Manajemen User</span><i class="kt-menu__ver-arrow la la-angle-right"></i></a>
                                <div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
                                    <ul class="kt-menu__subnav">
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('User')): ?>
                                        <li class="kt-menu__item <?php echo e(($routeName == 'user.index') ? 'kt-menu__item--active':''); ?>" aria-haspopup="true"><a href="<?php echo e(route('user.index')); ?>" class="kt-menu__link "><span class="kt-menu__link-text">User</span></a></li>
                                        <?php endif; ?>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Role')): ?>
                                        <li class="kt-menu__item <?php echo e(($routeName == 'role.index') ? 'kt-menu__item--active':''); ?>" aria-haspopup="true"><a href="<?php echo e(route('role.index')); ?>" class="kt-menu__link "><span class="kt-menu__link-text">Role</span></a></li>
                                        <?php endif; ?>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Permission')): ?>
                                        <li class="kt-menu__item <?php echo e(($routeName == 'permission.index') ? 'kt-menu__item--active':''); ?>" aria-haspopup="true"><a href="<?php echo e(route('permission.index')); ?>" class="kt-menu__link "><span class="kt-menu__link-text">Permission</span></a></li>
                                        <?php endif; ?>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </li>
            <?php endif; ?>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['Assessor','Tempat Uji Kompetensi (TUK)','Provinsi','Kota','Unit Kompetensi','Elemen Kompetensi','Kerangka Unjuk Kerja'])): ?>
            <li class="kt-menu__item  kt-menu__item--submenu kt-menu__item--submenu-fullheight <?php echo e(in_array('data-master', $prefix) ? 'kt-menu__item--open kt-menu__item--here':''); ?>" aria-haspopup="true" data-ktmenu-submenu-toggle="click" data-ktmenu-dropdown-toggle-class="kt-aside-menu-overlay--on"><a href="javascript:;" class="kt-menu__link kt-menu__toggle"><i class="kt-menu__link-icon la la-database"></i><span class="kt-menu__link-text">Data Master</span><i class="kt-menu__ver-arrow la la-angle-right"></i></a>
                <div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
                    <div class="kt-menu__wrapper">
                        <ul class="kt-menu__subnav">
                            <li class="kt-menu__item  kt-menu__item--parent kt-menu__item--submenu-fullheight" aria-haspopup="true"><span class="kt-menu__link"><span class="kt-menu__link-text">Data Master</span></span></li>
                            <li class="kt-menu__item  kt-menu__item--submenu kt-menu__item--open <?php echo e(in_array('manajemen-kelas', $prefix) ? 'kt-menu__item--here':''); ?>" aria-haspopup="true" data-ktmenu-submenu-toggle="click" data-ktmenu-submenu-mode="accordion"><a href="javascript:;" class="kt-menu__link kt-menu__toggle"><span class="kt-menu__link-text">Manajemen Kelas</span><i class="kt-menu__ver-arrow la la-angle-right"></i></a>
                                <div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
                                    <ul class="kt-menu__subnav">
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Assessor')): ?>
                                        <li class="kt-menu__item <?php echo e(($routeName == 'assessor.index') ? 'kt-menu__item--active':''); ?>" aria-haspopup="true"><a href="<?php echo e(route('assessor.index')); ?>" class="kt-menu__link "><span class="kt-menu__link-text">Assessor</span></a></li>
                                        <?php endif; ?>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Tempat Uji Kompetensi (TUK)')): ?>
                                        <li class="kt-menu__item <?php echo e(($routeName == 'tuk.index') ? 'kt-menu__item--active':''); ?>" aria-haspopup="true"><a href="<?php echo e(route('tuk.index')); ?>" class="kt-menu__link "><span class="kt-menu__link-text">TUK</span></a></li>
                                        <?php endif; ?>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Provinsi')): ?>
                                        <li class="kt-menu__item <?php echo e(($routeName == 'master.provinsi') ? 'kt-menu__item--active':''); ?>" aria-haspopup="true"><a href="<?php echo e(route('master.provinsi')); ?>" class="kt-menu__link "><span class="kt-menu__link-text">Provinsi</span></a></li>
                                        <?php endif; ?>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Kota')): ?>
                                        <li class="kt-menu__item <?php echo e(($routeName == 'master.kota') ? 'kt-menu__item--active':''); ?>" aria-haspopup="true"><a href="<?php echo e(route('master.kota')); ?>" class="kt-menu__link "><span class="kt-menu__link-text">Kabupaten/Kota</span></a></li>
                                        <?php endif; ?>
                                        <li class="kt-menu__item <?php echo e(($routeName == 'ujian-komputer.kategori') ? 'kt-menu__item--active':''); ?>" aria-haspopup="true"><a href="<?php echo e(route('ujian-komputer.kategori')); ?>" class="kt-menu__link "><span class="kt-menu__link-text">Kategori Program</span></a></li>
                                        <li class="kt-menu__item <?php echo e(($routeName == 'ujian-komputer.program') ? 'kt-menu__item--active':''); ?>" aria-haspopup="true"><a href="<?php echo e(route('ujian-komputer.program')); ?>" class="kt-menu__link "><span class="kt-menu__link-text">Program</span></a></li>
                                        <li class="kt-menu__item <?php echo e(($routeName == 'ujian-komputer.management') ? 'kt-menu__item--active':''); ?>" aria-haspopup="true"><a href="<?php echo e(route('ujian-komputer.management')); ?>" class="kt-menu__link "><span class="kt-menu__link-text">Management</span></a></li>
                                    </ul>
                                </div>
                            </li>
                            <li class="kt-menu__item  kt-menu__item--submenu kt-menu__item--open <?php echo e(in_array('master', $prefix) ? 'kt-menu__item--here':''); ?>" aria-haspopup="true" data-ktmenu-submenu-toggle="click" data-ktmenu-submenu-mode="accordion"><a href="javascript:;" class="kt-menu__link kt-menu__toggle"><i class="kt-menu__link-icon flaticon2-map"><span></span></i><span class="kt-menu__link-text">Daftar Pertanyaan</span><i class="kt-menu__ver-arrow la la-angle-right"></i></a>
                                <div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
                                    <ul class="kt-menu__subnav">
                                        <li class="kt-menu__item <?php echo e(($routeName == 'tertulis.index') ? 'kt-menu__item--active':''); ?>" aria-haspopup="true"><a href="<?php echo e(route('tertulis.index')); ?>" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Tertulis</span></a></li>
                                        <li class="kt-menu__item <?php echo e(($routeName == 'lisan.index') ? 'kt-menu__item--active':''); ?>" aria-haspopup="true"><a href="<?php echo e(route('lisan.index')); ?>" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Lisan</span></a></li>
                                       
                                       
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </li>
            <?php endif; ?>
            <li class="kt-menu__item  kt-menu__item--submenu  kt-menu__item--submenu-fullheight" aria-haspopup="true" data-ktmenu-submenu-toggle="click" data-ktmenu-dropdown-toggle-class="kt-aside-menu-overlay--on"><a target="_blank" href="javascript:;" class="kt-menu__link kt-menu__toggle"><i class="kt-menu__link-icon flaticon2-analytics-2"></i><span class="kt-menu__link-text">Customers</span><i class="kt-menu__ver-arrow la la-angle-right"></i></a>
                <div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
                    <div class="kt-menu__wrapper">
                        <ul class="kt-menu__subnav">
                            <li class="kt-menu__item  kt-menu__item--parent kt-menu__item--submenu-fullheight" aria-haspopup="true"><span class="kt-menu__link"><span class="kt-menu__link-text">Manajemen Assessmen</span></span></li>
                            <li class="kt-menu__item  kt-menu__item--submenu kt-menu__item--open <?php echo e(in_array('cbt', $prefix) ? 'kt-menu__item--here':''); ?>" aria-haspopup="true" data-ktmenu-submenu-toggle="click" data-ktmenu-submenu-mode="accordion"><a href="javascript:;" class="kt-menu__link kt-menu__toggle"><i class="kt-menu__link-icon flaticon-event-calendar-symbol"><span></span></i><span class="kt-menu__link-text">Manajemen Kelas</span><i class="kt-menu__ver-arrow la la-angle-right"></i></a>
                                <div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
                                    <ul class="kt-menu__subnav">
                                        <li class="kt-menu__item <?php echo e(($routeName == 'ujian-komputer.kategori') ? 'kt-menu__item--active':''); ?>" aria-haspopup="true"><a href="<?php echo e(route('ujian-komputer.kategori')); ?>" class="kt-menu__link "><span class="kt-menu__link-text">Kategori Program</span></a></li>
                                        <li class="kt-menu__item <?php echo e(($routeName == 'ujian-komputer.program') ? 'kt-menu__item--active':''); ?>" aria-haspopup="true"><a href="<?php echo e(route('ujian-komputer.program')); ?>" class="kt-menu__link "><span class="kt-menu__link-text">Program</span></a></li>
                                        <li class="kt-menu__item <?php echo e(($routeName == 'ujian-komputer.management') ? 'kt-menu__item--active':''); ?>" aria-haspopup="true"><a href="<?php echo e(route('ujian-komputer.management')); ?>" class="kt-menu__link "><span class="kt-menu__link-text">Management</span></a></li>
                                    </ul>
                                </div>
                            </li>
                            <li class="kt-menu__item  kt-menu__item--submenu kt-menu__item--open <?php echo e(in_array('cbt', $prefix) ? 'kt-menu__item--here':''); ?>" aria-haspopup="true" data-ktmenu-submenu-toggle="click" data-ktmenu-submenu-mode="accordion"><a href="javascript:;" class="kt-menu__link kt-menu__toggle"><i class="kt-menu__link-icon flaticon-imac"><span></span></i><span class="kt-menu__link-text">Ujian Komputer</span><i class="kt-menu__ver-arrow la la-angle-right"></i></a>
                                <div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
                                    <ul class="kt-menu__subnav">
                                        <li class="kt-menu__item <?php echo e(($routeName == 'ujian.jenis') ? 'kt-menu__item--active':''); ?>" aria-haspopup="true"><a href="<?php echo e(route('ujian.jenis')); ?>" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Jenis</span></a></li>
                                        <li class="kt-menu__item <?php echo e(($routeName == 'ujian.jadwal') ? 'kt-menu__item--active':''); ?>" aria-haspopup="true"><a href="<?php echo e(route('ujian.jadwal')); ?>" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Jadwal</span></a></li>
                                        <li class="kt-menu__item <?php echo e(($routeName == 'ujian.parameter') ? 'kt-menu__item--active':''); ?>" aria-haspopup="true"><a href="<?php echo e(route('ujian.parameter')); ?>" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Parameter</span></a></li>
                                        <li class="kt-menu__item <?php echo e(($routeName == 'ujian.aktivasi') ? 'kt-menu__item--active':''); ?>" aria-haspopup="true"><a href="<?php echo e(route('ujian.aktivasi')); ?>" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Aktivasi</span></a></li>

                                    </ul>
                                </div>
                            </li>
                            <li class="kt-menu__item  kt-menu__item--submenu kt-menu__item--open <?php echo e(in_array('materi', $prefix) ? 'kt-menu__item--here':''); ?>" aria-haspopup="true" data-ktmenu-submenu-toggle="click" data-ktmenu-submenu-mode="accordion"><a href="javascript:;" class="kt-menu__link kt-menu__toggle"><i class="kt-menu__link-icon flaticon-file-1"><span></span></i><span class="kt-menu__link-text">Materi</span><i class="kt-menu__ver-arrow la la-angle-right"></i></a>
                                <div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
                                    <ul class="kt-menu__subnav">
                                        <li class="kt-menu__item <?php echo e(($routeName == 'materi.pembuatan-modul') ? 'kt-menu__item--active':''); ?>" aria-haspopup="true"><a href="<?php echo e(route('materi.pembuatan-modul')); ?>" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Pembuatan Modul</span></a></li>
                                        <li class="kt-menu__item <?php echo e(($routeName == 'materi.pembuatan-submodul') ? 'kt-menu__item--active':''); ?>" aria-haspopup="true"><a href="<?php echo e(route('materi.pembuatan-submodul')); ?>" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Pembuatan Submodul</span></a></li>
                                        <li class="kt-menu__item <?php echo e(($routeName == 'materi.jenis-soal') ? 'kt-menu__item--active':''); ?>" aria-haspopup="true"><a href="<?php echo e(route('materi.jenis-soal')); ?>" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Jenis Soal</span></a></li>
                                        <li class="kt-menu__item <?php echo e(($routeName == 'materi.pembuatan-soal') ? 'kt-menu__item--active':''); ?>" aria-haspopup="true"><a href="<?php echo e(route('materi.pembuatan-soal')); ?>" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Pembuatan Soal</span></a></li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </li>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['Jadwal Kelas','Pengaturan Kompetensi'])): ?>
                <li class="kt-menu__item  kt-menu__item--submenu  kt-menu__item--submenu-fullheight <?php echo e(in_array('management-assesmen', $prefix) ? 'kt-menu__item--open kt-menu__item--here':''); ?>" aria-haspopup="true" data-ktmenu-submenu-toggle="click" data-ktmenu-dropdown-toggle-class="kt-aside-menu-overlay--on"><a target="_blank" href="javascript:;" class="kt-menu__link kt-menu__toggle"><i class="kt-menu__link-icon flaticon2-analytics-2"></i><span class="kt-menu__link-text">Customers</span><i class="kt-menu__ver-arrow la la-angle-right"></i></a>
                    <div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
                        <div class="kt-menu__wrapper">
                            <ul class="kt-menu__subnav">
                                <li class="kt-menu__item  kt-menu__item--parent kt-menu__item--submenu-fullheight" aria-haspopup="true"><span class="kt-menu__link"><span class="kt-menu__link-text">Manajemen Assessmen</span></span></li>
                                <li class="kt-menu__item  kt-menu__item--submenu <?php echo e(in_array('manajemen-kelas', $prefix) ? ' kt-menu__item--open kt-menu__item--here':''); ?>" aria-haspopup="true" data-ktmenu-submenu-toggle="click" data-ktmenu-submenu-mode="accordion"><a href="javascript:;" class="kt-menu__link kt-menu__toggle"><i class="kt-menu__link-icon flaticon-event-calendar-symbol"><span></span></i><span class="kt-menu__link-text">Manajemen Kelas</span><i class="kt-menu__ver-arrow la la-angle-right"></i></a>
                                    <div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
                                        <ul class="kt-menu__subnav">
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Jadwal Kelas')): ?>
                                                <li class="kt-menu__item <?php echo e(($routeName == 'jadwal-kelas.index') ? 'kt-menu__item--active':''); ?>" aria-haspopup="true"><a href="<?php echo e(route('jadwal-kelas.index')); ?>" class="kt-menu__link "><span class="kt-menu__link-text">Jadwal Kelas</span></a></li>
                                            <?php endif; ?>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Jadwal Kelas Approve')): ?>
                                                <li class="kt-menu__item <?php echo e(($routeName == 'jadwal-kelas.approve.index') ? 'kt-menu__item--active':''); ?>" aria-haspopup="true"><a href="<?php echo e(route('jadwal-kelas.approve.index')); ?>" class="kt-menu__link "><span class="kt-menu__link-text">Approve Jadwal Kelas</span></a></li>
                                            <?php endif; ?>
                                        </ul>
                                    </div>
                                </li>
                                <li class="kt-menu__item  kt-menu__item--submenu <?php echo e(in_array('manajemen-assessmen', $prefix) ? ' kt-menu__item--open kt-menu__item--here':''); ?>" aria-haspopup="true" data-ktmenu-submenu-toggle="click" data-ktmenu-submenu-mode="accordion"><a href="javascript:;" class="kt-menu__link kt-menu__toggle"><i class="kt-menu__link-icon flaticon-customer"><span></span></i><span class="kt-menu__link-text">Manajemen Assessmen</span><i class="kt-menu__ver-arrow la la-angle-right"></i></a>
                                    <div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
                                        <ul class="kt-menu__subnav">
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Pengaturan Kompetensi')): ?>
                                                <li class="kt-menu__item <?php echo e(($routeName == 'pengaturan-kompetensi.index') ? 'kt-menu__item--active':''); ?>" aria-haspopup="true"><a href="<?php echo e(route('pengaturan-kompetensi.index')); ?>" class="kt-menu__link "><span class="kt-menu__link-text">Pengaturan Kompetensi</span></a></li>
                                            <?php endif; ?>
                                        </ul>
                                    </div>
                                </li>
                                <li class="kt-menu__item  kt-menu__item--submenu <?php echo e(in_array('cbt', $prefix) ? ' kt-menu__item--open kt-menu__item--here':''); ?>" aria-haspopup="true" data-ktmenu-submenu-toggle="click" data-ktmenu-submenu-mode="accordion"><a href="javascript:;" class="kt-menu__link kt-menu__toggle"><i class="kt-menu__link-icon flaticon-imac"><span></span></i><span class="kt-menu__link-text">Ujian Komputer</span><i class="kt-menu__ver-arrow la la-angle-right"></i></a>
                                    <div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
                                        <ul class="kt-menu__subnav">
                                            <li class="kt-menu__item <?php echo e(($routeName == 'ujian-komputer.kategori') ? 'kt-menu__item--active':''); ?>" aria-haspopup="true"><a href="<?php echo e(route('ujian-komputer.kategori')); ?>" class="kt-menu__link "><span class="kt-menu__link-text">Kategori</span></a></li>
                                            <li class="kt-menu__item <?php echo e(($routeName == 'ujian-komputer.program') ? 'kt-menu__item--active':''); ?>" aria-haspopup="true"><a href="<?php echo e(route('ujian-komputer.program')); ?>" class="kt-menu__link "><span class="kt-menu__link-text">Program</span></a></li>
                                            <li class="kt-menu__item <?php echo e(($routeName == 'ujian-komputer.management') ? 'kt-menu__item--active':''); ?>" aria-haspopup="true"><a href="<?php echo e(route('ujian-komputer.management')); ?>" class="kt-menu__link "><span class="kt-menu__link-text">Management</span></a></li>

                                        </ul>
                                    </div>
                                </li>
                                <li class="kt-menu__item  kt-menu__item--submenu <?php echo e(in_array('materi', $prefix) ? 'kt-menu__item--open kt-menu__item--here':''); ?>" aria-haspopup="true" data-ktmenu-submenu-toggle="click" data-ktmenu-submenu-mode="accordion"><a href="javascript:;" class="kt-menu__link kt-menu__toggle"><i class="kt-menu__link-icon flaticon-file-1"><span></span></i><span class="kt-menu__link-text">Materi</span><i class="kt-menu__ver-arrow la la-angle-right"></i></a>
                                    <div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
                                        <ul class="kt-menu__subnav">
                                            <li class="kt-menu__item <?php echo e(($routeName == 'materi.pembuatan-modul') ? 'kt-menu__item--active':''); ?>" aria-haspopup="true"><a href="<?php echo e(route('materi.pembuatan-modul')); ?>" class="kt-menu__link "><span class="kt-menu__link-text">Pembuatan Modul</span></a></li>
                                            <li class="kt-menu__item <?php echo e(($routeName == 'materi.pembuatan-submodul') ? 'kt-menu__item--active':''); ?>" aria-haspopup="true"><a href="<?php echo e(route('materi.pembuatan-submodul')); ?>" class="kt-menu__link "><span class="kt-menu__link-text">Pembuatan Submodul</span></a></li>
                                            <li class="kt-menu__item <?php echo e(($routeName == 'materi.jenis-soal') ? 'kt-menu__item--active':''); ?>" aria-haspopup="true"><a href="<?php echo e(route('materi.jenis-soal')); ?>" class="kt-menu__link "><span class="kt-menu__link-text">Jenis Soal</span></a></li>
                                            <li class="kt-menu__item <?php echo e(($routeName == 'materi.pembuatan-soal') ? 'kt-menu__item--active':''); ?>" aria-haspopup="true"><a href="<?php echo e(route('materi.pembuatan-soal')); ?>" class="kt-menu__link "><span class="kt-menu__link-text">Pembuatan Soal</span></a></li>
                                        </ul>
                                    </div>
                                </li>

                            </ul>
                        </div>
                    </div>
                </li>
                <?php endif; ?>
                <li class="kt-menu__item">
                    <a href="<?php echo e(route('logout')); ?>" class="kt-menu__link"><i class="kt-menu__link-icon flaticon-logout"></i><span class="kt-menu__link-text">Logout</span><i class="kt-menu__ver-arrow la la-angle-right"></i></a>
                </li>
            </ul>
        </div>
    </div>
    <!-- end:: Aside Menu -->
</div>
<div class="kt-aside-menu-overlay"></div>
<!-- end:: Aside -->
<?php /**PATH /var/www/resources/views/layouts/sidemenu.blade.php ENDPATH**/ ?>
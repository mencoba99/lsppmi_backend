@extends('layouts.modal.base')
@section('content')
<!-- begin:: Content -->


<div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">
    <div class="kt-portlet kt-portlet--mobile">
        <div class="row">
            <div class="col-xl-4">
                <!--begin:: Widgets/Tasks -->
                <div class="kt-portlet kt-portlet--tabs kt-portlet--height-fluid">
                    <div class="kt-portlet__head">
                        <div class="kt-portlet__head-label">
                            <h3 class="kt-portlet__head-title">
                                    Modul Soal
                            </h3>
                        </div>

                    </div>
                    <div class="kt-portlet__body">
                        <div class="tab-content">
                            <div class="tab-pane active" id="kt_widget2_tab1_content">
                                <div class="kt-widget2">
                                    <div class="kt-widget2__item kt-widget2__item--brand">
                                        <div class="kt-widget2__info" style="padding: 1rem 0 0 2.2rem;">
                                            <span class="kt-widget2__title">
                                                {{ $soal->nama_modul ? $soal->nama_modul : ' - ' }}
                                            </span>
                                            <span class="kt-widget2__username">
                                                Modul
                                            </span>
                                        </div>
                                    </div>

                                    <div class="kt-widget2__item kt-widget2__item--danger">
                                            <div class="kt-widget2__info" style="padding: 1rem 0 0 2.2rem;">
                                                <span class="kt-widget2__title">
                                                        {{ $soal->nama_submodul ? $soal->nama_submodul : ' - ' }}
                                                </span>
                                                <span class="kt-widget2__username">
                                                   Sub Modul
                                                </span>
                                            </div>
                                    </div>

                                    <div class="kt-widget2__item kt-widget2__item--primary">
                                            <div class="kt-widget2__info" style="padding: 1rem 0 0 2.2rem;">
                                                <span class="kt-widget2__title">
                                                        {{ $soal->jenis }}
                                                </span>
                                                <span class="kt-widget2__username">
                                                    Jenis Soal
                                                </span>
                                            </div>
                                    </div>
                                    <div class="kt-widget2__item kt-widget2__item--success">
                                            <div class="kt-widget2__info" style="padding: 1rem 0 0 2.2rem;">
                                                <span class="kt-widget2__title">
                                                        {{ $soal->hit }}
                                                </span>
                                                <span class="kt-widget2__username">
                                                    Hit
                                                </span>
                                            </div>
                                    </div>
                                    <div class="kt-widget2__item kt-widget2__item--info">
                                            <div class="kt-widget2__info" style="padding: 1rem 0 0 2.2rem;">
                                                <span class="kt-widget2__title">
                                                        <span class='badge badge-success'>{{ $soal->parent == '0' ? 'Parent' : $soal->parent }}</span>
                                                </span>
                                                <span class="kt-widget2__username">
                                                        Parent
                                                </span>
                                            </div>
                                    </div>
                                    <div class="kt-widget2__item kt-widget2__item--primary">
                                            <div class="kt-widget2__info" style="padding: 1rem 0 0 2.2rem;">
                                                <span class="kt-widget2__title">
                                                        {{ $soal->nick }}
                                                </span>
                                                <span class="kt-widget2__username">
                                                    Nick
                                                </span>
                                            </div>
                                    </div>
                                    <div class="kt-widget2__item kt-widget2__item--warning">
                                            <div class="kt-widget2__info" style="padding: 1rem 0 0 2.2rem;">
                                                <span class="kt-widget2__title">
                                                        @if($soal->aktif == 0)
                                                                    @php($aktif = 'Tidak Aktif')
                                                                @elseif($soal->aktif == 1)
                                                                    @php($aktif = 'Aktif')
                                                                @endif
                                                        {{ $aktif }}
                                                </span>
                                                <span class="kt-widget2__username">
                                                    Status
                                                </span>
                                            </div>
                                    </div>
                                </div>
                            </div>

                            
                        </div>
                    </div>
                </div>
                <!--end:: Widgets/Tasks -->
            </div>

            <div class="col-xl-8">
                <!--begin:: Widgets/Support Tickets -->
                <div class="kt-portlet kt-portlet--height-fluid">
                    <div class="kt-portlet__head">
                        <div class="kt-portlet__head-label">
                            <h3 class="kt-portlet__head-title">
                                    Detail Soal
                            </h3>
                        </div>
                    </div>
                    <div class="kt-portlet__body">
                        <div class="kt-widget3">
                            <div class="kt-widget3__item">
                                <div class="kt-widget3__header">
                                    <div class="kt-widget3__user-img">
                                        <img class="kt-widget3__img"
                                            src="/metronic/themes/metronic/theme/default/demo7/dist/assets/media/users/user1.jpg"
                                            alt="">
                                    </div>
                                    <div class="kt-widget3__info">
                                        <a href="#" class="kt-widget3__username">
                                            Soal
                                        </a>
                                    </div>
                                    <span class="kt-widget3__status kt-font-info">
                                            <i class="kt-menu__link-icon flaticon-medal"><span></span></i>
                                    </span>
                                </div>
                                <div class="kt-widget3__body">
                                    <p class="kt-widget3__text" style="padding-left: 1rem;">
                                            {!! !empty($soal->soal) ? Crypt::decryptString($soal->soal) : ' - ' !!}
                                    </p>
                                </div>
                            </div>
                            <div class="kt-widget3__item">
                                <div class="kt-widget3__header">
                                    <div class="kt-widget3__user-img">
                                        <img class="kt-widget3__img"
                                            src="/metronic/themes/metronic/theme/default/demo7/dist/assets/media/users/user4.jpg"
                                            alt="">
                                    </div>
                                    <div class="kt-widget3__info">
                                        <a href="#" class="kt-widget3__username">
                                            Jawaban A
                                        </a>
                                    </div>
                                    <span class="kt-widget3__status kt-font-brand">
                                            <i class="kt-menu__link-icon flaticon-medal"><span></span></i>
                                    </span>
                                </div>
                                <div class="kt-widget3__body">
                                    <p class="kt-widget3__text" style="padding-left: 1rem;"> 
                                            {!! !empty($soal->a) ? Crypt::decryptString($soal->a) : ' - ' !!}
                                    </p>
                                </div>
                            </div>
                            <div class="kt-widget3__item">
                                <div class="kt-widget3__header">
                                    <div class="kt-widget3__user-img">
                                        <img class="kt-widget3__img"
                                            src="/metronic/themes/metronic/theme/default/demo7/dist/assets/media/users/user5.jpg"
                                            alt="">
                                    </div>
                                    <div class="kt-widget3__info">
                                        <a href="#" class="kt-widget3__username">
                                           Jawaban B
                                        </a>
                                    </div>
                                    <span class="kt-widget3__status kt-font-success">
                                            <i class="kt-menu__link-icon flaticon-medal"><span></span></i>
                                    </span>
                                </div>
                                <div class="kt-widget3__body">
                                    <p class="kt-widget3__text" style="padding-left: 1rem;">
                                            {!! !empty($soal->b) ? Crypt::decryptString($soal->b) : ' - ' !!}
                                    </p>
                                </div>
                            </div>
                            <div class="kt-widget3__item">
                                <div class="kt-widget3__header">
                                    <div class="kt-widget3__user-img">
                                        <img class="kt-widget3__img"
                                            src="/metronic/themes/metronic/theme/default/demo7/dist/assets/media/users/user5.jpg"
                                            alt="">
                                    </div>
                                    <div class="kt-widget3__info">
                                        <a href="#" class="kt-widget3__username">
                                           Jawaban C
                                        </a>
                                    </div>
                                    <span class="kt-widget3__status kt-font-warning">
                                            <i class="kt-menu__link-icon flaticon-medal"><span></span></i>
                                    </span>
                                </div>
                                <div class="kt-widget3__body">
                                    <p class="kt-widget3__text" style="padding-left: 1rem;">
                                            {!! !empty($soal->c) ? Crypt::decryptString($soal->c) : ' - ' !!}
                                    </p>
                                </div>
                            </div>
                            <div class="kt-widget3__item">
                                <div class="kt-widget3__header">
                                    <div class="kt-widget3__user-img">
                                        <img class="kt-widget3__img"
                                            src="/metronic/themes/metronic/theme/default/demo7/dist/assets/media/users/user5.jpg"
                                            alt="">
                                    </div>
                                    <div class="kt-widget3__info">
                                        <a href="#" class="kt-widget3__username">
                                           Jawaban D
                                        </a>
                                    </div>
                                    <span class="kt-widget3__status kt-font-danger">
                                            <i class="kt-menu__link-icon flaticon-medal"><span></span></i>
                                    </span>
                                </div>
                                <div class="kt-widget3__body">
                                    <p class="kt-widget3__text" style="padding-left: 1rem;">
                                            {!! !empty($soal->d) ? Crypt::decryptString($soal->d) : ' - ' !!}
                                    </p>
                                </div>
                            </div>
                            <div class="kt-widget3__item">
                                <div class="kt-widget3__header">
                                    <div class="kt-widget3__user-img">
                                        <img class="kt-widget3__img"
                                            src="/metronic/themes/metronic/theme/default/demo7/dist/assets/media/users/user5.jpg"
                                            alt="">
                                    </div>
                                    <div class="kt-widget3__info">
                                        <a href="#" class="kt-widget3__username">
                                           Jawaban E
                                        </a>
                                    </div>
                                    <span class="kt-widget3__status kt-font-primary">
                                            <i class="kt-menu__link-icon flaticon-medal"><span></span></i>
                                    </span>
                                </div>
                                <div class="kt-widget3__body">
                                    <p class="kt-widget3__text" style="padding-left: 1rem;">
                                            {!! !empty($soal->e) ? Crypt::decryptString($soal->e) : ' - ' !!}
                                    </p>
                                </div>
                            </div>
                            <div class="kt-widget3__item">
                                <div class="kt-widget3__header">
                                    <div class="kt-widget3__user-img">
                                        <img class="kt-widget3__img"
                                            src="/metronic/themes/metronic/theme/default/demo7/dist/assets/media/users/user5.jpg"
                                            alt="">
                                    </div>
                                    <div class="kt-widget3__info">
                                        <a href="#" class="kt-widget3__username">
                                           Jawaban Benar
                                        </a>
                                    </div>
                                    <span class="kt-widget3__status kt-font-success">
                                        <i class="kt-menu__link-icon flaticon-medal"><span></span></i>
                                    </span>
                                </div>
                                <div class="kt-widget3__body">
                                    <p class="kt-widget3__text" style="padding-left: 1rem;">
                                            <span class='badge badge-success'>{{ $soal->kunci }}</span>
                                    </p>
                                </div>
                            </div>
                            <div class="kt-widget3__item">
                                <div class="kt-widget3__header">
                                    <div class="kt-widget3__user-img">
                                        <img class="kt-widget3__img"
                                            src="/metronic/themes/metronic/theme/default/demo7/dist/assets/media/users/user5.jpg"
                                            alt="">
                                    </div>
                                    <div class="kt-widget3__info">
                                        <a href="#" class="kt-widget3__username">
                                           Penjelasan
                                        </a>
                                    </div>
                                    <span class="kt-widget3__status kt-font-info">
                                            <i class="kt-menu__link-icon flaticon-medal"><span></span></i>
                                    </span>
                                </div>
                                <div class="kt-widget3__body">
                                    <p class="kt-widget3__text" style="padding-left: 1rem;">
                                            {!! !empty($soal->penjelasan) ? Crypt::decryptString($soal->penjelasan) : ' - ' !!}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end:: Widgets/Support Tickets -->
            </div>
        </div>
        </form>
    </div>
</div>
</div>


<!-- end:: Content -->
@endsection

@push('modal-script')
<script>
    jQuery(document).ready(function () {
        $('#loader', parent.document).fadeOut();
    });

    

</script>

@endpush

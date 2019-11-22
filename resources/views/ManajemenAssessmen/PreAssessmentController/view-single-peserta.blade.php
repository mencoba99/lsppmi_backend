@extends('layouts.modal.base')
@section('content')

    <!-- begin:: Content -->
    <div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">

        <div class="kt-portlet kt-portlet--mobile">
            <div class="kt-portlet__head kt-portlet__head--lg">
                <div class="kt-portlet__head-label">
                    <span class="kt-portlet__head-icon">
                        <i class="kt-font-brand flaticon-presentation"></i>
                    </span>
                    <h3 class="kt-portlet__head-title">
                        Data Peserta : {{ $memberCertification->members->name }}
                    </h3>
                </div>
            </div>
            <div class="kt-portlet__body">
                @include('flash::message')

                <table class="table table-bordered table-hover table-checkable" id="">
                    <tbody>
                    <tr>
                        <td width='15%'>Nama</td>
                        <td width='10'>:</td>
                        <td width='35%'>{{ $memberCertification->members->name }}</td>
                        <td width='15%'>Program Sertifikasi</td>
                        <td width='10'>:</td>
                        <td width=''>{{ $memberCertification->schedules->program->name }}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="kt-portlet kt-portlet--tabs">
            <div class="kt-portlet__head">
                <div class="kt-portlet__head-toolbar">
                    <ul class="nav nav-tabs nav-tabs-line nav-tabs-line-success nav-tabs-line-2x" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#kt_portlet_base_demo_1_1_tab_content"
                               role="tab" aria-selected="true">
                                <i class="la la-check-circle"></i> APL-01
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#kt_portlet_base_demo_1_2_tab_content"
                               role="tab" aria-selected="false">
                                <i class="la la-briefcase"></i> APL-02
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#kt_portlet_base_demo_1_3_tab_content"
                               role="tab" aria-selected="false">
                                <i class="la la-bell-o"></i> PAAP
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="kt-portlet__body">
                <div class="tab-content">
                    <div class="tab-pane" id="kt_portlet_base_demo_1_1_tab_content" role="tabpanel">
                        <div class="kt-portlet kt-portlet--bordered">
                            <div class="kt-portlet__head">
                                <div class="kt-portlet__head-label">
                                    <h3 class="kt-portlet__head-title">
                                        FR-APL-01. FORMULIR PERMOHONAN SERTIFIKASI KOMPETENSI
                                    </h3>
                                </div>
                            </div>
                            <div class="kt-portlet__body">
                                <h6>Bagian 1: Rincian Data Pemohon Sertifikasi</h6>
                                <p>Pada bagian ini, cantumkan data pribadi, data pendidikan formal serta data pekerjaan
                                    anda pada saat ini.</p>

                                <table class="table">
                                    <tr>
                                        <th>a. Data Pribadi</th>
                                    </tr>
                                    <tr>
                                        <td width='15%'>Nama Lengkap</td>
                                        <td width='10'>:</td>
                                        <td>{{ $memberCertification->members->name }}</td>
                                    </tr>
                                    <tr>
                                        <td>No. KTP/NIK</td>
                                        <td>:</td>
                                        <td>{{ $memberCertification->members->identity_no }}</td>
                                    </tr>
                                    <tr>
                                        <td>Tempat/tgl. lahir</td>
                                        <td>:</td>
                                        <td>{{ $memberCertification->members->place_of }}</td>
                                    </tr>
                                    <tr>
                                        <td>Jenis Kelamin</td>
                                        <td>:</td>
                                        <td>
                                            @if ($memberCertification->members->gender == 1)
                                                Laki-laki
                                            @elseif($memberCertification->members->gender == 2)
                                                Wanita
                                            @else
                                                -
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Kebangsaan</td>
                                        <td>:</td>
                                        <td>{{ $memberCertification->members->nationality }}</td>
                                    </tr>
                                    <tr>
                                        <td>Alamat Rumah</td>
                                        <td>:</td>
                                        <td>{{ $memberCertification->members->address }}, Kodepos
                                            : {{ $memberCertification->members->postal_code }}</td>
                                    </tr>
                                    <tr>
                                        <td>No. Telepon/E-mail</td>
                                        <td>:</td>
                                        <td>
                                            <table class="table">
                                                <tr>
                                                    <td width='50%'>Rumah
                                                        : {{ $memberCertification->members->home_phone }}</td>
                                                    <td>Kantor :</td>
                                                </tr>
                                                <tr>
                                                    <td>HP : {{ $memberCertification->members->handphone }}</td>
                                                    <td>Email : {{ $memberCertification->members->email }}</td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Kualifikasi/Pendidikan</td>
                                        <td>:</td>
                                        <td>{{ $memberCertification->members->education }}</td>
                                    </tr>
                                    <tr>
                                        <th colspan="3">b. Data Pekerjaan Sekarang</th>
                                    </tr>
                                    <tr>
                                        <td>Perusahaan/Lembaga</td>
                                        <td>:</td>
                                        <td>{{ $memberCertification->members->company_name }}</td>
                                    </tr>
                                    <tr>
                                        <td>Jabatan</td>
                                        <td>:</td>
                                        <td>{{ $memberCertification->members->company_position }}</td>
                                    </tr>
                                    <tr>
                                        <td>Alamat</td>
                                        <td>:</td>
                                        <td>{{ $memberCertification->members->company_address }}, Kodepos
                                            : {{ $memberCertification->members->company_postal_code }}</td>
                                    </tr>
                                    <tr>
                                        <td>No. Telp/Fax/Email</td>
                                        <td>:</td>
                                        <td>
                                            <table class="table">
                                                <tr>
                                                    <td width='50%'>Telp
                                                        : {{ $memberCertification->members->company_phone }}</td>
                                                    <td>Fax : {{ $memberCertification->members->company_fax }}</td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2">Email
                                                        : {{ $memberCertification->members->company_email }}</td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                                <h6>Bagian 2: Data Sertifikasi</h6>
                                <p>Tuliskan Judul dan Nomor Skema Sertifikasi serta Daftar Unit Kompetensi sesuai
                                    kemasan pada skema sertifikasi yang anda ajukan untuk mendapatkan pengakuan sesuai
                                    dengan latar belakang pendidikan, pelatihan serta pengalaman kerja yang anda
                                    miliki.</p>
                                <table class="table">
                                    <tr>
                                        <td width="15%">Judul Skema</td>
                                        <td width="10">:</td>
                                        <td>{{ $memberCertification->schedules->program->name }}</td>
                                    </tr>
                                    <tr>
                                        <td>Nomor</td>
                                        <td>:</td>
                                        <td>{{ $memberCertification->schedules->program->code }}</td>
                                    </tr>
                                    <tr>
                                        <th colspan="3">Daftar Unit Kompetensi</th>
                                    </tr>
                                    <tr>
                                        <td colspan="3">
                                            <table class="table table-bordered">
                                                <thead>
                                                <tr>
                                                    <th width="20">No</th>
                                                    <th width="15%">Kode Unit</th>
                                                    <th width="65%">Judul Unit</th>
                                                    <th>Jenis Standar (SKKNI/ Standar Internasional/ Standar Khusus )
                                                    </th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @if ($memberCertification->apl01 && $memberCertification->apl01->count() > 0)
                                                    @php($no=1)
                                                    @foreach($memberCertification->apl01 as $item)
                                                        <tr>
                                                            <td>{{ $no }}</td>
                                                            <td>{{ $item->puk->uk->code }}</td>
                                                            <td>{{ $item->puk->uk->name }}</td>
                                                            <td>
                                                                @if ($item->puk->uk->type == 1)
                                                                    SKKNI
                                                                @elseif($item->puk->uk->type == 2)
                                                                    Standar International
                                                                @elseif($item->puk->uk->type == 3)
                                                                    Standar Khusus
                                                                @endif
                                                            </td>
                                                        </tr>
                                                        @php($no++)
                                                    @endforeach
                                                @endif
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                                <h6>Bagian 3: Bukti persyaratan dasar pemohon</h6>
                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th rowspan="2" width="10">No</th>
                                        <th rowspan="2" width="">Bukti Persyaratan</th>
                                        <th colspan="2">Ada</th>
                                        <th rowspan="2" width="14%">Tidak ada</th>
                                    </tr>
                                    <tr>
                                        <th width="14%">Memenuhi Syarat</th>
                                        <th width="14%">Tidak Memenuhi Syarat</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>KTP</td>
                                        @if ($memberCertification->members->ktp_file)
                                            @if ($memberCertification->apl01->status == 1)
                                                <td><i class="la la-check"></i></td>
                                                <td></td>
                                                <td></td>
                                            @else
                                                <td></td>
                                                <td><i class="la la-check"></i></td>
                                                <td></td>
                                            @endif
                                        @else
                                            <td></td>
                                            <td></td>
                                            <td><i class="la la-check"></i></td>
                                        @endif
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>Foto</td>
                                        @if ($memberCertification->members->foto_file)
                                            @if ($memberCertification->apl01->status == 1)
                                                <td><i class="la la-check"></i></td>
                                                <td></td>
                                                <td></td>
                                            @else
                                                <td></td>
                                                <td><i class="la la-check"></i></td>
                                                <td></td>
                                            @endif
                                        @else
                                            <td></td>
                                            <td></td>
                                            <td><i class="la la-check"></i></td>
                                        @endif
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>Ijazah</td>
                                        @if ($memberCertification->members->ijazah_file)
                                            @if ($memberCertification->apl01->status == 1)
                                                <td><i class="la la-check"></i></td>
                                                <td></td>
                                                <td></td>
                                            @else
                                                <td></td>
                                                <td><i class="la la-check"></i></td>
                                                <td></td>
                                            @endif
                                        @else
                                            <td></td>
                                            <td></td>
                                            <td><i class="la la-check"></i></td>
                                        @endif
                                    </tr>
                                    <tr>
                                        <td>4</td>
                                        <td>Surat Keterangan Kerja</td>
                                        @if ($memberCertification->members->skb_file)
                                            @if ($memberCertification->apl01->status == 1)
                                                <td><i class="la la-check"></i></td>
                                                <td></td>
                                                <td></td>
                                            @else
                                                <td></td>
                                                <td><i class="la la-check"></i></td>
                                                <td></td>
                                            @endif
                                        @else
                                            <td></td>
                                            <td></td>
                                            <td><i class="la la-check"></i></td>
                                        @endif
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane active" id="kt_portlet_base_demo_1_2_tab_content" role="tabpanel">
                        <div class="kt-portlet kt-portlet--bordered kt-portlet--responsive-mobile">
                            <div class="kt-portlet__head">
                                <div class="kt-portlet__head-label">
                                    <h3 class="kt-portlet__head-title">
                                        FR-APL-02. ASESMEN MANDIRI
                                    </h3>
                                </div>
                                <div class="kt-portlet__head-toolbar" style="align-items: center!important;">
                                    <div class="kt-portlet__head-actions">
                                        <a href="#" class="btn btn-outline-brand btn-bold btn-sm" data-toggle="modal" data-target="#kt_chat_modals">
                                            <i class="la la-wechat"></i> Kirim Pesan
                                        </a>
                                        {{ $memberCertification->apl02 }}
{{--                                        @if ($memberCertification->apl02->status == 0)--}}
{{--                                            <a href="{{ route('pre-assessment.approveapl02',['member_certification'=>$memberCertification,'status'=>'approve']) }}" class="btn btn-outline-success btn-sm btn-bold approveApl02">--}}
{{--                                                <i class="la la-check-circle"></i> Approve APL-02--}}
{{--                                            </a>--}}
{{--                                        @elseif($memberCertification->apl02->status == 1)--}}
{{--                                            <a href="{{ route('pre-assessment.approveapl02',['member_certification'=>$memberCertification,'status'=>'unapprove']) }}" class="btn btn-outline-danger btn-sm btn-bold approveApl02">--}}
{{--                                                <i class="la la-check-circle"></i> Unapprove APL-02--}}
{{--                                            </a>--}}
{{--                                        @endif--}}
                                    </div>
                                </div>
                            </div>
                            <div class="kt-portlet__body">
{{--                                <button type="button" class="btn btn-label-brand btn-lg btn-upper" data-toggle="modal" data-target="#kt_chat_modals"></button>--}}
{{--                                <br>--}}
                                <table class="table table-bordered">
                                    @if ($memberCertification->apl01 && $memberCertification->apl01->count() > 0)
                                        @php($noUk = 1)
                                        @foreach($memberCertification->apl01 as $item)
                                            <tr class="row-no-padding kt-margin-0">
                                                <td colspan="4" class="margin-none row-no-padding">
                                                    <table class="table no-gutters" style="margin-bottom: 0;">
                                                        <tr class="bg-light">
                                                            <td rowspan="2" width="20%"><strong>Kode & Judul Kompetensi {{ $noUk }}</strong></td>
                                                            <td colspan="3"><strong>{{ $item->puk->uk->code }}</strong> </td>
                                                        </tr>
                                                        <tr class="bg-light">
                                                            <td colspan="3"><strong>{{ $item->puk->uk->name }}</strong></td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                            @if ($item->puk->uk->elements && $item->puk->uk->elements->count() > 0)
                                                <tr>
                                                    <td width="50%">Dapatkah Saya?</td>
                                                    <td width="5%">K</td>
                                                    <td width="5%">BK</td>
                                                    <td>Bukti</td>
                                                </tr>
                                                @php($noElemen = 1)
                                                @foreach($item->puk->uk->elements as $element)
                                                    <tr>
                                                        <td>Elemen {{ $noElemen }} : {{ $element->name }} <br> KUK</td>
                                                        <td></td>
                                                        <td></td>
                                                        <td rowspan="{{ ($element->kuk->count() + 1) }}">
                                                            @if ($item->proof)
                                                                @php($arrProof=GeneralHelper::getAPL01File($item->proof))
                                                                @if ($arrProof)
                                                                    @foreach($arrProof as $proof)
                                                                        <a href="{{ Storage::url('apl/'.$memberCertification->members->id.'/'.$proof) }}"
                                                                           class="showDocument">{{ $proof }}</a>
                                                                    @endforeach
                                                                @endif
                                                            @endif
                                                        </td>
                                                    </tr>
                                                    @if ($element->kuk)
                                                        @php($nokuk=1)
                                                        @foreach($element->kuk as $kuk)
                                                            <tr>
                                                                <td style="padding-left: 30px;">{{ $noElemen }}
                                                                    .{{ $nokuk }} {{ $kuk->name }}</td>
                                                                @if (GeneralHelper::getCompetentStatusAPL02($memberCertification->id, $kuk->id))
                                                                    <td><i class="la la-check"></i></td>
                                                                    <td></td>
                                                                @else
                                                                    <td></td>
                                                                    <td><i class="la la-check"></i></td>
                                                                @endif
                                                            </tr>
                                                            @php($nokuk++)
                                                        @endforeach
                                                    @endif

                                                    @php($noElemen++)
                                                @endforeach
                                                <tr class="bg-info">
                                                    <td colspan="4" class="table-borderless warning"></td>
                                                </tr>
                                            @endif
                                            @php($noUk++)
                                        @endforeach
                                    @else
                                        <tr>
                                            <td>Belum ada data</td>
                                        </tr>
                                    @endif
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="kt_portlet_base_demo_1_3_tab_content" role="tabpanel">

                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- end:: Content -->
@endsection

@push('modal-script')

    <div class="modal fade rotate" id="myModal2">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Modal 2</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"
                            aria-label="Close"></button>
                </div>
                <div class="container"></div>
                <div class="modal-body">
                    <img src="" alt="" width="100%" height="100%">
                </div>
                <div class="modal-footer">
                    <a href="#" data-dismiss="modal" class="btn">Close</a>
                </div>
            </div>
        </div>
    </div>

    <!--Begin:: Chat-->
    <div class="modal fade- modal-sticky-bottom-right" id="kt_chat_modals" role="dialog" data-backdrop="false">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="kt-chat">
                    <div class="kt-portlet kt-portlet--last">
                        <div class="kt-portlet__head">
                            <div class="kt-chat__head ">
                                <div class="kt-chat__left">
                                    <div class="kt-chat__label">
                                        <a href="#" class="kt-chat__title">Jason Muller</a>
                                        <span class="kt-chat__status">
												<span class="kt-badge kt-badge--dot kt-badge--success"></span> Active
											</span>
                                    </div>
                                </div>
                                <div class="kt-chat__right">
                                    <button type="button" class="btn btn-clean btn-sm btn-icon" data-dismiss="modal">
                                        <i class="flaticon2-cross"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="kt-portlet__body">
                            <div class="kt-scroll kt-scroll--pull" data-height="410" data-mobile-height="300">
                                <div class="kt-chat__messages kt-chat__messages kt-chat__messages--modal">
                                    @if ($chatApl02 && $chatApl02->count() > 0)
                                        @foreach($chatApl02 as $chat)
                                            @if (!empty($chat->member_id) && empty($chat->user_id))
                                                {{-- Chat dari Peserta  --}}
                                                <div class="kt-chat__message kt-bg-light-primary" style="min-width: 55%;">
                                                    <div class="kt-chat__user">
                                                        <span class="kt-userpic kt-userpic--circle kt-userpic--sm">
                                                            <img src="{{ asset('assets/media/users/default.jpg') }}" alt="">
                                                        </span>
                                                        <a href="#" class="kt-chat__username">{{ $memberCertification->members->name }}</a>
                                                        <span class="kt-chat__datetime">{{ $chat->created_at->locale('id_ID')->diffForHumans() }}</span>
                                                    </div>
                                                    <div class="kt-chat__text">
                                                        {{ $chat->message }}
                                                    </div>
                                                </div>
                                            @elseif(empty($chat->member_id) && !empty($chat->user_id))
                                                {{-- Chat dari Asesor --}}
                                                <div class="kt-chat__message kt-chat__message--right kt-bg-light-success" style="min-width: 55%;">
                                                    <div class="kt-chat__user">
                                                        <span class="kt-chat__datetime">{{ $chat->created_at->locale('id_ID')->diffForHumans() }}</span>
                                                        <a href="#" class="kt-chat__username">Saya</a>
                                                        <span class="kt-userpic kt-userpic--circle kt-userpic--sm">
													<img src="{{ asset('assets/media/users/default.jpg') }}" alt="Asesor">
												</span>
                                                    </div>
                                                    <div class="kt-chat__text">
                                                        {{ $chat->message }}
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="kt-portlet__foot">
                            <div class="kt-chat__input">
                                <div class="kt-chat__editor">
                                    <textarea name="chat_message" placeholder="Tulis pesan disini..." style="height: 50px"></textarea>
                                </div>
                                <div class="kt-chat__toolbar">
                                    <div class="kt_chat__tools">
{{--                                        <a href="#"><i class="flaticon2-link"></i></a>--}}
{{--                                        <a href="#"><i class="flaticon2-photograph"></i></a>--}}
{{--                                        <a href="#"><i class="flaticon2-photo-camera"></i></a>--}}
                                    </div>
                                    <div class="kt_chat__actions">
{{--                                        <button type="button" class="btn btn-brand btn-md  btn-font-sm btn-upper btn-bold kt-chat__reply">reply</button>--}}
                                        <button type="button" class="btn btn-brand btn-md btn-font-sm btn-upper btn-bold reply_chat">
                                             Kirim pesan
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--ENd:: Chat-->

    <script type="text/javascript">

        var parentEl = KTUtil.getByID('kt_chat_modals');
        $(document).ready(function () {

            $('#openBtn').click(function () {
                $('#myModal').modal({
                    show: true
                })
            });

            $('.showDocument').on('click', function (event) {
                event.preventDefault();
                var url = $(this).attr("href");
                var title = $(this).data("original-title");
                title = (title === undefined) ? $(this).attr('title') : title;
                var fwidth = $(this).data("fwidth");
                var afterClose = $(this).data('after-close');

                $('#myModal2').on('show.bs.modal', function (e) {
                    var image = $(this).find('img');
                    $(this).find('img').attr('src', url);

                    var tinggi = $(window).height() - 220;
                    if (fwidth == "") {
                        fwidth = '80%';
                    }

                    $(this).attr('data-after-close', afterClose);

                    $(this).find('.modal-title').html(title);
                    image.height(tinggi);
                    $(this).find('.modal-dialog').width(fwidth);
                });
                $('#myModal2').modal({show: true});
            });

            $(document).on('show.bs.modal', '.modal', function (event) {
                var zIndex = 1040 + (10 * $('.modal:visible').length);
                $(this).css('z-index', zIndex);
                setTimeout(function () {
                    $('.modal-backdrop').not('.modal-stack').css('z-index', zIndex - 1).addClass('modal-stack');
                }, 0);

            });

            $(document).on('shown.bs.modal', '.modal', function (event) {
                var scrollEl = KTUtil.find(parentEl, '.kt-scroll');
                scrollEl.scrollTop = parseInt(KTUtil.css(scrollEl, 'height')) * 10;
            });

            /**
             * Event Approve APL02
             **/
            $(document).on('click','.approveApl02', function (e) {
                e.preventDefault();

                var link = $(this).attr('href');
                swal.fire({
                    title: 'Approve Form APL-02?',
                    text: 'Apakah Anda yakin untuk Approve Form APL-02 ini?',
                    type: 'warning',
                    allowOutsideClick: true,
                    showConfirmButton: true,
                    showCancelButton: true,
                    confirmButtonClass: 'btn-info',
                    cancelButtonClass: 'btn-danger',
                    // closeOnConfirm: true,
                    // closeOnCancel: true,
                    confirmButtonText: 'Ya',
                    cancelButtonText: 'Tidak',
                }).then(function(result){
                    if (result.value) {
                        window.location.href = link;
                    }
                });
            })
        });


        /**
         * Fungsi Chat
         **/

        var sendMessage = function (e) {
            var scrollEl = KTUtil.find(parentEl, '.kt-scroll');
            var messagesEl = KTUtil.find(parentEl, '.kt-chat__messages');
            var textarea = KTUtil.find(parentEl, '.kt-chat__input textarea');

            if (textarea.value.length === 0) {
                return;
            }


            /**
             * Save chat message to database
             */

            $.post("{{ route('pre-assessment.savechatapl02',['member_certification'=>$memberCertification]) }}",{message:textarea.value}, function (data) {
                if (data.status === true) {
                    var node = document.createElement("DIV");
                    KTUtil.addClass(node, 'kt-chat__message kt-chat__message--right');
                    var html =
                        '<div class="kt-chat__message kt-chat__message--right kt-bg-light-success">' +
                        '<div class="kt-chat__user">' +
                        '<span class="kt-chat__datetime">Just now</span>' +
                        '<a href="#" class="kt-chat__username">{{ auth()->user()->name }}</span></a>' +
                        '<span class="kt-userpic kt-userpic--circle kt-userpic--sm">' +
                        '<img src="{{ asset("assets/media/users/default.jpg") }}" alt="image">' +
                        '</span>' +
                        '</div>' +
                        '<div class="kt-chat__text">' +
                        textarea.value
                    '</div></div>';

                    KTUtil.setHTML(node, html);
                    messagesEl.appendChild(node);
                    // console.log(node);
                    textarea.value = '';
                    var ps;
                    if (ps = KTUtil.data(scrollEl).get('ps')) {
                        ps.update();
                    }

                    console.log(scrollEl);
                    scrollEl.scrollTop = parseInt(KTUtil.css(scrollEl, 'height')) * 10;
                } else {
                    alert('Pesan gagal dikirim');
                }

                $('.reply_chat').text('Kirim pesan').removeClass('kt-spinner kt-spinner--v2 kt-spinner--sm kt-spinner--light');
            },'json');

            // ps.update();
        };

        KTUtil.on(parentEl, '.kt-chat__input textarea', 'keydown', function(e) {
            if (e.keyCode == 13) {
                $('.reply_chat').text('Loading...').addClass('kt-spinner kt-spinner--v2 kt-spinner--sm kt-spinner--light');
                sendMessage();
                e.preventDefault();

                return false;
            }
        });

        KTUtil.on(parentEl, '.kt-chat__input .reply_chat', 'click', function(e) {
            $(this).text('Loading...').addClass('kt-spinner kt-spinner--v2 kt-spinner--sm kt-spinner--light');
            // console.log(KTUtil.data(scrollEl).get('ps'));
            sendMessage();
            e.preventDefault();

            return false;
        });
    </script>

    <script type="text/javascript">
        "use strict";

        // Class definition
        var KTChat = function () {
            var initChat = function (parentEl) {
                var messageListEl = KTUtil.find(parentEl, '.kt-scroll');

                if (!messageListEl) {
                    return;
                }

                // initialize perfect scrollbar(see:  https://github.com/utatti/perfect-scrollbar)
                KTUtil.scrollInit(messageListEl, {
                    windowScroll: false, // allow browser scroll when the scroll reaches the end of the side
                    mobileNativeScroll: true,  // enable native scroll for mobile
                    desktopNativeScroll: false, // disable native scroll and use custom scroll for desktop
                    resetHeightOnDestroy: true,  // reset css height on scroll feature destroyed
                    handleWindowResize: true, // recalculate hight on window resize
                    rememberPosition: true, // remember scroll position in cookie
                    height: function() {  // calculate height
                        var height;

                        // Mobile mode
                        if (KTUtil.isInResponsiveRange('tablet-and-mobile')) {
                            return KTUtil.hasAttr(messageListEl, 'data-mobile-height') ? parseInt(KTUtil.attr(messageListEl, 'data-mobile-height')) : 300;
                        }

                        // Desktop mode
                        if (KTUtil.isInResponsiveRange('desktop') && KTUtil.hasAttr(messageListEl, 'data-height')) {
                            return parseInt(KTUtil.attr(messageListEl, 'data-height'));
                        }

                        var chatEl = KTUtil.find(parentEl, '.kt-chat');
                        var portletHeadEl = KTUtil.find(parentEl, '.kt-portlet > .kt-portlet__head');
                        var portletBodyEl = KTUtil.find(parentEl, '.kt-portlet > .kt-portlet__body');
                        var portletFootEl = KTUtil.find(parentEl, '.kt-portlet > .kt-portlet__foot');

                        if (KTUtil.isInResponsiveRange('desktop')) {
                            height = KTLayout.getContentHeight();
                        } else {
                            height = KTUtil.getViewPort().height;
                        }

                        if (chatEl) {
                            height = height - parseInt(KTUtil.css(chatEl, 'margin-top')) - parseInt(KTUtil.css(chatEl, 'margin-bottom'));
                            height = height - parseInt(KTUtil.css(chatEl, 'padding-top')) - parseInt(KTUtil.css(chatEl, 'padding-bottom'));
                        }

                        if (portletHeadEl) {
                            height = height - parseInt(KTUtil.css(portletHeadEl, 'height'));
                            height = height - parseInt(KTUtil.css(portletHeadEl, 'margin-top')) - parseInt(KTUtil.css(portletHeadEl, 'margin-bottom'));
                        }

                        if (portletBodyEl) {
                            height = height - parseInt(KTUtil.css(portletBodyEl, 'margin-top')) - parseInt(KTUtil.css(portletBodyEl, 'margin-bottom'));
                            height = height - parseInt(KTUtil.css(portletBodyEl, 'padding-top')) - parseInt(KTUtil.css(portletBodyEl, 'padding-bottom'));
                        }

                        if (portletFootEl) {
                            height = height - parseInt(KTUtil.css(portletFootEl, 'height'));
                            height = height - parseInt(KTUtil.css(portletFootEl, 'margin-top')) - parseInt(KTUtil.css(portletFootEl, 'margin-bottom'));
                        }

                        // remove additional space
                        height = height - 5;

                        return height;
                    }
                });

            }

            return {
                // public functions
                init: function() {
                    // init modal chat example
                    initChat( KTUtil.getByID('kt_chat_modals'));

                    // trigger click to show popup modal chat on page load
                    setTimeout(function() {
                        //KTUtil.getByID('kt_app_chat_launch_btn').click();
                    }, 1000);
                },

                setup: function(element) {
                    initChat(element);
                }
            };
        }();

        KTUtil.ready(function() {
            KTChat.init();
        });
    </script>
@endpush

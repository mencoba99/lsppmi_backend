@extends('layouts.base')
@section('content')

<!-- begin:: Content -->
<div class="kt-content kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">

    @include('flash::message')
    <div class="kt-portlet kt-portlet--mobile">

        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                <span class="kt-portlet__head-icon">
                    <i class="kt-font-brand flaticon2-line-chart"></i>
                </span>
                <h3 class="kt-portlet__head-title">
                    {{ $c->schedules->programs->name }} <small>APL01</small>
                </h3>
            </div>
            <div class="kt-portlet__head-toolbar">
                <div class="kt-portlet__head-wrapper">
                    <a href="{{ route('peserta.pendaftaran.sertifikasi') }}" class="btn btn-clean btn-icon-sm">
                        <i class="la la-long-arrow-left"></i>
                        Back
                    </a>
                </div>
            </div>
        </div>

        <div class="kt-portlet__body">
            {!! Form::open(['url'=>'','id'=>'form-apl01','method'=> 'PUT']) !!}
            <div class="row">
                <div class="col-sm-6">

                    {!! Form::hidden('token', $c->token) !!}
                        <div class="row">
                            <div class="col-xl-2"></div>
                            <div class="col-xl-8">
                                <div class="kt-section kt-section--first">
                                    <h5>Informasi Akun</h5>
                                    <div class="kt-section__body">
                                        <div class="form-group row">
                                            <div class="col-6">
                                                <label>Nama</label>
                                                {!! Form::text('name',(!empty($c) ? $c->members->name:null),['class'=>'form-control','placeholder'=>'Nama', 'disabled' => 'disabled']) !!}
                                            </div>
                                            <div class="col-6">
                                                <label>Email</label>
                                                {!! Form::text('email',(!empty($c) ? $c->members->email:null),['class'=>'form-control','placeholder'=>'Email', 'disabled' => 'disabled']) !!}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-6">
                                                <label>NIK</label>
                                                {!! Form::text('name',(!empty($c) ? $c->members->identity_no:null),['class'=>'form-control','placeholder'=>'NIK', 'disabled' => 'disabled']) !!}
                                            </div>
                                            <div class="col-6">
                                                <label>Kewarganegaraan</label>
                                                {!! Form::text('email',(!empty($c) ? $c->members->nationality:null),['class'=>'form-control','placeholder'=>'Kewarganegaraan', 'disabled' => 'disabled']) !!}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-6">
                                                <label>Tempat Lahir</label>
                                                {!! Form::text('name',(!empty($c) ? $c->members->place_of_birth:null),['class'=>'form-control','placeholder'=>'Tempat Lahir', 'disabled' => 'disabled']) !!}
                                            </div>
                                            <div class="col-6">
                                                <label>Tanggal Lahir</label>
                                                {!! Form::text('email',(!empty($c) ? $c->members->date_of_birth:null),['class'=>'form-control','placeholder'=>'Tanggal Lahir', 'disabled' => 'disabled']) !!}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-6">
                                                <label>Jenis Kelamin</label>
                                                {!! Form::text('name',(!empty($c) ? $c->members->gender:null),['class'=>'form-control','placeholder'=>'Jenis Kelamin', 'disabled' => 'disabled']) !!}
                                            </div>
                                            <div class="col-6">
                                                <label>Pendidikan</label>
                                                {!! Form::text('email',(!empty($c) ? $c->members->education:null),['class'=>'form-control','placeholder'=>'Email', 'disabled' => 'disabled']) !!}
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Alamat Rumah</label>
                                            {!! Form::textarea('address', @$c->members->address, ['class' => 'form-control', 'rows' => 3, 'disabled' => 'disabled']) !!}
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-6">
                                                <label>Kode Pos</label>
                                                {!! Form::text('name',(!empty($c) ? $c->members->postal_code:null),['class'=>'form-control','placeholder'=>'Kode Pos', 'disabled' => 'disabled']) !!}
                                            </div>
                                            <div class="col-6">
                                                <label>Telepon Rumah</label>
                                                {!! Form::text('email',(!empty($c) ? $c->members->home_phone:null),['class'=>'form-control','placeholder'=>'Telepon Rumah', 'disabled' => 'disabled']) !!}
                                            </div>
                                        </div>
                                    </div>
                                    <h3 class="kt-section__title">Informasi Pekerjaan</h3>
                                    <div class="kt-section__body">
                                        <div class="form-group row">
                                            <div class="col-6">
                                                <label>Perusahaan/Lembaga</label>
                                                {!! Form::text('name',(!empty($c) ? $c->members->company_name:null),['class'=>'form-control','placeholder'=>'Perusahaan/Lembaga', 'disabled' => 'disabled']) !!}
                                            </div>
                                            <div class="col-6">
                                                <label>Jabatan</label>
                                                {!! Form::text('email',(!empty($c) ? $c->members->company_position:null),['class'=>'form-control','placeholder'=>'Jabatan', 'disabled' => 'disabled']) !!}
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Alamat</label>
                                            {!! Form::textarea('address', @$c->members->company_address, ['class' => 'form-control', 'rows' => 3, 'disabled' => 'disabled']) !!}
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-6">
                                                <label>Kode Pos</label>
                                                {!! Form::text('name',(!empty($c) ? $c->members->company_postal_code:null),['class'=>'form-control','placeholder'=>'Kode Pos', 'disabled' => 'disabled']) !!}
                                            </div>
                                            <div class="col-6">
                                                <label>Email Kantor</label>
                                                {!! Form::text('email',(!empty($c) ? $c->members->company_email:null),['class'=>'form-control','placeholder'=>'Email Kantor', 'disabled' => 'disabled']) !!}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-6">
                                                <label>Telepon Kantor</label>
                                                {!! Form::text('name',(!empty($c) ? $c->members->company_phone:null),['class'=>'form-control','placeholder'=>'Telepon Kantor', 'disabled' => 'disabled']) !!}
                                            </div>
                                            <div class="col-6">
                                                <label>Fax</label>
                                                {!! Form::text('email',(!empty($c) ? $c->members->company_fax:null),['class'=>'form-control','placeholder'=>'Fax', 'disabled' => 'disabled']) !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="kt-portlet__foot">
                            @if ($c->status == 0)
                            <button type="submit" class="btn btn-success btn-loading" id="approveAPL01">Verifikasi</button>
                            <a href="{{ route('peserta.pendaftaran.sertifikasi') }}" id="rejectAPL01" class="btn btn-secondary">Tolak</a>
                            @elseif ($c->status == 1)
                            <button type="submit" class="btn btn-success btn-loading" id="sendAPL01Payment">Kirim Tagihan Pembayaran</button>
                            <!-- <a href="{{ route('peserta.pendaftaran.sertifikasi') }}" id="rejectAPL01" class="btn btn-secondary">Tolak</a> -->
                            @else
{{--                            <button type="submit" class="btn btn-success btn-loading" id="approveAPL01">Verifikasi</button>--}}
{{--                            <a href="{{ route('peserta.pendaftaran.sertifikasi') }}" class="btn btn-secondary">Tolak</a>--}}
                            @endif

                        </div>

                </div>
                <div class="col-sm-6">
                    <h5 class="black">Unit Kompetensi Dipilih</h5>
                    <ol>
                    @foreach($c->apl01 as $key => $val)
                        <li>{{ $val->puk->uk->name }}</li>
                    @endforeach
                    </ol>

                    <h5>Bukti Persyaratan</h5>
                    <table class="table table-striped table-bordered table-md">
                        <thead class="thead-light">
                            <tr>
                                <th scope="row" rowspan="2" class="center">No</th>
                                <th rowspan="2" class="text-center">Bukti Persyaratan</th>
                                <th colspan="2" class="text-center">Ada</th>
                                <th rowspan="2" class="text-center">Tidak Ada</th>
                            </tr>
                            <tr>
                                <th class="text-center">Memenuhi</th>
                                <th class="text-center">Tidak Memenuhi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>
                                    @if ($c->members->ktp_file && Storage::exists($c->members->ktp_file))
                                        <a href="{{ Storage::url($c->members->ktp_file) }}" class="showImageModal" title="KTP {{ $c->members->name }}">KTP</a>
                                    @else
                                    KTP
                                    @endif
                                </td>
                                <td class="text-center"><input type="radio" name="ktp_verified" value="1" @if($c->members->ktp_verified == 1) {{ 'checked' }} @endif></td>
                                <td class="text-center"><input type="radio" name="ktp_verified" value="2" @if($c->members->ktp_verified == 2) {{ 'checked' }} @endif></td>
                                <td class="text-center"><input type="radio" name="ktp_verified" value="0" @if($c->members->ktp_verified == 0) {{ 'checked' }} @endif></td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>
                                    @if ($c->members->foto_file && Storage::exists($c->members->foto_file))
                                        <a href="{{ Storage::url($c->members->foto_file) }}" class="showImageModal" title="Foto {{ $c->members->name }}">Foto</a>
                                    @else
                                        Foto
                                    @endif
                                </td>
                                <td class="text-center"><input type="radio" name="foto_verified" value="1" @if($c->members->foto_verified == 1) {{ 'checked' }} @endif></td>
                                <td class="text-center"><input type="radio" name="foto_verified" value="2" @if($c->members->foto_verified == 2) {{ 'checked' }} @endif></td>
                                <td class="text-center"><input type="radio" name="foto_verified" value="0" @if($c->members->foto_verified == 0) {{ 'checked' }} @endif></td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>
                                    @if ($c->members->ijazah_file && Storage::exists($c->members->ijazah_file))
                                    <a href="{{ $c->members->ijazah_file }}" class="showImageModal" title="Ijazah {{ $c->members->name }}">Ijazah</a>
                                    @else
                                    Ijazah
                                    @endif
                                </td>
                                <td class="text-center"><input type="radio" name="ijazah_verified" value="1" @if($c->members->ijazah_verified == 1) {{ 'checked' }} @endif></td>
                                <td class="text-center"><input type="radio" name="ijazah_verified" value="2" @if($c->members->ijazah_verified == 2) {{ 'checked' }} @endif></td>
                                <td class="text-center"><input type="radio" name="ijazah_verified" value="0" @if($c->members->ijazah_verified == 0) {{ 'checked' }} @endif></td>
                            </tr>
                            <tr>
                                <td>4</td>
                                <td>
                                    @if ($c->members->skb_file && Storage::exists($c->members->skb_file))
                                    <a href="{{ $c->members->skb_file }}" class="showImageModal" title="Surat Keterangan Bekerja {{ $c->members->name }}">Surat Keterangan Bekerja</a>
                                    @else
                                    SKB
                                    @endif
                                </td>
                                <td class="text-center"><input type="radio" name="skb_verified" value="1" @if($c->members->skb_verified == 1) {{ 'checked' }} @endif></td>
                                <td class="text-center"><input type="radio" name="skb_verified" value="2" @if($c->members->skb_verified == 2) {{ 'checked' }} @endif></td>
                                <td class="text-center"><input type="radio" name="skb_verified" value="0" @if($c->members->skb_verified == 0) {{ 'checked' }} @endif></td>
                            </tr>
                        </tbody>
                    </table>

                    <hr>


                    <!--Begin:: App Content-->
                    <div class="kt-grid__item kt-grid__item--fluid kt-app__content" id="kt_chat_content">
                        <div class="kt-chat">
                            <div class="kt-portlet kt-portlet--head-lg kt-portlet--last">
                                <div class="kt-portlet__head">
                                    <div class="kt-chat__head ">
                                        <div class="kt-chat__left">

                                            <!--end:: Aside Mobile Toggle-->
                                            {{--                                            <div class="dropdown dropdown-inline">--}}
                                            {{--                                                <button type="button" class="btn btn-clean btn-sm btn-icon btn-icon-md" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">--}}
                                            {{--                                                    <i class="flaticon-more-1"></i>--}}
                                            {{--                                                </button>--}}
                                            {{--                                                <div class="dropdown-menu dropdown-menu-fit dropdown-menu-left dropdown-menu-md">--}}

                                            {{--                                                    <!--begin::Nav-->--}}
                                            {{--                                                    <ul class="kt-nav">--}}
                                            {{--                                                        <li class="kt-nav__item">--}}
                                            {{--                                                            <a href="#" class="kt-nav__link">--}}
                                            {{--                                                                <i class="kt-nav__link-icon flaticon2-group"></i>--}}
                                            {{--                                                                <span class="kt-nav__link-text">New Group</span>--}}
                                            {{--                                                            </a>--}}
                                            {{--                                                        </li>--}}
                                            {{--                                                        <li class="kt-nav__item">--}}
                                            {{--                                                            <a href="#" class="kt-nav__link">--}}
                                            {{--                                                                <i class="kt-nav__link-icon flaticon2-open-text-book"></i>--}}
                                            {{--                                                                <span class="kt-nav__link-text">Contacts</span>--}}
                                            {{--                                                            </a>--}}
                                            {{--                                                        </li>--}}
                                            {{--                                                        <li class="kt-nav__item">--}}
                                            {{--                                                            <a href="#" class="kt-nav__link">--}}
                                            {{--                                                                <i class="kt-nav__link-icon flaticon2-rocket-1"></i>--}}
                                            {{--                                                                <span class="kt-nav__link-text">Groups</span>--}}
                                            {{--                                                                <span class="kt-nav__link-badge">--}}
                                            {{--																				<span class="kt-badge kt-badge--brand kt-badge--inline">new</span>--}}
                                            {{--																			</span>--}}
                                            {{--                                                            </a>--}}
                                            {{--                                                        </li>--}}
                                            {{--                                                        <li class="kt-nav__item">--}}
                                            {{--                                                            <a href="#" class="kt-nav__link">--}}
                                            {{--                                                                <i class="kt-nav__link-icon flaticon2-bell-2"></i>--}}
                                            {{--                                                                <span class="kt-nav__link-text">Calls</span>--}}
                                            {{--                                                            </a>--}}
                                            {{--                                                        </li>--}}
                                            {{--                                                        <li class="kt-nav__item">--}}
                                            {{--                                                            <a href="#" class="kt-nav__link">--}}
                                            {{--                                                                <i class="kt-nav__link-icon flaticon2-dashboard"></i>--}}
                                            {{--                                                                <span class="kt-nav__link-text">Settings</span>--}}
                                            {{--                                                            </a>--}}
                                            {{--                                                        </li>--}}
                                            {{--                                                        <li class="kt-nav__separator"></li>--}}
                                            {{--                                                        <li class="kt-nav__item">--}}
                                            {{--                                                            <a href="#" class="kt-nav__link">--}}
                                            {{--                                                                <i class="kt-nav__link-icon flaticon2-protected"></i>--}}
                                            {{--                                                                <span class="kt-nav__link-text">Help</span>--}}
                                            {{--                                                            </a>--}}
                                            {{--                                                        </li>--}}
                                            {{--                                                        <li class="kt-nav__item">--}}
                                            {{--                                                            <a href="#" class="kt-nav__link">--}}
                                            {{--                                                                <i class="kt-nav__link-icon flaticon2-bell-2"></i>--}}
                                            {{--                                                                <span class="kt-nav__link-text">Privacy</span>--}}
                                            {{--                                                            </a>--}}
                                            {{--                                                        </li>--}}
                                            {{--                                                    </ul>--}}

                                            {{--                                                    <!--end::Nav-->--}}
                                            {{--                                                </div>--}}
                                            {{--                                            </div>--}}

                                        </div>
                                        <div class="kt-chat__center">
                                            <div class="kt-chat__label">
                                                <a href="javascript:return false;" class="kt-chat__title">{{ $c->members->name }}</a>
                                                <span class="kt-chat__status">
                                                    <span class="kt-badge kt-badge--dot kt-badge--success"></span> {{ $c->members->email }}
                                                </span>
                                            </div>
                                        </div>
                                        <div class="kt-chat__right">
                                            <div class="dropdown dropdown-inline">
                                                &nbsp;
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="kt-portlet__body">
                                    <div class="kt-scroll kt-scroll--pull" data-mobile-height="300">
                                        <div class="kt-chat__messages">
                                            @if ($chatApl01 && $chatApl01->count() > 0)
                                                @foreach($chatApl01 as $chat)
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
                                            <textarea style="height: 50px" placeholder="Type here..."></textarea>
                                        </div>
                                        <div class="kt-chat__toolbar">
                                            <div class="kt_chat__tools">
{{--                                                <a href="#"><i class="flaticon2-link"></i></a>--}}
{{--                                                <a href="#"><i class="flaticon2-photograph"></i></a>--}}
{{--                                                <a href="#"><i class="flaticon2-photo-camera"></i></a>--}}
                                            </div>
                                            <div class="kt_chat__actions">
{{--                                                <button type="button" class="btn btn-brand btn-md btn-upper btn-bold kt-chat__reply">reply</button>--}}
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

                    <!--End:: App Content-->

                </div>
            </div>
            {!! Form::close() !!}
        </div>

    </div>

</div>

@push('script')
<script type="text/javascript">
    var parentEl = KTUtil.getByID('kt_chat_content');
    $(document).ready(function() {
        $('#approveAPL01').click(function (e) {
            e.preventDefault();

            if (!confirm('Anda yakin?')) {
                return false;
            }

            $('#form-apl01').attr('action', '/management-peserta/peserta/sertifikasi/apl01/verify').submit();
        });

        $('#rejectAPL01').click(function (e) {
            e.preventDefault();

            if (!confirm('Anda yakin?')) {
                return false;
            }

            $('#form-apl01').attr('action', '/management-peserta/peserta/sertifikasi/apl01/reject').submit();
        });

        $('#approveAPL01Payment').click(function (e) {
            e.preventDefault();

            if (!confirm('Anda yakin?')) {
                return false;
            }

            $('#form-apl01').attr('action', '/management-peserta/peserta/sertifikasi/pembayaran').submit();
        });

        $('#sendAPL01Payment').click(function (e) {
            e.preventDefault();

            if (!confirm('Anda yakin?')) {
                return false;
            }

            $('#form-apl01').attr('action', '/management-peserta/peserta/sertifikasi/pembayaran').submit();
        });

        $( "#form-role" ).validate({

            submitHandler: function (form) {
                $('.btn-loading').addClass('kt-spinner kt-spinner--sm kt-spinner--light');
                form[0].submit(); // submit the form
            }
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

            $.post("{{ route('peserta.pendaftaran.savechatapl01',['member_certification'=>$c]) }}",{message:textarea.value}, function (data) {
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

        // $('#remove_image').on('click', function (e) {
        //
        // });
    })
</script>
@endpush
@endsection

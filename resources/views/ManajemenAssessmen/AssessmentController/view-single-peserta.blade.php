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

                {{--                {{ array_search('direct', array_column($memberCertification->schedules->program->type,'type')) }}--}}
                {{--                {{ var_dump(array_column($memberCertification->schedules->program->type,'type')) }}--}}
            </div>
        </div>

        <div class="kt-portlet kt-portlet--tabs">
            <div class="kt-portlet__head">
                <div class="kt-portlet__head-toolbar">
                    <ul class="nav nav-tabs nav-tabs-line nav-tabs-line-success nav-tabs-line-2x" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#kt_portlet_base_demo_1_1_tab_content"
                               role="tab" aria-selected="true">
                                <i class="la la-check-circle"></i> FR APL-01
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#kt_portlet_base_demo_1_2_tab_content"
                               role="tab" aria-selected="false">
                                <i class="la la-briefcase"></i> FR APL-02
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#kt_portlet_base_demo_1_3_tab_content"
                               role="tab" aria-selected="false">
                                <i class="la la-bell-o"></i> FR PAAP-01
                            </a>
                        </li>
                        @if(in_array('cbt', $direct))
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#kt_portlet_base_demo_1_4_tab_content"
                                   role="tab" aria-selected="false">
                                    <i class="la la-desktop"></i> HASIL UJIAN CBT
                                </a>
                            </li>
                        @endif
                        @if(in_array('interview', $direct))
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#kt_portlet_base_demo_1_5_tab_content"
                                   role="tab" aria-selected="false">
                                    <i class="la la-desktop"></i> INTERVIEW / WAWANCARA
                                </a>
                            </li>
                        @endif
                        @if ($indirect)
                            @if(in_array('wawancara', $indirect))

                            @endif
                        @endif
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#kt_portlet_base_demo_1_6_tab_content"
                               role="tab" aria-selected="false">
                                <i class="la la-save"></i> REKAMAN ASESMEN
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
                                        <td>
                                            @if (Storage::exists($memberCertification->members->ktp_file))
                                                <a href="{{ Storage::url($memberCertification->members->ktp_file) }}" class="showDocument" title="KTP">KTP</a>
                                            @else
                                                KTP
                                            @endif
                                        </td>
                                        @if ($memberCertification->members->ktp_file)
                                            @if ($memberCertification->members->ktp_verified == 1)
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
                                        <td>
                                            @if (Storage::exists($memberCertification->members->foto_file))
                                                <a href="{{ Storage::url($memberCertification->members->foto_file) }}" class="showDocument" title="Foto">Foto</a>
                                            @else
                                                Foto
                                            @endif
                                        </td>
                                        @if ($memberCertification->members->foto_file)
                                            @if ($memberCertification->members->foto_verified == 1)
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
                                        <td>
                                            @if (Storage::exists($memberCertification->members->ijazah_file))
                                                <a href="{{ Storage::url($memberCertification->members->ijazah_file) }}" class="showDocument" title="Ijazah">Ijazah</a>
                                            @else
                                                Ijazah
                                            @endif
                                        </td>
                                        @if ($memberCertification->members->ijazah_file)
                                            @if ($memberCertification->members->ijazah_verified == 1)
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
                                        <td>
                                            @if (Storage::exists($memberCertification->members->skb_file))
                                                <a href="{{ Storage::url($memberCertification->members->skb_file) }}" class="showDocument" title="Surat Keterangan Kerja">Surat Keterangan Kerja</a>
                                            @else
                                                Surat Keterangan Kerja
                                            @endif

                                        </td>
                                        @if ($memberCertification->members->skb_file)
                                            @if ($memberCertification->members->skb_verified == 1)
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
                    <div class="tab-pane" id="kt_portlet_base_demo_1_2_tab_content" role="tabpanel">
                        <div class="kt-portlet kt-portlet--bordered kt-portlet--responsive-mobile">
                            <div class="kt-portlet__head">
                                <div class="kt-portlet__head-label">
                                    <h3 class="kt-portlet__head-title">
                                        FR-APL-02. ASESMEN MANDIRI
                                    </h3>
                                </div>
                                <div class="kt-portlet__head-toolbar" style="align-items: center!important;">

                                </div>
                            </div>
                            <div class="kt-portlet__body">
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
                                                        @if ($noElemen == 1)
                                                            <td rowspan="{{ ($element->kuk->count() + 1) }}">
                                                                @if ($item->proof)
                                                                    @php($noFile=1)
                                                                    @if ($item->proof['files'])
                                                                        @foreach($item->proof['files'] as $file)
                                                                            @if ($file && Storage::exists(key($file)))
                                                                                <a href="{{ Storage::url(key($file)) }}" class="showDocument">{{ $noFile }}. {{ $file[key($file)] }}</a>
                                                                            @endif
                                                                            @php($noFile++)
                                                                        @endforeach
                                                                    @endif
                                                                    {{--                                                                @php($arrProof=GeneralHelper::getAPL01File($item->proof))--}}
                                                                    {{--                                                                @if ($arrProof)--}}
                                                                    {{--                                                                    @foreach($arrProof as $proof)--}}
                                                                    {{--                                                                        <a href="{{ Storage::url('apl/'.$memberCertification->members->id.'/'.$proof) }}"--}}
                                                                    {{--                                                                           class="showDocument">{{ $proof }}</a>--}}
                                                                    {{--                                                                    @endforeach--}}
                                                                    {{--                                                                @endif--}}
                                                                @endif
                                                            </td>
                                                        @else
                                                            <td rowspan="{{ ($element->kuk->count() + 1) }}">&nbsp;</td>
                                                        @endif
                                                    </tr>
                                                    @if ($element->kuk)
                                                        @php($nokuk=1)
                                                        @foreach($element->kuk as $kuk)
                                                            <tr>
                                                                <td style="padding-left: 30px;">{{ $noElemen }}.{{ $nokuk }} {{ $kuk->name }}</td>
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
                        <div class="kt-portlet kt-portlet--bordered kt-portlet--responsive-mobile">
                            <div class="kt-portlet__head">
                                <div class="kt-portlet__head-label">
                                    <h3 class="kt-portlet__head-title">
                                        FR-PAAP-01. MERENCANAKAN AKTIVITAS DAN PROSES ASESMEN
                                    </h3>
                                </div>
                                <div class="kt-portlet__head-toolbar" style="align-items: center!important;">
                                    <div class="kt-portlet__head-actions">

                                    </div>
                                </div>
                            </div>
                            <div class="kt-portlet__body">
                                <table class="table table-bordered">
                                    <tr>
                                        <td colspan="5"><h5>1. Pendekatan Asesmen</h5></td>
                                    </tr>
                                    <tr>
                                        <td rowspan="16" width="20">1.1</td>
                                        <td rowspan="3" width="15%">Asesi</td>
                                        <td colspan="3">
                                            <label class="kt-checkbox kt-checkbox--success">
                                                <input type="checkbox" name="pa_asesi[]" {{ is_object($paap) ? (in_array(1,$paap->pa_asesi) ? 'checked':''):'' }} value="1"> Hasil pelatihan dan / atau pendidikan:
                                                <span></span>
                                            </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="3">
                                            <label class="kt-checkbox kt-checkbox--success">
                                                <input type="checkbox" name="pa_asesi[]" {{ is_object($paap) ? (in_array(2,$paap->pa_asesi) ? 'checked':''):'' }} value="2"> Pekerja berpengalaman
                                                <span></span>
                                            </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="3">
                                            <label class="kt-checkbox kt-checkbox--success">
                                                <input type="checkbox" name="pa_asesi[]" {{ is_object($paap) ? (in_array(3,$paap->pa_asesi) ? 'checked':''):'' }} value="3"> Pelatihan / belajar mandiri
                                                <span></span>
                                            </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Tujuan Asesmen</td>
                                        <td colspan="3">
                                            <div class="kt-radio-inline">
                                                <label class="kt-radio kt-radio--success">
                                                    <input type="radio" name="pa_tujuan_asesmen" {{ is_object($paap) ? (($paap->pa_tujuan_asesmen == 1) ? 'checked':''):'' }} value="1"> Sertifikasi
                                                    <span></span>
                                                </label>
                                                <label class="kt-radio kt-radio--success">
                                                    <input type="radio" name="pa_tujuan_asesmen" {{ is_object($paap) ? (($paap->pa_tujuan_asesmen == 2) ? 'checked':''):'' }} value="2"> RCC
                                                    <span></span>
                                                </label>
                                                <label class="kt-radio kt-radio--success">
                                                    <input type="radio" name="pa_tujuan_asesmen" {{ is_object($paap) ? (($paap->pa_tujuan_asesmen == 3) ? 'checked':''):'' }} value="3"> RPL
                                                    <span></span>
                                                </label>
                                                <label class="kt-radio kt-radio--success">
                                                    <input type="radio" name="pa_tujuan_asesmen" {{ is_object($paap) ? (($paap->pa_tujuan_asesmen == 4) ? 'checked':''):'' }} value="4"> Hasil pelatihan / proses pembelajaran
                                                    <span></span>
                                                </label>
                                                <label class="kt-radio kt-radio--success">
                                                    <input type="radio" name="pa_tujuan_asesmen" {{ is_object($paap) ? (($paap->pa_tujuan_asesmen == 5) ? 'checked':''):'' }} value="5"> Lainnya
                                                    <span></span>
                                                </label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td rowspan="8">Konteks Asesmen</td>
                                        <td width="20%">Lingkungan</td>
                                        <td>
                                            <label class="kt-radio kt-radio--success">
                                                <input type="radio" name="pa_konteks_asesmen[1]" {{ is_object($paap) ? (($paap->pa_konteks_asesmen[1] == 1) ? 'checked':''):'' }} value="1"> Tempat kerja nyata
                                                <span></span>
                                            </label>
                                        </td>
                                        <td>
                                            <label class="kt-radio kt-radio--success">
                                                <input type="radio" name="pa_konteks_asesmen[1]" {{ is_object($paap) ? (($paap->pa_konteks_asesmen[1] == 2) ? 'checked':''):'' }} value="2"> Tempat kerja simulasi
                                                <span></span>
                                            </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Peluang untuk mengumpulkan bukti dalam sejumlah situasi</td>
                                        <td>
                                            <label class="kt-radio kt-radio--success">
                                                <input type="radio" name="pa_konteks_asesmen[2]" {{ is_object($paap) ? (($paap->pa_konteks_asesmen[2] == 1) ? 'checked':''):'' }} value="1"> Tersedia
                                                <span></span>
                                            </label>
                                        </td>
                                        <td>
                                            <label class="kt-radio kt-radio--success">
                                                <input type="radio" name="pa_konteks_asesmen[2]" {{ is_object($paap) ? (($paap->pa_konteks_asesmen[2] == 2) ? 'checked':''):'' }} value="2"> Terbatas
                                                <span></span>
                                            </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td rowspan="3">Hubungan antara standar kompetensi dan:</td>
                                        <td colspan="2">
                                            <div class="kt-radio-inline">
                                                <label class="kt-radio kt-radio--success">
                                                    <input type="radio" name="pa_konteks_asesmen[3][0]" {{ is_object($paap) ? (($paap->pa_konteks_asesmen[3][0] == 1) ? 'checked':''):'' }} value="1"> Bukti untuk mendukung asesmen / RPL:
                                                    <span></span>
                                                </label>
                                                <label class="kt-radio kt-radio--success">
                                                    <input type="radio" name="pa_konteks_asesmen[3][1]" {{ is_object($paap) ? (($paap->pa_konteks_asesmen[3][0] == 1 && $paap->pa_konteks_asesmen[3][1] == 1) ? 'checked':''):'' }} value="1"> <i class="la la-smile-o" style="font-size: 1.6rem;"></i>
                                                    <span></span>
                                                </label>
                                                <label class="kt-radio kt-radio--success">
                                                    <input type="radio" name="pa_konteks_asesmen[3][1]" {{ is_object($paap) ? (($paap->pa_konteks_asesmen[3][0] == 1 && $paap->pa_konteks_asesmen[3][1] == 2) ? 'checked':''):'' }} value="2"> <i class="la la-meh-o" style="font-size: 1.6rem;"></i>
                                                    <span></span>
                                                </label>
                                                <label class="kt-radio kt-radio--success">
                                                    <input type="radio" name="pa_konteks_asesmen[3][1]" {{ is_object($paap) ? (($paap->pa_konteks_asesmen[3][0] == 1 && $paap->pa_konteks_asesmen[3][1] == 3) ? 'checked':''):'' }} value="3"> <i class="la la-frown-o" style="font-size: 1.6rem;"></i>
                                                    <span></span>
                                                </label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <div class="kt-radio-inline">
                                                <label class="kt-radio kt-radio--success">
                                                    <input type="radio" name="pa_konteks_asesmen[3][0]" {{ is_object($paap) ? (($paap->pa_konteks_asesmen[3][0] == 2) ? 'checked':''):'' }} value="2"> Aktivitas kerja di tempat kerja kandidat:
                                                    <span></span>
                                                </label>
                                                <label class="kt-radio kt-radio--success">
                                                    <input type="radio" name="pa_konteks_asesmen[3][1]" {{ is_object($paap) ? (($paap->pa_konteks_asesmen[3][0] == 2 && $paap->pa_konteks_asesmen[3][1] == 1) ? 'checked':''):'' }} value="1"> <i class="la la-smile-o" style="font-size: 1.6rem;"></i>
                                                    <span></span>
                                                </label>
                                                <label class="kt-radio kt-radio--success">
                                                    <input type="radio" name="pa_konteks_asesmen[3][1]" {{ is_object($paap) ? (($paap->pa_konteks_asesmen[3][0] == 2 && $paap->pa_konteks_asesmen[3][1] == 2) ? 'checked':''):'' }} value="2"> <i class="la la-meh-o" style="font-size: 1.6rem;"></i>
                                                    <span></span>
                                                </label>
                                                <label class="kt-radio kt-radio--success">
                                                    <input type="radio" name="pa_konteks_asesmen[3][1]" {{ is_object($paap) ? (($paap->pa_konteks_asesmen[3][0] == 2 && $paap->pa_konteks_asesmen[3][1] == 3) ? 'checked':''):'' }} value="3"> <i class="la la-frown-o" style="font-size: 1.6rem;"></i>
                                                    <span></span>
                                                </label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <div class="kt-radio-inline">
                                                <label class="kt-radio kt-radio--success">
                                                    <input type="radio" name="pa_konteks_asesmen[3][0]" {{ is_object($paap) ? (($paap->pa_konteks_asesmen[3][0] == 3) ? 'checked':''):'' }} value="3"> Kegiatan Pembelajaran:
                                                    <span></span>
                                                </label>
                                                <label class="kt-radio kt-radio--success">
                                                    <input type="radio" name="pa_konteks_asesmen[3][1]" {{ is_object($paap) ? (($paap->pa_konteks_asesmen[3][0] == 3 && $paap->pa_konteks_asesmen[3][1] == 1) ? 'checked':''):'' }} value="1"> <i class="la la-smile-o" style="font-size: 1.6rem;"></i>
                                                    <span></span>
                                                </label>
                                                <label class="kt-radio kt-radio--success">
                                                    <input type="radio" name="pa_konteks_asesmen[3][1]" {{ is_object($paap) ? (($paap->pa_konteks_asesmen[3][0] == 3 && $paap->pa_konteks_asesmen[3][1] == 2) ? 'checked':''):'' }} value="2"> <i class="la la-meh-o" style="font-size: 1.6rem;"></i>
                                                    <span></span>
                                                </label>
                                                <label class="kt-radio kt-radio--success">
                                                    <input type="radio" name="pa_konteks_asesmen[3][1]" {{ is_object($paap) ? (($paap->pa_konteks_asesmen[3][0] == 3 && $paap->pa_konteks_asesmen[3][1] == 3) ? 'checked':''):'' }} value="3"> <i class="la la-frown-o" style="font-size: 1.6rem;"></i>
                                                    <span></span>
                                                </label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td rowspan="3">Siapa yang melakukan asesmen / RPL</td>
                                        <td colspan="2">
                                            <label class="kt-radio kt-radio--success">
                                                <input type="radio" name="pa_konteks_asesmen[4]" {{ is_object($paap) ? (($paap->pa_konteks_asesmen[4] == 1) ? 'checked':''):'' }} value="1"> Oleh Lembaga Sertifikasi
                                                <span></span>
                                            </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <label class="kt-radio kt-radio--success">
                                                <input type="radio" name="pa_konteks_asesmen[4]" {{ is_object($paap) ? (($paap->pa_konteks_asesmen[4] == 2) ? 'checked':''):'' }} value="2"> Oleh Organisasi Pelatihan
                                                <span></span>
                                            </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <label class="kt-radio kt-radio--success">
                                                <input type="radio" name="pa_konteks_asesmen[4]" {{ is_object($paap) ? (($paap->pa_konteks_asesmen[4] == 3) ? 'checked':''):'' }} value="3"> Oleh asesor perusahaan
                                                <span></span>
                                            </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td rowspan="4">Orang yang relevan untuk dikonfirmasi</td>
                                        <td colspan="3">
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <label class="kt-checkbox kt-checkbox--success">
                                                        <input type="checkbox" name="pa_orang_relevan[1][key]" {{ is_object($paap) ? ((isset($paap->pa_orang_relevan[1]['key']) && $paap->pa_orang_relevan[1]['key'] == 1) ? 'checked':''):'' }} value="1"> Manajer sertifikasi LSP
                                                        <span></span>
                                                    </label>
                                                </div>
                                                <div class="col-sm-8">
                                                    <input type="text" name="pa_orang_relevan[1][value]" value="{{ is_object($paap) ? (!empty($paap->pa_orang_relevan[1]['value']) ? $paap->pa_orang_relevan[1]['value']:''):'' }}" class="form-control">
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="3">
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <label class="kt-checkbox kt-checkbox--success">
                                                        <input type="checkbox" name="pa_orang_relevan[2][key]" {{ is_object($paap) ? ((isset($paap->pa_orang_relevan[2]['key']) && $paap->pa_orang_relevan[2]['key'] == 2) ? 'checked':''):'' }} value="2"> Master Assessor / Master Trainer / Asesor Utama kompetensi
                                                        <span></span>
                                                    </label>
                                                </div>
                                                <div class="col-sm-8">
                                                    <input type="text" name="pa_orang_relevan[2][value]" value="{{ is_object($paap) ? (!empty($paap->pa_orang_relevan[2]['value']) ? $paap->pa_orang_relevan[2]['value']:''):'' }}" class="form-control">
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="3">
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <label class="kt-checkbox kt-checkbox--success">
                                                        <input type="checkbox" name="pa_orang_relevan[3][key]" {{ is_object($paap) ? ((isset($paap->pa_orang_relevan[3]['key']) && $paap->pa_orang_relevan[3]['key'] == 3) ? 'checked':''):'' }} value="3"> Manajer pelatihan Lembaga Training terakreditasi / Lembaga Training terdaftar
                                                        <span></span>
                                                    </label>
                                                </div>
                                                <div class="col-sm-8">
                                                    <input type="text" name="pa_orang_relevan[3][value]" value="{{ is_object($paap) ? (!empty($paap->pa_orang_relevan[3]['value']) ? $paap->pa_orang_relevan[3]['value']:''):'' }}" class="form-control">
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="3">
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <label class="kt-checkbox kt-checkbox--success">
                                                        <input type="checkbox" name="pa_orang_relevan[4][key]" {{ is_object($paap) ? ((isset($paap->pa_orang_relevan[4]['key']) && $paap->pa_orang_relevan[4]['key'] == 4) ? 'checked':''):'' }} value="4"> Lainnya :
                                                        <span></span>
                                                    </label>
                                                </div>
                                                <div class="col-sm-8">
                                                    <input type="text" name="pa_orang_relevan[4][value]" value="{{ is_object($paap) ? (!empty($paap->pa_orang_relevan[4]['value']) ? $paap->pa_orang_relevan[4]['value']:''):'' }}" class="form-control">
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td rowspan="5">1.2</td>
                                        <td rowspan="5">Tolak Ukur Asesmen</td>
                                        <td colspan="3">
                                            <label class="kt-radio kt-radio--success">
                                                <input type="radio" name="pa_tolak_ukur" {{ is_object($paap) ? (($paap->pa_tolak_ukur == 1) ? 'checked':''):'' }} value="1"> Standar Kompetensi
                                                <span></span>
                                            </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="3">
                                            <label class="kt-radio kt-radio--success">
                                                <input type="radio" name="pa_tolak_ukur" {{ is_object($paap) ? (($paap->pa_tolak_ukur == 2) ? 'checked':''):'' }} value="2"> Kriteria asesmen dari kurikulum pelatihan
                                                <span></span>
                                            </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="3">
                                            <label class="kt-radio kt-radio--success">
                                                <input type="radio" name="pa_tolak_ukur" {{ is_object($paap) ? (($paap->pa_tolak_ukur == 3) ? 'checked':''):'' }} value="3"> Spesifikasi kinerja suatu perusahaan atau industri:
                                                <span></span>
                                            </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="3">
                                            <label class="kt-radio kt-radio--success">
                                                <input type="radio" name="pa_tolak_ukur" {{ is_object($paap) ? (($paap->pa_tolak_ukur == 4) ? 'checked':''):'' }} value="4"> Spesifikasi Produk:
                                                <span></span>
                                            </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="3">
                                            <label class="kt-radio kt-radio--success">
                                                <input type="radio" name="pa_tolak_ukur" {{ is_object($paap) ? (($paap->pa_tolak_ukur == 5) ? 'checked':''):'' }} value="5"> Pedoman Khusus
                                                <span></span>
                                            </label>
                                        </td>
                                    </tr>
                                </table>

                                <table class="table table-bordered">
                                    <tr>
                                        <td colspan="11"><h5>2. Rencana Asesmen</h5></td>
                                    </tr>

                                    @if ($memberCertification->apl01 && $memberCertification->apl01->count() > 0)
                                        @php($noUk=1)
                                        @foreach($memberCertification->apl01 as $item)
                                            <tr class="bg-light">
                                                <td>Unit Kompetensi</td>
                                                <td colspan="10">: {{ $item->puk->uk->name }}</td>
                                            </tr>
                                            @if ($item->puk->uk->elements && $item->puk->uk->elements->count() > 0)
                                                @php($noElemen=1)
                                                @foreach($item->puk->uk->elements as $element)
                                                    <tr>
                                                        <td><strong>ELEMEN</strong></td>
                                                        <td colspan="10">: {{ $element->name }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td rowspan="2" class="text-center"><strong>Kriteria Unjuk Kerja</strong></td>
                                                        <td rowspan="2" width="10%"><strong>Bukti-Bukti</strong> (Kinerja, produk, Portofolio, dan / atau hafalan) diidentifikasi berdasarkan Kriteria Unjuk Kerja dan pendekatan asesmen.</td>
                                                        <td colspan="3"><strong>Jenis Bukti</strong></td>
                                                        <td colspan="6" class="text-center"><strong>Metode dan Perangkat Asesmen CL (Daftar Periksa), DIT (Daftar Instruksi Terstruktur), DPL(Daftar Pertanyaan Lisan), DPT (Daftar Pertanyaan Tertulis), VP (Verifikasi Portofolio), CUP (Ceklis Ulasan Produk).</strong></td>
                                                    </tr>
                                                    <tr>
                                                        <td width="10">L</td>
                                                        <td width="10">TL</td>
                                                        <td width="10">T</td>
                                                        <td width="8%">
                                                            <div style="writing-mode: vertical-rl;text-orientation: sideways; height: 200px; transform: rotate(180deg);text-align: center;"><strong>Obsevasi langsung</strong> <br> <small>(kerja nyata/aktivitas waktu nyata di tempat kerja dilingkungan tempat kerja yang disimulasikan)</small></div>
                                                        </td>
                                                        <td width="8%">
                                                            <div style="writing-mode: vertical-rl;text-orientation: sideways; height: 200px; transform: rotate(180deg);text-align: center;"><strong>Kegiatan Struktur</strong> <br> <small>(latihan simulasi dan bermain peran, proyek,  presentasi, lembar kegiatan)</small></div>
                                                        </td>
                                                        <td width="8%">
                                                            <div style="writing-mode: vertical-rl;text-orientation: sideways; height: 200px; transform: rotate(180deg);text-align: center;"><strong>Tanya Jawab</strong> <br> <small>(pertanyaan tertulis, wawancara, asesmen diri, tanya jawab lisan, angket, ujian lisan atau tertulis)</small></div>
                                                        </td>
                                                        <td width="8%">
                                                            <div style="writing-mode: vertical-rl;text-orientation: sideways; height: 200px; transform: rotate(180deg);text-align: center;"><strong>Verifikasi  Portfolio</strong> <br> <small>(sampel pekerjaaan yang disusun oleh kandidat, produk dengan dokumentasi pendukung, bukti sejarah, jurnal atau buku catatan, informasi tentang pengalaman hidup)</small></div>
                                                        </td>
                                                        <td width="8%">
                                                            <div style="writing-mode: vertical-rl;text-orientation: sideways; height: 200px; transform: rotate(180deg);text-align: center;"><strong>Review produk</strong> <br> <small>(testimoni dan laporan dari atasan dan atasan, bukti pelatihan, otentikasi pencapaian sebelumnya, wawancara dengan atasan, atasan, atau rekan kerja)</small></div>
                                                        </td>
                                                        <td width="8%"><div style="writing-mode: vertical-rl;text-orientation: sideways; height: 200px; transform: rotate(180deg);text-align: center;">Lainnya : </div></td>

                                                    </tr>

                                                    @if ($element->kuk)
                                                        @php($nokuk=1)
                                                        @foreach($element->kuk as $kuk)
                                                            <tr>
                                                                <td style="padding-left: 30px;">{{ $noElemen }} .{{ $nokuk }} {{ $kuk->name }}</td>
                                                                <td></td>
                                                                @if ($noUk == 1 && $noElemen == 1 && $nokuk == 1)

                                                                    @if (is_array($direct) && !empty($direct))
                                                                        <td class="text-center">
                                                                            <label class="kt-radio kt-radio--success">
                                                                                <input type="radio" class="paap_metode" {{ is_object($paap) ? (($paap->metode_asesmen == 1) ? 'checked':''):'' }} name="metode_asesmen" value="1">&nbsp;
                                                                                <span></span>
                                                                            </label>
                                                                        </td>
                                                                    @else
                                                                        <td class="text-center">
                                                                            <label class="kt-radio kt-radio--success">
                                                                                <input type="radio" class="paap_metode" disabled name="metode_asesmen" value="1">&nbsp;
                                                                                <span></span>
                                                                            </label>
                                                                        </td>
                                                                    @endif
                                                                    @if (is_array($indirect) && !empty($indirect))
                                                                        <td class="text-center">
                                                                            <label class="kt-radio kt-radio--success">
                                                                                <input type="radio" class="paap_metode" {{ is_object($paap) ? (($paap->metode_asesmen == 2) ? 'checked':''):'' }} name="metode_asesmen" value="2">&nbsp;
                                                                                <span></span>
                                                                            </label>
                                                                        </td>
                                                                    @else
                                                                        <td class="text-center">
                                                                            <label class="kt-radio kt-radio--success">
                                                                                <input type="radio" class="paap_metode" disabled name="metode_asesmen" value="2">&nbsp;
                                                                                <span></span>
                                                                            </label>
                                                                        </td>
                                                                    @endif
                                                                    <td class="text-center">
                                                                        <label class="kt-radio kt-radio--success">
                                                                            <input type="radio" class="paap_metode" {{ is_object($paap) ? (($paap->metode_asesmen == 3) ? 'checked':''):'' }} name="metode_asesmen" value="3">&nbsp;
                                                                            <span></span>
                                                                        </label>
                                                                    </td>
                                                                @else
                                                                    <td class="text-center"><span class="for_l"></span></td>
                                                                    <td class="text-center"><span class="for_tl"></span></td>
                                                                    <td class="text-center"><span class="for_t"></span></td>
                                                                @endif
                                                                <td><span class="for_cbt"></span></td>
                                                                <td></td>
                                                                <td><span class="for_interview"></span></td>
                                                                <td><span class="for_portfolio"></span></td>
                                                                <td></td>
                                                                <td></td>
                                                            </tr>
                                                            @php($nokuk++)
                                                        @endforeach
                                                        <tr class="bg-light">
                                                            <td colspan="11" class=""></td>
                                                        </tr>
                                                    @endif
                                                    @php($noElemen++)
                                                @endforeach
                                                <tr class="bg-success">
                                                    <td colspan="11" class="table-borderless warning"></td>
                                                </tr>
                                            @endif
                                            @php($noUk++)
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="11">Tidak ada Data Unit Kompetensi</td>
                                        </tr>
                                    @endif
                                </table>

                                <table class="table table-bordered">
                                    <tr>
                                        <td colspan="2"><h5>3. Modifikasi dan Kontekstualisasi</h5></td>
                                    </tr>
                                    <tr>
                                        <td width="35%">3.1 Karakteristik Kandidat</td>
                                        <td>
                                            <input type="text" name="mk_1" value="{{ is_object($paap) ? (!empty($paap->mk_1) ? $paap->mk_1:''):'' }}" class="form-control">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>3.2 Kebutuhan kontekstualisasi</td>
                                        <td>
                                            <input type="text" name="mk_2" value="{{ is_object($paap) ? (!empty($paap->mk_2) ? $paap->mk_2:''):'' }}" class="form-control">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>3.3 Saran yang diberikan oleh paket pelatihan atau pengembang pelatihan</td>
                                        <td>
                                            <input type="text" name="mk_3" value="{{ is_object($paap) ? (!empty($paap->mk_3) ? $paap->mk_3:''):'' }}" class="form-control">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>3.4 Peluang untuk kegiatan asesmen terintegrasi dan mencatat setiap perubahan yang diperlukan untuk alat asesmen</td>
                                        <td>
                                            <input type="text" name="mk_4" value="{{ is_object($paap) ? (!empty($paap->mk_4) ? $paap->mk_4:''):'' }}" class="form-control">
                                        </td>
                                    </tr>
                                </table>

                                <div class="form-group">

                                </div>

                            </div>
                            <div class="kt-portlet__foot">
                                <div class="kt-form__actions">
                                    <div class="row">
                                        <div class="col-sm-12">

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if(in_array('cbt', $direct))
                    <div class="tab-pane active" id="kt_portlet_base_demo_1_4_tab_content" role="tabpanel">
                        <div class="kt-portlet kt-portlet--bordered kt-portlet--responsive-mobile">
                            <div class="kt-portlet__head">
                                <div class="kt-portlet__head-label">
                                    <h3 class="kt-portlet__head-title">
                                        HASIL UJIAN CBT
                                    </h3>
                                </div>
                                <div class="kt-portlet__head-toolbar" style="align-items: center!important;">
                                    <div class="kt-portlet__head-actions">

                                    </div>
                                </div>
                            </div>
                            <div class="kt-portlet__body">


                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Modul</th>
                                        <th style="text-align: right;">Total Soal</th>
                                        <th style="text-align: right;">Jumlah Benar</th>
                                        <th style="text-align: right;">Nilai</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php($no=1)
                                    @foreach($ujian_detail as $dtl)
                                        <?php
//                                            dd($ujian_batch_id);
                                                $modul_soal = \DB::table('modul_soal')->where('modul_id',$dtl->modul_id)->get();
                                                $ujian_modul_id = \DB::table('ujian_modul')->where('modul_id', $dtl->modul_id)->where('ujian_batch_id', $ujian_batch_id)->first();
//                                             dd($ujian_modul_id);
//                                            $ujian_modul_id = null;
//                                            $soal_peserta_id = \DB::table('soal_peserta')->where('ujian_modul_id', $ujian_modul_id->ujian_modul_id)->get();
//                                            dd($soal_peserta_id->pluck('soal_peserta_id'));

                                             /** Get Element */
                                            $elementCbt = \App\Models\Element::where('competence_unit_id', $dtl->modul_id)->get();
                                        ?>
                                        <tr>
                                            <td>{{ $no }}</td>
                                            <td>{{ $dtl->nama_modul }}</td>
                                            <td align="right">{{ \App\Models\StartUjian\Peserta_jawab::whereIn('soal_id', $modul_soal->pluck('soal_id'))->whereIn('soal_peserta_id', $soal_peserta_id->pluck('soal_peserta_id') )->count() }}</td>
                                            {{-- <td align="right">{{ \App\Models\Peserta_jawab::whereIn('soal_id', $modul_soal->pluck('soal_id'))->where('soal_peserta_id', $soal_peserta_id->soal_peserta_id)->where('is_bener', true)->count() }}</td>--}}
                                            <td align="right">{{ \DB::table('soal_peserta')->where('ujian_modul_id', $ujian_modul_id->ujian_modul_id)->where('perdana_peserta_id', $perdana_peserta_id)->first()->nilai }}</td>
                                            <td align="right">{{ $dtl->nilai }}%</td>
                                        </tr>
                                        @php($no++)
                                    @endforeach
                                    </tbody>
                                    <tfoot>
                                    <tr style="background-color: #e5e5e5;">
                                        <td align="right" colspan="2">TOTAL</td>
                                        <td align="right">{{ $total_soal->count() }}</td>
                                        <td align="right">{{ $total_soal->where('is_bener', true)->count() }}</td>
                                        <td align="right">{{ $total_soal->where('is_bener', true)->count() }}%</td>
                                    </tr>
                                    </tfoot>
                                </table>

                            </div>
                            <div class="kt-portlet__foot">
                                <div class="kt-form__actions">
                                    <div class="row">
                                        <div class="col-sm-12">

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                    @if(in_array('interview', $direct))
                    <div class="tab-pane" id="kt_portlet_base_demo_1_5_tab_content" role="tabpanel">
                        <div class="kt-portlet kt-portlet--bordered kt-portlet--responsive-mobile">
                            <div class="kt-portlet__head">
                                <div class="kt-portlet__head-label">
                                    <h3 class="kt-portlet__head-title">
                                        INTERVIEW / WAWANCARA
                                    </h3>
                                </div>
                                <div class="kt-portlet__head-toolbar" style="align-items: center!important;">
                                    <div class="kt-portlet__head-actions">
                                    </div>
                                </div>
                            </div>
                            <div class="kt-portlet__body">
                                <div class="clearfix">
                                    <a href="#" class="btn btn-success newQuestion">Tambah Pertanyaan</a>
                                    <br><br>
                                </div>
                                {!! Form::open(['url'=>route('asesmen.interview.save',['member_certification'=>$memberCertification->id]),'name'=>'formInterview','id'=>'formInterview']) !!}
                                <input type="hidden" name="tipe_pertanyaan" value="lisan">
                                <table class="table table-bordered tablePertanyaan">
                                    <thead>
                                    <tr>
                                        <th rowspan="2" width="20">No</th>
                                        <th rowspan="2">Pertanyaan/Kesimpulan</th>
                                        <th colspan="2" width="10%">Keputusan</th>
                                        <th rowspan="2" width="5%">Aksi</th>
                                    </tr>
                                    <tr>
                                        <th>K</th>
                                        <th>BK</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if (is_object($memberCertification->interview) && $memberCertification->interview->count() > 0)
                                        @php($noInterview=1)
                                        @foreach ($memberCertification->interview as $interview)
                                            <tr>
                                                <td>{{ $noInterview }}</td>
                                                <td>
                                                    <table class='table table-bordered'>
                                                        <tbody>
                                                        <tr>
                                                            <td>Pertanyaan : {!! $interview->pertanyaan_lisan->pertanyaan !!}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Jawaban yang diharapkan : {!! $interview->pertanyaan_lisan->jawaban !!}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Kesimpulan jawaban asesi : <textarea name='kesimpulan[{{ $interview->pertanyaan_lisan->id }}]' id='' class='form-control' cols='30' rows='10'>{{ $interview->kesimpulan }}</textarea></td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                </td>
                                                <td><input type='radio' name='is_kompeten[{{ $interview->pertanyaan_lisan->id }}]' required="required" {{ ($interview->is_kompeten == 1) ? 'checked':'' }} value='1'></td>
                                                <td>
                                                    <input type='radio' name='is_kompeten[{{ $interview->pertanyaan_lisan->id }}]' required="required" {{ ($interview->is_kompeten == 2) ? 'checked':'' }} value='2'>
                                                    <input type="hidden" name="pertanyaan_id[{{ $interview->pertanyaan_lisan->id }}]" value="{{ $interview->pertanyaan_lisan->id }}">
                                                </td>
                                                <td><a href="{{ route('asesmen.interview.delete',['interview_id'=>$interview->id,'member_certification'=>$memberCertification->id]) }}" class="btn btn-sm btn-icon btn-clean btn-icon-sm delconfirm" title="Delete Pertanyaan"><i class="la la-trash"></i></a></td>
                                            </tr>
                                            @php($noInterview++)
                                        @endforeach
                                    @endif

                                    </tbody>
                                </table>
                                {!! Form::close() !!}
                            </div>
                            <div class="kt-portlet__foot">
                                <div class="kt-form__actions">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <a href="#" class="btn btn-success btn-lg pull-right btnSimpanInterview">Simpan Data Interview/Wawancara</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                    <div class="tab-pane" id="kt_portlet_base_demo_1_6_tab_content" role="tabpanel">
                        <div class="kt-portlet kt-portlet--bordered kt-portlet--responsive-mobile">
                            <div class="kt-portlet__head">
                                <div class="kt-portlet__head-label">
                                    <h3 class="kt-portlet__head-title">
                                        FR.AC.01. FORMULIR REKAMAN ASESMEN KOMPETENSI
                                    </h3>
                                </div>
                                <div class="kt-portlet__head-toolbar" style="align-items: center!important;">
                                    <div class="kt-portlet__head-actions">
                                    </div>
                                </div>
                            </div>
                            <div class="kt-portlet__body">
                                {!! Form::open(['url'=>route('asesmen.rekaman.save',['member_certification'=>$memberCertification->id]),'name'=>'formRekaman','id'=>'formRekaman']) !!}
                                <table class="table table-bordered">
                                    <tr>
                                        <td width="25%">Nama Asesi</td>
                                        <td>{{ $memberCertification->members->name }}</td>
                                    </tr>
                                    <tr>
                                        <td>Nama Asesor</td>
                                        <td>{{ $memberCertification->assessor->name ?? 'No asesor' }}</td>
                                    </tr>
                                    <tr>
                                        <td>Skema sertifikasi Okupasi/ Kualifikasi/ Klaster</td>
                                        <td>{{ $memberCertification->schedules->program->name }}</td>
                                    </tr>
                                    <tr>
                                        <td>Tanggal mulainya asesmen</td>
                                        <td>{{ date("d, F Y", strtotime($memberCertification->schedules->started_at)) }}</td>
                                    </tr>
                                    <tr>
                                        <td>Keputusan Asesmen</td>
                                        <td>
                                            <input name="rekomendasi_asesor" data-switch="true" {{ is_object($rekaman) ? (($rekaman->rekomendasi_asesor == true) ? 'checked':''):'' }} id="is_kompeten" type="checkbox" checked data-on-text="Kompeten" data-handle-width="70" data-off-text="Belum Kompeten" data-on-color="brand" data-off-color="warning">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Tindak lanjut yang dibutuhkan (Masukkan pekerjaan tambahan dan asesmen yang diperlukan untuk mencapai kompetensi) </td>
                                        <td>
                                            <div class="kt-radio-inline">
                                                <label class="kt-radio kt-radio--success">
                                                    <input type="radio" name="tindak_lanjut" {{ is_object($rekaman) ? (($rekaman->tindak_lanjut == 1) ? 'checked':''):'' }} value="1">
                                                    Seluruh Elemen Kompetensi/Kriteria Unjuk Kerja (KUK) yang diujikan telah tercapai
                                                    <span></span>
                                                </label>
                                                <label class="kt-radio kt-radio--success">
                                                    <input type="radio" name="tindak_lanjut" {{ is_object($rekaman) ? (($rekaman->tindak_lanjut == 2) ? 'checked':''):'' }} value="2">
                                                    Terdapat Elemen Kompetensi/Kriteria Unjuk Kerja (KUK) yang diujikan belum tercapai Pada Elemen / Kriteria Unjuk Kerja   :
                                                    <span></span>
                                                </label>
                                                <br><br>

                                                <!--begin::Portlet-->
                                                <div class="kt-portlet ">
                                                    <div class="kt-portlet__head">
                                                        <div class="kt-portlet__head-label">
                                                            <h3 class="kt-portlet__head-title">
                                                                Daftar Unit Kompetensi
                                                            </h3>
                                                        </div>
                                                    </div>
                                                    <div class="kt-portlet__body">

                                                        <!--begin::Accordion-->
                                                        <div class="accordion accordion-solid accordion-toggle-plus" id="accordionTindakLanjut">
                                                            <div class="card">
                                                                <div class="card-header" id="headingOne6">
                                                                    <div class="card-title" data-toggle="collapse" data-target="#uktindaklanjut" aria-expanded="false" aria-controls="collapseOne6">
                                                                        <i class="flaticon-more"></i> Unit Kompetensi
                                                                    </div>
                                                                </div>
                                                                <div id="uktindaklanjut" class="collapse" aria-labelledby="headingOne6" data-parent="#accordionTindakLanjut">
                                                                    <div class="card-body">

                                                                        <table class="table table-bordered">
                                                                            @if ($memberCertification->apl01 && $memberCertification->apl01->count() > 0)
                                                                                @php($noUk=1)
                                                                                @foreach($memberCertification->apl01 as $item)
                                                                                    <tr class="bg-light">
                                                                                        <td><strong>Unit Kompetensi: {{ $noUk }} {{ $item->puk->uk->name }}</strong> </td>
                                                                                    </tr>
                                                                                    @if ($item->puk->uk->elements && $item->puk->uk->elements->count() > 0)
                                                                                        @php($noElemen=1)
                                                                                        @foreach($item->puk->uk->elements as $element)
                                                                                            <tr>
                                                                                                <td style="text-indent:20px;">
                                                                                                    <label class="kt-checkbox kt-checkbox--success">
                                                                                                        <input type="checkbox" name="elemen_tindak_lanjut[]" value="{{ $element->id }}"> <strong>Elemen :</strong> {{ $noElemen }} : {{ $element->name }}
                                                                                                        <span></span>
                                                                                                    </label>
                                                                                                </td>
                                                                                            </tr>
                                                                                            @if ($element->kuk)
                                                                                                @php($nokuk=1)
                                                                                                @foreach($element->kuk as $kuk)
                                                                                                    <tr>
                                                                                                        <td style="text-indent:40px;">
                                                                                                            <label class="kt-checkbox kt-checkbox--success">
                                                                                                                <input type="checkbox" name="kuk_tindak_lanjut[]" value="{{ $kuk->id }}"> KUK : {{ $nokuk }} {{ $kuk->name }}
                                                                                                                <span></span>
                                                                                                            </label>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    @php($nokuk++)
                                                                                                @endforeach
                                                                                            @endif
                                                                                            @php($noElemen++)
                                                                                        @endforeach
                                                                                    @endif
                                                                                    @php($noUk++)
                                                                                @endforeach
                                                                            @else
                                                                                Tidak ada Data Unit Kompetensi
                                                                            @endif
                                                                        </table>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <!--end::Accordion-->
                                                    </div>
                                                </div>

                                                <!--end::Portlet-->

                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Komentar/ Observasi oleh asesor </td>
                                        <td>
                                            <div class="kt-radio-inline">
                                                <label class="kt-radio kt-radio--success">
                                                    <input type="radio" name="komentar_asesor" {{ is_object($rekaman) ? (($rekaman->komentar_asesor == 1) ? 'checked':''):'' }} value="1">
                                                    Tingkatkan kompetensi anda atau ambil kompetensi pada kualifikasi berikutnya
                                                    <span></span>
                                                </label> <br>
                                                <label class="kt-radio kt-radio--success">
                                                    <input type="radio" name="komentar_asesor" {{ is_object($rekaman) ? (($rekaman->komentar_asesor == 2) ? 'checked':''):'' }} value="2">
                                                    Perlu dilakukan asesmen ulang pada unit kompetensi :
                                                    <span></span>
                                                </label>
                                                <br><br>

                                                <!--begin::Portlet-->
                                                <div class="kt-portlet ">
                                                    <div class="kt-portlet__head">
                                                        <div class="kt-portlet__head-label">
                                                            <h3 class="kt-portlet__head-title">
                                                                Daftar Unit Kompetensi
                                                            </h3>
                                                        </div>
                                                    </div>
                                                    <div class="kt-portlet__body">

                                                        <!--begin::Accordion-->
                                                        <div class="accordion accordion-solid accordion-toggle-plus" id="accordionExample6">
                                                            <div class="card">
                                                                <div class="card-header" id="headingOne6">
                                                                    <div class="card-title" data-toggle="collapse" data-target="#ukkomentarasesor" aria-expanded="false" aria-controls="collapseOne6">
                                                                        <i class="flaticon-more"></i> Unit Kompetensi
                                                                    </div>
                                                                </div>
                                                                <div id="ukkomentarasesor" class="collapse" aria-labelledby="headingOne6" data-parent="#accordionExample6">
                                                                    <div class="card-body">
                                                                        <table class="table table-bordered">
                                                                            @if ($memberCertification->apl01 && $memberCertification->apl01->count() > 0)
                                                                                @php($noUk=1)
                                                                                @foreach($memberCertification->apl01 as $item)
                                                                                    <tr class="bg-light">
                                                                                        <td><strong>Unit Kompetensi: {{ $noUk }} {{ $item->puk->uk->name }}</strong> </td>
                                                                                    </tr>
                                                                                    @if ($item->puk->uk->elements && $item->puk->uk->elements->count() > 0)
                                                                                        @php($noElemen=1)
                                                                                        @foreach($item->puk->uk->elements as $element)
                                                                                            <tr>
                                                                                                <td style="text-indent:20px;">
                                                                                                    <label class="kt-checkbox kt-checkbox--success">
                                                                                                        <input type="checkbox" name="elemen_komentar_asesor[]" value="{{ $element->id }}"> <strong>Elemen :</strong> {{ $noElemen }} : {{ $element->name }}
                                                                                                        <span></span>
                                                                                                    </label>
                                                                                                </td>
                                                                                            </tr>
                                                                                            @if ($element->kuk)
                                                                                                @php($nokuk=1)
                                                                                                @foreach($element->kuk as $kuk)
                                                                                                    <tr>
                                                                                                        <td style="text-indent:40px;">
                                                                                                            <label class="kt-checkbox kt-checkbox--success">
                                                                                                                <input type="checkbox" name="kuk_komentar_asesor[]" value="{{ $kuk->id }}"> KUK : {{ $nokuk }} {{ $kuk->name }}
                                                                                                                <span></span>
                                                                                                            </label>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    @php($nokuk++)
                                                                                                @endforeach
                                                                                            @endif
                                                                                            @php($noElemen++)
                                                                                        @endforeach
                                                                                    @endif
                                                                                    @php($noUk++)
                                                                                @endforeach
                                                                            @else
                                                                                Tidak ada Data Unit Kompetensi
                                                                            @endif
                                                                        </table>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <!--end::Accordion-->
                                                    </div>
                                                </div>

                                                <!--end::Portlet-->

                                            </div>
                                        </td>
                                    </tr>
                                </table>

                                <h6>Beri tanda centang ( &#x2713; ) di kolom yang sesuai untuk mencerminkan bukti yang diperoleh untuk menentukan Kompetensi Asesi untuk setiap Unit Kompetensi.</h6>

                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th>Unit Kompetensi</th>
                                        <th width="10%">Observasi Demonstrasi</th>
                                        <th width="10%">Portfolio</th>
                                        <th width="10%">Pernyataan pihak ketiga</th>
                                        <th width="10%">Pertanyaan Lisan</th>
                                        <th width="10%">Pertanyaan Tertulis</th>
                                        <th width="10%">Proyek Kerja</th>
                                        <th width="10%">Lainnya</th>
                                    </tr>
                                    </thead>
                                    @if ($memberCertification->apl01 && $memberCertification->apl01->count() > 0)
                                        @php($noUk=1)
                                        @foreach($memberCertification->apl01 as $item)
                                            @if(is_object($memberCertification->paap) && $memberCertification->paap->metode_asesmen == 1)
                                                <tr>
                                                    <td>Unit Kompetensi: {{ $noUk }} {{ $item->puk->uk->name }}</td>
                                                    <td><i class="la la-check"></i></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td><i class="la la-check"></i></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                </tr>
                                            @elseif(is_object($memberCertification->paap) && $memberCertification->paap->metode_asesmen == 2)
                                                <tr>
                                                    <td>Unit Kompetensi: {{ $noUk }} {{ $item->puk->uk->name }}</td>
                                                    <td></td>
                                                    <td><i class="la la-check"></i></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td><i class="la la-check"></i></td>
                                                    <td></td>
                                                    <td></td>
                                                </tr>
                                            @else
                                                <tr>
                                                    <td>Unit Kompetensi: {{ $noUk }} {{ $item->puk->uk->name }}</td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                </tr>
                                            @endif
                                            @php($noUk++)
                                        @endforeach
                                    @endif
                                </table>
                                {!! Form::close() !!}
                            </div>
                            <div class="kt-portlet__foot">
                                <div class="kt-form__actions">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <a href="#" class="btn btn-success btn-lg pull-right btnSimpanRekaman">Simpan Data Rekaman Asesmen</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
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
                <div class="modal-body text-center">
                    <img src="" alt="" class="img-responsive" width="" height="">
                </div>
                <div class="modal-footer">
                    <a href="#" data-dismiss="modal" class="btn">Close</a>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade rotate" id="myModalPertanyaan">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Modal 2</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true" aria-label="Close"></button>
                </div>
                <div class="container"></div>
                <div class="modal-body">
                    <form action="" name="formPertanyaan" id="formPertanyaan">
                        <input type="hidden" name="member_certification_id" value="{{ $memberCertification->id }}">
                        <input type="hidden" name="member_id" value="{{ $memberCertification->members->id }}">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th width="5%"></th>
                            <th colspan="2">Unit</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if ($memberCertification->apl01 && $memberCertification->apl01->count() > 0)
                            @php($noUk=1)
                            @foreach($memberCertification->apl01 as $item)
                                <tr>
                                    <td colspan="3"><strong>{{ $noUk }}. UNIT KOMPETENSI</strong> : {{ $item->puk->uk->name }}</td>
                                </tr>
                                @if ($item->puk->uk->elements && $item->puk->uk->elements->count() > 0)
                                    @php($noElemen=1)
                                    @foreach($item->puk->uk->elements as $element)
                                        <tr>
                                            <th></th>
                                            <td colspan="2"><strong>{{ $noUk }}.{{ $noElemen }}. ELEMEN</strong> : {{ $element->name }}</td>
                                        </tr>

                                        @if ($element->kuk)
                                            @php($nokuk=1)
                                            @foreach($element->kuk as $kuk)
                                                <tr>
                                                    <td width="5%"></td>
                                                    <td align="right"><strong>KUK</strong></td>
                                                    <td style="text-indent:10px;">{{ $noElemen }} .{{ $nokuk }} {{ $kuk->name }}</td>
                                                </tr>

                                                {{-- Ambil pertanyaan berdasarkan TUK --}}
                                                @php($pertanyaan = $pertanyaan_lisan->where('kuk_id', $kuk->id))
                                                    @if($pertanyaan && $pertanyaan->count() > 0)
                                                    	@foreach($pertanyaan as $prt)
                                                            <tr>
                                                                <td></td>
                                                                <td align="right"><input type="radio" name="id_pertanyaan" data-tipe-pertanyaan="lisan" value="{{ $prt->id }}" id=""></td>
                                                                <td>{!! $prt->pertanyaan !!}</td>
                                                            </tr>
                                                        @endforeach
                                                    @endif
                                                @php($nokuk++)
                                            @endforeach
                                        @endif

                                        @php($noElemen++)
                                    @endforeach
                                @endif
                                @php($noUk++)
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                    </form>
                    <div>
                        <a href="#" data-dismiss="modal" class="btn btn-success btnPilihPertanyaan pull-right btn-lg"><i class="la la-check-circle"></i> Pilih Pertanyaan</a>
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="#" data-dismiss="modal" class="btn btn-default">Close</a>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $(document).ready(function () {

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
                    image.width('80%');
                    $(this).find('.modal-dialog').width(fwidth);
                });
                $('#myModal2').modal({show: true});
            });

            /**
             * Event untuk metode PAAP
             **/
            $(document).on('click','.paap_metode', function (e) {
                // e.preventDefault();
                var val = $(this).val();

                if (val == 1) {
                    /**
                     * Metode Langsung
                     */
                    @if(in_array('cbt', $direct))
                    $('span.for_cbt').html('<i class="la la-check"></i>');
                    @endif
                    @if(in_array('interview', $direct))
                    $('span.for_interview').html('<i class="la la-check"></i>');
                    @endif
                    $('span.for_portfolio').html('');
                    $('span.for_l').html('<i class="la la-check"></i>');
                    $('span.for_tl').html('');
                    $('span.for_t').html('');
                } else if (val == 2) {
                    @if($indirect)
                        @if(in_array('observasi', $indirect))
                            $('span.for_portfolio').html('<i class="la la-check"></i>');
                        @endif
                        @if(in_array('wawancara', $indirect))
                        $('span.for_interview').html('<i class="la la-check"></i>');
                    @endif
                    @endif
                    $('span.for_cbt').html('');
                    $('span.for_l').html('');
                    $('span.for_tl').html('<i class="la la-check"></i>');
                    $('span.for_t').html('');
                } else if (val == 3) {
                    $('span.for_cbt').html('');
                    $('span.for_portfolio').html('');
                    $('span.for_interview').html('');
                    $('span.for_l').html('');
                    $('span.for_tl').html('');
                    $('span.for_t').html('<i class="la la-check"></i>');
                }
            });

            /**
             *  Untuk proses checked saat edit
             */
            @if(is_object($paap) && $paap->metode_asesmen == 3)
            $('span.for_t').html('<i class="la la-check"></i>');
            @elseif(is_object($paap) && $paap->metode_asesmen == 2)
                $('span.for_tl').html('<i class="la la-check"></i>');
                @if(in_array('observasi', $indirect))
                    $('span.for_portfolio').html('<i class="la la-check"></i>');
                @endif
                @if(in_array('wawancara', $indirect))
                    $('span.for_interview').html('<i class="la la-check"></i>');
                @endif
            @elseif(is_object($paap) && $paap->metode_asesmen == 1)
                $('span.for_l').html('<i class="la la-check"></i>');
                @if(in_array('cbt', $direct))
                    $('span.for_cbt').html('<i class="la la-check"></i>');
                @endif
                @if(in_array('interview', $direct))
                    $('span.for_interview').html('<i class="la la-check"></i>');
                @endif
            @endif

            $(document).on('click','.newQuestion', function(e) {
                e.preventDefault();
                $('#myModalPertanyaan').modal({show: true});
            });

            $(document).on('click','.btnPilihPertanyaan', function () {
                var id_pertanyaan = $('input[name="id_pertanyaan"]:checked').val();
                var tipe_pertanyaan = $('input[name="id_pertanyaan"]:checked').data('tipe-pertanyaan');
                var member_certification_id = $('input[name="member_certification_id"]').val();
                var member_id = $('input[name="member_id"]').val();


                KTApp.blockPage({
                    overlayColor: '#000000',
                    type: 'v2',
                    state: 'primary',
                    message: 'Processing...'
                });

                if(id_pertanyaan.length > 0) {
                    $.post('{{ route('asesmen.getpertanyaandata') }}', {id_pertanyaan:id_pertanyaan,tipe_pertanyaan:tipe_pertanyaan,member_certification_id:member_certification_id,member_id:member_id}, function (data) {
                        // console.log(data);
                        if(data.status == true) {
                            $('.tablePertanyaan>tbody').append(data.data);
                        } else {
                            // console.log(data);
                            alert(data.message);
                        }
                        $('#myModalPertanyaan').modal('hide');
                        KTApp.unblockPage();
                    }, 'json').fail(function (error) {
                        // console.log(error.responseJSON.message);
                        alert(error.responseJSON.message);
                        KTApp.unblockPage();
                    });
                } else {
                    KTApp.unblockPage();
                    $('#myModalPertanyaan').modal('hide');
                }

                $('#myModalPertanyaan').modal('hide');
            });

            $(document).on('click', '.btnSimpanInterview', function (e) {
                e.preventDefault();
                swal.fire({
                    title: 'Simpan Interview/Wawancara ?',
                    text: 'Apakah Anda yakin untuk menyimpan data Interview/Wawancara ?',
                    type: 'info',
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
                    document.formInterview.submit();
                });
            });


            $( "#formInterview" ).validate({
                //display error alert on form submit
                invalidHandler: function(event, validator) {
                    // var alert = $('#kt_form_1_msg');
                    // alert.removeClass('kt--hide').show();

                    swal.fire({
                        "title": "Gagal simpan/update",
                        "text": "Ada kesalahan dalam pengisian form, mohon untuk diperiksa kembali",
                        "type": "error",
                        "confirmButtonClass": "btn btn-secondary",
                        "onClose": function(e) {
                            console.log('on close event fired!');
                        }
                    });

                    KTUtil.scrollTop();
                    event.preventDefault();
                },
                submitHandler: function (form) {
                    form[0].submit(); // submit the form
                }
            });

            /** Rekaman Asesmen */
            $('[data-switch=true]').bootstrapSwitch();


            $(document).on('click', '.btnSimpanRekaman', function (e) {
                e.preventDefault();
                swal.fire({
                    title: 'Simpan Interview/Wawancara ?',
                    text: 'Apakah Anda yakin untuk menyimpan data Rekaman Asesmen ?',
                    type: 'info',
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
                    document.formRekaman.submit();
                });
            });
            $("#is_kompeten").bootstrapSwitch('state', true);
        });
    </script>
@endpush

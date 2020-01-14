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
                        FORM PAAP
                    </h3>
                </div>
            </div>
            <div class="kt-portlet__body">
                @include('flash::message')

                {!! Form::open(['url'=>route('pre-assessment.savetemplatepaap',['jadwal_kelas'=>$jadwalKelas]),'onsubmit'=>'return false','class'=>'formPAAP','name'=>'formPAAP']) !!}
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

                            @if ($jadwalKelas->program->unit_kompetensi && $jadwalKelas->program->unit_kompetensi->count() > 0)
                                @php($noUk=1)
                                @foreach($jadwalKelas->program->unit_kompetensi as $uk)
                                    <tr class="bg-light">
                                        <td><strong>{{ $noUk }}. UNIT KOMPETENSI</strong></td>
                                        <td colspan="10">: <strong>{{ $uk->name }}</strong></td>
                                    </tr>
                                    @if ($uk->elements && $uk->elements->count() > 0)
                                        @php($noElemen=1)
                                        @foreach($uk->elements as $element)
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
                                                        <td style="padding-left: 30px;">{{ $noUk }}. {{ $noElemen }} .{{ $nokuk }} {{ $kuk->name }}</td>
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
                                    <button type="button" class="btn btn-success btn-loading savePAAP pull-right">Simpan PAAP</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {!! Form::close() !!}

            </div>
        </div>
@endsection

@push('modal-style')
    <style type="text/css" rel="stylesheet">
        .kt-checkbox, .kt-radio {
            margin-bottom: 0!important;
        }
    </style>
@endpush

@push('modal-script')
    <script type="text/javascript">
        $(document).ready(function () {

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
                    @if(in_array('observasi', $indirect))
                    $('span.for_portfolio').html('<i class="la la-check"></i>');
                    @endif
                    @if(in_array('wawancara', $indirect))
                    $('span.for_interview').html('<i class="la la-check"></i>');
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
             * Event menyimpan PAAP
             */

            $(document).on('click', '.savePAAP', function (e) {
                e.preventDefault();
                var form = $('.formPAAP');
                var _this = $(this);
                var url = form.attr('action');

                swal.fire({
                    title: 'Simpan Form PAAP',
                    text: 'Apakah Anda yakin untuk Menyimpan Form PAAP ini?',
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
                    // console.log(form.serializeArray());
                    KTApp.blockPage({
                        overlayColor: '#000000',
                        type: 'v2',
                        size: 'lg',
                        state: 'primary',
                        message: 'Processing...'
                    });
                    _this.text('Loading...').addClass('kt-spinner kt-spinner--v2 kt-spinner--sm kt-spinner--light');

                    /** Simpan PAAP */
                    document.formPAAP.submit();
                    // $.post(url, form.serializeArray(), function (data) {
                    //     console.log(data);
                    //     _this.text('Simpan PAAP').removeClass('kt-spinner kt-spinner--v2 kt-spinner--sm kt-spinner--light');
                    //     KTApp.unblockPage();
                    // },'json');
                });
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
        });
    </script>
@endpush

@extends('layouts.base')
@section('content')

<!-- begin:: Content -->
<div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">

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
                <div class="col-6">

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
                <div class="col-6">
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
                                    @if ($c->members->ktp_file)
                                    <a href="{{ $c->members->ktp_file }}">KTP</a>
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
                                    @if ($c->members->foto_file)
                                    <a href="{{ $c->members->foto_file }}">Foto</a>
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
                                    @if ($c->members->ijazah_file)
                                    <a href="{{ $c->members->ijazah_file }}">Ijazah</a>
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
                                    @if ($c->members->skb_file)
                                    <a href="{{ $c->members->skb_file }}">SKB</a>
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
                </div>
            </div>
            {!! Form::close() !!}
        </div>

    </div>

</div>

@push('script')
<script type="text/javascript">
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

        // $('#remove_image').on('click', function (e) {
        //
        // });
    })
</script>
@endpush
@endsection

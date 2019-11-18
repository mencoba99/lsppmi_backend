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
            <div class="row">
                <div class="col-6">
                    {!! Form::open(['url'=>'','id'=>'form-apl01','method'=> 'PUT']) !!}
                    {!! Form::hidden('token', $c->token) !!}
                        <div class="row">
                            <div class="col-xl-2"></div>
                            <div class="col-xl-8">
                                <div class="kt-section kt-section--first">
                                    <h3 class="kt-section__title">Informasi Akun</h3>
                                    <div class="kt-section__body">
                                        <div class="form-group row">
                                            <div class="col-6">
                                                <label>Nama</label>
                                                {!! Form::text('name',(!empty($c) ? $c->members->name:null),['class'=>'form-control','placeholder'=>'Nama']) !!}
                                            </div>
                                            <div class="col-6">
                                                <label>Email</label>
                                                {!! Form::text('email',(!empty($c) ? $c->members->email:null),['class'=>'form-control','placeholder'=>'Email']) !!}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-6">
                                                <label>NIK</label>
                                                {!! Form::text('name',(!empty($c) ? $c->members->identity_no:null),['class'=>'form-control','placeholder'=>'Nama']) !!}
                                            </div>
                                            <div class="col-6">
                                                <label>Kewarganegaraan</label>
                                                {!! Form::text('email',(!empty($c) ? $c->members->nationality:null),['class'=>'form-control','placeholder'=>'Email']) !!}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-6">
                                                <label>Tempat Lahir</label>
                                                {!! Form::text('name',(!empty($c) ? $c->members->place_of_birth:null),['class'=>'form-control','placeholder'=>'Nama']) !!}
                                            </div>
                                            <div class="col-6">
                                                <label>Tanggal Lahir</label>
                                                {!! Form::text('email',(!empty($c) ? $c->members->date_of_birth:null),['class'=>'form-control','placeholder'=>'Email']) !!}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-6">
                                                <label>Jenis Kelamin</label>
                                                {!! Form::text('name',(!empty($c) ? $c->members->gender:null),['class'=>'form-control','placeholder'=>'Nama']) !!}
                                            </div>
                                            <div class="col-6">
                                                <label>Pendidikan</label>
                                                {!! Form::text('email',(!empty($c) ? $c->members->education:null),['class'=>'form-control','placeholder'=>'Email']) !!}
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Alamat Rumah</label>
                                            {!! Form::textarea('address', @$c->members->address, ['class' => 'form-control', 'rows' => 3]) !!}
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-6">
                                                <label>Kode Pos</label>
                                                {!! Form::text('name',(!empty($c) ? $c->members->postal_code:null),['class'=>'form-control','placeholder'=>'Nama']) !!}
                                            </div>
                                            <div class="col-6">
                                                <label>Telepon Rumah</label>
                                                {!! Form::text('email',(!empty($c) ? $c->members->home_phone:null),['class'=>'form-control','placeholder'=>'Email']) !!}
                                            </div>
                                        </div>
                                    </div>
                                    <h3 class="kt-section__title">Informasi Pekerjaan</h3>
                                    <div class="kt-section__body">
                                        <div class="form-group row">
                                            <div class="col-6">
                                                <label>Perusahaan/Lembaga</label>
                                                {!! Form::text('name',(!empty($c) ? $c->members->company_name:null),['class'=>'form-control','placeholder'=>'Nama']) !!}
                                            </div>
                                            <div class="col-6">
                                                <label>Jabatan</label>
                                                {!! Form::text('email',(!empty($c) ? $c->members->company_position:null),['class'=>'form-control','placeholder'=>'Email']) !!}
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Alamat</label>
                                            {!! Form::textarea('address', @$c->members->company_address, ['class' => 'form-control', 'rows' => 3]) !!}
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-6">
                                                <label>Kode Pos</label>
                                                {!! Form::text('name',(!empty($c) ? $c->members->company_postal_code:null),['class'=>'form-control','placeholder'=>'Nama']) !!}
                                            </div>
                                            <div class="col-6">
                                                <label>Email Kantor</label>
                                                {!! Form::text('email',(!empty($c) ? $c->members->company_email:null),['class'=>'form-control','placeholder'=>'Email']) !!}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-6">
                                                <label>Telepon Kantor</label>
                                                {!! Form::text('name',(!empty($c) ? $c->members->company_phone:null),['class'=>'form-control','placeholder'=>'Nama']) !!}
                                            </div>
                                            <div class="col-6">
                                                <label>Fax</label>
                                                {!! Form::text('email',(!empty($c) ? $c->members->company_fax:null),['class'=>'form-control','placeholder'=>'Email']) !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="kt-portlet__foot">
                            @if ($c->status == 1)
                            <button type="submit" class="btn btn-success btn-loading" id="approveAPL01">Verifikasi</button>
                            <a href="{{ route('peserta.pendaftaran.sertifikasi') }}" id="rejectAPL01" class="btn btn-secondary">Tolak</a>
                            @elseif ($c->status == 2)
                            <button type="submit" class="btn btn-success btn-loading" id="sendAPL01Payment">Kirim Tagihan Pembayaran</button>
                            <!-- <a href="{{ route('peserta.pendaftaran.sertifikasi') }}" id="rejectAPL01" class="btn btn-secondary">Tolak</a> -->
                            @else
                            <button type="submit" class="btn btn-success btn-loading" id="approveAPL01">Verifikasi</button>
                            <a href="{{ route('peserta.pendaftaran.sertifikasi') }}" class="btn btn-secondary">Tolak</a>
                            @endif
                            
                        </div>
                    {!! Form::close() !!}        
                </div>
                <div class="col-6">
                    <h5 class="black">Unit Kompetensi Dipilih</h5>
                    <ol>
                    @foreach($c->apl01 as $key => $val)
                        <li>{{ $val->puk->uk->name }}</li>
                    @endforeach
                    </ol>

                    @if ($c->payment_file)
                    <h5>Bukti Pembayaran</h5>
                    <a href="{{ env('GOOGLE_CLOUD_STORAGE_API_URI') . '/' . $c->payment_file }}" target="_blank">Lihat</a>
                    @endif
                </div>
            </div>
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
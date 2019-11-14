@extends('layouts.base')
@section('content')


    <!-- begin:: Content -->
    <div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">


        <div class="kt-portlet kt-portlet--mobile">
            <div class="kt-portlet__head kt-portlet__head--lg">
                <div class="kt-portlet__head-label">
                    <span class="kt-portlet__head-icon">
                        <i class="kt-font-brand flaticon2-line-chart"></i>
                    </span>
                    <h3 class="kt-portlet__head-title">
                        Manajemen Assessmen - Pre Assessmen - Data Peserta
                    </h3>
                </div>
                <div class="kt-portlet__head-toolbar">
                    <div class="kt-portlet__head-wrapper">
                        <a href="{{ route('pre-assessment.index') }}" class="btn btn-clean btn-icon-sm">
                            <i class="la la-long-arrow-left"></i>
                            Back
                        </a>
                    </div>
                </div>
            </div>
            @include('flash::message')
            <div class="kt-portlet__body">
                <table class="table table-striped- table-bordered table-hover table-checkable" id="">
                    <thead>
                    <tr>
                        <th colspan="6">Detail Kelas</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td width="15%">Program</td>
                        <td width="10">:</td>
                        <td width="24%">{{ $jadwalKelas->program->name }}</td>
                        <td width="15%">Tanggal Pelaksanaan</td>
                        <td width="10">:</td>
                        <td width="">{{ date('l,d F Y', strtotime($jadwalKelas->started_at)) }}</td>
                    </tr>
                    <tr>
                        <td>Tempat Uji Kompetensi</td>
                        <td>:</td>
                        <td>{{ $jadwalKelas->tuk->name }} : {{ $jadwalKelas->tuk->address }}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- end:: Content -->
@endsection

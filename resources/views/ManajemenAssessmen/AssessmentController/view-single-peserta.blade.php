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

    </div>

    <!-- end:: Content -->
@endsection

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
                        Data Assessor : {{ $assessor->name }}
                    </h3>
                </div>
            </div>
            <div class="kt-portlet__body">
                @include('flash::message')
                <table class="table table-bordered">
                    <tr>
                        <td width="25%">
                            <img src="{!! Storage::url('upload/backend/assessor/'.$assessor->id.'/'.$assessor->foto) !!}" alt="{{ $assessor->name }}" width="400" class="img-responsive kt-userpic kt-margin-r-5 kt-margin-t-5">
                        </td>
                        <td>
                            <table class="table table-bordered">
                                <tr>
                                    <td width="15%">Email</td>
                                    <td width="5">:</td>
                                    <td>{{ $assessor->email }}</td>
                                </tr>
                                <tr>
                                    <td>Mobile Phone</td>
                                    <td>:</td>
                                    <td>{{ $assessor->mobile_phone }}</td>
                                </tr>
                                <tr>
                                    <td>Instansi</td>
                                    <td>:</td>
                                    <td>{{ $assessor->company }}</td>
                                </tr>
                                <tr>
                                    <td>Posisi/Jabatan</td>
                                    <td>:</td>
                                    <td>{{ $assessor->position }}</td>
                                </tr>
                                <tr>
                                    <td>Status</td>
                                    <td>:</td>
                                    <td>{{ ($assessor->status) ? 'Aktif':'Tidak Aktif' }}</td>
                                </tr>
                                <tr>
                                    <td>Profil</td>
                                    <td>:</td>
                                    <td>{{ $assessor->profile }}</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

    <!-- end:: Content -->

@endsection

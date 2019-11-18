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
                        Data TUK : {{ $tuk->name }}
                    </h3>
                </div>
            </div>
            <div class="kt-portlet__body">
                @include('flash::message')
                <table class="table table-bordered">
                    <tr>
                        <td>
                            <table class="table table-bordered">
                                <tr>
                                    <td width="15%">Nama TUK</td>
                                    <td width="5">:</td>
                                    <td>{{ $tuk->name }}</td>
                                </tr>
                                <tr>
                                    <td>Alamat</td>
                                    <td>:</td>
                                    <td>{{ $tuk->address }}</td>
                                </tr>
                                <tr>
                                    <td>Provinsi</td>
                                    <td>:</td>
                                    <td>{{ $tuk->regency->provinsi->name }}</td>
                                </tr>
                                <tr>
                                    <td>Kabupaten/Kota</td>
                                    <td>:</td>
                                    <td>{{ $tuk->regency->name }}</td>
                                </tr>
                                <tr>
                                    <td>Status</td>
                                    <td>:</td>
                                    <td>{{ ($tuk->status == 1) ? 'Aktif':'Tidak Aktif' }}</td>
                                </tr>
                                <tr>
                                    <td>Lat/Long (Map Position)</td>
                                    <td>:</td>
                                    <td>{{ $tuk->latitude }} / {{ $tuk->longitude }}</td>
                                </tr>
                                <tr>
                                    <td>Kontak</td>
                                    <td>:</td>
                                    <td>{!! $tuk->contact !!}</td>
                                </tr>
                                <tr>
                                    <td>Profil Singkat</td>
                                    <td>:</td>
                                    <td>{!! $tuk->description !!}</td>
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

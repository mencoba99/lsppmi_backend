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
                        Pertanyaan Tertulis : {{ strip_tags($tertulis->pertanyaan) }}
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
                                    <td>{{ $tertulis->tuk->name }}</td>
                                </tr>
                                <tr>
                                    <td>Unit</td>
                                    <td>:</td>
                                    <td>{{ $tertulis->unit->name }}</td>
                                </tr>
                                <tr>
                                    <td>Element</td>
                                    <td>:</td>
                                    <td>{{ $tertulis->element->name }}</td>
                                </tr>
                                <tr>
                                    <td>KUK</td>
                                    <td>:</td>
                                    <td>{{ $tertulis->kuk->name }}</td>
                                </tr>
                                <tr>
                                    <td>Status</td>
                                    <td>:</td>
                                    <td>{{ ($tertulis->status == 1) ? 'Aktif':'Tidak Aktif' }}</td>
                                </tr>
                                <tr>
                                    <td>Pertanyaan</td>
                                    <td>:</td>
                                    <td>{!! $tertulis->pertanyaan !!}</td>
                                </tr>
                                <tr>
                                    <td>Jawaban</td>
                                    <td>:</td>
                                    <td>{!! $tertulis->jawaban !!}</td>
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
@push('modal-script')
    <script type="text/javascript">

        $(document).ready(function () {
            $('#loader', parent.document).fadeOut();
        });
    </script>
@endpush

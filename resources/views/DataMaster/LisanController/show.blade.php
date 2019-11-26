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
                        Pertanyaan Lisan : {{ strip_tags($lisan->pertanyaan) }}
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
                                    <td>{{ $lisan->tuk->name }}</td>
                                </tr>
                                <tr>
                                    <td>Unit</td>
                                    <td>:</td>
                                    <td>{{ $lisan->unit->name }}</td>
                                </tr>
                                 <tr>
                                    <td>Element</td>
                                    <td>:</td>
                                    <td>{{ $lisan->element->name }}</td>
                                </tr>
                                 <tr>
                                    <td>KUK</td>
                                    <td>:</td>
                                    <td>{{ $lisan->kuk->name }}</td>
                                </tr>
                                <tr>
                                    <td>Status</td>
                                    <td>:</td>
                                    <td>{{ ($lisan->status == 1) ? 'Aktif':'Tidak Aktif' }}</td>
                                </tr>
                                <tr>
                                    <td>Pertanyaan</td>
                                    <td>:</td>
                                    <td>{!! $lisan->pertanyaan !!}</td>
                                </tr>
                                <tr>
                                    <td>Jawaban</td>
                                    <td>:</td>
                                    <td>{!! $lisan->jawaban !!}</td>
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

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
                {!! Form::open(['url'=>route('pendaftaran.pemilihanasesor.saveasesor',['member_certification'=>$memberCertification]),'id'=>'formPemilihanAsesor']) !!}
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th colspan="2">PILIH ASESOR</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td colspan="2">Silahkan pilih asesor untuk peserta ini</td>
                    </tr>
                    @if (is_object($memberCertification->schedules->assessor) && $memberCertification->schedules->assessor->count() > 0)
                        @foreach($memberCertification->schedules->assessor as $asesor)
                            <tr>
                                <td width="10">
                                    <label class="kt-radio kt-radio--success">
{{--                                        <input type="radio" name="assessor_id" required="required" value="{{ $asesor->id }}">--}}
                                        {!! Form::checkbox('assessor_id',$asesor->id,($asesor->id == $memberCertification->assessor_id)) !!}
                                        <span></span>
                                    </label>
                                </td>
                                <td>{{ $asesor->name }}</td>
                            </tr>
                        @endforeach
                    @endif
                    </tbody>
                    <tfoot>
                    <tr>
                        <td colspan="2" class="text-center">
                            <button type="submit" class="btn btn-success btn-loading savePAAP">Simpan Pilihan Asesor</button>
                        </td>
                    </tr>
                    </tfoot>
                </table>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection

@push('modal-script')
    <script type="text/javascript">
        // window.onload = function () {
        //     $("#loader",parent.document).hide();
        // }

        $(document).ready(function() {
            $( "#formPemilihanAsesor" ).validate({
                // define validation rules
                rules: {
                    assessor_id: {
                        required: true
                    }
                },

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

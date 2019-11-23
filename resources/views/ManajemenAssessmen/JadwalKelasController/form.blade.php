
<div class="kt-portlet__body">
    {!! Form::open(['url'=>$action,'id'=>'form-kelas','method'=>(!empty($jadwalKelas) ? 'PUT':'POST'),'files'=>true]) !!}
    <div class="row">
        <div class="col-xl-2"></div>
        <div class="col-xl-8">
            <div class="kt-section kt-section--first">
                <div class="kt-section__body">
                    <div class="form-group row">
                        <label class="col-3 col-form-label">Program</label>
                        <div class="col-9">
                            {!! Form::select('program_id', $programs, (!empty($jadwalKelas) ? $jadwalKelas->program_id:null), ['class'=>'kt-select2','data-placeholder'=>'Pilih Program']) !!}
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-3 col-form-label">Tempat Uji Kompetensi</label>
                        <div class="col-9">
                            {!! Form::select('competence_place_id', $tuk, (!empty($jadwalKelas) ? $jadwalKelas->competence_place_id:null), ['class'=>'kt-select2','data-placeholder'=>'Pilih Tempat Uji Kompetensi']) !!}
                        </div>
                    </div>
                    <div class="kt-section__body">
                        <div class="form-group row">
                            <label class="col-3 col-form-label">Harga</label>
                            <div class="col-3">
                                {!! Form::text('price',(!empty($jadwalKelas) ? $jadwalKelas->price:null),['class'=>'form-control','placeholder'=>'Harga Kelas']) !!}
                                <small class="form-text text-muted">Masukkan harga tanpa titik pemisah ribuan. Contoh : 1000000</small>
                            </div>
                        </div>
                    </div>
                    <div class="kt-section__body">
                        <div class="form-group row">
                            <label class="col-3 col-form-label">Minimal Peserta</label>
                            <div class="col-3">
                                {!! Form::text('min_participants',(!empty($jadwalKelas) ? $jadwalKelas->min_participants:null),['class'=>'form-control','placeholder'=>'Minimal Peserta']) !!}
                                <small class="form-text text-muted">Masukkan informasi minimal peserta untuk sebuah kelas bisa dijalankan</small>
                            </div>
                        </div>
                    </div>
                    <div class="kt-section__body">
                        <div class="form-group row">
                            <label class="col-3 col-form-label">Maksimal Peserta</label>
                            <div class="col-3">
                                {!! Form::text('max_participants',(!empty($jadwalKelas) ? $jadwalKelas->max_participants:null),['class'=>'form-control','placeholder'=>'Maksimal Peserta']) !!}
                                <small class="form-text text-muted">Masukkan informasi maksimal peserta untuk sebuah kelas bisa dijalankan</small>
                            </div>
                        </div>
                    </div>
                    <div class="kt-section__body">
                        <div class="form-group row">
                            <label class="col-3 col-form-label">Durasi Assessmen (hari)</label>
                            <div class="col-3">
                                {!! Form::text('exam_duration',(!empty($jadwalKelas) ? $jadwalKelas->exam_duration:null),['class'=>'form-control','placeholder'=>'Durasi Assessmen']) !!}
                                <small class="form-text text-muted">Masukkan informasi durasi assessmen dalam hitungan hari</small>
                            </div>
                        </div>
                    </div>
                    <div class="kt-section__body">
                        <div class="form-group row">
                            <label class="col-3 col-form-label">Tanggal Ujian</label>
                            <div class="col-3">
                                {!! Form::text('started_at',(!empty($jadwalKelas) ? $jadwalKelas->started_at:null),['class'=>'form-control','id'=>'kt_datepicker_1','placeholder'=>'Tanggal Ujian']) !!}
                                <small class="form-text text-muted">Masukkan informasi durasi assessmen dalam hitungan hari</small>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-3 col-form-label"><em>Status ?</em></label>
                        <div class="col-9">
                            <span class="kt-switch kt-switch--icon">
                                <label>
                                    {!! Form::checkbox('status',1,((!empty($jadwalKelas) && $jadwalKelas->status == 1) ? 'checked':null),['class'=>'form-control']) !!}
                                    <span></span>
                                </label>
                            </span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-3 col-form-label"><em>Is Hidden ?</em></label>
                        <div class="col-9">
                            <span class="kt-switch kt-switch--icon">
                                <label>
                                    {!! Form::checkbox('is_hidden',1,((!empty($jadwalKelas) && $jadwalKelas->is_hidden == 1) ? 'checked':null),['class'=>'form-control']) !!}
                                    <span></span>
                                </label>
                            </span>
                        </div>
                    </div>
                    <div class="kt-section__body">
                        <div class="form-group row">
                            <label class="col-3 col-form-label">Keterangan</label>
                            <div class="col-9">
                                {!! Form::textarea('remark',(!empty($jadwalKelas) ? $jadwalKelas->remark:null),['class'=>'summernote']) !!}
                            </div>
                        </div>
                    </div>
                    <div class="kt-separator kt-separator--border-dashed kt-separator--space-lg"></div>
                    <h3 class="kt-section__title">Pemilihan Assessor</h3>
                    <div class="kt-section__body">
                        <div id="kt_repeater_1">
                            <div class="form-group row" id="kt_repeater_1">
                                <label class="col-3 col-form-label">Pilih Assessor:</label>
                                <div data-repeater-list="assessor_id" class="col-lg-9">
                                    @if (!empty($jadwalKelas) && !empty($jadwalKelas->assessor) && $jadwalKelas->assessor->count() > 0)
                                        @foreach($jadwalKelas->assessor as $item)
                                            <div data-repeater-item class="form-group row align-items-center">
                                                <div class="col-sm-8">
                                                    <div class="kt-form__group--inline">
                                                        <div class="kt-form__control">
                                                            {!! Form::select('',$assessor, $item->id,['class'=>'form-control','placeholder'=>'Pilih Assessor']) !!}
                                                        </div>
                                                    </div>
                                                    <div class="d-md-none kt-margin-b-10"></div>
                                                </div>
                                                <div class="col-md-4">
                                                    <a href="javascript:;" data-repeater-delete="" class="btn-sm btn btn-label-danger btn-bold">
                                                        <i class="la la-trash-o"></i>
                                                        Delete
                                                    </a>
                                                </div>
                                            </div>
                                        @endforeach
                                    @else
                                        <div data-repeater-item class="form-group row align-items-center">
                                            <div class="col-sm-8">
                                                <div class="kt-form__group--inline">
                                                    <div class="kt-form__control">
                                                        {!! Form::select('',$assessor, null,['class'=>'form-control','placeholder'=>'Pilih Assessor']) !!}
                                                    </div>
                                                </div>
                                                <div class="d-md-none kt-margin-b-10"></div>
                                            </div>
                                            <div class="col-md-4">
                                                <a href="javascript:;" data-repeater-delete="" class="btn-sm btn btn-label-danger btn-bold">
                                                    <i class="la la-trash-o"></i>
                                                    Delete
                                                </a>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label"></label>
                                <div class="col-lg-4">
                                    <a href="javascript:;" data-repeater-create="" class="btn btn-bold btn-sm btn-label-brand">
                                        <i class="la la-plus"></i> Tambah Assessor
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="kt-portlet__foot">
        <div class="kt-form__actions">
            <div class="row">
                <div class="col-3"></div>
                <div class="col-sm-6">
                    <button type="submit" class="btn btn-success btn-loading">{{ $button }}</button>
                    <a href="{{ route('jadwal-kelas.index') }}" class="btn btn-secondary">Batal</a>
                </div>
            </div>
        </div>
    </div>
    {!! Form::close() !!}
</div>

@push('script')
    <script type="text/javascript">
        $(document).ready(function() {
            $( "#form-kelas" ).validate({
                // define validation rules
                ignore: [],
                rules: {
                    program_id: {
                        required: true
                    },
                    competence_place_id: {
                        required: true
                    },
                    price: {
                        required: true
                    },
                    min_participants: {
                        required: true
                    },
                    max_participants: {
                        required: true
                    },
                    started_at: {
                        required: true
                    },
                    'assessor_id[]': {
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

            /** untuk select provinsi */
            $('.kt-select2').select2({
                // placeholder: "Pilih Program",
                allowClear: true,
                width: '100%'
            });

            // datepicker minimum setup
            $('#kt_datepicker_1').datepicker({
                rtl: KTUtil.isRTL(),
                todayBtn: "linked",
                clearBtn: true,
                format: "yyyy-mm-dd",
                todayHighlight: true,
                orientation: "bottom left",
                templates: 'arrows'
            });

            $('#kt_repeater_1').repeater({
                initEmpty: false,

                defaultValues: {
                    'assessor_id': ''
                },

                show: function () {
                    $(this).slideDown();
                },

                hide: function (deleteElement) {
                    $(this).slideUp(deleteElement);
                },
                isFirstItemUndeletable: true
            });
        })
    </script>
@endpush


<div class="kt-portlet__body">
    {!! Form::open(['url'=>$action,'id'=>'form-program-kompetensi','method'=>(!empty($programKompetensi) ? 'PUT':'POST')]) !!}
    <div class="row">
        <div class="col-xl-2"></div>
        <div class="col-xl-8">
            <div class="kt-section kt-section--first">
                <div class="kt-section__body">
                    <div class="form-group row">
                        <label class="col-3 col-form-label">Program</label>
                        <div class="col-9">
                            {!! Form::select('program_id', $programs, (is_object($programKompetensi) ? $programKompetensi->program_id:null),['class'=>'kt-select2 select_program','data-placeholder'=>'Pilih Program']) !!}
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-3 col-form-label">Program</label>
                        <div class="col-9">
                            {!! Form::select('competence_unit_id', $unitKompetensi, (is_object($programKompetensi) ? $programKompetensi->competence_unit_id:null),['class'=>'kt-select2 select_kompetensi','data-placeholder'=>'Pilih Unit Kompetensi']) !!}
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-3 col-form-label">Jenis Kompetensi</label>
                        <div class="col-9">
                            {!! Form::select('is_required',['1'=>'Utama','0'=>'Pilihan'], (is_object($programKompetensi) ? $programKompetensi->is_required:null), ['class'=>'form-control','placeholder'=>'Pilih Jenis Kompetensi']) !!}
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
                    <button type="submit" class="btn btn-success">{{ $button }}</button>
                    <a href="{{ route('pengaturan-kompetensi.index') }}" class="btn btn-secondary">Batal</a>
                </div>
            </div>
        </div>
    </div>
    {!! Form::close() !!}
</div>

@push('script')
    <script type="text/javascript">
        $(document).ready(function() {
            $( "#form-program-kompetensi" ).validate({
                // define validation rules
                rules: {
                    program_id: {
                        required: true
                    },
                    competence_unit_id: {
                        required: true
                    },
                    is_required: {
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
                    form[0].submit(); // submit the form
                }
            });

            /** untuk select2 */
            $('.select_program').select2({
                placeholder: "Pilih Program",
                allowClear: true,
                {{(is_object($programKompetensi) ? 'disabled: true':null)}}
            });
            $('.select_kompetensi').select2({
                placeholder: "Pilih Unit Kompetensi",
                allowClear: true,
                width: '100%',
                {{(is_object($programKompetensi) ? 'disabled: true':null)}}
            });

            /** Untuk event saat pilih provinsi maka kabupaten/kota akan berubah sesuai pilihan provinsi */
            $('.select_program').on('change', function (e) {
                var _this = $(this);
                $.post('{{ route('pengaturan-kompetensi.getunitkompetensi') }}',{program_id:_this.val()}, function (data) {
                    console.log(data);
                    $(".select_kompetensi").html("");
                    $(".select_kompetensi").select2("destroy");
                    $('.select_kompetensi').select2({
                        placeholder: "Pilih Unit Kompetensi",
                        data: data,
                        allowClear: true,
                        width: '100%',
                        {{(is_object($programKompetensi) ? 'disabled: true':null)}}
                    }).val(null).trigger('change.select2');
                },'json');
            });
        })
    </script>
@endpush

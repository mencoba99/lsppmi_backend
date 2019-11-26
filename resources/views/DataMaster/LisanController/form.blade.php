
<div class="kt-portlet__body">
        {!! Form::open(['url'=>$action,'id'=>'form-role','method'=>'POST','files'=>true]) !!}
        <div class="row">
            <div class="col-xl-2"></div>
            <div class="col-xl-8">
                <div class="kt-section kt-section--first">
                    <div class="kt-section__body">
                        <div class="form-group row">
                            <label class="col-3 col-form-label">TUK</label>
                            <div class="col-9">
                                {!! Form::select('tuk_id', $tuk,(!empty($lisan) ? $lisan->tuk->id:null),['class'=>'form-control kt-select2-tuk']) !!}
                            </div>
                        </div>
                    </div>
                    <div class="kt-section__body">
                        <div class="form-group row">
                            <label class="col-3 col-form-label">Unit</label>
                            <div class="col-9">
                               
                                {!! Form::select('unit_id', $units, (!empty($lisan) ? $lisan->unit->id:null),['class'=>'form-control kt-select2-unit']) !!}
                            </div>
                        </div>
                    </div>
                    <div class="kt-section__body">
                        <div class="form-group row">
                            <label class="col-3 col-form-label">Element</label>
                            <div class="col-9">
                                {!! Form::select('element_id', $element ,(!empty($lisan) ? $lisan->element->id:null),['class'=>'form-control kt-select2-element']) !!}
                            </div>
                        </div>
                    </div>
                    <div class="kt-section__body">
                        <div class="form-group row">
                            <label class="col-3 col-form-label">KUK</label>
                            <div class="col-9">
                                {!! Form::select('kuk_id', (!empty($lisan) ? [$lisan->kuk->id=>$lisan->kuk->name] : [''=>'']),(!empty($lisan) ? $lisan->kuk->id:null),['class'=>'form-control kt-select2-kuk']) !!}
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-3 col-form-label">Status (Aktif/Tidak Aktif)</label>
                        <div class="col-9">
                                <span class="kt-switch kt-switch--icon">
                                    <label>
                                        {!! Form::checkbox('status',1,((!empty($lisan) && $lisan->status == 1) ? 'checked':null),['class'=>'form-control']) !!}
                                        <span></span>
                                    </label>
                                </span>
                        </div>
                    </div>
                    <div class="kt-section__body">
                        <div class="form-group row">
                            <label class="col-3 col-form-label">Pertanyaan</label>
                            <div class="col-9">
                                {!! Form::textarea('pertanyaan',(!empty($lisan) ? $lisan->pertanyaan:null),['class'=>'summernote']) !!}
                            </div>
                        </div>
                    </div>
                    <div class="kt-section__body">
                        <div class="form-group row">
                            <label class="col-3 col-form-label">Jawaban yang diharapkan</label>
                            <div class="col-9">
                                {!! Form::textarea('jawaban',(!empty($lisan) ? $lisan->jawaban:null),['class'=>'summernote']) !!}
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
                        <a href="{{ route('lisan.index') }}" class="btn btn-secondary">Batal</a>
                    </div>
                </div>
            </div>
        </div>
        {!! Form::close() !!}
    </div>
    
    @push('script')
        <script type="text/javascript">
            $(document).ready(function() {
                $( "#form-role" ).validate({
                    // define validation rules
                    rules: {
                        unit_id: {
                            required: true
                        },
                        tuk_id: {
                            required: true
                        },
                        element_id: {
                            required: true
                        },
                        kuk_id: {
                            required: true
                        },
                        pertanyaan: {
                            required: true
                        },
                        jawaban: {
                            required: true
                        }
                    },
    
                    //display error alert on form submit
                    invalidHandler: function(event, validator) {
                        // var alert = $('#kt_form_1_msg');
                        // alert.removeClass('kt--hide').show();
    
                        KTUtil.scrollTop();
                        swal.fire({
                            "title": "Gagal simpan/update",
                            "text": "Ada kesalahan dalam pengisian form, mohon untuk diperiksa kembali",
                            "type": "error",
                            "confirmButtonClass": "btn btn-secondary",
                            "onClose": function(e) {
                                console.log('on close event fired!');
                            }
                        });
                        // event.preventDefault();
                    },
                    submitHandler: function (form) {
                        $('.btn-loading').addClass('kt-spinner kt-spinner--sm kt-spinner--light');
                        form[0].submit(); // submit the form
                    }
                });
               
                if('{{$lisan}}' === ''){
                    $('select').val(null).trigger("change");
                }
    
                /** untuk select tuk */
                $('.kt-select2-tuk').select2({
                    placeholder: "Pilih TUK",
                    allowClear: true
                });
                /** untuk select unit */
                $('.kt-select2-unit').select2({
                    placeholder: "Pilih Units",
                    allowClear: true
                });
                /** untuk select kuk */
                $('.kt-select2-kuk').select2({
                    placeholder: "Pilih element terlebih dahulu",
                    allowClear: true
                });
                /** untuk select element */
                $('.kt-select2-element').select2({
                    placeholder: "Pilih Unit Terlebih dahulu",
                    allowClear: true
                });
                 /** Untuk event saat pilih unit maka element akan berubah sesuai unit yang dipilih */
                 $('.kt-select2-unit').on('change', function (e) {
                    var _this = $(this);
                    $(".kt-select2-kuk").select2({
                            placeholder: "Loading...",
                    }).empty();
    
                    $(".kt-select2-element").select2({
                            placeholder: "Loading...",
                    }).empty();
    
                    $.post('{{ route('lisan.getElement') }}',{competence_unit_id:_this.val()}, function (data) {
                        console.log(data);
                        $('.kt-select2-element').select2({
                            placeholder: "Pilih Element",
                            data: data,
                            allowClear: true,
                        });
                        $('.kt-select2-element').val(null).trigger("change");
                    },'json');
                });
                 /** Untuk event saat pilih element maka kuk akan berubah sesuai unit yang dipilih */
                 $('.kt-select2-element').on('change', function (e) {
                    var _this = $(this);
                    if(this.value!=""){
                        $.post('{{ route('lisan.getKUK') }}',{competence_element_id:_this.val()}, function (data) {
                            $(".kt-select2-kuk").select2().empty();
                            $('.kt-select2-kuk').select2({
                                placeholder: "Pilih KUK",
                                data: data,
                                allowClear: true,
                            });
                        $('.kt-select2-kuk').val(null).trigger("change");
                       
                       
                    },'json');
    
                    }
                    
                });
               
            })
        </script>
    @endpush
    
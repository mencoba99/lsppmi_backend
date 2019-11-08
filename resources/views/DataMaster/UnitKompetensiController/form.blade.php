
<div class="kt-portlet__body">
    {!! Form::open(['url'=>$action,'id'=>'form-role','method'=>(!empty($unitKompetensi) ? 'PUT':'POST'),'files'=>true]) !!}
    <div class="row">
        <div class="col-xl-2"></div>
        <div class="col-xl-8">
            <div class="kt-section kt-section--first">
                <div class="kt-section__body">
                    <div class="form-group row">
                        <label class="col-3 col-form-label">Kode Unit</label>
                        <div class="col-9">
                            {!! Form::text('code',(!empty($unitKompetensi) ? $unitKompetensi->code:null),['class'=>'form-control','placeholder'=>'Kode Unit']) !!}
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-3 col-form-label">Nama Unit</label>
                        <div class="col-9">
                            {!! Form::text('name',(!empty($unitKompetensi) ? $unitKompetensi->name:null),['class'=>'form-control','placeholder'=>'Nama Unit']) !!}
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-3 col-form-label">Status</label>
                        <div class="col-9">
                            <span class="kt-switch kt-switch--icon">
                                <label>
                                    {!! Form::checkbox('status',1,((!empty($unitKompetensi) && $unitKompetensi->is_hidden == 1) ? 'checked':null),['class'=>'form-control']) !!}
                                    <span></span>
                                </label>
                            </span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-3 col-form-label">Tipe</label>
                        <div class="col-9">
                            <div class="kt-radio-inline">
                                <label class="kt-radio">
                                    {!! Form::radio('type',1,null,['']) !!} SKKNI
                                    <span></span>
                                </label>
                                <label class="kt-radio">
                                    {!! Form::radio('type',2,null,['']) !!} SI
                                    <span></span>
                                </label>
                                <label class="kt-radio">
                                    {!! Form::radio('type',3,null,['']) !!} SK
                                    <span></span>
                                </label>
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
                    <a href="{{ route('assessor.index') }}" class="btn btn-secondary">Batal</a>
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
                    code: {
                        required: true
                    },
                    name: {
                        required: true
                    },
                    type: {
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

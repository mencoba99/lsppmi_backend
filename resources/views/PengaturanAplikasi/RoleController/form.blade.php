
    <div class="kt-portlet__body">
        {!! Form::open(['url'=>$action,'id'=>'form-role','method'=>(!empty($role) ? 'PUT':'POST')]) !!}
        <div class="row">
            <div class="col-xl-2"></div>
            <div class="col-xl-8">
                <div class="kt-section kt-section--first">
                    <div class="kt-section__body">
                        <div class="form-group row">
                            <label class="col-3 col-form-label">Nama Role</label>
                            <div class="col-9">
                                {!! Form::text('name',(!empty($role) ? $role->name:null),['class'=>'form-control','placeholder'=>'Nama Role']) !!}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-3 col-form-label">Guard</label>
                            <div class="col-9">
                                {!! Form::select('guard_name',['web'=>'WEB'], null, ['class'=>'form-control']) !!}
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
                        <a href="{{ route('role.index') }}" class="btn btn-secondary">Batal</a>
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
                        name: {
                            required: true
                        },
                        guard_name: {
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
            })
        </script>
    @endpush

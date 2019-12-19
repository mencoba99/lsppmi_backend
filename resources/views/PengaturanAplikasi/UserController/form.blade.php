<div class="kt-portlet__body">
    {!! Form::open(['url'=>$action,'id'=>'form-user','method'=>(is_object($user) ? 'PUT':'POST')]) !!}
    <div class="row">
        <div class="col-xl-2"></div>
        <div class="col-xl-8">
            <div class="kt-section kt-section--first">
                <div class="kt-section__body">
                    <div class="form-group row">
                        <label class="col-3 col-form-label">Nama</label>
                        <div class="col-9">
                            {!! Form::text('name',(is_object($user) ? $user->name:''),['class'=>'form-control','placeholder'=>'Nama Lengkap']) !!}
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-3 col-form-label">Email</label>
                        <div class="col-9">
                            {!! Form::email('email',(is_object($user) ? $user->email:''),['class'=>'form-control','placeholder'=>'Email',(is_object($user) ? 'readonly':'')]) !!}
                            @if (is_object($user))
                                <small class="form-text text-muted">Untuk akun user email tidak bisa diubah</small>
                            @else
                                <small class="form-text text-muted">Pastikan email yang digunakan aktif dan dapat diakses</small>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-3 col-form-label">Password</label>
                        <div class="col-9">
                            {!! Form::password('password',['class'=>'form-control','id'=>'password','placeholder'=>'Password']) !!}
                            @if (is_object($user))
                                <small class="form-text text-muted">Biarkan kosong jika tidak ingin melakukan perubahan password</small>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-3 col-form-label">Ulangi Password</label>
                        <div class="col-9">
                            {!! Form::password('password_confirmation',['class'=>'form-control','placeholder'=>'Ulangi Password']) !!}
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-3 col-form-label">Role User</label>
                        <div class="col-9">
                            {!! Form::select('role',$role,(is_object($user) ? $user->roles->first()->id:''),['class'=>'form-control']) !!}
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
                    <a href="{{ route('user.index') }}" class="btn btn-secondary">Batal</a>
                </div>
            </div>
        </div>
    </div>
    {!! Form::close() !!}
</div>

@push('script')
    <script type="text/javascript">
        $(document).ready(function (e) {

            $( "#form-user" ).validate({
                // define validation rules
                rules: {
                    name: {
                        required: true
                    },
                    email: {
                        required: true,
                        email: true
                    },
                    @if(!is_object($user))
                    password: {
                        required: true
                    },
                    password_confirmation: {
                        equalTo: '#password'
                    },
                    @endif
                    role: {
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

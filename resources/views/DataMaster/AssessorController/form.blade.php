
<div class="kt-portlet__body">
    {!! Form::open(['url'=>$action,'id'=>'form-role','method'=>(!empty($assessor) ? 'PUT':'POST'),'files'=>true]) !!}
    <div class="row">
        <div class="col-xl-2"></div>
        <div class="col-xl-8">
            <div class="kt-section kt-section--first">
                <h3 class="kt-section__title">1. Informasi Akun:</h3>
                <div class="kt-section__body">
                    <div class="form-group row">
                        <label class="col-3 col-form-label">Nama Assessor</label>
                        <div class="col-9">
                            {!! Form::text('name',(!empty($assessor) ? $assessor->name:null),['class'=>'form-control','placeholder'=>'Nama Assessor']) !!}
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-3 col-form-label">Email</label>
                        <div class="col-9">
                            {!! Form::email('email',(!empty($assessor) ? $assessor->email:null),['class'=>'form-control','placeholder'=>'Email Assessor',(is_object($assessor) ? 'readonly':'')]) !!}
                            @if (is_object($assessor))
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
                            @if (is_object($assessor))
                                <small class="form-text text-muted">Biarkan kosong jika tidak ingin melakukan perubahan password</small>
                            @else
                                <small class="form-text text-muted">Pastikan email yang digunakan aktif dan dapat diakses</small>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-3 col-form-label">Ulangi Password</label>
                        <div class="col-9">
                            {!! Form::password('password_confirmation',['class'=>'form-control','placeholder'=>'Ulangi Password']) !!}
                        </div>
                    </div>
                </div>
                <h3 class="kt-section__title">2. Biodata:</h3>
                <div class="kt-section__body">
                    @if (is_object($assessor))
                        <div class="form-group row">
                            <label class="col-3 col-form-label"></label>
                            <div class="col-9">
                                <span>Foto Saat Ini</span> <br>
                                <img src="{{ Storage::url('upload/backend/assessor/'.$assessor->id.'/'.$assessor->foto) }}" alt="{{ $assessor->name }}" width="300">

{{--                                <a href="javascript:return false" class="btn btn-danger" id="remove_image">Hapus Gambar</a>--}}
                            </div>
                        </div>
                    @endif
                    <div class="form-group row">
                        <label class="col-3 col-form-label">Foto</label>
                        <div class="col-9">
                            {!! Form::file('pasfoto',['class'=>'form-control']) !!}
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-3 col-form-label">Nomor Telepon Genggam</label>
                        <div class="col-9">
                            {!! Form::text('mobile_phone',(!empty($assessor) ? $assessor->mobile_phone:null),['class'=>'form-control','placeholder'=>'Nomor Telepon Genggam']) !!}
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-3 col-form-label">Tempat Bekerja Saat Ini</label>
                        <div class="col-9">
                            {!! Form::text('company',(!empty($assessor) ? $assessor->company:null),['class'=>'form-control','placeholder'=>'Tempat Bekerja Daat ini']) !!}
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-3 col-form-label">Jabatan/Posisi</label>
                        <div class="col-9">
                            {!! Form::text('position',(!empty($assessor) ? $assessor->position:null),['class'=>'form-control','placeholder'=>'Jabatan/Posisi']) !!}
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-3 col-form-label">Status (Aktif/Tidak Aktif)</label>
                        <div class="col-9">
                            <span class="kt-switch kt-switch--icon">
                                <label>
                                    {!! Form::checkbox('status',1,((!empty($assessor) && $assessor->status == 1) ? 'checked':null),['class'=>'form-control']) !!}
                                    <span></span>
                                </label>
                            </span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-3 col-form-label">Profil Singkat</label>
                        <div class="col-9">
{{--                            <div class="summernote" id="kt_summernote_1"></div>--}}
{{--                            <textarea name="profile" id="kt_summernote_1" class="summernote" cols="30" rows="10"></textarea>--}}
                            {!! Form::textarea('profile',(!empty($assessor) ? $assessor->profile:null),['class'=>'summernote','id'=>'kt_summernote_1']) !!}
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-3 col-form-label">Program yang di assess (<small>Pilih program-program yang dapat diassess oleh assessor bersangkutan</small>)</label>
                        <div class="col-9">
                            <div class="kt-checkbox-inline">
                                @if ($program && $program->count() > 0)
                                    @foreach($program as $item)
                                        <label class="kt-checkbox">
                                            {!! Form::checkbox('assessment_ability[]',$item->id,((!empty($assessor) && in_array($item->id,$assessor->assessment_ability)) ? 'checked':null)) !!} {{ $item->code }}
                                            <span></span>
                                        </label>
                                    @endforeach
                                @endif
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

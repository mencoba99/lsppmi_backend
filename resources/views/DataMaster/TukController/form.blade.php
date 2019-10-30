
<div class="kt-portlet__body">
    {!! Form::open(['url'=>$action,'id'=>'form-role','method'=>(!empty($tuk) ? 'PUT':'POST'),'files'=>true]) !!}
    <div class="row">
        <div class="col-xl-2"></div>
        <div class="col-xl-8">
            <div class="kt-section kt-section--first">
{{--                <h3 class="kt-section__title">1. Informasi Akun:</h3>--}}
                <div class="kt-section__body">
                    <div class="form-group row">
                        <label class="col-3 col-form-label">Nama TUK</label>
                        <div class="col-9">
                            {!! Form::text('name',(!empty($tuk) ? $tuk->name:null),['class'=>'form-control','placeholder'=>'Nama TUK']) !!}
                        </div>
                    </div>
                </div>
                <div class="kt-section__body">
                    <div class="form-group row">
                        <label class="col-3 col-form-label">Alamat TUK</label>
                        <div class="col-9">
                            {!! Form::text('address',(!empty($tuk) ? $tuk->address:null),['class'=>'form-control','placeholder'=>'Alamat TUK']) !!}
                        </div>
                    </div>
                </div>
                <div class="kt-section__body">
                    <div class="form-group row">
                        <label class="col-3 col-form-label">Provinsi</label>
                        <div class="col-9">
                            {!! Form::select('province_id', $provinces, (is_object($tuk) ? $tuk->regency->provinsi->id:null),['class'=>'form-control kt-select2-province','placeholder'=>'Pilih Provinsi']) !!}
                        </div>
                    </div>
                </div>
                <div class="kt-section__body">
                    <div class="form-group row">
                        <label class="col-3 col-form-label">Kabupaten/Kota</label>
                        <div class="col-9">
                            {!! Form::select('regency_id', $regencies, (is_object($tuk) ? $tuk->regency_id:null),['class'=>'form-control kt-select2-regency','placeholder'=>'Pilih Kabuoaten/Kota','data-placeholder'=>'Pilih Kabuoaten/Kota']) !!}
                        </div>
                    </div>
                </div>
                <div class="kt-section__body">
                    <div class="form-group row">
                        <label class="col-3 col-form-label">Latitude</label>
                        <div class="col-3">
                            {!! Form::text('latitude',(!empty($tuk) ? $tuk->latitude:null),['class'=>'form-control','placeholder'=>'Posisi Latitude']) !!}
                            <small class="form-text text-muted">Posisi Latitude pada Google Map</small>
                        </div>
                    </div>
                </div>
                <div class="kt-section__body">
                    <div class="form-group row">
                        <label class="col-3 col-form-label">Longitude</label>
                        <div class="col-3">
                            {!! Form::text('longitude',(!empty($tuk) ? $tuk->longitude:null),['class'=>'form-control','placeholder'=>'Posisi Longitude']) !!}
                            <small class="form-text text-muted">Posisi Longitude pada Google Map</small>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-3 col-form-label">Status (Aktif/Tidak Aktif)</label>
                    <div class="col-9">
                            <span class="kt-switch kt-switch--icon">
                                <label>
                                    {!! Form::checkbox('status',1,((!empty($tuk) && $tuk->status == 1) ? 'checked':null),['class'=>'form-control']) !!}
                                    <span></span>
                                </label>
                            </span>
                    </div>
                </div>
                <div class="kt-section__body">
                    <div class="form-group row">
                        <label class="col-3 col-form-label">Kontak</label>
                        <div class="col-9">
                            {!! Form::textarea('contact',(!empty($tuk) ? $tuk->contact:null),['class'=>'summernote']) !!}
                        </div>
                    </div>
                </div>
                <div class="kt-section__body">
                    <div class="form-group row">
                        <label class="col-3 col-form-label">Profile Singkat TUK</label>
                        <div class="col-9">
                            {!! Form::textarea('description',(!empty($tuk) ? $tuk->description:null),['class'=>'summernote']) !!}
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
                    address: {
                        required: true
                    },
                    province_id: {
                        required: true
                    },
                    regency_id: {
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
            /** untuk select provinsi */
            $('.kt-select2-province').select2({
                placeholder: "Pilih Provinsi",
                allowClear: true
            });
            /** untuk select kabupaten/kota */
            $('.kt-select2-regency').select2({
                placeholder: "Pilih Kabuoaten/Kota",
                allowClear: true
            });
            /** Untuk event saat pilih provinsi maka kabupaten/kota akan berubah sesuai pilihan provinsi */
            $('.kt-select2-province').on('change', function (e) {
                var _this = $(this);
                $.post('{{ route('tuk.getregency') }}',{province_id:_this.val()}, function (data) {
                    console.log(data);
                    $(".kt-select2-regency").html("");
                    $(".kt-select2-regency").select2("destroy");
                    $('.kt-select2-regency').select2({
                        placeholder: "Pilih Kabuoaten/Kota",
                        data: data,
                        allowClear: true,
                    }).val(null).trigger('change.select2');
                },'json');
            });
        })
    </script>
@endpush

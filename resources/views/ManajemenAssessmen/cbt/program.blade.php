@extends('layouts.base')

@section('content')

<div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">
    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                <span class="kt-portlet__head-icon">
                    <i class="kt-font-brand flaticon2-line-chart"></i>
                </span>
                <h3 class="kt-portlet__head-title">
                      Program
                </h3>
            </div>
            <div class="kt-portlet__head-toolbar">
                <div class="kt-portlet__head-wrapper">
                    <div class="kt-portlet__head-actions">
                        @can('Program Add')
                        <button type="button" id="new" class="btn btn-brand btn-elevate btn-icon-sm" data-toggle="modal" data-target="#add"><i class="la la-plus"></i>
                            Tambah Data
                        </button>
                        @endcan
                    </div>
                </div>
            </div>
        </div>
        <div class="kt-portlet__body tabel-provinsi">
            <table class="table table-striped- table-bordered table-hover table-checkable dataTable no-footer dtr-inline" id="datatable">
                <thead>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                </thead>
                <tfoot>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td class="nosearch"></td>
                </tr>
                </tfoot>
            </table>

        </div>
    </div>
</div>

<div class="modal fade" id="add"  role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Data Baru</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                    <form id="form" class="kt-form kt-form--label-right" onsubmit="return false;">
                            <div class="kt-portlet__body">
                                <div class="kt-section kt-section--first">

                                    <div class="kt-section__body">
                                        <div class="form-group row">
                                            <label class="col-lg-3 col-form-label">Kategori:</label>
                                            <div class="col-lg-6">
                                                {!! Form::select('kategori_id',$Kategori,null,['id'=>'kategori_id','class'=>'form-control input-sm kt-selectpicker','required'=>'required','data-live-search'=>"true",'placeholder'=>'Pilih Kategori']) !!}
                                                {!! Form::text('program_id',null,['id'=>'program_id','class'=>'form-control','hidden'=>'hidden']) !!}

                                            </div>
                                        </div>
                                        <div class="form-group row">
                                                <label class="col-lg-3 col-form-label">Kode Program:</label>
                                                <div class="col-lg-6">
                                                    {!! Form::text('program_code',null,['id'=>'program_code','class'=>'form-control ','required'=>'required']) !!}
                                                </div>
                                        </div>
                                        <div class="form-group row">
                                                <label class="col-lg-3 col-form-label">Nama Program:</label>
                                                <div class="col-lg-6">
                                                    {!! Form::text('program_name',null,['id'=>'program_name','class'=>'form-control ','required'=>'required']) !!}
                                                </div>
                                        </div>
                                        <div class="form-group row">
                                                <label class="col-lg-3 col-form-label">Singkatan Ind:</label>
                                                <div class="col-lg-6">
                                                    {!! Form::text('program_sing_ind',null,['id'=>'program_sing_ind','class'=>'form-control ','required'=>'required']) !!}
                                                </div>
                                        </div>
                                        <div class="form-group row">
                                                <label class="col-lg-3 col-form-label">Singkatan Eng:</label>
                                                <div class="col-lg-6">
                                                    {!! Form::text('program_sing_eng',null,['id'=>'program_sing_eng','class'=>'form-control ','required'=>'required']) !!}
                                                </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-lg-3 col-form-label">Min Competence:</label>
                                            <div class="col-lg-6">
                                                {!! Form::text('min_competence',null,['id'=>'min_competence','class'=>'form-control ','required'=>'required']) !!}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-lg-3 col-form-label">Opt Competence:</label>
                                            <div class="col-lg-6">
                                                {!! Form::text('opt_competence',null,['id'=>'opt_competence','class'=>'form-control ','required'=>'required']) !!}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-lg-3 col-form-label">Level:</label>
                                            <div class="col-lg-3">
                                                {!! Form::select('level',$level,null,['id'=>'level','class'=>'form-control input-sm kt-selectpicker','required'=>'required','data-live-search'=>"true",'placeholder'=>'Pilih Level']) !!}
                                            </div>
                                        </div>
                                        <div class="form-group row mta">
                                            <label class="col-3 col-form-label">Metode Assesment</label>
                                            <div class="col-9">
                                                <div class="kt-checkbox-inline">
                                                    <label class="kt-checkbox">
                                                        {!! Form::checkbox('type[]','direct',null,['class'=>'tipe-asesmen','id'=>'direct','data-direct'=>'']) !!} Langsung
                                                        <span></span>
                                                    </label>
                                                    <label class="kt-checkbox">
                                                        {!! Form::checkbox('type[]','indirect',null,['class'=>'tipe-asesmen','id'=>'indirect','data-indirect'=>'']) !!} Tidak Langsung
                                                        <span></span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row metode" style="display:none;">
                                            <label class="col-3 col-form-label">Metode</label>
                                            <div class="col-9">
                                                <div class="kt-checkbox-inline">
                                                    <label class="kt-checkbox">
                                                        {!! Form::checkbox('type[direct][]','cbt',null,['id'=>'cbt','data-cbt'=>'']) !!} CBT
                                                        <span></span>
                                                    </label>
                                                    <label class="kt-checkbox">
                                                        {!! Form::checkbox('type[direct][]','interview',null,['id'=>'interview','data-interview'=>'','checked'=>false]) !!} Interview
                                                        <span></span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row metode-tidak-langsung" style="display:none;">
                                            <label class="col-3 col-form-label">Pilih Metode Asesmen Tidak Langsung</label>
                                            <div class="col-9">
                                                <div class="kt-checkbox-inline">
                                                    <label class="kt-checkbox">
                                                        {!! Form::checkbox('type[indirect][]','observasi',null,['id'=>'observasi','data-observasi'=>'']) !!} Verifikasi Portofolio
                                                        <span></span>
                                                    </label>
                                                    <label class="kt-checkbox">
                                                        {!! Form::checkbox('type[indirect][]','wawancara',null,['id'=>'wawancara','data-wawancara'=>'','checked'=>false]) !!} Wawancara
                                                        <span></span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                                <label class="col-lg-3 col-form-label">Keterangan:</label>
                                                <div class="col-lg-6">
                                                    {!! Form::text('program_desc',null,['id'=>'program_desc','class'=>'summernote form-control ']) !!}
                                                </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-lg-3 col-form-label">Status:</label>
                                            <div class="col-lg-3">
                                                {!! Form::select('status',$status,null,['id'=>'status','class'=>'form-control input-sm kt-selectpicker','required'=>'required','data-live-search'=>"true",'placeholder'=>'Pilih Status']) !!}
                                            </div>
                                        </div>
                                    </div>


                                </div>
                            </div>



            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" id="simpan" class=" btn btn-brand btn-elevate btn-icon-sm">Simpan</button>
            </div>
        </form>
        </div>
    </div>
</div>

@endsection

@push('script')
<script src="{{ Storage::url('assets/backend/vendors/custom/datatables/datatables.bundle.js') }}" type="text/javascript"></script>
<script type="text/javascript">
    var KTBootstrapSelect = function () {

    //  functions init
    var start = function () {
        $('.kt-selectpicker').selectpicker().change(function(){
            $(this).valid()
        });
        $('.summernote').summernote({
            height: 150
        });


    }

    return {
        // public functions
        init: function() {
            start();
        }
    };
}();

//validate
jQuery(document).ready(function () {
    KTBootstrapSelect.init();
    form = $("#form").validate({
        rules: {
            "kategori_id": {
                required: true
            },
            "program_code": {
                required: true
            },
            "program_name": {
                required: true
            },
            "program_sing_ind": {
                required: true
            },
            "program_sing_eng": {
                required: true
            },
            "min_competence": {
                required: true
            },
            "opt_competence": {
                required: true
            },
            "level": {
                required: true
            },
            "interview": {
                required: function (element) {
                    if ($("#type").prop("checked") == true) {
                        if ($("#cbt").prop("checked") == true) {
                            return false;
                        } else {
                            return true;
                        }


                    } else {
                        return false;
                    }
                },
                maxlength: 2
            },
            "status": {
                required: true
            }

        },
        messages: {
            "kategori_id": {
                required: "Silahkan pilih kategori "
            },
            "program_code": {
                required: "Silahkan tulis kode yang akan diinput"
            },
            "program_name": {
                required: "Silahkan tulis nama yang akan diinput"
            },
            "program_sing_ind": {
                required: "Silahkan tulis singkatan ind yang akan diinput"
            },
            "program_sing_eng": {
                required: "Silahkan tulis singkatan eng yang akan diinput"
            },
            "min_competence": {
                required: "Silahkan tulis min competence yang akan diinput"
            },
            "opt_competence": {
                required: "Silahkan tulis opt competence yang akan diinput"
            },
            "level": {
                required: "Silahkan pilih level"
            },
            "interview": {
                required: "Silahkan pilih modul"
            },
            "status": {
                required: "Silahkan pilih status"
            }
        },
        submitHandler: function (form) {
            table = $('#datatable').DataTable().destroy();


            $.ajax({
                type: "post",
                url: "{{ route('ujian-komputer.program.insert') }}",
                dataType: "json",
                data: $('#form').serialize(),
                // data: {
                //     id: $("#program_id").val(),
                //     program_type_id: $("#kategori_id").val(),
                //     code: $("#program_code").val(),
                //     name: $("#program_name").val(),
                //     sing_int: $("#program_sing_eng").val(),
                //     sing_ind: $("#program_sing_ind").val(),
                //     min_competence: $("#min_competence").val(),
                //     opt_competence: $("#opt_competence").val(),
                //     level: $("#level").val(),
                //     // type: $("input[name='type']"),
                //     cbt: $("#cbt").data('cbt'),
                //     interview: $("#interview").data('interview'),
                //     status: $("#status").val(),
                //     desc: $(".note-editable").html(),
                // },
                beforeSend: function () {
                    KTApp.block('#add .modal-content', {
                        overlayColor: '#000000',
                        type: 'v2',
                        state: 'primary',
                        message: 'Processing...'
                    });
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                    // alert(JSON.stringify(response));
                    if (response.status === 200) {
                        view();
                        setTimeout(function () {
                            KTApp.unblock('#add .modal-content');
                            $('#add').modal('hide');
                            $.notify({
                                // options
                                message: 'Berhasil disimpan'
                            }, {
                                // settings
                                type: 'success',
                                placement: {
                                    from: "top",
                                    align: "right"
                                }
                            });
                        }, 2000);

                        //
                    } else if (response.status === 500) {
                        KTApp.unblock('#add .modal-content');
                        $('#add').modal('hide');
                        $.notify({
                            // options
                            message: 'Tidak berhasil disimpan'
                        }, {
                            // settings
                            type: 'danger',
                            placement: {
                                from: "top",
                                align: "right"
                            }
                        });
                    }
                },
                error: function (jqXHR, exception) {

                    msg = '';
                    if (jqXHR.status === 0) {
                        msg = 'Not connect.\n Verify Network.';
                    } else if (jqXHR.status == 404) {
                        msg = 'Requested page not found. [404]';
                    } else if (jqXHR.status == 500) {
                        msg = 'Internal Server Error [500].';
                    } else if (exception === 'parsererror') {
                        msg = 'Requested JSON parse failed.';
                    } else if (exception === 'timeout') {
                        msg = 'Time out error.';
                    } else if (exception === 'abort') {
                        msg = 'Ajax request aborted.';
                    } else {
                        msg = 'Uncaught Error.\n' + jqXHR.responseText;
                    }

                    KTApp.unblock('#add .modal-content');
                    $('#add').modal('hide');

                    $.notify({
                        // options
                        message: msg
                    }, {
                        // settings
                        type: 'danger',
                        placement: {
                            from: "top",
                            align: "right"
                        }
                    });

                },
            })
            return false;
            event.preventDefault();
        }
    });
});

  function view(){
    $('#datatable').DataTable().destroy(); // destroy datatable
    /* Datatable View */
     $('#datatable').DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            ajax: "{{ route('ujian-komputer.program.data') }}",
            columns: [
                { data: 'id', render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                } , title: 'No.', width : "3%" },
                { data: 'code', name: 'code' , title: 'Kode ', width : "5%" },
                { data: 'name', name: 'name' , title: 'Nama Program' },
                { data: 'kategori.name', name: 'kategori.name' , title: 'Kategori' },
                { data: 'abbreviation_id', name: 'abbreviation_en' , title: 'Singkatan Ind' },
                { data: 'abbreviation_en', name: 'abbreviation_en' , title: 'Singkatan Eng' },
                { data: 'min_competence', name: 'min_competence' , title: 'Min Competence' },
                { data: 'opt_competence', name: 'opt_competence' , title: 'Opt Competence' },
                { data: 'level', name: 'level' , title: 'Level', width : "3%" },
                { data: 'keterangan', name: 'keterangan' , title: 'Keterangan' },
                { data: 'status', name: 'status' , title: 'Status', width : "10%" },
                { data: 'action', name: 'action' , title: 'Action', width : "5%"  }
            ]
    });

    }

    $(function () {

        view(); //call datatable view

        /* Edit Data */
        $("#datatable").on("click", "tr #edit", function () {
            $("input").val("");
            form.resetForm();
            $('#summernote').summernote('destroy');

            $("#program_id").val($(this).data('id'));
            $("select#kategori_id").val($(this).data('kategori'));
            $("#program_name").val($(this).data('nama'));
            $("#program_code").val($(this).data('code'));
            $("#status").val($(this).data('status'));
            $("#program_sing_eng").val($(this).data('sing_int'));
            $("#program_sing_ind").val($(this).data('sing_ind'));
            $("#program_harga").val($(this).data('harga'));
            $("#min_competence").val($(this).data('optCompetence'));
            $("#opt_competence").val($(this).data('optCompetence'));

            $("select#level").val($(this).data('level'));
            $('.kt-selectpicker').selectpicker('refresh');

            $.ajax({
                type: "post",
                url: "{{ route('ujian-komputer.program.desc') }}",
                dataType: "json",
                data: {
                    id: $(this).data('id'),
                },
                beforeSend: function () {
                    KTApp.blockPage();
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {

                    if (response.status === 200) {
                        // console.log(response.type[0]);
                        // console.log($.inArray('direct', response.type[0]));

                        if (response.type[0].type.length > 0 && response.type[0].type == 'direct') {
                            // console.log('nemu direct');
                            $('.metode-langsung').show();
                            $("#direct").prop('checked', true);
                            if (response.type[0].methods.length > 0 && response.type[0].methods[0] == 'cbt') {
                                // console.log('nemu cbt');
                                $("#cbt").prop('checked', true)
                            }

                            if (response.type[0].methods.length > 0 && response.type[0].methods[1] == 'interview') {
                                // console.log($.inArray('interview',response.type));
                                $("#interview").prop('checked', true);
                            }
                        }

                        if (response.type[1]) {
                            if (response.type[1].type.length > 0 && response.type[1].type == 'indirect') {
                                // console.log('nemu indirect')
                                $('.metode-tidak-langsung').show();
                                $("#indirect").prop('checked', true);

                                if (response.type[1].methods.length > 0 && response.type[1].methods[0] == 'observasi') {
                                    // console.log('nemu cbt');
                                    $("#observasi").prop('checked', true)
                                }

                                if (response.type[1].methods.length > 0 && response.type[1].methods[1] == 'wawancara') {
                                    // console.log($.inArray('interview',response.type));
                                    $("#wawancara").prop('checked', true);
                                }
                            }
                        }
                        // if(response.type[0].type == 'direct') {
                        //     $("#direct").prop('checked', true);
                        //     $('.metode-langsung').show();
                        //
                        //     // if (response.methods[0])
                        // }
                        $('.summernote').summernote('code', response.data);
                        setTimeout(function () {
                            KTApp.unblockPage(); //loading icon
                        }, 2000);
                        $('#add').modal('show');

                    } else if (response.status === 500) {
                        // do something with response.message or whatever other data on error
                    }
                }
            })


        });



        // $('.type').change(function () {
        //     if ($(this).prop("checked") == true) {
        //         console.log($(this).val());
        //         $(".metode").show();
        //         $(this).data('direct', 'direct');
        //     } else if ($(this).prop("checked") == false) {
        //         $(".metode").hide();
        //         $("#cbt").prop("checked", false).trigger("change");
        //         $("#interview").prop("checked", false).trigger("change");
        //         $(this).data('direct', '');
        //     }
        // });

        $(document).on('click', '.tipe-asesmen', function (e) {
            console.log($(this).val());
            if ($(this).is(':checked') === true && $(this).val() == 'direct') {
                $('.metode-langsung').show();
            } else if ($(this).is(':checked') === false && $(this).val() == 'direct') {
                console.log('unchecked langsung');
                $('#cbt').prop('checked', false);
                $('#interview').prop('checked', false);
            }

            if ($(this).is(':checked') === true && $(this).val() == 'indirect') {
                $('.metode-tidak-langsung').show();
            } else if ($(this).is(':checked') === false && $(this).val() == 'indirect') {
                console.log('unchecked langsung');
                $('#portofolio').prop('checked', false);
                $('#wawancara').prop('checked', false);
            }
        });

        $('#cbt').change(function () {
            if ($(this).prop("checked") == true) {
                $(this).data('cbt', 'cbt');
            } else {
                $(this).data('cbt', '');
            }
        });

        $('#interview').change(function () {
            if ($(this).prop("checked") == true) {
                $(this).data('interview', 'interview');
            } else {
                $(this).data('interview', '');
            }
        });


        /* New Data Button */
        $('#new').click(function (event) {
            // $("input").val("");
            $('.summernote').summernote('reset');
            $("select#program_id").val("");
            $('.kt-selectpicker').selectpicker('refresh');
            form.resetForm();
        });

    });

</script>

@endpush

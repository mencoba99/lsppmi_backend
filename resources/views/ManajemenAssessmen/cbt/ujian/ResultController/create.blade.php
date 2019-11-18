@extends('layouts.modal.base')
@section('content')
<!-- begin:: Content -->
<div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">
    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                <span class="kt-portlet__head-icon">
                    <i class="kt-font-brand flaticon2-line-chart"></i>
                </span>
                <h3 class="kt-portlet__head-title">
                    Jenis Ujian
                </h3>
            </div>
        </div>
        <div class="kt-portlet__body">
            <form id="form" class="kt-form kt-form--label-right">
                <div class="kt-portlet__body">
                    <div class="kt-section kt-section--first">
                        <div class="kt-section__body">
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label">Nama:</label>
                                <div class="col-lg-6">
                                    {!! Form::text('name',null,['id'=>'name','class'=>'form-control'])!!}
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label">Keterangan:</label>
                                <div class="col-lg-6">
                                    {!! Form::textarea('keterangan',null,['id'=>'keterangan','class'=>'form-control ','required'=>'required']) !!}

                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label">Aktif?:</label>
                                <div class="col-lg-6">
                                        <div class="kt-portlet__head-toolbar">
                                                <div class="kt-portlet__head-actions">
                                                    <span class="kt-switch kt-switch--icon">
                                                        <label>
                                                            <input type="checkbox" data-url="" name="aktif" id="aktif" class="roleParentChange roleList">
                                                            <span></span>
                                                        </label>
                                                    </span>
                                                </div>
                                            </div>
                                </div>
                            </div>

                            
                        </div>
                    </div>
                </div>
        </div>
        <div class="modal-footer">
            <button type="button" id="close" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" id="simpan" class=" btn btn-brand btn-elevate btn-icon-sm">Simpan</button>
        </div>
        </form>
    </div>
</div>
</div>
<!-- end:: Content -->
@endsection

@push('modal-script')
<script src="{{ Storage::url('assets/backend/vendors/custom/datatables/datatables.bundle.js') }}" type="text/javascript"></script>
<script type="text/javascript">


jQuery(document).ready(function() {
    //$('.modal-footer', parent.document).remove();
    $('#loader', parent.document).fadeOut();
   
    form = $("#form").validate({
        rules: {
            "name": {
                required: true
            },
            "keterangan": {
                required: true
            }

        },
        messages: {
            "name": {
                required: "Silahkan tulis name kategori yang akan diinput "
            },
            "keterangan": {
                required: "Silahkan pilih modul & submodul "
            }
        },
        submitHandler: function (form) { // for demo
                table = $('#datatable').DataTable().destroy();
            
                $.ajax({
                type: "post",
                url: "{{ route('ujian.jenis.insert') }}",
                dataType:"json",
                data: {
                    name: $("#name").val(),
                    keterangan: $("#keterangan").val(),
                    aktif: $("#aktif").val()
                },
                beforeSend: function() {
                //     KTApp.block('.kt-portlet__body', {
                //     overlayColor: '#000000',
                //     type: 'v2',
                //     state: 'primary',
                //     message: 'Processing...'
                // });
                
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                        // alert(JSON.stringify(response));
                        if (response.status === 200) {
                            view();
                            
                            
                            $.when(setTimeout(function () {
                                KTApp.unblock('.kt-portlet__body');
                                
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
                            }, 2000)).then(function() {
                                // parent.$('#mod-iframe-large').modal('hide');
                                setTimeout(function(){ 
                                    parent.$('#mod-iframe-large').modal('hide');
                                 }, 4000);
                            });

                        } else if (response.status === 500) {
                            $.notify({
                                // options
                                message: 'Error'
                            }, {
                                // settings
                                type: 'danger',
                                placement: {
                                    from: "top",
                                    align: "right"
                                }
                            });
                        }

                       

                }, error: function (jqXHR, exception) {
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
        }
    });
});

  function view(){
    parent.$('#datatable').DataTable().destroy(); // destroy datatable
    /* Datatable View */
    parent.$('#datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('ujian.jenis.data') }}",
            columns: [
                { data: 'id', render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                } , title: 'No.', width : "3%" },
                { data: 'name', name: 'name' , title: 'Nama ' },
                { data: 'keterangan', name: 'keterangan' , title: 'Keterangan ' },
                { data: 'action', name: 'action' , title: 'Action', width : "15%" },
            ]
    });
    }

    $(function() {
        view(); //call datatable view
       
        /* New Data Button */
        $('#close').click(function(event) {
            parent.$('#mod-iframe-large').modal('hide');
            parent.$('#iframeModalContent').attr('src',"about:blank");
            // $('#mod-iframe-large', parent.document).modal('hide');
        });
        
    });

</script>

@endpush


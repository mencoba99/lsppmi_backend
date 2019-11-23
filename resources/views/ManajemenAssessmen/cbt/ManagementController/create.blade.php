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
                    Program management
                </h3>
            </div>
        </div>
        <div class="kt-portlet__body">
            <form id="form" class="kt-form kt-form--label-right">
                <div class="kt-portlet__body">
                    <div class="kt-section kt-section--first">
                        <div class="kt-section__body">
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label">Program:</label>
                                <div class="col-lg-6">
                                    {!!
                                    Form::select('program_id',$Program,null,['id'=>'program_id','class'=>'form-control
                                    input-sm
                                    kt-selectpicker','required'=>'required','data-live-search'=>"true"]) !!}
                                    {!!
                                    Form::text('mgt_id',null,['id'=>'mgt_id','class'=>'form-control','hidden'=>'hidden'])
                                    !!}
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label">Modul:</label>
                                <div class="col-lg-6">
                                    <div class='tree'>
                                        <ul>
                                            @foreach ($modul as $moduls)
                                            <li dataid="">{{ $moduls->name }}
                                                <ul>
                                                    @foreach ($moduls->submodul as $submoduls)
                                                    <li class="no_checkbox" dataid="{{ $submoduls->id }}">
                                                        {{ $submoduls->name }}</li>
                                                    @endforeach
                                                </ul>
                                            </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    <input type="text" name="checktree" style="display:none" id="checktree" value="">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label">Status:</label>
                                <div class="col-lg-6">
                                        <div class="kt-portlet__head-toolbar">
                                                <div class="kt-portlet__head-actions">
                                                    <span class="kt-switch kt-switch--icon">
                                                        <label>
                                                            <input type="checkbox" data-url="" name="status" id="status" class="roleParentChange roleList">
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.2.1/jstree.min.js"></script>
<script src="{{ Storage::url('assets/backend/vendors/custom/datatables/datatables.bundle.js') }}" type="text/javascript"></script>
<script type="text/javascript">

     function getAllSelectedNodesText(jsTree) {
         var selectedNodes = jsTree.jstree("get_selected");
         var allText = [];
         $.each(selectedNodes, function (i, nodeId) {
             var node = jsTree.jstree("get_node", nodeId);
             allText.push(node.li_attr.dataid); 
         });
         return allText; 
     }

     var ElementInit = function () {

         // Private functions
         var element = function () {
             $('.kt-selectpicker').selectpicker().change(function () {
                 $(this).valid()
             });
             $('#status').change(function () {
                 $(this).valid()
             });

             $('.tree').jstree({
                 "core": {
                     "dblclick_toggle": false,
                 },
                 "plugins": ["wholerow", "checkbox"],
             });

             $(".tree").click(function (jsTree) {
                 var allSelectedText = getAllSelectedNodesText($(".tree"));
                 console.log(allSelectedText);
                 $('#checktree').val(allSelectedText);
                 $('#checktree').valid();
                 

             });

         }

         return {
             init: function () {
                element();
             }
         };
     }();

jQuery(document).ready(function() {
    //$('.modal-footer', parent.document).remove();
    $('#loader', parent.document).fadeOut();
    ElementInit.init();

    form = $("#form").validate({
        rules: {
            "program_id": {
                required: true
            },
            "checktree": {
                required: true
            }

        },
        messages: {
            "program_id": {
                required: "Silahkan tulis nama kategori yang akan diinput "
            },
            "checktree": {
                required: "Silahkan pilih modul & submodul "
            }
        },
        submitHandler: function (form) { // for demo
                table = $('#datatable').DataTable().destroy();
                if($("#status").is(':checked')){
                    cekstatus = 1;
                }else{
                    cekstatus = 0;
                }
                   

                $.ajax({
                type: "post",
                url: "{{ route('ujian-komputer.management.insert') }}",
                dataType:"json",
                data: {
                    checktree: $("#checktree").val(),
                    program: $("#program_id").val(),
                    status: cekstatus,
                    id: $("#mgt_id").val()
                },
                beforeSend: function() {
                    KTApp.block('.kt-portlet__body', {
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

                           // Promise.all([notify]).then(function() {
                             //   parent.$('#mod-iframe-large').modal('hide');
                              //});

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
            ajax: "{{ route('ujian-komputer.management.data') }}",
            columns: [
                { data: 'id', render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                } , title: 'No.', width : "3%" },
                { data: 'nama_program', name: 'nama_program' , title: 'Program ' },
                { data: 'action', name: 'action' , title: 'Action', width : "15%" },
            ],
            "drawCallback": function(settings) {
				parent.$('.tree').jstree();
            }, 
    });
    }

    $(function() {


        view(); //call datatable view
       

        
        $('#tes').click(function(event) {
            view();
        });


        /* New Data Button */
        $('#close').click(function(event) {
            parent.$('#mod-iframe-large').modal('hide');
            parent.$('#iframeModalContent').attr('src',"about:blank");
            // $('#mod-iframe-large', parent.document).modal('hide');
        });
            
       

    });

</script>

@endpush
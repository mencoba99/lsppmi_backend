@extends('layouts.base')

@section('content')

<div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">
    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                <span class="kt-portlet__head-icon">
                    <i class="kt-font-brand flaticon2-tag"></i>
                </span>
                <h3 class="kt-portlet__head-title">
                  Program management
                </h3>
            </div>
            <div class="kt-portlet__head-toolbar">
                <div class="kt-portlet__head-wrapper">
                    <div class="kt-portlet__head-actions">
                        <button type="button" id="new" class="modalIframe btn btn-brand btn-elevate btn-icon-sm" data-toggle='kt-tooltip' ><i class="la la-plus"></i>
                            Tambah   </button>
                        &nbsp;
                        <a href={{route('tuk.show', '')}} class='btn btn-sm btn-icon btn-clean btn-icon-sm modalIframe' data-toggle='kt-tooltip' title='View ".$MgtProgram->name."' data-original-tooltip='View ".$MgtProgram->name."'>
                                <i class='la la-search'></i>
                                </a>
                        {{-- <a href="#add" data-toggle="modal" class="btn btn-brand btn-elevate btn-icon-sm">
                            <i class="la la-plus"></i>
                            New Record
                        </a> --}}
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
                </tr>
                </thead>
                <tfoot>
                <tr>
                    <td></td>
                    <td></td>
                    <td class="nosearch"></td>
                </tr>
                </tfoot>
            </table>

        </div>
    </div>
</div>
{{-- <div class="modal fade" id="add" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah {{ucfirst(trans(end($crumbs)))}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
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
                                        <input type="text" name="checktree" style="display:none" id="checktree"
                                            value="">
                                    </div>
                                </div>
                                <div class="form-group row">
                                        <label class="col-lg-3 col-form-label">Status:</label>
                                        <div class="col-lg-6">
                                            {!! Form::select('status', $status,null,['id'=>'status','class'=>'form-control input-sm kt-selectpicker','required'=>'required','data-live-search'=>"true"]) !!}
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
</div> --}}

@endsection

@push('script')
<script src="http://static.jstree.com/3.0.0-beta3/assets/dist/jstree.min.js" type="text/javascript"></script>

<script src="{{ Storage::url('assets/backend/vendors/custom/datatables/datatables.bundle.js') }}" type="text/javascript"></script>
<script type="text/javascript">
     function getAllSelectedNodesText(jsTree) {
         // this returns ids of all selected nodes
         var selectedNodes = jsTree.jstree("get_selected");
         var allText = [];
         // Go through all selected nodes to get text
         $.each(selectedNodes, function (i, nodeId) {
             var node = jsTree.jstree("get_node", nodeId);
             allText.push(node.li_attr.dataid); // Add id modul to array
         });
         return allText; // This will join all entries with comma
     }

     var KTBootstrapSelect = function () {

         // Private functions
         var demos = function () {
             $('.kt-selectpicker').selectpicker().change(function () {
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

            //  $(".tree").jstree({
            //      "checkbox": {
            //          "keep_selected_style": true
            //      },
            //      "plugins": ["checkbox", "sort"]
            //  });

            
         }

         return {
             // public functions
             init: function () {
                 demos();
             }
         };
     }();

jQuery(document).ready(function() {
    KTBootstrapSelect.init();
    form = $("#form").validate({
        rules: {
            "program_id": {
                required: true
            },
            "checktree": {
                required: true
            },
            "status": {
                required: true
            }

        },
        messages: {
            "program_id": {
                required: "Silahkan tulis nama kategori yang akan diinput "
            },
            "checktree": {
                required: "Silahkan pilih modul & submodul "
            },
            "status": {
                required: "Silahkan pilih modul & submodul "
            }
        },
        submitHandler: function (form) { // for demo
               table = $('#datatable').DataTable().destroy();
            

                $.ajax({
                type: "post",
                url: "{{ route('ujian-komputer.management.insert') }}",
                dataType:"json",
                data: {
                    checktree: $("#checktree").val(),
                    program: $("#program_id").val(),
                    status: $("#status").val(),
                    id: $("#mgt_id").val()
                },
                beforeSend: function() {
                //     KTApp.block('#add .modal-content', {
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
                    if(response.status === 200) {
                        view();
                        setTimeout(function() {
                            KTApp.unblock('#add .modal-content');
                            $('#add').modal('hide');
                            $.notify({
                                // options
                                message: 'Berhasil disimpan' 
                            },{
                                // settings
                                type: 'success',
                                placement: {
                                    from: "top",
                                    align: "right"
                                }
                            });
                        }, 2000);

            //
                    } else if(response.status === 500) {
                        $.notify({
                                // options
                                message: 'Error' 
                            },{
                                // settings
                                type: 'danger',
                                placement: {
                                    from: "top",
                                    align: "right"
                                }
                            });
                    }
                },error: function (jqXHR, exception) {
                    
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
                           },{
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

           
        // if((this).jstree(true).get_selected()){
        //     alert("Checked: " + data.node.id);
        //     alert("Parent: " + data.node.parent); 
        // }
        // alert("Checked: " + data.node.id);
        // alert("Parent: " + data.node.parent); 
       

            
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
            ajax: "{{ route('ujian-komputer.management.data') }}",
            columns: [
                { data: 'id', render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                } , title: 'No.', width : "3%" },
                { data: 'nama_program', name: 'nama_program' , title: 'Program ' },
                { data: 'action', name: 'action' , title: 'Action', width : "5%" },
            ]
    });
    }

    $(function() {


        view(); //call datatable view


        /* Edit Data */
        $("#datatable").on("click", "tr #edit", function() {
            $("input").val("");
            form.resetForm();
            $("#kategori_id").val($(this).data('id'));
            $("#kategori_code").val($(this).data('code'));
            $("#kategori_desc").val($(this).data('desc'));
            $("#kategori_nm").val($(this).data('nama'));
            $("select#status").val($(this).data('status'));
            $('.kt-selectpicker').selectpicker('refresh');
            $("#simpan").show();

            $('#add').modal('show');
        });



        /* New Data Button */
        $('#new').click(function(event) {
            $("input").val("");
            $("textarea").val("");
            $("select").val("");
            $('.kt-selectpicker').selectpicker('refresh');
            form.resetForm();
            $("#simpan").show();
        });

        // $('#checktree').on('change', function () {
        //     alert("tes");
        // });

        $('select#modul').on('change', function () {
           
            $.ajax({
                type: "POST",
                url: "{{ route('ujian-komputer.management.modul') }}",
                data: {
                    'modul_id': this.value
                },
                beforeSend: function () {
                    KTApp.block();
                    $('select#submodul').html("");
                    $('.kt-selectpicker').selectpicker('refresh');
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (data) {
                     
                    $.each(data, function (index, value) {
                       
                        $('select#submodul').append('<option value="' + value.id + '">' + value.name + '</option>');
                        $('.kt-selectpicker').selectpicker('refresh');
                    });

                }
            });

            });

    });

</script>

@endpush

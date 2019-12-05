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
                  Soal
                </h3>
            </div>
            <div class="kt-portlet__head-toolbar">
                <div class="kt-portlet__head-wrapper">
                    <div class="kt-portlet__head-actions">
                        <button type="button" id="new" class="btn btn-brand btn-elevate btn-icon-sm" data-toggle="modal" data-target="#add"><i class="la la-plus"></i>
                            Tambah   Data</button>
                        &nbsp;
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
                    <td class="nosearch"></td>
                </tr>
                </tfoot>
            </table>
          
        </div>
    </div>
</div>

<div class="modal fade" id="add"  role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg"   style="min-width: 100%;margin: 0;" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                    <form id="form" class="kt-form kt-form--label-right">
                            <div class="kt-portlet__body">
                                <div class="kt-section kt-section--first">
                                    
                                    <div class="kt-section__body">
                                        <div class="form-group row">
                                            <label class="col-lg-3 col-form-label">Modul:</label>
                                            <div class="col-lg-6">
                                                    {!! Form::select('modul_id',$modul,null,['id'=>'modul_id','class'=>'form-control input-sm kt-selectpicker','required'=>'required','data-live-search'=>"true",'placeholder'=>'Pilih Modul']) !!}
                                                    {!! Form::text('soal_id',null,['id'=>'soal_id','class'=>'form-control','hidden'=>'hidden']) !!}
                                               
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                                <label class="col-lg-3 col-form-label">Submodul:</label>
                                                <div class="col-lg-6">
                                                    {!! Form::select('submodul_id',['' => 'Pilih Submodul'],null,['id'=>'submodul_id','class'=>'form-control input-sm kt-selectpicker','required'=>'required','data-live-search'=>"true"]) !!}
                                              
                                                </div>
                                        </div>
                                        <div class="form-group row bobot" style="display: none">
                                                <label class="col-lg-3 col-form-label">Bobot:</label>
                                                <div class="col-lg-6">
                                                    {!! Form::select('jenissoal_id',$bobot,null,['id'=>'jenissoal_id','class'=>'form-control input-sm kt-selectpicker','required'=>'required','data-live-search'=>"true",'placeholder'=>'Pilih Bobot']) !!}
                                                </div>
                                        </div>
                                        <div class="form-group row parent" style="display: none">
                                                <label class="col-lg-3 col-form-label">Parent:</label>
                                                <div class="col-lg-6">
                                                    {!! Form::select('parent_id',['0' => 'Parent'],null,['id'=>'parent_id','class'=>'form-control input-sm kt-selectpicker','data-live-search'=>"true"]) !!}
                                                </div>
                                        </div>
                                        <div class="form-group row">
                                                <label class="col-lg-3 col-form-label">Nick:</label>
                                                <div class="col-lg-6">
                                                    {!! Form::text('nick',null,['id'=>'nick','class'=>'form-control ','required'=>'required']) !!}
                                                 
                                                </div>
                                        </div>
                                        <div class="form-group row">
                                                <label class="col-lg-3 col-form-label">soal:</label>
                                                <div class="col-lg-6">
                                                    {!! Form::textarea('soal',null,['id'=>'soal','class'=>'form-control summernote']) !!}
                                                  
                                                </div>
                                        </div>
                                        <div class="form-group row">
                                                <label class="col-lg-3 col-form-label">a:</label>
                                                <div class="col-lg-6">
                                                    {!! Form::textarea('answer_a',null,['id'=>'answer_a','class'=>'form-control ','required'=>'required']) !!}
                                                  
                                                </div>
                                        </div>
                                        <div class="form-group row">
                                                <label class="col-lg-3 col-form-label">b:</label>
                                                <div class="col-lg-6">
                                                    {!! Form::textarea('answer_b',null,['id'=>'answer_b','class'=>'form-control ','required'=>'required']) !!}
                                                  
                                                </div>
                                        </div>
                                        <div class="form-group row">
                                                <label class="col-lg-3 col-form-label">c:</label>
                                                <div class="col-lg-6">
                                                    {!! Form::textarea('answer_c',null,['id'=>'answer_c','class'=>'form-control ','required'=>'required']) !!}
                                                  
                                                </div>
                                        </div>
                                        <div class="form-group row">
                                                <label class="col-lg-3 col-form-label">d:</label>
                                                <div class="col-lg-6">
                                                    {!! Form::textarea('answer_d',null,['id'=>'answer_d','class'=>'form-control ','required'=>'required']) !!}
                                                  
                                                </div>
                                        </div>
                                        <div class="form-group row">
                                                <label class="col-lg-3 col-form-label">e:</label>
                                                <div class="col-lg-6">
                                                    {!! Form::textarea('answer_e',null,['id'=>'answer_e','class'=>'form-control ','required'=>'required']) !!}
                                                  
                                                </div>
                                        </div>
                                        <div class="form-group row">
                                                <label class="col-lg-3 col-form-label">Tag:</label>
                                                <div class="col-lg-6">
                                                    {!! Form::text('tag',null,['id'=>'tag','class'=>'form-control ','required'=>'required']) !!}
                                                 
                                                </div>
                                        </div>
                                        <div class="form-group row">
                                                <label class="col-lg-3 col-form-label">Penjelasan:</label>
                                                <div class="col-lg-6">
                                                    {!! Form::textarea('desc',null,['id'=>'desc','class'=>'form-control ','required'=>'required']) !!}
                                                  
                                                </div>
                                        </div>
                                        <div class="form-group row">
                                                <label class="col-lg-3 col-form-label">Jawaban:</label>
                                                <div class="col-lg-6">
                                                    {!! Form::select('answer',['1' => 'a','2' => 'b','3' => 'c','4' => 'd','5' => 'e'],null,['id'=>'answer','class'=>'form-control input-sm kt-selectpicker','required'=>'required','data-live-search'=>"true",'placeholder'=>'Pilih Jawaban']) !!}
                                                  
                                                </div>
                                            </div>
                                        <div class="form-group row">
                                            <label class="col-lg-3 col-form-label">Status:</label>
                                            <div class="col-lg-6">
                                                {!! Form::select('status',$status,null,['id'=>'status','class'=>'form-control input-sm kt-selectpicker','required'=>'required','data-live-search'=>"true",'placeholder'=>'Pilih Status']) !!}
                                              
                                            </div>
                                        </div>
                                    </div>
            
                                </div>
                            </div>
                            
                       
               
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" id="simpan" class="btn btn-brand btn-elevate btn-icon-sm">Simpan</button>
            </div>
        </form>
        </div>
    </div>
</div>

@endsection

@push('style')
<style>
        tfoot {
             display: table-header-group;
        }
</style>
@endpush

@push('script')
<script src="{{ Storage::url('assets/backend/vendors/custom/datatables/datatables.bundle.js') }}" type="text/javascript"></script>
<script type="text/javascript">
    var KTBootstrapSelect = function () {
    
    // Private functions
    var demos = function () {
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
            demos(); 
        }
    };
}();

jQuery(document).ready(function() {
    KTBootstrapSelect.init();
    form = $("#form").validate({
        rules: {
            "modul_id": {
                required: true
            },
            "submodul_id": {
                required: true,
                maxlength: 2
            },
            "jenissoal_id": {
                required: true
            },
            "nick": {
                required: true
            },
            "answer_a": {
                required: true
            },
            "answer_b": {
                required: true
            },
            "answer_c": {
                required: true
            },
            "answer_d": {
                required: true
            },
            "answer_e": {
                required: true
            },
            "tag": {
                required: true
            },
            "desc": {
                required: true
            },
            "answer": {
                required: true
            },
            "status": {
                required: true
            }

        },
        messages: {
            "modul_id": {
                required: "Silahkan pilih modul"
            },
            "submodul_id": {
                required: "Silahkan pilih submodul"
            },
            "jenissoal_id": {
                required: "Silahkan pilih bobot"
            },
            "nick": {
                required: "Silahkan tulis nick"
            },
            "answer_a": {
                required: "Silahkan tulis jawaban "
            },
            "answer_b": {
                required: "Silahkan tulis jawaban "
            },
            "answer_c": {
                required: "Silahkan tulis jawaban "
            },
            "answer_d": {
                required: "Silahkan tulis jawaban "
            },
            "answer_e": {
                required: "Silahkan tulis jawaban "
            },
            "tag": {
                required: "Silahkan tulis tag"
            },
            "desc": {
                required: "Silahkan tulis penjelasan"
            },
            "answer": {
                required: "Silahkan pilih jawaban"
            },
            "status": {
                required: "Silahkan pilih status"
            }
        },
        submitHandler: function (form) { 
            table = $('#datatable').DataTable().destroy();
           
            $.ajax({
                type: "post",
                url: "{{ route('materi.pembuatan-soal.insert') }}",
                dataType:"json",
                data: {
                    parent: $("#parent_id").val(),
                    modul_id: $("#modul_id").val(),
                    id: $("#soal_id").val(),
                    soal: $("#soal").val(),
                    submodul: $("#submodul_id").val(),
                    bobot: $("#jenissoal_id").val(),
                    nick: $("#nick").val(),
                    a: $("#answer_a").val(),
                    b: $("#answer_b").val(),
                    c: $("#answer_c").val(),
                    d: $("#answer_d").val(),
                    e: $("#answer_e").val(),
                    tag: $("#tag").val(),
                    answer: $("#answer").val(),
                    status: $("#status").val(),
                    desc: $("#desc").val(),
                },
                beforeSend: function() {
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
                    if(response.status === 200) {
                        view();
                        setTimeout(function() {
                            KTApp.unblock('#add .modal-content');
                            $('#add').modal('hide');
                        }, 2000);
                        
            //          
                    } else if(response.status === 500) {
                        // do something with response.message or whatever other data on error
                    }
                }
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
            ajax: "{{ route('materi.pembuatan-soal.data') }}",
            columns: [
                { data: 'soal_id', render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                } , title: 'No.', width : "3%" },
                { data: 'nick', name: 'nick' , title: 'Nick' },
                { data: 'bobot', name: 'bobot' , title: 'Jenis Soal' },
                { data: 'hit', name: 'hit' , title: 'Hit' },
                { data: 'modul', name: 'modul' , title: 'Modul' },
                { data: 'submodul', name: 'submodul' , title: 'Submodul' },
                { data: 'soal_id', name: 'soal_id' , title: 'ID' },
                { data: 'status', name: 'status' , title: 'Status', width : "10%" },
                { data: 'action', name: 'action' , title: 'Action', width : "15%" }
            ],
            initComplete: function () {
            this.api().columns([4,5]).every( function () {
                var column = this;
                var select = $('<select class="form-control input-sm kt-selectpicker" data-live-search="true" data-live-search-style="startsWith" placeholder="filter by modul"><option value=""></option></select>')
                    .appendTo( $(column.footer()).empty() )
                    .on( 'change', function () {
                        var val = $.fn.dataTable.util.escapeRegex(
                            $(this).val()
                        );
 
                        column
                            .search( val ? '^'+val+'$' : '', true, false )
                            .draw();
                    } );
 
                column.data().unique().sort().each( function ( d, j ) {
                    select.append( '<option value="'+d+'">'+d+'</option>' )
                } );
            } );
        }
    });

    $('#show').click(function(event) {
            alert("a");
            $('#loader').show();
        });
    }

    function get_submodul(modul,submodul){
        $.ajax({
                type: "POST",
                url: "{{ route('materi.pembuatan-soal.modul') }}",
                data: {
                    'id_modul': modul
                },
                beforeSend: function () {
                    KTApp.block('#add .modal-content', {
                    overlayColor: '#000000',
                    type: 'v2',
                    state: 'primary',
                    message: 'Processing...'
                    });
                    $('select#submodul_id').html("<option value=''>Pilih Submodul</option>");
                    $('.kt-selectpicker').selectpicker('refresh');
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (data) {

                    $.each(data, function (index, value) {
                        
                        $('select#submodul_id').append('<option value="' + value.id + '">' + value.name + '</option>');
                        if(submodul!=null){
                             $('select#submodul_id').val(submodul);
                        }
                        $('.kt-selectpicker').selectpicker('refresh');
                        KTApp.unblock('#add .modal-content');
                        $('.bobot').show();
                        // $('.parent').show();
                    });

                }
            });
    }

    function get_parent(jenis_soal_id,parent,modul,submodul){
       
        $.ajax({
                type: "POST",
                url: "{{ route('materi.pembuatan-soal.parent') }}",
                data: {
                    'jenis_soal_id': jenis_soal_id,
                    'modul_id'     : modul,
                    'submodul_id'  : submodul,
                    'soal_id'      : $('#soal_id').val(),
                },
                beforeSend: function () {
                    KTApp.block('#add .modal-content', {
                    overlayColor: '#000000',
                    type: 'v2',
                    state: 'primary',
                    message: 'Processing...'
                    });
                   
                    $('select#parent_id').html("<option value='0'>-- Parent --</option>");
                    $('select#parent_id').selectpicker('refresh');
                   
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (data) {
                    // alert(JSON.stringify(response));
                    alert(parent);
                    KTApp.unblock('#add .modal-content');
                    
                    $.each(data, function (index, v) {
                        
                        $('select#parent_id').append( "<option value='"+ v.soal_id +"' >"+ v.soal_id +" - "+ v.nick +"</option>");
                        if(parent!=null){
                             $('#parent_id').val(parent);
                        }
                        $('select#parent_id').selectpicker('refresh');
                      
                    });

                }
            });
    }

    $(function () {

        view(); //call datatable view

        /* Edit Data */
        $("#datatable").on("click", "tr #edit", function () {
            get_submodul($(this).data('modul'),$(this).data('submodul'));
            get_parent($(this).data('bobot'),$(this).data('parent'),$(this).data('modul'),$(this).data('submodul'));
            

           
            $("#soal_id").val($(this).data('id'));
            $("#modul_id").val($(this).data('modul'));

            $("#soal").val($(this).data('soal'));
            $("#jenissoal_id").val($(this).data('bobot'));
            $("#nick").val($(this).data('nick'));
            $("#answer_a").val($(this).data('a'));
            $("#answer_b").val($(this).data('b'));
            $("#answer_c").val($(this).data('c'));
            $("#answer_d").val($(this).data('d'));
            $("#answer_e").val($(this).data('e'));
            $("#tag").val($(this).data('tag'));
            $("#answer").val($(this).data('jawaban'));
            $("#status").val($(this).data('status'));
            $("#desc").val($(this).data('desc'));
            // $("#parent_id").val();
            $('.summernote').summernote('code', $(this).data('soal'));
            $('.kt-selectpicker').selectpicker('refresh');

            $('#add').modal('show');
            $('.bobot').show();
            $('.parent').show();
        });

        /* New Data Button */
        $('#new').click(function (event) {
            $('form')[0].reset();
            $('.summernote').summernote('code', '');
            $("select#status").val("");
            $('.kt-selectpicker').selectpicker('refresh');
            
        });

        $('select#modul_id').on('change', function () {
            $('select#jenissoal_id').val("").selectpicker('refresh');
            get_submodul(this.value,null);

           

        });

        $('select#submodul_id').on('change', function () {
            $('select#jenissoal_id').val("").selectpicker('refresh');
            // $('select#parent_id').remove("").selectpicker('refresh');
            $('.parent').show();
        });
            
        $('select#jenissoal_id').on('change', function () {
            $('select#parent_id').children().remove();
            $('select#parent_id').selectpicker('refresh');
           
            
            if($('#submodul_id').val()!='' && $('#modul_id').val()!=''){
                get_parent(this.value,null,$('#modul_id').val(),$('#submodul_id').val());
                alert("bobot");

            }

        });

        



    });
    
</script>   
   
@endpush

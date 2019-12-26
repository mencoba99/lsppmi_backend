@extends('layouts.modal.base')
@section('content')
<?php
use App\Models\MgtProgram;
use App\Models\Program;
use App\Models\Modul;
use App\Models\Modul_soal;
use App\Models\Soal;
use App\Models\SubModul;
use App\Models\SoalJenis;
use App\Models\Komposisi_soal;
?>
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
                                                {{ Form::text('program', $program_dtl->first()->name, ['class' => 'form-control program', 'data-id' => $program_dtl->first()->program_id, 'readonly']) }}
                                                {!! $errors->first('program', '<span class="help-block form-messages">:message</span>') !!}
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                            <label class="col-lg-3 col-form-label">Modul:</label>
                                            <div class="col-lg-6">
                                                    
                                                            <?php  
                                                                $var_temp = 0;
                                                                $i        = 0;
                                                            ?>
        
                                                            @foreach($program_dtl as $prog)
                                                                <?php 
                                                                ++$i;
                                                                // get submodul by id 
                                                                $submodul  = MgtProgram::where('program_id', $prog->program_id)
                                                                 ->where('modul_id', $prog->modul_id)
                                                                    ->where('status', 1)
                                                                    ->whereIn('modul_id', function($q){
                                                                        $q->select('id')
                                                                          ->from('competence_units')
                                                                          ->where('status', 1);
                                                                    })
                                                                    ->whereIn('submodul_id', function($r){
                                                                        $r->select('id')
                                                                          ->from('competence_kuk')
                                                                          ->where('status', 1);
                                                                    })
                                                                    ->orderBy('modul_id')
                                                                    ->get();
                                                                     
                                                                $id_program_dtl = MgtProgram::where('program_id', $prog->program_id)
                                                                    ->where('modul_id', $prog->modul_id)
                                                                    ->where('submodul_id', $prog->submodul_id)
                                                                    ->where('status', 1)
                                                                    ->orderBy('modul_id')
                                                                    ->value('id');
                                                                ?>
                                                                
                                                                <!-- Jika modul sama tidak melakukan perulangan -->
                                                                @if($var_temp != $prog->modul_id)
                                                                <div class="accordion accordion-solid accordion-toggle-plus" id="accordion{{ $i }}" data-id="{{$prog->modul_id}}">
                                                                    <div class="card">
                                                                        <div class="card-header">
                                                                                <div class="card-title " data-toggle="collapse" data-parent="#accordion{{ $i }}" href="#collapse_{{ $i }}" aria-expanded="true" aria-controls="collapseOne6"> {{ $prog->modul->name }} (<span class="result"></span> soal) 
                                                                                </div>
                                                                        </div>
        
                                                                        <div id="collapse_{{ $i }}" class="card-collapse in">
                                                                            <div class="card-body">
                                                                                <?php
                                                                                $total_soal_modul = 0;
                                                                                ?>
                                                                                @foreach ($submodul as $key => $val_submodul)
                                                                              
                                                                                <div class="kt-checkbox-list">
                                                                                    
        
                                                                                    <label class="kt-checkbox kt-checkbox--brand">
                                                                                        <input type="checkbox" name="check_modul"
                                                                                            dtl-id="{{ $val_submodul->id }}" data-id="{{  $val_submodul->submodul_id }}" class="check-komposisi" 
                                                                                            {{ !empty($val_submodul->total_soal) ? 'checked' : ''}}>
                                                                                            @foreach ( $val_submodul->submodul as $submodul )
                                                                                                 {{ $submodul->name }}
                                                                                            @endforeach
                                                                                           
                                                                                        <span></span>
                                                                                    </label>
                                                                                    <div class="row komposisi-soal" {{ !empty($val_submodul->total_soal) ? "style=display:block" : "style=display:none"}}>
                                                                                    <div class="col-md-8">
                                                                                        <table class="table table-siak borderless">
                                                                                            <tbody>
                                                                                                <?php
                                                                                                $total_soal_submodul = 0;
                                                                                                ?>
                                                                                                @foreach($total_soal as $val_soal)
                                                                                                
                                                                                               <?php
                                                                                                // get row soal by modul and submodul id
                                                                                                $Modul = Modul_soal::where('modul_id', $val_submodul->modul_id)
                                                                                                    ->where('submodul_id', $val_submodul->submodul_id)
                                                                                                    ->pluck('soal_id');
                                                                                                
                                                                                                // total soal yang menjadi parent soal
                                                                                                $jumlah_parent = Soal::whereIn('soal_id', $Modul)
                                                                                                    ->where('jenis_soal_id', $val_soal->id)
                                                                                                    ->where('aktif', true)->where('parent', '=', '0')->count();
                                                                                                
                                                                                                // total soal yang menjadi anak soal
                                                                                                $jumlah_anak   = Soal::whereIn('soal_id', $Modul)
                                                                                                    ->where('jenis_soal_id', $val_soal->id)
                                                                                                    ->where('aktif', true)
                                                                                                    ->count();
                                                                                                // jumlah soal berdasarkan jenis soal
                                                                                                $jumlah_soal   = Komposisi_soal::where('program_mgt_id', $val_submodul->id)
                                                                                                    ->where('jenis_soal_id',$val_soal->id)
                                                                                                    ->value('jumlah_soal');
                                                                                                $total_soal_submodul += $jumlah_soal;
                                                                                              
                                                                                                ?>

                                                                                                
                                                                                                    <tr>
                                                                                                        <td> Soal <strong>{{ $val_soal->name }}</strong> {{$jumlah_parent}}
                                                                                                        </td>
                                                                                                        <td>:</td>
                                                                                                        <td>
                                                                                                            {{ Form::number('jenis_soal', $jumlah_soal, ['class' => 'form-control jenis_soal','data-id' => $val_soal->id]) }}
                                                                                                            {!! $errors->first('jenis_soal', '<span class="help-block form-messages">:message</span>') !!}
                                                                                                        </td>
                                                                                                        <td>
                                                                                                            <span data-toggle="tooltip" title="Total Parent Soal {{ $val_soal->name }}" style="color:red" class="parent">({{ $jumlah_parent }}) </span>
                                                                                                            <span data-toggle="tooltip" title="Total Soal {{ $val_soal->name }}" style="color:blue" class="anak">({{ $jumlah_anak }}) </span>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                @endforeach
                                                                                                <tr class="total">
                                                                                                    <td> Total Soal </td>
                                                                                                    <td>:</td>
                                                                                                    <td>
                                                                                                        {{ Form::text('total_soal', $total_soal_submodul, ['class' => 'form-control total_soal', 'readonly']) }}
                                                                                                        {!! $errors->first('total_soal', '<span class="help-block form-messages">:message</span>') !!}
                                                                                                    </td>
                                                                                                </tr>
                                                                                                {{-- <tr>
                                                                                                    <td> Persentase Minimal Kelulusan </td>
                                                                                                    <td>:</td>
                                                                                                    <td>
                                                                                                    <div class="input-group">
                                                                                                        {{ Form::text('persentase', $val_submodul->persentase_kelulusan, ['class' => 'form-control persentase']) }}
                                                                                                        {!! $errors->first('persentase', '<span class="help-block form-messages">:message</span>') !!}
                                                                                                        <div class="input-group-addon">
                                                                                                            <span>%</span>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                    </td>
                                                                                                </tr> --}}
                                                                                            </tbody>
                                                                                        </table>
                                                                                    </div>
                                                                                    </div>
                                                                                    
                                                                                </div>
                                                                                <?php $total_soal_modul += $total_soal_submodul; ?>
                                                                                @endforeach
                                                                                {{ Form::text('total_soal_modul', $total_soal_modul, ['class' => 'form-control total_soal_modul hidden','style'=>'display:none']) }}
                                                                            </div>                     
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                @endif
                                                        <?php $var_temp = $prog->modul_id; ?>
                                                            @endforeach
                                                        
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                                <label class="col-lg-3 col-form-label">Jumlah Soal :</label>
                                                <div class="col-lg-6">
                                                        <b><span class="total_semua_soal"></span> Soal</b>
                                                </div>
                                            </div>
                       
                       
                    </div>
                </div>
        </div>
        <div class="modal-footer">
            <button type="button" id="close" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" id="simpan" name="simpan" class=" btn btn-brand btn-elevate btn-icon-sm simpan">Simpan</button>
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

});

  function view(){
    parent.$('#datatable').DataTable().destroy(); // destroy datatable
    /* Datatable View */
    parent.$('#datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('ujian-komputer.management.data') }}",
            columns: [
                { data: 'program_id', render: function (data, type, row, meta) {
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

    $(document).ready(function(){
        $('.total_soal_modul').each(function(i) {
            total_soal_modul = $(this).parent().parent().siblings('.panel-heading').find('.result');
            total_soal_modul.text($(this).val());
        });
        total_jenis_soal = $('.total_soal_modul');
        total_semua = 0;
        $(total_jenis_soal).each(function(i,v) {
            if ($(this).val() !== ''){
                total_semua = parseInt(total_semua) + parseInt($(this).val());
            }
        });
        $('.total_semua_soal').text(total_semua);
        $('.check-komposisi:checkbox:checked').each(function () {
            komposisi = $(this).parent().next('.komposisi-soal');
                if ( $(this).is(':checked') )
                  {
                    $(komposisi).show();
                  }
                  else
                  {
                    $(komposisi).hide();
                  }
        });
        // check checkbox to show forms
        $('.check-komposisi').on('click', function(){
            komposisi = $(this).parent().next('.komposisi-soal');
                if ( $(this).is(':checked') )
                  {
                    $(komposisi).show();
                  }
                  else
                  {
                    $(komposisi).hide();
                  }
            });
        // clear input if exceed total soal by jenis soal
        $('.jenis_soal').on('change paste keyup', function() {
            nilai         = $(this).val();
            jumlah_parent = $(this).parent().next('td').find('.parent').html().replace(/[()]/g, '');
            jumlah_anak   = $(this).parent().next('td').find('.anak').html().replace(/[()]/g, '');
            total         = parseInt(jumlah_anak);
            jumlah_parent = parseInt(jumlah_parent);
            
            if(nilai>jumlah_parent)
            {
                alert('Nilai soal tidak boleh melebihi total soal parent');
                $(this).val('');
            } else if(nilai<0) {
                alert('Nilai Soal Tidak Boleh Kurang Dari 0');
                $(this).val('');
            }
            total_jenis = $(this).parent().parent().parent().find('.jenis_soal');
            jumlah = 0;
            $(total_jenis).each(function(i,v){
                if($(this).val() !== '')
                {
                    
                    jumlah = parseInt(jumlah) + parseInt($(this).val());
                }
            });
            total_soal = $(this).parent().parent().nextAll('.total').find('.total_soal').val(jumlah);
            bergerak = $(this).parent().parent().parent().parent().parent().parent().parent().parent().find('.total_soal');
            soal_bergerak = 0;
            $(bergerak).each(function(i,v) {
                if ($(this).val() !== ''){
                    soal_bergerak = parseInt(soal_bergerak) + parseInt($(this).val());
                }
            });
            soal_modul_bergerak = $(this).parent().parent().parent().parent().parent().parent().parent().parent().parent().siblings('.panel-heading').find('.result');
            soal_modul_bergerak.text(soal_bergerak);
            total_bergerak = 0;
            $('.total_soal').each(function(i,v) {
                if ($(this).val() !== ''){
                    total_bergerak = parseInt(total_bergerak) + parseInt($(this).val());
                }
            });
            $('.total_semua_soal').text(total_bergerak);
            // total_soal = $(this).parent().parent().nextAll('.total').find('.total_soal').val(jumlah);
            // if(total_soal.val() == '')
            // {
            //     total_soal.val(nilai);
            // } else {
            //     total = parseInt(total_soal.val()) + parseInt(nilai);
            //     total_soal.val(total);
            // }
            // $('.jenis_soal').each(function(i,v){
                
            // });
        });
        $('input[name="check_modul"]').on('click', function() {
            if($(this).is(':checked') === false){
                $(this).parent().next('.komposisi-soal').find('.jenis_soal').val('').trigger('change');
                $(this).parent().next('.komposisi-soal').find('.total_soal').val('').trigger('change');
            }
        });

        $('#close').click(function (event) {
            parent.$('#mod-iframe-large').modal('hide');
            parent.$('#iframeModalContent').attr('src', "about:blank");
            // $('#mod-iframe-large', parent.document).modal('hide');
        });

        $('.simpan').on('click', function() {
            // disable button
            // $('button[name="simpan"]').attr('disabled', 'disabled');
            $('#execute-loading').css({'visibility': 'visible'});
            var data         = [];
            var submoduls    = $('input[name="check_modul"]');
            //get value from form each submodul checked 
            submoduls.each(function(i,v) {
                modul_id       = $(this).closest('#accordion-container').attr('data-id');
                submodul_id    = $(this).attr('data-id');
                program_dtl_id = $(this).attr('dtl-id');
                allJenis       = $(this).parent().next('.komposisi-soal').find('.jenis_soal');
                total_soal     = $(this).parent().next('.komposisi-soal').find('.total_soal').val();
                jenis          = [];
                allJenis.each(function(index,el) {
                    subJenis = {};
                    subJenis['jenis_soal_id'] = $(this).attr('data-id');
                    subJenis['jumlah_soal']   = $(this).val();
                    jenis.push(subJenis);
                });
                // create object
                data.push({program_dtl_id: program_dtl_id,modul_id: modul_id, submodul_id: submodul_id,total_soal:total_soal,jenis_soal: jenis});
            });
            console.log(data);
            $.ajax({
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{ route('management.komposisi_store') }}",
                data: {
                    data: data
                },
                beforeSend: function () {
                            KTApp.block('.kt-portlet__body', {
                            overlayColor: '#000000',
                            type: 'v2',
                            state: 'primary',
                            message: 'Processing...'
                        });

                    },
                //dataType: 'json',
                success: function (data) {
                    // alert(JSON.stringify(data));
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
                    }, 2000)).then(function () {
                        // parent.$('#mod-iframe-large').modal('hide');
                        setTimeout(function () {
                            parent.$('#mod-iframe-large').modal('hide');
                        }, 4000);
                    });
                },
                error: function(data) {
                    console.log('Error:', data);
                }
            });
            
        });
    });



</script>

@endpush
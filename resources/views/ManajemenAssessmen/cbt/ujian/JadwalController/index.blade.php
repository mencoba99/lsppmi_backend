@extends('layouts.base')

<link href="https://siak.ticmi.co.id/assets/theme/global/plugins/jquery-multi-select/css/multi-select.css" rel="stylesheet" type="text/css">
@section('content')
<div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">
    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                <span class="kt-portlet__head-icon">
                    <i class="kt-font-brand flaticon2-tag"></i>
                </span>
                <h3 class="kt-portlet__head-title">
                    Jadwal Ujian
                </h3>
            </div>
            <div class="kt-portlet__head-toolbar">
                <div class="kt-portlet__head-wrapper">
                    <div class="kt-portlet__head-actions">
                        <a href={{route('ujian.jadwal.create', '')}}
                            class='btn btn-brand btn-elevate btn-icon-sm modalIframe' id="clearIframe"
                            data-toggle='kt-tooltip' title='Tambah Data'
                            data-original-tooltip='Jadwal Ujian Create Data'>
                            <i class='la la-plus'></i> Tambah
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="kt-portlet__body tabel-provinsi">
            <table
                class="table table-striped- table-bordered table-hover table-checkable dataTable no-footer dtr-inline"
                id="datatable">
                <thead>
                    <tr>
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
                        <td class="nosearch"></td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
 <!-- MODAL BATCH-->
 <div class="modal fade" id="modal_batch"  role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Submodul diujikan </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group form-batch">
                         <span id="loading-modal-batch" style="display:none"><span> &nbsp;&nbsp;Loading... </span></span>
                                           <div class="batch_opsi">
                                               {!! Form::select('batch',[],null,['id'=>'batch','class'=>'form-control kt-selectpicker','required'=>'required','data-live-search'=>"true",'placeholder'=>'Pilih Batch']) !!}
                                            
                                               {!! $errors->first('ruang', '<span class="help-block form-messages">:message</span>'); !!}
                                           </div>
                                     
                             </div>
                             <div class="modsub">
                                 <!-- checklist submodul -->
                             </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary " data-dismiss="modal">Close</button>
                    <button type="submit" id="simpan_submodul" class="btn btn-brand btn-elevate btn-icon-sm">Simpan</button>
                </div>
            </form>
            </div>
        </div>
    </div>


      <!-- MODAL BATCH-->
      <!-- MODAL PESERTA-->
      <div class="modal fade" id="modal_peserta"  role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Peserta Ujian</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        </button>
                    </div>
                    <div class="modal-body">
                            <span id="loading-modal-peserta" style="display:none"><span> &nbsp;&nbsp;Loading... </span></span>
                            <div class="list_peserta">
      
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" id="simpan" class="simpan_peserta btn btn-brand btn-elevate btn-icon-sm">Simpan</button>
                    </div>
                </form>
                </div>
            </div>
        </div>

      
          <!-- MODAL PESERTA-->

          <!-- MODAL PENGAWAS-->
          <div class="modal fade" id="modal_pengawas"  role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Peserta Ujian</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group form-pengawas">
                            <table class="table table-siak borderless">
                               <tbody>
                                  <tr>
                                     <td>
                                       <span id="loading-modal-pengawas" style="display:none"><span> &nbsp;&nbsp;Loading... </span></span>
                                       <div class="pengawas_opsi">
                                         <div class="form-group">
                                           <label><h5><strong>Pengawas</strong></h5></label>
                                           {{Form::select('pengawas', [], null, ['class'=> 'form-control kt-selectpicker pengawas','data-live-search'=>"true"])}}
                                            <span id="loading-pengawas" style="display:none">Loading...</span>
                                         </div>
                                         <div class="form-group">
                                           <label><h5><strong>Keyboard Lock</h5></strong></label>
                                           {{ Form::select('keyboard_lock', ['t' => 'Aktif', 'f' => 'Tidak Aktif'], null, ['class' => 'form-control kt-selectpicker keyboard_lock']) }}
                                         </div>
                                           
                                       </div>
                                     </td>
                                  </tr>
                               </tbody>
                             </table>
                         </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
<<<<<<< Updated upstream
                        <button type="submit" id="simpan" class=" btn btn-brand btn-elevate btn-icon-sm">Simpan</button>
=======
                        <button type="submit" id="simpan" class="btn btn-brand btn-elevate btn-icon-sm">Simpan</button>
>>>>>>> Stashed changes
                    </div>
                </form>
                </div>
            </div>
        </div>

          <!-- MODAL PENGAWAS-->
@endsection

@push('script')
<script src="{{ Storage::url('assets/backend/vendors/custom/datatables/datatables.bundle.js') }}" type="text/javascript"></script>
<script src="https://siak.ticmi.co.id/assets/theme/global/plugins/jquery-multi-select/js/jquery.multi-select.js" type="text/javascript"></script>

<script type="text/javascript">
    var KTBootstrap = function () {
        // Private functions
        var config = function () {
            $('.kt-selectpicker').selectpicker({
                liveSearch: true,
                showSubtext: true
            });
        }
        return {
            init: function () {
                config();
            }
        };
    }();

    jQuery(document).ready(function() {
        KTBootstrap.init();
    });

    function view(){
    $('#datatable').DataTable().destroy(); // destroy datatable
    /* Datatable View */
    $('#datatable').DataTable({
            processing: true,
            searchDelay: 500,
            serverSide: true,
            responsive: true,
            ajax: "{{ route('ujian.jadwal.data') }}",
            columns: [
                {data: 'rownum', searchable: false, width : "3%"},
                { data: 'nama', name: 'perdana_jadwal.nama' , title: 'Nama ' },
                { data: 'tgl_perdana', name: 'tgl_perdana' , title: 'Tgl Perdana ' },
                { data: 'nama_ruang', name: 'nama_ruang' , title: 'Nama TUK ' },
                { data: 'nama_hari', name: 'nama_hari' , title: 'Hari ' },
                { data: 'nama_jam', name: 'nama_jam' , title: 'Jam ' },
                { data: 'action', name: 'action' , title: 'Action', width : "15%" },
            ],
            "drawCallback": function(settings) {
				//
            }, 
    });

    $('#clearIframe').click(function(event) {
            $('#loader').show();
    });
    }


    $(function() {
        view(); //call datatable view
        $('body').on('click', '.fa-plus-circle', function() {
          var button = $(this);
          $(this).removeClass('fa-plus-circle');
          $(this).addClass('fa-ban');
          var uptr = $(this).closest('tr');
          var jadwal_id = $(this).attr('data-jadwal');
          load = '<tr id="temp"> <td colspan="7"><span><span> &nbsp;&nbsp;Loading... </span></span></td></tr>';
          $(load).insertAfter(uptr);
          $.ajax({
            method: 'GET',
            url: '{{ route('ujian.jadwal.batch') }}',
            data: {jadwal_id: jadwal_id},
            success: function(msg){
              var obj_batch     = JSON.parse(msg);
              var app = '<tr> <td colspan="7"> <div class="accordion accordion-solid accordion-toggle-plus" id="accordion'+jadwal_id+'">';
              $.each(obj_batch, function(i, v) {
                app += '<div class="card"><div class="card-header"><div class="card-title collapsed" data-toggle="collapse" data-parent="#accordion'+jadwal_id+'" href="#collapse_3_'+jadwal_id+i+'" aria-expanded="true" aria-controls="collapseOne6">  <i class="flaticon-pie-chart-1"></i>'+v.nama_batch+' </div> </div><div id="collapse_3_'+jadwal_id+i+'" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">';
                app +='<div class="card-body">';
                modsub = v.modsub;
                app += '<h4 class="block text-left"><strong>Submodul diujikan</strong></h4>'
                $.each(modsub, function(i_mod, v_mod) {
                    app += '<div class="col-md-12 text-left"><div class="form-group"><table class="table table-siak borderless"> <tbody> <tr> <td class="checkmod"><strong>'+v_mod.nama_modul+'</strong><div class="kt-checkbox-list">';
                    submodul = v_mod.submodul;
                    $.each(submodul, function(i_sub, v_sub) {
                        app += '<label class="kt-checkbox kt-checkbox--brand"><p class="text-left">'+v_sub.nama_submodul+'</p><input type="checkbox" checked disabled> <span></span></label>';
                    });
                    app += '</div></td></tr></tbody></table></div></div>';
                });
                app += '<h4 class="block text-left"><strong>Peserta Ujian</strong></h4><table class="table table-bordered table-hover"> <thead> <tr> <th> No </th> <th> Nama </th> <th class="text-left"> Email </th> </tr></thead> <tbody>';
                peserta = v.peserta;
                $.each(peserta, function(x, y) {
                  no = x+1;
                  app += '<tr>';
                  app += '<td class="text-left"> '+no+' </td>';
                  app += '<td class="text-left"> '+y.nama_peserta+' </td>';
                  app += '<td style="text-align:left !important"> '+y.email_peserta+' </td>';
                  app += '</tr>';
                });
                app += '</tbody></table></div></div></div>';
              });
              app += '</div></td></tr>';
              $(uptr).next('#temp').remove();
              $(button).removeClass('fa-ban');
              $(button).addClass('fa-minus-circle');
              $(app).insertAfter(uptr);
            },
            error: function(err){
              alert(JSON.stringify(err));
            }
          });
        });

        $('body').on('click', '.fa-minus-circle', function() {
          $(this).removeClass('fa-minus-circle');
          $(this).addClass('fa-plus-circle');
          nexttr = $(this).closest('tr').next('tr');
          $(nexttr).remove();
        });

        $('body').on('click', '.group-checkable', function() {
            modul_id = $(this).val();
            check = $(this).parent().next().find('.submodul');
            checked = $(this).is(":checked");
            if(checked) {
              $.each(check, function() {
                $(this).prop('checked', true);
              });
            } else {
              $.each(check, function() {
                $(this).prop('checked', false);
              });
            }
        });

        $('body').on('change', '#batch', function() {
          batch      = $(this).val().trim();
        //   alert(batch);
          jadwal_id  = $('.modsub').attr('data-jadwal');
          if(batch)
          {
              $('#loading-batch').css({'display': 'block'});
              $.ajax({
                method: 'GET',
                url: '{{ route('ujian.jadwal.submodul') }}',
                data: {batch: batch,
                        jadwal_id:jadwal_id},
                success: function(msg){
                  $('.modsub').empty();
                  $('#loading-batch').css({'display': 'none'});
                  
                  list_modsub     = JSON.parse(msg);
                  app = '';
                  if(list_modsub.length > 0){
                    $.each(list_modsub, function(i,v){
                      app += '<div class="form-group"><table class="table table-siak borderless"> <tbody> <tr> <td>';
                      app += "<label class='kt-checkbox kt-checkbox--brand'><strong>"+v.nama_modul+"</strong>";
                      app += "<input type='checkbox' value='"+ v.modul_id +" 'class='group-checkable modul' count_sub='"+v.submodul.length+"'> <span></span>";
                        app += "</label>";
                      app += "<div modul-id = '"+ v.modul_id +"' class='kt-checkbox-list'>"
                       $.each(v.submodul, function(isub,vsub){
                        app += "<label class='kt-checkbox kt-checkbox--brand' style='margin-left:20px'>"+ vsub.nama_submodul;
                        app += "<input type='checkbox' modul-id = '"+ v.modul_id +"' value='"+ vsub.submodul_id +"' class='submodul'> <span></span>";
                        app += "</label>";
                       });
                      app += "</div></tr></tbody></table></div>";
                    });
                  }else{
                    app = "";
                  }
                  $('.modsub').append(app);
                },
                error: function(err){
                  console.log(JSON.stringify(err));
                  $('#loading-modsub').css({'display': 'none'});
                }
              });
          }
        });

        $('body').on('click', '.edit_modal_batch', function() {
           
            jadwal_id = $(this).attr('data-jadwal');
            $('.modsub').removeAttr('data-jadwal');
            $('.modsub').attr('data-jadwal', jadwal_id);
            $('.modsub').empty();
            $(".batch_opsi").hide();
            $("select[name='batch']").html('');
            $('#loading-modal-batch').css({'display': 'block'});
            $('#modal_batch').modal('toggle');
            $.ajax({
                    method: 'GET',
                    url: '{{ route('ujian.jadwal.program') }}',
                    data: {jadwal_id: jadwal_id},
                    success: function(msg){
                        obj_batch = JSON.parse(msg);
                        list_batch = "<option value=''></option>";
                        if (obj_batch.length > 0) {
                            $.each(obj_batch, function (i, v) {
<<<<<<< Updated upstream
                                list_batch += "<option value='" + v.id + "'>" + v.name + "</option>";
=======
                                list_batch += "<option value='" + v._id + "'>" + v.name + "</option>";
>>>>>>> Stashed changes
                            });
                        } else {
                            list_batch = "<option></option>";
                        }
                       
                        $('#loading-modal-batch').css({'display': 'none'});
                        $(".batch_opsi").show();
                        $("select[name='batch']").html(list_batch);
                        $('.kt-selectpicker').selectpicker('refresh');
                        
                    },
                    error: function(err){
                        alert(JSON.stringify(err));
                    }
                });
        });

        $('body').on('click', '.opt-peserta', function() {
            var count = $('#my_multi_select2 :selected').length;
            $('#total_kapasitas').html(count); 
            if(kapasitas == count)
            {
                $('#modal_peserta').modal('toggle');
                swal({ 
                  title: "Peringatan",
                   text: "Total Peserta Mencapai Kapasitas Ruang",
                    type: "warning" 
                  },
                  function(){
                    $('#modal_peserta').modal('toggle');
                });
            }
        });

        $('body').on('click', '.simpan_peserta', function() {
          jadwal_id      = $('.list_peserta').attr('data-jadwal');
          count          = $('#my_multi_select2 :selected');
          optgroup       = $('.optgroup-peserta');
          loading        = $('.loading-peserta');
          tombol         = $(this);
          loading.css('display', '');
          loading.css({'visibility': 'visible'});
          tombol.attr('disabled', 'disabled');
          
          ujian_batch_id = [];
          $.each(optgroup, function(i,v){
            ujian_batch_id[i] = $(this).attr('ujian-batch');
          });
          arr = [];
          $.each(count, function(i,v){
            obj = {};
            obj['peserta_id']     = $(this).val();
            obj['ujian_batch_id'] = $(this).attr('ujian-batch');
            arr.push(obj);
            //arr[i] = $(this).val();
          });
            $.ajax({
              type: "POST",
              headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              },
              url: '{{ route('ujian.jadwal.peserta_store') }}',
              data: {data: arr,
                     ujian_batch_id: ujian_batch_id
                 },
              dataType: 'json',
              success: function(msg){
                loading.css({'display': 'none'});
                tombol.removeAttr('disabled');
                $('#modal_peserta').modal('toggle');
                swal("Data Updated!", "", "success");
                // $('#perdana-table').DataTable().ajax.reload();
              },
              error: function(err){
                alert(JSON.stringify(err));
                loading.css({'display': 'none'});
              }
            });
         });

        $('body').on('click', '.edit_modal_pengawas', function() {
            jadwal_id = $(this).attr('data-jadwal');
            $('.form-pengawas').removeAttr('data-jadwal');
            $('.form-pengawas').attr('data-jadwal', jadwal_id);
            $(".pengawas_opsi").hide();
            $("select[name='pengawas']").html('');
            $('#loading-modal-pengawas').css({'display': 'block'});
            $('#modal_pengawas').modal('toggle');
            $.ajax({
                    method: 'GET',
                    url: '{{ route('ujian.jadwal.pengawas') }}',
                    data: {jadwal_id: jadwal_id},
                    success: function(msg){
                        obj_pengawas     = JSON.parse(msg);
                        list_pengawas    = "<option value=''></option>";
                        if(obj_pengawas.length > 0){
                            $.each(obj_pengawas, function(i,v){
                              if(v.hasOwnProperty("id")) {
                                list_pengawas += "<option value='"+ v.id +"' "+ v.selected +">"+ v.name +"</option>";
                              }
                              if(v.hasOwnProperty("keyboard_lock")) {
                                if(v.keyboard_lock == 't') {
                                  $("select[name='keyboard_lock']").val('t').trigger('change');
                                } else {
                                  $("select[name='keyboard_lock']").val('f').trigger('change');
                                }
                              }
                            });
                        }else{
                            list_pengawas = "<option></option>";
                        }
                        $('#loading-modal-pengawas').css({'display': 'none'});
                        $(".pengawas_opsi").show();
                        $("select[name='pengawas']").html(list_pengawas);
                        
                    },
                    error: function(err){
                        alert(JSON.stringify(err));
                    }
                });
        });

        $('body').on('click', '.opt-peserta', function() {
            var count = $('#my_multi_select2 :selected').length;
            $('#total_kapasitas').html(count); 
            if(kapasitas == count)
            {
                $('#modal_peserta').modal('toggle');
                swal({ 
                  title: "Peringatan",
                   text: "Total Peserta Mencapai Kapasitas Ruang",
                    type: "warning" 
                  },
                  function(){
                    $('#modal_peserta').modal('toggle');
                });
            }
        });

        $('body').on('click', '.edit_modal_pengawas', function() {
            jadwal_id = $(this).attr('data-jadwal');
            $('.form-pengawas').removeAttr('data-jadwal');
            $('.form-pengawas').attr('data-jadwal', jadwal_id);
            $(".pengawas_opsi").hide();
            $("select[name='pengawas']").html('');
            $('#loading-modal-pengawas').css({'display': 'block'});
            $('#modal_pengawas').modal('toggle');
            $.ajax({
                    method: 'GET',
                    url: '{{ route('ujian.jadwal.pengawas') }}',
                    data: {jadwal_id: jadwal_id},
                    success: function(msg){
                        obj_pengawas     = JSON.parse(msg);
                        list_pengawas    = "<option value=''></option>";
                        if(obj_pengawas.length > 0){
                            $.each(obj_pengawas, function(i,v){
                              if(v.hasOwnProperty("id")) {
                                list_pengawas += "<option value='"+ v.id +"' "+ v.selected +">"+ v.name +"</option>";
                              }
                              if(v.hasOwnProperty("keyboard_lock")) {
                                if(v.keyboard_lock == 't') {
                                  $("select[name='keyboard_lock']").val('t').trigger('change');
                                } else {
                                  $("select[name='keyboard_lock']").val('f').trigger('change');
                                }
                              }
                            });
                        }else{
                            list_pengawas = "<option></option>";
                        }
                        $('#loading-modal-pengawas').css({'display': 'none'});
                        $(".pengawas_opsi").show();
                        $("select[name='pengawas']").html(list_pengawas);
                        
                    },
                    error: function(err){
                        alert(JSON.stringify(err));
                    }
                });
        });

        $('body').on('click', '.edit_modal_peserta', function() {

            
            sesi_id   = $(this).attr('data-jadwal');
            kapasitas = $(this).attr('kapasitas');
            $('.list_peserta').removeAttr('data-jadwal');
            $('.list_peserta').attr('data-jadwal', sesi_id);
            $('#loading-modal-peserta').css({'display': 'block'});
            $('.list_peserta').empty();
            $('#modal_peserta').modal('toggle');
            $.ajax({
            method: 'GET',
            url: '{{ route('ujian.jadwal.peserta') }}',
            data: {
                sesi_id: sesi_id
            },
            success: function (msg) {
                $('#loading-modal-peserta').css({
                    'display': 'none'
                });


                list_peserta = JSON.parse(msg);
<<<<<<< Updated upstream
                // alert(JSON.stringify(list_peserta));
=======
                
>>>>>>> Stashed changes
                peserta = '';
                peserta += '<div class="form-group form-peserta"> <table class="table table-siak borderless">';
                peserta += '<tbody> <tr> <td> <div class="col-md-offset-2" style="margin-left: 25%;">';
                peserta += '<h4><strong><span>Peserta Batch</span>  <span style="margin-left: 75px;">Peserta Ujian</span></strong></h4>';
                peserta += '<select multiple="multiple" class="multi-select" id="my_multi_select2" name="my_multi_select2[]">';
                if (list_peserta.length > 0) {
                    $.each(list_peserta, function (i, v) {
                        
                        peserta += '<optgroup class="optgroup-peserta" batch-id="' + v.id_batch + '" ujian-batch="' + v.ujian_batch_id + '" label="' + v.nama_batch + '">';
<<<<<<< Updated upstream
                
                        $.each(v.peserta_selected, function (m, n) {
                            peserta += '<option class="opt-peserta" ujian-batch="' + v.ujian_batch_id + '" value="' + v.id_batch + '_' + n.peserta_id + '" disabled selected>' + n.nama + '</option>';
                        });

                        $.each(v.peserta, function (x, y) {
                            peserta += '<option class="opt-peserta" ujian-batch="' + v.ujian_batch_id + '" value="' + v.id_batch + '_' + y.peserta_id + '">' + y.nama + '</option>';
                        
=======
                        $.each(v.peserta, function (x, y) {
                            peserta += '<option class="opt-peserta" ujian-batch="' + v.ujian_batch_id + '" value="' + v.id_batch + '_' + y.peserta_id + '">' + y.nama + '</option>';
                        });
                        $.each(v.peserta_selected, function (m, n) {
                            peserta += '<option class="opt-peserta" ujian-batch="' + v.ujian_batch_id + '" value="' + v.id_batch + '_' + n.peserta_id + '" disabled selected>' + n.nama + '</option>';
>>>>>>> Stashed changes
                        });
                        peserta += '</optgroup>';
                    });
                    peserta += '</select>';
                    peserta += '</div></td></tr></tbody></table></div>';
                    peserta += '<div class="form-group form-kapasitas"> <table class="table table-siak borderless"> <tbody> <tr> <td> <strong>Total Peserta&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <span id="total_kapasitas">0</span> Orang</strong> </td></tr></tbody> </table></div>';
                } else {
                    peserta = "";
<<<<<<< Updated upstream
                }
                $('.list_peserta').append(peserta);
                $('#my_multi_select2').multiSelect();
                var count = $('#my_multi_select2 :selected').length;
               
                $('#total_kapasitas').html(count);
            },
            error: function (err) {
                console.log(JSON.stringify(err));
            }
            });
            });

            $('body').on('click', '#simpan_submodul', function() {
             

                var jadwal_id = $('.modsub').attr('data-jadwal');
                var submodul  = $('.submodul:checked');
                var modalhead = $('.modal-submodul');
                var tombol    = $(this);
                var loading   = $('.loading-submodul');
                var batch     = $('#batch').val();
                
                input = [];
                $.each(submodul, function(i,v){
                    checked = {};
                    checked['modul_id'] = $(this).attr('modul-id');
                    checked['submodul_id'] = $(this).val();
                    input.push(checked);
                });
                if(input.length === 0) {
                    alert('Centang salah satu submodul yang diujikan');
                } else {
                    loading.css('display', '');
                    loading.css({'visibility': 'visible'});
                    tombol.attr('disabled', 'disabled');
                    $.ajax({
                    type: "POST",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: '{{ route('ujian.jadwal.submodul_store') }}',
                    data: {modsub: input,
                            batch: batch,
                            jadwal_id: jadwal_id, 
                        },
                    dataType: 'json',
                    success: function(msg){
                        loading.css({'display': 'none'});
                        tombol.removeAttr('disabled');
                        modalhead.modal('toggle');
                        swal("Data Updated!", "", "success");
                        $('#dataTable').DataTable().ajax.reload();
                    },
                    error: function(err){
                        alert(JSON.stringify(err));
                        loading.css({'display': 'none'});
                    }
                    });
                }
        });


        $('body').on('click', '.simpan_pengawas', function() {
          var jadwal_id     = $('.form-pengawas').attr('data-jadwal');
          var modalhead     = $('.modal-pengawas');
          var tombol        = $(this);
          var loading       = $('.loading-pengawas');
          var pengawas      = $('.pengawas').val();
          var keyboard_lock = $('.keyboard_lock').val();
          if(pengawas == '') {
            alert('Mohon pilih salah satu pengawas');
          } else {
            loading.css({'visibility': 'visible'});
            tombol.attr('disabled', 'disabled');
            $.ajax({
              type: "POST",
              headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              },
              url: '{{ route('ujian.jadwal.pengawas_store') }}',
              data: {pengawas: pengawas,
                     keyboard_lock: keyboard_lock,
                     jadwal_id: jadwal_id, 
                   },
              dataType: 'json',
              success: function(msg){
                loading.css({'visibility': 'hidden'});
                tombol.removeAttr('disabled');
                modalhead.modal('toggle');
                swal("Data Updated!", "", "success");
                $('#dataTable').DataTable().ajax.reload();
              },
              error: function(err){
                alert(JSON.stringify(err));
                loading.css({'display': 'none'});
              }
            });
          }
        });
=======
                }
                $('.list_peserta').append(peserta);
                $('#my_multi_select2').multiSelect();
                var count = $('#my_multi_select2 :selected').length;
                alert(count);
                $('#total_kapasitas').html(count);
            },
            error: function (err) {
                console.log(JSON.stringify(err));
            }
            });
            });
>>>>>>> Stashed changes
    });

</script>

@endpush

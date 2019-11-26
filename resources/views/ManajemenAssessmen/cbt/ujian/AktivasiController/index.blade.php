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
                    Aktivasi Ujian
                </h3>
            </div>
            <div class="kt-portlet__head-toolbar">
                <div class="kt-portlet__head-wrapper">
                    <div class="kt-portlet__head-actions">
                       
                    </div>
                </div>
            </div>
        </div>
        <div class="kt-portlet__body tabel-provinsi">
            <table
                class="table table-striped- table-bordered table-hover table-checkable dataTable no-footer  dtr-inline"
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
<div class="modal fade" id="modal_aktivasi"  role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">
                        <span id="loading-modal-aktivasi" style="display:none"><span> &nbsp;&nbsp;Loading... </span></span>
                        <div class="content_aktivasi">

                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" id="simpan" class="submit btn btn-brand btn-elevate btn-icon-sm simpan_aktivasi">Simpan</button>
                </div>
            </form>
    
    
            </div>
        </div>
    </div>
@endsection

@push('script')
<script src="{{ Storage::url('assets/backend/vendors/custom/datatables/datatables.bundle.js') }}" type="text/javascript"></script>
<script type="text/javascript">
    var KTBootstrap = function () {
        // Private functions
        var config = function () {
           
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
            serverSide: true,
            ajax: "{{ route('ujian.aktivasi.data') }}",
            columns: [
                { data: 'perdana_jadwal_id', render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                } , title: 'No.', width : "3%" },
                { data: 'nama_perdana_jadwal', name: 'nama_perdana_jadwal' , title: 'Nama ' },
                { data: 'tgl_perdana', name: 'tgl_perdana' , title: 'Tgl' },
                { data: 'nama_ruang', name: 'nama_ruang' , title: 'TUK' },
                { data: 'nama_hari', name: 'nama_hari' , title: 'Hari' },
                { data: 'nama_jam', name: 'nama_jam' , title: 'Jam' },
                { data: 'action', name: 'action' , title: 'Action', width : "15%" },
            ]
    });

    $('#clearIframe').click(function(event) {
            $('#loader').show();
        });
    }

    $(function() {
        view(); //call datatable view
        $('body').on('click', '.aktivasi_peserta', function() {
          var jadwal_id = $(this).attr('data-jadwal');
          $('.content_aktivasi').empty();
          $('#loading-modal-aktivasi').css({'display': 'block'});
          $('#modal_aktivasi').modal('toggle');
          $.ajax({
            method: 'GET',
            url: '{{ route('ujian.aktivasi.peserta') }}',
            data: {jadwal_id: jadwal_id},
            success: function(msg){
              var obj_batch     = JSON.parse(msg);
              var app = '';
              if(obj_batch.length > 0){
                app += '<div class="panel-group accordion" id="accordion'+jadwal_id+'">';
                $.each(obj_batch, function(i, v) {
                    app += '<div class="panel panel-default" data-ujian-batch="'+v.ujian_batch_id+'" data-batch="'+v.id_batch+'"><div class="panel-heading"> <h4 class="panel-title" style="text-align:left"> <a class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#accordion'+v.id_batch+'" href="#collapse_3_'+v.id_batch+'" aria-expanded="false"> '+v.nama_batch+' </a> </h4> </div><div id="collapse_3_'+v.id_batch+'" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">';
                    app +='<div class="panel-body">';
                    app += '<h4><strong>Peserta Ujian</strong></h4>';
                    app += '<table class="table table-bordered table-hover"> <thead> <tr>';
                    app += '<th><label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">';
                    app += '<input type="checkbox" class="group-checkable" value="'+v.id_batch+'"/>';
                    app += '<span></span></label></th>';
                    app += '<th> Nama </th> <th class="text-left"> Email </th> </tr></thead> <tbody>';
                    peserta = v.peserta;
                    if(peserta.length == false)
                      {
                        app += '<tr data-batch="'+v.id_batch+'">';
                        app += '<td colspan="3"><center>Tidak Ada Peserta</center></td>';
                        app += '</tr>';
                      }
                    $.each(peserta, function(x, y) {
                        app += '<tr data-batch="'+v.id_batch+'">';
                        app += '<td cols="1"><label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">';
                        app += '<input type="checkbox" class="checkboxes" value="'+y.peserta_id+'" />';
                        app += '<span></span></label></td>';
                        app += '<td> '+y.nama_peserta+' </td>';
                        app += '<td> '+y.email_peserta+' </td>';
                        app += '</tr>';             
                    });
                    app += '</tbody></table></div></div></div>';
                });
                    app += '</div></td></tr>';
              } else {
                app = '<h4>Tidak Ada Peserta</h4>';
              }
              $('#loading-modal-aktivasi').css({'display': 'none'});
              $('.content_aktivasi').append(app);
            },
            error: function(err){
              alert(JSON.stringify(err));
            }
          });
        });
        $('body').on('click', '.group-checkable', function() {
            batch_id = $(this).val();
            check = $('tr[data-batch="' + batch_id + '"]').find('.checkboxes');
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
        $('body').on('click', '.simpan_aktivasi', function() {
            if ($('.checkboxes:checked').length == false)
            {
                alert('Mohon Centang Salah Satu Peserta');
            } else {
                $('#loading-aktivasi').css({'display': 'block'});
                $('.simpan_aktivasi').attr('disabled', 'disabled');
                all_batch = $('.panel-default');
                arr = []; 
                $.each(all_batch, function(i,v) {
                    batch_id        = $(this).attr('data-batch');
                    ujian_batch_id  = $(this).attr('data-ujian-batch');
                    checked_peserta = $('tr[data-batch="' + batch_id + '"]').find('.checkboxes:checked');
                    
                    ar= {};
                    ar['id_batch'] = batch_id;
                    ar['ujian_batch_id'] = ujian_batch_id;
                    ar['peserta'] = [];
                    $.each(checked_peserta, function(i,v) {
                        a = {};
                        a['peserta_id'] = $(this).val();
                        ar['peserta'].push(a);
                    })
                    
                    arr.push(ar);
                })
                var data = arr;
                $.ajax({
                  type: "POST",
                  headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  },
                  url: '{{ route('ujian.aktivasi.insert') }}',
                  data: {data: data},
                  dataType: 'json',
                  success: function(msg){
                    if(msg.status = "Data Updated")
                    {
                        $('#loading-aktivasi').css({'display': 'none'});
                        $('.simpan_aktivasi').removeAttr('disabled');
                        $('.modal-aktivasi').modal('toggle');
                        swal("Data Updated!", "", "success");
                        $('#datatable').DataTable().ajax.reload();
                    } else {
                        $('#loading-aktivasi').css({'display': 'none'});
                        $('.simpan_aktivasi').removeAttr('disabled');
                        $('.modal-aktivasi').modal('toggle');
                        swal("Data Failed to Updated!", "", "error");
                        $('#datatable').DataTable().ajax.reload();
                    }
                  },
                  error: function(err){
                    alert(JSON.stringify(err));
                    $('#loading-aktivasi').css({'display': 'none'});
                    $('.simpan_aktivasi').removeAttr('disabled');
                    $('.modal-aktivasi').modal('toggle');
                    swal("Data Failed to Updated!", "", "error");
                    $('#datatable').DataTable().ajax.reload();
                  }
                });
            }
        });
    });

</script>

@endpush

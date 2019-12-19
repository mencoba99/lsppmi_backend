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
                    Jadwal Ujian
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
                                    {!! Form::text('id',null,['id'=>'id','class'=>'form-control','hidden'=>'hidden'])!!}
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label">TUK:</label>
                                <div class="col-lg-6">
                                    {!!
                                    Form::select('tuk_id',$ruang,null,['id'=>'tuk_id','class'=>'form-control
                                    input-sm
                                    kt-selectpicker','required'=>'required','data-live-search'=>"true",'placeholder'=>'Pilih
                                    TUK']) !!}
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label">Rentang Tanggal:</label>
                                <div class="col-lg-6">
                                        <div class="input-group date-picker input-daterange" data-date-format="dd-mm-yyyy">
                                                <input type="text" class="form-control tgl_awal" readonly name="tgl_awal">
                                                <span class="input-group-addon"> s/d </span>
                                                <input type="text" class="form-control tgl_akhir" readonly name="tgl_akhir">
                                            </div>
                                    
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label">Aktif?:</label>
                                <div class="col-lg-6">
                                    <div class="kt-portlet__head-toolbar">
                                        <div class="kt-portlet__head-actions">
                                            <span class="kt-switch kt-switch--icon">
                                                <label>
                                                    <input type="checkbox" data-url="" name="aktif" id="aktif"
                                                        class="roleParentChange roleList">
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
                <div class="container">
                        <div class="row justify-content-md-center">
                                <div class="col-md-8">
                                        <div class="kt-portlet kt-portlet--bordered ">
                                                <div class="kt-portlet__head">
                                                    <div class="kt-portlet__head-label">
                                                        <h3 class="kt-portlet__head-title">
                                                            Hari
                                                        </h3>
                                                    </div>
                                                    <div class="kt-portlet__head-toolbar">
                                                        <ul class="nav nav-pills nav-pills-sm" role="tablist">
                                                                <?php
                                                                // tabs senin - minggu
                                                                foreach ($hari as $key => $data) {
                                                                ?>
                                                                    <li class="nav-item ">
                                                                        <a class="title_hari nav-link {{ ($key == 0) ? 'active' : '' }}" data-day="{{ $data->name }}" data-toggle="tab" href="#hari_{{ $key }}" role="tab">
                                                                                {{ $data->name }}
                                                                            </a>
                                                                    </li>
                                                                <?php
                                                                }
                                                                ?>
                                        
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="portlet-body">
                                                    <ul class="nav nav-tabs">
                                                   
                                                    </ul>
                                                    <div class="tab-content">
                                                        
                                                        <?php
                                                        // detail senin - minggu
                                                        foreach ($hari as $key2 => $data2) {
                                                        ?>
                                                        
                                                            <div class="tab-pane show {{ ($key2 == 0) ? 'active' : '' }}" id="hari_{{ $key2 }}" data-day="{{ $data2->name }}">
                                                                <div class="row justify-content-md-center">
                                                                    <br>
                                                                    <div class="col-md-10">
                                                                        <div class="form-group row listhari {{ $data2->name }}">
                                                                            <?php
                                                                            $columns            = 2;
                                                                            $jam_leng           = $jams->count();
                                                                            $data_per_columns   = ceil($jam_leng/$columns); // round up
                                                                            foreach ($jams as $index => $value) {
                                                                                // first column
                                                                               
                                                                                if($index == 0)
                                                                                    echo '<div class="col-md-4"><div class="kt-checkbox-list">';
                                                                                // second column and more
                                                                                if($index > 0 && ($index % $data_per_columns == 0))
                                                                                    echo '</div></div><div class="col-md-4"><div class="kt-checkbox-list">';
                                                                            ?>
                                                                          
                                                                                {{-- <label class="mt-checkbox mt-checkbox-outline">
                                                                                    <input type="checkbox" class="jam_dalam_hari" name="jam_hari_{{ $data2->hari_id }}[]" value="{{ $value->jam_id.'|'.$data2->hari_id }}" disabled="disabled"> {{ $value->name }}
                                                                                    <span></span>
                                                                                </label> --}}
                                                                                <label class="kt-checkbox ">
                                                                                    <input type="checkbox" class="jam_dalam_hari" name="jam_hari[]" value="{{ $value->jam_id.'|'.$data2->hari_id }}" disabled="disabled"> {{ $value->name }}
                                                                                    <span></span>
                                                                                </label>
                                        
                                                                            <?php
                                                                                if(($index+1) == $jam_leng)
                                                                                    echo '</div></div>';
                                                                            }
                                                                            ?>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        <?php 
                                                        }
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                  </div>
                        </div>
                       
                      </div>
               
                <div class="col-md-6 ">
                       
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


<!-- end:: Content -->
@endsection

@push('modal-script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.2.1/jstree.min.js"></script>
<script src="{{ Storage::url('assets/backend/vendors/custom/datatables/datatables.bundle.js') }}"
    type="text/javascript"></script>
<script type="text/javascript">
    var ElementInit = function () {
        function addDays(date, days) {
                var result = new Date(date);
                    result.setDate(result.getDate() + days);
                return result;
        }
        function uniq(a) {
                var seen = {};
                return a.filter(function(item) {
                    return seen.hasOwnProperty(item) ? false : (seen[item] = true);
                });
        }
        // Private functions
        var element = function () {
            $('.kt-selectpicker').selectpicker().change(function () {
                $(this).valid()
            });

            $('.input-daterange').datepicker({autoclose:true})
            .on('changeDate', function(e) {
                $('.title_hari').css('background-color', '');
                $('.listhari :input').removeAttr('checked'  );
                $('.listhari :input').attr('disabled', true);
                // $('.title_hari').removeClass('active');
                // $('.tab-pane').removeClass('active');
                var weekday    = new Array(7);
                weekday['Sun'] =  "Minggu";
                weekday['Mon'] = "Senin";
                weekday['Tue'] = "Selasa";
                weekday['Wed'] = "Rabu";
                weekday['Thu'] = "Kamis";
                weekday['Fri'] = "Jumat";
                weekday['Sat'] = "Sabtu";
                var hari       = ["Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu"];
                var start      = $(this).find('.tgl_awal').datepicker('getDate');
                var end        = $(this).find('.tgl_akhir').datepicker('getDate');
                var hariAwal   = weekday[String(start).split(" ")[0]];
                var hariAkhir  = weekday[String(end).split(" ")[0]];
                list= [];
                while(start <= end) {
                    list.push(weekday[String(start).split(" ")[0]]);
                        //alert(weekday[String(start).split(" ")[0]]);
                        start = addDays(start, 1)    
                    }
                list = uniq(list); 
            
                $.each(list, function(i,v){
                   
                    $('.'+v+' :input').removeAttr('disabled');
                    $('.title_hari[data-day='+v+']').css('background-color', '#337ab7');
                    // $('.title_hari[data-day='+v+']').addClass('active');
                    // $('.tab-pane[data-day='+v+']').addClass('active');
                    
                })
                    
            });

           

        }

        return {
            init: function () {
                element();
            }
        };
    }();

    jQuery(document).ready(function () {
        //$('.modal-footer', parent.document).remove();
        $('#loader', parent.document).fadeOut();
        ElementInit.init();

        form = $("#form").validate({
            rules: {
                "name": {
                    required: true
                },
                "tuk_id": {
                    required: true
                },
                "tgl": {
                    required: true
                }

            },
            messages: {
                "name": {
                    required: "Silahkan tulis name kategori yang akan diinput "
                },
                "tuk_id": {
                    required: "Silahkan pilih modul & submodul "
                },
                "tgl": {
                    required: "Silahkan pilih modul & submodul "
                }
            },
            submitHandler: function (form) { // for demo
                table = $('#datatable').DataTable().destroy();

                $.ajax({
                    type: "post",
                    url: "{{ route('ujian.jadwal.insert') }}",
                    dataType: "json",
                    data: $("form").serialize(),
                    beforeSend: function () {
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
                        
                        if (response.status === 200) {
                            view();
                            // alert(JSON.stringify(response.status));
                            KTApp.unblock('.kt-portlet__body');
                            $.when(setTimeout(function () {
                               
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
                                    parent.$('#mod-iframe-large').modal(
                                        'hide');
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

    function view() {
        parent.$('#datatable').DataTable().destroy(); // destroy datatable
        /* Datatable View */
        parent.$('#datatable').DataTable({
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
    }

    $(function () {


        view(); //call datatable view



        $('#tes').click(function (event) {
            view();
        });


        /* New Data Button */
        $('#close').click(function (event) {
            parent.$('#mod-iframe-large').modal('hide');
            parent.$('#iframeModalContent').attr('src', "about:blank");
            // $('#mod-iframe-large', parent.document).modal('hide');
        });



    });

</script>

@endpush

@extends('layouts.ujian.app')
    @section('content')

    <link rel="stylesheet" type="text/css" href="https://ticmi.co.id/assets/sweetalerts/sweetalert.css">
    <link rel="stylesheet" type="text/css" href="https://ticmi.co.id/css/jquery.dataTables.min.css">
    <style>
        #header{
            display: none;
        }
        .page-header{
            display: none;
        }
        .page-sidebar-wrapper{
            display: none;
        }
        .row-footer{
            display: none;
        }
        .main-footer{
            display: none;
        }
        #footer{
            display: none;
        }
        .dataTables_wrapper .dataTables_paginate {
            float: left !important;
            text-align: left;
        }  
    </style>

    <!-- BEGIN CONTENT -->
    <div class="page-content-wrapper">
        <!-- BEGIN CONTENT BODY -->
            <!-- END PAGE HEAD-->
            <?php $checked = ''; ?>
            <!-- BEGIN PAGE BASE CONTENT -->
            <div class="row">
                <div class="col-md-offset-2">
                    <div class="col-md-12">
                        <div id="aggree"><center><h3 class="bold">Persetujuan Pengguna</h3></center>
                            <p>Anda menyetujui bahwa dengan menyetujui atau dengan menggunakan website dan aplikasi kami, Anda memasuki persetujuan yang mengikat secara hukum dengan Ticmi, yang dimiliki sepenuhnya dan dioperasikan oleh Ticmi berdasarkan pada persyaratan dari Persetujuan Pengguna ini dan Kebijakan Privasi, yang dengan ini tergabung dengan referensi (secara kolektif direferensikan sebagai “Persetujuan”).
                            </p>

                            <label class="mt-checkbox mt-checkbox-outline"> Ya, Saya Setuju
                                <input type="checkbox" name="check_persetujuan">
                                <span></span>
                            </label>

                            <button class="btn default btn-block" id="btn-mulai-ujian" >Mulai Ujian</button>
                        </div>
                    </div>
                </div>
            </div>

            <div id="siap-siap-ilang" style="display: none;">

            <div class="row">
                <div class="col-md-12">
                    <div class="portlet light portlet-fit bordered">
                        <p style="display: inline;">Batch : {{ $nama_batch }}</p>
                        <h3 style="display: inline; margin-left: 50%;" class="text-right font-red bold waktu">Waktu : <span id="jam"></span>:<span id="menit"></span>:<span id="detik"></span></h3>
                        <span class="hidden" id="time"></span>
                        <span class="hidden" id="time_left"></span>
                        <p>Nama Peserta : {{ $peserta }}</p>
                        <p>Tanggal : {{ $tanggal }}</p>
                        <p class="aksi_ujian"><button class="btn blue btn-akhiri-ujian" disabled="true">Akhiri Ujian</button></p>
                       <div class="portlet-title">
                            <div class="caption">
                               
                            </div>
                        </div>
                        <div class="portlet-body">
                            <!-- CONTENT HERE -->
                            <table class="table" id="myTable">
                                <thead>
                                    <tr>
                                        <th width="10px">No</th>
                                        <th>Soal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $all_num   = []; // collect all number question
                                        $all_ans   = []; // collect all number answered question
                                        $num_alpha = ['a' => '1', 'b' => '2', 'c' => '3', 'd' => '4']; // array reference key
                                        $num       = 0;
                                    @endphp

                                    @foreach($modul_jawab as $mj)
                                        @foreach($mj as $index=>$uji)
                                        <tr>
                                            @php
                                                $num +=1;
                                                array_push($all_num, $num);
                                                $jawaban = array('a','b','c','d'); // make array for random key
                                                shuffle($jawaban);
                                                $randomKey = array_pop($jawaban);
                                                unset($jawaban[$randomKey]);
                                                if(in_array($uji->soal_id, $ans)) // push answered number
                                                {
                                                    array_push($all_ans, $num);
                                                }
                                            @endphp
                                            <td class="num_soal">{{ $num }}</td>
                                            <td><b>{!! Crypt::decryptString($uji->soalUjian->soal) !!}</b>

                                                <div class="form-group">
                                                    <div class="mt-radio-list">
                                                        <label class="mt-radio"> <b>A.</b> {!! Crypt::decryptString($uji->soalUjian->{$randomKey}) !!}
                                                            
                                                            @php          
                                                                $id_soal         = $uji->soalUjian->soal_id;
                                                                $kunci_id        = $num_alpha[$randomKey];
                                                                
                                                                if($kunci_id==$uji->kunci_id ){
                                                                    $checked_a = 'checked';
                                                                } else {
                                                                    $checked_a = '';
                                                                }
                                                            @endphp
                                                                <input class="radio_soal" type="radio" value="{{ $kunci_id }}" name="soal_{{ $uji->soalUjian->soal_id }}" soal-id="{{ $uji->soalUjian->soal_id }}" {{$checked_a}}>
                                                                <span></span>

                                                        </label>
                                                        @php
                                                            $randomKey = array_pop($jawaban);
                                                            unset($jawaban[$randomKey]);
                                                            $kunci_id  = $num_alpha[$randomKey];
                                                        @endphp
                                                        <label class="mt-radio"> <b>B.</b> {!! Crypt::decryptString($uji->soalUjian->{$randomKey}) !!}
                                                        @php
                                                            if( ($kunci_id==$uji->kunci_id) ){
                                                                $checked_b = 'checked';
                                                            } else {
                                                                $checked_b = '';
                                                            }
                                                        @endphp
                                                                <input class="radio_soal" type="radio" value="{{ $kunci_id }}" name="soal_{{ $uji->soalUjian->soal_id }}" soal-id="{{ $uji->soalUjian->soal_id }}" {{$checked_b}}>
                                                                <span></span>
                                                        </label>
                                                        @php
                                                            $randomKey = array_pop($jawaban);
                                                            unset($jawaban[$randomKey]);
                                                            $kunci_id  = $num_alpha[$randomKey];
                                                        @endphp
                                                        <label class="mt-radio"> <b>C.</b> {!! Crypt::decryptString($uji->soalUjian->{$randomKey}) !!}

                                                            @php
                                                                if( ($kunci_id==$uji->kunci_id) ){
                                                                    $checked_c = 'checked';
                                                                } else {
                                                                    $checked_c = '';
                                                                }
                                                            @endphp
                                                                <input class="radio_soal" type="radio" value="{{ $kunci_id }}" name="soal_{{ $uji->soalUjian->soal_id }}" soal-id="{{ $uji->soalUjian->soal_id }}" {{$checked_c}}>
                                                                <span></span>
                                                        </label>
                                                        @php
                                                            $randomKey = array_pop($jawaban);
                                                            unset($jawaban[$randomKey]);
                                                            $kunci_id  = $num_alpha[$randomKey];
                                                        @endphp
                                                        <label class="mt-radio"> <b>D.</b> {!! Crypt::decryptString($uji->soalUjian->{$randomKey}) !!}

                                                            @php
                                                                if( ($kunci_id==$uji->kunci_id) ){
                                                                    $checked_d = 'checked';
                                                                } else {
                                                                    $checked_d = '';
                                                                }
                                                            @endphp
                                                                <input class="radio_soal" type="radio" value="{{ $kunci_id }}" name="soal_{{ $uji->soalUjian->soal_id }}" soal-id="{{ $uji->soalUjian->soal_id }}" {{$checked_d}}>
                                                                <span></span>
                                                        </label>
                                                    </div>
                                                    <span class="alert alert-success pull-right"><strong> Modul {{ $uji->name }}</strong></span>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    @endforeach

                                    <div style="box-sizing: inherit;margin-bottom: 60px;">
                                        <button class="btn blue btn-outline" style="float:left;" id="previous"><span class="fa fa-arrow-circle-left"></span> Previous</button>
                                        <button class="btn blue btn-outline" style="float:right;" id="next">Next <span class="fa fa-arrow-circle-right"></span></button>
                                    </div>

                                    <div id="ans" class="hidden" data-count="{{ json_encode($all_ans) }}"></div>
                                    <div id="all_num" class="hidden" data-count="{{ json_encode($all_num) }}"></div>
                                </tbody>
                            </table>
                <!-- modal password pengawas -->
                <div class="modal fade" id="modal_password" tabindex="-1" data-backdrop="static" data-keyboard="false" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <b><h4 class="modal-title">Masukkan Password</h4></b>
                                <span class="tag label label-primary" style="font-size: 9pt;padding: 0px 6px;"></span>
                            </div>
                            <div class="modal-body">
                                <form method="POST" action="{{ url('ujian/perdana/password_ulang/'.$emp_id) }}">
                                {{csrf_field()}}
                                    <div class="form-group">
                                        <div class="input-icon input-icon-lg right">
                                            <i class="fa fa-bell-o font-green"></i>
                                            <input type="password" name="password_ulang" class="form-control input-lg" placeholder="Masukkan Password Pengawas"> </div>
                                            <p id="peringatan-password-ulang" style="color: red; display: none;">Password Wajib Di isi</p>
                                    </div>
                                    <div class="form-actions">
                                        <button type="submit" name="btn_password_ulang" class="btn blue">Submit</button>
                                        <span id="loading-password-ulang" style="display: none;"><img src="https://ticmi.co.id/assets/theme/global/img/loading.gif"></span>
                                    </div>
                                </form>
                            </div>
                            <!-- <div class="modal-footer">
                                <button type="button" class="btn red" data-dismiss="modal">Close</button>
                            </div> -->
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div><!-- /modal password pengawas -->


                <!-- modal connection reminder -->
                <div class="modal fade" id="modal_conn_reminder" tabindex="-1" data-backdrop="static" data-keyboard="false" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            {{-- <div class="modal-header">
                                <b><h4 class="modal-title">Masukkan Password</h4></b>
                                <span class="tag label label-primary" style="font-size: 9pt;padding: 0px 6px;"></span>
                            </div> --}}
                            <div class="modal-body">
                                <div class="form-group">
                                    <center>
                                        <p><span class="fa fa-exclamation-circle" style="font-size:100px;color:red;margin-top:50px"></span></p>
                                        <p>
                                        <h3>Koneksi Anda Terputus</h3></p>
                                        <p>
                                        <h4>Periksa koneksi Anda dan silahkan lanjutkan ujian</h4>
                                    </p>
                                    <button type="button" class="btn primary" id="lanjut_ujian">Lanjutkan ujian</button>
                                </center>
                                </div>
                            </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div><!-- /modal connection reminder -->

                            <!-- END CONTENT -->                            
                        </div>
                    </div>
                </div>
            </div>
            <input type="hidden" name="perdana_peserta_id" value="{{ $perdana_peserta->perdana_peserta_id}}"> 
            <meta name="csrf-token" content="{{ csrf_token() }}">

            </div>
            <!-- END PAGE BASE CONTENT -->
        <!-- END CONTENT BODY -->
    </div>
    <!-- END CONTENT -->

    <script type="text/javascript" src="https://ticmi.co.id/assets/sweetalerts/sweetalert.js"></script>
    <script type="text/javascript" src="https://ticmi.co.id/js/jquery.dataTables.min.js"></script>

    <script>
        var disableTawk = true; // flag for disable tawk.js 
        var isPaused    = false; // flag for pause time in exam
        $(document).ready(function(){
            $('html').removeClass(); // clear css
            $('#next').on( 'click', function () {
                $('#myTable').DataTable().page( 'next' ).draw( 'page' );
            } );
             
            $('#previous').on( 'click', function () {
                $('#myTable').DataTable().page( 'previous' ).draw( 'page' );
            } );
            var allDt = []; // collect all answered number each answered question for paging color
            var ans = $('#ans').attr('data-count'); // collect all answered from db
            var ans = JSON.parse(ans);
            var allNum = $('#all_num').attr('data-count'); // collect all number
            var allNum = JSON.parse(allNum);
            $.each(ans, function(i, v){
                removeFromArray(allNum, v); // remove number answered from all number in exam
            });
            /* enter password when pengawas exists  & lock keyboard */
            var keyboard = "{{ $keyboard_lock }}";
            var emp_id   = "{{ $emp_id }}";
            if(keyboard == true)
            {
                $(document).keydown(function (event) {
                    check_btn_mulai     = $('#btn-mulai-ujian').is(":visible");
                    check_btn_dashboard = $('.tmbl_dashboard').is(":visible");
                    if(check_btn_mulai !== true && check_btn_dashboard !== true)
                    {
                        if(emp_id !== '')
                        {
                            $('#modal_password').modal();
                        } else {
                            swal("Dilarang menyentuh keyboard!", "", "error");
                        }
                    }
                });
                $(document).contextmenu(function() {
                    check_btn_mulai = $('#btn-mulai-ujian').is(":visible");
                    check_btn_dashboard = $('.tmbl_dashboard').is(":visible");
                    if(check_btn_mulai !== true && check_btn_dashboard !== true)
                    {
                        if(emp_id !== '')
                        {
                            $('#modal_password').modal();
                        } else {
                            swal("Dilarang menyentuh keyboard!", "", "error");
                        }
                    }
                    return false;
                });
            }
            /* remove answered number from remain number unanswered question **/
            function removeFromArray(array, element) {
                const index = array.indexOf(element);
        
                if (index !== -1) {
                    array.splice(index, 1);
                }
            }
            
            // make a fullscreen mode
            function fullScreen(){
                if ((document.fullScreenElement && document.fullScreenElement !== null) ||   
                   (!document.mozFullScreen && !document.webkitIsFullScreen)) {
                    if (document.documentElement.requestFullScreen) { 
                      document.documentElement.requestFullScreen(); 
                  } else if (document.documentElement.mozRequestFullScreen) { 
                      document.documentElement.mozRequestFullScreen(); 
                  } else if (document.documentElement.webkitRequestFullScreen) { 
                      document.documentElement.webkitRequestFullScreen(Element.ALLOW_KEYBOARD_INPUT); 
                  } 
                  } else { 
                    if (document.cancelFullScreen) { 
                      document.cancelFullScreen(); 
                  } else if (document.mozCancelFullScreen) { 
                      document.mozCancelFullScreen(); 
                  } else if (document.webkitCancelFullScreen) { 
                      document.webkitCancelFullScreen(); 
                  } 
              }
            }
            /* function to countdown time and auto finish exam when timeout */
            function counter(time){
                var interval = setInterval(function(){
                    // if still connected
                    if(isPaused == false){
                        var totalWaktu = time;
                        var jam        = Math.floor(totalWaktu / 3600);
                        totalWaktu    %= 3600;
                        menit          = Math.floor(totalWaktu / 60);
                        detik          = totalWaktu % 60; 
                        check_btn_mulai     = $('#btn-mulai-ujian').is(":visible");
                        check_btn_dashboard = $('.tmbl_dashboard').is(":visible");
                        $('#jam').text(jam);
                        $('#menit').text(menit);
                        $('#detik').text(detik);
                        time -= 1;
                        $('#time').html(time);
                        // jika tidak dihalaman start ujian atau tidak dihalaman selesai ujian
                        if(check_btn_mulai !== true && check_btn_dashboard !== true)
                        {
                            // jika waktu habis otomatis akumulasi kelulusan
                            if(time == 0){
                                soal_peserta = "{{ $soal_peserta_id }}";
                                clearInterval(interval);
                                alert('Maaf, waktu habis');
                                
                                var soal_peserta_id = [];
                                $.each(JSON.parse(soal_peserta), function(i, v){
                                    soal_peserta_id.push(v);
                                });
                                $.ajax({
                                    headers: {
                                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                    },
                                    type: 'post',
                                    dataType: 'json',
                                    url: "{{ url('ujian/perdana/save_persentase_kelulusan') }}",
                                    data: {
                                        soal_peserta_id: soal_peserta_id,
                                    },
                                    success: function(data){
                                        $('.portlet-title').hide();
                                        $('.portlet-body').hide();
                                        $('.waktu').hide();
                                        $('.btn-akhiri-ujian').hide();
                                        var tmbl_dashboard = '<a href="{{ route('dashboard') }}" class="btn red tmbl_dashboard"><span class="fa fa-arrow-circle-left"></span> Kembali ke dashboard</a>';
                                            tmbl_dashboard+= '<a href="{{ route('print_ujian') }}" class="btn red print_ujian pull-right" target="_blank"><span class="fa fa-print"></span> Print </a>';
                                        var tbl_result = '<br /><br /><div class="portlet box red"> <div class="portlet-title"> <div class="caption"> <i class="fa fa-graduation-cap"></i> Hasil Ujian </div></div>';
                                            tbl_result += '<div class="portlet-body" style="display: block;"> <div class="table-responsive"> <table class="table"> <thead> <tr>';
                                            tbl_result += '<th> # </th> <th> Modul </th> <th> Total Soal </th> <th> Jumlah Benar </th> <th> Nilai </th> <th> Keterangan </th> </tr> </thead> <tbody>';
                                        var iteration = 0;
                                        $.each(data, function(index, v) {
                                            iteration++;
                                            if(v.lulus == true) {
                                                lulus = "<span class='label label-sm label-success'> Lulus </span>";
                                            } else {
                                                lulus = "<span class='label label-sm label-danger'> Tidak lulus </span>";
                                            }
                                            tbl_result += ' <tr> <td> '+ iteration +' </td><td> '+v.nama_modul+' </td><td> '+v.total_soal+' </td><td> '+v.total_benar+' </td><td> '+v.nilai+' </td><td> '+lulus+' </td>';
                                        });
                                            tbl_result +='</tr></tbody> </table> </div></div></div>';
                                        $('.aksi_ujian').append(tmbl_dashboard);
                                        $(tbl_result).insertAfter('.aksi_ujian');
                                        swal.close();
                                    }
                                }); // end ajax
                            } //end if time == 0
                        } // end if tmbl_dashboard
                    } else {// end ispaused false
                        //if no connection clear countdown time
                        clearInterval(interval); //
                    }
                }, 1000);
            }
            $( "#modal_password" ).on('shown.bs.modal', function(){
                $("input[name='password_ulang']").val('');
            });
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var semua_soal_id = [];
            var soal_peserta_id = [];
            // Ketika button mulai ujian di klik
            $('#btn-mulai-ujian').click(function(e){
                if(navigator.onLine == true) {
                    var waktu       = {{ $waktu }};
                    counter(waktu);
                    $('#siap-siap-ilang').show('slow');
                    fullScreen();
                    $('#aggree').hide();
                } else {
                    alert('Koneksi internet Anda terputus. Silahkan ulangi beberapa saat lagi');
                }
                
            });
            var total_soal = {{ $total_soal }};
            /** datatable **/
            $.fn.dataTableExt.pager.numbers_length = total_soal;
            $('#myTable').DataTable({
                "pageLength": 1,
                "searching": false,
                "ordering": false,
                "bLengthChange": false,
                "pagingType": "numbers",
                "drawCallback": function(settings) {
                    $.each(ans, function(i, v){
                        idx = v-1;
                        $('.dataTables_wrapper .dataTables_paginate .paginate_button[data-dt-idx="'+idx+'"').css("background", "linear-gradient(to bottom, #fff 0%,  #4bd055 100%)");
                    });
                    $.each(allDt, function(i, v){
                        idx = v-1;
                        $('.dataTables_wrapper .dataTables_paginate .paginate_button[data-dt-idx="'+idx+'"').css("background", "linear-gradient(to bottom, #fff 0%,  #4bd055 100%)");
                    });
                },
            });
            /** menjawab soal cek koneksi terlebih dahulu **/
            $('body').on('change', '.radio_soal', function(){
                
                if(navigator.onLine == true){
                    var kunci_id           = $(this).val();
                    var soal_id            = $(this).attr('soal-id');
                    var soal_peserta       = "{{ $soal_peserta_id }}";
                    var num_soal           = $(this).closest('td').prev().html();
                    var dt                 = parseInt(num_soal.replace(/\s+/g,''));
                    var perdana_peserta_id = $('input[name="perdana_peserta_id"]').val();
                    var time               = $('#time').html();
                    var mark               = dt-1; 
                    var my_ans             = $(this);
                    $('#time_left').html(time);
                    $.each(JSON.parse(soal_peserta), function(i, v){
                        soal_peserta_id.push(v);
                    });
                    $.ajax({
                        type : 'post',
                        dataType : 'json',
                        url : "{{ url('ujian/perdana/save_peserta_jawab') }}",
                        data : {
                            soal_id : soal_id,
                            kunci_id : kunci_id,
                            perdana_peserta_id: perdana_peserta_id,
                            time: time,
                            soal_peserta_id : soal_peserta_id
                            
                        },
                        success : function(data){
                            removeFromArray(allNum, dt);
                    
                            allDt.push(dt);
                            $('.dataTables_wrapper .dataTables_paginate .paginate_button[data-dt-idx="'+mark+'"').css("background", "linear-gradient(to bottom, #fff 0%,  #4bd055 100%)");
                            $('.btn-akhiri-ujian').removeAttr('disabled');
                            if(navigator.onLine == false) {
                                alert('Koneksi internet Anda terputus. Pastikan Anda memiliki koneksi Internet');
                            }
                        },
                        error: function(err){
                            $(my_ans).attr("selected",false);
                            $(my_ans).attr("checked",false);
                            swal("Jawaban gagal disimpan, Silahkan isi kembali","", "error");
                        }
                    });
                } else {
                    // jika tidak ada koneksi hapus jawaban, stop waktu show modal reminder connection
                    isPaused = true;
                    $(this).attr("selected",false);
                    $(this).attr("checked",false);
                    $('#modal_conn_reminder').modal('toggle');
                }
                
            });
            // Ketika button submit masukkan password ulang di klik
            $("button[name='btn_password_ulang']").click(function(e){
                e.preventDefault();
                var emp_id = "{{ $emp_id }}";
                var password_ulang = $("input[name='password_ulang']").val();
                $('#peringatan-password-ulang').hide();
                $('#loading-password-ulang').show();
                
                if(password_ulang == '')
                {
                    $('#peringatan-password-ulang').show();
                    $('#loading-password-ulang').hide();
                }
                else
                {
                    $.ajax({
                        type : 'POST',
                        url : "{{ url('ujian/perdana/password_ulang') }}"+'/'+emp_id,
                        data : {
                            password_ulang : password_ulang
                        },
                        success : function(data){
                            $('#loading-password-ulang').hide();
                            if(data.pesan == 'gagal')
                            {
                                $('#peringatan-password-ulang').text('Password Salah').show();
                            }
                            else
                            {
                                $('#modal_password').modal('hide');
                            }
                        }
                    });
                }
            });
            // when user menyetujui persetujuan pengguna
            $('input[name="check_persetujuan"]').click(function(){
                if($(this).is(':checked')){
                    $('#btn-mulai-ujian').attr('disabled', false);
                    $('#btn-mulai-ujian').removeClass('default').addClass('blue');
                } else {
                    $('#btn-mulai-ujian').attr('disabled', 'disabled');
                    $('#btn-mulai-ujian').removeClass('blue').addClass('default');
                }
            });
            // when user click lanjutkan ujian from modal connection reminder
            $('#lanjut_ujian').click(function(){
                if(navigator.onLine == true){
                    // start time from last answer question
                    isPaused = false;
                    time_left = $('#time_left').html();
                    counter(time_left);
                    $('#modal_conn_reminder').modal('hide');
                } else {
                    // loop modal
                    isPaused = true;
                    setTimeout(function(){$('#modal_conn_reminder').modal('hide')}, 10);
                    setTimeout(function(){$('#modal_conn_reminder').modal('show')}, 900);
                }
            });
            // ketika btn akhiri ujian di klik
            $('.btn-akhiri-ujian').click(function(e){
                e.preventDefault();
                if (typeof allNum !== 'undefined' && allNum.length > 0) {
                    question = allNum.join(", "); // join all number unanswered question with comma
                    warnText = "Anda belum menyelesaikan soal nomor <strong>"+question+"</strong>";
                    swal({
                        title: "Mohon selesaikan soal ujian Anda",
                        html:true,
                        text: warnText,
                        type: "warning",
                        showCancelButton: true,
                        cancelButtonText: "Lanjutkan ujian",
                        showConfirmButton: false
                    });
                } else {
                
                    warnText = 'Anda tidak dapat membatalkan proses ini';
            
                    swal({
                        title: "Yakin ingin di akhiri?",
                        html:true,
                        text: warnText,
                        type: "warning",
                        showCancelButton: true,
                        cancelButtonText: 'Batal',
                        confirmButtonClass: "btn-danger",
                        confirmButtonText: "Ya, saya yakin!",
                        closeOnConfirm: false,
                        showLoaderOnConfirm: true
                    },
                    function () {
                        $.ajax({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            type: 'post',
                            dataType: 'json',
                            url: "{{ url('ujian/perdana/save_persentase_kelulusan') }}",
                            data: {
                                soal_peserta_id: soal_peserta_id,
                                semua_soal_id: semua_soal_id
                            },
                            success: function(data){
                                $('.portlet-title').hide();
                                $('.portlet-body').hide();
                                $('.waktu').hide();
                                $('.btn-akhiri-ujian').hide();
                                var tmbl_dashboard = '<a href="{{ route('dashboard') }}" class="btn red tmbl_dashboard"><span class="fa fa-arrow-circle-left"></span> Kembali ke dashboard</a>';
                                    tmbl_dashboard+= '<a href="{{ route('print_ujian') }}" class="btn red tmbl_dashboard pull-right" target="_blank"><span class="fa fa-print"></span> Print </a>';
                                var tbl_result = '<br /><br /><div class="portlet box red"> <div class="portlet-title"> <div class="caption"> <i class="fa fa-graduation-cap"></i> Hasil Ujian </div></div>';
                                    tbl_result += '<div class="portlet-body" style="display: block;"> <div class="table-responsive"> <table class="table"> <thead> <tr>';
                                    tbl_result += '<th> # </th> <th> Modul </th> <th> Total Soal </th> <th> Jumlah Benar </th> <th> Nilai </th> <th> Keterangan </th> </tr> </thead> <tbody>';
                                var iteration = 0;
                                $.each(data, function(index, v) {
                                    iteration++;
                                    // alert(v);
                                    if(v.lulus == true) {
                                        lulus = "<span class='label label-sm label-success'> Lulus </span>";
                                    } else {
                                        lulus = "<span class='label label-sm label-danger'> Tidak lulus </span>";
                                    }
                                    tbl_result += ' <tr> <td> '+ iteration +' </td><td> '+v.nama_modul+' </td><td> '+v.total_soal+' </td><td> '+v.total_benar+' </td><td> '+v.nilai+' </td><td> '+lulus+' </td>';
                                });
                                    tbl_result +='</tr></tbody> </table> </div></div></div>';
                                $('.aksi_ujian').append(tmbl_dashboard);
                                $(tbl_result).insertAfter('.aksi_ujian');
                                swal.close();
                            }
                        }); // end ajax
                    }); // end swal
                }
            });
        });
    </script>

@endsection
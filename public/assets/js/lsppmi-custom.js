"use strict";

$(document).ready(function () {

    /**
     * Konfigurasi untuk proses AJAX REQUEST berfungsi untuk otomatis mengirim CSRF_TOKEN ke controller
     * pada proses POST yang menggunakan AJAX RQEUEST
     */
    $.ajaxPrefilter(function(options, originalOptions, xhr) { // this will run before each request
        //var token = $('meta[name="csrf-token"]').attr('content'); // or _token, whichever you are using
        var token = $("input[name='_token']").val();

        if (token) {
            return xhr.setRequestHeader('X-CSRF-TOKEN', token); // adds directly to the XmlHttpRequest Object
        }
    });
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $("input[name='_token']").val()
        }
    });

    /**
     * Untuk fungsi mengaktifkan (load) tooltip yang ada didalam Datatable saat
     * Datatable di Draw/Render
     */
    if ($('#kt_table_1').length) {
        $('#kt_table_1').on('draw.dt', function () {
            $('[data-toggle="kt-tooltip"]').each(function() {
                KTApp.initTooltip($(this));
            });
        });
    }

    /**
     * Summernote initialization
     */
    $(".summernote").summernote({height:150,dialogsInBody: true});

    /**
     * Untuk fungsi Popup konfirmasi pada saat menghapus item
     * Penggunaan : masukkan CSS Class "delconfirm" pada elemen tombol hapus (a:href)
     */
    $('body').on('click','.delconfirm', function (e) {
        e.preventDefault();
        var link = $(this).attr('href');
        swal.fire({
                title: 'Hapus data?',
                text: 'Apakah Anda yakin untuk hapus data ini ?',
                type: 'warning',
                allowOutsideClick: true,
                showConfirmButton: true,
                showCancelButton: true,
                confirmButtonClass: 'btn-info',
                cancelButtonClass: 'btn-danger',
                // closeOnConfirm: true,
                // closeOnCancel: true,
                confirmButtonText: 'Ya',
                cancelButtonText: 'Tidak',
            }).then(function(result){
                if (result.value) {
                    window.location.href = link;
                }
            });
        // ,
        //     function(isConfirm){
        //         if (isConfirm){
        //             window.location.href = link;
        //         } else {
        //
        //         }
        //     });
    });

    /**
     * Modal Iframe - a custom modal launcher
     * Modal yang load iframe pada modal body, berfungsi untuk modal yang berfungsi untuk load FORM/Proses
     */

    $("body").on("click","a.modalIframe",function(e) {
        e.preventDefault();
        var url = $(this).attr("href");
        var title = $(this).data("original-title");
        title = (title === undefined) ? $(this).attr('title'):title;
        var fwidth = $(this).data("fwidth");
        var afterClose = $(this).data('after-close');

        $('#mod-iframe-large').on('show.bs.modal', function (e) {
            var iframeWindow = $(this).find('iframe');
            $(this).find('iframe').attr('src',url);

            var tinggi = $( window ).height() - 220;
            if(fwidth == "") { fwidth = '80%'; }

            $(this).attr('data-after-close',afterClose);

            $(this).find('.modal-title').html(title);
            iframeWindow.height(tinggi);
            $(this).find('.modal-dialog').width(fwidth);
        });
        $('#mod-iframe-large').modal({show:true});
    });

    /** Set lebar Iframe on show up modal */
    $('#mod-iframe-large').on('shown.bs.modal', function (e) {
        var iframeWindow = $(this).find('iframe');
        $(this).find('iframe').attr('src',url);
        var h = $(this).find('.modal-body').outerWidth();
    });

    /** Clear Iframe on modal hide */
    // $('#mod-iframe-large').on('hidden.bs.modal', function (e) {
    //     $(this).find('iframe').attr('src','');
    // });

    /** Untuk memunculkan loading saat setiap submit button di klik */
    $(".btn-loading").on('click', 'body', function (e) {
        $(this).addClass('kt-spinner kt-spinner--v2 kt-spinner--sm kt-spinner--light');
    });
});

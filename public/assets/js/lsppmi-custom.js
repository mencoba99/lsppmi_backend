$(document).ready(function () {

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
                confirmButtonText: 'Yes',
                cancelButtonText: 'No',
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
})

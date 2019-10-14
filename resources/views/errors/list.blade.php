@if (count($errors) > 0)
    <div class="alert alert-danger">
        <div class="alert-text">
            <h4>Maaf, terjadi kesalahan</h4>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{!! $error !!}</li>
                @endforeach
            </ul>
            <hr>
            <p class="mb-0">
                Harap cek kembali form, pastikan isian form sudah terisi dan sesuai.
            </p>
        </div>

        <div class="alert-close">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true"><i class="la la-close"></i></span>
            </button>
        </div>
    </div>
@endif

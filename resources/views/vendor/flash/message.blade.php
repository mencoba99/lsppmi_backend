@foreach (session('flash_notification', collect())->toArray() as $message)
    @if ($message['overlay'])
        @include('flash::modal', [
            'modalClass' => 'flash-modal',
            'title'      => $message['title'],
            'body'       => $message['message']
        ])
    @else
        <div class="alert
                    alert-{{ $message['level'] }}
                    {{ $message['important'] ? 'alert-important' : '' }}"
                    role="alert"
        >
            @if ($message['important'])
                <div class="alert-close">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true"><i class="la la-close"></i></span>
                    </button>
                </div>
            @endif

            <div class="alert-text">
                @if ($message['level'] == 'danger')
                    <h4>Maaf, terjadi kesalahan</h4>
                @elseif($message['level'] == 'success')
                    <h4>Sukses</h4>
                @elseif($message['level'] == 'info')
                    <h4>Informasi</h4>
                @elseif($message['level'] == 'warning')
                    <h4>Perhatian!</h4>
                @endif
                {!! $message['message'] !!}
            </div>
        </div>
    @endif
@endforeach

{{ session()->forget('flash_notification') }}


@include('errors.list')

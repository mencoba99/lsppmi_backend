@component('mail::message')
# Halo, {{ $cert->members->name }}

Pembayaran sertifikasi {{ $cert->schedules->programs->name }} Anda telah kami verifikasi.

Anda dapat melanjutkan proses pengisian Form APL02.

Terima kasih,<br>
{{ config('app.name') }}
@endcomponent

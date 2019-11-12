@component('mail::message')
# Halo, {{ $cert->members->name }}

Pendaftaran sertifikasi Wakil Perantara Pedagang Efek Anda telah kami setujui. Untuk menyelesaikan proses pendaftaran silakan lakukan pembayaran.

Terima kasih,<br>
{{ config('app.name') }}
@endcomponent

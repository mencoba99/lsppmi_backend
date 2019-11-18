@component('mail::message')
# Halo, {{ $cert->members->name }}

Pendaftaran sertifikasi {{ $cert->schedules->programs->name }} Anda telah kami setujui. Untuk menyelesaikan proses pendaftaran silakan lakukan pembayaran.

Terima kasih,<br>
{{ config('app.name') }}
@endcomponent

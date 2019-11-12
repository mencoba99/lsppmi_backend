@component('mail::message')
# Halo {{ $member->name }}

Anda perlu melakukan aktivasi email untuk menyelesaikan proses pendaftaran di Lembaga Sertifikasi Profesi Pasar Modal.

Silakan klik link berikut untuk melakukan aktivasi.

{{ env('FE_APP_URL') . '/member/activation?token=' . $member->token  }}

Terima kasih,<br>
{{ config('app.name') }}
@endcomponent

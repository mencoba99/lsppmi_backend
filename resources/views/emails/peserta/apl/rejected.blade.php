@component('mail::message')
# Halo, {{ $cert->members->name }}

Maaf, pendaftaran sertifikasi {{ $cert->programs->name }} Anda tidak dapat kami setujui.

Terima kasih,<br>
{{ config('app.name') }}
@endcomponent

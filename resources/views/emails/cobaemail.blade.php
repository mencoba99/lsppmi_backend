@component('mail::message')
# Introduction

The body of your message. Coba Email

@component('mail::button', ['url' => ''])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent

@component('mail::message')
# Introduction

The body of your message.

@component('mail::button', ['url' => ''])
Button Text
@endcomponent

Спасибо,<br>
{{ config('app.name') }}
@endcomponent

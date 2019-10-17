@component('mail::message')
#Dear Student,

{{$message}}

Thanks,<br>
{{ config('app.name') }}
@endcomponent

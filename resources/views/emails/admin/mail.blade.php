@component('mail::message')
    Hello,

    @if(isset($studentData['studentEmail']))
        Here are your credentials:
        Email: {{$studentData['studentEmail']}}
        Password: {{$studentData['studentPassword']}}
    @elseif(isset($studentData['message']))
        {{$studentData['message']}}
    @endif

{{--@component('mail::button', ['url' => ''])--}}
{{--Button Text--}}
{{--@endcomponent--}}

Thanks,<br>
{{ config('app.name') }}
@endcomponent

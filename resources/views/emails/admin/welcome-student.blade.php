@component('mail::message')
#Dear Student,
Congratulations, You are successfully admitted to our school.

Here are your credentials:<br>
Email: {{$studentData['studentEmail']}}<br>
Password: {{$studentData['studentPassword']}}

Thanks,<br>
{{ config('app.name') }}
@endcomponent

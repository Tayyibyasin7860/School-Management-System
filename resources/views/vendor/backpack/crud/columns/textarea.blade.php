{{-- regular object attribute --}}
@php
    $value = data_get($entry, $column['name']);
@endphp

<span>{!! $value !!}</span>
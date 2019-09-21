@php
    $value = data_get($entry, $column['name']);
@endphp

<span>
    @if ($value && count($value))
        @foreach ($value as $file_path)
            - <a target="_blank" href="{{ isset($column['disk'])?asset(\Storage::disk($column['disk'])->url($file_path)):asset($file_path) }}">{{ $file_path }}</a><br>
        @endforeach
    @else
        -
    @endif
</span>
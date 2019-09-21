<?php
$required = (isset($field['attributes']['required']) || (isset($action) && $crud->isRequired($field['name'], $action))) ? ' required' : '';
?>

@if (isset($field['wrapperAttributes']))
    @if (!isset($field['wrapperAttributes']['class']))
        class="form-group col-xs-12 {{ $required }}"
    @else
        class="{{ $field['wrapperAttributes']['class'] }} {{ $required }}"
    @endif

    @php 
        unset($field['wrapperAttributes']['class']);
    @endphp

    @foreach ($field['wrapperAttributes'] as $attribute => $value)
        @if (is_string($attribute))
            {{ $attribute }}="{{ $value }}"
        @endif
    @endforeach
@else
    class="form-group col-xs-12{{ $required }}"
@endif

<!-- Simple MDE - Markdown Editor -->
<div @include('crud::inc.field_wrapper_attributes') >
    <label>{!! $field['label'] !!}</label>
    @include('crud::inc.field_translatable_icon')
    <textarea
    	id="simplemde_{{ $field['name'] }}"
        name="{{ $field['name'] }}"
        @include('crud::inc.field_attributes', ['default_class' => 'form-control'])
    	>{{ old(square_brackets_to_dots($field['name'])) ?? $field['value'] ?? $field['default'] ?? '' }}</textarea>

    {{-- HINT --}}
    @if (isset($field['hint']))
        <p class="help-block">{!! $field['hint'] !!}</p>
    @endif
</div>


{{-- ########################################## --}}
{{-- Extra CSS and JS for this particular field --}}
{{-- If a field type is shown multiple times on a form, the CSS and JS will only be loaded once --}}
@if ($crud->checkIfFieldIsFirstOfItsType($field))

    {{-- FIELD CSS - will be loaded in the after_styles section --}}
    @push('crud_fields_styles')
        <link rel="stylesheet" href="//cdn.jsdelivr.net/simplemde/latest/simplemde.min.css">
        <style type="text/css">
        .CodeMirror-fullscreen, .editor-toolbar.fullscreen {
            z-index: 9999 !important;
        }
        .CodeMirror{
        	min-height: auto !important;
        }
        </style>
    @endpush

    {{-- FIELD JS - will be loaded in the after_scripts section --}}
    @push('crud_fields_scripts')
        <script src="//cdn.jsdelivr.net/simplemde/latest/simplemde.min.js"></script>
    @endpush

@endif

@push('crud_fields_scripts')
<script>
    var simplemde_{{ $field['name'] }} = new SimpleMDE({
    	element: $("#simplemde_{{ $field['name'] }}")[0],
    	@if(isset($field['simplemdeAttributes']))
    		@foreach($field['simplemdeAttributes'] as $index => $value)
    			{{$index}} : @if(is_bool($value)) {{ ($value?'true':'false') }} @else {!! '"'.$value.'"' !!} @endif,
    		@endforeach
    	@endif
    	{!! isset($field['simplemdeAttributesRaw']) ? $field['simplemdeAttributesRaw'] : "" !!}
    });
    simplemde_{{ $field['name'] }}.options.minHeight = simplemde_{{ $field['name'] }}.options.minHeight || "300px";
    simplemde_{{ $field['name'] }}.codemirror.getScrollerElement().style.minHeight = simplemde_{{ $field['name'] }}.options.minHeight;
    $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
    	setTimeout(function() { simplemde_{{ $field['name'] }}.codemirror.refresh(); }, 10);
    });
</script>
@endpush
{{-- End of Extra CSS and JS --}}
{{-- ########################################## --}}

<!-- summernote editor -->
<div @include('crud::inc.field_wrapper_attributes') >
    <label>{!! $field['label'] !!}</label>
    @include('crud::inc.field_translatable_icon')
    <textarea
        name="{{ $field['name'] }}"
        @include('crud::inc.field_attributes', ['default_class' =>  'form-control summernote'])
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
        <!-- include summernote css-->
        <link href="{{ asset('vendor/backpack/summernote/summernote.css') }}" rel="stylesheet" type="text/css" />
    @endpush

    {{-- FIELD JS - will be loaded in the after_scripts section --}}
    @push('crud_fields_scripts')
        <!-- include summernote js-->
        <script src="{{ asset('vendor/backpack/summernote/summernote.min.js') }}"></script>
    @endpush

@endif

@push('crud_fields_scripts')
    <!-- include summernote js with related options for this field -->
    <script>
        jQuery(document).ready(function($) {
            $(".summernote[name='{{ $field['name'] }}']").summernote(@json($field['options'] ?? []));
        });
    </script>
@endpush
{{-- End of Extra CSS and JS --}}
{{-- ########################################## --}}

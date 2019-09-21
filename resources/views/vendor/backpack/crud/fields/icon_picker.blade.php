<!-- icon picker input -->

<?php
// if no iconset was provided, set the default iconset to Font-Awesome
if (! isset($field['iconset'])) {
    $field['iconset'] = 'fontawesome';
}
?>

<div @include('crud::inc.field_wrapper_attributes') >
    <label>{!! $field['label'] !!}</label>
    @include('crud::inc.field_translatable_icon')

    <div>
        <button class="btn btn-default " role="iconpicker" data-icon="{{ old(square_brackets_to_dots($field['name'])) ?? $field['value'] ?? $field['default'] ?? '' }}" data-iconset="{{ $field['iconset'] }}"></button>
        <input
            type="hidden"
            name="{{ $field['name'] }}"
            value="{{ old(square_brackets_to_dots($field['name'])) ?? $field['value'] ?? $field['default'] ?? '' }}"
            @include('crud::inc.field_attributes')
        >
    </div>

    {{-- HINT --}}
    @if (isset($field['hint']))
        <p class="help-block">{!! $field['hint'] !!}</p>
    @endif
</div>


@if ($crud->checkIfFieldIsFirstOfItsType($field))

    @if($field['iconset'] == 'glyphicon')
        @push('crud_fields_scripts')
            <!-- Bootstrap-Iconpicker Iconset for Glyphicon -->
            <script type="text/javascript" src="{{ asset('vendor/backpack/bootstrap-iconpicker/bootstrap-iconpicker/js/iconset/iconset-glyphicon.min.js') }}"></script>
        @endpush
    @elseif($field['iconset'] == 'ionicon')
        @push('crud_fields_styles')
            <!-- Ionicons -->
            <link rel="stylesheet" href="{{ asset('vendor/backpack/bootstrap-iconpicker/icon-fonts/ionicons-1.5.2/css/ionicons.min.css') }}"/>
        @endpush

        @push('crud_fields_scripts')
            <!-- Bootstrap-Iconpicker Iconset for Ionicons -->
            <script type="text/javascript" src="{{ asset('vendor/backpack/bootstrap-iconpicker/bootstrap-iconpicker/js/iconset/iconset-ionicon-1.5.2.min.js') }}"></script>
        @endpush
    @elseif($field['iconset'] == 'weathericon')
        @push('crud_fields_styles')
            <!-- Weather Icons -->
            <link rel="stylesheet" href="{{ asset('vendor/backpack/bootstrap-iconpicker/icon-fonts/weather-icons-1.2.0/css/weather-icons.min.css') }}"/>
        @endpush

        @push('crud_fields_scripts')
            <!-- Bootstrap-Iconpicker Iconset for Weather Icons -->
            <script type="text/javascript" src="{{ asset('vendor/backpack/bootstrap-iconpicker/bootstrap-iconpicker/js/iconset/iconset-weathericon-1.2.0.min.js') }}"></script>
        @endpush
    @elseif($field['iconset'] == 'mapicon')
        @push('crud_fields_styles')
            <!-- Map Icons -->
            <link rel="stylesheet" href="{{ asset('vendor/backpack/bootstrap-iconpicker/icon-fonts/map-icons-2.1.0/css/map-icons.min.css') }}"/>
        @endpush

        @push('crud_fields_scripts')
            <!-- Bootstrap-Iconpicker Iconset for Map Icons -->
            <script type="text/javascript" src="{{ asset('vendor/backpack/bootstrap-iconpicker/bootstrap-iconpicker/js/iconset/iconset-mapicon-2.1.0.min.js') }}"></script>
        @endpush
    @elseif($field['iconset'] == 'octicon')
        @push('crud_fields_styles')
            <!-- Octicons -->
            <link rel="stylesheet" href="{{ asset('vendor/backpack/bootstrap-iconpicker/icon-fonts/octicons-2.1.2/css/octicons.min.css') }}"/>
        @endpush

        @push('crud_fields_scripts')
            <!-- Bootstrap-Iconpicker Iconset for Octicons -->
            <script type="text/javascript" src="{{ asset('vendor/backpack/bootstrap-iconpicker/bootstrap-iconpicker/js/iconset/iconset-octicon-2.1.2.min.js') }}"></script>
        @endpush
    @elseif($field['iconset'] == 'typicon')
        @push('crud_fields_styles')
            <!-- Typicons -->
            <link rel="stylesheet" href="{{ asset('vendor/backpack/bootstrap-iconpicker/icon-fonts/typicons-2.0.6/css/typicons.min.css') }}"/>
        @endpush

        @push('crud_fields_scripts')
            <!-- Bootstrap-Iconpicker Iconset for Typicons -->
            <script type="text/javascript" src="{{ asset('vendor/backpack/bootstrap-iconpicker/bootstrap-iconpicker/js/iconset/iconset-typicon-2.0.6.min.js') }}"></script>
        @endpush
    @elseif($field['iconset'] == 'elusiveicon')
        @push('crud_fields_styles')
            <!-- Elusive Icons -->
            <link rel="stylesheet" href="{{ asset('vendor/backpack/bootstrap-iconpicker/icon-fonts/elusive-icons-2.0.0/css/elusive-icons.min.css') }}"/>
        @endpush

        @push('crud_fields_scripts')
            <!-- Bootstrap-Iconpicker Iconset for Elusive Icons -->
            <script type="text/javascript" src="{{ asset('vendor/backpack/bootstrap-iconpicker/bootstrap-iconpicker/js/iconset/iconset-elusiveicon-2.0.0.min.js') }}"></script>
        @endpush
    @elseif($field['iconset'] == 'materialdesign')
        @push('crud_fields_styles')
            <!-- Material Icons -->
            <link rel="stylesheet" href="{{ asset('vendor/backpack/bootstrap-iconpicker/icon-fonts/material-design-1.1.1/css/material-design-iconic-font.min.css') }}"/>
        @endpush

        @push('crud_fields_scripts')
            <!-- Bootstrap-Iconpicker Iconset for Material Design -->
            <script type="text/javascript" src="{{ asset('vendor/backpack/bootstrap-iconpicker/bootstrap-iconpicker/js/iconset/iconset-materialdesign-1.1.1.min.js') }}"></script>
        @endpush
    @else
        @push('crud_fields_styles')
            <!-- Font Awesome -->
            <link rel="stylesheet" href="{{ asset('vendor/backpack/bootstrap-iconpicker/icon-fonts/font-awesome-4.2.0/css/font-awesome.min.css') }}"/>
        @endpush

        @push('crud_fields_scripts')
            <!-- Bootstrap-Iconpicker Iconset for Font Awesome -->
            <script type="text/javascript" src="{{ asset('vendor/backpack/bootstrap-iconpicker/bootstrap-iconpicker/js/iconset/iconset-fontawesome-4.2.0.min.js') }}"></script>
        @endpush
    @endif

    {{-- FIELD EXTRA CSS  --}}
    @push('crud_fields_styles')
        <!-- Bootstrap-Iconpicker -->
        <link rel="stylesheet" href="{{ asset('vendor/backpack/bootstrap-iconpicker/bootstrap-iconpicker/css/bootstrap-iconpicker.min.css') }}"/>
    @endpush

    {{-- FIELD EXTRA JS --}}
    @push('crud_fields_scripts')
        <!-- Bootstrap-Iconpicker -->
        <script type="text/javascript" src="{{ asset('vendor/backpack/bootstrap-iconpicker/bootstrap-iconpicker/js/bootstrap-iconpicker.min.js') }}"></script>

        {{-- Bootstrap-Iconpicker - set hidden input value --}}
        <script>
            jQuery(document).ready(function($) {
                $('button[role=iconpicker]').on('change', function(e) {
                    $(this).siblings('input[type=hidden]').val(e.icon);
                });
            });
        </script>
    @endpush

@endif


{{-- Note: you can use @if ($crud->checkIfFieldIsFirstOfItsType($field, $fields)) to only load some CSS/JS once, even though there are multiple instances of it --}}

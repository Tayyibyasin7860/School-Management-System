<!-- upload multiple input -->
<div @include('crud::inc.field_wrapper_attributes') >
    <label>{!! $field['label'] !!}</label>
    @include('crud::inc.field_translatable_icon')

	{{-- Show the file name and a "Clear" button on EDIT form. --}}
	@if (isset($field['value']))
	@php
		if (is_string($field['value'])) {
			$values = json_decode($field['value'], true) ?? [];
		} else {
			$values = $field['value'];
		}
	@endphp
	@if (count($values))
    <div class="well well-sm file-preview-container">
    	@foreach($values as $key => $file_path)
    		<div class="file-preview">
    			@if (isset($field['temporary']))
		            <a target="_blank" href="{{ isset($field['disk'])?asset(\Storage::disk($field['disk'])->temporaryUrl($file_path, Carbon\Carbon::now()->addMinutes($field['temporary']))):asset($file_path) }}">{{ $file_path }}</a>
		        @else
		            <a target="_blank" href="{{ isset($field['disk'])?asset(\Storage::disk($field['disk'])->url($file_path)):asset($file_path) }}">{{ $file_path }}</a>
		        @endif
		    	<a id="{{ $field['name'] }}_{{ $key }}_clear_button" href="#" class="btn btn-default btn-xs pull-right file-clear-button" title="Clear file" data-filename="{{ $file_path }}"><i class="fa fa-remove"></i></a>
		    	<div class="clearfix"></div>
	    	</div>
    	@endforeach
    </div>
    @endif
    @endif
	{{-- Show the file picker on CREATE form. --}}
	<input name="{{ $field['name'] }}[]" type="hidden" value="">
	<input
        type="file"
        id="{{ $field['name'] }}_file_input"
        name="{{ $field['name'] }}[]"
        value="@if (old(square_brackets_to_dots($field['name']))) old(square_brackets_to_dots($field['name'])) @elseif (isset($field['default'])) $field['default'] @endif"
        @include('crud::inc.field_attributes')
        multiple
    >

    {{-- HINT --}}
    @if (isset($field['hint']))
        <p class="help-block">{!! $field['hint'] !!}</p>
    @endif
</div>

{{-- FIELD EXTRA JS --}}
{{-- push things in the after_scripts section --}}

    @push('crud_fields_scripts')
        <!-- no scripts -->
        <script>
	        $(".file-clear-button").click(function(e) {
	        	e.preventDefault();
	        	var container = $(this).parent().parent();
	        	var parent = $(this).parent();
	        	// remove the filename and button
	        	parent.remove();
	        	// if the file container is empty, remove it
	        	if ($.trim(container.html())=='') {
	        		container.remove();
	        	}
	        	$("<input type='hidden' name='clear_{{ $field['name'] }}[]' value='"+$(this).data('filename')+"'>").insertAfter("#{{ $field['name'] }}_file_input");
	        });

	        $("#{{ $field['name'] }}_file_input").change(function() {
	        	console.log($(this).val());
	        	// remove the hidden input, so that the setXAttribute method is no longer triggered
	        	$(this).next("input[type=hidden]").remove();
	        });
        </script>
    @endpush

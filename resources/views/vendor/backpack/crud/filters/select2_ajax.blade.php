{{-- Select2 Ajax Backpack CRUD filter --}}

<li filter-name="{{ $filter->name }}"
	filter-type="{{ $filter->type }}"
	class="dropdown {{ Request::get($filter->name)?'active':'' }}">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{ $filter->label }} <span class="caret"></span></a>
    <div class="dropdown-menu ajax-select">
	    <div class="form-group m-b-0">
	    	<input type="text" value="{{ Request::get($filter->name)?Request::get($filter->name).'|'.Request::get($filter->name.'_text'):'' }}" id="filter_{{ $filter->name }}">
	    </div>
    </div>
  </li>

{{-- ########################################### --}}
{{-- Extra CSS and JS for this particular filter --}}

{{-- FILTERS EXTRA CSS  --}}
{{-- push things in the after_styles section --}}

@push('crud_list_styles')
    <!-- include select2 css-->
    <link href="{{ asset('vendor/backpack/select2/select2.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('vendor/backpack/select2/select2-bootstrap-dick.css') }}" rel="stylesheet" type="text/css" />
    <style>
	  .form-inline .select2-container {
	    display: inline-block;
	  }
	  .select2-drop-active {
	  	border:none;
	  }
	  .select2-container .select2-choices .select2-search-field input, .select2-container .select2-choice, .select2-container .select2-choices {
	  	border: none;
	  }
	  .select2-container-active .select2-choice {
	  	border: none;
	  	box-shadow: none;
	  }
    </style>
@endpush


{{-- FILTERS EXTRA JS --}}
{{-- push things in the after_scripts section --}}

@push('crud_list_scripts')
	<!-- include select2 js-->
    <script src="{{ asset('vendor/backpack/select2/select2.js') }}"></script>
    @if (app()->getLocale() !== 'en')
    <script src="{{ asset('vendor/backpack/select2/select2_locale_' . app()->getLocale() . '.js') }}"></script>
    @endif
    
    <script>
        jQuery(document).ready(function($) {
            // trigger select2 for each untriggered select2 box
            $('#filter_{{ $filter->name }}').select2({
			    minimumInputLength: 2,
            	allowClear: true,
        	    placeholder: '{{ $filter->placeholder ? $filter->placeholder : ' ' }}',
				closeOnSelect: false,
			    // tags: [],
			    ajax: {
			        url: '{{ $filter->values }}',
			        dataType: 'json',
			        type: 'GET',
			        quietMillis: 50,
			        data: function (term) {
			            return {
			                term: term
			            };
			        },
			        results: function (data) {
			            return {
			                results: $.map(data, function (item, i) {
			                    return {
			                        text: item,
			                        id: i
			                    }
			                })
			            };
			        }
			    },
		        initSelection: function (element, callback) {
		        	var value = element.val().split('|');
		        	var results = [];

		        	if (value != '') {
		        		results.push({
				          id: value[0],
				          text: value[1]
				        });
		        	}
				    callback(results[0]);
				}
			}).on('change', function (evt) {
				var val = $(this).val();
				var val_text = $(this).select2('data')?$(this).select2('data').text:null;
				var parameter = '{{ $filter->name }}';

		    	// behaviour for ajax table
				var ajax_table = $('#crudTable').DataTable();
				var current_url = ajax_table.ajax.url();
				var new_url = addOrUpdateUriParameter(current_url, parameter, val);
				if (val_text) {
                    new_url = addOrUpdateUriParameter(new_url, parameter + '_text', val_text);
				}
				new_url = normalizeAmpersand(new_url.toString());


				// replace the datatables ajax url with new_url and reload it
				ajax_table.ajax.url(new_url).load();

				// add filter to URL
				crud.updateUrl(new_url);

				// mark this filter as active in the navbar-filters
				if (URI(new_url).hasQuery('{{ $filter->name }}', true)) {
					$('li[filter-name={{ $filter->name }}]').removeClass('active').addClass('active');
				} else {
					$('li[filter-name={{ $filter->name }}]').trigger('filter:clear');
				}
			});

			// when the dropdown is opened, autofocus on the select2
			$('li[filter-name={{ $filter->name }}]').on('shown.bs.dropdown', function () {
				$('#filter_{{ $filter->name }}').select2('open');
			});

			// clear filter event (used here and by the Remove all filters button)
			$('li[filter-name={{ $filter->name }}]').on('filter:clear', function(e) {
				// console.log('select2 filter cleared');
				$('li[filter-name={{ $filter->name }}]').removeClass('active');
                $('#filter_{{ $filter->name }}').select2('val', '');
			});
        });
    </script>
@endpush
{{-- End of Extra CSS and JS --}}
{{-- ########################################## --}}


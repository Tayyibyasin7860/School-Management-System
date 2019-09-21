<nav class="navbar navbar-default navbar-filters">
    <div class="container-fluid">
      <!-- Brand and toggle get grouped for better mobile display -->
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
          <span class="sr-only">{{ trans('backpack::crud.toggle_filters') }}</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false"><i class="fa fa-filter"></i> <span class="hidden-md hidden-lg">{{ trans('backpack::crud.filters') }}</span></a>
      </div>

      <!-- Collect the nav links, forms, and other content for toggling -->
      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav">
          <!-- THE ACTUAL FILTERS -->
    			@foreach ($crud->filters as $filter)
    				@include($filter->view)
    			@endforeach
          <li ><a href="#" id="remove_filters_button" class="{{ count(Request::input()) != 0 ? '' : 'hidden' }}"><i class="fa fa-eraser"></i> {{ trans('backpack::crud.remove_filters') }}</a></li>
        </ul>
      </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
  </nav>

@push('crud_list_scripts')
	<script src="https://cdnjs.cloudflare.com/ajax/libs/URI.js/1.18.2/URI.min.js" type="text/javascript"></script>
    <script>
      function addOrUpdateUriParameter(uri, parameter, value) {
            var new_url = normalizeAmpersand(uri);

            new_url = URI(new_url).normalizeQuery();

            if (new_url.hasQuery(parameter)) {
              new_url.removeQuery(parameter);
            }

            if (value != '') {
              new_url = new_url.addQuery(parameter, value);
            }

            $('#remove_filters_button').removeClass('hidden');

        return new_url.toString();

      }

      function normalizeAmpersand(string) {
        return string.replace(/&amp;/g, "&").replace(/amp%3B/g, "");
      }

      // button to remove all filters
      jQuery(document).ready(function($) {
      	$("#remove_filters_button").click(function(e) {
      		e.preventDefault();

		    	// behaviour for ajax table
		    	var new_url = '{{ url($crud->route.'/search') }}';
		    	var ajax_table = $("#crudTable").DataTable();

  				// replace the datatables ajax url with new_url and reload it
  				ajax_table.ajax.url(new_url).load();

  				// clear all filters
  				$(".navbar-filters li[filter-name]").trigger('filter:clear');

          // remove filters from URL
          crud.updateUrl(new_url);
      	});

        // hide the Remove filters button when no filter is active
        $(".navbar-filters li[filter-name]").on('filter:clear', function() {
          var anyActiveFilters = false;
          $(".navbar-filters li[filter-name]").each(function () {
            if ($(this).hasClass('active')) {
              anyActiveFilters = true;
              console.log('ACTIVE FILTER');
            }
          });

          if (anyActiveFilters == false) {
            $('#remove_filters_button').addClass('hidden');
          }
        });
      });
    </script>
@endpush

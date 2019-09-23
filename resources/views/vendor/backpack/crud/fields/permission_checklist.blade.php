<!-- select2 from array -->

<div @include('crud::inc.field_wrapper_attributes') >
<div class="row dataTables_wrapper form-inline dt-bootstrap" id="crudTable_wrapper">
    <div class="col-sm-6 hidden-xs"></div>
    <div class="col-sm-6 hidden-print">
        <div id="crudTable_filter" class="dataTables_filter">
            <label class="pull-right">
                Search:&nbsp; <input id="filterInput" onkeyup="filterOptions()" placeholder="" type="search" class="form-control input-sm" >
            </label>
        </div>
    </div>
</div>

    <label>{!! $field['label'] !!}</label>




    <div class="row" id="subfilterNamesContainer">
        @foreach ($field['options'] as $key => $value)
            <div class="col-sm-4">
                <div class="checkbox">
                  <label>

                  @if((old($field['name']) && (
                                          $key == old($field['name']) ||
                                          (is_array(old($field['name'])) &&
                                          in_array($key, old($field['name']))))) ||
                                          (null === old($field['name']) &&
                                              ((isset($field['value']) && (
                                                          $key == $field['value'] || (
                                                                  is_array($field['value']) &&
                                                                  in_array($key, $field['value'])
                                                                  )
                                                          )) ||
                                                  (isset($field['default']) &&
                                                  ($key == $field['default'] || (
                                                                  is_array($field['default']) &&
                                                                  in_array($key, $field['default'])
                                                              )
                                                          )
                                                  ))
                                          ))
                    <input checked type="checkbox"
                      name="{{ $field['name'] }}[]"
                      value="{{ $value }}"
                      >
                     <span class="text-primary">{!! $value !!}</span>
                   @else
                   <input type="checkbox"
                                         name="{{ $field['name'] }}[]"
                                         value="{{ $value }}"

                                         >
                                         <span>{!! $value !!}</span>
                                         @endif

                  </label>
                </div>
            </div>
        @endforeach

    </div>

        {{-- HINT --}}
        @if (isset($field['hint']))
            <p class="help-block">{!! $field['hint'] !!}</p>
        @endif
    </div>



 @push('crud_fields_scripts')
    <script>
            jQuery(document).ready(function($) {


    function sortGiveNamesFilter() {
        $('#subfilterNamesContainer .col-sm-4').sort(function(a, b) {
            var $a = $(a).find(':checkbox'),
                $b = $(b).find(':checkbox');

            if ($a.is(':checked') && !$b.is(':checked'))
                return -1;
            else if (!$a.is(':checked') && $b.is(':checked'))
                return 1;

            return 0;
        }).appendTo('#subfilterNamesContainer');

        $('#subfilterNamesContainer .default:last, #subfilterNamesContainer :checked:last').closest('.col-sm-4').after('<div class="form-group col-xs-12"><hr></div>');
    }

    //sortGiveNamesFilter();




    });

    function filterOptions() {
      // Declare variables
      var input, filter, ul, li, a, i, txtValue;
      input = document.getElementById('filterInput');
      filter = input.value.toUpperCase();
      ul = document.getElementById("subfilterNamesContainer");
      li = ul.getElementsByClassName('col-sm-4');

      // Loop through all list items, and hide those who don't match the search query
      for (i = 0; i < li.length; i++) {
        a = li[i].getElementsByTagName("span")[0];
        txtValue = a.textContent || a.innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
          li[i].style.display = "";
        } else {
          li[i].style.display = "none";
        }
      }
    }
    </script>

    @endpush
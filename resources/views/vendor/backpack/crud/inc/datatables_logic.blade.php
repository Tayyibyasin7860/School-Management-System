  <!-- DATA TABLES SCRIPT -->
  <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js" type="text/javascript"></script>
  <script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js" type="text/javascript"></script>
  <script src="https://cdn.datatables.net/responsive/2.2.1/js/dataTables.responsive.min.js"></script>
  <script src="https://cdn.datatables.net/responsive/2.2.1/js/responsive.bootstrap.min.js"></script>
  <script src="
https://cdn.datatables.net/fixedheader/3.1.5/js/dataTables.fixedHeader.min.js"></script>

  <script>
    @if ($crud->getPersistentTable())
    // if there's a filtered URL saved for this list view, redirect to that one
    var saved_list_url = localStorage.getItem('{{ str_slug($crud->getRoute()) }}_list_url');
    if (saved_list_url && saved_list_url!=window.location.href) {
      window.location.href = localStorage.getItem('{{ str_slug($crud->getRoute()) }}_list_url');
    }
    @endif

    var crud = {
      exportButtons: JSON.parse('{!! json_encode($crud->export_buttons) !!}'),
      functionsToRunOnDataTablesDrawEvent: [],
      addFunctionToDataTablesDrawEventQueue: function (functionName) {
          if (this.functionsToRunOnDataTablesDrawEvent.indexOf(functionName) == -1) {
          this.functionsToRunOnDataTablesDrawEvent.push(functionName);
        }
      },
      responsiveToggle: function(dt) {
          $(dt.table().header()).find('th').toggleClass('all');
          dt.responsive.rebuild();
          dt.responsive.recalc();
      },
      executeFunctionByName: function(str, args) {
        var arr = str.split('.');
        var fn = window[ arr[0] ];

        for (var i = 1; i < arr.length; i++)
        { fn = fn[ arr[i] ]; }
        fn.apply(window, args);
      },
      updateUrl : function (new_url) {
        new_url = new_url.replace('/search', '');
        window.history.pushState({}, '', new_url);
        localStorage.setItem('{{ str_slug($crud->getRoute()) }}_list_url', new_url);
      },
      dataTableConfiguration: {

        @if ($crud->getResponsiveTable())
        responsive: {
            details: {
                display: $.fn.dataTable.Responsive.display.modal( {
                    header: function ( row ) {
                        // show the content of the first column
                        // as the modal header
                        var data = row.data();
                        return data[0];
                    }
                } ),
                renderer: function ( api, rowIdx, columns ) {

                  var data = $.map( columns, function ( col, i ) {
                      var columnHeading = crud.table.columns().header()[col.columnIndex];

                      // hide columns that have VisibleInModal false
                      if ($(columnHeading).attr('data-visible-in-modal') == 'false') {
                        return '';
                      }

                      return '<tr data-dt-row="'+col.rowIndex+'" data-dt-column="'+col.columnIndex+'">'+
                                '<td style="vertical-align:top; border:none;"><strong>'+col.title.trim()+':'+'<strong></td> '+
                                '<td style="padding-left:10px;padding-bottom:10px; border:none;">'+col.data+'</td>'+
                              '</tr>';
                  } ).join('');

                  return data ?
                      $('<table class="table table-hover m-b-0">').append( '<tbody>' + data + '</tbody>' ) :
                      false;
                },
            }
        },
        fixedHeader: true,
        @else
        responsive: false,
        scrollX: true,
        @endif

        @if ($crud->getPersistentTable())
        stateSave: true,
        @endif
        autoWidth: false,
        pageLength: {{ $crud->getDefaultPageLength() }},
        lengthMenu: @json($crud->getPageLengthMenu()),
        /* Disable initial sort */
        aaSorting: [],
        language: {
              "emptyTable":     "{{ trans('backpack::crud.emptyTable') }}",
              "info":           "{{ trans('backpack::crud.info') }}",
              "infoEmpty":      "{{ trans('backpack::crud.infoEmpty') }}",
              "infoFiltered":   "{{ trans('backpack::crud.infoFiltered') }}",
              "infoPostFix":    "{{ trans('backpack::crud.infoPostFix') }}",
              "thousands":      "{{ trans('backpack::crud.thousands') }}",
              "lengthMenu":     "{{ trans('backpack::crud.lengthMenu') }}",
              "loadingRecords": "{{ trans('backpack::crud.loadingRecords') }}",
              "processing":     "<img src='{{ asset('vendor/backpack/crud/img/ajax-loader.gif') }}' alt='{{ trans('backpack::crud.processing') }}'>",
              "search":         "{{ trans('backpack::crud.search') }}",
              "zeroRecords":    "{{ trans('backpack::crud.zeroRecords') }}",
              "paginate": {
                  "first":      "{{ trans('backpack::crud.paginate.first') }}",
                  "last":       "{{ trans('backpack::crud.paginate.last') }}",
                  "next":       ">",
                  "previous":   "<"
              },
              "aria": {
                  "sortAscending":  "{{ trans('backpack::crud.aria.sortAscending') }}",
                  "sortDescending": "{{ trans('backpack::crud.aria.sortDescending') }}"
              },
              "buttons": {
                  "copy":   "{{ trans('backpack::crud.export.copy') }}",
                  "excel":  "{{ trans('backpack::crud.export.excel') }}",
                  "csv":    "{{ trans('backpack::crud.export.csv') }}",
                  "pdf":    "{{ trans('backpack::crud.export.pdf') }}",
                  "print":  "{{ trans('backpack::crud.export.print') }}",
                  "colvis": "{{ trans('backpack::crud.export.column_visibility') }}"
              },
          },
          processing: true,
          serverSide: true,
          ajax: {
              "url": "{!! url($crud->route.'/search').'?'.Request::getQueryString() !!}",
              "type": "POST"
          },
          dom:
            "<'row hidden'<'col-sm-6 hidden-xs'i><'col-sm-6 hidden-print'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row m-t-10'<'col-sm-6 col-md-4'l><'col-sm-2 col-md-4 text-center'B><'col-sm-6 col-md-4 hidden-print'p>>",
      }
  }
  </script>

  @include('crud::inc.export_buttons')

  <script type="text/javascript">
    jQuery(document).ready(function($) {

      crud.table = $("#crudTable").DataTable(crud.dataTableConfiguration);

      // move search bar
      $("#crudTable_filter").appendTo($('#datatable_search_stack' ));

      // move "showing x out of y" info to header
      $("#datatable_info_stack").html($('#crudTable_info'));

      // move the bottom buttons before pagination
      $("#bottom_buttons").insertBefore($('#crudTable_wrapper .row:last-child' ));

      // override ajax error message
      $.fn.dataTable.ext.errMode = 'none';
      $('#crudTable').on('error.dt', function(e, settings, techNote, message) {
          new PNotify({
              type: "error",
              title: "{{ trans('backpack::crud.ajax_error_title') }}",
              text: "{{ trans('backpack::crud.ajax_error_text') }}"
          });
      });

      // make sure AJAX requests include XSRF token
      $.ajaxPrefilter(function(options, originalOptions, xhr) {
          var token = $('meta[name="csrf_token"]').attr('content');

          if (token) {
                return xhr.setRequestHeader('X-XSRF-TOKEN', token);
          }
      });

      // on DataTable draw event run all functions in the queue
      // (eg. delete and details_row buttons add functions to this queue)
      $('#crudTable').on( 'draw.dt',   function () {
         crud.functionsToRunOnDataTablesDrawEvent.forEach(function(functionName) {
            crud.executeFunctionByName(functionName);
         });
      } ).dataTable();

      // when datatables-colvis (column visibility) is toggled
      // rebuild the datatable using the datatable-responsive plugin
      $('#crudTable').on( 'column-visibility.dt',   function (event) {
         crud.table.responsive.rebuild();
      } ).dataTable();

      @if ($crud->getResponsiveTable())
        // when columns are hidden by reponsive plugin,
        // the table should have the has-hidden-columns class
        crud.table.on( 'responsive-resize', function ( e, datatable, columns ) {
            if (crud.table.responsive.hasHidden()) {
              $("#crudTable").removeClass('has-hidden-columns').addClass('has-hidden-columns');
             } else {
              $("#crudTable").removeClass('has-hidden-columns');
             }
        } );
      @else
        // make sure the column headings have the same width as the actual columns
        // after the user manually resizes the window
        var resizeTimer;
        function resizeCrudTableColumnWidths() {
          clearTimeout(resizeTimer);
          resizeTimer = setTimeout(function() {
            // Run code here, resizing has "stopped"
            crud.table.columns.adjust();
          }, 250);
        }
        $(window).on('resize', function(e) {
          resizeCrudTableColumnWidths();
        });
        $(document).on('expanded.pushMenu', function(e) {
          resizeCrudTableColumnWidths();
        });
        $(document).on('collapsed.pushMenu', function(e) {
          resizeCrudTableColumnWidths();
        });
      @endif

    });
  </script>

  @include('crud::inc.details_row_logic')

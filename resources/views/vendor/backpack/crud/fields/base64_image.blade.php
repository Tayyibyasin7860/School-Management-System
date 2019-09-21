  <div class="form-group col-xs-12 image" data-preview="#{{ $field['name'] }}" data-aspectRatio="{{ isset($field['aspect_ratio']) ? $field['aspect_ratio'] : 0 }}" data-crop="{{ isset($field['crop']) ? $field['crop'] : false }}" @include('crud::inc.field_wrapper_attributes')>
    <div>
        <label>{!! $field['label'] !!}</label>
        @include('crud::inc.field_translatable_icon')
    </div>
    <!-- Wrap the image or canvas element with a block element (container) -->
    <div class="row">
        <div class="col-sm-6" style="margin-bottom: 20px;">
            @if(!is_null(old(square_brackets_to_dots($field['name']))))
                <img id="mainImage" src="{{ old(square_brackets_to_dots($field['name'])) }}">
            @elseif(isset($field['src']) && isset($entry))
                <img id="mainImage" src="{{ $entry->find($entry->id)->{$field['src']}() }}">
            @elseif(isset($field['value']))
                <img id="mainImage" src="{{ $field['value'] }}">
            @elseif(isset($field['default']))
                <img id="mainImage" src="{{ $field['default'] }}">
            @else
                <img id="mainImage" src="">
            @endif
        </div>
        @if(isset($field['crop']) && $field['crop'])
        <div class="col-sm-3">
            <div class="docs-preview clearfix">
                <div id="{{ $field['name'] }}" class="img-preview preview-lg">
                    <img src="" style="display: block; min-width: 0px !important; min-height: 0px !important; max-width: none !important; max-height: none !important; margin-left: -32.875px; margin-top: -18.4922px; transform: none;">
                </div>
            </div>
        </div>
        @endif
        <input type="hidden" id="hiddenFilename" name="{{ $field['filename'] }}" value="">
    </div>
    <div class="btn-group">
        <label class="btn btn-primary btn-file">
            Choose file <input type="file" accept="image/*" id="uploadImage" @include('crud::inc.field_attributes', ['default_class' => 'hide'])>
            <input type="hidden" id="hiddenImage" name="{{ $field['name'] }}">
        </label>
        @if(isset($field['crop']) && $field['crop'])
        <button class="btn btn-default" id="rotateLeft" type="button" style="display: none;"><i class="fa fa-rotate-left"></i></button>
        <button class="btn btn-default" id="rotateRight" type="button" style="display: none;"><i class="fa fa-rotate-right"></i></button>
        <button class="btn btn-default" id="zoomIn" type="button" style="display: none;"><i class="fa fa-search-plus"></i></button>
        <button class="btn btn-default" id="zoomOut" type="button" style="display: none;"><i class="fa fa-search-minus"></i></button>
        <button class="btn btn-warning" id="reset" type="button" style="display: none;"><i class="fa fa-times"></i></button>
        @endif
        <button class="btn btn-danger" id="remove" type="button"><i class="fa fa-trash"></i></button>
    </div>

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
        {{-- YOUR CSS HERE --}}
        <link href="{{ asset('vendor/backpack/cropper/dist/cropper.min.css') }}" rel="stylesheet" type="text/css" />
        <style>
            .hide {
                display: none;
            }
            .image .btn-group {
                margin-top: 10px;
            }
            img {
                max-width: 100%; /* This rule is very important, please do not ignore this! */
            }
            .img-container, .img-preview {
                width: 100%;
                text-align: center;
            }
            .img-preview {
                float: left;
                margin-right: 10px;
                margin-bottom: 10px;
                overflow: hidden;
            }
            .preview-lg {
                width: 263px;
                height: 148px;
            }

            .btn-file {
                position: relative;
                overflow: hidden;
            }
            .btn-file input[type=file] {
                position: absolute;
                top: 0;
                right: 0;
                min-width: 100%;
                min-height: 100%;
                font-size: 100px;
                text-align: right;
                filter: alpha(opacity=0);
                opacity: 0;
                outline: none;
                background: white;
                cursor: inherit;
                display: block;
            }
        </style>
    @endpush

    {{-- FIELD JS - will be loaded in the after_scripts section --}}
    @push('crud_fields_scripts')
        {{-- YOUR JS HERE --}}
        <script src="{{ asset('vendor/backpack/cropper/dist/cropper.min.js') }}"></script>
        <script>
            jQuery(document).ready(function($) {
                // Loop through all instances of the image field
                $('.form-group.image').each(function(index){
                    // Find DOM elements under this form-group element
                    var $mainImage = $(this).find('#mainImage');
                    var $uploadImage = $(this).find("#uploadImage");
                    var $hiddenImage = $(this).find("#hiddenImage");
                    var $hiddenFilename = $(this).find("#hiddenFilename");
                    var $rotateLeft = $(this).find("#rotateLeft")
                    var $rotateRight = $(this).find("#rotateRight")
                    var $zoomIn = $(this).find("#zoomIn")
                    var $zoomOut = $(this).find("#zoomOut")
                    var $reset = $(this).find("#reset")
                    var $remove = $(this).find("#remove")
                    // Options either global for all image type fields, or use 'data-*' elements for options passed in via the CRUD controller
                    var options = {
                        viewMode: 2,
                        checkOrientation: false,
                        autoCropArea: 1,
                        responsive: true,
                        preview : $(this).attr('data-preview'),
                        aspectRatio : $(this).attr('data-aspectRatio')
                    };
                    var crop = $(this).attr('data-crop');

                    // Hide 'Remove' button if there is no image saved
                    if (!$mainImage.attr('src')){
                        $remove.hide();
                    }
                    // Initialise hidden form input in case we submit with no change
                    $hiddenImage.val($mainImage.attr('src'));


                    // Only initialize cropper plugin if crop is set to true
                    if(crop){

                        $remove.click(function() {
                            $mainImage.cropper("destroy");
                            $mainImage.attr('src','');
                            $hiddenImage.val('');
                            if (filename == "true"){
                                $hiddenFilename.val('removed');
                            }
                            $rotateLeft.hide();
                            $rotateRight.hide();
                            $zoomIn.hide();
                            $zoomOut.hide();
                            $reset.hide();
                            $remove.hide();
                        });
                    } else {

                        $(this).find("#remove").click(function() {
                            $mainImage.attr('src','');
                            $hiddenImage.val('');
                            $hiddenFilename.val('removed');
                            $remove.hide();
                        });
                    }

                    //Set hiddenFilename field to 'removed' if image has been removed.
                    //Otherwise hiddenFilename will be null if no changes have been made.

                    $uploadImage.change(function() {
                        var fileReader = new FileReader(),
                                files = this.files,
                                file;

                        if (!files.length) {
                            return;
                        }
                        file = files[0];

                        if (/^image\/\w+$/.test(file.type)) {
                            $hiddenFilename.val(file.name);
                            fileReader.readAsDataURL(file);
                            fileReader.onload = function () {
                                $uploadImage.val("");
                                if(crop){
                                    $mainImage.cropper(options).cropper("reset", true).cropper("replace", this.result);
                                    // Override form submit to copy canvas to hidden input before submitting
                                    $('form').submit(function() {
                                        var imageURL = $mainImage.cropper('getCroppedCanvas').toDataURL(file.type);
                                        $hiddenImage.val(imageURL);
                                        return true; // return false to cancel form action
                                    });
                                    $rotateLeft.click(function() {
                                        $mainImage.cropper("rotate", 90);
                                    });
                                    $rotateRight.click(function() {
                                        $mainImage.cropper("rotate", -90);
                                    });
                                    $zoomIn.click(function() {
                                        $mainImage.cropper("zoom", 0.1);
                                    });
                                    $zoomOut.click(function() {
                                        $mainImage.cropper("zoom", -0.1);
                                    });
                                    $reset.click(function() {
                                        $mainImage.cropper("reset");
                                    });
                                    $rotateLeft.show();
                                    $rotateRight.show();
                                    $zoomIn.show();
                                    $zoomOut.show();
                                    $reset.show();
                                    $remove.show();

                                } else {
                                    $mainImage.attr('src',this.result);
                                    $hiddenImage.val(this.result);
                                    $remove.show();
                                }
                            };
                        } else {
                            alert("Please choose an image file.");
                        }
                    });

                });
            });
        </script>


    @endpush
@endif
{{-- End of Extra CSS and JS --}}
{{-- ########################################## --}}

@php
    $horizontalTabs = $crud->getTabsType()=='horizontal' ? true : false;

    if ($errors->any() && array_key_exists(array_keys($errors->messages())[0], $crud->getCurrentFields()) &&
        array_key_exists('tab', $crud->getCurrentFields()[array_keys($errors->messages())[0]])) {
        $tabWithError = ($crud->getCurrentFields()[array_keys($errors->messages())[0]]['tab']);
    }
@endphp

@push('crud_fields_styles')
    <style>
        .nav-tabs-custom {
            box-shadow: none;
        }
        .nav-tabs-custom > .nav-tabs.nav-stacked > li {
            margin-right: 0;
        }

        .tab-pane .form-group h1:first-child,
        .tab-pane .form-group h2:first-child,
        .tab-pane .form-group h3:first-child {
            margin-top: 0;
        }
    </style>
@endpush

@if ($crud->getFieldsWithoutATab()->filter(function ($value, $key) { return $value['type'] != 'hidden'; })->count())
<div class="box p-t-20">
    <div class="box-body">
    @include('crud::inc.show_fields', ['fields' => $crud->getFieldsWithoutATab()])
    </div>
</div>
@else
    @include('crud::inc.show_fields', ['fields' => $crud->getFieldsWithoutATab()])
@endif

<div class="tab-container {{ $horizontalTabs ? 'col-xs-12' : 'col-xs-3 m-t-10' }}">

    <div class="nav-tabs-custom" id="form_tabs">
        <ul class="nav {{ $horizontalTabs ? 'nav-tabs' : 'nav-stacked nav-pills'}}" role="tablist">
            @foreach ($crud->getTabs() as $k => $tab)
                <li role="presentation" class="{{ isset($tabWithError) ? ($tab == $tabWithError ? 'active' : '') : ($k == 0 ? 'active' : '') }}">
                    <a href="#tab_{{ str_slug($tab, "") }}" aria-controls="tab_{{ str_slug($tab, "") }}" role="tab" tab_name="{{ str_slug($tab, "") }}" data-toggle="tab" class="tab_toggler">{{ $tab }}</a>
                </li>
            @endforeach
        </ul>
    </div>

</div>

<div class="tab-content panel {{$horizontalTabs ? 'col-md-12' : 'col-md-8 m-t-10'}}">

    @foreach ($crud->getTabs() as $k => $tab)
    <div role="tabpanel" class="tab-pane{{ isset($tabWithError) ? ($tab == $tabWithError ? ' active' : '') : ($k == 0 ? ' active' : '') }}" id="tab_{{ str_slug($tab, "") }}">

        @include('crud::inc.show_fields', ['fields' => $crud->getTabFields($tab)])

    </div>
    @endforeach

</div>

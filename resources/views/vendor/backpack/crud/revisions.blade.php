@extends('backpack::layout')

@section('header')
  <section class="content-header">
    <h1>
        <span class="text-capitalize">{!! $crud->getHeading() ?? $crud->entity_name_plural !!}</span>
        <small>{!! $crud->getSubheading() ?? trans('backpack::crud.revisions') !!}.</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{ url(config('backpack.base.route_prefix'),'dashboard') }}">{{ trans('backpack::crud.admin') }}</a></li>
      <li><a href="{{ url($crud->route) }}" class="text-capitalize">{{ $crud->entity_name_plural }}</a></li>
      <li class="active">{{ trans('backpack::crud.revisions') }}</li>
    </ol>
  </section>
@endsection

@section('content')
@if ($crud->hasAccess('list'))
  <a href="{{ url($crud->route) }}" class="hidden-print"><i class="fa fa-angle-double-left"></i> {{ trans('backpack::crud.back_to_all') }} <span>{{ $crud->entity_name_plural }}</span></a>
@endif
<div class="row m-t-20">
  <div class="{{ $crud->getRevisionsTimelineContentClass() }}">
    <!-- Default box -->

    @if(!count($revisions))
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">{{ trans('backpack::crud.no_revisions') }}</h3>
        </div>
      </div>
    @else
      @include('crud::inc.revision_timeline')
    @endif
  </div>
</div>
@endsection


@section('after_styles')
  <link rel="stylesheet" href="{{ asset('vendor/backpack/crud/css/crud.css') }}">
  <link rel="stylesheet" href="{{ asset('vendor/backpack/crud/css/revisions.css') }}">
@endsection

@section('after_scripts')
  <script src="{{ asset('vendor/backpack/crud/js/crud.js') }}"></script>
  <script src="{{ asset('vendor/backpack/crud/js/revisions.js') }}"></script>
@endsection
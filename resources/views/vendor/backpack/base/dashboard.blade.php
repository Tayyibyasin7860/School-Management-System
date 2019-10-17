@extends('backpack::layout')

@section('header')
    <section class="content-header">
      <h1>
        {{ trans('backpack::base.dashboard') }}<small>{{ trans('backpack::base.first_page_you_see') }}</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ backpack_url() }}">{{ config('backpack.base.project_name') }}</a></li>
        <li class="active">{{ trans('backpack::base.dashboard') }}</li>
      </ol>
    </section>
@endsection


@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="box">
                <div class="box-header with-border text-white" style="background-color: #3c8dbc; color: white;">
                    <div class="box-title">{{ trans('backpack::base.dashboard_disc_short') }}</div>
                </div>

                <div class="box-body">{{ trans('backpack::base.dashboard_disc_long') }}</div>
            </div>
        </div>
    </div>
@endsection

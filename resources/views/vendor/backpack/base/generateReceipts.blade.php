@extends('backpack::layout')
<?php use App\User;

?>
@section('header')
    <div class="container" style="margin-left:18px">
        <section class="content-header">
            <h1>
                Generate Fee Receipts
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{ backpack_url() }}">{{ config('backpack.base.project_name') }}</a></li>
                <li class="active">{{ trans('backpack::base.dashboard') }}</li>
            </ol>
        </section>
    </div>

@endsection


@section('content')
    <div class="col-md-6">
        <form id="contact-form" method="post" action="/admin/fee-receipt/generate">
            @csrf
                @if(session()->has('message')){
                    <div class="alert alert-success">
                        <strong>Success: </strong>{{ session()->get('message') }}
                    </div>
                @elseif(session()->has('errorMessage'))
                    <div class="alert alert-danger">
                        <strong>Failure: </strong>{{ session()->get('errorMessage') }}
                    </div>
                @endif
            <div class="controls">
                    <div class="col-md-12">
                        <div class="form-group required">
                            <label for="fee_type">Fee Type</label>
                            <select id="fee_type" class="form-control" name="fee_type">
                                <option value="">Select Fee Type</option>
                                @foreach($feeTypes as $feeType)
                                    <option value="{{$feeType->id}}">{{$feeType->type}}</option>
                                @endforeach
                            </select>
                            <small class="form-text text-muted text-danger">
                               {{ $errors->first('fee_type')}}
                            </small>
                        </div>
						<div class="form-group required">
                            <label for="class">Class</label>
                            <select id="class" class="form-control" name="class">
                                <option value="">Select Class</option>
                            @foreach($classRooms as $classRoom)
                                    <option value="{{$classRoom->id}}">{{$classRoom->title}}</option>
                                @endforeach
                            </select>
                            <small class="form-text text-muted text-danger">
                                 {{$errors->first('class')}}
                            </small>
                        </div>
                    </div>


                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="amount">Due Date</label>
                            <input style="width: 222px;" type="date" name="due_date" class="form-control" value="{{ old('due_date') }}" data-error="Valid email is required.">
                            <small class="form-text text-muted text-danger">
                                {{ $errors->first('due_date') }}
                            </small>
                        </div>
                    </div>



                <div class="col-md-12">
                    <input type="submit" class="btn btn-success btn-send" value="Send Receipts">
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <p class="text-muted">
                            <strong>*</strong> fields are required.
                        </p>
                    </div>
                </div>
            </div>

        </form>
    </div>

@endsection

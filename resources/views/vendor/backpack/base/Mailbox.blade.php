@extends('backpack::layout')
<?php use App\User;

?>
@section('header')
    <section class="content-header">
        <h1>
            Send Email to your students
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ backpack_url() }}">{{ config('backpack.base.project_name') }}</a></li>
            <li class="active">{{ trans('backpack::base.dashboard') }}</li>
        </ol>
    </section>
@endsection


@section('content')
    <div class="col-md-5">
        <form id="contact-form" method="post" action="/admin/mailbox">
            @csrf
            @if(session()->has('message'))
            <div class="alert alert-success">
                <strong>Success: </strong>{{ session()->get('message') }}
            </div>
            @endif
            <div class="controls">
                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group">
                            <label for="category">Category</label>
                            <select id="category" class="form-control" name="category">
                                <option value="one">Chosen recipient</option>
                                <option value="fee_defaulters">Fee defaulters</option>
                                <option value="announced_results">Announced Results</option>
                                <option value="all">All Students</option>
                            </select>
                        </div>
                        <div class="text-danger">
                            {{ $errors->first('category') }}
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group">
                            <label for="form_email">Email</label>
                            <div id="help"></div>
                            <input id="form_email" type="email" name="email" class="form-control" value="{{ $student->email ?? '' }}" data-error="Valid email is required.">
                        </div>
                        <div class="text-danger">
                            {{ $errors->first('email') }}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="form_message">Message *</label>
                            <textarea id="form_message" name="message" class="form-control" placeholder="Email content here" rows="4" data-error="Please, leave us a message."></textarea>
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="text-danger">
                            {{ $errors->first('message') }}
                        </div>
                    </div>
                    <div class="col-md-12">
                        <input type="submit" class="btn btn-success btn-send" value="Send Email">
                    </div>
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
    <script>
        var yourSelect = document.getElementById( "category" );
        if(yourSelect.options[ yourSelect.selectedIndex ].value == 'Email all Pending Fee students'){
            document.getElementById('help').innerText = 'You dont have to fill this field if you want to send bulk email ';
        }
        else{
            document.getElementById('help').innerText = '';
        }
    </script>

@endsection

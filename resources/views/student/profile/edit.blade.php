@extends('layouts.app')
@section('title','Student | Edit Profile')

@section('content')
    <h4>You may change following details</h4>
    <div class="justify-content-center">
    <div class="col-md-8">
        <form method="post" action="/student/profile/{{ $user->id }}">
            @method('put')
            @csrf
            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" name="email" class="form-control"
                       value="{{ old('email') }}">
                <small class="form-text text-muted text-danger">
                    {{ $errors->first('email') }}
                </small>
            </div>
            <div class="form-group">
                <label for="phone_number">Phone Number</label>
                <input type="text" name="phone_number" class="form-control"
                       value="{{ old('phone_number') }}">
                <small class="form-text text-muted text-danger">
                    {{ $errors->first('phone_number') }}
                </small>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <small>(if you don't want to change password, then enter your old password)</small>
                <input type="password" name="password" class="form-control"
                       placeholder="Enter new Password">
                <small class="form-text text-muted text-danger">
                    {{ $errors->first('password') }}
                </small>
            </div>
            <div class="form-group">
                <label for="password_confirmation">Confirm Password</label>
                <input type="password" class="form-control" name="password_confirmation"
                       placeholder="Confirm Password">
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
    </div>
@endsection



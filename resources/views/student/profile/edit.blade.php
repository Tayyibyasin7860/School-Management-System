@extends('layouts.app')
@section('title', 'Profile')

@section('content')
    <form>
        <div class="form-group">
            <label for="exampleInputEmail1">Email address</label>
            <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
        </div>
        <div class="form-group form-check">
            <input type="checkbox" class="form-check-input" id="exampleCheck1">
            <label class="form-check-label" for="exampleCheck1">Check me out</label>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
{{--<tr data-dt-row="0" data-dt-column="7">--}}
{{--    <td style="padding-left:10px;padding-bottom:10px; border:none;">--}}
{{--        <form method="POST" action="{{ route('profile') }} ">--}}
{{--            @csrf--}}
{{--            @method('PUT')--}}
{{--            <input type="text" name="email" value="{{ $user->email }}"><br><br>--}}
{{--    </td>--}}
{{--</tr>--}}
{{--<tr data-dt-row="0" data-dt-column="8">--}}
{{--    <td style="vertical-align:top; border:none;"><strong>Phone--}}
{{--            Number:<strong></strong></strong></td>--}}
{{--    <td style="padding-left:10px;padding-bottom:10px; border:none;">--}}
{{--        <input type="text" name="email" value="{{ $student->phone_number }}"><br><br>--}}
{{--    </td>--}}
{{--</tr>--}}
{{--<tr data-dt-row="0" data-dt-column="9">--}}
{{--    <td style="vertical-align:top; border:none;">--}}
{{--        <strong>Password:<strong></strong></strong></td>--}}
{{--    <td style="padding-left:10px;padding-bottom:10px; border:none;">--}}
{{--        <input type="password" name="password"><br><br>--}}
{{--        <input type="password" name="password_confirmation" ><br><br>--}}
{{--        <button type="submit" class="btn btn-primary">Change Profile</button>--}}
{{--        </form>--}}
{{--    </td>--}}
{{--</tr>--}}
@endsection

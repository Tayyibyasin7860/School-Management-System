@extends('layouts.app')
@section('title', 'Profile')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Profile</div>

                    <div class="card-body">

                        <div class="well well-sm">
                            <div class="row">

                                <div class="col-sm-4 col-md-3">
                                    <img src="http://placehold.it/100x150" alt="" class="img-rounded img-responsive"/>
                                </div>
                                <div class="col-sm-6 col-md-8">
                                    <table class="table table-hover m-b-0">
                                        <tbody>
                                        <tr data-dt-row="0" data-dt-column="0">
                                            <td style="vertical-align:top; border:none;">
                                                <strong>Student ID:<strong></strong></strong>
                                            </td>
                                            <td style="padding-left:10px;padding-bottom:10px; border:none;">
                                                <span>{{ $user->id }}</span></td>
                                        </tr>
                                        <tr data-dt-row="0" data-dt-column="1">
                                            <td style="vertical-align:top; border:none;"><strong>Name:<strong></strong></strong>
                                            </td>
                                            <td style="padding-left:10px;padding-bottom:10px; border:none;">
                                                <span>{{ $user->name }}</span></td>
                                        </tr>
                                        <tr data-dt-row="0" data-dt-column="3">
                                            <td style="vertical-align:top; border:none;"><strong>Class:<strong></strong></strong>
                                            </td>
                                            <td style="padding-left:10px;padding-bottom:10px; border:none;">
                                                <span>{{ $student->class_id }}</span></td>
                                        </tr>
                                        <tr data-dt-row="0" data-dt-column="4">
                                            <td style="vertical-align:top; border:none;"><strong>Father
                                                    Name:<strong></strong></strong></td>
                                            <td style="padding-left:10px;padding-bottom:10px; border:none;"><span>{{ $student->father_name }}</span>
                                            </td>
                                        </tr>
                                        <tr data-dt-row="0" data-dt-column="5">
                                            <td style="vertical-align:top; border:none;">
                                                <strong>gender:<strong></strong></strong></td>
                                            <td style="padding-left:10px;padding-bottom:10px; border:none;">
                                                <span>{{ $student->gender }}</span></td>
                                        </tr>
                                        <tr data-dt-row="0" data-dt-column="6">
                                            <td style="vertical-align:top; border:none;"><strong>Date of
                                                    Birth:<strong></strong></strong></td>
                                            <td style="padding-left:10px;padding-bottom:10px; border:none;"><span>{{ $student->date_of_birth }}</span>
                                            </td>
                                        </tr>
                                        <tr data-dt-row="0" data-dt-column="7">
                                            <td style="vertical-align:top; border:none;"><strong>Email:<strong></strong></strong>
                                            </td>
                                            <td style="padding-left:10px;padding-bottom:10px; border:none;"><span>{{ $student->email }}</span>
                                            </td>
                                        </tr>
                                        <tr data-dt-row="0" data-dt-column="8">
                                            <td style="vertical-align:top; border:none;"><strong>Phone
                                                    Number:<strong></strong></strong></td>
                                            <td style="padding-left:10px;padding-bottom:10px; border:none;"><span>{{ $student->phone_number }}</span>
                                            </td>
                                        </tr>
                                        <tr data-dt-row="0" data-dt-column="9">
                                            <td style="vertical-align:top; border:none;">
                                                <strong>Password:<strong></strong></strong></td>
                                            <td style="padding-left:10px;padding-bottom:10px; border:none;">
                                                <form method="POST" action="{{ route('profile') }} ">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="password" name="password"><br><br>
                                                    <input type="password" name="password_confirmation" ><br><br>
                                                    <button type="submit" class="btn btn-primary">Change Password</button>
                                                </form>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

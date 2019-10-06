@extends('layouts.app')
@section('title','Student | Profile')

@section('content')
    @if(session()->has('message'))
        <div class="alert alert-success">
            {{ session()->get('message') }}
        </div>
    @endif
    <h4><img src="{{ asset('images/icon/db1.png') }}" alt=""/> My Profile</h4>
    <div class="sdb-tabl-com sdb-pro-table">
        <table class="responsive-table bordered">
            <tbody>
            <tr>
                <td>Student Name</td>
                <td>:</td>
                <td>{{ $user->name }}</td>
            </tr>
            <tr>
                <td>Student Id</td>
                <td>:</td>
                <td>{{ $user->id }}</td>
            </tr>
            <tr>
                <td>Class</td>
                <td>:</td>
                <td>{{ $student->class_id }}</td>
            </tr>
            <tr>
                <td>Gender</td>
                <td>:</td>
                <td>{{ $student->gender }}</td>
            </tr>
            <tr>
                <td>Email</td>
                <td>:</td>
                <td>{{ $user->email }}</td>
            </tr>
            <tr>
                <td>Phone</td>
                <td>:</td>
                <td>{{ $student->phone_number }}</td>
            </tr>
            <tr>
                <td>Date of birth</td>
                <td>:</td>
                <td>{{ $student->date_of_birth }}</td>
            </tr>
            <tr>
                <td>Address</td>
                <td>:</td>
                <td>{{ $student->address }}</td>
            </tr>
            </tbody>
        </table>
        <div class="sdb-bot-edit">
            <a href="profile/{{ $user->id }}/edit"
               class="waves-effect waves-light btn-large sdb-btn sdb-btn-edit btn btn-primary"><i
                    class="fa fa-pencil"></i> Edit My Profile</a>
        </div>
    </div>
@endsection

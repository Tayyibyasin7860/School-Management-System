@extends('layouts.app')
@section('title','Student | Results')

@section('content')
    <div class="con-title">
        <h2>My <span> Results</span></h2>
    </div>
    <table class="table text-capitalize">
        <thead>
        <th>
            <b>Exam Session</b>
        </th>
        <th>
            <b>Subject</b>
        </th>
        <th>
            <b>Total Marks</b>
        </th>
        <th>
            <b>Obtained Marks</b>
        </th>
        <th>
            <b>Teacher Remarks</b>
        </th>
        </thead>
        <tbody>
        @foreach($user_results as $result)
            <tr>
                <td>
                    <b>{{ $result->examSession->title . " " . $result->examSession->year }}</b>
                </td>
                <td>
                    {{ $result->subject->title }}
                </td>
                <td>
                    {{ $result->pivot->total_marks }}
                </td>
                <td>
                    {{ $result->pivot->obtained_marks }}
                </td>
                <td>
                    {{ $result->pivot->remarks }}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection

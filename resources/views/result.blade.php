@extends('layouts.app2')
@section('title', 'Student Results')

@section('content')
    <div class="con-title">
        <h2>My <span> Results</span></h2>
    </div>
    <table class="table text-capitalize">
        <thead>
        <th>
            <b>Result title</b>
        </th>
        <th>
            <b>Subject title</b>
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
                    {{ $result->Exam->title }}
                </td>
                <td>
                    {{ $result->Subject->title }}
                </td>
                <td>
                    {{ $result->total_marks }}
                </td>
                <td>
                    {{ $result->obtained_marks }}
                </td>
                <td>
                    {{ $result->remarks }}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection

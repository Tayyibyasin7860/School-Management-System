@extends('layouts.app')
@section('title','Student | Exams')
@section('content')
    <div class="con-title">
        <h2>My <span> Exams</span></h2>
    </div>
    <div class="tour_head1 udb-time-line days">

                <table class="table">
                    <thead>
                    <tr>
                        <th>
                            <b>Sr.#</b>
                        </th>
                        <th>
                            <b>Exam Session</b>
                        </th>
                        <th>
                            <b>Subject</b>
                        </th>
                        <th>
                            <b>Date</b>
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $rowNumber=1 ?>
                    @foreach($exams as $exam)
                    <tr>
                        <th scope="row">
                            <b>{{ $rowNumber++ }}</b>
                        </th>
                        <td>
                            {{ $exam->examSession->title . " " . $exam->examSession->year }}
                        </td>
                        <td>
                            {{ $exam->subject->title }}
                        </td>
                        <td>
                            {{ $exam->date }}
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
    </div>
@endsection

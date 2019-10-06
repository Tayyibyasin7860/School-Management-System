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
                            Sr.#
                        </th>
                        <th>
                            Exam Session
                        </th>
                        <th>
                            Subject
                        </th>
                        <th>
                            Date
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $rowNumber=1 ?>
                    @foreach($exams as $exam)
                    <tr>
                        <th scope="row">
                            {{ $rowNumber++ }}
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

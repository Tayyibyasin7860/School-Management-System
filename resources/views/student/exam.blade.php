@extends('layouts.app2')
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





{{--@extends('layouts.app')--}}
{{--@section('title', 'Exam')--}}

{{--@section('content')--}}
{{--    <div class="container">--}}
{{--        <div class="row justify-content-center">--}}
{{--            <div class="col-md-8">--}}
{{--                <div class="card">--}}
{{--                    <div class="card-header">--}}
{{--                        <h2 class="">My Exams</h2>--}}

{{--                    </div>--}}

{{--                    <div class="card-body">--}}
{{--                        <table class="table">--}}
{{--                            <thead>--}}
{{--                            <th>--}}
{{--                                Exam title--}}
{{--                            </th>--}}
{{--                            <th>--}}
{{--                                Subject title--}}
{{--                            </th>--}}
{{--                            <th>--}}
{{--                                Date--}}
{{--                            </th>--}}
{{--                            </thead>--}}
{{--                            <tbody>--}}
{{--                            @foreach($user_exams as $exam)--}}
{{--                            <tr>--}}
{{--                                <td>--}}
{{--                                    {{ $exam->title }}--}}
{{--                                </td>--}}
{{--                                <td>--}}
{{--                                    {{ $exam->Subject->title }}--}}
{{--                                </td>--}}
{{--                                <td>--}}
{{--                                    {{ $exam->date }}--}}
{{--                                </td>--}}
{{--                            </tr>--}}
{{--                                @endforeach--}}
{{--                            </tbody>--}}
{{--                        </table>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--@endsection--}}

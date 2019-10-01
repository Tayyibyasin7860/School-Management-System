@extends('layouts.app2')
@section('title','Student | Exams')
@section('content')
    <div class="con-title">
        <h2>My <span> Exams</span></h2>
    </div>
        <div class="tour_head1 udb-time-line days">
            <ul>
                @foreach($user_exams as $exam)
                <li class="l-info-pack-plac"> <i class="fa fa-clock-o" aria-hidden="true"></i>
                    <div class="sdb-cl-tim">
                        <div class="sdb-cl-day">
                            <h5>{{ $exam->title }}</h5>
                        </div>
                        <div class="sdb-cl-class">
                            <ul>
                                <li>
                                    <div class="sdb-cl-class-tim tooltipped" data-position="top" data-delay="50" data-tooltip="Exam timing" data-tooltip-id="5cca40ab-3e33-aaeb-dbee-ac092b8c0103">
                                        <span>Date: </span>
                                        <span>{{ $exam->date }}</span>
                                    </div>
                                    <div class="sdb-cl-class-name tooltipped" data-position="top" data-delay="50" data-tooltip="Exam name and status" data-tooltip-id="e427702a-1bc1-b3de-0ff4-29cbf030a936">
                                        <h5>{{ $exam->subject->title }}</h5>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </li>
                @endforeach
            </ul>
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

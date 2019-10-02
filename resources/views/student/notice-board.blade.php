@extends('layouts.app2')
@section('title','Student | Notice Board')

@section('content')
    <div class="ed-about-tit">
        <div class="con-title">
            <h2>School <span> Events</span></h2>
        </div>
        <div>
            <div class="ho-event pg-eve-main">
                <ul>
                    @foreach($all_announcements as $announcement)
                        <li>

                                <div class="ho-ev-date pg-eve-date">
                                    <span>{{ $announcement->date->format('d') }}</span><span>{{ $announcement->date->format('M') }}, 20{{ $announcement->date->format('y') }}</span>
                                </div>
                                <div class="s17-eve-time-msg">
                                    <h4>{{ $announcement->title }}</h4>
                                    <p>{{ $announcement->content }}</p>
                                </div>

                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 text-center">
                {{ $all_announcements->links() }}
            </div>
        </div>
    </div>
@endsection

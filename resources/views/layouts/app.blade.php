<!DOCTYPE html>
<html lang="en">


<head>
    <title> @yield('title') </title>
    <!-- META TAGS -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description"
          content="Education master is one of the best educational html template, it's suitable for all education websites like university,college,school,online education,tution center,distance education,computer education">
    <meta name="keyword"
          content="education html template, university template, college template, school template, online education template, tution center template">
    <!-- FAV ICON(BROWSER TAB ICON) -->
    <link rel="shortcut icon" href="{{ asset('images/fav.ico') }}" type="image/x-icon">
    <!-- GOOGLE FONT -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700%7CJosefin+Sans:600,700"
          rel="stylesheet">
    <!-- FONTAWESOME ICONS -->
    <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}">
    <!-- ALL CSS FILES -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet"/>
    <link href="{{ asset('css/style2.css') }}" rel="stylesheet"/>
    <!-- RESPONSIVE.CSS ONLY FOR MOBILE AND TABLET VIEWS -->
    <link href="{{ asset('css/style-mob.css') }}" rel="stylesheet"/>

</head>

<body>
@if(auth()->check())
<div class="pro-menu">
    <div class="container">
        <div class="col-md-8 col-md-offset-3">
            <ul>
                @if(Request::path() == 'student')
                    <li><a href="{{ route('dashboard') }}" class="pro-act">Dashboard</a></li>
                @else
                    <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
                @endif
                @if(Request::path() == 'student/profile')
                    <li><a href="{{ route('profile') }}" class="pro-act">My Profile</a></li>
                @else
                    <li><a href="{{ route('profile') }}">My Profile</a></li>
                @endif
                @if(Request::path() == 'student/fee')
                    <li><a href="{{ route('fee') }}" class="pro-act">Fee Receipts</a></li>
                @else
                    <li><a href="{{ route('fee') }}">Fee Receipts</a></li>
                @endif
                @if(Request::path() == 'student/exam')
                    <li><a href="{{ route('exam') }}" class="pro-act">Exams</a></li>
                @else
                    <li><a href="{{ route('exam') }}">Exams</a></li>
                @endif
                @if(Request::path() == 'student/result')
                    <li><a href="{{ route('result') }}" class="pro-act">Results</a></li>
                @else
                    <li><a href="{{ route('result') }}">Results</a></li>
                @endif
                @php

                    @endphp
                <li><a href="{{ route('notice-board') }}"
                       class="{{ (Request::is('student/notice-board/*')) ? 'pro-act' : ''}}">Notice Board</a></li>
                @if(Request::path() == 'student/feedback')
                    <li><a href="{{ route('feedback') }}" class="pro-act">Provide </a></li>
                @else
                    <li><a href="{{ route('feedback') }}">Provide Feedback</a></li>
                @endif
                <li>
                    <a class="dropdown-item" href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                        Logout
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
            </ul>
        </div>
    </div>
</div>
@endif
<div class="stu-db">
    <div class="container pg-inn">
        <div class="col-md-3">
            @if(auth()->check())
            <div class="pro-user"
                 style="border-radius: 50%;background-repeat:no-repeat; background-position: center; background-image:url({{ auth()->user()->StudentDetail->photo ? asset('storage/' . auth()->user()->StudentDetail->photo) : asset('storage/' . 'uploads/student-defualt-profile.jpg')}}); background-size: cover; width: 200px;height: 200px; ">
            </div>
            <form action="/student/update-photo/{{ auth()->user()->id }}" method="post" class="form"
                  enctype="multipart/form-data">
                @method('patch')
                @csrf
                <input type="file" name="photo" class="form-control">
                <input type="submit" class="btn btn-success" style="width: 100%;" value="Change Profile Picture">
            </form>


            <div class="pro-user-bio">
                <ul>
                    <li>
                        <h4>{{ auth()->user()->name }}</h4>
                    </li>
                    <li>Student Id: {{ auth()->user()->id }}</li>
                </ul>
            </div>
            @endif
        </div>
        <div class="col-md-9">
            <div class="udb">

                <div class="udb-sec udb-prof">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.js"></script>
@yield('page_level_js')
<!--Import jQuery before materialize.js-->
<script src="{{ asset('js/main.min.js') }}"></script>
<script src="{{ asset('js/custom.js') }}"></script>
</body>


</html>

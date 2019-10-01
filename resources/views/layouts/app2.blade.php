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

        <script>
            // .add('pro-act');
            // document.write(window.location.href);


                var v = document.getElementById("profile");
                v.classList += "pro-act";
        </script>
</head>

<body>

<div class="pro-menu">
    <div class="container">
        <div class="col-md-9 col-md-offset-3">
            <ul>
                @if(Request::path() == 'dashboard')
                <li><a href="{{ route('dashboard') }}" class="pro-act">My Dashboard</a></li>
                @else
                    <li><a href="{{ route('dashboard') }}">My Dashboard</a></li>
                @endif
                @if(Request::path() == 'student/profile')
                <li><a href="{{ route('profile') }}" class="pro-act">Profile</a></li>
                @else
                    <li><a href="{{ route('profile') }}">Profile</a></li>
                @endif
                @if(Request::path() == 'student/fee')
                    <li><a href="{{ route('fee') }}" class="pro-act">Fee</a></li>
                @else
                    <li><a href="{{ route('fee') }}">Fee</a></li>
                @endif
                @if(Request::path() == 'student/exam')
                    <li><a href="{{ route('exam') }}" class="pro-act">Exam</a></li>
                @else
                    <li><a href="{{ route('exam') }}">Exam</a></li>
                @endif
                @if(Request::path() == 'student/result')
                    <li><a href="{{ route('result') }}" class="pro-act">Result</a></li>
                @else
                    <li><a href="{{ route('result') }}">Result</a></li>
                @endif
                @if(Request::path() == 'student/notice-board')
                    <li><a href="{{ route('notice-board') }}" class="pro-act">notice-board</a></li>
                @else
                    <li><a href="{{ route('notice-board') }}">Notice Board</a></li>
                @endif
                <li>
                    <a class="dropdown-item" href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                        logout
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
            </ul>
        </div>
    </div>
</div>
<div class="stu-db">
    <div class="container pg-inn">
        <div class="col-md-3">
            <div class="pro-user">
                <img src="{{ asset('storage/' . $user->StudentDetail->photo) }}" alt="user" class="img-circle">
            </div>
            <form action="student/update-photo/{{ $user->id }}" method="post" class="form" enctype="multipart/form-data">
                @method('patch')
                @csrf
                <input type="file" name="photo" class="form-control">
                <input type="submit" class="btn btn-success" style="width: 100%;" value="Change Profile Picture">
            </form>


            <div class="pro-user-bio">
                <ul>
                    <li>
                        <h4>{{ $user->name }}</h4>
                    </li>
                    <li>Student Id: {{ $user->id }}</li>
                </ul>
            </div>
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

<!--Import jQuery before materialize.js-->
<script src="{{ asset('js/main.min.js') }}"></script>
<script src="{{ asset('images/fav.ico') }}"></script>
<script src="{{ asset('js/custom.js') }}"></script>
</body>


</html>

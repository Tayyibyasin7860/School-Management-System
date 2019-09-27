<!DOCTYPE html>
<html lang="en">


<head>
    <title>Education Master Template</title>
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
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    {{--<!--    <script src="{{ asset('js/html5shiv.js') }}"></script>-->--}}
    {{--<!--    <script src="{{ asset('js/respond.min.js') }}"></script>-->--}}
    <![endif]-->
</head>

<body>

{{--<section>--}}
{{--    <div class="ed-mob-menu">--}}
{{--        <div class="ed-mob-menu-con">--}}
{{--            <div class="ed-mm-left">--}}
{{--                <div class="wed-logo">--}}
{{--                    <a href="index-2.html"><img src="images/logo.png" alt="">--}}
{{--                    </a>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="ed-mm-right">--}}
{{--                <div class="ed-mm-menu">--}}
{{--                    <a href="#!" class="ed-micon"><i class="fa fa-bars"></i></a>--}}
{{--                    <div class="ed-mm-inn">--}}
{{--                        <a href="#!" class="ed-mi-close"><i class="fa fa-times"></i></a>--}}
{{--                        <h4>All Courses</h4>--}}
{{--                        <ul>--}}
{{--                            <li><a href="course-details.html">Accounting/Finance</a></li>--}}
{{--                            <li><a href="course-details.html">civil engineering</a></li>--}}
{{--                            <li><a href="course-details.html">Art/Design</a></li>--}}
{{--                            <li><a href="course-details.html">Marine Engineering</a></li>--}}
{{--                            <li><a href="course-details.html">Business Management</a></li>--}}
{{--                            <li><a href="course-details.html">Journalism/Writing</a></li>--}}
{{--                            <li><a href="course-details.html">Physical Education</a></li>--}}
{{--                            <li><a href="course-details.html">Political Science</a></li>--}}
{{--                            <li><a href="course-details.html">Sciences</a></li>--}}
{{--                            <li><a href="course-details.html">Statistics</a></li>--}}
{{--                            <li><a href="course-details.html">Web Design/Development</a></li>--}}
{{--                            <li><a href="course-details.html">SEO</a></li>--}}
{{--                            <li><a href="course-details.html">Google Business</a></li>--}}
{{--                            <li><a href="course-details.html">Graphics Design</a></li>--}}
{{--                            <li><a href="course-details.html">Networking Courses</a></li>--}}
{{--                            <li><a href="course-details.html">Information technology</a></li>--}}
{{--                        </ul>--}}
{{--                        <h4>User Account</h4>--}}
{{--                        <ul>--}}
{{--                            <li><a href="#!" data-toggle="modal" data-target="#modal1">Sign In</a></li>--}}
{{--                            <li><a href="#!" data-toggle="modal" data-target="#modal2">Register</a></li>--}}
{{--                        </ul>--}}
{{--                        <h4>All Pages</h4>--}}
{{--                        <ul>--}}
{{--                            <li><a href="index-2.html">Home</a></li>--}}
{{--                            <li><a href="about.html">About us</a></li>--}}
{{--                            <li><a href="admission.html">Admission</a></li>--}}
{{--                            <li><a href="all-courses.html">All courses</a></li>--}}
{{--                            <li><a href="course-details.html">Course details</a></li>--}}
{{--                            <li><a href="awards.html">Awards</a></li>--}}
{{--                            <li><a href="seminar.html">Seminar</a></li>--}}
{{--                            <li><a href="events.html">Events</a></li>--}}
{{--                            <li><a href="event-details.html">Event details</a></li>--}}
{{--                            <li><a href="event-register.html">Event register</a></li>--}}
{{--                            <li><a href="contact-us.html">Contact us</a></li>--}}
{{--                        </ul>--}}
{{--                        <h4>User Profile</h4>--}}
{{--                        <ul>--}}
{{--                            <li><a href="dashboard.html">User profile</a></li>--}}
{{--                            <li><a href="db-courses.html">Courses</a></li>--}}
{{--                            <li><a href="db-exams.html">Exams</a></li>--}}
{{--                            <li><a href="db-profile.html">Prfile</a></li>--}}
{{--                            <li><a href="db-time-line.html">Time line</a></li>--}}
{{--                        </ul>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</section>--}}

<div class="pro-menu">
    <div class="container">
        <div class="col-md-9 col-md-offset-3">
            <ul>
                <li><a href="dashboard.html">My Dashboard</a></li>
                <li><a href="{{ route('profile') }}" class="pro-act">Profile</a></li>
                <li><a href="{{ route('fee') }}">Fees</a></li>
                <li><a href="{{ route('exam') }}">Exams</a></li>
                <li><a href="{{ route('result') }}">Results</a></li>
                <li><a href="{{ route('notice-board') }}">Notice Board</a></li>
                <li><a href="#route('feedback')">Feedback</a></li>
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
            <form action="/update-photo/{{ $user->id }}" method="post" class="form" enctype="multipart/form-data">
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
<script src="{{ asset('js/materialize.min.js') }}"></script>
<script src="{{ asset('js/custom.js') }}"></script>
</body>


</html>

@extends('layouts.app2')




@section('content')

    <div class="col-lg-9 animated fadeInRight">
        <h2>
            Provide Feedback
            <p>Here you can provide feedback to management related to various tests/exams, results, announcements and
                any queries.</p>
        </h2>
        <div class="mail-box">


            <div class="mail-body">

                <form class="form-horizontal" method="get">
                    <div class="form-group"><label class="col-sm-2 control-label">Subject</label>

                        <div class="col-sm-10"><input name="subject" type="text" class="form-control"
                                                      value="{{old('subject')}}"></div>
                    </div>
                    <div class="form-group"><label class="col-sm-2 control-label">Feedback</label>

                        <div class="col-sm-10"><textarea name="feedback" class="form-control"
                                                         value="{{ old('feedback') }}" rows="5"></textarea></div>
                    </div>
                    <div class="mail-body text-right tooltip-demo">
                        <input type="submit" class="btn btn-sm btn-primary" data-toggle="tooltip" data-placement="top"
                           title="Send"></i></input>
                        <input type="reset" class="btn btn-white btn-sm" data-toggle="tooltip" data-placement="top"
                           title="Reset"></i></input>
                    </div>
                </form>

            </div>

            <div class="clearfix"></div>


        </div>
    </div>
@endsection

<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\Result;
use Backpack\NewsCRUD\app\Models\Article;
use Illuminate\Http\Request;
use App\Models\StudentDetail;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Hash;
use function GuzzleHttp\Promise\all;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
      $user = auth()->user();
        return view('student\index',compact('user'));
    }

    public function noticeBoard()
    {
        $user = auth()->user();
        $all_announcements = Article::paginate(5);
        return view('student.notice-board', compact('all_announcements','user'));
    }
    public function fee()
    {
        $user = auth()->user();
        $user_fees = $user->fees;
        return view('student.fee',compact('user','user_fees'));
    }
    public function exam()
    {
        //getting currrent user
        $user = auth()->user();
        //getting class of current user
        $class_id= $user->studentDetail->class_id;
        //getting all exams
        $exams = Exam::all();
        //getting exams of current user,s class
        $user_exams = $exams->where('class_id', $class_id);

        return view('student.exam', compact('user_exams','exams','user'));

    }
    public function result()
    {
        $user = auth()->user();
        $user_id= $user->id;
        $results = Result::all();
        $user_results = $results->where('user_id', $user_id);

        return view('student.result', compact('user_results','user'));
    }


}

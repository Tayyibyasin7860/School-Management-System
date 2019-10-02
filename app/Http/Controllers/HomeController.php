<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\ExamSession;
use App\Models\Result;
use Backpack\NewsCRUD\app\Models\Article;
use Illuminate\Http\Request;
use App\Models\StudentDetail;
use App\User;
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
        $user_admin = User::find(auth()->user()->id)->schoolAdmin->id;
        $all_announcements = Article::where('admin_id',$user_admin)->paginate(5);
//        $all_announcements = Article::paginate(5);
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
        $user_admin_sessions = User::find(auth()->user()->id)->schoolAdmin->examSessions;
        $user_class_id = User::find(auth()->user()->id)->studentDetail->class->id;
        $exams = [];
        foreach($user_admin_sessions as $user_admin_session){
            $user_admin_exams = $user_admin_session->exams->where('class_id',$user_class_id);
            foreach ($user_admin_exams as $exam){
                $exams [] = $exam;
            }
        }
//        $exam_sessions = $user_admin->examSessions()->where('admin_id','2');
//        foreach($user_admin_sessions as $user_admin_session){
//            print_r($user_admin_session->exams());
//        }
        return view('student.exam', compact('exams','user'));

    }
    public function result()
    {
        $user = auth()->user();
        $user_results = User::find(auth()->user()->id)->results;

        return view('student.result', compact('user_results','user'));
    }


}

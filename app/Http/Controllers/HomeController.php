<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\ExamSession;
use App\Models\FeeReceipt;
use App\Models\FeeType;
use App\Models\Result;
use Backpack\NewsCRUD\app\Models\Article;
use Illuminate\Http\Request;
use App\Models\StudentDetail;
use App\User;
use Illuminate\Support\Facades\Auth;
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

    public function home()
    {
        Auth::logout();
        return redirect('/login');
//        return view('auth.login');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = auth()->user();
        return view('student\index', compact('user'));
    }

    public function fee()
    {
        $user_id = auth()->user()->id;
        $user = User::find($user_id);

        return view('student.fee', compact('user'));
    }

    public function exam()
    {
        //getting current user
        $user = auth()->user();
        $user_admin_sessions = $user->schoolAdmin->examSessions;
        $user_class_id = $user->studentDetail->classRoom->id;
        $exams = [];
        foreach ($user_admin_sessions as $user_admin_session) {
            $user_admin_exams = $user_admin_session->exams->where('class_id', $user_class_id);
            foreach ($user_admin_exams as $exam) {
                $exams [] = $exam;
            }
        }
        return view('student.exam', compact('exams', 'user'));

    }

    public function result()
    {
        $user = auth()->user();
        $user_results = User::find(auth()->user()->id)->exams;

        return view('student.result', compact('user_results', 'user'));
    }


}

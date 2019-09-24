<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\Result;
use Backpack\NewsCRUD\app\Models\Article;
use Illuminate\Http\Request;
use App\Models\StudentDetails;
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
      // dd(auth()->user()->Student->id);
        return view('home');
    }

    public function profile()
    {
        $user = auth()->user();
        $user_id = auth()->user()->id;
        $student = DB::table('student_details')->where('user_id', $user_id)->first();
        return view('profile', compact('student','user'));
    }
    public function updateProfile(){
        $user = auth()->user();

        request()->validate([
            'password' => 'required|confirmed|min:8'
        ]);
        $hashedPassword = Hash::make(request()->password);

        $user->update([
            'password' => $hashedPassword
        ]);
        $user_id = auth()->user()->id;
        $student = DB::table('student_details')->where('user_id', $user_id)->first();
        return view('profile', compact('student','user'))->with('changed', 'password changed succesfuly');
    }
    public function noticeBoard()
    {
        $all_announcements = Article::all();
        return view('notice-board', compact('all_announcements'));
    }
    public function fee()
    {
        return view('fee');
    }
    public function exam()
    {
        //getting class of current user
        $class_id= auth()->user()->Student->class_id;
        //getting all exams
        $exams = Exam::all();
        //getting exams of current user,s class
        $user_exams = $exams->where('class_id', $class_id);

        return view('exam', compact('user_exams','exams'));

    }
    public function result()
    {
        $user_id= auth()->user()->id;
        $results = Result::all();
        $user_results = $results->where('user_id', $user_id);

        return view('result', compact('user_results'));
    }


}

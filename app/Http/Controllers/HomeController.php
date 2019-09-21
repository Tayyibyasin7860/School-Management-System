<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Hash;

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
        return view('home');
    }

    public function profile()
    {
        $role = Role::create('admin');
        dd($role);
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
        return view('notice-board');
    }
    public function fee()
    {
        return view('fee');
    }
}

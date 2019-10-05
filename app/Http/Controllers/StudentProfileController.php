<?php

namespace App\Http\Controllers;

use App\Models\StudentDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\User;
use Hash;

class StudentProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();

        $student_id = auth()->user()->id;
        $student = DB::table('student_details')->where('student_id', $student_id)->first();
        return view('student/profile/index', compact('student', 'user'));
    }

    public function edit(User $user)
    {
        $user_id = $user->id;
        $student = $user->StudentDetail;
        return view('student/profile/edit', compact('user', 'student'));
    }

    public function update(User $user)
    {
        $attributes = [];
        if (request()->filled('phone_number')) {
            $attributes [] = [ 'phone_number' => 'Phone Number' ];
            request()->validate([
                'phone_number' => 'numeric',
            ]);
            $user->StudentDetail->update([
                'phone_number' => request()->phone_number,
            ]);
        }
        if (request()->filled('email')) {
            $attributes [] = "Email";
            request()->validate([
                'email' => 'required|email|unique:users,email',
            ]);
            $user->update([
                'email' => request()->email,
            ]);
        }
        if (request()->filled('password')) {
            $attributes [] = "Password";
            request()->validate([
                'password' => 'confirmed|min:8'
            ]);
            $hashedPassword = Hash::make(request()->password);

            $user->update([
                'password' => $hashedPassword
            ]);
        }
        if(count($attributes) > 0){
            $message = "Success! Your profile has been updated successfuly.";
        }else{
            $message = "Nothing changed! because all fields were empty.";
        }
        return redirect('student\profile')->with('message', $message);
    }

    public function updateImage(User $user)
    {
        if (request()->hasFile('photo')) {
            request()->validate([
                'photo' => 'required'
            ]);
        }
        if (request()->has('photo')) {
            $user->studentDetail()->update([
                'photo' => request()->photo->store('uploads', 'public')
            ]);
        }
        return back();
    }
}

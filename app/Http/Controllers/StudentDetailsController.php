<?php

namespace App\Http\Controllers;

use App\Models\StudentDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\User;
use Hash;

class StudentDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();

        $user_id = auth()->user()->id;
        $student = DB::table('student_details')->where('user_id', $user_id)->first();
        return view('student/profile/index', compact('student','user'));
    }

    public function edit(User $user)
    {
        $user_id = $user->id;
//        $student = DB::table('student_details')->where('user_id', $user_id)->first();
        $student = $user->StudentDetail;
            return view('student/profile/edit', compact('user','student'));
    }

    public function update(User $user)
    {
            request()->validate([
                'email' => 'email|unique:users,email',
                'phone_number' => 'numeric',
                'password' => 'confirmed|min:8',
            ]);
        $hashedPassword = Hash::make(request()->password);

       // dd(request()->email);
        $user->update([
            'email' => request()->email,
            'phone_number' => request()->phone_number,
            'password' => $hashedPassword
        ]);
        $user->StudentDetail->update([
            'phone_number' => request()->phone_number,
        ]);
        return redirect('profile');
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

<?php

namespace App\Http\Controllers\Admin;

use App\Mail\AdminMail;
use App\Models\Exam;
use App\Models\FeeType;
use App\Models\StudentDetail;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\User;
use App\Models\Fee;
use PhpParser\Node\Expr\Array_;

class MailboxController extends CrudController
{

    public function create()
    {
        return view('vendor/backpack/base/Mailbox');
    }

    public function send(Request $request)
    {

//        $admin_students = User::find(backpack_user()->id)->students;
//        foreach ($admin_students as $admin_student){
//            $student_fees = $admin_student->fees;
//            foreach($student_fees as $student_fee){
//                    $fee_status = $student_fee->pivot->status;
//                    if($fee_status = 'Pending'){
//                        echo "pending";
//                    }
//            }
////        }
//        $admin = backpack_user()->id;
////        $fees = $admin->fees();
//
//        dd(Exam::find(1)->examSession()->where('admin_id',$admin)->pluck('admin_id'));
////        $pending_fee = $fee->pivot;
//        foreach ($fees as $fee){
//            echo $fee . "<br>";
//        }
//        dd();
        if(request()->category == 'fee_defaulters')
        {
            $pending_fee = FeeType::where('status','Pending')
                ->whereHas('students', function($user){
                    $user->where('admin_id', backpack_user()->id);
                })
                ->get();
            dd($pending_fee);
            $emails = [];
            foreach ($pending_fee as $fee){
                $emails [] =  $fee->student->email;
            }
        }else if($request->category =='all'){
            $students = User::where('admin_id', backpack_user()->id)->get();
            foreach ($students as $student){
                $emails [] =  $student->email;
            }
        }else if(!empty($request->email)){
            $emails [] = $request->email;
        }

        if(!empty($emails)){

            foreach ($emails as $email){
                $mail = new AdminMail();
                $mail->subject = ($request->subject) ? $request->subject : 'Important Notice from '.config('app.name');
                Mail::to($email)->send($mail);
//                sleep(1);
            }
            $message = 'Email(s) has been sent successfully.';
            return redirect('/admin/mailbox')->with('message',$message);

        }else{
            return redirect('/admin/mailbox')->withErrors(['email'=> 'No email sent.']);
        }
    }

    public function show($id)
    {
        //
    }

    public function studentEmail(User $student)
    {
        return view('vendor/backpack/base/Mailbox',compact('student'));
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}

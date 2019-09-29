<?php

namespace App\Http\Controllers\Admin;

use App\Mail\AdminMail;
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

        dd(User::find(5)->studentDetail->classRoom->exam);
        if(request()->category == 'fee_defaulters'){

            $pending_fee = Fee::where('status','Pending')
                ->whereHas('student', function($user){
                    $user->where('admin_id', backpack_user()->id);
                })
                ->groupBy('user_id')
                ->get();
            $emails = [];
            foreach ($pending_fee as $fee){
                $emails [] =  $fee->student->email;
            }
        }else if($request->category =='all'){
            $students = User::where('admin_id', backpack_user()->id)->find();
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
                sleep(1);
            }
            $message = 'Email(s) has been sent successfully.';
            return redirect('/admin/mailbox')->with('message',$message);

        }else{
            return redirect('/admin/mailbox')->withErrors(['email'=> 'Not email sent.']);
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

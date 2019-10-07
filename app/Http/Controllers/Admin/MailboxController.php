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
        request()->validate([
            'category' => 'required',
            'message' => 'required'
        ]);
        if (request()->filled('email')) {
            request()->validate([
                'email' => 'required'
            ]);
        }
        if (request()->category == 'fee_defaulters') {
            $users = User::where('admin_id', backpack_user()->id)->get();
            $emails = [];
            foreach ($users as $user) {
                foreach ($user->feeTypes as $feeReceipt) {
                    $status = $feeReceipt->pivot->status;
                    if($status == 'pending'){
                        $pendingStudentId = $feeReceipt->pivot->student_id;
                        echo $emails [] = User::where('id',$pendingStudentId)->pluck('email');
                    }
                }
            }
        }
        else if (request()->category == 'announced_results') {
            $users = User::where('admin_id', backpack_user()->id)->get();
            $emails = [];
            foreach ($users as $user) {
                foreach ($user->exams as $exam) {
                    $resultstudentId = $exam->pivot->student_id;
                       $emails [] = User::where('id',$resultstudentId)->pluck('email');
//                    }
                }
            }
        }
        else if ($request->category == 'all') {
            $students = User::where('admin_id', backpack_user()->id)->get();
            foreach ($students as $student) {
                $emails [] = $student->email;
            }
        } else if (!empty($request->email)) {
            $emails [] = $request->email;
        }

        if (!empty($emails)) {
            $message['message'] = request()->message;
            foreach ($emails as $email) {
                $mail = new AdminMail($message);
                $mail->subject = ($request->subject) ? $request->subject : 'Important Notice from ' . config('app.name');
                Mail::to($email)->send($mail);
//                sleep(1);
            }
            $message = 'Email(s) has been sent successfully.';
            return redirect('/admin/mailbox')->with('message', $message);

        } else {
            return redirect('/admin/mailbox')->withErrors(['emailError' => 'No email sent.']);
        }
    }

    public function show($id)
    {
        //
    }

    public function studentEmail(User $student)
    {
        return view('vendor/backpack/base/Mailbox', compact('student'));
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

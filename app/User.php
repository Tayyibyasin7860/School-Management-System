<?php

namespace App;

use App\Models\ClassRoom;
use Backpack\CRUD\CrudTrait;
use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
use App\Http\Controllers\Role;
use Illuminate\Notifications\Notifiable;
use App\Models\StudentDetail;

class User extends Authenticatable
{
    use CrudTrait;
    use Notifiable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','admin_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    protected $guard_name = 'web';
    //one student has one student detail


    public function studentDetail(){
        return $this->hasOne('App\Models\StudentDetail', 'student_id');
    }

    //one student at most belongs to one admin
    public function schoolAdmin()
    {
        return $this->belongsTo('App\User', 'admin_id');
    }
    //one admin has many students
    public function students()
    {
        return $this->hasMany('App\User', 'admin_id');
    }


    //one admin(school) has many exam sessions
    public function examSessions(){
        return $this->hasMany('App\Models\ExamSession','admin_id');
    }

//one admin has many feedbacks
    public function studentFeedbacks(){
        return $this->hasMany('App\Models\Feedback','admin_id');
    }
    //one student has many feedbacks
    public function feedbacks(){
        return $this->hasMany('App\Models\Feedback','student_id');
    }
//one student has many exams and belongsto many exams. students and exams both have joining table results.
    public function exams(){
        return $this->belongsToMany('App\Models\Exam','results','student_id','exam_id')
            ->withPivot('total_marks', 'obtained_marks','remarks');
    }
    //one student belongs to many fees
    public function feeTypes(){
        return $this->belongsToMany('App\Models\FeeType','fee_receipts','student_id','fee_type_id')
            ->withPivot('amount','submitted_amount','due_date','submission_date','status');
    }
    //one admin has many fees
    public function adminFeeTypes(){
        return $this->hasMany('App\Models\FeeType','admin_id');
    }


    //one admin has many articles
    public function articles(){
        return $this->hasMany('App\Models\Article','admin_id');
    }
    //one admin has many classes
    public function classes(){
        return $this->hasMany('App\Models\ClassRoom','admin_id');
    }
    public function subjects(){
        return $this->hasMany('App\Models\Subject','admin_id');
    }
    public function categories(){
        return $this->hasMany('App\Models\Category','admin_id');
    }
    public function tags(){
        return $this->hasMany('App\Models\Tag','admin_id');
    }
    public static function myExamSessions(){

		$examSessions = backpack_user()->examSessions;
		$result = [];
		foreach($examSessions as $session){
			$result[$session->id] = $session->title . ' ' .$session->year;
		}
		return $result ;
	}

	public static function adminFeesTypes(){
        $feeTypes = backpack_user()->adminFeeTypes->pluck('type','id');
        return $feeTypes;
    }
    public static function myFeeTypes(){

        $feeTypes = backpack_user()->adminFeeTypes;

        $voucherTypes = [];
        foreach($feeTypes as $feeType){
            $voucherTypes[$feeType->id] = $feeType->title;
        }
        return $voucherTypes ;
    }

	public function myClasses(){
		return $this->classes->pluck('title','id')->toArray();
	}
    public function mySubjects(){
        return $this->subjects()->pluck('title','id')->toArray();
    }
    public static function onlyStudents(){
        $users = User::whereNotNull('admin_id')->get();
        $students = [];
        foreach ($users as $user){
            $students = $users->pluck('name','id');
        }
        $allStudents = [];
        foreach ($students as $key => $value){
            $allStudents[$key] = $value;
        }
        return $allStudents;
    }
    //profile button
    public function profileButton(){
        if($this->studentDetail){
            return '<a data-button-type="review" title="Profile" href="'. url(config('backpack.base.route_prefix').'/student/'. $this->id.'/profile') .'" class="btn btn-xs btn-success"><i class="fa fa-file-text-o"></i> View Profile</a>';
            //return '<a data-button-type="review" title="Profile" href="'. url(config('backpack.base.route_prefix').'/student/'. $this->id.'/profile/'.$this->studentDetail->id.'/edit') .'" class="btn btn-xs btn-default"><i class="fa fa-file-text-o"></i> Profile</a>';
        }else{
            return '<a data-button-type="review" title="Profile" href="'. url(config('backpack.base.route_prefix').'/student/'. $this->id.'/profile/create') .' " class="btn btn-xs btn-warning"><i class="fa fa-file-text-o"></i> Create Profile</a>';
        //'. url(config('backpack.base.route_prefix').'/student/'. $this->id.'/profile/2') .'
        }
    }
    public static function getAdminStudents(){
        return User::where('admin_id',backpack_user()->id)->pluck('name','id')->toArray();
    }
    public function getStudentDetailAdminAttribute(){
        $admin_classes = $this->schoolAdmin->classes->pluck('title','id');
        $classes = [];
        foreach ($admin_classes as $key => $value){
            $classes [$key] = $value;
        }
        return $classes;
    }
    public function setupData(){
        $classes  = ['Play Group', 'Prep', 'Nursary', 'One', 'Two', 'Three', 'Four', 'Five', 'Six', 'Seven', 'Eight', 'Nine', 'Ten'];
        foreach ($classes as $class){

            Models\ClassRoom::create([
                'title' => $class,
                'capacity' => 40,
                'admin_id' => $this->id
            ]);
        }

		$feeTypes = ['Admission Fee', 'Monthly Fee', 'Annual Fee'];
		foreach ($feeTypes as $row){

            Models\FeeType::create([
                'type' => $row,

                'admin_id' => $this->id
            ]);
        }
        $subjects = ['Math', 'Physics', 'Chemistry','Science','Urdu','English','Pak Studies','Drawing'];
        foreach ($subjects as $row){

            Models\Subject::create([
                'title' => $row,

                'admin_id' => $this->id
            ]);
        }
        $now = Carbon::now();
        $exam_sessions = ['Spring', 'Fall'];
        foreach ($exam_sessions as $row){

            Models\ExamSession::create([
                'title' => $row,
                'year' => $now->year,
                'admin_id' => $this->id
            ]);
        }
    }

}

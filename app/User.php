<?php

namespace App;

use App\Models\ClassRoom;
use Backpack\CRUD\CrudTrait;
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
    //one student has many exams and belongsto many exams. students and exams both have joining table results.
    public function exams(){
        return $this->belongsToMany('App\Models\Exam','results','student_id','exam_id')
                    ->withPivot('total_marks', 'obtained_marks','remarks');
    }
    //one student belongs to many fees
    public function feeTypes(){
        return $this->belongsToMany('App\Models\FeeType','fee_receipts','fee_type_id','student_id')
            ->withPivot('amount','submitted_amount','due_date','submission_date','status');
    }
    //one admin has many fees
    public function adminFeeTypes(){
        return $this->hasMany('App\Models\FeeType','admin_id');
    }
    //one admin has many articles
    public function articles(){
        return $this->hasMany('Backpack\NewsCRUD\app\Models\Article','admin_id');
    }
    //one admin has many classes
    public function classes(){
        return $this->hasMany('App\Models\ClassRoom','admin_id');
    }
    //one admin has many feedbacks
    public function studentFeedbacks(){
        return $this->hasMany('App\Models\Feedback','admin_id');
    }
    //one student has many feedbacks
    public function feedbacks(){
        return $this->hasMany('App\Models\Feedback','student_id');
    }
    //profile button
    public function profileButton(){
        if($this->studentDetail){
            return '<a data-button-type="review" title="Profile" href="'. url(config('backpack.base.route_prefix').'/student/'. $this->id.'/profile/'.$this->studentDetail->id.'/edit') .'" class="btn btn-xs btn-default"><i class="fa fa-file-text-o"></i> Profile</a>';
        }else{
            return '<a data-button-type="review" title="Profile" href="'. url(config('backpack.base.route_prefix').'/student/'. $this->id.'/profile/create') .' " class="btn btn-xs btn-default"><i class="fa fa-file-text-o"></i> Profile</a>';
        //'. url(config('backpack.base.route_prefix').'/student/'. $this->id.'/profile/2') .'
        }
    }
    public static function getAdminStudents(){
        return User::where('admin_id',backpack_user()->id)->pluck('name','id')->toArray();
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

    }
}

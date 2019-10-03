<?php

namespace App;

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
        return $this->hasOne('App\Models\StudentDetail');
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
    public function results(){
        return $this->belongsToMany('App\Models\Exam','results','student_id','exam_id')
                    ->withPivot('total_marks', 'obtained_marks','remarks');
    }
    //one student belongs to many fees
    public function fees(){
        return $this->belongsToMany('App\Models\Fee','student_fee','student_id','fee_id')
            ->withPivot('status');
    }
    //one admin has many fees
    public function feeStructures(){
        return $this->hasMany('App\Models\Fee','admin_id');
    }
    //one admin has many articles
    public function articles(){
        return $this->hasMany('Backpack\NewsCRUD\app\Models\Article','admin_id');
    }
    //one admin has many classes
    public function classes(){
        return $this->hasMany('App\Models\ClassRoom','admin_id');
    }
    //one admin has many classes
//    public function class(){
//        return $this->belongsTo('App\Models\ClassRoom','class_id');
//    }
    //profile button
    public function profileButton(){
        return '<a data-button-type="review" title="Profile" href="'. url(config('backpack.base.route_prefix').'/student/'. $this->id.'/profile') .'" class="btn btn-xs btn-default"><i class="fa fa-file-text-o"></i> Profile</a>';
    }
    public static function getAdminStudents(){
        return User::where('admin_id',backpack_user()->id)->pluck('name','id')->toArray();
    }

    public function setupData($admin_id){
        for($i=1;$i<=10;$i++){
            Models\ClassRoom::create([
                'title' => $i,
                'capacity' => 40,
                'admin_id' => $admin_id
            ]);
        }

    }
}

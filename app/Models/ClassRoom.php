<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\CrudTrait;

class ClassRoom extends Model
{
    use CrudTrait;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'classes';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    // protected $guarded = ['id'];
    protected $fillable = ['title', 'capacity','admin_id'];
    // protected $hidden = [];
    // protected $dates = [];

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */
    public static function getClassWithAdminAttribute(){
        $classes = ClassRoom::all();
        $classesWithAdmin = [];
        foreach($classes as $class){
            $classesWithAdmin[$class->id] = $class->title . ' | ' . $class->schoolAdmin->name;
        }
        return $classesWithAdmin;
    }
    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

	public function schoolAdmin(){
        return $this->belongsTo('App\User','admin_id');
    }

	public function classFee(){
        return $this->hasMany('App\Models\ClassFee','class_id');
    }


    public function students(){
        return $this->hasMany('App\Models\StudentDetail','class_id');
    }
    public function studentsAccount(){
        return $this->hasMany('App\User');
    }

    public function exams()
    {
        return $this->hasMany('App\Models\Exam','class_id');
    }

    public function subjects()
    {
        return $this->belongsToMany('App\Models\Subject', 'class_subjects', 'class_id');
    }



    public static function getAdminClasses(){
        return ClassRoom::where('admin_id',backpack_user()->id)->pluck('title','id')->toArray();
    }
    /*
    |--------------------------------------------------------------------------
    | ACCESORS
    |--------------------------------------------------------------------------
    */

    public function getAvailableSeatsAttribute(){
        return $this->capacity - $this->students()->count();
    }

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */

    //profile button
    public function subjectsButton(){
        if($this->subjects){
            return '<a data-button-type="review" title="Subjects" href="'. url(config('backpack.base.route_prefix').'/class/'. $this->id.'/subject/') .'" class="btn btn-xs btn-default"><i class="fa fa-book"></i> Subjects</a>';
        }else{
            return '<a data-button-type="review" title="Profile" href="'. url(config('backpack.base.route_prefix').'/student/'. $this->id.'/profile/create') .' " class="btn btn-xs btn-default"><i class="fa fa-file-text-o"></i> Profile</a>';
            //'. url(config('backpack.base.route_prefix').'/student/'. $this->id.'/profile/2') .'
        }
    }
}

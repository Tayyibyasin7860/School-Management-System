<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\CrudTrait;

class Subject extends Model
{
    use CrudTrait;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'subjects';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    // protected $guarded = ['id'];
    protected $guarded = [];
    // protected $hidden = [];
    // protected $dates = [];

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */
    public static function getSubjectWithAdminAttribute(){
        $subjects = Subject::all();
        $subjectsWithAdmin = [];
        foreach($subjects as $subject){
            $subjectsWithAdmin[$subject->id] = $subject->title . ' | ' . $subject->schoolAdmin->name;
        }
        return $subjectsWithAdmin;
    }
    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */
    public function classes()
    {
        return $this->belongsToMany('App\Models\ClassRoom', 'class_subjects');
    }
    public function exams(){
        return $this->hasMany('App\Models\Exam');
    }
    public function schoolAdmin(){
        return $this->belongsTo('App\User','admin_id');
    }
    public static function getAdminSubjects(){
        return Subject::where('admin_id',backpack_user()->id)->pluck('title','id')->toArray();
    }


    /*
    |--------------------------------------------------------------------------
    | ACCESORS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */
}

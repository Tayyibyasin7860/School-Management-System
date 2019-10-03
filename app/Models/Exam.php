<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\CrudTrait;

class Exam extends Model
{
    use CrudTrait;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'exams';
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

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    public function students(){
        return $this->belongsToMany('App\User','results','student_id','exam_id')
            ->withPivot('total_marks', 'obtained_marks','remarks');
    }
    public function classRoom()
    {
        return $this->belongsTo('App\Models\ClassRoom','class_id');
    }
    public function subject()
    {
        return $this->belongsTo('App\Models\Subject');
    }
    public function examSession(){
        return $this->belongsTo('App\Models\ExamSession','exam_session_id');
    }
    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | ACCESORS
    |--------------------------------------------------------------------------
    */
    public function getAdminIdAttribute(){
        return $this->examSession->schoolAdmin->id;
    }
    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */
}

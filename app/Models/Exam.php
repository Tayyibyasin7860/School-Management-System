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
    public function subject()
    {
        return $this->belongsTo('App\Models\Subject');
    }
    public function examSession(){
        return $this->belongsTo('App\Models\ExamSession','exam_session_id');
    }

    public function classRoom(){
        return $this->belongsTo('App\Models\ClassRoom','class_id');
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

	public function getDescriptiveNameAttribute(){
		return $this->examSession->title.' | '.$this->classRoom->title.' | '. $this->subject->title;
	}
    public function getExamAdminAttribute(){
        return $this->examSession->title.' | '.$this->classRoom->title.' | '. $this->subject->title . ' | ' . $this->examSession->schoolAdmin->name;
    }
    public function getDescriptiveNamesAttribute(){
        return ExamSession::find($this->id)->pluck('title');  //->pluck.' | '.$this->classRoom->title.' | '. $this->subject->title;;
    }
    public function sgetDescriptiveNamesAttribute(){
        return ExamSession::find($this->id)->pluck('title');  //->pluck.' | '.$this->classRoom->title.' | '. $this->subject->title;;
    }

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */
}

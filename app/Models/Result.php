<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\CrudTrait;
use Illuminate\Support\Facades\App;

class Result extends Model
{
    use CrudTrait;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'results';
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
    public function exam(){
        return $this->belongsTo('App\Models\Exam','exam_id');
    }

	public function student()
    {
        return $this->belongsTo('App\User','student_id');
    }

	public function subject()
    {
        return $this->belongsTo('App\Models\Subject','subject_id');
    }


    /*
    |--------------------------------------------------------------------------
    | Helper functions
    |--------------------------------------------------------------------------
    */
    public function getAdminStudents(){
        return User::where('admin_id',backpack_user()->id);
    }
    public function getAdminIdAttribute(){
        return $this->exam->examSession->schoolAdmin->id;
    }

    /*
    |--------------------------------------------------------------------------
    | ACCESORS
    |--------------------------------------------------------------------------
    */
    public function getExamSessionAttribute()
    {
        return $this->exam->examSession->title;
    }

	public function getRelatedClassAttribute(){

		return $this->student->studentDetail->id;
	}
    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */
}

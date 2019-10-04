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

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    public function schoolAdmin(){
        return $this->belongsTo('App\Models\User','admin_id');
    }
    public function students(){
        return $this->hasMany('App\Models\studentDetail','class_id');
    }
    public function exams()
    {
        return $this->hasMany('App\Models\Exam','class_id');
    }

    public function subjects()
    {
        return $this->belongsToMany('App\Models\Subject', 'class_subjects');
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
}

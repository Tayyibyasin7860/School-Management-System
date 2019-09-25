<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\CrudTrait;

class ClassRoom extends Model //but this change is only inside code/behind the scene, for labels we still use class word
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
    protected $fillable = ['title', 'capacity'];
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
    public function users()
    {
        return $this->hasMany('App\User');
    }
    public function exam()
    {
        return $this->hasOne('App\Models\Exam');
    }
    public function results()
    {
        return $this->hasMany('App\Models\Result');
    }
    public function fees()
    {
        return $this->hasMany('App\Models\Fee');
    }
    public function subjects()
    {
        return $this->hasMany('App\Models\Subject');
    }
    public function studentDetails()
    {
        return $this->hasMany('App\Models\StudentDetails');
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

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */
}

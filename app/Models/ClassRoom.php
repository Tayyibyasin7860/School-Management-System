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
    public function User()
    {
        return $this->hasMany('App\User');
    }
    public function Exam()
    {
        return $this->hasOne('App\Models\Exam');
    }
    public function Result()
    {
        return $this->hasMany('App\Models\Result');
    }
    public function Fee()
    {
        return $this->hasMany('App\Models\Fee');
    }
    public function Subject()
    {
        return $this->hasMany('App\Models\Subject');
    }
    public function Student()
    {
        return $this->hasMany('App\Models\Student');
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

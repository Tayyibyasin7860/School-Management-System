<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\CrudTrait;

class StudentDetail extends Model
{
    use CrudTrait;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'student_details';

    protected $guarded = [];

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
    public function user()
    {
        return $this->belongsTo('App\User','student_id');
    }
    public function class()
    {
        return $this->belongsTo('App\Models\ClassRoom', 'class_id');
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
    public function setPhotoAttribute($value) {
// use Intervention image or whatever you want to process that image

        $image=$value;
        $input['photo'] = time().'.'.$image->getClientOriginalExtension();
        $img = \Image::make($image->getRealPath());

        $destinationPath = "D:/xampp/htdocs/School_Management_System/storage/app/public/uploads";
        $img->resize(750, 450, function ($constraint) {
            $constraint->aspectRatio();
        })->save($destinationPath.'/'.$input['photo']);

        $destinationPath = $destinationPath.'/'.$input['photo'];

        $img->resize(100, 100, function ($constraint) {
            $constraint->aspectRatio();
        })->save($destinationPath);

// $image->move($destinationPath, $input['imagename']); // for no resize
        $this->attributes['photo'] = strtolower($input['photo']);

    }
}

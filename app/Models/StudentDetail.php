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
    public function user()
    {
        return $this->belongsTo('App\User','user_id');
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
    public function setThumbnailImageAttribute($value) {

        $image=$value;
        $input['thumbnail_image'] = $image->getClientOriginalName();
        $img = \Image::make($image->getRealPath());

        $destinationPath = public_path('/uploads/thumbnailImages');
        $img->resize(750, 450, function ($constraint) {
            $constraint->aspectRatio();
        })->save($destinationPath.'/'.$input['thumbnail_image']);

        $destinationPath = public_path('storage/uploads/thumbnailImages');

        $img->resize(100, 100, function ($constraint) {
            $constraint->aspectRatio();
        })->save($destinationPath.'/'.$input['thumbnail_image']);

        $image->move($destinationPath, $input['thumbnail_image']);
        $this->attributes['thumbnail_image'] = $input['thumbnail_image'];

    }
}

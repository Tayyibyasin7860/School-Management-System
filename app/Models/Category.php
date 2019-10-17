<?php

namespace App\Models;

use Backpack\CRUD\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;

class Category extends Model
{
    use CrudTrait;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'categories';
    protected $primaryKey = 'id';
    // public $timestamps = false;
    // protected $guarded = ['id'];
    protected $fillable = ['name','admin_id'];
    // protected $hidden = [];
    // protected $dates = [];

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public static function getCategoriesWithAdminAttribute(){
        $categories = Category::all();
        $categoriesWithAdmin = [];
        foreach($categories as $category){
            $categoriesWithAdmin[$category->id] = $category->name . ' | ' . $category->schoolAdmin->name;
        }
        return $categoriesWithAdmin;
    }
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

    public function parent()
    {
        return $this->belongsTo('Backpack\NewsCRUD\app\Models\Category', 'parent_id');
    }

    public function children()
    {
        return $this->hasMany('Backpack\NewsCRUD\app\Models\Category', 'parent_id');
    }

    public function articles()
    {
        return $this->hasMany('Backpack\NewsCRUD\app\Models\Article');
    }
    public function schoolAdmin()
    {
        return $this->belongsTo('App\User','admin_id');
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

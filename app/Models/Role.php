<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\CrudTrait;
use Spatie\Permission\Traits\HasPermissions;
use Spatie\Permission\Models\Role as BaseRole;
class Role extends Model
{
    use CrudTrait, HasPermissions;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'roles';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    // protected $guarded = ['id'];
    protected $fillable = ['name', 'guard_name'];
    // protected $hidden = [];
    // protected $dates = [];

    public static function boot()
    {
        parent::boot();

        self::saved(function($model){
//            dd(request()->permissions);
            BaseRole::findById($model->id, 'web')->syncPermissions(request()->perms);
        });

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
    function getPermsAttribute(){
        $permissions = BaseRole::findById($this->id, 'web')->permissions()->get()->pluck('name')->toArray();
        return $permissions;
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

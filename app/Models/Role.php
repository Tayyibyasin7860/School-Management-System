<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\CrudTrait;
use Illuminate\Support\Facades\App;
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
    public function users(){
        return $this->belongsToMany('App\User','model_has_roles','role_id','model_id')
            ->withPivot('model_type');
    }
    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */
    function getPermsAttribute(){
        $permissions = BaseRole::findById($this->id, 'web')->permissions()->get()->pluck('name')->toArray();
        return $permissions;
    }
    public static function getAllAdmins(){
        $roles = Role::where('name','school_admin')->first();
        $admin_users = $roles->users->count()
            ? $roles->users->pluck('name','id') : [];
        $admin_users_names = [];
        foreach($admin_users as $key => $admin_user){
            $admin_users_names[$key] = $admin_user;
        }
        return $admin_users_names;
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

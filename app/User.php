<?php

namespace App;

use Backpack\CRUD\CrudTrait;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
use App\Http\Controllers\Role;
use Illuminate\Notifications\Notifiable;
use App\Models\StudentDetail;

class User extends Authenticatable
{
    use CrudTrait;
    use Notifiable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','admin_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    protected $guard_name = 'web';

//    public
//    function studentDetail(){
//        return $this->hasOne('App\Models\StudentDetail');
//    }
//
//    public function schoolAdmin()
//    {
//        return $this->belongsTo('App\User', 'admin_id');
//    }
//
//    public function exams(){
//        return $this->hasMany('App\Models\Exam');
//    }
//
//    public function fees(){
//        return $this->hasMany('App\Models\Fee');
//    }
//
//    public function classRoom(){
//        return $this->belongsTo('App\Models\ClassRoom');
//    }
    public function articles(){
        return $this->hasMany('App\Models\Article','admin_id');
    }

    public function profileButton(){
        return '<a data-button-type="review" title="Profile" href="'. url(config('backpack.base.route_prefix').'/student/'. $this->id.'/profile') .'" class="btn btn-xs btn-default"><i class="fa fa-file-text-o"></i> Profile</a>';
    }
}

<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
use App\Http\Controllers\Role;
use Illuminate\Notifications\Notifiable;
use App\Models\Student;

class User extends Authenticatable
{
    use Notifiable;
    use HasRoles;

    protected $guard_name = 'web';

    public function Student(){
        return $this->hasOne('App\Models\Student');
    }
    public function Exam(){
        return $this->hasMany('App\Models\Exam');
    }
    public function Result(){
        return $this->hasMany('App\Models\Result');
    }
    public function Fee(){
        return $this->hasMany('App\Models\Fee');
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
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
}

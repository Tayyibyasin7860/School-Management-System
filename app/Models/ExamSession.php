<?php

namespace App\Models;

use Backpack\CRUD\CrudTrait;
use Illuminate\Database\Eloquent\Model;

class ExamSession extends Model
{
    use CrudTrait;
    protected $table = 'exam_sessions';

    //one exam session belongs to one admin
    public function schoolAdmin(){
        return $this->belongsTo('App\User','admin_id');
    }
    //relations
    public function exams(){
        return $this->hasMany('App\Models\Exam','exam_session_id');
    }
}

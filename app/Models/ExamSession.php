<?php

namespace App\Models;

use Backpack\CRUD\CrudTrait;
use Illuminate\Database\Eloquent\Model;

class ExamSession extends Model
{
    use CrudTrait;
    protected $table = 'exam_sessions';

    //relations
    public function exams(){
        return $this->hasMany('App\Models\Exam','exam_session_id');
    }
}

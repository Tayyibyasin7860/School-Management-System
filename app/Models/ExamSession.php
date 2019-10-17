<?php

namespace App\Models;

use Backpack\CRUD\CrudTrait;
use Illuminate\Database\Eloquent\Model;

class ExamSession extends Model
{
    use CrudTrait;
    protected $table = 'exam_sessions';

    protected $fillable = ['title','year','admin_id'];

    //one exam session belongs to one admin
    public function schoolAdmin(){
        return $this->belongsTo('App\User','admin_id');
    }
    //relations
    public function exams(){
        return $this->hasMany('App\Models\Exam','exam_session_id');
    }

    //functions
    public static function getExamSessionWithAdminAttribute(){
        $examSessions = ExamSession::all();
        $examSessionWithAdmin = [];
        foreach($examSessions as $examSession){
            $examSessionWithAdmin[$examSession->id] = $examSession->title . ' ' . $examSession->year . ' | ' . $examSession->schoolAdmin->name;
        }
        return $examSessionWithAdmin;
    }

}

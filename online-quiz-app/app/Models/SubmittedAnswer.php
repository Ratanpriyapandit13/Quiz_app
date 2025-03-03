<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubmittedAnswer extends Model
{
    protected $fillable = ['submitted_quiz_id','question_id', 'answer_id'];


    public function answer(){
        return $this->belongsTo(Answer::class,'answer_id');
    }

    public function question(){
        return $this->belongsTo(Question::class);
    }

    public function submitted_quiz(){
        return $this->belongsTo(SubmittedQuiz::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubmittedQuiz extends Model
{
    protected $fillable = ['quiz_id', 'user_id'];

    public function quiz()
    {
        return $this->belongsTo(Quiz::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function submittedAnswers()
    {
        return $this->hasMany(SubmittedAnswer::class, 'submitted_quiz_id');
    }

}

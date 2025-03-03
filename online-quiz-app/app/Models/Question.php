<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $fillable = ['question_text', 'option_1', 'option_2', 'option_3', 'option_4', 'correct_option', 'created_by'];

    // Relationship to User who created the question
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    // Relationships to fetch options (Answers)
    public function optionOne()
    {
        return $this->belongsTo(Answer::class, 'option_1');
    }

    public function optionTwo()
    {
        return $this->belongsTo(Answer::class, 'option_2');
    }

    public function optionThree()
    {
        return $this->belongsTo(Answer::class, 'option_3');
    }

    public function optionFour()
    {
        return $this->belongsTo(Answer::class, 'option_4');
    }

    // Relationship to get the correct answer
    public function correctAnswer()
    {
        return $this->belongsTo(Answer::class, 'correct_option');
    }

   //m method to get all answer options dynamically
     public function options()
     {
         return Answer::whereIn('id', [$this->option_1, $this->option_2, $this->option_3, $this->option_4])->get();
     }
}


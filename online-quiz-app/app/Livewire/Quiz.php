<?php

namespace App\Livewire;

use App\Models\Quiz as Quiz_Model;
use App\Models\SubmittedAnswer;
use App\Models\SubmittedQuiz;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Title;
use Livewire\Component;

class Quiz extends Component
{

    public $selected_answers = [];
    public $isSubmitted = false;

    public $quizzes;
    public $selectedQuiz = null;
    public $questions = [];

    public function mount()
    {
        $this->quizzes = Quiz_Model::all();
    }

    #[Title('Quizzes')]
    public function render()
    {
        return view('livewire.quiz');
    }

    public function showQuizQuestions($quizId)
    {
        $this->selectedQuiz = Quiz_Model::with('questions')->find($quizId);
        $this->questions = $this->selectedQuiz ? $this->selectedQuiz->questions : [];
    }

    public function submitAnswer()
    {

        $submitted_quiz = SubmittedQuiz::create([
            'quiz_id' => $this->selectedQuiz->id,
            'user_id' => Auth::user()->id
        ]);

        foreach ($this->questions as $index=>$question) {
            SubmittedAnswer::create([
                'submitted_quiz_id' => $submitted_quiz->id,
                'question_id' => $question->id,
                'answer_id'=>$this->selected_answers[$index]
            ]);
        }

        $this->isSubmitted = true;
        $this->reset(['selected_answers']);

        //logic to save answer
    }
}

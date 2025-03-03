<?php

namespace App\Livewire\Admin;

use App\Models\SubmittedQuiz;
use Livewire\Component;

class QuizAttempts extends Component
{

    public $attemptedQuizzes;

    public function mount()
    {
        // Fetch all quizzes attempted by users along with their submitted answers
        $this->attemptedQuizzes = SubmittedQuiz::with(['user', 'quiz'])
            ->get();
    }

    public function render()
    {
        return view('livewire.admin.quiz-attempts');
    }

    public function backToAdmin(){
        $this->redirect('/admin-dashboard');
    }
}

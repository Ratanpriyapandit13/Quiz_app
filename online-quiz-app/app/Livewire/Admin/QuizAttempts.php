<?php

namespace App\Livewire\Admin;

use App\Models\SubmittedQuiz;
use Livewire\Component;

class QuizAttempts extends Component
{

    public $attemptedQuizzes;

    public function mount()
    {
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

    public function deleteSubmittedQuiz($submittedQuizId)
    {
        $submittedQuiz = SubmittedQuiz::with('submittedAnswers')->find($submittedQuizId);

        if (!$submittedQuiz) {
            session()->flash('error', 'Submitted Quiz not found!');
            return;
        }

        $submittedQuiz->submittedAnswers()->delete();

        $submittedQuiz->delete();

        session()->flash('success', 'Submitted Quiz deleted successfully!');

        $this->attemptedQuizzes = SubmittedQuiz::with(['user', 'quiz'])
            ->get();
    }
}

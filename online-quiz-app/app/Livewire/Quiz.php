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
    public $attemptedQuizzes;
    public $attemptedQuizzedQuestion;

    public function mount()
    {
        $this->quizzes = Quiz_Model::all();
        $this->getSubmittedQuizByUserId();
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


        $score = 0;

        foreach ($this->questions as $index => $question) {
            // $selectedAnswerId = $this->selected_answers[$index] ?? null;

            SubmittedAnswer::create([
                'submitted_quiz_id' => $submitted_quiz->id,
                'question_id' => $question->id,
                'answer_id' => $this->selected_answers[$index]
            ]);

            if ( $this->selected_answers[$index] == $question->correct_option) {
                $score++;
            }
        }

        dump($score);

        // Save score in database
        $submitted_quiz->score = $score;
        $submitted_quiz->save();
        $this->reset(['selected_answers']);
        $this->isSubmitted = true;
        $this->redirect('/quiz');
    }

    public function getSubmittedQuizByUserId(){

        $this->attemptedQuizzes = SubmittedQuiz::with(['user', 'quiz','submittedAnswers.question','submittedAnswers.answer'])
        ->where('user_id', Auth::user()->id)
        ->get();

    }


    public function viewQuizDetails($quizId, $submmitedQuizId)
    {
        // Get the submitted quiz for the selected quiz ID
        $this->attemptedQuizzedQuestion = SubmittedQuiz::with([
            'submittedAnswers.question',
            'submittedAnswers.answer'
        ])->where('quiz_id', $quizId)
        ->where('user_id', Auth::id())
        ->where('id', $submmitedQuizId)
        ->first();
    }

    public function clearData(){
        $this->reset(['attemptedQuizzedQuestion']);
    }

    public function logOut(){
        Auth::logout();
        redirect('/login');
    }

}

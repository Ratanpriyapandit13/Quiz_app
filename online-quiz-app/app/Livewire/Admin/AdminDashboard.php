<?php

namespace App\Livewire\Admin;

use App\Models\Quiz;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Component;


class AdminDashboard extends Component
{

    public bool $showQuestionForm = false;
    public bool $showEditForm = false;

    public function mount()
    {
        if (!Auth::user()) {
            abort(403, 'Unauthorized access');
        }
    }

    #[Title('Admin Dashboard')]
    public function render()
    {
        if(!Auth::user()) {
            return view('livewire.login');
        }

        if(Auth::user()->role->name == 'admin'){
            return view('livewire.admin.admin-dashboard');
        }elseif( Auth::user()->role->name == 'instructor'){
            return view('livewire.admin.admin-dashboard');
        }elseif(Auth::user()->role->name == 'student'){
            return view('livewire.quiz');
        }

    }


    public function toggleQuestionForm()
    {
        $this->showQuestionForm = !$this->showQuestionForm;
    }

    #[On('showEditForm')]
    public function toggleEditForm($question_id){

        if( $question_id ){
            $this->showEditForm = true;
            $this->showQuestionForm = false;
            $this->dispatch('on-edit-question',$question_id);
        }
        else{
            $this->showEditForm = false;
        }
    }

    public function manageQuizzes(){
        $this->redirect('/manage-quizzes');
    }

    public function quizAttemps(){
        $this->redirect('/quiz-attemps');
    }

    public function logOut(){
        Auth::logout();
        return redirect('/login');
    }

    public function manageUsers(){
        $this->redirect('/manage-users');
    }
}

<?php

namespace App\Livewire\Admin;

use App\Models\Question;
use Livewire\Attributes\On;
use Livewire\Component;

class QuestionList extends Component
{

    public $questions;

    #[On('refreshQuestionList')]
    public function mount()
    {
        $this->questions = Question::with(['creator'])->get();

    }

    public function render()
    {
        return view('livewire.admin.question-list');
    }

    public function edit($id){
        $this->dispatch('showEditForm', $id);
    }

    public function delete($id){
        Question::find($id)->delete();

        session()->flash('status', 'Deleted Successfully.');
        $this->dispatch('refreshQuestionList');
    }
}

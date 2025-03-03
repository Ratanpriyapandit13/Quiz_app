<?php

namespace App\Livewire\Admin;

use App\Models\Answer;
use App\Models\Question;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\Component;

class QuestionForm extends Component
{

    #[Validate('required|min:5')]
    public string $question_text = '';
    public $options= [0,0,0,0];
    public int $correct_option;

    public $question_option = [];
    public $answer;

    public $isUpdate=false;



    #[Title('Qusetion')]
    public function render()
    {
        //$this->asnwers();
        return view('livewire.admin.question-form');
    }

    public function mount()
    {
        $this->answer = Answer::all();
    }

    public function question(){
        return Question::all();
    }

    // public function asnwers(){
    //     $this->answer = Answer::all();
    // }

    public function save()
    {
        $this->isUpdate = false;

        $this->validate([
            'question_text' => 'required|min:5',
            'options.*' => 'required|exists:answers,id',
            'correct_option' => 'required|exists:answers,id',
        ]);


        if ($this->hasDuplicateOptions()) {
            session()->flash('error', 'Duplicate options are not allowed.');
            return;
        }

        Question::create([
            'question_text' => $this->question_text,
            'option_1' => $this->options[0],
            'option_2' => $this->options[1],
            'option_3' => $this->options[2],
            'option_4' => $this->options[3],
            'correct_option' => $this->correct_option,
            'created_by' => Auth::id(),
        ]);

        $this->resetValues();
        $this->dispatch('refreshQuestionList');
        session()->flash('status', 'Question created successfully!');
        $this->answer = Answer::all();
    }

    public function resetValues(){
        $this->options=[0,0,0,0];
        $this->question_text = '';
        $this->correct_option = 0;
    }

    public function changeEvent($value=null)    {

        if (!$value) return;

        $answer = Answer::find($value);

        if (!$answer) return;

        // Ensure the answer isn't already in question_option
        if (!collect($this->question_option)->contains('id', $answer->id)) {
            $this->question_option[] = $answer;
        }
    }

    #[On('onEditQuestion')]
    public function updatePostList($question = null)
    {
        $this->isUpdate = true;
    }

    public function hasDuplicateOptions()
    {
        return count($this->options) !== count(array_unique($this->options));
    }

}

<?php

namespace App\Livewire\Admin;

use App\Models\Answer;
use App\Models\Question;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;

class EditQuestion extends Component
{
    public $question_text;

    public $options= [0,0,0,0];
    public int $correct_option;
    public $question_option = [];
    public $id;
    public $answer;

    public function render()
    {
        return view('livewire.admin.edit-question');
    }

    #[On('on-edit-question')]
    public function edit($question_id){

        $this->dispatch('debug-log',$question_id);
        $question = Question::find( $question_id );
        $this->answer=Answer::all();


        // if($question->created_by == auth()->user->id && auth()->user->role->name =='admin'){

       if($question){
            $this->id = $question_id;
            $this->question_text = $question->question_text;
            $this->correct_option = $question->correct_option;
            $this->dispatch('debug-log',$this->correct_option);

            $this->options[0] = $question->option_1;
            $this->options[1] = $question->option_2;
            $this->options[2] = $question->option_3;
            $this->options[3] = $question->option_4;

            $this->question_option = $this->answer;
        }
        // }

    }

    public function editQuestion(){

        $this->validate([
            'question_text' => 'required|min:5',
            'options.*' => 'required|exists:answers,id',
            'correct_option' => 'required|exists:answers,id',
        ]);
        $question = Question::find($this->id);

        if ($this->hasDuplicateOptions()) {
            session()->flash('error', 'Duplicate options are not allowed.');
            return;
        }
        if($question){
            $question->update([
                'question_text' => $this->question_text,
                'option_1' => (int)($this->options[0]),
                'option_2' => (int)$this->options[1],
                'option_3' => (int)$this->options[2],
                'option_4' => (int)$this->options[3],
                'correct_option' => $this->correct_option,
                'created_by' => Auth::id(),
            ]);

            $this->resetValues();
            session()->flash('status', 'Question Updated successfully!');
            $this->dispatch('refreshQuestionList');
        }
        else{
            session()->flash('status', 'Question not found!');
        }
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

    public function hasDuplicateOptions()
    {
        return count($this->options) !== count(array_unique($this->options));
    }


}

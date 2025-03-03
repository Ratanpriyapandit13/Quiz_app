<?php

namespace App\Livewire\Admin;

use App\Models\Question;
use App\Models\Quiz;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

class ManageQuizzes extends Component
{
    use WithPagination;

    public $name, $total_marks, $passing_marks, $quiz_duration, $quiz_id;
    public $questions = [], $selectedQuestions = [];
    public $isEditing = false;
    public $questionCount = 0;

    protected $rules = [
        'name' => 'required|string',
        'total_marks' => 'required|integer',
        'passing_marks' => 'required|integer',
        'quiz_duration' => 'required|integer',
    ];

    #[Title('Manage Quizzes')]
    public function render()
    {
        return view('livewire.admin.manage-quizzes', [
            'quizzes' => Quiz::with('questions')->paginate(5),
            'allQuestions' => Question::all()
        ]);
    }

    public function createQuiz()
    {
        //$this->validate();
        $this->dispatch('debug-log',$this->selectedQuestions);
        $quiz = Quiz::create([
            'name' => $this->name,
            'total_marks' => $this->total_marks,
            'passing_marks' => $this->passing_marks,
            'quiz_duration' => $this->quiz_duration,
        ]);
        $quiz->questions()->attach($this->selectedQuestions);
        $this->resetFields();
    }

    public function editQuiz($id)
    {
        $quiz = Quiz::findOrFail($id);

        $this->quiz_id = $quiz->id;
        $this->name = $quiz->name;
        $this->total_marks = $quiz->total_marks;
        $this->passing_marks = $quiz->passing_marks;
        $this->quiz_duration = $quiz->quiz_duration;
        $this->selectedQuestions = $quiz->questions->pluck('id');
        $this->isEditing = true;
        $this->questionCount= count($this->selectedQuestions);

        $this->dispatch('debug-log',$quiz->questions()->get());
        $this->dispatch('debug-log',$this->selectedQuestions[0]);
    }

    public function updateQuiz()
    {
        $this->validate();
        $quiz = Quiz::findOrFail($this->quiz_id);
        $quiz->update([
            'name' => $this->name,
            'total_marks' => $this->total_marks,
            'passing_marks' => $this->passing_marks,
            'quiz_duration' => $this->quiz_duration,
        ]);
        $quiz->questions()->sync($this->selectedQuestions);
        $this->resetFields();
    }

    public function deleteQuiz($id)
    {
        Quiz::findOrFail($id)->delete();
    }

    private function resetFields()
    {
        $this->reset(['name', 'total_marks', 'passing_marks', 'quiz_duration', 'selectedQuestions', 'isEditing', 'questionCount']);
    }

    public function addDropdown(){
        $this->questionCount++;
    }


    public function backToAdmin(){
        $this->redirect('/admin-dashboard');
    }
}

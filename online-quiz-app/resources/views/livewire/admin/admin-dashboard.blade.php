<div class="p-6 bg-white shadow rounded">
    <!-- Button to quiz attemped -->
    <button wire:click="logOut" class="bg-yellow-500 px-2 py-1 rounded me-2 mt-2 mb-2 float-end">
        LogOut
    </button>
    <h2 class="text-lg font-semibold mb-4">Admin Dashboard</h2>

    <p>Welcome, <strong>{{ auth()->user()->name }}</strong> ({{ auth()->user()->role->name }})</p>

    <!-- Button to Toggle Question Form -->
    <button wire:click="toggleQuestionForm" class="mt-4 bg-blue-600 px-4 py-2 rounded ms-2">
        {{ $showQuestionForm ? 'Hide Question' : 'Create Question' }}
    </button>

    <!-- Button to Manage quizzes -->
    <button wire:click="manageQuizzes" class="mt-4 bg-blue-600 px-4 py-2 rounded">
       Manage Quizzes
    </button>

     <!-- Button to quiz attemped -->
     <button wire:click="quizAttemps" class="mt-4 bg-blue-600 px-4 py-2 rounded">
        Quiz Attemps
     </button>

    <div class='row'>

        <div class="col-7">
            <livewire:admin.question-list/>
        </div>

        <!-- Show Question Form Only When Toggled -->
        @if($showQuestionForm)
            <div class="col-5">
                <livewire:admin.question-form />
            </div>
        @endif
        <div class="col-5">
            <livewire:admin.edit-question />
        </div>
    </div>
</div>


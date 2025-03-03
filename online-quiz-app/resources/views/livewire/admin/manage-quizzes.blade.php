<div class="max-w-4xl mx-auto p-6 bg-white shadow-lg rounded-lg col-8 mt-2">
    <button wire:click="backToAdmin" class="bg-yellow-500 px-2 py-1 rounded me-2 mt-2 mb-2 float-end">Back</button>

    <h2 class="text-2xl font-bold mb-4 ms-2">Manage Quizzes</h2>

    <form wire:submit.prevent="{{ $isEditing ? 'updateQuiz' : 'createQuiz' }}" class="space-y-4 ms-3">
        <div class="mb-1">
            <label class="font-bold">Quiz name:</label>
            <input type="text" wire:model="name" placeholder="Quiz Name" class="w-full border p-2 rounded">
        </div>
        <div class="mb-1">
            <label class="font-bold">Total Marks:</label>
            <input type="number" wire:model="total_marks" placeholder="Total Marks" class="w-full border p-2 rounded">
        </div>
        <div class="mb-1">
            <label class="font-bold">Passing Marks:</label>
            <input type="number" wire:model="passing_marks" placeholder="Passing Marks" class="w-full border p-2 rounded">
        </div>
        <div class="mb-1">
            <label class="font-bold">Quiz Duration:</label>
            <input type="number" wire:model="quiz_duration" placeholder="Duration (minutes)" class="w-full border p-2 rounded">
        </div>
        {{-- <div class="mb-1">
            <label class="font-bold">Select Questions:</label>
            <div class="row ms-2">
                @foreach($allQuestions as $question)
                    <label class="flex items-center space-x-2">
                        <input type="checkbox" wire:model="selectedQuestions" value="{{ $question->id }}">
                        <span>{{ $question->question_text }}</span>
                    </label>
                @endforeach
            </div>
        </div> --}}

        <div class="mb-1">
            <label class="font-bold">Select Questions:</label>
            <button type="button" wire:click="addDropdown" class="bg-blue-500 px-4 rounded mb-1">Add</button>

            @for ($i = 0; $i < $questionCount; $i++)
                <div class="row ms-3">
                    <select wire:model="selectedQuestions.{{ $i }}" class="col-4 w-full border p-2 rounded mb-1">
                        <option value="">-- Select a Question --</option>
                        @if($allQuestions)
                            @foreach($allQuestions as $question)
                                <option value="{{ $question->id }}">{{ $question->question_text }}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
            @endfor
        </div>


        <button type="submit" class="bg-blue-500  px-4 py-2 rounded mb-1">
            {{ $isEditing ? 'Update Quiz' : 'Create Quiz' }}
        </button>
    </form>

    <table class="w-full mt-6 border-collapse border border-gray-300 ms-2">
        <thead>
            <tr class="bg-gray-200">
                <th class="border p-2">Name</th>
                <th class="border p-2">Total Marks</th>
                <th class="border p-2">Passing Marks</th>
                <th class="border p-2">Duration</th>
                <th class="border p-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($quizzes as $quiz)
                <tr>
                    <td class="border p-2">{{ $quiz->name }}</td>
                    <td class="border p-2">{{ $quiz->total_marks }}</td>
                    <td class="border p-2">{{ $quiz->passing_marks }}</td>
                    <td class="border p-2">{{ $quiz->quiz_duration }}</td>
                    <td class="border p-2 flex space-x-2">
                        <button wire:click="editQuiz({{ $quiz->id }})" class="bg-yellow-500 px-2 py-1 rounded">Edit</button>
                        <button wire:click="deleteQuiz({{ $quiz->id }})" class="bg-red-500 px-2 py-1 rounded">Delete</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

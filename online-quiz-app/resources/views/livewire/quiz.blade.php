{{--
 <div class="max-w-2xl mx-auto bg-white p-6 rounded-lg shadow-lg border border-gray-200">
    <h1 class="text-2xl font-bold text-gray-900 text-center mb-6">📝 Online Quiz</h1>

    <div class="row">
    @foreach($questions as $question)
        <div class="row justify-content-center">
            <div class=" col-6 mb-3 p-3 border rounded-lg bg-gray-50 shadow-sm ">
                <h4 class="text-lg font-semibold text-gray-800">Question : {{ $question->question_text }}</h4>

                <div class="mt-2 grid grid-cols-1 md:grid-cols-2 gap-4">
                    @foreach($question->options() as $option)
                        <label class="flex items-center gap-3 p-2 border rounded-lg cursor-pointer transition-all duration-300
                            {{ ($selected_answers[$question->id] ?? null) == $option->id ? 'border-blue-500 bg-blue-100' : 'border-gray-300 hover:border-blue-400 hover:bg-gray-100' }}">

                            <input type="radio" name="question_{{ $question->id }}" wire:model="selected_answers.{{ $question->id }}" value="{{ $option->id }}" class="hidden">

                            <span class="w-5 h-5 inline-block border-2 border-gray-400 rounded-full flex items-center justify-center">
                                @if(($selected_answers[$question->id] ?? null) == $option->id)
                                    <span class="w-3 h-3 bg-blue-500 rounded-full"></span>
                                @endif
                            </span>


                            <span class="text-gray-700 font-medium">{{ $option->answer }}</span>
                        </label>
                    @endforeach
                </div>
            </div>
        </div>

    @endforeach
    </div>


    <div class="text-center mt-4">
        <button wire:click="submitAnswer"
            class="btn btn-primary px-5 py-2"
            {{ !empty($selected_answers) ? '' : 'disabled' }}>
             Submit Answers
        </button>
    </div>

    @if($isSubmitted)
        <div class="mt-6 p-4 bg-green-100 border-l-4 border-green-500 text-green-700 font-semibold text-center rounded-md">
            Answer Submitted Successfully!
        </div>
    @endif
</div>
 --}}

 <div class="max-w-4xl mx-auto p-6 bg-white shadow-lg rounded-lg">
    <h2 class="text-2xl font-bold mb-4">Available Quizzes</h2>

    <table class="w-full border-collapse border border-gray-300">
        <thead>
            <tr class="bg-gray-200">
                <th class="border p-2">Quiz Name</th>
                <th class="border p-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @if($quizzes)
                @foreach($quizzes as $quiz)
                    <tr>
                        <td class="border p-2">{{ $quiz?->name }}</td>
                        <td class="border p-2">
                            <button wire:click="showQuizQuestions({{ $quiz?->id }})"
                                    class="bg-blue-500 px-4 py-2 rounded">
                                Show Questions
                            </button>
                        </td>
                    </tr>
                @endforeach
            @endif

        </tbody>
    </table>

    {{-- Display questions if a quiz is selected --}}
    @if($selectedQuiz)
        {{-- <div class="mt-6 p-4 border rounded-lg">
            <h3 class="text-xl font-bold mb-2">Questions for: {{ $selectedQuiz->name }}</h3>
            <ul class="list-disc pl-5">
                @foreach($questions as $question)
                    <li class="mb-2">{{ $question->question_text }}</li>
                @endforeach
            </ul>
        </div> --}}
        <div class="max-w-2xl mx-auto bg-white p-6 rounded-lg shadow-lg border border-gray-200">
            <h1 class="text-2xl font-bold text-gray-900 text-center mb-6"> Online Quiz</h1>

            <div class="row">
            @foreach($questions as $qustion_index =>$question)
                <div class="row justify-content-center">
                    <div class=" col-6 mb-3 p-3 border rounded-lg bg-gray-50 shadow-sm ">
                        <h4 class="text-lg font-semibold text-gray-800">Question : {{ $question->question_text }}</h4>

                        <div class="mt-2 grid grid-cols-1 md:grid-cols-2 gap-4">
                            @foreach($question->options() as $index=>$option)
                                <label class="flex items-center gap-3 p-2 border rounded-lg cursor-pointer transition-all duration-300
                                    {{ ($selected_answers[$question->id] ?? null) == $option->id ? 'border-blue-500 bg-blue-100' : 'border-gray-300 hover:border-blue-400 hover:bg-gray-100' }}">
                                    <input type="radio" name="question_{{ $question->id }}" wire:model="selected_answers.{{ $qustion_index}}" value="{{ $option->id }}" class="hidden">

                                    <span class="w-5 h-5 inline-block border-2 border-gray-400 rounded-full flex items-center justify-center">
                                        @if(($selected_answers[$question->id] ?? null) == $option->id)
                                            <span class="w-3 h-3 bg-blue-500 rounded-full"></span>
                                        @endif
                                    </span>
                                    <span class="text-gray-700 font-medium">{{ $option->answer }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>
                </div>

            @endforeach
            </div>


            <div class="text-center mt-4">
                <button wire:click="submitAnswer"
                    class="btn btn-primary px-5 py-2">
                     Submit Answers
                </button>
            </div>

            @if($isSubmitted)
                <div class="mt-6 p-4 bg-green-100 border-l-4 border-green-500 text-green-700 font-semibold text-center rounded-md">
                    Answer Submitted Successfully!
                </div>
            @endif
        </div>
    @endif
</div>


 <div class="max-w-4xl mx-auto p-6 bg-white shadow-lg rounded-lg">
    <button wire:click="logOut" class="bg-yellow-500 px-2 py-1 rounded me-2 mt-2 mb-2 float-end">
        LogOut
    </button>
    <h2 class="text-lg font-semibold mb-4">Student Dashboard</h2>

    <p>Welcome, <strong>{{ auth()->user()->name }}</strong> ({{ auth()->user()->role->name }})</p>

    <div class="row">
        <div class="col-5">
            <h2 class="text-xl font-bold mb-4">My Quiz Attempts</h2>

            <!-- Quiz Attempts Table -->
            <table class="w-full border-collapse border border-gray-300">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="border p-2">Quiz Title</th>
                        <th class="border p-2">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($attemptedQuizzes as $quiz)
                        <tr>
                            <td class="border p-2">{{ $quiz->quiz->name }}</td>
                            <td class="border p-2 text-center">
                                <button wire:click="viewQuizDetails({{ $quiz->quiz->id }},{{ $quiz->id }})"
                                    class="bg-blue-500 px-3 py-1 rounded hover:bg-blue-600"> View Details
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            @if($attemptedQuizzedQuestion)
                <div class="mt-6 p-6 bg-white shadow-lg rounded-lg border border-gray-300 mt-2">
                    <h2 class="text-xl font-bold text-gray-800">Attempted Quiz Details</h2>
                    <button wire:click="clearData" class="bg-yellow-500 px-2 py-1 rounded me-2 mt-2 mb-2 float-end">X</button>

                    <p class="text-gray-600 mb-3"><strong>Quiz:</strong> {{ $attemptedQuizzedQuestion->quiz->name }}</p>

                    <table class="w-full border-collapse border border-gray-300">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="border p-2">Question</th>
                                <th class="border p-2">Your Answer</th>
                                <th class="border p-2">Correct Answer</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($attemptedQuizzedQuestion->submittedAnswers as $submittedAnswer)
                                <tr>
                                    <td class="border p-2">{{ $submittedAnswer->question->question_text }}</td>
                                    <td class="border p-2">
                                        <span class="px-3 py-1 rounded-lg bg-blue-200 text-blue-700">
                                            {{ $submittedAnswer->answer->answer }}
                                        </span>
                                    </td>
                                    <td class="border p-2">
                                        <span class="px-3 py-1 rounded-lg bg-blue-200 text-blue-700">
                                            {{ $submittedAnswer->question->correctAnswer->answer }}
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <p class="text-gray-600 mb-3"><strong>Score:</strong> {{ $attemptedQuizzedQuestion->score}}</p>
                </div>
            @endif

        </div>

        <div class="col-5">
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
        </div>
    </div>

    {{-- Display questions if a quiz is selected --}}
    @if($selectedQuiz)
        <div class="max-w-2xl mx-auto bg-white p-6 rounded-lg shadow-lg border border-gray-200">
            <h2 class="text-2xl font-bold text-gray-900 text-center mb-6"> Online Quiz</h2>

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


<div class="p-4 bg-gray-100 rounded">
    <button wire:click="backToAdmin" class="bg-yellow-500 px-2 py-1 rounded me-2 mt-2 mb-2 float-center">Back</button>
    <h2 class="text-lg font-bold mb-2">User Quiz Attempts</h2>

    <table class="w-full border-collapse border border-gray-300">
        <thead>
            <tr class="bg-gray-200">
                <th class="border border-gray-300 px-4 py-2">User</th>
                <th class="border border-gray-300 px-4 py-2">Quiz</th>
                <th class="border border-gray-300 px-4 py-2">Submitted Answers</th>
                <th class="border border-gray-300 px-4 py-2">Score</th>
                <th class="border border-gray-300 px-4 py-2">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($attemptedQuizzes as $attempt)
                <tr>
                    <td class="border border-gray-300 px-4 py-2">{{ $attempt->user->name }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $attempt->quiz->name }}</td>
                    <td class="border border-gray-300 px-4 py-2">
                        <ul>
                            @foreach($attempt->submittedAnswers as $submittedAnswer)
                                <li>
                                    <strong>Question:</strong> {{ $submittedAnswer->question->question_text }} <br>
                                    <strong>Ans:</strong> {{ $submittedAnswer->answer->answer }}
                                </li>
                            @endforeach
                        </ul>
                    </td>
                    <td class="border border-gray-300 px-4 py-2">{{ $attempt->score }}</td>
                    <td><button wire:click="deleteSubmittedQuiz({{ $attempt->id }})" wire:confirm="Are you sure you want to delete this post?" class="btn btn-danger delete-header m-1"  title="Delete"><i class="glyphicon glyphicon-trash" small>Delete</i></button></td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

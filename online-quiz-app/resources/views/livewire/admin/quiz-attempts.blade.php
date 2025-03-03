<div class="p-4 bg-gray-100 rounded">
    <button wire:click="backToAdmin" class="bg-yellow-500 px-2 py-1 rounded me-2 mt-2 mb-2 float-center">Back</button>
    <h2 class="text-lg font-bold mb-2">User Quiz Attempts</h2>

    <table class="w-full border-collapse border border-gray-300">
        <thead>
            <tr class="bg-gray-200">
                <th class="border border-gray-300 px-4 py-2">User</th>
                <th class="border border-gray-300 px-4 py-2">Quiz</th>
                <th class="border border-gray-300 px-4 py-2">Submitted Answers</th>
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
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

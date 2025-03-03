<div class="p-6 bg-gray-100 min-h-screen ms-2">
    <h4 class="text-2xl font-semibold text-gray-700 mb-2">Question List</h4>
    @if (session()->has('status'))
        <div class="p-2 mb-3 text-green-600 bg-green-100 rounded">{{ session('status') }}</div>
    @endif
    <div class="overflow-x-auto bg-white shadow-md rounded-lg p-4">
        <table class="w-full border-collapse border border-gray-300">
            <thead class="bg-gray-200">
                <tr>
                    <th class="border px-4 py-2 text-left">Question</th>
                    <th class="border px-4 py-2">A</th>
                    <th class="border px-4 py-2">B</th>
                    <th class="border px-4 py-2">C</th>
                    <th class="border px-4 py-2">D</th>
                    <th class="border px-4 py-2 text-green-600">Correct Answer</th>
                    <th class="border px-4 py-2">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($questions as $question)
                    <tr class="border">
                        <td class="border px-4 py-2 font-semibold">{{ $question->question_text }}</td>
                        <td class="border px-4 py-2">{{ optional(App\Models\Answer::find($question->option_1))->answer }}</td>
                        <td class="border px-4 py-2">{{ optional(App\Models\Answer::find($question->option_2))->answer }}</td>
                        <td class="border px-4 py-2">{{ optional(App\Models\Answer::find($question->option_3))->answer }}</td>
                        <td class="border px-4 py-2">{{ optional(App\Models\Answer::find($question->option_4))->answer }}</td>
                        <td class="border px-4 py-2 text-green-600 font-semibold">
                            {{ optional(App\Models\Answer::find($question->correct_option))->answer }}
                        </td>
                        <td class="text-center align-middle">
                            <div class="btn-group">

                                <button wire:click="edit({{ $question->id }})" class="btn btn-info m-1" title="Edit"><i class="glyphicon glyphicon-pencil" small></i> Edit</button>

                                <button wire:click="delete({{ $question->id }})" wire:confirm="Are you sure you want to delete this post?" class="btn btn-danger delete-header m-1"  title="Delete"><i class="glyphicon glyphicon-trash" small>Delete</i></button>

                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

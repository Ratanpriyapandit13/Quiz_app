<div class="col-10">
    {{-- A good traveler has no fixed plans and is not intent upon arriving. --}}
    <div class="p-6 bg-white shadow rounded {{!$question_text ? 'd-none': ''}}" >
        <h4 class="text-lg font-semibold mb-4 ms-2">Update Question</h4>

        @if (session()->has('status'))
            <div class="p-2 mb-3 text-green-600 bg-green-100 rounded">{{ session('status') }}</div>
        @endif

        @if (session()->has('error'))
            <div class="p-2 mb-3 text-green-600 bg-green-100 rounded">{{ session('error') }}</div>
        @endif

        <form wire:submit.prevent="editQuestion" class="ms-2">
            <!-- Question Input -->
            <div class="mb-4">
                <label class="block text-sm font-medium">Question</label>
                <input type="text" wire:model="question_text" class="w-full border p-2 rounded">
                @error('question_text') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Options Input -->

                @foreach($options as $index => $option)
                    <div class="mb-3">
                        <label class="block text-sm font-medium">Option {{ chr(65 + $index) }}</label>
                        @if($answer)
                        <select wire:model="options.{{ $index }}" wire:change="changeEvent($event.target.value)" class="w-full border p-2 rounded">
                            <option value="">-- Select an Answer --</option>
                            @foreach($answer as $ans)
                                <option value="{{ $ans->id }}">{{ $ans->answer }}</option>
                            @endforeach
                        </select>
                        @endif
                        @error('options.'.$index) <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>
                @endforeach

                <div class="mb-4">
                    <label class="block text-sm font-medium">Correct Answer</label>
                    <select wire:model="correct_option"  class="w-full border p-2 rounded">
                        <option value="">-- Select an Answer --</option>
                        @if($question_option)
                            @foreach($question_option as $ans)
                                <option value="{{ $ans->id }}">{{ $ans->answer }}</option>
                            @endforeach
                        @endif

                    </select>
                    @error('correct_option') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
            <!-- Submit Button -->
            <button type="submit" class="bg-blue-600 px-4 py-2 rounded mt-4">Update Question</button>
        </form>
    </div>
</div>

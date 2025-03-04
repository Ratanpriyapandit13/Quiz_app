
<div>
    <button wire:click="backToAdmin" class="bg-yellow-500 px-2 py-1 rounded me-2 mt-2 mb-2 ">Back</button>
    <h2 class="text-lg font-bold">User Role Management</h2>

    <!-- Role Editing Modal -->
    @if($isEditing)
        <div class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50">
            <div class="bg-white p-5 rounded-lg">
                <h3 class="text-lg font-semibold">Edit Role for {{ $selectedUser->name }}</h3>
                <select wire:model="selectedRole" class="mt-2 p-2 border rounded">
                    @foreach($roles as $role)
                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                    @endforeach
                </select>
                <div class="mt-3">
                    <button wire:click="updateRole" class="bg-blue-500 px-4 py-2 rounded">Update</button>
                    <button wire:click="$set('isEditing', false)" class="bg-gray-500 px-4 py-2 rounded">Cancel</button>
                </div>
            </div>
        </div>
    @endif

    <!-- Users Table -->
    <table class="w-full border mt-4">
        <thead>
            <tr class="bg-gray-200">
                <th class="border px-4 py-2">User</th>
                <th class="border px-4 py-2">Email</th>
                <th class="border px-4 py-2">Role</th>
                <th class="border px-4 py-2">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr>
                    <td class="border px-4 py-2">{{ $user->name }}</td>
                    <td class="border px-4 py-2">{{ $user->email }}</td>
                    <td class="border px-4 py-2">{{ $user->role->name ?? 'No Role' }}</td>
                    <td class="text-center align-middle">
                        <div class="btn-group">
                            <button wire:click="editRole({{ $user->id }})" class="btn btn-info m-1" title="Edit"><i class="glyphicon glyphicon-pencil" small></i> Edit</button>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    @if (session()->has('success'))
        <div class="mt-2 p-2 bg-green-300 text-green-800">
            {{ session('success') }}
        </div>
    @endif
</div>


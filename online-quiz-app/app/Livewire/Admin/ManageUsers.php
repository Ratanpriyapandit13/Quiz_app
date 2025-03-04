<?php

namespace App\Livewire\Admin;

use App\Models\Role;
use App\Models\User;
use Livewire\Attributes\Title;
use Livewire\Component;

class ManageUsers extends Component
{
    // public $users;
    // public $isEditing = false;

    // #[Title("Manage users")]
    // public function render()
    // {
    //     $this->users = User::all();
    //     return view('livewire.admin.manage-users');
    // }

    // public function editRole($userId){
    //     $this->isEditing = true;
    // }

    // public function updateUserRole(){

    // }

    // public function clearData(){
    //     $this->isEditing = false;
    // }

    public $users;
    public $roles;
    public $selectedUser;
    public $selectedRole;
    public $isEditing = false;

    public function mount()
    {
        $this->users = User::with('role')->get();
        $this->roles = Role::all();
    }

    public function editRole($userId)
    {
        $this->selectedUser = User::find($userId);
        $this->selectedRole = $this->selectedUser->role_id;
        $this->isEditing = true;
    }

    public function updateRole()
    {
        if ($this->selectedUser) {
            $this->selectedUser->update(['role_id' => $this->selectedRole]);
            session()->flash('success', 'Role updated successfully.');
        }

        $this->reset(['isEditing', 'selectedUser', 'selectedRole']);
        $this->users = User::with('role')->get();
    }

    public function render()
    {
        return view('livewire.admin.manage-users');
    }

    public function backToAdmin(){
        $this->redirect('/admin-dashboard');
    }
}

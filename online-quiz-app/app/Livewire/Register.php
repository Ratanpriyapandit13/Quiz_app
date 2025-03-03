<?php

namespace App\Livewire;

use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Register extends Component
{
    #[Validate('required|min:5')]
    public string $name = "";

    #[Validate('required')]
    public string $email="";

    #[Validate('required|confirmed')]
    public  $password ;

    #[Validate('required')]
    public $password_confirmation;

    #[Title('Register')]
    public function render()
    {
        return view('livewire.register');
    }

    public function save(){
        $this->validate();
        User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'role_id' =>  Role::where('name', 'student')->value('id')
        ]);

        session()->flash('status', 'registration successfully.');

        return $this->redirect('/register');
    }
}

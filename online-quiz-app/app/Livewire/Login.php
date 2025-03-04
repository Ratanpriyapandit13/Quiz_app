<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Title;
use Livewire\Component;

class Login extends Component
{

    public $email, $password;

    #[Title('Login')]
    public function render()
    {
        return view('livewire.login');
    }

    public function login(){
        $this->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if(Auth::attempt(array('email' => $this->email, 'password' => $this->password))){

            if(Auth::user()->role->name == 'admin' ){
                session()->flash('message', "You are Login successful.");
                return redirect("/admin-dashboard");
            }elseif(Auth::user()->role->name == 'student'){
                session()->flash('message', "You are Login successful.");
                return redirect("/quiz");
            }elseif(Auth::user()->role->name == 'instructor'){
                session()->flash('message', "You are Login successful.");
                return redirect("/admin-dashboard");
            }

        }else{
            session()->flash('error', 'email and password are wrong.');
        }
    }
}

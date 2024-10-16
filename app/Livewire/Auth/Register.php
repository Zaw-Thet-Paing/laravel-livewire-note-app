<?php

namespace App\Livewire\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class Register extends Component
{

    public $name;
    public $email;
    public $password;

    public function userRegister()
    {
        $this->validate([
            'name'=> 'required|string',
            'email'=> 'required|email|unique:users',
            'password'=> 'required|min:8'
        ]);

        $user = new User();
        $user->name = $this->name;
        $user->email = $this->email;
        $user->password = Hash::make($this->password);
        $user->save();

        Auth::login($user);

        $this->redirect(route('user.home'), navigate:true);
    }

    public function render()
    {
        return view('livewire.auth.register');
    }
}

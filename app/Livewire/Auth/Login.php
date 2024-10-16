<?php

namespace App\Livewire\Auth;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Login extends Component
{

    public $email;
    public $password;

    public function userLogin()
    {
        $this->validate([
            'email'=> 'required|email',
            'password'=> 'required'
        ]);

        if(!Auth::attempt(['email'=> $this->email, 'password'=> $this->password])){
            $this->addError('email', 'credential wrong');
            return;
        }

        $this->redirect(route('user.home'), navigate:true);

    }

    public function render()
    {
        return view('livewire.auth.login');
    }
}

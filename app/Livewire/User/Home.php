<?php

namespace App\Livewire\User;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Home extends Component
{

    public function userLogout()
    {
        Auth::logout();

        $this->redirect(route('login'), navigate:true);
    }

    public function render()
    {
        return view('livewire.user.home');
    }
}

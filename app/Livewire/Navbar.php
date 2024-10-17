<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Navbar extends Component
{

    public function userLogout()
    {
        Auth::logout();

        $this->redirect(route('login'), navigate:true);
    }

    public function render()
    {
        return view('livewire.navbar');
    }
}

<?php

namespace App\Livewire\User;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Profile extends Component
{

    public $editName;
    public $editEmail;

    public $currentEmail;
    public $currentName;

    public function mount()
    {
        $this->loadProfileData();
    }

    public function loadProfileData()
    {
        $user = Auth::user();

        $this->currentName = $user->name;
        $this->currentEmail = $user->email;
        $this->editName = $user->name;
        $this->editEmail = $user->email;
    }

    public function resetEditProfileErrors()
    {
        $this->resetErrorBag('editEmail');
    }

    public function updateProfile()
    {
        $this->validate([
            'editName'=> 'required|string',
            'editEmail'=> 'required|email'
        ]);

        $user = User::find(Auth::user()->id);

        if($this->editEmail === $this->currentEmail){
            if($this->editName !== $this->currentName){
                $user->update([
                    'name'=> $this->editName
                ]);
            }
        }else{
            $emailExistCheck = User::where('email', $this->editEmail)->first();
            if($emailExistCheck === null){
                $user->update([
                    'name'=> $this->editName,
                    'email'=> $this->editEmail
                ]);
            }else{
                $this->addError('editEmail', 'This email has already taken! Try with another email!');
                return;
            }

        }
        // dd($this->name, $this->email);
        session()->flash('alert', 'User information updated!');

    }

    public function render()
    {
        return view('livewire.user.profile');
    }
}

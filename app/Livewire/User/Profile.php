<?php

namespace App\Livewire\User;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class Profile extends Component
{

    // edit profile
    public $editName;
    public $editEmail;

    public $currentEmail;
    public $currentName;

    // change password
    public $oldPassword;
    public $newPassword;
    public $confirmPassword;

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
        $this->resetValidation();
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

    //change password

    public function resetPasswordForm()
    {
        $this->oldPassword = '';
        $this->newPassword = '';
        $this->confirmPassword = '';
    }

    public function changePassword()
    {
        $this->validate([
            'oldPassword'=> 'required',
            'newPassword'=> 'required|min:8',
            'confirmPassword'=> 'required|same:newPassword'
        ]);

        $auth_user = Auth::user();

        if(!Hash::check($this->oldPassword, $auth_user->password)){
            $this->addError('oldPassword', 'Old Password didn\'t match');
            return;
        }

        $user = User::find($auth_user->id);
        $user->update([
            'password'=> Hash::make($this->confirmPassword)
        ]);

        session()->flash('changePasswordAlert', 'Password Changed!');

    }

    public function render()
    {
        return view('livewire.user.profile');
    }
}

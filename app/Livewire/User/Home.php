<?php

namespace App\Livewire\User;

use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;

class Home extends Component
{

    public $title;
    public $content;

    public function addNewNote()
    {
        // dd("add new note");
        $this->dispatch('add-new-note');
    }

    public function saveNewNote()
    {
        $this->validate([
            'title'=> 'required',
            'content'=> 'required'
        ]);

        dd($this->title, $this->content);

        $this->dispatch('close-add-new-note');
    }

    public function render()
    {
        return view('livewire.user.home');
    }
}

<?php

namespace App\Livewire\User;

use App\Models\Note;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;

class Home extends Component
{

    public $title;
    public $content;

    public $notes = [];

    public function mount()
    {
        $this->notes = Note::where('user_id', Auth::user()->id)->get();
    }

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

        $note = new Note();
        $note->title = $this->title;
        $note->content = $this->content;
        $note->user_id = Auth::user()->id;
        $note->save();
        $this->notes = Note::where('user_id', Auth::user()->id)->get();

        $this->reset('title', 'content');

        $this->dispatch('close-add-new-note');
    }

    public function render()
    {
        return view('livewire.user.home');
    }
}

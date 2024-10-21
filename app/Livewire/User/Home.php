<?php

namespace App\Livewire\User;

use App\Models\Note;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;

class Home extends Component
{

    public $editId;
    public $title;
    public $content;

    // public $noteTitle;
    // public $noteContent;

    public $notes = [];

    public function mount()
    {
        $this->notes = Note::where('user_id', Auth::user()->id)->get();
    }

    // show create new note model
    public function addNewNote()
    {
        $this->reset('title', 'content');
        $this->dispatch('add-new-note');
    }

    //create new note
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

    // delete note
    public function deleteNote($id)
    {
        $note = Note::find($id);
        $note->delete();

        $this->notes = Note::where('user_id', Auth::user()->id)->get();

    }

    // see more note
    public function seeMoreNote($id)
    {
        $note = Note::find($id);

        $this->dispatch('seemore-note', title: $note->title, content: $note->content);
    }

    // show edit note modal
    public function editNote($id)
    {
        $note = Note::find($id);
        $this->editId = $id;
        $this->title = $note->title;
        $this->content = $note->content;

        $this->dispatch('edit-note');
    }

    // update note
    public function updateModal()
    {
        $note = Note::find($this->editId);
        $note->title = $this->title;
        $note->content = $this->content;
        $note->update();

        $this->dispatch('close-edit-note');

        $this->notes = Note::where('user_id', Auth::user()->id)->get();

        $this->reset('editId', 'title', 'content');

    }

    public function render()
    {
        return view('livewire.user.home');
    }
}

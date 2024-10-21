<div>
    <div class="container mt-3">
        <div class="text-center">
            <div class="spinner-grow text-danger" wire:loading wire:target="deleteNote" role="status">
                <span class="visually-hidden">Loading...</span>
              </div>
        </div>
        <div class="row me-3">

            <div class="col-2 p-2" style="height: 200px">
                <div class="border rounded w-100 h-100 d-flex justify-content-center align-items-center" style="cursor: pointer" wire:click="addNewNote">
                    <i class="fa-solid fa-plus fs-1"></i>
                </div>
            </div>

            <!-- Add New Note Modal -->
            <div class="modal fade" id="addNewNoteModal" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Add New Note</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form wire:submit.prevent="saveNewNote">
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="">Title</label>
                                <input type="text" wire:model="title" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="">Content</label>
                                <textarea wire:model="content" class="form-control" rows="8" required></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">
                                Save
                                <div class="spinner-border spinner-border-sm" wire:loading wire:target="saveNewNote" role="status">
                                </div>
                            </button>
                        </div>
                    </form>
                </div>
                </div>
            </div>

            @foreach($notes as $note)
            <div class="col-2 p-2" style="height: 200px">
                <div class="border rounded w-100 h-100 p-2">
                    <div class="d-flex justify-content-between">
                        <div>
                            {{ substr($note->title, 0, 12) }}
                        </div>
                        <div>
                            {{-- edit button --}}
                            <i class="fa-solid fa-pen-to-square text-primary me-2" style="cursor: pointer"></i>
                            {{-- delete button --}}
                            <i class="fa-solid fa-trash text-danger me-2" wire:click="deleteNote({{ $note->id }})" style="cursor: pointer"></i>
                        </div>
                    </div>
                    <hr>
                    {{ substr($note->content, 0, 80) }}
                    @if (strlen($note->content) >= 80)
                        <i class="fa-solid fa-angles-right text-secondary ms-2" wire:click="seeMoreNote({{ $note->id }})" style="cursor: pointer"></i>
                    @endif
                </div>
            </div>
            @endforeach

            <!-- See More Note Modal -->
            <div class="modal fade" id="seeMoreNoteModal" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Note Details</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="">Title</label>
                            <input type="text" id="noteTitle" class="form-control" disabled>
                        </div>
                        <div class="mb-3">
                            <label for="">Content</label>
                            <textarea id="noteContent" rows="12" class="form-control" disabled></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
                </div>
            </div>

        </div>
    </div>
</div>

@script
<script>
    //add new note modal
    window.addEventListener('add-new-note', event => {
        let modal = new bootstrap.Modal(document.getElementById('addNewNoteModal'));
        modal.show();
    });
    window.addEventListener('close-add-new-note', event => {
        let modal = document.getElementById('addNewNoteModal');
        let modalInstance = bootstrap.Modal.getInstance(modal);
        modalInstance.hide();
    });

    //note detail modal
    // window.addEventListener('seemore-note', event => {
    $wire.on('seemore-note', event => {
        // console.log("hit")
        const noteTitle = event.title;
        const noteContent = event.content;

        // console.log(noteTitle, noteContent);

        document.getElementById('noteTitle').value = noteTitle;
        document.getElementById('noteContent').value = noteContent;

        let modal = new bootstrap.Modal(document.getElementById('seeMoreNoteModal'));
        modal.show();
    });
    window.addEventListener('cloe-seemore-note', event => {
        let modal = document.getElementById('seeMoreNoteModal');
        let modalInstance = bootstrap.Modal.getInstance(modal);
        modalInstance.hide();
    });

</script>
@endscript

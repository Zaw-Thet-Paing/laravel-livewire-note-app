<div>
    <div class="container mt-3">
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
            <div class="col-2 p-2" style="height: 200px; cursor: pointer;">
                <div class="border rounded w-100 h-100 p-2">
                    {{ $note->title }}
                    <hr>
                    {{ substr($note->content, 0, 80) }}
                    @if (strlen($note->content) >= 80)
                    ...
                    @endif
                </div>
            </div>
            @endforeach

        </div>
    </div>
</div>

<script>
    window.addEventListener('add-new-note', event => {
        let modal = new bootstrap.Modal(document.getElementById('addNewNoteModal'));
        modal.show();
    });
    window.addEventListener('close-add-new-note', event => {
        let modal = document.getElementById('addNewNoteModal');
        let modalInstance = bootstrap.Modal.getInstance(modal);
        modalInstance.hide();
    });
</script>

<div>
    <h1>Home - {{ Auth::user()->name }}</h1>
    <button class="btn btn-danger" wire:click="userLogout">
        Logout
        <div class="spinner-border spinner-border-sm" wire:loading wire:target="userLogout" role="status">
        </div>
    </button>
</div>

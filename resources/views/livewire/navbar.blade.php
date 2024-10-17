<div>
    <nav class="navbar bg-body-secondary">
        <div class="container">
            <a class="navbar-brand" href="{{ route('user.home') }}" wire:navigate>Note-App</a>
            @if (Auth::user())
            <div class="d-flex">
                <a href="{{ route('user.profile') }}" wire:navigate class="btn btn-outline-primary me-2">Profile</a>
                <button class="btn btn-outline-danger" wire:click="userLogout">
                    Logout
                    <div class="spinner-border spinner-border-sm" wire:loading wire:target="userLogout" role="status">
                    </div>
                </button>
            </div>
            @endif
        </div>
    </nav>
</div>

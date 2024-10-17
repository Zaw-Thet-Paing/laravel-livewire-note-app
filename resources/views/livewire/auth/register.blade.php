<div>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h1 class="text-center">Register Page</h1>
                    </div>
                    <div class="card-body">
                        <form wire:submit="userRegister">

                            <div class="mb-3">
                                <label for="">Name : </label>
                                <input type="text" wire:model="name" class="form-control @error('name') is-invalid @enderror">
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="">Email : </label>
                                <input type="email" wire:model="email" class="form-control @error('email') is-invalid @enderror">
                                @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div x-data="{ passwordStatus: false }">
                                <div class="mb-3">
                                    <label for="">Password : </label>
                                    <div class="input-group">
                                        <input :type="passwordStatus ? 'text' : 'password'" wire:model="password" class="form-control @error('password') is-invalid @enderror">
                                        <span class="input-group-text" x-on:click="passwordStatus = !passwordStatus" style="cursor: pointer">
                                            <i :class="passwordStatus ? 'fa-regular fa-eye' : 'fa-regular fa-eye-slash'"></i>
                                        </span>
                                    </div>
                                    @error('password')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                                </div>
                            </div>

                            <div class="mb-3">
                                <button type="submit" class="btn btn-success w-100">
                                    Register
                                    <div class="spinner-border spinner-border-sm" wire:loading wire:target="userRegister" role="status">
                                    </div>
                                </button>
                            </div>
                            <div class="text-center">
                                <a href="{{ route('login') }}" wire:navigate>Login</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-3"></div>
        </div>
    </div>
</div>

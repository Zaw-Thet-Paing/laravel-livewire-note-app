<div>
    <div class="container mt-3">
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <div class="row" x-data="{ navStatus: 'profile' }">
                    <div class="col-md-4 p-3 border">
                        <ul class="nav nav-pills nav-fill flex-column">
                            <li class="nav-item">
                                <button :class="navStatus === 'profile' ? 'nav-link active' : 'nav-link'" x-on:click="navStatus = 'profile'; $wire.loadProfileData()">Profile</button>
                            </li>
                            <li class="nav-item">
                                <button :class="navStatus === 'editProfile' ? 'nav-link active' : 'nav-link'" x-on:click="navStatus = 'editProfile'; $wire.resetEditProfileErrors()">Edit Profile</button>
                            </li>
                            <li class="nav-item">
                                <button :class="navStatus === 'changePassword' ? 'nav-link active' : 'nav-link'" x-on:click="navStatus = 'changePassword'; $wire.resetPasswordForm()">Change Password</button>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-8 border p-2">
                        <div :class="navStatus === 'profile' ? 'd-block' : 'd-none'">
                            <h2 class="text-center">User Profile</h2>
                            <div class="mb-3">
                                <label for="">Name : </label>
                                <input type="text" class="form-control" wire:model="currentName" disabled>
                            </div>
                            <div class="mb-3">
                                <label for="">Email : </label>
                                <input type="text" class="form-control" wire:model="currentEmail" disabled>
                            </div>
                        </div>

                        <div :class="navStatus === 'editProfile' ? 'd-block' : 'd-none'">
                             <!-- Display the flash message if it exists -->
                            @if (session()->has('alert'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ session('alert') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif
                            <h2 class="text-center">Edit Profile</h2>
                            <form wire:submit.prevent="updateProfile">
                                <div class="mb-3">
                                    <label for="">Name</label>
                                    <input type="text" wire:model="editName" class="form-control @error('editName') is-invalid @enderror">
                                </div>
                                <div class="mb-3">
                                    <label for="">Email</label>
                                    <input type="email" wire:model="editEmail" class="form-control @error('editEmail') is-invalid @enderror">
                                    @error('editEmail')
                                        <span class="text-danger">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <button type="submit" class="btn btn-secondary w-100">
                                        Update
                                    </button>
                                </div>
                            </form>
                        </div>

                        <div :class="navStatus === 'changePassword' ? 'd-block' : 'd-none'">
                             <!-- Display the flash message if it exists -->
                             @if (session()->has('changePasswordAlert'))
                             <div class="alert alert-success alert-dismissible fade show" role="alert">
                                 {{ session('changePasswordAlert') }}
                                 <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                             </div>
                         @endif
                            <h2 class="text-center">Change Password</h2>
                            <form x-data="{ status: false }" wire:submit.prevent="changePassword">
                                <div class="mb-3">
                                    <label for="">Old Password : </label>
                                    <div class="input-group">
                                        <input :type="status ? 'text' : 'password'" wire:model="oldPassword" class="form-control">
                                        <span class="input-group-text" style="cursor: pointer" x-on:click="status = !status" x-text="status ? 'Hide' : 'Show'">
                                        </span>
                                    </div>
                                    @error('oldPassword')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="">New Password : </label>
                                    <input :type="status ? 'text' : 'password'" wire:model="newPassword" class="form-control">
                                    @error('newPassword')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="">Confirm Password : </label>
                                    <input :type="status ? 'text' : 'password'" wire:model="confirmPassword" class="form-control">
                                    @error('confirmPassword')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <button type="submit" class="btn btn-secondary w-100">Change Password</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-2"></div>
        </div>
    </div>
</div>

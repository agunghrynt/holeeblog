<div>
    <div class="d-flex flex-row">
        <div class="col-md-6">
            <div class="rounded-5 border-muted p-3">
                <h2>Basic Info</h2>
                @if (session()->has('messageBasic'))
                    <div class="alert alert-success alert-dismissible fade show col-md-6" role="alert">
                        <strong>{{ session('messageBasic') }}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <form wire:submit.prevent="saveBasicSettings">
                    @csrf

                    <div class="d-flex flex-row gap-5 align-items-center lh-1 border-bottom border-muted py-2">
                        <div class="kiri m-0 p-0 col-3">
                            <p class="m-0 p-0">
                                Profile Picture
                            </p>
                        </div>
                        <div class="kanan d-flex flex-row gap-2 align-items-center lh-1">
                            <div class="profile-pic-dashboard">
                                <input type="file" id="profile-pic-upload" wire:model.live="photo" name="photo" accept="image/*" class="d-none">

                                @if ($photo && ($user->photo === NULL))
                                    <label for="profile-pic-upload" class="profile-pic-dashboard">
                                        <img src="{{ $photo->temporaryUrl() }}" alt="Profile Photo" class="profile-pic-dashboard">
                                    </label>
                                @elseif ($user->photo)
                                    <label for="profile-pic-upload" class="profile-pic-dashboard">
                                        <img src="{{ route('storage.file', ['filename' => $user->photo]) }}" alt="Profile Photo" class="profile-pic-dashboard">
                                    </label>
                                @else
                                    <label for="profile-pic-upload" class="profile-pic-dashboard">
                                        <img src="/img/person.svg" alt="Default Profile Photo" class="profile-pic-dashboard">
                                    </label>
                                @endif

                            </div>
                            <div class="p-0 m-0 lh-1 align-items-start">
                                <small class="d-flex flex-row p-0 m-0 lh-1 align-content-start">
                                    <label for="profile-pic-upload" class="d-flex flex-row justify-content-start btn m-0 p-0 lh-1 border-0 text-decoration-none">
                                        <p class="p-0 m-0 lh-1">Upload new picture</p>
                                    </label>
                                </small>
                                <small class="d-flex flex-row p-0 m-0 lh-1 align-content-start">
                                    <label for="profile-pic-upload" class="d-flex flex-row justify-content-start btn m-0 p-0 lh-1 border-0 text-decoration-none">
                                        @if (!empty($user->photo))
                                            <button class="btn m-0 p-0 lh-1 border-0" type="button" wire:click="removePhoto"><small><strong class="text-danger lh-1" style="font-size: 0.75rem">Remove</strong></small></button>
                                        @endif
                                    </label>
                                </small>
                                <p class="d-flex flex-row p-0 m-0 lh-1 align-content-start @if($errors->has('photo')) is-invalid @elseif($photo == NULL) @else is-valid @endif">
                                    @error('photo')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex flex-row gap-5 align-items-center lh-1 border-bottom border-muted py-2">
                        <div class="kiri m-0 p-0 col-3">
                            <span class="m-0 p-0">Name</span>
                        </div>
                        <div class="kanan col">
                            <input autocomplete="off" type="text" class="form-control @if($errors->has('name')) is-invalid @elseif($name == NULL) @else is-valid @endif" name="name" wire:model.live="name">
                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="d-flex flex-row gap-5 align-items-center lh-1 border-bottom border-muted py-2">
                        <div class="kiri m-0 p-0 col-3">
                            <span class="m-0 p-0">Username</span>
                        </div>
                        <div class="kanan col">
                            <input autocomplete="off" type="text" class="form-control @if($errors->has('username')) is-invalid @elseif($username == NULL) @else is-valid @endif" name="username" wire:model.live="username">
                            @error('username')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="d-flex flex-row mt-4">
                        <button wire:click="saveBasicSettings" class="btn btn-primary">Save Basic Info</button>
                    </div>
                </form>
                {{--
                <div class="d-flex flex-row gap-5 align-items-center lh-1 border-bottom border-muted py-2">
                    <div class="kiri m-0 p-0 col-3">
                        <p class="m-0 p-0">
                            Thumbnail
                        </p>
                    </div>
                    <div class="kanan col">
                        @if ($photo)
                            <img src="{{ $photo->temporaryUrl() }}" id="crop-image" class="img-thumbnail" />
                        @else
                            <img src="{{ $photo }}" id="crop-image" class="img-thumbnail" />
                        @endif
                    </div>
                </div>
                 --}}
            </div>

            <div class="rounded-5 border-muted p-3">
                    <h2>Advanced Settings</h2>
                    @if (session()->has('messageAdvanced'))
                        <div class="alert alert-success alert-dismissible fade show col-md-6" role="alert">
                            <strong>{{ session('messageAdvanced') }}</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <form wire:submit.prevent="saveAdvancedSettings">
                        @csrf
                        <div class="d-flex flex-row gap-5 align-items-center lh-1 border-bottom border-muted py-2">
                            <div class="kiri m-0 p-0 col-3">
                                <span class="m-0 p-0">Email address</span>
                            </div>
                            <div class="kanan col">
                                <input autocomplete="off" type="email" class="form-control @if($errors->has('email')) is-invalid @elseif($email == NULL) @else is-valid @endif" name="email" wire:model.live="email">
                                @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="d-flex flex-row gap-5 align-items-center lh-1 border-bottom border-muted py-2">
                            <div class="kiri m-0 p-0 col-3">
                                <span class="m-0 p-0">Password</span>
                            </div>
                            <div class="kanan col">
                                <input autocomplete="off" type="password" class="form-control @if($errors->has('password')) is-invalid @elseif($password == NULL) @else is-valid @endif" name="password" wire:model.live="password">
                                @error('password')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="d-flex flex-row gap-5 align-items-center lh-1 border-bottom border-muted py-2">
                            <div class="kiri m-0 p-0 col-3">
                                <span class="m-0 p-0">Confirm Password</span>
                            </div>
                            <div class="kanan col">
                                <input autocomplete="off" type="password" class="form-control @if($errors->has('confirmPassword')) is-invalid @elseif($confirmPassword == NULL) @else is-valid @endif" name="confirmPassword" wire:model.live="confirmPassword">
                                @error('confirmPassword')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="d-flex flex-row mt-4">
                            <button wire:click="saveAdvancedSettings" class="btn btn-primary">Save Changes</button>
                        </div>
                    </form>
            </div>
        </div>
    </div>

    <!-- Modal untuk cropping gambar -->
    <div id="cropModal" class="modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Crop Image</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="croppie-container"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal" id="crop-image-button">Crop</button>
                </div>
            </div>
        </div>
    </div>

</div>

@push('scripts')
<script src="js/usersetting.js"></script>
@endpush

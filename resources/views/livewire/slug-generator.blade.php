<div>
  <div class="mb-3">
    <span for="title" class="form-label">Title</span>
    <input type="text" class="form-control @error('title') is-invalid @enderror" wire:model="title" wire:keyup="generateSlug" id="title" name="title" value="{{ old('title') }}" required autofocus>
    @error('title')
      <p class="invalid-feedback">{{ $message }}</p>
    @enderror
  </div>

  <div class="mb-3">
    <span for="slug" class="form-label">Slug</span>
    <input type="text" class="form-control @error('slug') is-invalid @enderror" wire:model="slug" id="slug" name="slug" value="{{ old('slug') }}" required>
    @error('slug')
      <p class="invalid-feedback">{{ $message }}</p>
    @enderror
  </div>
</div>

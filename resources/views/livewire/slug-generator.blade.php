<div>
  {{-- @dd($makeTitle); --}}
  @if ($makeData == 'post')
    <div class="mb-3">
      <span for="title" class="form-label">Title</span>
      <input type="text" class="form-control @error('title') is-invalid @enderror" wire:model="title" wire:keyup="generateSlugTitle" id="title" name="title" value="{{ old('title') }}"  required autofocus>
      @error('title')
        <p class="invalid-feedback">{{ $message }}</p>
      @enderror
    </div>
  @else
    <div class="mb-3">
      <span for="name" class="form-label">Category Name</span>
      <input type="text" class="form-control @error('name') is-invalid @enderror" wire:model="name" wire:keyup="generateSlugName" id="name" name="name" value="{{ old('name') }}"  required autofocus>
      @error('name')
        <p class="invalid-feedback">{{ $message }}</p>
      @enderror
    </div>
  @endif

  <div class="mb-3">
    <span for="slug" class="form-label">Slug</span>
    <input type="text" class="form-control @error('slug') is-invalid @enderror" wire:model="slug" id="slug" name="slug" value="{{ old('slug') }}" required>
    @error('slug')
      <p class="invalid-feedback">{{ $message }}</p>
    @enderror
  </div>
</div>

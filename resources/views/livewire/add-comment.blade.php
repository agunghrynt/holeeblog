<div>
    @if (session()->has('error') || $errors->has('commentBody'))
        <div class="collapse show" id="collapseExample">
            <div class="form-floating d-flex flex-row mb-1">
                <textarea wire:model="commentBody" class="form-control @error('commentBody') is-invalid @enderror" placeholder="Leave a comment here" id="floatingTextarea" style="height: 100px" required></textarea>
                <label for="floatingTextarea">Leave a comment...</label>
            </div>
            <div class="form-check form-switch mb-1">
                <input wire:model="isAnonymous" class="form-check-input" type="checkbox" role="switch" id="anonymousCheck" required>
                <label class="form-check-label" for="anonymousCheck">Comment as anonymous</label>
            </div>
            <p class="small text-danger mb-1 lh-1">
                {{ session('error') }}
                @error('commentBody') {{ $message }} @enderror
            </p>
            <button wire:click="submit" class="btn btn-primary me-2 btn-sm mb-2">
                Submit Comment
            </button>
        </div>

        <p class="d-inline-flex gap-2 d-md-flex justify-content-md-end mb-2">
            <button class="btn btn-primary me-2 btn-sm" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="true" aria-controls="collapseExample">
                Leave a comment
            </button>
        </p>
    @else
        <div class="collapse {{ $editCommentId ? 'show' : null }}" id="collapseExample">
            <div class="form-floating d-flex flex-row mb-1">
                <textarea wire:model="commentBody" class="form-control @error('commentBody') is-invalid @enderror" placeholder="Leave a comment here" id="floatingTextarea" style="height: 100px" required></textarea>
                <label for="floatingTextarea">Leave a comment...</label>
            </div>
            <div class="form-check form-switch mb-1">
                <input wire:model="isAnonymous" class="form-check-input" type="checkbox" role="switch" id="anonymousCheck" required {{ $editCommentId ? 'checked' : null }}>
                <label class="form-check-label" for="anonymousCheck">Comment as anonymous</label>
            </div>
            {{-- <button wire:click="submit" class="btn btn-primary me-2 btn-sm mb-2"> --}}
            <button data-bs-toggle="modal" data-bs-target="#staticBackdropEdit{{ $editCommentId }}" class="btn btn-primary me-2 btn-sm mb-2">
                {{ $editCommentId ? 'Update Comment' : 'Submit Comment' }}
            </button>
            @if ($editCommentId)
                <button wire:click="resetForm" class="btn btn-sm btn-secondary mb-2">Cancel Edit</button>
            @endif
        </div>

        <p class="d-inline-flex gap-2 d-md-flex justify-content-md-end mb-2">
            <button class="btn btn-primary me-2 btn-sm" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="true" aria-controls="collapseExample">
                Leave a Comment
            </button>
        </p>

        <!-- Modal Edit -->
        <div class="modal fade" id="staticBackdropEdit{{ $editCommentId }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"                      aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
              <div class="modal-content">
                <div class="modal-header">
                  <h1 class="modal-title fs-5" id="staticBackdropLabel">Confirm</h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  Are you sure?
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                  <form wire:submit="submit({{ $editCommentId }})" class="d-inline">
                    @csrf
                    
                    <button type="submit" class="btn btn-danger" data-bs-dismiss="modal">Yes</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
    @endif
</div>

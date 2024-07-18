<div>
    @foreach($post->comments as $comment)
        <div class="d-flex flex-row mb-3">
            <div class="p-2">
                <img class="profile-pic float-start me-2" src="{{ URL::to('/') }}/img/person.svg" alt="Profile Pic">
            </div>
            <div class="card card-body d-flex d-inline-flex p-2">
                <div class="mb-1 d-flex d-inline-flex align-items-center justify-content-between">
                    <div class="d-flex d-inline-flex gap-1 lh-1 align-items-center p-0">
                        <strong class="text-left fs-6 lh-1">{{ $comment->is_anonymous ? 'Anonymous' : $comment->author->name }} </strong>
                        <small class="fw-light fst-italic">{{ $comment->created_at->diffForHumans() }} on {{ date('d M y', strtotime($comment->created_at)) }} at {{ date('H:i', strtotime($comment->created_at)) }}</small>
                        <small class="fw-light fst-italic">{{ $comment->is_edited ? '(edited)' : '' }}</small>
                    </div>
                    <div class="d-flex d-inline-flex gap-1 lh-1 align-items-center p-0">
                      @if (Auth::check() && (Auth::user()->id === $comment->user_id) || ($isAdmin) )
                      @can('creator', $comment)
                        <button wire:click="edit({{ $comment->id }})" class="btn btn-sm btn-link text-small text-decoration-none border-0 p-0"><i class="bi bi-pencil-square"></i></button>
                      @endcan
                      {{-- Trigger Modal --}}
                      <button data-bs-toggle="modal" data-bs-target="#staticBackdrop{{ $comment->id }}" class="btn btn-sm btn-link text-small text-decoration-none border-0 p-0"><i class="bi bi-trash"></i></button>
                      @endif
                    </div>
                </div>
                <p class="text-start mb-1">{{ $comment->body }}</p>
            </div>
        </div>
        <!-- Modal Delete -->
        <div class="modal fade" id="staticBackdrop{{ $comment->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"                      aria-labelledby="staticBackdropLabel" aria-hidden="true">
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
                <form wire:submit="delete({{ $comment->id }})" class="d-inline">
                  @csrf
                  
                  <button type="submit" class="btn btn-danger" data-bs-dismiss="modal">Yes</button>
                </form>
              </div>
            </div>
          </div>
        </div>
    @endforeach
</div>
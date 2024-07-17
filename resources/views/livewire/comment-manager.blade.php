<div>
    @if ($post->comments_count > 0)
          <hr class="border opacity-50">
          <button class="btn btn-primary mb-3" disabled style="opacity: 100">
            <strong>COMMENTS </strong><span class="badge text-bg-secondary">{{ $post->comments_count }}</span>
          </button>

          @php
            // Lazy eager loading comments dengan penulisnya
            $post->loadMissing('comments.author');
          @endphp

          {{-- comment list --}}
          {{-- <livewire:comment-list :post="$post" /> --}}
          @livewire('comment-list', ['isAdmin' => $isAdmin, 'post' => $post])
          {{-- comments --}}
          {{-- <livewire:add-comment :post="$post" /> --}}
          @livewire('add-comment', ['isAdmin' => $isAdmin, 'post' => $post])
          
        @else
          <hr class="border opacity-50">
          <p class="text-center fs-5">No comments found.</p>
          <strong><p class="text-center fs-4">LEAVE A COMMENT</p></strong>
          {{-- comments --}}
          {{-- <livewire:add-comment :post="$post" /> --}}
          @livewire('add-comment', ['isAdmin' => $isAdmin, 'post' => $post])
        @endif
</div>

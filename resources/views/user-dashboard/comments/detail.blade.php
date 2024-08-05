@extends('user-dashboard.layouts.main')

@section('container')

<div class="container">
  <div class="row my-3">
    <div class="col-lg-8">
      <h2 class="mb-3">{{ $comment->post->title }}</h2>

      <a href="{{ $isManage ? route('comments.manage') : route('comments.index') }}" class="text-decoration-none btn btn-primary btn-sm"><i class="bi bi-arrow-left"></i>{{ $isManage ? ' Back to All Comments' : ' Back to My Comments' }}</a>

      @if (!$isManage)
        <a class="btn btn-warning text-decoration-none btn-sm" href="{{ route('comments.edit', $comment->id) }}" data-bs-toggle="tooltip" data-bs-title="Edit"><i class="bibi-pencil-square"></i> Edit</a>
      @endif

      <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#staticBackdrop"><i class="bi bi-trash"></i> Delete Comment</button>
      <button class="btn btn-primary btn-sm"><i class="bi bi-eye"></i> {{ $post->views_count }}</button>

      <!-- Modal -->
      <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"aria-hidden="true">
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
              <form action="{{ $isAdmin ? route('comments.manage.destroy', $comment) : route('comments.destroy', $comment) }}" method="POST" class="d-inline">
                @method('DELETE')
                @csrf

                <button type="submit" class="btn btn-danger">Yes</button>
              </form>
            </div>
          </div>
        </div>
      </div>

      @if (empty($comment->post->image))
        <div class="d-flex justify-content-center mt-3 img-fluid" style="max-height: 300px; max-width:100%; overflow: hidden;">
          <img src="/img/post-1.jpg" class="object-fit-contain" alt="{{ $comment->post->category->name }}">
        </div>
      @else
        <div class="d-flex justify-content-center mt-3 img-fluid" style="max-height: 300px; max-width:100%; overflow: hidden;">
          <img src="{{ secure_asset('storage/' . $comment->post->image) }}" class="object-fit-contain" alt="{{ $comment->post->category->name }}">
        </div>
      @endif

      <p>{!! $comment->post->body !!}</p>
      <div>
        @livewire('comment-manager', ['isAdmin' => $isAdmin, 'post' => $post])
      </div>
    </div>
  </div>
</div>

@endsection

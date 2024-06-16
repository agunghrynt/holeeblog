@extends('user-dashboard.layouts.main')

@section('container')

<div class="container">
  <div class="row my-3">
    <div class="col-lg-8">
      <h2 class="mb-3">{{ $post->title }}</h2>
    
      <a href="/user-dashboard/posts" class="text-decoration-none btn btn-primary btn-sm"><i class="bi bi-arrow-left"></i> Back to all posts</a>
      <a class="btn btn-warning text-decoration-none btn-sm" href="/user-dashboard/posts/{{ $post->slug }}/edit" data-bs-toggle="tooltip" data-bs-title="Edit"><i class="bibi-pencil-square"></i> Edit</a>
      {{-- <a class="btn btn-danger text-decoration-none btn-sm" href="" data-bs-toggle="tooltip" data-bs-title="Delete"><i class="bi bi-trash"></i> Delete</a> --}}
      {{-- Trigger Modal --}}
      <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#staticBackdrop"><i class="bi bi-trash"></i> Delete</button>

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
              <form action="/user-dashboard/posts/{{ $post->slug }}" method="POST" class="d-inline">
                @method('DELETE')
                @csrf
                
                <button type="submit" class="btn btn-danger">Yes</button>
              </form>
            </div>
          </div>
        </div>
      </div>
      
      @if (empty($post->image))
        <div class="d-flex justify-content-center mt-3 img-fluid" style="max-height: 300px; max-width:100%;">
          <img src="{{ URL::to('/') }}/img/post-1.jpg" class="object-fit-contain" alt="{{ $post->category->name }}">
        </div>
      @else
        <div class="d-flex justify-content-center mt-3 img-fluid" style="max-height: 300px; max-width:100%;">
          <img src="{{ asset('storage/' . $post->image) }}" class="object-fit-contain" alt="{{ $post->category->name }}">
        </div>
      @endif
      
      <p>{!! $post->body !!}</p>
    </div>
  </div>
</div>

@endsection

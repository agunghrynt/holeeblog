
@extends('layouts.main')

@section('container')

<div class="container">
  <div class="row justify-content-center mb-5">
    <div class="col-md-8">
    {{-- @dd($post) --}}
      <h2 class="mb-5">{{ $post->title }}</h2>

      <div class="d-flex align-items-center justify-content-between mb-2 lh-1">
        <div class="d-flex justify-content-start">
          <p class="m-0">By. <a href="/posts?author={{ $post->author->username }}" class="text-decoration-none lh-1">{{ $post->author->name }}</a> in <a href="/posts?category={{ $post->category->slug }}" class="text-decoration-none lh-1">{{ $post->category->name }}</a></p>
        </div>
        <div class="d-flex justify-content-end">
          <p class="m-0">
            <button type="button" class="btn btn-sm btn-primary" disabled style="opacity: 100">
              <span><i class="bi bi-eye"></i> {{ $post->views_count }}</span>
            </button>
          </p>
        </div>
      </div>
      
      @if (empty($post->image))
        <div class="d-flex justify-content-center mt-3 img-fluid" style="max-height: 300px; max-width:100%; overflow: hidden;">
          <img src="{{ URL::to('/') }}/img/post-1.jpg" class="object-fit-contain" alt="{{ $post->category->name }}">
        </div>
      @else
        <div class="d-flex justify-content-center mt-3 img-fluid" style="max-height: 300px; max-width:100%; overflow: hidden;">
          <img src="{{ asset('storage/' . $post->image) }}" class="object-fit-scale" alt="{{ $post->category->name }}">
        </div>
      @endif
      <p>{!! $post->body !!}</p>
      <a href="/posts" class="text-decoration-none btn btn-primary btn-sm mb-3">Back</a>
      {{-- Comment section --}}

      <div>
        @livewire('comment-manager', ['isAdmin' => $isAdmin, 'post' => $post])
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="staticBackdropSB" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabelSB" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5 text-black" id="staticBackdropLabelSB">Confirm</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body text-black">
        Are you sure?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <form action="/logout" method="POST">
          @csrf

          <button type="submit" class="btn btn-danger">Yes</button>
        </form>
      </div>
    </div>
  </div>
</div>

@endsection
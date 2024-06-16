
@extends('layouts.main')

@section('container')

<div class="container">
    <div class="row justify-content-center mb-5">
        <div class="col-md-8">
            <h2 class="mb-5">{{ $post->title }}</h2>
        
            <p>By. <a href="/blog?author={{ $post->author->username }}" class="text-decoration-none">{{ $post->author->name }}</a> in <a href="/blog?category={{ $post->category->slug }}" class="text-decoration-none">{{ $post->category->name }}</a></p>
            
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
            <a href="/blog" class="text-decoration-none btn btn-primary btn-sm">Back</a>
        </div>
    </div>
</div>

@endsection
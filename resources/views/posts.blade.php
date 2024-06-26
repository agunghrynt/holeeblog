
@extends('layouts.main')

@section('container')

<h1 class="mb-3 text-center">{{ $title }}</h1>

<div class="row justify-content-center mb-4">
    <div class="col-md-6">
        <form action="/blog">

            @if (request('category'))
                <input type="hidden" name="category" value="{{ request('category') }}">
            @endif

            @if (request('author'))
                <input type="hidden" name="author" value="{{ request('author') }}">
            @endif

            <div class="input-group">
                <input type="text" class="form-control" placeholder="Search a post..." name="search" value="{{ request('search') }}">
                <button class="btn btn-primary" type="submit">Search</button>
            </div>
        </form>
    </div>
</div>


@if ($posts->count() > 0)

    <div class="card mb-3">
        @if (empty($posts[0]->image))
          <div style="max-height: 400px; overflow:hidden;">
            <img src="{{ URL::to('/') }}/img/post-1.jpg" class="card-img-top object-fit-fill border rounded" alt="{{ $posts[0]->category->name }}">
          </div>
        @else
          <div style="max-height: 400px; overflow:hidden;">
            <img src="{{ asset('storage/' . $posts[0]->image) }}" class="card-img-top object-fit-fill border rounded" alt="{{ $posts[0]->category->name }}">
          </div>
        @endif
        <div class="card-body text-center">
          <h5 class="card-title fs-3"><a href="/posts/{{ $posts[0]->slug }}" class="text-decoration-none text-dark">{{ $posts[0]->title }}</a></h5>
            <p class="card-text">
                <small class="text-body-secondary">
                    By. <a href="/blog?author={{ $posts[0]->author->username }}" class="text-decoration-none">{{ $posts[0]->author->name }}</a> in <a href="/blog?category={{ $posts[0]->category->slug }}" class="text-decoration-none">{{ $posts[0]->category->name }}</a>
                </small>
            </p>
          <p class="card-text fs-6">{{ $posts[0]->excerpt }}</p>
          <p class="card-text"><small class="text-body-secondary">Last update {{ $posts[0]->created_at->diffForHumans() }}</small></p>

          <a href="/posts/{{ $posts[0]->slug }}" class="text-decoration-none btn btn-primary btn-sm">Read more</a>
        </div>
    </div>

    <div class="container">
        <div class="row">
            @foreach ($posts->skip(1) as $post)
            <div class="col-md-4 mb-3">
                <div class="card">
                    <div class="position-absolute px-3 py-2" style="background-color: rgba(0, 0, 0, 0.1)"><a href="/blog?category={{ $post->category->slug }}"     class="text-decoration-none  text-white">{{ $post->category->name }}</a></div>
                    @if (empty($post->image))
                        <div style="max-height: 400px; overflow:hidden;">
                            <img src="{{ URL::to('/') }}/img/post-1.jpg" class="card-img-top object-fit-fill border rounded" alt="{{ $post->category->name }}">
                        </div>
                    @else
                        <div style="max-height: 400px; overflow:hidden;">
                            <img src="{{ asset('storage/' . $post->image) }}" class="card-img-top object-fit-fill border rounded" alt="{{ $post->category->name }}">
                        </div>
                    @endif
                    {{-- <img src="../img/post-1.jpg" class="card-img-top object-fit-fill border rounded" style="height: 200px;" alt="{{ $post->category->name }}"> --}}
                    <div class="card-body">
                      <h5 class="card-title"><a href="/posts/{{ $post->slug }}" class="text-decoration-none">{{ $post->title }}</a></h5>
                        <p class="card-text">
                            <small class="text-body-secondary">
                                By. <a href="/blog?author={{ $post->author->username }}" class="text-decoration-none">{{ $post->author->name }}</a>
                            </small>
                        </p>
                      <p class="card-text">{{ $post->excerpt }}</p>
                      <p class="card-text"><small class="text-body-secondary">Last update {{ $post->created_at->diffForHumans() }}</small></p>
                      <a href="/posts/{{ $post->slug }}" class="text-decoration-none btn btn-primary btn-sm">Read more</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

@else
    <p class="text-center fs-4">No post found.</p>
@endif

<div class="d-flex justify-content-center">
    {{ $posts->links() }}
</div>

{{-- @foreach ($posts->skip(1) as $post)
    <article class="mb-5 border-bottom pb-4" >

        <h2><a href="/posts/{{ $post->slug }}" class="text-decoration-none">{{ $post->title }}</a></h2>

        <p>By. <a href="/authors/{{ $post->author->username }}" class="text-decoration-none">{{ $post->author->name }}</a> in <a href="/categories/{{ $post->category->slug }}" class="text-decoration-none">{{ $post->category->name }}</a></p>
        
        <p>{{ $post->excerpt }}</p>

        <a href="/posts/{{ $post->slug }}" class="text-decoration-none">Read More...</a>

    </article>
@endforeach --}}
    
@endsection



@extends('layouts.main')

@section('container')

    <h1 class="mb-5">Post Categories</h1>

    <div class="container">
        <div class="row">
            @foreach ($categories as $category)
                <div class="col-md-4 mb-4">
                    <a href="/blog?category={{ $category->slug }}" class="text-decoration-none">
                        <div class="card text-bg-dark">
                            <img src="../img/post-1.jpg" class="card-img-top object-fit-fill border rounded" style="height: 200px;" alt="{{ $category->name }}">
                            <div class="card-img-overlay d-flex align-items-center p-0">
                              <h5 class="card-title text-center flex-fill p-2 fs-5" style="background-color: rgba(0, 0, 0, 0.5)">{{ $category->name }}</h5>
                            </div>
                        </div>
                    </a>
                </div>           
            @endforeach
        </div>
    </div>

    {{-- @foreach ($categories as $category)
    <ul>
        <li>
            <h2>
                <a href="/categories/{{ $category->slug }}" class="text-decoration-none">{{ $category->name }}</a>
            </h2>
        </li>
    </ul>
    @endforeach --}}
    
@endsection


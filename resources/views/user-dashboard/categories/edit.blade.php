@extends('user-dashboard.layouts.main')

@section('container')
    
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-2 border-bottom">
      <h1 class="h3">Edit Category</h1>
  </div>

  <div class="col-lg-8">
    <form action="/user-dashboard/categories/{{ $category->slug }}" method="POST">
      @method('PUT')
      @csrf

      <div class="mb-3">
        <span for="category" class="form-label">Category Name</span>
        <input type="text" class="form-control @error('category') is-invalid @enderror" id="category" name="category" value="{{ old('category', $category->name) }}" required autofocus>
        @error('category')
          <p class="invalid-feedback">{{ $message }}</p>
        @enderror
      </div>

      <div class="mb-3">
        <span for="slug" class="form-label">Slug</span>
        <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug" name="slug" value="{{ old('slug', $category->slug) }}" >
        @error('slug')
          <p class="invalid-feedback">{{ $message }}</p>
        @enderror
      </div>

      <div class="d-grid gap-2 d-md-flex justify-content-md-end mb-3">
        <button type="submit" class="btn btn-primary">Update Category</button>
      </div>

    </form>
      
  </div>

  
  <script src="{{ URL::to('/') }}/js/mycategoryutils.js">
  </script>

@endsection
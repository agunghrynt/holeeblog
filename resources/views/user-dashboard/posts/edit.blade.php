@extends('user-dashboard.layouts.main')

@section('container')
    
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-2 border-bottom">
      <h1 class="h3">Edit post</h1>
  </div>

  <div class="col-lg-8">
    <form action="/user-dashboard/posts/{{ $post->slug }}" method="POST" enctype="multipart/form-data">
      @method('PUT')
      @csrf

      <div class="mb-3">
        <span for="title" class="form-label">Title</span>
        <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title', $post->title) }}"  autofocus>
        @error('title')
          <p class="invalid-feedback">{{ $message }}</p>
        @enderror
      </div>

      <div class="mb-3">
        <span for="slug" class="form-label">Slug</span>
        <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug" name="slug" value="{{ old('slug', $post->slug) }}" >
        @error('slug')
          <p class="invalid-feedback">{{ $message }}</p>
        @enderror
      </div>

      <div class="mb-3">
        <span for="category_id" class="form-label">Category</span>
        <select id="category_id" class="form-select @error('category_id') is-invalid @enderror" name="category_id" >
          <option value="" selected>Choose a category</option>
          @foreach ($categories as $category)
            @if (old('category_id', $post->category_id) == $category->id)
              <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
            @else
              <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endif
          @endforeach
        </select>
        @error('category_id')
          <p class="invalid-feedback">{{ $message }}</p>
        @enderror
      </div>

      <div class="mb-3">
        <span for="image" class="form-label">Upload a image</span>
        <input class="form-control @error('image') is-invalid @enderror" type="file" accept="image/*" id="image" name="image">
        <input type="hidden" name="oldImg" value="{{ $post->image }}">
        @if ($post->image)
          <div id="showImg" style="display: block">
            <div class="d-flex justify-content-center mt-3 img-fluid" style="max-height: 300px; max-width:auto;">
              <img src="{{ asset('storage/' . $post->image) }}" alt="Preview Uploaded image" id="file-preview" class="object-fit-contain">
            </div>
          </div>
        @else
          <div id="showImg" style="display: none">
            <div class="d-flex justify-content-center mt-3 img-fluid" style="max-height: 300px; max-width:auto;">
              <img alt="Preview Uploaded image" id="file-preview" class="object-fit-contain">
            </div>
          </div>
        @endif
        @error('image')
          <p class="invalid-feedback">{{ $message }}</p>
        @enderror
      </div>

      <div class="mb-3">
        <span for="body" class="form-label @error('body') is-invalid @enderror">Body</span>
        <input type="hidden" name="body" id="body" value="{{ old('body', $post->body) }}">
        <trix-editor input="body"></trix-editor>
        @error('body')
          <p class="invalid-feedback">{{ $message }}</p>
        @enderror
      </div>

      <div class="d-grid gap-2 d-md-flex justify-content-md-end mb-3">
        <button type="submit" class="btn btn-primary">Update Post</button>
      </div>

    </form>
      
  </div>

  
  <script src="{{ URL::to('/') }}/js/mypostutils.js">
    // // Auto generate slug
    // const title = document.querySelector('#title');
    // const slug = document.querySelector('#slug');
    // title.addEventListener('change', function(){
    //     fetch('/user-dashboard/posts/checkSlug?title=' + title.value)
    //         .then(response => response.json())
    //         .then(data => slug.value = data.slug)
    // });

    // // Disable file upload for trix editor
    // document.addEventListener('trix-file-accept', function(e){
    //     e.preventDefault();
    // });

    // // Preview Image Upload By User
    // const imageInput = document.getElementById('image');
    // const imagePreview = document.getElementById('file-preview');
    // function previewImageSelected()
    // {
    //   const file = imageInput.files[0];
    //   if(file)
    //   {
    //     const reader = new FileReader();
    //     reader.readAsDataURL(file);
    //     reader.onload = function(e)
    //     {
    //       imagePreview.src = e.target.result;
    //     }
    //   }
    // }

    // // Showing div after user upload a image
    // const show = document.getElementById('showImg');
    // const divStyle = show.style.display;
    // function showDiv()
    // {
    //   if(divStyle == 'none')
    //   {
    //     show.style.display = 'block';
    //   }
    // }

    // imageInput.addEventListener('change', previewImageSelected);
    // imageInput.addEventListener('change', () => {
    //   previewImageSelected();
    //   showDiv();
    // });
  </script>

@endsection
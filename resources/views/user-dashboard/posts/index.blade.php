@extends('user-dashboard.layouts.main')

@section('container')
    
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-2 border-bottom">
    <h1 class="h3">My Posts</h1>
  </div>

  @if (session()->has('success'))
    <div class="alert alert-success alert-dismissible fade show col-lg-8" role="alert">
      <strong>{{ session('success') }}</strong>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  @endif

  <div class="table-responsive col-lg-8">
    <a class="text-decoration-none btn btn-primary btn-sm my-3" href="/user-dashboard/posts/create"><i class="bi bi-file-earmark-font"></i> Create a post</a>
    <table class="table table-striped table-md align-middle">
      <thead>
        <tr>
          <th scope="col">No.</th>
          <th scope="col">Title</th>
          <th scope="col">Category</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>

        @foreach ($posts as $post)
          <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $post->title }}</td>
            <td>{{ $post->category->name }}</td>
            <td>
              <a class="btn btn-primary" href="/user-dashboard/posts/{{ $post->slug }}" data-bs-toggle="tooltip" data-bs-title="Detail"><i class="bi bi-eye"></i></a>
              <a class="btn btn-warning" href="/user-dashboard/posts/{{ $post->slug }}/edit" data-bs-toggle="tooltip" data-bs-title="Edit"><i class="bi bi-pencil-square"></i></a>
              {{-- <form action="/user-dashboard/posts/{{ $post->slug }}" method="POST" class="d-inline">
                @method('DELETE')
                @csrf

                <button type="button" class="btn btn-danger"><i class="bi bi-trash"></i></button>
              </form> --}}

              {{-- Trigger Modal --}}
              <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#staticBackdrop{{ $post->slug }}"><i class="bi bi-trash"></i></button>

              <!-- Modal -->
              <div class="modal fade" id="staticBackdrop{{ $post->slug }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h1 class="modal-title fs-5" id="staticBackdropLabel">Delete Post</h1>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      Are you sure? Want to delete post with title<br> <strong>{{ $post->title }}</strong>
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
            </td>
          </tr>
        @endforeach

      </tbody>
    </table>
  </div>

@endsection

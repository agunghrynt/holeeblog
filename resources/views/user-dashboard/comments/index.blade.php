@extends('user-dashboard.layouts.main')

@section('container')
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-2 border-bottom">
    <h1 class="h3">{{ $isAdmin ? 'All Comments' : 'My Comments' }}</h1>
  </div>

  @if (session()->has('success'))
    <div class="alert alert-success alert-dismissible fade show col-lg-8" role="alert">
      <strong>{{ session('success') }}</strong>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  @endif

  <div class="table-responsive col-lg-8">
    <table class="table table-striped table-md align-middle">
      <thead>
        <tr>
          <th scope="col">No.</th>
          <th scope="col">Title</th>
          <th scope="col">Comment</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>

        @foreach ($comments as $comment)
          <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $comment->post ? $comment->post->title : 'May be post has been delete' }}</td>
            <td>{{ $comment->body }}</td>
            <td class="align-middle col-sm-2 justify-content-center">
              <a class="btn btn-primary" href="{{ $isAdmin ? route('comments.manage.show', $comment) : route('comments.show', $comment) }}" data-bs-toggle="tooltip" data-bs-title="Detail"><i class="bi bi-eye"></i></a>
              @if (!$isAdmin)
                <a class="btn btn-warning" href="{{ route('comments.edit', $comment) }}" data-bs-toggle="tooltip" data-bs-title="Edit"><i class="bi bi-pencil-square"></i></a>
              @endif

              {{-- Trigger Modal --}}
              <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#staticBackdrop{{ $comment->id }}"><i class="bi bi-trash"></i></button>

              <!-- Modal -->
              <div class="modal fade" id="staticBackdrop{{ $comment->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h1 class="modal-title fs-5" id="staticBackdropLabel">Delete Comment</h1>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      Are you sure? Want to delete comment<br> <strong>{{ $comment->body }}</strong>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                      <form action="{{ $isAdmin ? secure_route('comments.manage.destroy', $comment) : secure_route('comments.destroy', $comment) }}" method="POST" class="d-inline">
                        @method('DELETE')
                        @csrf

                        <button type="submit" class="btn btn-danger" >Yes</button>
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

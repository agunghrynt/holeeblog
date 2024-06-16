@extends('layouts.main')

@section('container')

<div class="row justify-content-center">
    <div class="col-lg-4">

      @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          <strong>{{ session('success') }}</strong>
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      @endif

      @if (session()->has('loginError'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
          <strong>{{ session('loginError') }}</strong>
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      @endif

        <main class="form-login">
            <h1 class="h3 mb-3 fw-normal text-center">Please Log in</h1>

            <form action="/login" method="POST">
              @csrf
              {{-- <img class="mb-4" src="../assets/brand/bootstrap-logo.svg" alt="" width="72" height="57"> --}}
          
              <div class="form-floating">
                <input name="email" class="form-control rounded-top @error('email') rounded-bottom is-invalid @enderror" id="email" placeholder="email@example.com" autofocus required>
                <label for="email">Email address</label>
                @error('email')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                @enderror
              </div>
              <div class="form-floating">
                <input name="password" type="password" class="form-control rounded-bottom" id="password" placeholder="Password" required>
                <label for="password">Password</label>
              </div>
              <button name="login-btn" class="btn btn-primary w-100 py-2 mt-3" type="submit">Log in</button>
            </form>

            <small class="d-block text-center mt-3">Not registered? <a href="/register" class="text-decoration-none">Register Now!</a></small>
        </main>
    </div>
</div>

@endsection
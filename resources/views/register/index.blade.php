@extends('layouts.main')

@section('container')

<div class="row justify-content-center">
    <div class="col-lg-5">
        <main class="form-registration">
            <h1 class="h3 mb-3 fw-normal text-center">Registration Form</h1>

            <form action="/register" method="POST">
              @csrf
              {{-- <img class="mb-4" src="../assets/brand/bootstrap-logo.svg" alt="" width="72" height="57"> --}}
              <div class="form-floating">
                <input type="text" name="name" class="form-control rounded-top @error('name') rounded-bottom is-invalid @enderror" id="name" placeholder="Your Name" autofocus required value="{{ old('name') }}">
                <label for="name">Name</label>
                @error('name')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                @enderror
              </div>
              <div class="form-floating">
                <input type="text" name="username" class="form-control @error('username') rounded is-invalid @enderror" id="username" placeholder="Username" required value="{{ old('username') }}">
                <label for="username">Username</label>
                @error('username')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                @enderror
              </div>
              <div class="form-floating">
                <input type="email" name="email" class="form-control @error('email') rounded is-invalid @enderror" id="email" placeholder="name@example.com" required value="{{ old('email') }}">
                <label for="email">Email address</label>
                @error('email')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                @enderror
              </div>
              <div class="form-floating">
                <input type="password" name="password" class="form-control rounded-bottom @error('password') rounded-top is-invalid @enderror" id="password" placeholder="Password" required>
                <label for="password">Password</label>
                @error('password')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                @enderror
              </div>
              <button name="registration-btn" class="btn btn-primary w-100 py-2 mt-3" type="submit">Register</button>
            </form>

            <small class="d-block text-center mt-3">Already registered? <a href="/login" class="text-decoration-none">Login</a></small>
        </main>
    </div>
</div>

@endsection
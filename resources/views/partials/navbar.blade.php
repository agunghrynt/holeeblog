<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container">
    <a class="navbar-brand" href="/">Holee Sheet</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Togglenavigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link {{ Request::is('/home') ? 'active' : '' }}" aria-current="page" href="/home">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ Request::is('posts') ? 'active' : '' }}" href="/posts">Blog</a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ Request::is('categories') ? 'active' : '' }}" href="/categories">Categories</a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ Request::is('contact') ? 'active' : '' }}" href="/contact">Contact</a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ Request::is('project') ? 'active' : '' }}" href="/project">Project</a>
        </li>
      </ul>
      
      <ul class="navbar-nav ms-auto profile-menu">
        @auth
          <ul class="navbar-nav ms-auto profile-menu">
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle p-0" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Welcome, {{ auth()->user()->name }}
                <div class="profile-pic">
                  <img src="{{ URL::to('/') }}/img/person.svg" alt="Profile Pic">
                </div>
              </a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item {{ Request::is('user-dashboard') ? 'active' : '' }}" href="/user-dashboard"><i class="bi bi-pc-display"></i> My Dashboard</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="{{ route('settings.index') }}"><i class="bi bi-person"></i> My Profile</a></li>
                <li><hr class="dropdown-divider"></li>
                <li>
                  <!-- Trigger Modal -->
                  <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#staticBackdropDD"><i class="bi bi-box-arrow-left"></i> Murtad</button>
                </li>
              </ul>
            </li>
          </ul>
        @else
          <li class="nav-item">
            <a class="nav-link {{ Request::is('login') ? 'active' : '' }}" aria-current="page" href="/login"><i class="bi bi-box-arrow-in-right"></i> Login</a>
          </li>
        @endauth
      </ul>
      
    </div>
  </div>
</nav>
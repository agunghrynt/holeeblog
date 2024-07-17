<div class="sidebar col-md-2 col-lg-2 p-0 bg-body-tertiary text-bg-dark">
    <div class="offcanvas-md offcanvas-end bg-body-tertiary vh-100" tabindex="-1" id="sidebarMenu" aria-labelledby="sidebarMenuLabel">
      <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="sidebarMenuLabel">Holee Sheet</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" data-bs-target="#sidebarMenu" aria-label="Close"></button>
      </div>
      <div class="offcanvas-body d-md-flex flex-column p-0 pt-lg-2 overflow-y-auto">
        <ul class="nav flex-column">
          <li class="nav-item align-items-center">
            <a class="nav-link d-flex gap-2 {{ Request::is('user-dashboard') ? 'active' : '' }}" aria-current="page" href="/user-dashboard">
              <i class="bi bi-pc-display"></i> Dashboard</a>
          </li>
          <li class="nav-item align-items-center">
            <a class="nav-link d-flex gap-2 {{ Request::is('user-dashboard/posts*') ? 'active' : '' }}" href="/user-dashboard/posts">
              <i class="bi bi-file-earmark"></i> My Posts</a>
          </li>
          <li class="nav-item align-items-center">
            <a class="nav-link d-flex gap-2 {{ Request::is('comments*') ? 'active' : '' }}" href="{{ route('comments.index') }}">
              <i class="bi bi-chat-right-dots"></i> My Comments</a>
          </li>
        </ul>
        
        @can('mustadmin')
          <ul class="nav flex-column mt-3">
            <div class="d-flex justify-content-center text-black-50 mb-3">
              <h6 class="d-flex justify-content-center m-0">ADMINISTRATOR</h6>
            </div>
            <li class="nav-item align-items-center">
              <a class="nav-link d-flex gap-2 {{ Request::is('user-dashboard/categories*') ? 'active' : '' }}" href="/user-dashboard/categories">
                <i class="bi bi-grid"></i> Manage Categories</a>
            </li>
            <li class="nav-item align-items-center">
              <a class="nav-link d-flex gap-2 {{ Request::is('manage*') ? 'active' : '' }}" href="{{ route('comments.manage') }}">
                <i class="bi bi-chat-square-dots"></i> Manage Comments</a>
            </li>
          </ul>
        @endcan

        <ul class="nav flex-column mt-3">
          <div class="d-flex justify-content-center text-black-50 mb-3">
            <h6 class="d-flex justify-content-center m-0">ACCOUNT SETTINGS</h6>
          </div>
          <li class="nav-item align-items-center">
            <a class="nav-link d-flex gap-2" href="#">
              <i class="bi bi-gear"></i> My Profile</a>
          </li>
          <li class="nav-item align-items-center">
            <div class="align-items-center">
              <!-- Trigger Modal -->
              <button class="nav-link d-flex gap-2" data-bs-toggle="modal" data-bs-target="#staticBackdropSB"><i class="bi bi-box-arrow-left"></i> Murtad</button>
            </div>
          </li>
        </ul>

      </div>
    </div>
</div>
<nav class="navbar navbar-expand-lg main-navbar">
    <form class="form-inline mr-auto">
    </form>
    <ul class="navbar-nav navbar-right">

        <li class="dropdown"><a href="#" data-toggle="dropdown"
                class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                <img alt="" src="{{ asset(auth()->user()->image) }}" class="rounded-circle mr-1">
                <div class="d-sm-none d-lg-inline-block"> {{ auth()->user()->name }} </div>
            </a>
            <div class="dropdown-menu dropdown-menu-right">

                <a href="{{ route('admin.profile') }}" class="dropdown-item has-icon">
                    <i class="far fa-user"></i> Profile
                </a>

                <a href="{{ route('admin.settings.index') }}" class="dropdown-item has-icon">
                    <i class="fas fa-cog"></i> Settings
                </a>
                <div class="dropdown-divider"></div>

                {{-- Implemented Authenticated user logout functionality --}}
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <a href="{{ route('logout') }}" class="dropdown-item has-icon text-danger"
                        onclick="event.preventDefault(); this.closest('form').submit();">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </a>
                </form>
                {{-- Implemented Authenticated user logout functionality End --}}
            </div>
        </li>
    </ul>
</nav>

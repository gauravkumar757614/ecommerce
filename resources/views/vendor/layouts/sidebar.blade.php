<div class="dashboard_sidebar">
    <span class="close_icon">
        <i class="far fa-bars dash_bar"></i>
        <i class="far fa-times dash_close"></i>
    </span>
    <a href="javascript:;" class="dash_logo"><img src="{{ asset(@$logo->logo) }}" alt="logo" class="img-fluid"></a>
    <ul class="dashboard_link">

        <li>
            <a class="{{ setActive(['vendor.dashboard']) }}" href="{{ route('vendor.dashboard') }}">
                <i class="fas fa-tachometer"></i>
                Dashboard
            </a>
        </li>

        <li>
            <a href="{{ url('/') }}">
                <i class="fas fa-tachometer"></i>
                Go To Home
            </a>
        </li>

        <li><a class="{{ setActive(['vendor.messages.index']) }}" href="{{ route('vendor.messages.index') }}">
                <i class="fas fa-tachometer"></i>
                Messages
            </a>
        </li>

        <li>
            <a class="{{ setActive(['vendor.orders.index']) }}" href="{{ route('vendor.orders.index') }}">
                <i class="far fa-user"></i>
                Orders
            </a>
        </li>

        <li>
            <a class="{{ setActive(['vendor.products.index']) }}" href="{{ route('vendor.products.index') }}">
                <i class="far fa-user"></i>
                Products
            </a>
        </li>

        <li>
            <a class="{{ setActive(['vendor.reviews.index']) }}" href="{{ route('vendor.reviews.index') }}">
                <i class="far fa-user"></i>
                Reviews
            </a>
        </li>

        <li>
            <a class="{{ setActive(['vendor.withdraw.index']) }}" href="{{ route('vendor.withdraw.index') }}">
                <i class="far fa-user"></i>
                My withdraw
            </a>
        </li>

        <li>
            <a class="{{ setActive(['vendor.shop-profile.index']) }}" href="{{ route('vendor.shop-profile.index') }}">
                <i class="far fa-user"></i>
                Shop Profile
            </a>
        </li>

        <li>
            <a class="{{ setActive(['vendor.profile']) }}" href="{{ route('vendor.profile') }}">
                <i class="far fa-user"></i>
                My Profile
            </a>
        </li>

        <li>
            {{-- Logout Form  --}}
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <a href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                this.closest('form').submit();"><i
                        class="far fa-sign-out-alt"></i>Log out</a>
            </form>
            {{-- Logout Form  --}}
        </li>
    </ul>
</div>

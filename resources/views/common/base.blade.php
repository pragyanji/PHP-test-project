<nav>
    <div>
        <a href="{{ url('/') }}" class="logo">IMS</a>
        <ul>
            <li><a href="{{ route('products.product_details') }}">Products</a></li>
            <li><a href="{{ route('products.create') }}">Create Product</a></li>

            @auth
                <li><a href="{{ route('sales.index') }}">Sales</a></li>
                <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
            @endauth
        </ul>

        <div class="nav-auth">
            @guest
                <a href="{{ route('login') }}" class="nav-auth-link">Login</a>
                <a href="{{ route('register') }}" class="nav-auth-link nav-auth-register">Register</a>
            @endguest

            @auth
                <div class="nav-user-menu" id="nav-user-menu">
                    <button class="nav-user-button" onclick="document.getElementById('nav-user-menu').classList.toggle('open')">
                        <span class="nav-user-avatar">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</span>
                        <span class="nav-user-name">{{ Auth::user()->name }}</span>
                        <svg width="12" height="12" viewBox="0 0 12 12" fill="none">
                            <path d="M3 5L6 8L9 5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </button>
                    <div class="nav-dropdown">
                        <a href="{{ route('profile.edit') }}">Profile</a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="nav-dropdown-logout">Log Out</button>
                        </form>
                    </div>
                </div>
            @endauth
        </div>
    </div>
</nav>

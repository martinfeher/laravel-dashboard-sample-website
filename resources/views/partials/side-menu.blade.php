<nav>
    <div class="sidenav">
        <ul>
            <li class="nav-item"><a class="nav-link {{ (request()->is('products')) ? 'active' : '' }}" href="/products">Products</a></li>
            <li class="nav-item"><a class="nav-link {{ (request()->is('orders')) ? 'active' : '' }}" href="/orders">Orders</a></li>
            @if (Auth::user()->isAdministrator())
                <li class="nav-item"><a class="nav-link {{ (request()->is('users')) ? 'active' : '' }}" href="/users">Users</a></li>
            @endif
            <li class="nav-item"><a class="nav-link {{ (request()->is('register')) ? 'active' : '' }}" href="/register">Register user</a></li>
        </ul>
    </div>
</nav>

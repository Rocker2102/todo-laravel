<nav class="navbar navbar-expand-lg navbar-light bg-light mx-2">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('app') }}">Todo App</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mobileViewNav"
            aria-controls="mobileViewNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="mobileViewNav">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link {{ Request::routeIs('index') ? 'active' : '' }}" href="{{ route('index') }}">
                        <span class="material-icons left-align">home</span>
                        Home
                    </a>
                </li>

                {{-- passed as auth status from parent --}}
                @if ($status)
                    <li class="nav-item">
                        <a class="nav-link {{ Request::routeIs('profile') ? 'active' : '' }}" href="{{ route('profile', Auth::id()) }}">
                            <span class="material-icons left-align">person</span>
                            Profile
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('logout') }}"><span class="material-icons left-align">logout</span>Logout</a>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link {{ Request::routeIs('login') ? 'active' : '' }}" href="{{ route('login') }}">
                            <span class="material-icons left-align">login</span>
                            Log In
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::routeIs('register') ? 'active' : '' }}" href="{{ route('register') }}">
                            <span class="material-icons left-align">person_add_alt</span>
                            Register
                        </a>
                    </li>
                @endif
            </ul>
            <form id="searchForm" class="d-flex">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-info" type="submit"><span class="material-icons">search</span></button>
            </form>
        </div>
    </div>
</nav>

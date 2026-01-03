<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>TixBus</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Bootstrap 4 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- Navbar Animation CSS -->
    <style>
    /* Hover underline animation */
    /* Default (navbar transparan) */
.navbar-transparent .nav-link,
.navbar-transparent .navbar-brand {
    color: #ffffff !important;
}

/* Hover saat transparan */
.navbar-transparent .nav-link:hover {
    color: #f8f9fa !important;
}

/* Navbar setelah scroll */
.navbar-scrolled .nav-link,
.navbar-scrolled .navbar-brand {
    color: #212529 !important;
}

/* Hover saat scrolled */
.navbar-scrolled .nav-link:hover {
    color: #007bff !important;
}

/* Active menu */
.navbar-nav .nav-link.active {
    color: #007bff !important;
}

.navbar-nav .nav-link {
    position: relative;
    padding-bottom: 5px;
    
}

.navbar-nav .nav-link::after {
    content: "";
    position: absolute;
    left: 50%;
    bottom: 0;
    width: 0;
    height: 2px;
    background-color: #007bff;
    transition: all 0.3s ease;
    transform: translateX(-50%);
}

.navbar-nav .nav-link:hover::after,
.navbar-nav .nav-link.active::after {
    width: 100%;
}

.navbar-nav.mx-auto .nav-item {
    margin: 0 15px;
}
    </style>
</head>

<body>
<div id="app">

    <!-- NAVBAR -->
    <nav id="mainNavbar" class="navbar navbar-expand-md navbar-light fixed-top navbar-transparent">
        <div class="container">
            <a class="navbar-brand font-weight-bold" href="{{ url('/') }}">
                TixBus
            </a>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">

    <!-- LEFT (Brand spacing) -->
    <ul class="navbar-nav mr-auto"></ul>

    <!-- CENTER MENU -->
    <ul class="navbar-nav mx-auto text-center">
        <li class="nav-item">
            <a href="{{ url('/') }}"
               class="nav-link {{ request()->is('/') ? 'active' : '' }}">
                Home
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ url('/about') }}"
               class="nav-link {{ request()->is('about') ? 'active' : '' }}">
                About
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('rides.index') }}"
               class="nav-link {{ request()->is('rides*') ? 'active' : '' }}">
                Tiket Bus
            </a>
        </li>
    </ul>

    <!-- RIGHT -->
    <ul class="navbar-nav ml-auto">
        @guest
            <li class="nav-item">
                <a class="nav-link" href="{{ route('login') }}">Login</a>
            </li>
        @else
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">
                    {{ Auth::user()->name }}
                </a>

                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="{{ route('admin.home') }}">Dashboard</a>
                    <a class="dropdown-item" href="{{ route('logout') }}"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        Logout
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </li>
        @endguest
    </ul>

</div>

    </nav>

    <!-- CONTENT -->
    <main>
        @yield('content')
    </main>
</div>

<!-- JS (URUTAN WAJIB BOOTSTRAP 4) -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.3/js/bootstrap.min.js"></script>

<!-- Navbar Scroll Animation -->
<script>
    window.addEventListener('scroll', function () {
        const navbar = document.getElementById('mainNavbar');
        if (window.scrollY > 50) {
            navbar.classList.add('navbar-scrolled');
        } else {
            navbar.classList.remove('navbar-scrolled');
        }
    });
    
</script>

@yield('scripts')
</body>
</html>

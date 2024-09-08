<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .navbar {
            background-color: #343a40;
        }
        .navbar-brand, .nav-link, .dropdown-item {
            color: #ffffff !important;
        }
        .dropdown-menu {
            background-color: #495057;
        }
        .dropdown-menu .dropdown-item:hover {
            background-color: #6c757d;
        }
        .nav-link.active {
            font-weight: bold;
            background-color: #495057;
            border-radius: 0.25rem;
        }
        .card {
            border: none;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }
        .card-header {
            background-color: #495057;
            color: #ffffff;
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }
    </style>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            <div class="container">
                @auth
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <ul class="nav nav-pills justify-content-start">
                                    @if (Auth::user()->role == 'admin')
                                    <li class="nav-item">
                                        <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">Dashboard</a>
                                    </li>
                                    <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle {{ request()->routeIs('kendaraan.*') ? 'active' : '' }}" data-bs-toggle="dropdown" href="#" role="button"
                                            aria-expanded="false">Kendaraan</a>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="{{ route('kendaraan.index') }}">Data Kendaraan</a></li>
                                            <li><a class="dropdown-item" href="{{ route('kendaraan.create') }}">Tambah Kendaraan</a></li>
                                        </ul>
                                    </li>
                                    <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle {{ request()->routeIs('peminjaman.*') ? 'active' : '' }}" data-bs-toggle="dropdown" href="#" role="button"
                                            aria-expanded="false">Peminjaman Kendaraan</a>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="{{ route('peminjaman.index') }}">Riwayat Peminjaman</a></li>
                                            <li><a class="dropdown-item" href="{{ route('peminjaman.create') }}">Pinjam Kendaraan</a></li>
                                        </ul>
                                    </li>
                                    @else
                                    <li class="nav-item">
                                        <a class="nav-link {{ request()->routeIs('approval-history') ? 'active' : '' }}" href="{{ route('approval-history', ['role' => Auth::user()->role]) }}">Approval History</a>
                                    </li>
                                    @endif
                                </ul>
                            </div>
                            <div class="card-body">
                                <div class="container">
                                    @yield('content')
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endauth
                @guest
                @yield('content')
                @endguest
            </div>
        </main>
    </div>
</body>
</html>

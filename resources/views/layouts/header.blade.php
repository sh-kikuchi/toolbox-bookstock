<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>bookstock</title>

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>

        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">

        <!-- FontAwesome -->
        <link type="text/css" rel="stylesheet" href="{{ mix('css/app.css') }}">
    </head>
    <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #DD8874;">
    <a href="{{ url('/') }}" style="text-decoration: none;">
        <div class="d-flex align-items-center" style="font-size:30px; color: #FCF2DD; font-weight: bold;">bookstock</div>
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
        <ul class="navbar-nav mr-auto">
        </ul>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item active"><a class="nav-link">
                <i class="fas fa-user"></i> {{ Auth::user()->name }}</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('theme.index') }}"><i class="fas fa-home"></i> HOME</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('book.all') }}"><i class="fas fa-list"></i> ALL BOOKS</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                    <i class="fas fa-sign-out-alt"></i> LOGOUT
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </li>
        </ul>
    </div>
    </nav>
    <main class="py-4">
        @yield('content')
    </main>
</body>
</html>

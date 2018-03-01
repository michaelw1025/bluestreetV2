<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('css/jquery-ui.structure.css') }}" rel="stylesheet">
        <link href="{{ asset('css/jquery-ui.theme.css') }}" rel="stylesheet">
        <link href="{{ asset('css/jquery-ui.css') }}" rel="stylesheet">
        <link href="{{ asset('css/welcome-styles.css') }}" rel="stylesheet">

    </head>
    <body class="bg-light">
            <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
                <a class="navbar-brand text-primary ml-md-4" href="{{ url('/') }}">{{ config('app.name', 'Laravel') }}</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <ul class="navbar-nav mr-auto">
                    @if(Auth::check())
                    <li class="nav-item">
                        <a class="nav-link {{ Route::is('home') ? 'active' : '' }}" href="{{ url('home') }}">Home</a>
                    </li>
                    
                    @if(Auth::user()->navigationRoles(['admin']))
                    <li class="nav-item">
                        <a class="nav-link {{ Route::is('admin.*') ? 'active' : '' }}" href="{{ url('admin.index') }}">Admin</a>
                    </li>
                    @endif
                    @endif
                    </ul>

                    <ul class="navbar-nav mr-md-4">
                        @guest
                            <li class="nav-item"><a class="nav-link text-light" href="{{ route('login') }}">Login</a></li>
                            <li class="nav-item"><a class="nav-link text-light" href="{{ route('register') }}">Register</a></li>

                            @else
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</a>
                                    <div class="dropdown-menu" aria-labelledby="dropdown01">
                                        <!-- <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form).submit();">Logout</a> -->
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                            {{ csrf_field() }}
                                            <button type="submit" class="btn btn-link text-danger">Logout</button>
                                        </form>
                                    </div>
                                </li>
                        @endguest
                    </ul>
                    
                </div>
            </nav>

            <main role="main" class="">
                @yield('content')
            </main>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/jquery-ui.js') }}"></script>
    <script src="{{ asset('js/scripts.js') }}"></script>

    </body>
</html>

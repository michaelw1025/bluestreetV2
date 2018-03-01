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
    @include('layouts.main-nav')

            <main role="main" class="">
                @yield('content')
            </main>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/jquery-ui.js') }}"></script>
    <script src="{{ asset('js/scripts.js') }}"></script>

    </body>
</html>

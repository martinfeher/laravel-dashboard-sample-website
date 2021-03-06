<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/libs/bootstrap-4.5.3/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/master.css') }}" rel="stylesheet">
</head>
<body>

    <main class="main" id="top">
        <div class="container" data-layout="container">
            <div class="content">
                @yield('content')
            </div>
        </div>
    </main>

    <script src="{{ asset('assets/libs/jquery/js/jquery-3.5.1.min.js') }}"></script>
    <script src="{{ asset('assets/libs/popper/js/popper.min.js') }}"></script>
    <script src="{{ asset('assets/libs/bootstrap-4.5.3/js/bootstrap.min.js') }}"></script>

    @yield('scripts')

</body>
</html>

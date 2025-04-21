<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>@yield('title', 'Sobat Dagang')</title>
        <link rel="icon" href="{{ asset('img/logo.png') }}" type="image/png">
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    </head>
<body>

        @if (!Auth::check())
        @include('component.navbar.guest')
    @elseif (Auth::check() && Auth::user()->role === 'admin')
        @include('component.navbar.admin')
    @elseif (Auth::check() && Auth::user()->role === 'user')
        @include('component.navbar.user')
    @elseif (Auth::check() && Auth::user()->role === 'guest')
        @include('component.navbar.guest')      
    @endif

    <main>
        @yield('content')
    </main>

    {{-- Footer --}}
    @include('component.footer')

    <!-- Script JS jika ada -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>

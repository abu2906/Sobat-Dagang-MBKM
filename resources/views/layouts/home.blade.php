<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Sobat Dagang')</title>
    <link rel="stylesheet" href="{{ asset('/assets/css/app.css') }}">
    <link rel="icon" href="{{ asset('assets/img/icon/logoIcon.png') }}" type="image/png">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" />

</head>

<body>

    {{-- @if (!Auth::check())
    @include('component.navbar.guest')
    @elseif (Auth::check() && Auth::user()->role === 'admin')
    @include('component.navbar.admin')
    @elseif (Auth::check() && Auth::user()->role === 'user')
    @include('component.navbar.user')
    @elseif (Auth::check() && Auth::user()->role === 'guest')
    @include('component.navbar.guest')
    @endif --}}
    @include('component.navbar.guest')
    <main>
        @yield('content')
    </main>

    @include('component.footer')
    <script src="{{ asset('/assets/js/app.js') }}"></script>
</body>

</html>
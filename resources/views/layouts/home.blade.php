<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>@yield('title', 'Sobat Dagang')</title>
        <link rel="icon" href="{{ asset('img/logoIcon.png') }}" type="image/png">
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="flex flex-col min-h-screen">
        @if (!Auth::check())
            @include('component.navbar.guest')
        @elseif (Auth::check() && Auth::user()->role === 'admin')
            @include('component.navbar.admin')
        @elseif (Auth::check() && Auth::user()->role === 'user')
            @include('component.navbar.user')
        @elseif (Auth::check() && Auth::user()->role === 'guest')
            @include('component.navbar.guest')      
        @endif
    
        <main class="flex-1">
            @yield('content')
        </main>
    
        @include('component.footer')
    </body>
    
</html>

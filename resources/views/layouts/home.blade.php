<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Istok+Web:ital,wght@0,400;0,700;1,400;1,700&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>@yield('title', 'Sobat Dagang')</title>
        <link rel="icon" href="{{ asset('img/logoIcon.png') }}" type="image/png">
<<<<<<< HEAD
        @vite('resources/css/app.css')
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
    @include('component.footer')
    @vite('resources/js/app.js')
    @yield('scripts')
</body>
=======
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
    
>>>>>>> Andif
</html>

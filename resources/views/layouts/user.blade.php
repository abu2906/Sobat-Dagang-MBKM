<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Dashboard' }}</title>
    <link rel="stylesheet" href="{{ asset('/css/app.css') }}">
w

</head>

<body class="min-h-screen flex flex-col bg-gray-100">

    <div class="relative">
        @include('component.navbar.user')

            <!-- Tombol Tab -->
            @yield('tab')

        </div>

    </div>

    {{-- Konten utama --}}
    <main class="flex-grow relative mx-5 md:mx-20 p-6 rounded-lg min-h-[calc(100vh-250px)]">
        @yield('content')
    </main>
    
    @include('component.footer')
    <script src="{{ asset('/assets/js/app.js') }}"></script>

    <!-- @include('component.footer') -->
</body>

</html>

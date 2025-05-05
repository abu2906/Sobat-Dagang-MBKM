<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Dashboard' }}</title>
    <link rel="stylesheet" href="{{ asset('/css/app.css') }}">

</head>

<body class="bg-gray-100">

    <div class="relative">
        @include('component.navbar.user')

        <!-- Tombol Tab -->
        @yield('tab')

    </div>

    </div>

    <main>
        @yield('content')
    </main>

    @include('component.footer')
    <script src="{{ asset('/assets/js/app.js') }}"></script>

</body>

</html>
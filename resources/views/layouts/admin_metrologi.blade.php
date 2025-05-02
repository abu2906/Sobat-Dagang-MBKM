<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Dashboard' }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex flex-col">

    <div class="flex flex-grow min-h-screen">
        {{-- Sidebar --}}
        @include('component.navbar.admin_metrologi')

        {{-- Konten utama --}}
        <div class="flex flex-col flex-grow">
            <main class="flex-grow p-4">
                @yield('content')
            </main>
        </div>
    </div>

</body>
</html>

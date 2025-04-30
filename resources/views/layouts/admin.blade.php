<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Dashboard' }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

    <div class="relative">
        @include('component.navbar.admin')
        <!-- Gambar Background -->
        <div class="h-[150px] w-full bg-cover bg-[center_87%] relative"
            style="background-image: url('/assets/img/background/kepalaDinas_SuperAdmin.png');">

            <!-- Tombol Kembali -->
            <a href="{{ url()->previous() }}"
                class="absolute top-4 left-4 z-10 inline-flex items-center justify-center w-10 h-10 text-white hover:text-gray-300">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </a>


            <!-- Tombol Tab -->
            @yield('tab')

        </div>

    </div>

    {{-- Konten utama --}}
    <main class="relative ml-20 mr-20 p-6 rounded-lg">
        @yield('content')
    </main>

</body>

</html>

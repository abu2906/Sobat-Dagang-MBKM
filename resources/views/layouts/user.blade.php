<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Dashboard' }}</title>
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<<<<<<< HEAD
<body class="bg-gray-100">
=======
<body class="min-h-screen flex flex-col bg-gray-100">

>>>>>>> 1c10773644da8a1f3cc5c2eae76f7a429ef9864f
    <div class="relative">
        @include('component.navbar.user')

        @hasSection('bg-user-metrologi')
            <!-- Gambar Background -->
            <div class="h-[150px] w-full bg-cover bg-[center_87%] relative"
                style="background-image: url('@yield("background")');">

                <!-- Tombol Kembali -->
                <a href="{{ url()->previous() }}"
                    class="absolute z-10 inline-flex items-center justify-center w-10 h-10 text-white top-4 left-4 hover:text-gray-300">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                </a>
            </div>
        @endif

        @yield('tab')
    </div>

    {{-- Konten utama --}}
    <main class="flex-grow relative mx-5 md:mx-20 p-6 rounded-lg min-h-[calc(100vh-250px)]">
        @yield('content')
    </main>

<<<<<<< HEAD
    @include('component.footer')
=======
    @yield('footer')
>>>>>>> 1c10773644da8a1f3cc5c2eae76f7a429ef9864f
    <script src="{{ asset('/assets/js/app.js') }}"></script>
</body>

</html>

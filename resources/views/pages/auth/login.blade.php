<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Masuk- Sobat Dagang</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('/assets/css/app.css') }}">
    <script src="https://cdn.tailwindcss.com"></script>

</head>
<body class="bg-primary font-sans h-screen flex">
    <div class="flex flex-col sm:flex-row w-full h-full">

        <!-- Kiri -->
        <div class="w-full sm:w-1/2 bg-primary text-white flex flex-col justify-center items-center p-8">
            <div class="flex justify-center w-full mt-6 mb-6">
                <img src="{{ asset('image/disdag.png') }}" alt="Logo" class="w-28">
            </div>
        
            <div class="flex flex-col justify-center items-center h-full">
                <h2 class="text-2xl font-bold mb-2 text-center">Selamat Datang Kembali!</h2>
                <p class="text-center mb-4">Satu langkah lagi buat jadi bagian dari kami!</p>
                <a href="{{ route('register') }}"
                class="block text-center w-[150px] text-white font-semibold py-2 -mt-33 rounded-full shadow transition duration-200"
                style="background-color: rgba(33, 148, 243, 1);"
                onmouseover="this.style.backgroundColor='rgba(81, 161, 227, 1)';"
                onmouseout="this.style.backgroundColor='rgba(33, 148, 243, 1)';">
                Daftar
                </a>
            </div>
        </div>

        <!-- Kanan -->
        <div class="w-full sm:w-2/3 bg-white flex flex-col justify-center items-center p-8 
        rounded-[40px] sm:rounded-bl-[40px] sm:rounded-tl-[40px] sm:rounded-tr-none sm:rounded-br-none shadow-xl">
            <h3 class="text-2xl font-bold mb-6 text-center">Masuk Ke Akun Anda</h3>

            <form action="#" method="POST" class="w-full max-w-md space-y-4">
                @csrf

                <!-- Username -->
                <div class="relative w-[300px] mx-auto">
                    <label for="username" class="block font-semibold mb-1">Nama Pengguna (NIK/NIB/NIP)</label>
                    <div class="relative ">
                        <input type="text" id="username" name="username" placeholder="Masukkan Nama Pengguna Anda"
                        class="w-full pl-4 pr-10 py-2 border border-gray-300 rounded-full shadow-sm focus:outline-none focus:ring-2 focus:ring-primary-dark">
                    <i class="fas fa-user absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                    </div>
                </div>

                <!-- Password -->
                <div class="relative w-[300px] mx-auto">
                    <label for="password" class="block font-semibold mb-1">Kata Sandi</label>
                    <div class="relative">
                        <input type="password" id="password" name="password" placeholder="Masukkan Kata Sandi Anda"
                            class="w-full pl-4 pr-10 py-2 border border-gray-300 rounded-full shadow-sm focus:outline-none focus:ring-2 focus:ring-primary-dark">
                        <i class="fas fa-lock absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                    </div>
                </div>

                <div class="relative w-[300px] mx-auto text-right text-sm">
                    <a href="{{ route('forgotpass') }}" class="text-link font-bold hover:underline">Lupa kata sandi?</a>
                </div>

                <div class="relative w-[150px] mx-auto">
                    <button type="submit"
                        class="w-full bg-secondary hover:bg-secondary-dark text-white font-semibold py-2 rounded-full shadow transition duration-200">
                        Masuk
                    </button>
                </div>     
            </form>
        </div>
    </div>

</body>
</html>

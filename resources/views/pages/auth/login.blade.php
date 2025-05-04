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

<body class="flex h-screen font-sans bg-primary">
    <div class="flex flex-col w-full h-full sm:flex-row">

        <!-- Kiri -->
        <div class="flex flex-col items-center justify-center w-full p-8 text-white sm:w-1/2 bg-primary">
            <div class="flex justify-center w-full mt-6 mb-6">
                <img src="{{ asset('/assets/img/icon/logo.png') }}" alt="Logo" class="w-28">
            </div>

            <div class="flex flex-col items-center justify-center h-full">
                <h2 class="mb-2 text-2xl font-bold text-center">Selamat Datang Kembali!</h2>
                <p class="mb-4 text-center">Satu langkah lagi buat jadi bagian dari kami!</p>
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
            <h3 class="mb-6 text-2xl font-bold text-center">Masuk Ke Akun Anda</h3>

            <form action="{{ route('login.submit') }}" method="POST" class="w-full max-w-md space-y-4">
                @csrf

                <!-- Username -->
                <div class="relative w-[300px] mx-auto">
                    <label for="username" class="block mb-1 font-semibold">Nama Pengguna (NIK/NIB/NIP)</label>
                    <div class="relative ">
                        <input type="text" id="username" name="username" placeholder="Masukkan Nama Pengguna Anda"
                            class="w-full py-2 pl-4 pr-10 border border-gray-300 rounded-full shadow-sm focus:outline-none focus:ring-2 focus:ring-primary-dark">
                        <i class="absolute text-gray-400 transform -translate-y-1/2 fas fa-user right-4 top-1/2"></i>
                    </div>
                </div>

                <!-- Password -->
                <div class="relative w-[300px] mx-auto">
                    <label for="password" class="block mb-1 font-semibold">Kata Sandi</label>
                    <div class="relative">
                        <input type="password" id="password" name="password" placeholder="Masukkan Kata Sandi Anda"
                            class="w-full py-2 pl-4 pr-10 border border-gray-300 rounded-full shadow-sm focus:outline-none focus:ring-2 focus:ring-primary-dark">
                        <i class="absolute text-gray-400 transform -translate-y-1/2 fas fa-lock right-4 top-1/2"></i>
                    </div>
                </div>

                <div class="relative w-[300px] mx-auto text-right text-sm">
                    <a href="{{ route('forgot-password') }}" class="font-bold text-link hover:underline">Lupa kata sandi?</a>
                </div>

                <div class="relative w-[150px] mx-auto">
                    <button type="submit"
                        class="w-full py-2 font-semibold text-white transition duration-200 rounded-full shadow bg-secondary hover:bg-secondary-dark">
                        Masuk
                    </button>
                </div>


            </form>
        </div>
    </div>

</body>

</html>
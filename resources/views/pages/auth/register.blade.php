<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar - Sobat Dagang</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('/assets/css/app.css') }}">
</head>
<body class="bg-primary font-sans h-screen flex">
    <div class="flex flex-col sm:flex-row w-full h-full">

 <!-- Kiri-->
        <div class="w-full sm:w-2/3 bg-white p-8 flex flex-col justify-center items-center 
        rounded-[40px] sm:rounded-br-[40px] sm:rounded-tr-[40px] sm:rounded-tl-none sm:rounded-bl-none shadow-xl">

        <h3 class="text-2xl font-bold mb-6 text-center">Daftar ke Akun Anda</h3>

        <form action="#" method="POST" class="w-full max-w-2xl">
            @csrf
        
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-6 gap-y-4">
                <!-- Nama Lengkap -->
                <div>
                    <label class="font-semibold mb-1 block">Nama Lengkap</label>
                    <input type="text" name="nama" placeholder="Masukkan Nama Lengkap Anda"
                        class="w-full px-4 py-2 border border-gray-300 rounded-full shadow-sm focus:ring-2 focus:ring-blue-500">
                </div>
            
                <!-- NIK -->
                <div>
                    <label class="font-semibold mb-1 block">NIK</label>
                    <input type="text" name="nik" placeholder="Masukkan NIK Anda"
                        class="w-full px-4 py-2 border border-gray-300 rounded-full shadow-sm focus:ring-2 focus:ring-blue-500">
                </div>
            
                <!-- Alamat -->
                <div class="sm:col-span-2">
                    <label class="font-semibold mb-1 block">Alamat Lengkap</label>
                    <input type="text" name="alamat" placeholder="Masukkan Alamat Anda"
                        class="w-full px-4 py-2 border border-gray-300 rounded-full shadow-sm focus:ring-2 focus:ring-blue-500">
                </div>
            
                <!-- Jenis Kelamin --> 
                <div class="sm:col-span-2">
                    <label class="font-semibold mb-1 block">Jenis Kelamin</label>
                    <div class="flex gap-6 items-center mt-1">
                        <label class="flex items-center gap-2">
                            <input type="radio" name="gender" value="Laki-laki" class="accent-blue-500">
                            <span>Laki-Laki</span>
                        </label>
                        <label class="flex items-center gap-2">
                            <input type="radio" name="gender" value="Perempuan" class="accent-blue-500">
                            <span>Perempuan</span>
                        </label>
                    </div>
                </div>
            
                <!-- Email -->
                <div>
                    <label class="font-semibold mb-1 block">Email</label>
                    <input type="email" name="email" placeholder="Masukkan Email"
                        class="w-full px-4 py-2 border border-gray-300 rounded-full shadow-sm focus:ring-2 focus:ring-blue-500">
                </div>
            
                <!-- Password -->
                <div>
                    <label class="font-semibold mb-1 block">Kata Sandi</label>
                    <input type="password" name="password" placeholder="Masukkan Kata Sandi"
                        class="w-full px-4 py-2 border border-gray-300 rounded-full shadow-sm focus:ring-2 focus:ring-blue-500">
                </div>
            
                <!-- No HP -->
                <div>
                    <label class="font-semibold mb-1 block">Nomor HP</label>
                    <input type="text" name="hp" placeholder="Masukkan Nomor HP"
                        class="w-full px-4 py-2 border border-gray-300 rounded-full shadow-sm focus:ring-2 focus:ring-blue-500">
                </div>
            
                <!-- Konfirmasi Password -->
                <div>
                    <label class="font-semibold mb-1 block">Konfirmasi Kata Sandi</label>
                    <input type="password" name="password_confirmation" placeholder="Ulangi Kata Sandi"
                        class="w-full px-4 py-2 border border-gray-300 rounded-full shadow-sm focus:ring-2 focus:ring-blue-500">
                </div>
            
                <!-- NIB -->
                <div class="sm:col-span-2">
                    <label class="font-semibold mb-1 block">NIB (Opsional)</label>
                    <input type="text" name="nib" placeholder="Masukkan NIB Anda"
                        class="w-full px-4 py-2 border border-gray-300 rounded-full shadow-sm focus:ring-2 focus:ring-blue-500">
                </div>
            </div>
        
            <!-- Tombol -->
            <div class="w-[150px] mx-auto mt-6">
                <button type="submit"
                    class="w-full bg-secondary hover:bg-secondary-dark text-white font-semibold py-2 rounded-full shadow-md transition">
                    Daftar
                </button>
            </div>
        </form>
        </div>
        <!-- Kanan -->
        <div class="w-full sm:w-1/2 bg-primary text-white flex flex-col justify-center items-center p-8">
            <div class="flex justify-center w-full mt-6 mb-6">
                <img src="{{ asset('image/disdag.png') }}" alt="Logo" class="w-28">
            </div>
        

            <div class="flex flex-col justify-center items-center h-full">
                <h2 class="text-2xl font-bold mb-2 text-center">Selamat Datang Kembali!</h2>
                <p class="text-center mb-4">Masukkan informasi akun Anda untuk melanjutkan!</p>
                <a href="{{ route('login') }}"
                class="block text-center w-[150px] text-white font-semibold py-2 -mt-33 rounded-full shadow transition duration-200"
                style="background-color: rgba(33, 148, 243, 1);"
                onmouseover="this.style.backgroundColor='rgba(81, 161, 227, 1)';"
                onmouseout="this.style.backgroundColor='rgba(33, 148, 243, 1)';">
                Masuk
                </a>
            </div>
        </div>
    </div>

</body>
</html>

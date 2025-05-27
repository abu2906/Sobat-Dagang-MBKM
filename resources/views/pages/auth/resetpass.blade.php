<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Kata Sandi</title>
    <link rel="stylesheet" href="{{ asset('/assets/css/app.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-[#0d3b66] flex items-center justify-center min-h-screen">
    <div class="w-full max-w-md p-8 bg-transparent rounded-lg">
        <div class="flex flex-col items-center mb-8">
            <!-- Logo -->
            <img src="{{ asset('image/disdag.png') }}" alt="Logo Dinas Perdagangan" class="h-12 mb-4">
            <h2 class="text-white text-2xl font-semibold mb-2">Reset Kata Sandi Anda</h2>
            <p class="text-white text-center text-sm">Masukkan Email Anda untuk melakukan reset kata sandi</p>
        </div>

            <div class="max-w-md mx-auto mt-10">
    <form method="POST" action="{{ route('password.update') }}">
        @csrf

        <input type="hidden" name="token" value="{{ $token }}">
        <input type="hidden" name="email" value="{{ $email }}">

        <div class="mb-4">
            <label>Password Baru</label>
            <input type="password" name="password" class="w-full p-2 border rounded" required>
        </div>

        <div class="mb-4">
            <label>Konfirmasi Password</label>
            <input type="password" name="password_confirmation" class="w-full p-2 border rounded" required>
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Reset Password</button>
    </form>
</div>
            {{-- <input type="hidden" name="token" value="#">

            <div class="mb-4">
                <label class="block text-white font-semibold mb-1" for="password">Kata Sandi Baru</label>
                <div class="relative">
                    <input 
                        id="password" 
                        type="password" 
                        name="password" 
                        required 
                        class="w-full px-4 py-2 rounded-full focus:outline-none focus:ring-2 focus:ring-yellow-400"
                        placeholder="Masukkan Kata Sandi Baru">
                    <div class="absolute inset-y-0 right-4 flex items-center">
                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15l9-5-9-5-9 5 9 5z" />
                        </svg>
                    </div>
                </div>
            </div>

            <div class="mb-6">
                <label class="block text-white font-semibold mb-1" for="password_confirmation">Konfirmasi Kata Sandi Baru</label>
                <div class="relative">
                    <input 
                        id="password_confirmation" 
                        type="password" 
                        name="password_confirmation" 
                        required 
                        class="w-full px-4 py-2 rounded-full focus:outline-none focus:ring-2 focus:ring-yellow-400"
                        placeholder="Konfirmasi Kata Sandi">
                    <div class="absolute inset-y-0 right-4 flex items-center">
                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15l9-5-9-5-9 5 9 5z" />
                        </svg>
                    </div>
                </div>
            </div>

            <div class="flex justify-center">
                <button type="submit" class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-6 rounded-full focus:outline-none focus:ring-2 focus:ring-yellow-400">
                    Ubah Kata Sandi
                </button>
            </div> --}}
        </form>
    </div>
</body>
</html>

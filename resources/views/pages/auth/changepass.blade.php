<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Reset Kata Sandi - Sobat Dagang</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="{{ asset('/assets/css/app.css') }}">
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body class="bg-primary min-h-screen flex flex-col justify-center items-center font-sans text-white">

  <!-- Logo -->
  <div class="mb-6">
    <img src="{{ asset('/assets/img/icon/logo.png') }}" alt="Logo Dinas Perdagangan" class="w-32 mx-auto">
  </div>

  <!-- Form Container -->
  <div class="w-full max-w-md bg-primary text-white p-6 flex flex-col items-center">
    <h1 class="text-2xl font-bold mb-2 text-center">Reset Kata Sandi Anda</h1>
    <p class="text-center mb-6 text-sm">Masukkan Email Anda untuk melakukan reset kata sandi</p>

    <form method="POST" action="#" class="w-full mt-5">
      @csrf

      <!-- Kata Sandi Baru -->
      <div class="mb-4 w-full flex justify-center">
        <div class="w-full max-w-[350px]">
          <label for="password" class="block mb-1 font-semibold">Kata Sandi Baru</label>
          <div class="relative">
            <input type="password" id="password" name="password" placeholder="Masukkan Kata Sandi Baru"
              class="w-full pl-4 pr-10 py-2 rounded-full text-black focus:ring-2 focus:ring-blue-400 focus:outline-none">
            <div class="absolute inset-y-0 right-3 flex items-center text-gray-400">
              <i class="fas fa-lock"></i>
            </div>
          </div>
        </div>
      </div>

      <!-- Konfirmasi Kata Sandi -->
      <div class="mb-4 w-full flex justify-center">
        <div class="w-full max-w-[350px]">
          <label for="password_confirmation" class="block mb-1 font-semibold">Konfirmasi Kata Sandi Baru</label>
          <div class="relative">
            <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Konfirmasi Kata Sandi"
              class="w-full pl-4 pr-10 py-2 rounded-full text-black focus:ring-2 focus:ring-blue-400 focus:outline-none">
            <div class="absolute inset-y-0 right-3 flex items-center text-gray-400">
              <i class="fas fa-user-lock"></i>
            </div>
          </div>
        </div>
      </div>

      <!-- Tombol Submit -->
      <div class="mt-6 w-full flex justify-center">
        <button type="submit"
          class="w-[150px] bg-secondary hover:bg-[var(--secondary-dark)] text-white font-semibold py-2 rounded-full transition">
          Ubah Kata Sandi
        </button>
      </div>

    </form>
  </div>

</body>
</html>

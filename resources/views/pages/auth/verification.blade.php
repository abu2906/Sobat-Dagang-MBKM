<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Kode Verifikasi - Sobat Dagang</title>
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

  <!-- Form -->
  <div class="w-full max-w-md bg-primary text-white p-6 flex flex-col items-center">
    <h1 class="text-2xl font-bold mb-2 text-center">Masukkan Kode Verifikasi</h1>
    <p class="text-center mb-6 text-sm">Kode verifikasi telah dikirim melalui Email Anda</p>

    <form action="#" method="POST" class="w-full mt-5">
      @csrf

    <!-- Email Input -->
    <div class="mb-4 w-full flex justify-center">
      <div class="w-full max-w-[350px]">
        <label for="email" class="block mb-1 font-semibold">Kode Verifikasi</label>
        <div class="relative">
          <input type="number" id="kode" name="kode" placeholder="Masukkan Kode Verifikasi Anda"
            class="w-full pl-4 pr-10 py-2 rounded-full text-gray-800 focus:ring-2 focus:ring-blue-400 focus:outline-none">
          <div class="absolute inset-y-0 right-3 flex items-center text-gray-400">
            <i class="fas fa-key"></i>
          </div>
        </div>
      </div>
    </div>

    <!-- Submit Button -->
    <div class="mt-6 w-full flex justify-center">
      <button type="submit"
        class="w-[100px] bg-secondary hover:bg-[var(--secondary-dark)] text-white font-semibold py-2 rounded-full transition">
        Lanjut
      </button>
    </div>


    </form>
  </div>

</body>
</html>

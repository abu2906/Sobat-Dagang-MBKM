<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Lupa Kata Sandi - Sobat Dagang</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="{{ asset('/assets/css/app.css') }}">
<<<<<<< HEAD
  <script src="https://cdn.tailwindcss.com"></script>
=======
>>>>>>> 1c10773644da8a1f3cc5c2eae76f7a429ef9864f
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-primary min-h-screen flex flex-col justify-center items-center font-sans">

  <!-- Logo -->
  <div class="mb-8">
    <img src="{{ asset('/assets/img/icon/logo.png') }}" alt="Logo Dinas Perdagangan" class="w-32 mx-auto">
  </div>

  <!-- Form -->
  <div class="w-full max-w-md bg-primary text-white p-6 flex flex-col items-center">
    <h1 class="text-2xl font-bold mb-2 text-center">Lupa Kata Sandi?</h1>
    <p class="text-center mb-6 text-sm">Masukkan Email Anda untuk melakukan reset kata sandi</p>

    <form action="#" method="POST" class="w-full mt-5">
      @csrf

    <!-- Email Input -->
    <div class="mb-4 w-full flex justify-center">
      <div class="w-full max-w-[350px]">
        <label for="email" class="block mb-1 font-semibold">Email</label>
        <div class="relative">
          <input type="email" id="email" name="email" placeholder="Masukkan Email Anda"
            class="w-full pl-4 pr-10 py-2 rounded-full text-gray-800 focus:ring-2 focus:ring-blue-400 focus:outline-none">
          <div class="absolute inset-y-0 right-3 flex items-center text-gray-400">
            <i class="fas fa-envelope"></i>
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

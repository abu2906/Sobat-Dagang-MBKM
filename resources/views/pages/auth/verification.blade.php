<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Verifikasi - Sobat Dagang</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  
  <link rel="stylesheet" href="{{ asset('/assets/css/app.css') }}">
</head>
<body class="flex flex-col items-center justify-center min-h-screen font-sans text-white bg-primary">

  <div class="mb-6">
    <img src="{{ asset('/assets/img/icon/logo.png') }}" alt="Logo Dinas Perdagangan" class="w-32 mx-auto">
  </div>

  <div class="flex flex-col items-center w-full max-w-md p-6 text-white rounded-lg shadow-lg bg-primary">
    <h1 class="mb-2 text-2xl font-bold text-center">Masukkan Kode Verifikasi</h1>
    
    @if (isset($status))
      <p class="mb-6 text-sm text-center">{{ $status }}</p>
    @endif

    <div class="flex justify-center w-full mt-6">
      <a href="{{ route('login') }}" class="w-[100px] text-center bg-secondary hover:bg-[var(--secondary-dark)] text-white font-semibold py-2 rounded-full transition">
        Login
      </a>
    </div>
  </div>
</body>
</html>
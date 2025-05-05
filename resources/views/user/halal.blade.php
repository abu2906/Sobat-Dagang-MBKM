<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Sertifikasi Halal</title>
  <link rel="stylesheet" href="{{ asset('/assets/css/app.css') }}">
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="flex flex-col min-h-screen bg-white">

  <!-- Header -->
  <header class="bg-[#0d3b66] py-4 px-6 flex items-center justify-between">
    <img src="{{ asset('/assets/img/icon/logo.png') }}" alt="Logo Dinas Perdagangan" class="h-10">
    <div class="flex items-center space-x-4">
      <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405M19 13v-2a7 7 0 10-14 0v2m2 4h10" />
      </svg>
      <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 15c2.21 0 4.314.535 6.121 1.804M15 12a3 3 0 11-6 0 3 3 3 0 016 0z" />
      </svg>
    </div>
  </header>

  <!-- Banner -->
  <div class="relative">
    <img src="{{ asset('image/banner.png') }}" alt="Banner" class="object-cover w-full h-48">
    <div class="absolute top-4 left-4">
      <button onclick="history.back()" class="text-2xl font-bold text-white">←</button>
    </div>

    <!-- Search Bar di tengah -->
    <div class="absolute w-11/12 transform -translate-x-1/2 top-32 left-1/2 md:w-3/4">
      <input
        type="text"
        placeholder="Cari"
        class="w-full px-6 py-2 bg-white rounded-full shadow-md focus:outline-none">
    </div>
  </div>


  <!-- Table -->
  <main class="flex-1 px-6 pb-10 mt-16 overflow-x-auto scrollbar-thin scrollbar-thumb-gray-400 scrollbar-track-transparent">
    <div class="overflow-hidden rounded-b-xl">
      <table class="w-full text-sm table-auto">
        <thead class="bg-[#0d3b66] text-white">
          <tr>
            <th class="px-4 py-3 font-semibold text-left">NOMOR</th>
            <th class="px-4 py-3 font-semibold text-left">NAMA USAHA</th>
            <th class="px-4 py-3 font-semibold text-left">TANGGAL</th>
            <th class="px-4 py-3 font-semibold text-left">ALAMAT</th>
            <th class="px-4 py-3 font-semibold text-left">NO. SERTIFIKASI HALAL</th>
            <th class="px-4 py-3 font-semibold text-left">HYPERLINK</th>
          </tr>
        </thead>
        <tbody>
          @for($i = 1; $i <= 14; $i++)
            <tr class="{{ $i % 2 == 0 ? 'bg-gray-100' : 'bg-white' }}">
            <td class="px-4 py-3">{{ $i }}</td>
            <td class="px-4 py-3">Kios Humairah</td>
            <td class="px-4 py-3">20 April 2025</td>
            <td class="px-4 py-3">Kompleks Pasar Wekke'e</td>
            <td class="px-4 py-3">120100001209{{ 10 + $i }}</td>
            <td class="px-4 py-3">
              <a href="#" class="text-blue-500 hover:underline">Sertifikat Halal</a>
            </td>
            </tr>
            @endfor
        </tbody>
      </table>
    </div>
  </main>

</body>

</html>
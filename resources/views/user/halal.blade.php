<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Sertifikasi Halal</title>
  @vite('resources/css/app.css')
</head>

<body class="bg-white min-h-screen flex flex-col">

  <!-- Header -->
  <header class="bg-[#0d3b66] py-4 px-6 flex items-center justify-between">
    <img src="{{ asset('image/disdag.png') }}" alt="Logo Dinas Perdagangan" class="h-10">
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
    <img src="{{ asset('image/banner.png') }}" alt="Banner" class="w-full h-48 object-cover">
    <div class="absolute top-4 left-4">
      <button onclick="history.back()" class="text-white text-2xl font-bold">←</button>
    </div>
  
    <!-- Search Bar di tengah -->
    <div class="absolute top-32 left-1/2 transform -translate-x-1/2 w-11/12 md:w-3/4">
      <input 
        type="text" 
        placeholder="Cari" 
        class="w-full px-6 py-2 rounded-full bg-white shadow-md focus:outline-none"
      >
    </div>
  </div>
  

  <!-- Table -->
  <main class="flex-1 overflow-x-auto mt-16 px-6 pb-10 scrollbar-thin scrollbar-thumb-gray-400 scrollbar-track-transparent">
    <div class="rounded-b-xl overflow-hidden">
      <table class="w-full table-auto text-sm">
        <thead class="bg-[#0d3b66] text-white">
          <tr>
            <th class="py-3 px-4 text-left font-semibold">NOMOR</th>
            <th class="py-3 px-4 text-left font-semibold">NAMA USAHA</th>
            <th class="py-3 px-4 text-left font-semibold">TANGGAL</th>
            <th class="py-3 px-4 text-left font-semibold">ALAMAT</th>
            <th class="py-3 px-4 text-left font-semibold">NO. SERTIFIKASI HALAL</th>
            <th class="py-3 px-4 text-left font-semibold">HYPERLINK</th>
          </tr>
        </thead>
        <tbody>
          @for($i = 1; $i <= 14; $i++)
          <tr class="{{ $i % 2 == 0 ? 'bg-gray-100' : 'bg-white' }}">
            <td class="py-3 px-4">{{ $i }}</td>
            <td class="py-3 px-4">Kios Humairah</td>
            <td class="py-3 px-4">20 April 2025</td>
            <td class="py-3 px-4">Kompleks Pasar Wekke'e</td>
            <td class="py-3 px-4">120100001209{{ 10 + $i }}</td>
            <td class="py-3 px-4">
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

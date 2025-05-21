@extends('layouts.home')

@section('title', 'Data Sertifikat Halal')

@section('content')

<head>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" />
</head>
<div class="relative w-full h-64">
    <img src="{{ asset('assets\img\background\user_industri.png') }}" alt="Port Background" class="object-cover w-full h-full">
    <a href="{{ route('user.dashboard') }}"
        class="absolute flex items-center justify-center w-12 h-12 text-black transition-all duration-300 transform -translate-y-1/2 rounded-full shadow-lg left-14 top-1/2 bg-white/80 hover:bg-black hover:text-white hover:border-white hover:scale-110">
        <span class="text-2xl material-symbols-outlined">
            arrow_back
        </span>
    </a>
</div>
<body class="flex flex-col min-h-screen bg-white">

    <!-- Search Bar di tengah -->
    <div class="absolute w-11/12 transform -translate-x-1/2 top-32 left-1/2 md:w-3/4">
      <input
        type="text"
        placeholder="Cari"
        class="w-full px-6 py-2 bg-white rounded-full shadow-md focus:outline-none">
    </div>
  </div>


  <!-- Table -->
  <main class="flex-1 px-6 pb-10 mt-16 mb-4 overflow-x-auto scrollbar-thin scrollbar-thumb-gray-400 scrollbar-track-transparent">
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
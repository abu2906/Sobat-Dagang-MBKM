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
      <form action="{{ route('halal.user') }}" method="GET" class="relative">
        <input
          type="text"
          name="keyword"
          value="{{ request('keyword') }}"
          placeholder="Cari"
          class="w-full px-6 py-2 pl-10 bg-white rounded-full shadow-md focus:outline-none">

        <!-- Ikon pencarian -->
        <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 h-5 w-5 text-gray-500" fill="none"
            stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round"
                d="M21 21l-4.35-4.35M11 19a8 8 0 100-16 8 8 0 000 16z"/>
        </svg>
      </form>
    </div>



  <main class="flex-1 px-6 py-10 max-w-7xl mx-auto">
  <div class="overflow-auto shadow rounded-xl border border-gray-200">
    <table class="min-w-full text-sm text-left">
      <thead class="bg-[#0d3b66] text-white">
        <tr>
          <th class="px-4 py-3">NOMOR</th>
          <th class="px-4 py-3">NAMA USAHA</th>
          <th class="px-4 py-3">TANGGAL  TERBIT</th>
          <th class="px-4 py-3">ALAMAT</th>
          <th class="px-4 py-3">NO. SERTIFIKAT HALAL</th>
          <th class="px-4 py-3">HYPERLINK</th>
        </tr>
      </thead>
      <tbody>
        @forelse ($data as $index => $item)
          <tr class="{{ $index % 2 === 0 ? 'bg-gray-100' : 'bg-white' }}">
            <td class="px-4 py-2">{{ $index + 1 }}</td>
            <td class="px-4 py-2">{{ $item->nama_usaha }}</td>
            <td class="px-4 py-2">{{ \Carbon\Carbon::parse($item->tanggal_sah)->format('d M Y') }}</td>
            <td class="px-4 py-2">{{ $item->alamat }}</td>
            <td class="px-4 py-2">{{ $item->no_sertifikasi_halal }}</td>
            <td class="px-4 py-2">
              @if ($item->sertifikat)
                <a href="{{ asset('storage/' . $item->sertifikat) }}" target="_blank" class="text-blue-600 underline">Sertifikat Halal</a>
              @else
                <span class="text-gray-400">Tidak tersedia</span>
              @endif
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="7" class="text-center py-4 text-gray-500">Tidak ada data sertifikat halal.</td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>
</main>


</body>

</html>
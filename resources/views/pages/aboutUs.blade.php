@extends('layouts.home')

@section('title', 'Tentang Kami')

@section('content')
<section class="bg-white">
    <!-- Header -->
    <div class="relative">
        <img src="{{ asset('img/header.jpg') }}" alt="Header" class="w-full h-60 object-cover">
        <div class="absolute inset-0 bg-black bg-opacity-40 flex flex-col justify-center px-6 text-white">
            <h2 class="text-xl font-light">Tentang Kami</h2>
            <h1 class="text-3xl font-bold">Dinas Perdagangan Kota Parepare</h1>
            <p class="text-sm mt-1">Beranda / Tentang Kami</p>
        </div>
    </div>

    <!-- Ringkasan Profil -->
    <div class="p-6 lg:px-16 lg:py-12">
        <div class="flex justify-between items-start">
            <h3 class="text-xl font-semibold text-gray-800 mb-4">Ringkasan Profil</h3>
            <a href="#kontak" class="px-4 py-2 bg-blue-100 text-blue-700 text-sm rounded hover:bg-blue-200">HUBUNGI KAMI</a>
        </div>
        <p class="text-gray-700 text-justify">
            Dinas Perdagangan Kota Parepare merupakan instansi pemerintah daerah yang berfokus pada pengembangan sektor perdagangan...
        </p>
    </div>

    <!-- Apa yang Kami Lakukan -->
    <div class="bg-gray-100 py-10">
        <div class="text-center mb-6">
            <h4 class="text-lg font-semibold text-gray-800">APA YANG KAMI LAKUKAN?</h4>
        </div>
        <div class="flex flex-wrap justify-center gap-6 px-4">
            @php
                $fitur = [
                    ['icon' => '🧾', 'label' => 'Pelayanan Publik'],
                    ['icon' => '🏬', 'label' => 'Revitalisasi Pasar'],
                    ['icon' => '📈', 'label' => 'Pemberdayaan UMKM'],
                    ['icon' => '🛡️', 'label' => 'Perlindungan Konsumen'],
                    ['icon' => '💻', 'label' => 'Digitalisasi Perdagangan'],
                ];
            @endphp
            @foreach ($fitur as $item)
                <div class="flex flex-col items-center bg-white p-4 rounded shadow w-32">
                    <div class="text-3xl mb-2">{{ $item['icon'] }}</div>
                    <span class="text-sm text-center text-gray-700">{{ $item['label'] }}</span>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Prestasi -->
    <div class="py-10 px-6">
        <h4 class="text-center text-lg font-semibold text-gray-800 mb-6">PRESTASI</h4>
        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4 justify-items-center">
            @for ($i = 0; $i < 6; $i++)
                <div class="w-24 h-24 bg-gray-300 rounded-md"></div>
            @endfor
        </div>
    </div>
</section>
@endsection

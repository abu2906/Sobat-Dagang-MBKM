@extends('layouts.home')

@section('title', 'Tentang Kami')

@section('content')
<section class="bg-white">
    <!-- Header -->
    <div class="relative">
        <img src="{{ asset('assets\img\background\header.jpg') }}" alt="Port Background" class="object-cover w-full h-full">
        <div class="absolute inset-0 flex flex-col justify-center px-6 text-white bg-black lg:px-16 bg-opacity-40">
            <h1 class="text-3xl font-bold">Tentang Kami</h1>
            <h1 class="text-3xl font-bold">Dinas Perdagangan</h1>
            <h1 class="font-bold text-3x1">Kota Parepare</h1>
            <p class="mt-1 text-sm">Beranda / Tentang Kami</p>
        </div>
    </div>

    <!-- Ringkasan Profil -->
    <div class="p-6 lg:px-16 lg:py-12">
        <div class="flex items-start justify-between">
            <h3 class="mb-4 text-xl font-semibold text-gray-800">Ringkasan Profil</h3>
            <a href="#kontak" class="px-4 py-2 text-sm text-blue-700 bg-blue-100 rounded hover:bg-blue-200">HUBUNGI KAMI</a>
        </div>
        <p class="text-justify text-gray-700">
            Dinas Perdagangan Kota Parepare merupakan instansi pemerintah daerah yang berfokus pada pengembangan sektor perdagangan di wilayah Parepare. Kami memiliki peran penting dalam menciptakan iklim usaha yang sehat, meningkatkan daya saing pelaku usaha, serta menjaga stabilitas harga dan ketersediaan barang kebutuhan masyarakat. Dengan mengedepankan pelayanan publik yang transparan, cepat, dan akuntabel.
        </p>
        <p class="mt-4 text-justify text-gray-700">
            Dinas Perdagangan berkomitmen untuk mendukung pertumbuhan ekonomi daerah melalui berbagai program seperti pengembangan pasar rakyat, perlindungan konsumen, pengawasan barang beredar, serta fasilitasi promosi perdagangan. Melalui inovasi dan kolaborasi, kami bertekad untuk menjadi mitra strategis bagi pelaku usaha lokal dan nasional, menciptakan Parepare sebagai kota perdagangan yang maju, dinamis, dan berdaya saing tinggi di tingkat regional maupun nasional.
        </p>
    </div>

    <!-- Apa yang Kami Lakukan -->
    <div class="py-10 bg-gray-100">
        <div class="mb-6 text-center">
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
            <div class="flex flex-col items-center w-32 p-4 bg-white rounded shadow">
                <div class="mb-2 text-3xl">{{ $item['icon'] }}</div>
                <span class="text-sm text-center text-gray-700">{{ $item['label'] }}</span>
            </div>
            @endforeach
        </div>
    </div>

    <!-- Prestasi -->
    <div class="px-6 py-10">
        <h4 class="mb-6 text-lg font-semibold text-center text-gray-800">PRESTASI</h4>
        <div class="grid max-w-5xl grid-cols-1 gap-6 mx-auto sm:grid-cols-2 lg:grid-cols-3 justify-items-center">
            @for ($i = 0; $i < 6; $i++)
                <div class="w-32 h-32 bg-gray-300 rounded-md">
        </div>
        @endfor
    </div>
    </div>

</section>
@endsection
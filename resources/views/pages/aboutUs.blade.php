@extends('layouts.home')

@section('title', 'Tentang Kami')

@section('content')
<section class="bg-white">
    <!-- Header -->
    <div class="relative">
        <img src="{{ asset('img/header.jpg') }}" alt="Header" class="w-full h-60 object-cover">
        <div class="lg:px-16 absolute inset-0 bg-black bg-opacity-40 flex flex-col justify-center px-6 text-white">
            <h1 class="text-3xl font-bold">Tentang Kami</h1>
            <h1 class="text-3xl font-bold">Dinas Perdagangan</h1>
            <h1 class="text-3x1 font-bold">Kota Parepare</h1>
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
            Dinas Perdagangan Kota Parepare merupakan instansi pemerintah daerah yang berfokus pada pengembangan sektor perdagangan di wilayah Parepare. Kami memiliki peran penting dalam menciptakan iklim usaha yang sehat, meningkatkan daya saing pelaku usaha, serta menjaga stabilitas harga dan ketersediaan barang kebutuhan masyarakat. Dengan mengedepankan pelayanan publik yang transparan, cepat, dan akuntabel. 
        </p>
        <p class="mt-4 text-gray-700 text-justify">
            Dinas Perdagangan berkomitmen untuk mendukung pertumbuhan ekonomi daerah melalui berbagai program seperti pengembangan pasar rakyat, perlindungan konsumen, pengawasan barang beredar, serta fasilitasi promosi perdagangan. Melalui inovasi dan kolaborasi, kami bertekad untuk menjadi mitra strategis bagi pelaku usaha lokal dan nasional, menciptakan Parepare sebagai kota perdagangan yang maju, dinamis, dan berdaya saing tinggi di tingkat regional maupun nasional.
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
        <div class="max-w-5xl mx-auto grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 justify-items-center">
            @for ($i = 0; $i < 6; $i++)
                <div class="w-32 h-32 bg-gray-300 rounded-md"></div>
            @endfor
        </div>
    </div>

</section>
@endsection

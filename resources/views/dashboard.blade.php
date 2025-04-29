@extends('layouts.home')

@section('title', 'Dashboard')

@section('content')

<div class="relative w-full overflow-visible pb-12">
    <div class="absolute top-0 right-0 w-[60%] h-[540px] bg-cover bg-center shadow-lg rounded-tl-3xl rounded-bl-3xl z-0" style="background-image: url('{{ asset('img/dashboard.jpg') }}');"></div>
    <div class="relative z-10 pt-24 pl-8 pr-8">
        <div class="bg-white rounded-xl shadow-md p-6 max-w-md border-l-8 border-b-8 ml-[100px]" style="border-color: #083358;">
            <h2 class="text-2xl font-bold text-gray-800 mb-3">Halo, Sobat Dagang!</h2>
            <p class="text-gray-600 text-medium leading-relaxed">
                Terima kasih telah mengakses 
                sistem informasi Dinas Perdagangan Kota Parepare.
                Melalui platform ini, kami hadir untuk 
                mendekatkan pelayanan publik kepada masyarakat
                dengan informasi yang mudah diakses dan transparan.
            </p>
        </div>
    </div>

    <div class="bg-[#083358] text-white px-6 md:px-16 py-4 mt-[150px] z-10 shadow-lg"> 
        <div class="flex items-center justify-between">
            <h3 class="text-lg md:text-2xl font-bold">Berita Terkini</h3>
            <a href="{{ route('berita.utama', ['id' => 1]) }}" class="text-sm underline hover:text-gray-300 transition"></a>
        </div>
    </div>
    <div class="px-6 md:px-16 py-8 relative overflow-visible">
        <div class="flex overflow-x-auto gap-8 scrollbar-hide relative overflow-visible" style="scroll-snap-type: x mandatory;">        
            @foreach ($beritas as $berita)
                <a href="{{ route('berita.utama', $berita->id) }}" 
                    class="flex-none w-72 bg-white rounded-2xl shadow-md transform transition-all duration-500 ease-in-out hover:-translate-y-2 hover:shadow-glow snap-start min-w-0 relative group z-0 group-hover:z-10 overflow-hidden">
                
                    <div class="overflow-hidden rounded-2xl">
                        <img src="{{ $berita->gambar }}" alt="{{ $berita->judul }}" 
                        class="w-full h-72 object-cover rounded-2xl transition-transform duration-500 ease-in-out group-hover:scale-110    ">
                    </div>

                    <div class="absolute top-3 left-3 text-xs font-semibold text-white">
                        {{ \Carbon\Carbon::parse($berita->created_at)->translatedFormat('l, d M Y') }}
                    </div>

                    <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/80 to-transparent p-4 rounded-b-2xl">
                        <h4 class="text-white text-base font-extrabold leading-tight group-hover:tracking-wider transition-all duration-500 ease-in-out">
                            {{ $berita->judul }}
                        </h4>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
    <div class="bg-[#083358] text-white px-6 md:px-16 py-4 mt-10 z-10 shadow-lg"> 
        <div class="flex items-center justify-center">
            <h3 class="text-lg md:text-2xl font-bold justify-center">Harga Pasar Terkini</h3>
        </div>
    </div>
    <div class="max-w-6xl mx-auto py-10 px-4">
        <div class="grid grid-cols-2 sm:grid-cols-5 gap-6">
            @php
                $items = [
                    ['name' => 'Beras', 'image' => 'beras.png', 'route' => 'harga-pasar.beras'],
                    ['name' => 'Cabe', 'image' => 'cabe.png', 'route' => 'harga-pasar.cabe'],
                    ['name' => 'Ayam', 'image' => 'ayam.png', 'route' => 'harga-pasar.ayam'],
                    ['name' => 'Bawang', 'image' => 'bawang.png', 'route' => 'harga-pasar.bawang'],
                    ['name' => 'Telur', 'image' => 'telur.png', 'route' => 'harga-pasar.telur'],
                    ['name' => 'Daging', 'image' => 'daging.png', 'route' => 'harga-pasar.daging'],
                    ['name' => 'Ikan', 'image' => 'ikan.png', 'route' => 'harga-pasar.ikan'],
                    ['name' => 'Tahu', 'image' => 'tahu.png', 'route' => 'harga-pasar.tahu'],
                    ['name' => 'Tempe', 'image' => 'tempe.png', 'route' => 'harga-pasar.tempe'],
                    ['name' => 'Tomat', 'image' => 'tomat.png', 'route' => 'harga-pasar.tomat'],
                ];
            @endphp
    
            @foreach ($items as $item)
            {{-- {{ route($item['route']) }} --}}
            <a href=""
            class="border-2 border-[#083358] rounded-xl p-4 flex flex-col items-center bg-white shadow-sm
                   hover:bg-indigo-50 hover:shadow-lg hover:scale-105 transition-all duration-300 ease-in-out transform">         
                <img src="{{ asset('img/hargaPasar/' . $item['image']) }}" alt="{{ $item['name'] }}" class="w-16 h-16 object-contain">
                <p class="mt-3 font-semibold text-sm">{{ $item['name'] }}</p>
            </a>
            @endforeach
        </div>
    </div>
    
</div>

<!-- Custom Styling -->
<style>
    /* Hilangkan scrollbar */
    .scrollbar-hide::-webkit-scrollbar {
        display: none;
    }
    .scrollbar-hide {
        -ms-overflow-style: none;
        scrollbar-width: none;
    }

    /* Glow Effect */
    .hover\:shadow-glow:hover {
        box-shadow: 0 8px 20px rgba(8, 51, 88, 0.5), 0 0 20px rgba(8, 51, 88, 0.3);
    }
</style>

@endsection

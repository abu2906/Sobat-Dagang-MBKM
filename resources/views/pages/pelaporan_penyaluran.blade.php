@extends('layouts.home')

@section('content')

<head>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<div class="relative w-full h-64">
    <img src="{{ asset('img/bgPelaporan.png') }}" alt="Background" class="w-full h-full object-cover" />
</div>
<div class="relative -mt-8 z-10 flex justify-center">
    <div class="bg-white/70 text-[#083358] text-center font-semibold text-sm md:text-xl py-2 px-8 rounded-full shadow-md backdrop-blur-sm">
        PELAPORAN PENYALURAN PUPUK BERSUBSIDI
    </div>
</div>
<div class="flex flex-col items-center justify-center min-h-[70vh] px-4 text-center">
    <img src="{{ asset('img/tanda_seru_circle.png') }}" class="w-20 h-20 mb-4" alt="Tanda Seru" />
    <h2 class="text-lg md:text-2xl font-bold text-[#083358] mb-3">
        ANDA BELUM TERDAFTAR SEBAGAI DISTRIBUTOR.<br> 
        LAKUKAN PENDAFTARAN UNTUK MENGAKSES PELAPORAN PENYALURAN PUPUK BERSUBSIDI
    </h2>
    <a href=""
       class="inline-block bg-[#083358] text-white px-6 py-3 rounded-full font-semibold shadow hover:bg-blue-100 hover:text-black transition-all duration-300">
        Daftar Sekarang
    </a>
</div>


@endsection
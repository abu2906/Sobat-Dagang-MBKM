@extends('layouts.user')

@section('tab')
<section class="bg-white py-12 px-4">
    <div class="max-w-7xl mx-auto grid md:grid-cols-2 gap-8 items-center">
        
        <!-- Teks Sambutan -->
        <div>
            <h1 class="text-3xl font-bold text-[#2E3C51] mb-4">
                Selamat datang di Sobat Dagang Kota Parepare
            </h1>
            <p class="text-base text-[#6B7280] leading-relaxed max-w-md">
                Kami siap melayani Anda dalam Pengurusan Perizinan, Pelaporan, dan fasilitas perdagangan lainnya secara mudah dan cepat
            </p>
        </div>

        <!-- Ilustrasi -->
        <div class="flex justify-center md:justify-end">
            <img src="{{ asset('image/ilustrasi-checklist.png') }}" alt="Ilustrasi Formulir" class="w-72 md:w-80">
        </div>

    </div>
</section>

@endsection

@section('content')
<div class="container mx-auto px-4 py-10 grid md:grid-cols-2 lg:grid-cols-3 gap-6">
    <div class="bg-white rounded-md shadow-md p-6 text-center hover:shadow-lg transition">
        <i class="fas fa-store text-4xl mb-4"></i>
        <h3 class="text-lg font-bold mb-2">IZIN USAHA TOKO</h3>
        <p class="text-sm text-gray-600">Fitur untuk pelaku usaha melaporkan kegiatan usahanya secara rutin</p>
    </div>
    <div class="bg-white rounded-md shadow-md p-6 text-center hover:shadow-lg transition">
        <i class="fas fa-chart-bar text-4xl mb-4"></i>
        <h3 class="text-lg font-bold mb-2">LAPORAN</h3>
        <p class="text-sm text-gray-600">Fitur untuk pelaku usaha melaporkan kegiatan usahanya secara rutin</p>
    </div>
    <div class="bg-white rounded-md shadow-md p-6 text-center hover:shadow-lg transition">
        <i class="fas fa-user-lock text-4xl mb-4"></i>
        <h3 class="text-lg font-bold mb-2">IZIN USAHA TOKO</h3>
        <p class="text-sm text-gray-600">Fitur untuk pelaku usaha melaporkan kegiatan usahanya secara rutin</p>
    </div>
</div>
@endsection

@extends('layouts.admin')

@section('content')
<section class="px-4 py-12 bg-white">
    <div class="grid items-center gap-8 mx-auto max-w-7xl md:grid-cols-2">
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
            <img src="{{ asset('assets\img\icon\ilustrasi-checklist.png') }}" alt="Ilustrasi Formulir" class="w-72 md:w-80">
        </div>
    </div>
</section>
<div class="p-6 bg-gray-100 min-h-screen">
    <div class="flex justify-center mt-10 space-x-20">
        <div class="relative group w-[300px]">
            <button class="bg-[#ABBED1] w-full px-8 py-3 rounded shadow font-bold">PERDAGANGAN</button>

            <!-- Submenu -->
            <div class="absolute left-0 w-full hidden group-hover:block bg-[#CAE2F6] shadow-lg rounded overflow-hidden">
                <a href="{{ route('bidangPerdagangan.formPermohonan') }}" class="block px-6 py-2 font-semibold text-[#083458] text-center hover:bg-[#98c4e9] rounded-t">Permohonan perizinan/
                    non perizinan</a>
            </div>
        </div>
        <div class="relative group w-[300px]">
            <button class="bg-[#ABBED1] w-full px-8 py-3 rounded shadow font-bold">INDUSTRI</button>

            <!-- Submenu -->
            <div class="absolute left-0 w-full hidden group-hover:block bg-[#CAE2F6] shadow-lg rounded overflow-hidden">
                <a href="#" class="block px-6 py-2 font-semibold text-[#083458] text-center hover:bg-[#98c4e9] rounded-t">Surat Permohonan</a>
                <a href="#" class="block px-6 py-2 font-semibold text-[#083458] text-center hover:bg-[#98c4e9] rounded-b">Data Sertifikat Halal</a>
            </div>
        </div>
        <div class="relative group w-[300px]">
            <button class="bg-[#ABBED1] w-full px-8 py-3 rounded shadow font-bold">METROLOGI</button>

            <!-- Submenu -->
            <div class="absolute left-0 w-full hidden group-hover:block bg-[#CAE2F6] shadow-lg rounded overflow-hidden">
                <a href="{{ route('administrasi-metrologi') }}" class="block px-6 py-2 font-semibold text-[#083458] text-center hover:bg-[#98c4e9] rounded-t">Permohonan Tera/Tera Ulang</a>
                <a href="{{ route('directory-metrologi') }}" class="block px-6 py-2 font-semibold text-[#083458] text-center hover:bg-[#98c4e9] rounded-b">Alat Ukur Valid</a>
            </div>            
        </div>
    </div>
</div>
@endsection 
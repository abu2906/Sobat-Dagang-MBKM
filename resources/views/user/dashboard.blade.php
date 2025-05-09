@extends('layouts.user')

@section('tab')

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

<!-- Tombol utama -->
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
            <a href="#" class="block px-6 py-2 font-semibold text-[#083458] text-center hover:bg-[#98c4e9] rounded-t">Surat Permohonan</a>
            <a href="#" class="block px-6 py-2 font-semibold text-[#083458] text-center hover:bg-[#98c4e9]">Regulasi</a>
            <a href="#" class="block px-6 py-2 font-semibold text-[#083458] text-center hover:bg-[#98c4e9] rounded-b">Direktory Book</a>
        </div>
    </div>
</div>

<div class="flex justify-center mb-10 space-x-20 mt-7">
    <!-- Kartu 1 -->
    <div class="w-[300px] bg-white p-8 rounded-lg border border-gray-300 shadow-[0_8px_20px_rgba(8,52,88,0.2)] text-center">
        <div class="flex justify-center mb-4 text-black">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-14 h-14">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
            </svg>
        </div>

        <h3 class="mb-2 text-xl font-bold">IZIN USAHA TOKO</h3>
        <p class="text-base text-black">Fitur untuk pelaku usaha melaporkan kegiatan usahanya secara rutin</p>
    </div>


    <!-- Kartu 2 -->
    <div class="w-[300px] bg-white p-8 rounded-lg border border-gray-300 shadow-[0_8px_20px_rgba(8,52,88,0.2)] text-center">
        <div class="flex justify-center mb-4 text-black">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-14 h-14">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 0 1 3 19.875v-6.75ZM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V8.625ZM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V4.125Z" />
            </svg>
        </div>

        <h3 class="mb-2 text-xl font-bold">LAPORAN</h3>
        <p class="text-base text-black">Fitur untuk pelaku usaha melaporkan kegiatan usahanya secara rutin</p>
    </div>


    <!-- Kartu 3 -->
    <div class="w-[300px] bg-white p-8 rounded-lg border border-gray-300 shadow-[0_8px_20px_rgba(8,52,88,0.2)] text-center">
        <div class="flex justify-center mb-4 text-black">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-14 h-14">
                <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 21v-7.5a.75.75 0 0 1 .75-.75h3a.75.75 0 0 1 .75.75V21m-4.5 0H2.36m11.14 0H18m0 0h3.64m-1.39 0V9.349M3.75 21V9.349m0 0a3.001 3.001 0 0 0 3.75-.615A2.993 2.993 0 0 0 9.75 9.75c.896 0 1.7-.393 2.25-1.016a2.993 2.993 0 0 0 2.25 1.016c.896 0 1.7-.393 2.25-1.015a3.001 3.001 0 0 0 3.75.614m-16.5 0a3.004 3.004 0 0 1-.621-4.72l1.189-1.19A1.5 1.5 0 0 1 5.378 3h13.243a1.5 1.5 0 0 1 1.06.44l1.19 1.189a3 3 0 0 1-.621 4.72M6.75 18h3.75a.75.75 0 0 0 .75-.75V13.5a.75.75 0 0 0-.75-.75H6.75a.75.75 0 0 0-.75.75v3.75c0 .414.336.75.75.75Z" />
            </svg>
        </div>

        <h3 class="mb-2 text-xl font-bold">IZIN USAHA TOKO</h3>
        <p class="text-base text-black">Fitur untuk pelaku usaha melaporkan kegiatan usahanya secara rutin</p>
    </div>

</div>

@endsection

@section('footer')
@include('component.footer')
@endsection
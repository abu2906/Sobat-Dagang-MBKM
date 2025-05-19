@extends('layouts.home')
@section('title', 'Verifikasi Pengajuan')
@section('content')
<head>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" />
</head>
<div class="relative w-full h-64">
    <img src="{{ asset('assets\img\background\perdagangan.jpg') }}" alt="Port Background" class="object-cover w-full h-full">
    <div class="absolute bottom-0 transform -translate-x-1/2 translate-y-1/2 left-1/2">
        <p class="px-6 py-3 font-bold text-[#083358] bg-white shadow-md text-md font-istok rounded-3xl shadow-black/40">
            PELAPORAN PENYALURAN PUPUK BERSUBSIDI
        </p>
    </div>
</div>
<div class="flex items-center justify-center min-h-screen bg-white px-4">
    <div class="bg-white border border-gray-300 shadow-lg rounded-xl p-10 text-center w-full max-w-md md:max-w-lg">
        <img src="{{ asset('assets/img/icon/tanda_seru_circle.png') }}" alt="Tanda Seru" class="mx-auto mb-6 w-24 h-24" />
        <p class="text-xl md:text-2xl font-semibold text-[#083358] leading-snug">
            DOKUMEN ANDA SEDANG<br />DIVERIFIKASI
        </p>
    </div>
</div>
@endsection
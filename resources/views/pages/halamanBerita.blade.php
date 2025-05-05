@extends('layouts.home')

@section('title', $berita->judul)

@section('content')

<div class="container mx-auto py-12 px-4">
    <div class="max-w-4xl mx-auto bg-white p-8 rounded-2xl shadow-lg">
        
        <!-- Tombol Kembali -->
        <a href="{{ route('Home') }}" class="text-sm text-blue-500 hover:text-blue-700 mb-6 inline-block">
            <i class="fas fa-arrow-left mr-2"></i> Kembali ke Halaman Utama
        </a>
        
        <!-- Judul -->
        <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-2">{{ $berita->judul }}</h1>
        
        <!-- Tanggal -->
        <p class="text-sm text-gray-500 mb-6">
            {{ \Carbon\Carbon::parse($berita->created_at)->translatedFormat('l, d M Y') }}
        </p>

        <!-- Gambar -->
        <div class="overflow-hidden rounded-lg mb-8">
            <img src="{{ $berita->gambar }}" alt="{{ $berita->judul }}" class="w-full h-[400px] object-cover">
        </div>

        <!-- Isi Berita -->
        <div class="text-gray-700 leading-relaxed text-lg">
            {!! nl2br(e($berita->isi)) !!}
        </div>

    </div>
</div>

@endsection

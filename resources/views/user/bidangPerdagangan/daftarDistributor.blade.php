@extends('layouts.home')

@section('title', 'Daftar Distributor')

@section('content')
<div class="relative w-full h-64">
    <img src="{{ asset('assets/img/background/admin_perdagangan.png') }}" alt="Background Perdagangan"
        class="object-cover w-full h-full">

    <a href="{{ url()->previous() }}"
        class="absolute left-14 top-1/2 -translate-y-1/2 w-12 h-12 flex items-center justify-center rounded-full shadow-lg bg-white/80 text-black hover:bg-black hover:text-white hover:scale-110 transition-all duration-300">
        <span class="text-2xl material-symbols-outlined">arrow_back</span>
    </a>
</div>

<div class="min-h-screen flex items-center justify-center bg-gray-100 px-4 py-10">
    <div class="bg-white rounded-[30px] shadow-xl border border-gray-200 w-full max-w-md p-8 text-center">
        <h2 class="text-lg font-semibold mb-6">FORM PERMOHONAN DISTRIBUTOR</h2>

        <form action="{{ route('bidangPerdagangan.submitDistributor') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-6 text-left">
                <label for="dokumen_nib" class="block font-medium mb-2">Tambahkan Dokumen NIB</label>
                <input type="file" name="dokumen_nib" id="dokumen_nib" accept=".pdf"
                    class="block w-full border border-gray-400 text-sm rounded-full px-4 py-2 text-gray-700 file:bg-transparent file:border-0 file:mr-2 file:cursor-pointer" />
            </div>

            <div class="mb-6 text-left text-sm">
                <span class="font-semibold">Note :</span>
                <ul class="list-disc list-inside">
                    <li>Dokumen NIB anda akan diverifikasi oleh Dinas Perdagangan</li>
                </ul>
            </div>

            <div class="flex justify-center space-x-4">
                <button type="submit" name="action" value="draft"
                    class="bg-[#083358] hover:bg-blue-300 text-white hover:text-black px-6 py-2 rounded-full shadow-md transition-all">
                    Draft
                </button>
                <button type="submit" name="action" value="ajukan"
                    class="bg-[#083358] hover:bg-blue-300 text-white hover:text-black px-6 py-2 rounded-full shadow-md transition-all">
                    Ajukan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
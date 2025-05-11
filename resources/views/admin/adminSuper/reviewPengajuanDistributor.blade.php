@extends('layouts.admin')
@section('title', 'Review Pengajuan')
@section('fullwidth')
@endsection

@section('content')

<div class="relative w-full h-60">
    <img src="{{ asset('assets/img/background/admin_perdagangan.png') }}" alt="Port Background" class="object-cover w-full h-full">
    <div class="absolute bottom-0 -left-4 w-full h-60 -z-10">
        <img src="{{ asset('assets/img/background/admin_perdagangan.png') }}"
             alt="Background"
             class="object-cover w-full h-full -ml-16">
</div>


<div class="max-w-6xl mx-auto px-4 mb-12 my-6">
<h2 class="text-2xl font-bold text-[#083358] mb-4 text-center">Daftar Pengajuan Distributor</h2>

<div class="overflow-x-auto bg-white rounded-lg shadow">
    <table class="min-w-full text-sm text-left text-gray-700">
        <thead class="bg-[#083358] text-white">
            <tr>
                <th class="px-6 py-3">No</th>
                <th class="px-6 py-3">Nama Distributor</th>
                <th class="px-6 py-3">Dokumen NIB</th>
                <th class="px-6 py-3">Status</th>
                <th class="px-6 py-3">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($distributor as $index => $itemDistributor)
                <tr>
                    <td class="px-6 py-3">{{ $index + 1 }}</td>
                    <td class="px-6 py-3">{{ $itemDistributor->nama_distributor }}</td>
                    <td class="px-6 py-3">
                        <a href="{{ asset('storage/' . $itemDistributor->dokumen_nib) }}" target="_blank" class="text-blue-500">Lihat Dokumen</a>
                    </td>
                    <td class="px-6 py-3">
                        <span class="inline-block py-1 px-3 rounded-full 
                            @if($itemDistributor->status == 'Menunggu')
                                bg-yellow-500 text-yellow-800
                            @elseif($itemDistributor->status == 'Disetujui')
                                bg-green-600 text-white
                            @else
                                bg-red-600 text-white
                            @endif
                        ">
                            {{ $itemDistributor->status }}
                        </span>
                    </td>
                    <td class="px-6 py-3">
                        <button class="bg-green-600 hover:bg-green-700 text-white px-3 py-1 rounded text-xs font-semibold">
                            Terima
                        </button>
                        <button class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded text-xs font-semibold">
                            Tunda
                        </button>
                        <button class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded text-xs font-semibold">
                            Tolak
                        </button>
                    </td>
                </tr>
            @endforeach
        </tbody>

    </table>
</div>
</div>
@endsection

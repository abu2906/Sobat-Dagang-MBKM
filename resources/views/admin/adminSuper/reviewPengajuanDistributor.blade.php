@extends('layouts.admin')
@section('title', 'Review Pengajuan')
@section('fullwidth')
@endsection

@section('content')

<div class="relative w-full h-60">
    <img src="{{ asset('assets/img/background/admin_perdagangan.png') }}" alt="Port Background" class="object-cover w-full h-full">
    <div class="absolute bottom-0 w-full -left-4 h-60 -z-10">
        <img src="{{ asset('assets/img/background/admin_perdagangan.png') }}"
             alt="Background"
             class="object-cover w-full h-full -ml-16">
</div>


<div class="max-w-6xl px-4 mx-auto my-6 mb-12">
<h2 class="text-2xl font-bold text-[#083358] mb-4 text-center">Daftar Pengajuan Distributor</h2>

<div class="overflow-x-auto bg-white rounded-lg shadow">
    <table class="min-w-full text-sm text-left text-gray-700">
        <thead class="bg-[#083358] text-white">
            <tr>
                <th class="px-6 py-3 text-center">No</th>
                <th class="px-6 py-3 text-center">Nama Distributor</th>
                <th class="px-6 py-3 text-center">Dokumen NIB</th>
                <th class="px-6 py-3 text-center">Status</th>
                <th class="px-6 py-3 text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
    @foreach($distributor as $index => $itemDistributor)
        <tr>
            <td class="px-6 py-3 text-center">{{ $index + 1 }}</td>
            <td class="px-6 py-3 text-center ">{{ $itemDistributor->user->nama ?? 'Tidak diketahui' }}</td>
            <td class="px-6 py-3 text-center">
                <a href="{{ asset('storage/' . $itemDistributor->nib) }}" target="_blank" class="text-blue-500">Lihat Dokumen</a>
            </td>
            <td class="px-6 py-3 text-center">
                <span class="inline-block py-1 px-3 rounded-full 
                    @if($itemDistributor->status == 'menunggu')
                                bg-yellow-500 text-white
                            @elseif($itemDistributor->status == 'diterima')
                                bg-green-600 text-white
                            @else
                                bg-red-600 text-white
                            @endif
                ">
                    {{ ucfirst($itemDistributor->status) }}
                </span>
            </td>
            <td class="px-6 py-3 text-center">
                @if ($itemDistributor->status !== 'menunggu')
                <button class="px-3 py-1 text-white bg-gray-400 rounded cursor-not-allowed" disabled>✓</button>
                @else
                <form action="{{ route('distributor.setujui', ['id_distributor' => $itemDistributor->id_distributor]) }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="px-3 py-1 text-xs font-semibold text-white bg-green-600 rounded hover:bg-green-700">
                        Terima
                    </button>
                </form>

                <form action="{{ route('distributor.tolak', ['id_distributor' => $itemDistributor->id_distributor]) }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="px-3 py-1 text-xs font-semibold text-white bg-red-600 rounded hover:bg-red-700">
                        Tolak
                    </button>
                </form>
                @endif
            </td>
        </tr>
    @endforeach
</tbody>


    </table>
</div>
</div>
@endsection


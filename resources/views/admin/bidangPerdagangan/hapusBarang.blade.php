@extends('layouts.admin')
@section('title', 'Hapus Data Barang')

@section('content')
<div class="w-full h-32">
    <img src="{{ asset('assets/img/background/admin_perdagangan.png') }}"
         alt="Background"
         class="w-full h-full object-cover">
</div>

<div class="bg-white py-4 px-6 md:px-10 min-h-[calc(100vh-8rem)]">
    <h2 class="text-center text-lg md:text-xl font-bold mb-4 text-[#083358]">Tabel Data Barang</h2>

    <div class="overflow-x-auto rounded-xl border border-gray-200 bg-[#083358] text-white shadow-md">
        <table class="min-w-full text-sm text-left">
            <tr class=" font-semibold">
                <tr>
                    <th class="py-3 px-4">No</th>
                    <th class="py-3 px-4">Nama Barang</th>
                    <th class="py-3 px-4">Kategori Barang</th>
                    <th class="py-3 px-4">Aksi</th>
                </tr>
            </thead>
            <tbody>
                {{-- @forelse ($barangs as $index => $barang)
                    <tr class="border-b">
                        <td class="py-2 px-4">{{ $index + 1 }}</td>
                        <td class="py-2 px-4">{{ $barang->nama_barang }}</td>
                        <td class="py-2 px-4">{{ $barang->kategori }}</td>
                        <td class="py-2 px-4">
                            <form action="{{ route('barang.destroy', $barang->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus barang ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-4 py-1 rounded-full text-xs">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center py-4 text-gray-500">Tidak ada data barang</td>
                    </tr>
                @endforelse --}}
            </tbody>
        </table>
    </div>
</div>
@endsection

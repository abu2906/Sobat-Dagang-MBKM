@extends('layouts.admin')

@section('content')
<div class="p-6 bg-gray-100 min-h-screen">
    <!-- Header Background -->
    <div class="relative h-[150px] w-full bg-cover bg-[center_87%]" style="background-image: url('/assets/img/background/user_metrologi.png');">
        <!-- Floating Filter + Button -->
        <div class="absolute bottom-[-30px] w-full px-8">
            <div class="flex flex-wrap items-center justify-between p-4 rounded-xl shadow-md">
                <!-- Filter/Search Input -->
                <div class="relative flex-grow mt-2 md:mt-0">
                    <input type="text" placeholder="Cari" class="pl-10 pr-4 py-2 rounded-full shadow text-sm w-full">
                    <span class="absolute left-3 top-2 text-gray-400">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-4.35-4.35M17 11a6 6 0 11-12 0 6 6 0 0112 0z" />
                        </svg>
                    </span>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Popup Review -->
    <div id="popupDetailAlat" class="fixed inset-0 z-50 hidden justify-center items-center bg-opacity-50">
        <div class="bg-white p-6 rounded-xl w-[450px] max-w-full relative shadow-xl">
            <button onclick="togglePopup(false)" class="absolute top-2 right-3 text-gray-500 hover:text-black text-xl font-bold">&times;</button>
            <h2 class="text-center font-bold text-lg mb-4">
                Detail Alat Ukur - 
                <span id="popupNoReg" class="text-gray-600"></span>
            </h2>
            <table class="w-full text-sm">
                <tbody id="popupDetailBody"></tbody>
            </table>
        </div>
    </div>

    <!-- Tabel Alat Ukur Sah -->
    <div class="overflow-x-auto rounded-lg shadow-sm mt-6">
        <table class="min-w-full text-sm text-left text-gray-700 bg-white border border-gray-200">
            <thead class="bg-[#0c3252] text-white">
                <tr>
                    <th scope="col" class="text-center px-5 py-3 font-medium border-b border-blue-100">No</th>
                    <th scope="col" class="text-center px-5 py-3 font-medium border-b border-blue-100">Jenis Alat</th>
                    <th scope="col" class="text-center px-5 py-3 font-medium border-b border-blue-100">Nomor Registrasi</th>
                    <th scope="col" class="text-center px-5 py-3 font-medium border-b border-blue-100">Tanggal Tera</th>
                    <th scope="col" class="text-center px-5 py-3 font-medium border-b border-blue-100">Tanggal Exp</th>
                    <th scope="col" class="text-center px-5 py-3 font-medium border-b border-blue-100">Status</th>
                    <th scope="col" class="text-center px-5 py-3 font-medium border-b border-blue-100">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($alatUkur as $index => $data)
                <tr class="hover:bg-blue-50 transition">
                    <td class="px-5 text-center py-3 border-b">{{ $index + 1 }}</td>
                    <td class="px-5 text-center py-3 border-b">{{ $data->uttp->jenis_alat }}</td>
                    <td class="px-5 text-center py-3 border-b">{{ $data->uttp->no_registrasi }}</td>
                    <td class="px-5 text-center py-3 border-b">{{ \Carbon\Carbon::parse($data->uttp->tanggal_penginputan)->format('d F Y') }}</td>
                    <td class="px-5 text-center py-3 border-b">
                        {{ optional($data)->tanggal_exp ? \Carbon\Carbon::parse($data->tanggal_exp)->format('d F Y') : '-' }}
                    </td>
                    <td class="px-5 text-center py-3 border-b">
                        <span class="
                            font-semibold
                            {{ $data->status === 'Valid' ? 'text-green-600' : ($data->status === 'Kadaluarsa' ? 'text-red-600' : 'text-gray-500') }}">
                            {{ $data->status ?? '-' }}
                        </span>
                    </td>
                    <td class="px-5 py-3 border-b">
                        <div class="flex justify-center">
                            <button class="flex items-center space-x-2 text-black hover:text-gray-600 transition" onclick="loadDetailAlat('{{ $data->uttp->id_uttp }}')">
                                <!-- Icon Preview -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-5 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                                <span>Preview</span>
                            </button>
                        </div>
                    </td>

                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<script>
    function togglePopup(show) {
        const modal = document.getElementById('popupDetailAlat');
        if (show) {
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        } else {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }
    }

    function loadDetailAlat(id) {
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        fetch("{{ route('alat.detail.post') }}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken
            },
            body: JSON.stringify({ id: id })
        })
        .then(response => response.json())
        .then(data => {
            document.getElementById('popupNoReg').textContent = data.no_registrasi ?? '-';

            const body = document.getElementById('popupDetailBody');
            body.innerHTML = `
                <tr><td class="py-1 font-semibold">Nama Usaha</td><td>: ${data.nama_usaha ?? '-'}</td></tr>
                <tr><td class="py-1 font-semibold">Jenis Alat</td><td>: ${data.jenis_alat ?? '-'}</td></tr>
                <tr><td class="py-1 font-semibold">Merk / Tipe</td><td>: ${data.merk_type ?? '-'}</td></tr>
                <tr><td class="py-1 font-semibold">Kapasitas</td><td>: ${data.nama_alat ?? '-'}</td></tr>
                <tr><td class="py-1 font-semibold">Nomor Seri</td><td>: ${data.nomor_seri ?? '-'}</td></tr>
                <tr><td class="py-1 font-semibold">Alat Penguji</td><td>: ${data.alat_penguji ?? '-'}</td></tr>
                <tr><td class="py-1 font-semibold">Cap Tanda Tera</td><td>: ${data.ctt ?? '-'}</td></tr>
                <tr><td class="py-1 font-semibold">No Surat Perintah Tugas</td><td>: ${data.spt_keperluan ?? '-'}</td></tr>
                <tr><td class="py-1 font-semibold">Tanggal Mulai</td><td>: ${data.tanggal_penginputan ?? '-'}</td></tr>
                <tr><td class="py-1 font-semibold">Tanggal Selesai</td><td>: ${data.tanggal_selesai ?? '-'}</td></tr>
                <tr><td class="py-1 font-semibold">Keterangan</td><td>: ${data.keterangan ?? '-'}</td></tr>
            `;

            togglePopup(true);
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Terjadi kesalahan saat memuat detail alat');
        });
    }
</script>
@endsection 
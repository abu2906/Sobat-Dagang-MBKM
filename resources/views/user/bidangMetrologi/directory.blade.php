@extends('layout.user')

@section('tab')

@endsection

@section('content')
	<!-- Filter -->
    <div class="absolute left-1/2 transform -translate-x-1/2 top-[-20px] z-10 w-full">
        <div class="flex flex-wrap px-8 items-center justify-between ">
            <div class="flex space-x-2">
                <select class="px-4 py-2 rounded-full border shadow text-sm">
                    <option>Status</option>
                    <option>Kadaluarsa</option>
                    <option>Valid</option>
                </select>
            </div>
            <div class="relative flex-grow mt-2 md:mt-0">
                <input type="text" placeholder="Cari" class="pl-10 pr-4 py-2 rounded-full border shadow text-sm w-full">
                <span class="absolute left-3 top-2 text-gray-400">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-4.35-4.35M17 11a6 6 0 11-12 0 6 6 0 0112 0z" />
                    </svg>
                </span>
            </div>
            <div class="px-4 py-2 items-center rounded-full text-sm bg-blue-600 font-bold text-white">
                <p>Alat Ukur Saya</p>
            </div>
        </div>
    </div>

    <!-- Modal Popup Review -->
    <div id="popupDetailAlat" class="fixed inset-0 z-50 hidden justify-center items-center bg-black bg-opacity-50">
        <div class="bg-white p-6 rounded-xl w-[450px] max-w-full relative shadow-xl">
            
            <button onclick="togglePopup(false)" class="absolute top-2 right-3 text-gray-500 hover:text-black text-xl font-bold">&times;</button>

            <h2 class="text-center font-bold text-lg mb-4">Detail Alat Ukur - <span class="text-gray-600">(Nomor Registrasi)</span></h2>

            <table class="w-full text-sm">
                <tbody>
                    <tr>
                        <td class="px-5 py-3 font-bold pr-2">Nama Alat</td>
                        <td class="px-5 py-3">:</td>
                        <td class="px-5 py-3">Timbangan Digital</td>
                    </tr>
                    <tr>
                        <td class="px-5 py-3 font-bold pr-2">Nomor Registrasi</td>
                        <td class="px-5 py-3">:</td>
                        <td class="px-5 py-3">SMBRNG-0231</td>
                    </tr>
                    <tr>
                        <td class="px-5 py-3 font-bold pr-2">Nama Pemilik</td>
                        <td class="px-5 py-3">:</td>
                        <td class="px-5 py-3">Icha</td>
                    </tr>
                    <tr>
                        <td class="px-5 py-3 font-bold pr-2">Nama Usaha</td>
                        <td class="px-5 py-3">:</td>
                        <td class="px-5 py-3">Toko Kembar</td>
                    </tr>
                    <tr>
                        <td class="px-5 py-3 font-bold pr-2">Tanggal Tera</td>
                        <td class="px-5 py-3">:</td>
                        <td class="px-5 py-3">12 Januari 2025</td>
                    </tr>
                    <tr>
                        <td class="px-5 py-3 font-bold pr-2">Tanggal Expire</td>
                        <td class="px-5 py-3">:</td>
                        <td class="px-5 py-3">12 Januari 2026</td>
                    </tr>
                    <tr>
                        <td class="px-5 py-3 font-bold pr-2">Merk / Type</td>
                        <td class="px-5 py-3">:</td>
                        <td class="px-5 py-3">Tidak Tahu</td>
                    </tr>
                    <tr>
                        <td class="px-5 py-3 font-bold pr-2">Nomor Seri</td>
                        <td class="px-5 py-3">:</td>
                        <td class="px-5 py-3">12345</td>
                    </tr>
                    <tr>
                        <td class="px-5 py-3 font-bold pr-2">Alat Penguji</td>
                        <td class="px-5 py-3">:</td>
                        <td class="px-5 py-3">HJ-002145</td>
                    </tr>
                    <tr>
                        <td class="px-5 py-3 font-bold pr-2">Sertifikat</td>
                        <td class="px-5 py-3">:</td>
                        <td class="px-5 py-3">
                            <a href="file/sertifikat.pdf" target="_blank" class="text-blue-600 hover:underline">🔽 Download PDF</a>
                        </td>
                    </tr>
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
    </script>



    <!-- Tabel Alat Ukur -->
    <div class="overflow-x-auto rounded-lg shadow-sm mt-6">
        <table class="min-w-full text-sm text-left text-gray-700 bg-white border border-gray-200">
            <thead class="bg-[#1e3a8a] text-white">
                <tr>
                    <th scope="col" class="text-center px-5 py-3 font-medium border-b border-blue-100">No</th>
                    <th scope="col" class="text-center px-5 py-3 font-medium border-b border-blue-100">Nama Alat</th>
                    <th scope="col" class="text-center px-5 py-3 font-medium border-b border-blue-100">Nomor Registrasi</th>
                    <th scope="col" class="text-center px-5 py-3 font-medium border-b border-blue-100">Tanggal Tera</th>
                    <th scope="col" class="text-center px-5 py-3 font-medium border-b border-blue-100">Expired</th>
                    <th scope="col" class="text-center px-5 py-3 font-medium border-b border-blue-100">Status</th>
                    <th scope="col" class="text-center px-5 py-3 font-medium border-b border-blue-100">Sertifikat</th>
                    <th scope="col" class="text-center px-5 py-3 font-medium border-b border-blue-100">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <tr class="hover:bg-blue-50 transition">
                    <td class="px-5 text-center py-3 border-b">1</td>
                    <td class="px-5 text-center py-3 border-b">Timbangan Digital</td>
                    <td class="px-5 text-center py-3 border-b">SMBRNG-0231</td>
                    <td class="px-5 text-center py-3 border-b">12 Januari 2024</td>
                    <td class="px-5 text-center py-3 border-b">12 Januari 2025</td>
                    <td class="px-5 text-center py-3 border-b">
                        <span class="text-xs font-medium text-white px-8 py-1 bg-green-700 rounded-full">Valid</span>
                    </td>
                    <td class="px-5 text-center py-3 border-b">                    
                        <button class="flex space-x-2 text-gray-800 hover:text-gray-700 transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-5 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M7 7h10M7 11h10M7 15h6M5 3h14a2 2 0 012 2v14a2 2 0 
                                    01-2 2H5a2 2 0 01-2-2V5a2 2 0 012-2z"/>
                            </svg> 
                            <span>Sertifikat</span>
                        </button>
                    </td>
                    <td>
                        <button class="flex space-x-2 text-black hover:text-gray-600 transition" onclick="togglePopup(true)">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-5 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                            <span>Preview</span>
                        </button>
                    </td>
                </tr>
                <tr class="hover:bg-blue-50 transition">
                    <td class="px-5 text-center py-3 border-b">2</td>
                    <td class="px-5 text-center py-3 border-b">Timbangan Digital</td>
                    <td class="px-5 text-center py-3 border-b">SMBRNG-0232</td>
                    <td class="px-5 text-center py-3 border-b">12 Juni 2024</td>
                    <td class="px-5 text-center py-3 border-b">12 Juni 2025</td>
                    <td class="px-5 text-center py-3 border-b">
                        <span class="text-xs font-medium text-white px-8 py-1 bg-green-700 rounded-full">Valid</span>
                    </td>
                    <td class="px-5 text-center py-3 border-b">                    
                        <button class="flex space-x-2 text-gray-800 hover:text-gray-700 transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-5 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M7 7h10M7 11h10M7 15h6M5 3h14a2 2 0 012 2v14a2 2 0 
                                    01-2 2H5a2 2 0 01-2-2V5a2 2 0 012-2z"/>
                            </svg> 
                            <span>Sertifikat</span>
                        </button>
                    </td>
                    <td>
                        <button class="flex space-x-2 text-black hover:text-gray-600 transition" onclick="toggleModal(true, 'path.jpg')">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-5 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                            <span>Preview</span>
                        </button>
                    </td>
                </tr>
                <tr class="hover:bg-blue-50 transition">
                    <td class="px-5 text-center py-3 border-b">3</td>
                    <td class="px-5 text-center py-3 border-b">Timbangan Digital</td>
                    <td class="px-5 text-center py-3 border-b">SMBRNG-0233</td>
                    <td class="px-5 text-center py-3 border-b">12 Januari 2024</td>
                    <td class="px-5 text-center py-3 border-b">12 Januari 2025</td>
                    <td class="px-5 text-center py-3 border-b">
                        <span class="text-xs font-medium text-white px-4 py-1 bg-red-600 rounded-full">Kadaluarsa</span>
                    </td>
                    <td class="px-5 text-center py-3 border-b">                    
                        <button class="flex space-x-2 text-gray-800 hover:text-gray-700 transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-5 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M7 7h10M7 11h10M7 15h6M5 3h14a2 2 0 012 2v14a2 2 0 
                                    01-2 2H5a2 2 0 01-2-2V5a2 2 0 012-2z"/>
                            </svg> 
                            <span>Sertifikat</span>
                        </button>
                    </td>
                    <td>
                        <button class="flex space-x-2 text-black hover:text-gray-600 transition" onclick="toggleModal(true, 'path.jpg')">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-5 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                            <span>Preview</span>
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
@endsection
@extends('layouts.admin')

@section('content')
<div class="p-6  min-h-screen">
    <!-- Header Background -->
    <div class="relative h-[150px] w-full bg-cover bg-[center_87%]" style="background-image: url('/assets/img/background/kepalaDinas_SuperAdmin.jpg');">
        <!-- Floating Filter + Button -->
        <div class="absolute bottom-[-30px] w-full px-8">
            <div class="flex flex-wrap items-center justify-between p-4 rounded-xl shadow-md">
                <!-- Filter/Search Input -->
                <div class="flex space-x-4 mb-2 md:mb-0">
                    <select name="status" id="statusFilter" class="flex items-center px-4 py-2 rounded-full border shadow text-sm" onchange="this.form.submit()">
                        <option value="">Semua</option>
                        <option value="Valid">Valid</option>
                        <option value="Kadaluarsa">Kadaluarsa</option>
                    </select>
                </div>
                <div class="relative flex-grow mt-2 md:mt-0 mx-4">
                    <input type="text" id="searchInput" placeholder="Cari" class="pl-10 pr-4 py-2 rounded-full shadow text-sm w-full">
                    <span class="absolute left-3 top-2 text-gray-400">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-4.35-4.35M17 11a6 6 0 11-12 0 6 6 0 0112 0z" />
                        </svg>
                    </span>
                </div>
                <!-- Add Button -->
                <div class="flex gap-4 mt-2 md:mt-0">
                    <button onclick="openModal()" class="text-white flex items-center gap-2 bg-[#0c3252] transition-colors duration-300 hover:bg-[#F49F1E] hover:text-black rounded-full px-8 py-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        Tambah FAQ
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="overflow-x-auto rounded-lg shadow-sm mt-4">
		<div class="min-w-full inline-block align-middle">
			<div class="overflow-hidden">
                <table class="min-w-full text-sm text-left text-gray-700 bg-white border border-gray-200">
					<thead class="bg-[#0c3252] text-white">
                        <tr>
							<th scope="col" class="px-3 sm:px-5 py-3 font-medium border-b border-blue-100 text-center">No</th>
							<th scope="col" class="px-3 sm:px-5 py-3 font-medium border-b border-blue-100 text-center">No Surat</th>
							<th scope="col" class="px-3 sm:px-5 py-3 font-medium border-b border-blue-100 text-center">Tanggal Surat</th>
							<th scope="col" class="px-3 sm:px-5 py-3 font-medium border-b border-blue-100 text-center hidden sm:table-cell">ID User</th>
						</tr>
                    </thead>
                    <tbody>
						<tr class="hover:bg-blue-50 transition">
							<td class="px-3 sm:px-5 py-3 border-b text-center"></td>
							<td class="px-3 sm:px-5 py-3 border-b text-center"></td>
							<td class="px-3 sm:px-5 py-3 border-b text-center"></td>
							<td class="px-3 sm:px-5 py-3 border-b text-center"></td>
						</tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
@extends('layouts.admin')

@section('content')
<div class="p-6  min-h-screen">
    <div class="relative h-[150px] w-full bg-cover bg-[center_87%]" style="background-image: url('/assets/img/background/kepalaDinas_SuperAdmin.jpg');">
        <div class="absolute bottom-[-30px] w-full px-8">
            <div class="flex flex-wrap items-center justify-between p-4 rounded-xl shadow-md">
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
							<th scope="col" class="px-3 sm:px-5 py-3 font-medium border-b border-blue-100 text-center">Pertanyaan</th>
							<th scope="col" class="px-3 sm:px-5 py-3 font-medium border-b border-blue-100 text-center">Jawaban</th>
							<th scope="col" class="px-3 sm:px-5 py-3 font-medium border-b border-blue-100 text-center">Aksi</th>
						</tr>
                    </thead>
                    <tbody>
                        @foreach ($faqs as $faq)
                        <tr class="hover:bg-blue-50 transition">
                            <td class="px-3 sm:px-5 py-3 border-b text-center">{{ $loop->iteration }}</td>
                            <td class="px-3 sm:px-5 py-3 border-b">{{ $faq->pertanyaan }}</td>
                            <td class="px-3 sm:px-5 py-3 border-b">{{ $faq->jawaban }}</td>
                            <td class="px-3 sm:px-5 py-3 border-b text-center">
                                <div class="flex items-center justify-center gap-2">
                                    <button onclick="openEditModal(this)" data-id="{{ $faq->id }}" data-pertanyaan="{{ htmlspecialchars($faq->pertanyaan, ENT_QUOTES) }}" data-jawaban="{{ htmlspecialchars($faq->jawaban, ENT_QUOTES) }}" class="text-black px-2 py-1 rounded-full inline-flex items-center justify-center" title="Edit">
                                        <span class="material-symbols-outlined">edit</span>
                                    </button>
                                    <form action="{{ route('faq-destroy', $faq->id) }}" method="POST"onsubmit="return confirm('Yakin ingin menghapus data ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="text-black px-2 py-1 rounded-full inline-flex items-center justify-center"
                                            title="Hapus">
                                            <span class="material-symbols-outlined">delete</span>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>
        </div>
    </div>

    <!-- Modal Edit FAQ -->
    <div id="editFaqModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">
        <div class="bg-white rounded-lg w-11/12 max-w-lg p-6 relative">
            <h2 class="text-xl font-semibold mb-4">Edit FAQ</h2>
            <form id="editFaqForm" method="POST" action="">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label for="edit_pertanyaan" class="block mb-1 font-medium">Pertanyaan</label>
                    <input type="text" name="pertanyaan" id="edit_pertanyaan" class="w-full border border-gray-300 rounded px-3 py-2" required>
                </div>

                <div class="mb-4">
                    <label for="edit_jawaban" class="block mb-1 font-medium">Jawaban</label>
                    <textarea name="jawaban" id="edit_jawaban" rows="4" class="w-full border border-gray-300 rounded px-3 py-2" required></textarea>
                </div>

                <div class="flex justify-end gap-3">
                    <button type="button" onclick="closeEditModal()" class="px-4 py-2 rounded bg-gray-300 hover:bg-gray-400">Batal</button>
                    <button type="submit" class="px-4 py-2 rounded bg-[#0c3252] text-white hover:bg-[#F49F1E]">Simpan</button>
                </div>
            </form>
            <!-- Close button -->
            <button onclick="closeEditModal()" class="absolute top-3 right-3 text-gray-600 hover:text-gray-800 text-xl font-bold">&times;</button>
        </div>
    </div>


    <!-- Modal Tambah FAQ -->
    <div id="faqModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center hidden">
        <div class="bg-white rounded-lg shadow-lg w-full max-w-md p-6 relative">
            <h2 class="text-xl font-semibold mb-4">Tambah FAQ</h2>
            <form action="{{ route('faq-store') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="pertanyaan" class="block text-sm font-medium text-gray-700">Pertanyaan</label>
                    <input type="text" name="pertanyaan" id="pertanyaan" required
                        class="mt-1 block w-full px-4 py-2 border rounded-md shadow-sm focus:ring focus:ring-blue-200">
                </div>
                <div class="mb-4">
                    <label for="jawaban" class="block text-sm font-medium text-gray-700">Jawaban</label>
                    <textarea name="jawaban" id="jawaban" rows="4" required
                        class="mt-1 block w-full px-4 py-2 border rounded-md shadow-sm focus:ring focus:ring-blue-200"></textarea>
                </div>
                <div class="flex justify-end gap-3">
                    <button type="button" onclick="closeModal()"
                        class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">Batal</button>
                    <button type="submit"
                        class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Simpan</button>
                </div>
            </form>
            <button onclick="closeModal()" class="absolute top-2 right-3 text-gray-500 hover:text-red-500">
                ✕
            </button>
        </div>
    </div>
</div>

<script>
    function openModal() {
        document.getElementById('faqModal').classList.remove('hidden');
    }

    function closeModal() {
        document.getElementById('faqModal').classList.add('hidden');
    }

    function openEditModal(button) {
        console.log('openEditModal triggered');
        const id = button.getAttribute('data-id');
        const pertanyaan = button.getAttribute('data-pertanyaan');
        const jawaban = button.getAttribute('data-jawaban');

        document.getElementById('edit_pertanyaan').value = pertanyaan;
        document.getElementById('edit_jawaban').value = jawaban;

        document.getElementById('editFaqForm').action = `/admin/faq/${id}`;

        document.getElementById('editFaqModal').classList.remove('hidden');
    }  

    function closeEditModal() {
        document.getElementById('editFaqModal').classList.add('hidden');
    }


    function closeEditModal() {
        document.getElementById('editFaqModal').classList.add('hidden');
    }
</script>
@endsection
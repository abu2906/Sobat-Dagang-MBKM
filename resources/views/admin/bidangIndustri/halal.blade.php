@extends('layouts.admin')
@section('title', 'Sertifikat Halal')

@section('content')

<div class="w-full max-w-full">
  <div x-data="{openAdd: {{ session('openAdd') ? 'true' : 'false' }} , openEdit: false, selectedItem: null }">
  <div class="relative w-full h-64">
    <img src="{{ asset('/assets/img/background/user_industri.png') }}" alt="Banner" class="object-cover w-full h-64">
      <a href="{{ route('dashboard.industri') }}"
        class="absolute flex items-center justify-center w-12 h-12 text-black transition-all duration-300 transform -translate-y-1/2 rounded-full shadow-lg left-14 top-1/2 bg-white/80 hover:bg-black hover:text-white hover:border-white hover:scale-110">
        <span class="text-2xl material-symbols-outlined">
            arrow_back
        </span>
      </a>
    </div>

  <div class="flex items-center gap-4 px-6 py-6 w-full mx-auto relative">
    <div class="relative flex-1">
      <form method="GET" action="{{ route('admin.industri.halal') }}">
          <input type="text" name="search" x-model="searchQuery" placeholder="Cari"
            class="w-full p-3 pl-10 bg-transparent border border-gray-300 rounded-full focus:outline-none focus:ring-2 focus:ring-blue-500" value="{{ request('search') }}" />
          <span class="absolute text-gray-500 transform -translate-y-1/2 material-symbols-outlined left-3 top-1/2">search</span>
      </form>
    </div>
      
    <button @click="openAdd = true" class="bg-[#002B4E] text-white font-semibold rounded-full px-6 py-3 shadow-md hover:brightness-110 transition" data-bs-toggle="modal" data-bs-target="#tambahModal">
      TAMBAH DATA
    </button>
  </div>

  <!-- Form Tambah Data -->
  
  <div x-show="openAdd" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">
    <div class="bg-white p-6 rounded shadow w-full max-w-lg">
      <h2 class="text-xl text-center font-semibold mb-4">Tambah Data Sertifikat Halal</h2>
      @if (session('success'))
      <div class="p-4 mb-4 text-sm text-green-700 bg-green-100 border border-green-200 rounded-lg" role="alert">
          {{ session('success') }}
      </div>
      @endif
      @if (session('error'))
      <div class="p-4 mb-4 text-sm text-red-700 bg-red-100 border border-red-200 rounded-lg" role="alert">
          {{ session('error') }}
      </div>
      @endif
      @if ($errors->any())
      <div class="p-4 mb-4 text-sm text-red-700 bg-red-100 border border-red-200 rounded-lg">
          <strong>Terjadi kesalahan:</strong>
          <ul class="mt-1 ml-4 list-disc list-inside">
              @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
              @endforeach
          </ul>
      </div>
      @endif
      <form action="{{ route('admin.industri.halal.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
          <div class="grid md:grid-cols-2 gap-4 w-800px">
            <div>
              <label class="block mb-1 font-semibold">Nama Usaha</label>
              <input type="text" name="nama_usaha" placeholder="Nama Usaha" class="w-full rounded-lg border border-gray-300 px-4 py-2 text-sm focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 shadow-sm placeholder-gray-400 transition" required>
            </div>
            <div>
              <label class="block mb-1 font-semibold">Nomor Sertifikat Halal</label>
              <input type="text" name="no_sertifikasi_halal" placeholder="No Sertifikat Halal" class="w-full rounded-lg border border-gray-300 px-4 py-2 text-sm focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 shadow-sm placeholder-gray-400 transition">
            </div>
            <div>
              <label class="block mb-1 font-semibold">Tanggal Diterbitkan</label>
              <input type="date" name="tanggal_sah" class="w-full rounded-lg border border-gray-300 px-4 py-2 text-sm focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 shadow-sm placeholder-gray-400 transition" required>
            </div>
            <div>
              <label class="block mb-1 font-semibold">Berlaku Sampai</label>
              <input type="date" name="tanggal_exp" class="w-full rounded-lg border border-gray-300 px-4 py-2 text-sm focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 shadow-sm placeholder-gray-400 transition" required>
            </div>
            <div>
              <label class="block mb-1 font-semibold">Status</label>
              <select name="status" class="w-full rounded-lg border border-gray-300 px-4 py-2 text-sm focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 shadow-sm placeholder-gray-400 transition" required>
                <option value="Berlaku">Berlaku</option>
                <option value="Perlu Pembaruan">Perlu Pembaruan</option>
              </select>
            </div>
            <div x-data="{ fileName: '' }">
              <p class="block mb-1 font-semibold">Sertifikat Halal</p>
              <label for="filesertifikat" class="px-4 py-2 bg-blue-100 text-black rounded-full cursor-pointer transition-all duration-300 hover:bg-[#083358] hover:text-white w-max sm:w-auto md:w-max">Pilih File</label>
              <input type="file" id="filesertifikat" name="sertifikat" accept="application/pdf" class="hidden" accept=".pdf" @change="fileName = $event.target.files[0].name" required>
              <p x-text="fileName" class="mt-2 text-sm text-gray-600"></p>
              <p class="mt-1 text-sm text-gray-500">Maksimal ukuran file 512KB (PDF).</p>
            </div>
            </div>
            <div>
              <label class="block mb-1 font-semibold"><i class="fas fa-map-marker-alt mr-1 text-blue-600"></i>Alamat</label>
              <textarea name="alamat" placeholder="Alamat" class="w-full rounded-lg border border-gray-300 px-4 py-2 text-sm focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 shadow-sm placeholder-gray-400 transition"  required></textarea>
            </div>
          <div class="flex justify-center mt-4 space-x-2">
            <button type="button" @click="openAdd = false" class="px-4 py-2 bg-gray-300 rounded-full">Batal</button>
            <button type="submit" class="bg-[#002B4E] text-white font-semibold rounded-full px-6 py-3 shadow-md hover:bg-blue-300 hover:text-black transition">Simpan</button>
          </div>

        </form>
      </div>
    </div>
    </div>
  </div>

  <!-- Tabel Data -->
  <div class="container px-4 pb-4 mx-auto">
  <section class="overflow-hidden bg-white border border-gray-300 shadow-md rounded-xl">
  <div class="overflow-y-auto max-h-[350px]">
  <table class="w-full text-sm table-auto text-left">
    <thead class="bg-[#0d3b66] text-white sticky top-0 z-10">
      <tr>
        <th class="px-4 py-3 font-semibold text-left sticky">NO</th>
        <th class="px-4 py-3 font-semibold text-left sticky">Nama Usaha</th>
        <th class="px-4 py-3 font-semibold text-left sticky">No Sertifikat</th>
        <th class="px-4 py-3 font-semibold text-left sticky">Tanggal Diterbitkan</th>
        <th class="px-4 py-3 font-semibold text-left sticky">Berlaku Sampai</th>
        <th class="px-4 py-3 font-semibold text-left sticky">Alamat</th>
        <th class="px-4 py-3 font-semibold text-left sticky">Status</th>
        <th class="px-4 py-3 font-semibold text-left sticky">Sertifikat</th>
        <th class="px-4 py-3 font-semibold text-left sticky rounded-tr-xl">Aksi</th>
      </tr>
    </thead>
    <tbody>
      @foreach($items as $item)
      <tr id="row-{{ $item->id_halal }}">
        <td class="px-4 py-3">{{ $loop->iteration }}</td>
        <td class="px-4 py-3">{{ $item->nama_usaha }}</td>
        <td class="px-4 py-3">{{ $item->no_sertifikasi_halal }}</td>
        <td class="px-4 py-3">{{ \Carbon\Carbon::parse($item->tanggal_sah)->format('d-m-Y') }}</td>
        <td class="px-4 py-3">{{ \Carbon\Carbon::parse($item->tanggal_exp)->format('d-m-Y') }}</td>
        <td class="px-4 py-3">{{ $item->alamat }}</td>
        <td class="px-4 py-3" >{{ $item->status }}</td>
        <td class="px-4 py-3">
          @if($item->sertifikat)
            <a href="{{ asset('storage/' . $item->sertifikat) }}" target="_blank" class="text-blue-600 underline">Lihat</a>
          @else
            -
          @endif
        </td>
        <td>
          <button class="btn btn-sm " onclick="openEditModal({{ json_encode($item) }})" class="text-green-600 hover:text-green-800" title="Edit">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-green-600 hover:text-green-800 transition" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M15.232 5.232l3.536 3.536M9 13l6-6 3 3-6 6H9v-3z" />
            </svg>
          </button>
          <button class="btn btn-sm btn-danger" onclick="deleteData({{ $item->id_halal }})" class=text-red-600 hover:text-red-800 title="Hapus">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-red-600 hover:text-red-800 transition" fill="none" viewBox="0 0 24 24"
              stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M9 7h6m2 0H7m4-3h2a1 1 0 011 1v1H8V5a1 1 0 011-1z" />
            </svg>
          </button>
        </td>
      </tr>
      @endforeach
    </tbody>
    </table>
    </div>
    </section>
    </div>
  </div>
  

  <!-- Modal Edit -->
  <div id="modalEdit" style="display:none; background: rgba(0,0,0,0.5); position: fixed; inset: 0; z-index: 1000;" class= "overflow-x-auto">
    <div style="background: white; max-width: 700px; margin: 50px auto; padding: 20px; border-radius: 8px; position: center;">
      <h3 class="text-xl font-bold mb-6 text-center">Edit Sertifikat Halal</h3>
      
      <form id="formEdit" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <input type="hidden" id="edit_id" name="id_halal">
        <div class="grid md:grid-cols-2 gap-4">
          <div>
            <label class="block mb-1 font-semibold"><i class="fas fa-store mr-1 text-blue-600"></i>Nama Usaha</label>
            <input type="text" id="edit_nama_usaha" name="nama_usaha" class="w-full rounded-lg border border-gray-300 px-4 py-2 text-sm focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 shadow-sm placeholder-gray-400 transition" required>
          </div>
          <div>
            <label class="block mb-1 font-semibold">Nomor Sertifikat Halal</label>
            <input type="text" id="edit_no_sertifikasi_halal" name="no_sertifikasi_halal" class="w-full rounded-lg border border-gray-300 px-4 py-2 text-sm focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 shadow-sm placeholder-gray-400 transition">
          </div>
          <div>
            <label class="block mb-1 font-semibold">Tanggal Sah</label>
            <input type="date" id="edit_tanggal_sah" name="tanggal_sah" class="w-full rounded-lg border border-gray-300 px-4 py-2 text-sm focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 shadow-sm placeholder-gray-400 transition" required>
          </div>
          <div>
            <label class="block mb-1 font-semibold">Tanggal Exp</label>
            <input type="date" id="edit_tanggal_exp" name="tanggal_exp" class="w-full rounded-lg border border-gray-300 px-4 py-2 text-sm focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 shadow-sm placeholder-gray-400 transition" required>
          </div>
          <div>
            <label class="block mb-1 font-semibold">Status</label>
            <select id="edit_status" name="status" class="w-full rounded-lg border border-gray-300 px-4 py-2 text-sm focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 shadow-sm placeholder-gray-400 transition" required>
              <option value="Berlaku">Berlaku</option>
              <option value="Perlu Pembaruan">Perlu Pembaruan</option>
            </select>
          </div>
          <div>
            <label class="block mb-1 font-semibold">Alamat</label>
            <textarea id="edit_alamat" name="alamat" placeholder="Alamat" class="w-full rounded-lg border border-gray-300 px-4 py-2 text-sm focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 shadow-sm placeholder-gray-400 transition"  required></textarea>
          </div>
          <div x-data="{ fileName: '' }">
            <p class="block mb-1 font-semibold">Sertifikat (PDF - kosongkan jika tidak berubah)</p>
            <label for="filesertifikat" class="px-4 py-2 bg-blue-100 text-black rounded-full cursor-pointer transition-all duration-300 hover:bg-[#083358] hover:text-white w-max sm:w-auto md:w-max">Pilih File</label>
            <input type="file" name="sertifikat" accept="application/pdf" class="hidden" accept=".pdf" @change="fileName = $event.target.files[0].name">
            <p x-text="fileName" class="mt-2 text-sm text-gray-600"></p>
            <p class="mt-1 text-sm text-gray-500">Maksimal ukuran file 512KB (PDF).</p>
          </div>
          <div>
            <div class="mt-10 flex justify-center gap-4">
              <button type="button" onclick="closeEditModal()" class="px-4 py-2 bg-gray-300 rounded-xl">Batal</button>
              <button type="button" onclick="submitEdit()" class="bg-[#002B4E] text-white font-semibold rounded-xl px-6 py-3 shadow-md hover:brightness-110 transition">Simpan Perubahan</button>
            </div>
          </div>
      </form>
      </div>
    </div>
  </div>

</div>

<script>
  
  function openEditModal(item) {
    document.getElementById('modalEdit').style.display = 'block';
    document.getElementById('edit_id').value = item.id_halal;
    document.getElementById('edit_nama_usaha').value = item.nama_usaha;
    document.getElementById('edit_no_sertifikasi_halal').value = item.no_sertifikasi_halal;
    document.getElementById('edit_tanggal_sah').value = item.tanggal_sah;
    document.getElementById('edit_tanggal_exp').value = item.tanggal_exp;
    document.getElementById('edit_alamat').value = item.alamat;
    document.getElementById('edit_status').value = item.status;
  }

  function closeEditModal() {
    document.getElementById('modalEdit').style.display = 'none';
  }

  function submitEdit() {
    let id = document.getElementById('edit_id').value;
    let form = document.getElementById('formEdit');
    let formData = new FormData(form);

    fetch(`/admin/industri/sertifikat-halal/${id}`, {
      method: 'POST', // Karena Laravel method PUT via _method
      headers: {
        'X-Requested-With': 'XMLHttpRequest',
        'X-CSRF-TOKEN': '{{ csrf_token() }}',
      },
      body: formData
    }).then(async response => {
      if (response.ok) {
        alert('Data berhasil diupdate');
        location.reload();
      } else {
        let errorData = await response.json();
        alert('Error: ' + JSON.stringify(errorData.errors || errorData.message));
      }
    }).catch(err => {
      alert('Terjadi kesalahan: ' + err);
    });
  }

  function deleteData(id) {
    if (!confirm('Yakin ingin menghapus data ini?')) return;

    fetch(`/admin/industri/sertifikat-halal/${id}`, {
      method: 'DELETE',
      headers: {
        'X-CSRF-TOKEN': '{{ csrf_token() }}',
        'X-Requested-With': 'XMLHttpRequest',
      }
    }).then(response => {
      if (response.ok) {
        alert('Data berhasil dihapus');
        document.getElementById('row-' + id).remove();
      } else {
        alert('Gagal menghapus data');
      }
    }).catch(() => alert('Terjadi kesalahan koneksi'));
  }
</script>

@endsection
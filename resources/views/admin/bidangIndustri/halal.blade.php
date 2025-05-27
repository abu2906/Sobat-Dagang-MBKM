@extends('layouts.admin')
@section('title', 'Sertifikat Halal')

@section('content')

<div class="container">
  <img src="{{ asset('/assets/img/background/user_industri.png') }}" alt="Banner" class="object-cover w-full h-48">

  <div class="flex items-center gap-4 px-6 py-6 max-w-7xl mx-auto z-10 relative">
    <div class="relative flex-1">
      <input type="text" x-model="searchQuery" placeholder="Cari"
        class="w-full rounded-xl bg-blue-200/80 py-3 pl-12 pr-4 text-gray-600 placeholder-gray-600 shadow-md focus:outline-none focus:ring-2 focus:ring-blue-400" />
      <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-500">
        <i class="fas fa-search"></i>
      </span>
    </div>

    <button @click="openAdd = true" class="bg-[#002B4E] text-white font-semibold rounded-xl px-6 py-3 shadow-md hover:brightness-110 transition" data-bs-toggle="modal" data-bs-target="#tambahModal">
      TAMBAH DATA
    </button>
  </div>

  <!-- Form Tambah Data -->
  <div x-data="{ open: false , openEdit: false, selectedItem: null }">
  <div x-show="openAdd" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">
    <div class="bg-white p-6 rounded shadow w-full max-w-lg">
      <h2 class="text-xl font-semibold mb-4">Tambah Sertifikat Halal</h2>
      <form action="{{ route('admin.industri.halal.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
          <div class="space-y-4">
            <input type="text" name="nama_usaha" placeholder="Nama Usaha" required>
            <input type="text" name="no_sertifikasi_halal" placeholder="No Sertifikat Halal">
            <input type="date" name="tanggal_sah" required>
            <input type="date" name="tanggal_exp" required>
            <input type="text" name="alamat" placeholder="Alamat" required>
            <select name="status" required>
              <option value="Berlaku">Berlaku</option>
              <option value="Perlu Pembaruan">Perlu Pembaruan</option>
            </select>
            <input type="file" name="sertifikat" accept="application/pdf" required>
          </div>
          <div class="flex justify-end mt-4 space-x-2">
            <button type="button" @click="open = false" class="px-4 py-2 bg-gray-300 rounded">Batal</button>
            <button type="submit" class="px-4 py-2 bg-green-500 text-white rounded">Simpan</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Tabel Data -->
  <section class="flex-1 px-6 pb-10 mt-1 overflow-x-auto scrollbar-thin scrollbar-thumb-gray-400 scrollbar-track-transparent z-10 relative">
    <div class="overflow-hidden rounded-xl">
  <table class="w-full text-sm table-auto ">
    <thead class="bg-[#0d3b66] text-white">
      <tr>
        <th class="px-4 py-3 font-semibold text-left">NO</th>
        <th class="px-4 py-3 font-semibold text-left">Nama Usaha</th>
        <th class="px-4 py-3 font-semibold text-left">No Sertifikat</th>
        <th class="px-4 py-3 font-semibold text-left">Tanggal Diterbitkan</th>
        <th class="px-4 py-3 font-semibold text-left">Berlaku Sampai</th>
        <th class="px-4 py-3 font-semibold text-left">Alamat</th>
        <th class="px-4 py-3 font-semibold text-left">Status</th>
        <th class="px-4 py-3 font-semibold text-left">Sertifikat</th>
        <th class="px-4 py-3 font-semibold text-left">Aksi</th>
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
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M15.232 5.232l3.536 3.536M9 13l6-6 3 3-6 6H9v-3z" />
            </svg>
          <button class="btn btn-sm btn-danger" onclick="deleteData({{ $item->id_halal }})class="text-red-600 hover:text-red-800" title="Hapus">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
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

  <!-- Modal Edit -->
  <div id="modalEdit" style="display:none; background: rgba(0,0,0,0.5); position: fixed; inset: 0; z-index: 1000;">
    <div style="background: white; max-width: 600px; margin: 50px auto; padding: 20px; border-radius: 8px; position: relative;">
      <h3 class="text-2xl font-bold mb-6 text-center">Edit Sertifikasi Halal</h3>
      <form id="formEdit" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <input type="hidden" id="edit_id" name="id_halal">

        <label class="block mb-1 font-semibold">Nama Usaha</label>
        <input type="text" id="edit_nama_usaha" name="nama_usaha" class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>

        <label class="block mb-1 font-semibold">Nomor Sertifikat Halal</label>
        <input type="text" id="edit_no_sertifikasi_halal" name="no_sertifikasi_halal" class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">

        <label class="block mb-1 font-semibold">Tanggal Sah</label>
        <input type="date" id="edit_tanggal_sah" name="tanggal_sah" class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>

        <label class="block mb-1 font-semibold">Tanggal Exp</label>
        <input type="date" id="edit_tanggal_exp" name="tanggal_exp" class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>

        <label class="block mb-1 font-semibold">Alamat</label>
        <input type="text" id="edit_alamat" name="alamat" class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"  required>

        <label class="block mb-1 font-semibold">Status</label>
        <select id="edit_status" name="status" class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
          <option value="Berlaku">Berlaku</option>
          <option value="Perlu Pembaruan">Perlu Pembaruan</option>
        </select>

        <label class="block mb-1 font-semibold">Sertifikat (PDF, optional - biarkan kosong jika tidak ingin ganti)</label>
        <input type="file" name="sertifikat" accept="application/pdf" class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">

        <div class="mt-4 flex justify-center gap-4">
          <button type="button" onclick="closeEditModal()" class="bg-red-600 text-white px-6 py-2 rounded hover:bg-red-700 transitio">Batal</button>
          <button type="button" onclick="submitEdit()" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700 transition">Simpan Perubahan</button>
        </div>
      </form>
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
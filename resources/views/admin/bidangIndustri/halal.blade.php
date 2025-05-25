@extends('layouts.admin')
@section('title', 'Sertifikat Halal')

@section('content')

<section 
  x-data="halalData()"
  class="relative"
>

  <img src="{{ asset('/assets/img/background/user_industri.png') }}" alt="Banner" class="object-cover w-full h-48">

  <div class="flex items-center gap-4 px-6 py-6 max-w-7xl mx-auto z-10 relative">
    <div class="relative flex-1">
      <input type="text" x-model="searchQuery" placeholder="Cari"
        class="w-full rounded-xl bg-blue-200/80 py-3 pl-12 pr-4 text-gray-600 placeholder-gray-600 shadow-md focus:outline-none focus:ring-2 focus:ring-blue-400" />
      <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-500">
        <i class="fas fa-search"></i>
      </span>
    </div>

    <button @click="openTambah()" type="button"
      class="bg-[#002B4E] text-white font-semibold rounded-xl px-6 py-3 shadow-md hover:brightness-110 transition">
      TAMBAH DATA
    </button>
  </div>

  <section class="flex-1 px-6 pb-10 mt-1 overflow-x-auto scrollbar-thin scrollbar-thumb-gray-400 scrollbar-track-transparent z-10 relative">
    <div class="overflow-hidden rounded-b-xl">
      <table class="w-full text-sm table-auto">
        <thead class="bg-[#0d3b66] text-white">
          <tr>
            <th class="px-4 py-3 font-semibold text-left">NO</th>
            <th class="px-4 py-3 font-semibold text-left">NAMA USAHA</th>
            <th class="px-4 py-3 font-semibold text-left">NO. SERTIFIKAT</th>
            <th class="px-4 py-3 font-semibold text-left">TANGGAL DITERBITKAN</th>
            <th class="px-4 py-3 font-semibold text-left">BERLAKU SAMPAI</th>
            <th class="px-4 py-3 font-semibold text-left">ALAMAT</th>
            <th class="px-4 py-3 font-semibold text-left">DOKUMEN</th>
            <th class="px-4 py-3 font-semibold text-left">AKSI</th>
          </tr>
        </thead>
        <tbody>
          <template x-if="filteredItems.length">
            <template x-for="(item, index) in filteredItems" :key="item.id_halal">
              <tr :class="index % 2 === 0 ? 'bg-gray-100' : 'bg-white'" class="border-b hover:bg-gray-50">
                <td class="px-4 py-3" x-text="index + 1"></td>
                <td class="px-4 py-3" x-text="item.nama_usaha"></td>
                <td class="px-4 py-3" x-text="item.no_sertifikasi_halal"></td>
                <td class="px-4 py-3" x-text="item.tanggal_sah_formatted"></td>
                <td class="px-4 py-3" x-text="item.tanggal_exp_formatted"></td>
                <td class="px-4 py-3" x-text="item.alamat"></td>
                <td class="px-4 py-3">
                  <a :href="'/storage/' + item.sertifikat" target="_blank" class="text-blue-600 hover:underline">
                    Lihat Sertifikat
                  </a>
                </td>
                <td class="px-4 py-3">
                  <div class="flex space-x-2">
                    <button type="button" @click="openEdit(item)" class="text-green-600 hover:text-green-800" title="Edit">
                      <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M15.232 5.232l3.536 3.536M9 13l6-6 3 3-6 6H9v-3z" />
                      </svg>
                    </button>

                    <form :action="'/admin/industri/halal/' + item.id_halal" method="POST"
                      @submit.prevent="if(confirm('Yakin ingin menghapus data ini?')) $el.submit()">
                      <input type="hidden" name="_token" value="{{ csrf_token() }}">
                      <input type="hidden" name="_method" value="DELETE">
                      <button type="submit" class="text-red-600 hover:text-red-800" title="Hapus">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                          stroke="currentColor">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M9 7h6m2 0H7m4-3h2a1 1 0 011 1v1H8V5a1 1 0 011-1z" />
                        </svg>
                      </button>
                    </form>
                  </div>
                </td>
              </tr>
            </template>
          </template>

          <template x-if="filteredItems.length === 0">
            <tr>
              <td colspan="8" class="text-center py-6 text-gray-500">Tidak ada data yang cocok.</td>
            </tr>
          </template>
        </tbody>
      </table>
    </div>
  </section>

  <!-- Overlay -->
  <div x-show="openModal" x-transition.opacity class="fixed inset-0 bg-black bg-opacity-50 backdrop-blur-sm z-40"></div>

  <!-- Modal -->
  <div x-show="openModal" x-transition class="fixed inset-0 flex items-start justify-center z-50 p-4">
    <div @click.away="openModal = false" @keydown.escape.window="openModal = false" tabindex="0"
      class="relative w-full max-w-3xl bg-white rounded-lg shadow-lg p-8 mt-24 overflow-auto max-h-[80vh]">
      <button @click="openModal = false" type="button" class="absolute top-4 right-4 text-2xl font-bold leading-none hover:text-gray-700 focus:outline-none">
        &times;
      </button>

      <h2 class="mb-6 text-center text-lg font-bold md:text-xl" x-text="formData.id ? 'EDIT DATA SERTIFIKASI HALAL' : 'TAMBAH DATA SERTIFIKASI HALAL'"></h2>
      <form 
        :action="formData.id 
            ? '{{ url('admin/industri/halal') }}/' + formData.id 
            : '{{ route('halal.store') }}'"
        method="POST"
        enctype="multipart/form-data"
        class="space-y-6"
      >
        @csrf
        <template x-if="formData.id">
          <input type="hidden" name="_method" value="PUT">
        </template>
          <div class="grid md:grid-cols-2 gap-6">
            <div class="space-y-5">
              <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                  <i class="fas fa-store mr-1 text-blue-600"></i> Nama Usaha
                </label>
                <input type="text" name="nama_usaha" x-model="formData.nama_usaha" required
                  class="w-full rounded-lg border border-gray-300 px-4 py-2 text-sm focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 shadow-sm placeholder-gray-400 transition">
              </div>

              <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                  <i class="fas fa-certificate mr-1 text-blue-600"></i> Nomor Sertifikasi Halal
                </label>
                <input type="text" name="no_sertifikasi_halal" x-model="formData.no_sertifikasi_halal"
                  class="w-full rounded-lg border border-gray-300 px-4 py-2 text-sm focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 shadow-sm transition">
              </div>

              <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                  <i class="fas fa-calendar-day mr-1 text-blue-600"></i> Tanggal Diterbitkan
                </label>
                <input type="date" name="tanggal_sah" x-model="formData.tanggal_sah" required
                  class="w-full rounded-lg border border-gray-300 px-4 py-2 text-sm focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 shadow-sm transition">
              </div>

              <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                  <i class="fas fa-calendar-check mr-1 text-blue-600"></i> Berlaku Sampai
                </label>
                <input type="date" name="tanggal_exp" x-model="formData.tanggal_exp" required
                  class="w-full rounded-lg border border-gray-300 px-4 py-2 text-sm focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 shadow-sm transition">
              </div>
            </div>

            <div class="space-y-5">
              <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                  <i class="fas fa-map-marker-alt mr-1 text-blue-600"></i> Alamat Usaha
                </label>
                <textarea name="alamat" x-model="formData.alamat" rows="2" required
                  class="w-full rounded-lg border border-gray-300 px-4 py-2 text-sm resize-y min-h-[48px] max-h-[150px] focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 shadow-sm placeholder-gray-400 transition"
                  placeholder="Masukkan alamat lengkap usaha"></textarea>
              </div>

              <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                  <i class="fas fa-toggle-on mr-1 text-blue-600"></i> Status Sertifikat
                </label>
                <select name="status" x-model="formData.status" required
                  class="w-full rounded-lg border border-gray-300 px-4 py-2 text-sm focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 shadow-sm transition">
                  <option value="" disabled selected>Pilih Status</option>
                  <option value="Berlaku">Berlaku</option>
                  <option value="Perlu Pembaruan">Perlu Pembaruan</option>
                </select>
              </div>

              <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                  <i class="fas fa-upload mr-1 text-blue-600"></i> Upload Sertifikat (PDF)
                </label>
                <input type="file" name="sertifikat" accept="application/pdf"
                  class="w-full rounded-lg border border-gray-300 px-4 py-2 text-sm focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 shadow-sm transition">
              </div>
            </div>
          </div>
        <div class="flex justify-center">
          <button type="submit"
            class="rounded-2xl bg-[#083458] px-8 py-3 text-white font-semibold shadow-md hover:shadow-lg transition duration-200">
            Simpan Data
          </button>
        </div>
      </form>
    </div>
  </div>
</section>
<script>
function halalData() {
  function formatDateToYMD(dateStr) {
    const d = new Date(dateStr);
    if (isNaN(d)) return '';
    const year = d.getFullYear();
    const month = String(d.getMonth() + 1).padStart(2, '0');
    const day = String(d.getDate()).padStart(2, '0');
    return `${year}-${month}-${day}`; 
  }

  return {
    openModal: false,
    searchQuery: '',
    originalData: @json($data),
    formData: {
      id: null,
      nama_usaha: '',
      no_sertifikasi_halal: '',
      tanggal_sah: '',
      tanggal_exp: '',
      alamat: '',
      status: '',
    },
    get filteredItems() {
      if (!this.searchQuery.trim()) return this.originalData;

      const q = this.searchQuery.toLowerCase();
      return this.originalData.filter(item =>
        (item.nama_usaha && item.nama_usaha.toLowerCase().includes(q)) ||
        (item.no_sertifikasi_halal && item.no_sertifikasi_halal.toLowerCase().includes(q)) ||
        (item.alamat && item.alamat.toLowerCase().includes(q))
      );
    },
    openEdit(data) {
      this.formData = {
        id: data.id_halal,
        nama_usaha: data.nama_usaha,
        no_sertifikasi_halal: data.no_sertifikasi_halal,
        tanggal_sah: formatDateToYMD(data.tanggal_sah),
        tanggal_exp: formatDateToYMD(data.tanggal_exp),
        alamat: data.alamat,
        status: data.status,
      };
      this.openModal = true;

      console.log('Edit Data:', JSON.parse(JSON.stringify(this.formData))); // opsional debug
    },
    openTambah() {
      this.formData = {
        id: null,
        nama_usaha: '',
        no_sertifikasi_halal: '',
        tanggal_sah: '',
        tanggal_exp: '',
        alamat: '',
        status: '',
      };
      this.openModal = true;
    },
  }
}
</script>
@endsection
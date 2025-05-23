@extends('layouts.admin')
@section('title', 'Detail Data Pemohon')

@section('content')
<div class="bg-white ">
<div class="bg-white">
    <div class="relative w-full">
        <img src="{{ asset('assets/img/background/dagang.jpg') }}" alt="Port Background" class="object-cover w-full h-64 md:h-full">
        <div class="absolute bottom-0 w-full -left-4 h-60 -z-10">
            <img src="{{ asset('assets/img/background/dagang.jpg') }}" alt="Background" class="object-cover w-full h-full -ml-16">
        </div>
        <a href="{{ route('perdagangan.kelolaSurat') }}"
            class="absolute flex items-center justify-center w-12 h-12 text-black transition-all duration-300 transform -translate-y-1/2 rounded-full shadow-lg left-14 top-1/2 bg-white/80 hover:bg-black hover:text-white hover:border-white hover:scale-110">
            <span class="text-2xl material-symbols-outlined">
                arrow_back
            </span>
        </a>
    </div>
    <div class="mt-6 mb-8">
        <h2 class="text-center text-3xl font-bold text-[#083358]">
            DETAIL DATA PEMOHON
        </h2>
    </div>
</div>

<div class="flex items-center justify-center min-h-screen bg-white">
    <div class="w-full max-w-2xl p-6 bg-white border border-gray-200 shadow-lg rounded-3xl">
        <div class="space-y-4 text-sm">
            <div class="grid grid-cols-2 bg-[#ABBED1] p-4 rounded-md">
                <div class="font-semibold text-black">Nama Lengkap</div>
                <div>{{ $user->nama ?? 'Null' }}</div>
            </div>
            <div class="grid grid-cols-2 p-4">
                <div class="font-semibold text-black">Jenis Kelamin</div>
                <div>{{ $user->jenis_kelamin ?? 'Null' }}</div>
            </div>
            <div class="grid grid-cols-2 bg-[#ABBED1] p-4 rounded-md">
                <div class="font-semibold text-black">Nomor Telepon</div>
                <div>{{ $user->telp ?? 'Null' }}</div>
            </div>
            <div class="grid grid-cols-2 p-4">
                <div class="font-semibold text-black">Email</div>
                <div>{{ $user->email ?? 'Null' }}</div>
            </div>

            {{-- Tanggal Masuk --}}
            <div class="grid grid-cols-2 bg-[#ABBED1] p-4 rounded-md">
                <div class="font-semibold text-black">Tanggal Masuk</div>
                <div>
                    {{ $data && $data->created_at ? \Carbon\Carbon::parse($data->created_at)->format('d-m-Y') : 'Tidak tersedia' }}
                </div>
            </div>

            {{-- Jenis Surat --}}
            <div class="grid grid-cols-2 p-4">
                <div class="font-semibold text-black">Jenis Surat</div>
                @php
                $jenisSuratMap = [
                'surat_rekomendasi_perdagangan' => 'Surat Rekomendasi',
                'surat_keterangan_perdagangan' => 'Surat Keterangan',
                'dan_lainnya_perdagangan' => 'Surat Lainnya',
                ];
                @endphp
                <div>{{ $jenisSuratMap[$data->jenis_surat] ?? 'Tidak tersedia' }}</div>
            </div>

            {{-- Titik Koordinat --}}
            <div class="grid grid-cols-2 bg-[#ABBED1] p-4 rounded-md">
                <div class="font-semibold text-black">Titik Koordinat</div>
                <div>{{ $data->titik_koordinat ?? 'Tidak tersedia' }}</div>
            </div>

            <!-- Dokumen NPWP -->
            <div class="grid grid-cols-2 p-4">
                <div class="font-semibold text-black">Dokumen NPWP</div>
                <div>
                    @if ($dokumen && $dokumen->npwp)
                    <a href="{{ route('dokumen.view', ['id' => $dokumen->id_permohonan, 'type' => 'NPWP']) }}" target="_blank"
                        class="inline-block w-full px-3 py-2 text-xs text-center bg-gray-200 rounded-md shadow-md hover:bg-gray-300">
                        📄 Lihat NPWP
                    </a>
                    @else
                    <span class="text-red-500">Tidak tersedia</span>
                    @endif
                </div>
            </div>

            <!-- Akta Perusahaan -->
            <div class="grid grid-cols-2 bg-[#ABBED1] p-4 rounded-md">
                <div class="font-semibold text-black">Akta Perusahaan</div>
                <div>
                    @if ($dokumen && $dokumen->akta_perusahaan)
                    <a href="{{ route('dokumen.view', ['id' => $dokumen->id_permohonan, 'type' => 'AKTA']) }}" target="_blank"
                        class="inline-block w-full px-3 py-2 text-xs text-center bg-gray-200 rounded-md shadow-md hover:bg-gray-300">
                        📄 Lihat Akta
                    </a>
                    @else
                    <span class="text-red-500">Tidak tersedia</span>
                    @endif
                </div>
            </div>

            <!-- Dokumen NIB -->
            <div class="grid grid-cols-2 p-4">
                <div class="font-semibold text-black">Dokumen NIB</div>
                <div>
                    @if ($dokumen && $dokumen->dokument_nib)
                    <a href="{{ route('dokumen.view', ['id' => $dokumen->id_permohonan, 'type' => 'NIB']) }}" target="_blank"
                        class="inline-block w-full px-3 py-2 text-xs text-center bg-gray-200 rounded-md shadow-md hover:bg-gray-300">
                        📄 Lihat NIB
                    </a>
                    @else
                    <span class="text-red-500">Tidak tersedia</span>
                    @endif
                </div>
            </div>

            <!-- Foto KTP -->
            <div class="grid grid-cols-2 bg-[#ABBED1] p-4 rounded-md">
                <div class="font-semibold text-black">Foto KTP</div>
                <div>
                    @if ($dokumen && $dokumen->foto_ktp)
                    <a href="{{ route('dokumen.view', ['id' => $dokumen->id_permohonan, 'type' => 'KTP']) }}" target="_blank"
                        class="inline-block w-full px-3 py-2 text-xs text-center bg-gray-200 rounded-md shadow-md hover:bg-gray-300">
                        🖼️ Lihat KTP
                    </a>
                    @else
                    <span class="text-red-500">Tidak tersedia</span>
                    @endif
                </div>
            </div>

            <!-- Foto Usaha -->
            <div class="grid grid-cols-2 p-4">
                <div class="font-semibold text-black">Foto Usaha</div>
                <div>
                    @if ($dokumen && $dokumen->foto_usaha)
                    <a href="{{ route('dokumen.view', ['id' => $dokumen->id_permohonan, 'type' => 'USAHA']) }}" target="_blank"
                        class="inline-block w-full px-3 py-2 text-xs text-center bg-gray-200 rounded-md shadow-md hover:bg-gray-300">
                        🖼️ Lihat Usaha
                    </a>
                    @else
                    <span class="text-red-500">Tidak tersedia</span>
                    @endif
                </div>
            </div>
            <!-- Foto KTP -->
            <div class="grid grid-cols-2 bg-[#ABBED1] p-4 rounded-md">
                <div class="font-semibold text-justify text-black">File Surat</div>
                <div>
                    @if ($dokumen && $dokumen->foto_ktp)
                    <a href="{{ route('dokumen.view', ['id' => $dokumen->id_permohonan, 'type' => 'SURAT']) }}" target="_blank"
                        class="inline-block w-full px-3 py-2 text-xs text-center bg-gray-200 rounded-md shadow-md hover:bg-gray-300">
                        🖼️ Lihat File Surat
                    </a>
                    @else
                    <span class="text-red-500">Tidak tersedia</span>
                    @endif
                </div>
            </div>

            @if (!in_array($data->status, ['ditolak', 'diterima']))
            <div class="flex justify-center gap-6 mt-8">
                <form action="" method="POST" class="w-full">
                    @csrf
                    <button
                        onclick="handleSetujuClick(this)"
                        type="button"
                        class="w-full py-3 text-black transition duration-300 bg-white border border-black rounded-full hover:bg-gray-200"
                        data-modal="{{ $data->jenis_surat === 'surat_rekomendasi_perdagangan' ? 'modalRekomendasi' : ($data->jenis_surat === 'surat_keterangan_perdagangan' ? 'modalKeterangan' : '') }}">
                        Setuju
                    </button>
                </form>

                <button type="button" onclick="openModal('modaltolak')"
                    class="w-full py-3 rounded-full bg-[#083358] text-white hover:text-black hover:bg-blue-300 transition duration-300">
                    Tolak
                </button>
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
            <!-- Modal Surat Rekomendasi -->
            <div id="modalRekomendasi" class="fixed inset-0 z-50 flex items-center justify-center hidden w-full px-4 bg-black bg-opacity-50">
                <form action="{{ route('permohonan.rekomendasi', $data->id_permohonan) }}" method="POST">
                    <div class="bg-white w-full max-w-xl max-h-[90vh] overflow-y-auto p-6 rounded-lg relative scrollbar-none" style="scrollbar-width: none;">
                        <button type="button" class="absolute text-xl text-gray-600 top-2 right-2" onclick="closeModal('modalRekomendasi')">&times;</button>
                        <h2 class="mb-4 text-lg font-bold text-center">FORMULIR SURAT REKOMENDASI</h2>
                        <div class="grid grid-cols-2 gap-4 text-sm">
                            @csrf
                            @method('PUT')
                            <div>
                            <label>Nomor Surat</label>
                            <input name="nomor_surat" type="text" class="w-full px-3 py-2 border rounded">
                        </div>
                        <div>
                            <label>Tanggal Surat</label>
                            <input name="tanggal_surat" type="date" class="w-full px-3 py-2 border rounded">
                        </div>
                        <div>
                            <label>Nama Pemohon</label>
                            <input name="nama_pengirim" type="text" class="w-full px-3 py-2 border rounded" value="{{ old('nama_pengirim', $user->nama ?? 'Null') }}" >
                        </div>
                        <div>
                            <label>NIK</label>
                            <input name="nik" type="text" class="w-full px-3 py-2 border rounded" value="{{ old('nama_pengirim', $user->nik ?? 'Null') }}">
                        </div>
                        <div>
                            <label>Warga Negara</label>
                            <select name="warga_negara" class="w-full px-3 py-2 border rounded">
                                <option value="">Pilih</option>
                                <option>WNI</option>
                                <option>WNA</option>
                            </select>
                        </div>
                        <div>
                            <label>Pekerjaan</label>
                            <input name="pekerjaan" type="text" class="w-full px-3 py-2 border rounded">
                        </div>
                        <div>
                            <label>Alamat Rumah</label>
                            <input name="alamat_rumah" type="text" class="w-full px-3 py-2 border rounded">
                        </div>

                        <div>
                            <label>Nama Usaha</label>
                            <input name="nama_usaha" type="text" class="w-full px-3 py-2 border rounded">
                        </div>
                        <div>
                            <label>Bentuk Usaha</label>
                            <input name="bentuk_usaha" type="text" class="w-full px-3 py-2 border rounded">
                        </div>
                        <div>
                            <label>Jenis Perusahaan</label>
                            <select name="jenis_perusahaan" class="w-full px-3 py-2 border rounded">
                                <option value="">Pilih</option>
                                <option>Perusahaan Perseorangan</option>
                                <option>Persekutuan Firma</option>
                                <option>CV</option>
                                <option>PT</option>
                                <option>Koperasi</option>
                                <option>BUMN</option>
                                <option>BUMD</option>
                                <option>Asing</option>
                            </select>
                        </div>
                        <div>
                            <label>Luas Ruangan (m<sup>2</sup>)</label>
                            <input name="luas_ruangan" type="text" class="w-full px-3 py-2 border rounded">
                        </div>
                        <div>
                            <label class="block mb-1 text-sm font-semibold">Alamat Usaha</label>
                            <input name="alamat_usaha" type="text" class="w-full px-3 py-2 border rounded">
                        </div>
                        <div class="col-span-2">
                            <label class="block mb-1 text-sm font-semibold">Keterangan Surat</label>
                            <textarea name="isi" id="summernote_rekomendasi" class="w-full px-3 py-2 border rounded " rows="3" required required></textarea>
                        </div>
                        </div>
                        <div class="flex justify-center gap-3 mt-4">
                            <button class="px-4 py-2 text-white bg-gray-700 rounded">Draft</button>
                            <button class="bg-[#083358] text-white hover:bg-blue-300 hover:text-black px-4 py-2 rounded">Simpan</button>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Modal Surat Keterangan -->
            <div id="modalKeterangan" class="fixed inset-0 z-50 flex items-center justify-center hidden px-4 bg-black bg-opacity-50">
                <form action="{{ route('permohonan.keterangan', $data->id_permohonan) }}" method="POST">
                    <div class="bg-white w-full max-w-xl max-h-[90vh] overflow-y-auto p-6 rounded-lg relative scrollbar-none" style="scrollbar-width: none;">
                        <button type="button" class="absolute text-xl text-gray-600 top-2 right-2" onclick="closeModal('modalKeterangan')">&times;</button>
                        <h2 class="mb-4 text-lg font-bold text-center">FORMULIR SURAT KETERANGAN</h2>
                        <div class="grid grid-cols-2 gap-4 text-sm">
                            @csrf
                            @method('PUT')
                            <div>
                                <label class="block mb-1 text-sm font-semibold">Tanggal Surat</label>
                                <input name="tanggal_surat" type="date" class="w-full px-3 py-2 border rounded">
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-semibold">Nama Pemohon Surat</label>
                                <input name="nama_pengirim" type="text" class="w-full px-3 py-2 border rounded">
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-semibold">Jabatan</label>
                                <input name="jabatan" type="text" class="w-full px-3 py-2 border rounded">
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-semibold">Nama Penerima</label>
                                <input name="nama_penerima" type="text" class="w-full px-3 py-2 border rounded" value="{{ old('nama_pengirim', $user->nama ?? 'Null') }}">
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-semibold">Tempat Lahir</label>
                                <input name="tampat_lahir" type="text" class="w-full px-3 py-2 border rounded">
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-semibold">Tanggal Lahir</label>
                                <input name="tanggal_lahir" type="date" class="w-full px-3 py-2 border rounded">
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-semibold">Jenis Kelamin</label>
                                <select name="jenis_kelamin" class="w-full px-3 py-2 border rounded">
                                    <option value="">Pilih</option>
                                    <option value="Laki-laki" {{ old('jenis_kelamin', $user->jenis_kelamin ?? '') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                    <option value="Perempuan" {{ old('jenis_kelamin', $user->jenis_kelamin ?? '') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                </select>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-semibold">Alamat Lengkap</label>
                                <input name="alamat_lengkap" type="text" class="w-full px-3 py-2 border rounded" value="{{ old('nama_pengirim', $user->alamat_lengkap ?? 'Null') }}">
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-semibold">Agama</label>
                                <input name="agama" type="text" class="w-full px-3 py-2 border rounded">
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-semibold">Status Pernikahan</label>
                                <select name="status_pernikahan" class="w-full px-3 py-2 border rounded">
                                    <option value="">Pilih</option>
                                    <option>Menikah</option>
                                    <option>Belum Menikah</option>
                                </select>
                            </div>
                            <div class="col-span-2">
                                <label class="block mb-1 text-sm font-semibold">Keterangan Surat</label>
                                <textarea name="isi" id="summernote_edit" class="w-full px-3 py-2 border rounded" rows="3" required required></textarea>
                            </div>
                        </div>
                        <div class="flex justify-center gap-3 mt-4">
                            <button class="px-4 py-2 text-white bg-gray-700 rounded">Draft</button>
                            <button class="bg-[#083358] text-white hover:bg-blue-300 hover:text-black px-4 py-2 rounded">Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
            <!-- Modal Surat Keterangan DItolak -->
            <div id="modaltolak" class="fixed inset-0 z-50 flex items-center justify-center hidden px-4 bg-black bg-opacity-50">
                <form action="{{ route('permohonan.tolak', $data->id_permohonan) }}" method="POST" class="relative w-full max-w-xl p-6 bg-white rounded-lg">
                    @csrf
                    @method('PUT')

                    <button type="button" class="absolute text-xl text-gray-600 top-2 right-2" onclick="closeModal('modaltolak')">&times;</button>
                    <h2 class="mb-4 text-lg font-bold text-center">Formulir SURAT DI TOLAK</h2>

                    <div class="grid grid-cols-2 gap-x-6 gap-y-4">
                        <div class="col-span-2">
                            <label class="block mb-1 text-sm font-semibold">Nama Pemohon</label>
                            <input name="nama_pengirim" type="text" class="w-full px-3 py-2 border rounded" value="{{ old('nama_pengirim', $user->nama ?? 'Null') }}">
                        </div>
                        <div class="col-span-2">
                            <label class="block mb-1 text-sm font-semibold">Alasan Penolakan</label>
                            <textarea name="alasan" id="summernote_tolak" class="w-full px-3 py-2 border rounded" rows="3" required required></textarea>
                        </div>
                        <div class="col-span-2">
                            <label class="block mb-1 text-sm font-semibold">Tanggal Surat</label>
                            <input name="tanggal" type="date" class="w-full px-3 py-2 border rounded">
                        </div>
                    </div>

                    <div class="flex justify-center gap-4 mt-6">
                        <button type="submit" class="bg-[#083358] text-white hover:bg-blue-300 hover:text-black px-4 py-2 rounded">
                            Kirim
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
            <script>
                $(document).ready(function() {
                    $("#summernote_edit").summernote({
                        tabsize: 2,
                        height: 150,
                        toolbar: [
                            ["style", ["bold", "italic", "underline", "clear"]],
                            ["fontsize", ["fontsize"]],
                            ["color", ["color"]],
                            ["para", ["ul", "ol", "paragraph"]],
                        ],
                    });
                });

                $(document).ready(function() {
                    $("#summernote_rekomendasi").summernote({
                        tabsize: 2,
                        height: 150,
                        toolbar: [
                            ["style", ["bold", "italic", "underline", "clear"]],
                            ["fontsize", ["fontsize"]],
                            ["color", ["color"]],
                            ["para", ["ul", "ol", "paragraph"]],
                        ],
                    });
                });

                $(document).ready(function() {
                    $("#summernote_tolak").summernote({
                        tabsize: 2,
                        height: 150,
                        toolbar: [
                            ["style", ["bold", "italic", "underline", "clear"]],
                            ["fontsize", ["fontsize"]],
                            ["color", ["color"]],
                            ["para", ["ul", "ol", "paragraph"]],
                        ],
                    });
                });

                function handleSetujuClick(button) {
                    const modalId = button.getAttribute('data-modal');
                    if (modalId) {
                        openModal(modalId);
                    } else {
                        alert('Jenis surat tidak dikenali atau belum didukung.');
                    }
                }

                function openModal(id) {
                    const modal = document.getElementById(id);
                    if (modal) {
                        modal.classList.remove('hidden');
                    }
                }

                function closeModal(id) {
                    const modal = document.getElementById(id);
                    if (modal) {
                        modal.classList.add('hidden');
                    }
                }
            </script>
@endsection
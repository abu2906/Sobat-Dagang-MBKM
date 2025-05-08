<div x-data="{ showProfileMenu: true }"
     x-show="showProfile"
     x-transition
     @click.outside="showProfile = false"
     class="fixed top-[70px] right-0 w-[350px] h-[700px] bg-white shadow-2xl z-50 rounded-l-2xl overflow-hidden flex flex-col">

    <!-- Header -->
<div x-show="showProfileMenu" x-transition
    class="bg-blue-100 flex items-center px-4 py-2 rounded-tl-2xl">
   <button @click="showProfile = false"
       class="w-8 h-8 flex items-center justify-center rounded-full bg-white border border-gray-300 text-gray-700 hover:bg-blue-200 transition">
       &times;
   </button>
</div>

    <!-- Konten Awal: Menu Profil -->
    <div x-show="showProfileMenu" class="flex-1 p-6 overflow-y-auto text-center">

        <h2 class="text-base text-lg p-2 font-semibold text-black">Profile Anda</h2>

        <!-- Avatar -->
        <img src="{{ asset(Auth::user()->avatar) }}" class="w-24 h-24 rounded-full mx-auto" alt="Foto Profil">      

        <!-- Nama & Email -->
        <h3 class="mt-4 font-bold text-lg text-black">{{ Auth::user()->nama ?? '-' }}</h3>
        <p class="text-sm text-gray-600">{{ Auth::user()->email ?? '-' }}</p>

        <!-- Menu -->
        <div class="mt-6 space-y-4 text-left">
            <!-- Data Pribadi -->
            <a @click="showProfileMenu = false"
               class="flex items-center justify-between hover:bg-gray-100 p-2 rounded-lg cursor-pointer">
                <div class="flex items-center gap-2">
                    <i class="fa fa-user text-black text-sm"></i>
                    <span class="text-black text-sm">Data Pribadi</span>
                </div>
                <span class="text-black">›</span>
            </a>

            <!-- Ubah Kata Sandi -->
            <a href="{{ route('change.password') }}"
               class="flex items-center justify-between hover:bg-gray-100 p-2 rounded-lg">
                <div class="flex items-center gap-2">
                    <i class="fa fa-key text-black text-sm"></i>
                    <span class="text-black text-sm">Ubah Kata Sandi</span>
                </div>
                <span class="text-black">›</span>
            </a>
        </div>

        <!-- Logout -->
        <form method="POST" action="{{ route('logout') }}" class="pt-6 pl-2">
            @csrf
            <button type="submit"
                class="border border-black text-black rounded-full px-3 py-1.5 flex items-center gap-2 hover:bg-gray-100 transition text-sm font-semibold">
                <span>Keluar</span>
                <i class="bg-white fas fa-right-from-bracket text-black text-sm"></i>
            </button>
        </form>
    </div>

    <!-- Konten: Form Data Pribadi -->
    <div x-show="!showProfileMenu" x-transition class="flex-1 overflow-y-auto">
        <!-- Header -->
    <div x-show="!showProfileMenu" x-transition
        class="bg-blue-100 flex items-center px-4 py-2 rounded-tl-2xl">
       <button @click="showProfileMenu = true"
           class="w-8 h-8 flex items-center justify-center rounded-full bg-white border border-gray-300 text-gray-700 hover:bg-blue-200 transition">
           <i class="fas fa-chevron-left text-sm"></i>
       </button>
       <span class="ml-2 font-semibold text-sm text-gray-800">Kembali</span>
   </div>
    
     <!-- Konten Profil -->
    <div class="p-4 text-center">
        <h2 class="font-bold text-lg mb-2 text-black">Profile Anda</h2>
        <img src="{{ asset(Auth::user()->avatar) }}" class="w-24 h-24 rounded-full mx-auto mb-2" alt="Foto Profil">
        <h3 class="font-semibold text-md text-black">{{ Auth::user()->nama }}</h3>
        <p class="text-black text-sm">{{ Auth::user()->email }}</p>
    
        <button class="bg-[#002b49] text-white text-sm px-4 py-1 rounded-full mt-3">Edit</button>
    </div>

        <!-- Form -->
        <form action="{{ route('profile.update') }}" method="POST" class="space-y-4 px-4 pb-6 text-sm text-black">
            @csrf
            @method('PUT')
        
            <div>
                <label class="block text-sm font-semibold mb-1 text-black">Nama Lengkap</label>
                <input type="text" name="nama" value="{{ old('nama', Auth::user()->nama) }}" class="w-full border rounded-full px-4 py-2 text-sm text-black">
            </div>

                 <div>
                    <label class="block text-sm font-semibold mb-1 text-black">Kabupaten</label>
                    <select id="kabupaten" name="kabupaten" class="w-full border rounded-full px-4 py-2 text-sm text-black">
                        @foreach($wilayah['kabupaten'] ?? [] as $kabupaten)
                            <option value="{{ $kabupaten['name'] }}" {{ old('kabupaten') == $kabupaten['name'] ? 'selected' : '' }}>
                                {{ $kabupaten['name'] }}
                            </option>
                        @endforeach
                    </select>
                </div>
                
                <div>
                    <label class="block text-sm font-semibold mb-1 text-black">Kecamatan</label>
                    <select id="kecamatan" name="kecamatan" class="w-full border rounded-full px-4 py-2 text-sm text-black" {{ old('kabupaten') ? '' : 'disabled' }}>
                        @foreach($wilayah['kabupaten'] ?? [] as $kabupaten)
                            @if(old('kabupaten') == $kabupaten['name'])  <!-- Cek jika kabupaten yang dipilih cocok -->
                                @foreach($kabupaten['kecamatan'] as $kecamatan)
                                    <option value="{{ $kecamatan['name'] }}" {{ old('kecamatan') == $kecamatan['name'] ? 'selected' : '' }}>
                                        {{ $kecamatan['name'] }}
                                    </option>
                                @endforeach
                            @endif
                        @endforeach
                    </select>
                </div>
                
                
                <div>
                    <label class="block text-sm font-semibold mb-1 text-black">Kelurahan</label>
                    <select id="kelurahan" name="kelurahan" class="w-full border rounded-full px-4 py-2 text-sm text-black" {{ old('kecamatan') ? '' : 'disabled' }}>
                        @foreach($wilayah['kabupaten'] ?? [] as $kabupaten)
                            @foreach($kabupaten['kecamatan'] as $kecamatan)
                                @if(old('kecamatan') == $kecamatan['name'])
                                    @foreach($kecamatan['kelurahan'] as $kelurahan)
                                        <option value="{{ $kelurahan }}" {{ old('kelurahan') == $kelurahan ? 'selected' : '' }}>
                                            {{ $kelurahan }}
                                        </option>
                                    @endforeach
                                @endif
                            @endforeach
                        @endforeach
                    </select>
                </div>
                
            


            <div>
                 <label class="block text-sm font-semibold mb-1 text-black">Alamat Lengkap</label>
                 <input type="text" name="alamat_lengkap" value="{{ old('alamat_lengkap', Auth::user()->alamat_lengkap) }}" class="w-full border rounded-full px-4 py-2 text-sm text-black">
            </div>
        
            <div>
                <label class="block text-sm font-semibold mb-1 text-black">Email Aktif</label>
                <input type="email" name="email" value="{{ old('email', Auth::user()->email) }}" class="w-full border rounded-full px-4 py-2 text-sm text-black">
            </div>
        
            <div>
                <label class="block text-sm font-semibold mb-1 text-black">Nomor HP/Telepon</label>
                <input type="text" name="telp" value="{{ old('telp', Auth::user()->telp) }}" class="w-full border rounded-full px-4 py-2 text-sm text-black">
            </div>
        
            <div>
                <label class="block text-sm font-semibold mb-1 text-black">NIB (Nomor Induk Berusaha)</label>
                <input type="text" name="nib" value="{{ old('nib', Auth::user()->nib) }}" class="w-full border rounded-full px-4 py-2 text-sm text-black">
            </div>
        
            <div>
                <label class="block text-sm font-semibold mb-1 text-black">NIK (Nomor Induk Kependudukan)</label>
                <input type="text" name="nik" value="{{ old('nik', Auth::user()->nik) }}" class="w-full border rounded-full px-4 py-2 text-sm text-black">
            </div>
        
            <div>
                <label class="block text-sm font-semibold mb-1 text-black">Jenis Kelamin</label>
                <select name="jenis_kelamin" class="w-full border rounded-full px-4 py-2 text-sm text-black">
                    <option value="Laki-laki" {{ Auth::user()->jenis_kelamin == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                    <option value="Perempuan" {{ Auth::user()->jenis_kelamin == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                </select>
            </div>
        
            <button type="submit" class="w-[150px] block mx-auto bg-secondary hover:bg-[var(--secondary-dark) text-white rounded-full py-2 font-semibold">
                Simpan
            </button>

            <script>
                const dataWilayah = @json($wilayah['kabupaten'] ?? []); // Ambil data wilayah
            
                const kabupatenSelect = document.getElementById('kabupaten');
                const kecamatanSelect = document.getElementById('kecamatan');
                const kelurahanSelect = document.getElementById('kelurahan');
            
                kabupatenSelect.addEventListener('change', function() {
                    const selectedKabupaten = dataWilayah.find(kab => kab.name === this.value);
                    kecamatanSelect.innerHTML = ''; // Reset kecamatan
                    kelurahanSelect.innerHTML = ''; // Reset kelurahan
                    kelurahanSelect.disabled = true;
            
                    if (selectedKabupaten) {
                        selectedKabupaten.kecamatan.forEach(kecamatan => {
                            const option = document.createElement('option');
                            option.value = kecamatan.name;
                            option.textContent = kecamatan.name;
                            kecamatanSelect.appendChild(option);
                        });
                        kecamatanSelect.disabled = false;
                    }
                });
            
                kecamatanSelect.addEventListener('change', function() {
                    const selectedKabupaten = dataWilayah.find(kab => kab.name === kabupatenSelect.value);
                    const selectedKecamatan = selectedKabupaten?.kecamatan.find(kec => kec.name === this.value);
            
                    kelurahanSelect.innerHTML = ''; // Reset kelurahan
                    kelurahanSelect.disabled = true;
            
                    if (selectedKecamatan) {
                        selectedKecamatan.kelurahan.forEach(kelurahan => {
                            const option = document.createElement('option');
                            option.value = kelurahan;
                            option.textContent = kelurahan;
                            kelurahanSelect.appendChild(option);
                        });
                        kelurahanSelect.disabled = false;
                    }
                });
            
                // Trigger perubahan saat halaman dimuat untuk menampilkan data yang sudah ada
                window.onload = function() {
                    kabupatenSelect.dispatchEvent(new Event('change')); // Update kecamatan
                    kecamatanSelect.dispatchEvent(new Event('change')); // Update kelurahan
                };
            </script>
            
            
            
        </form>

    </div>
    
</div>

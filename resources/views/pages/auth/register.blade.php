<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Daftar - Sobat Dagang</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('/css/app.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
</head>

<body class="flex h-screen font-sans bg-primary">
    <div class="flex flex-col w-full h-full sm:flex-row">

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
        <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
        </head>

        <body class="flex h-screen font-sans bg-primary">
            <div class="flex flex-col w-full h-full sm:flex-row">

                <!-- Kiri-->
                <div class="w-full sm:w-2/3 bg-white p-8 flex flex-col justify-center items-center 
        rounded-[40px] sm:rounded-br-[40px] sm:rounded-tr-[40px] sm:rounded-tl-none sm:rounded-bl-none shadow-xl">

                    <h3 class="mb-6 text-2xl font-bold text-center">Daftar ke Akun Anda</h3>

                    @if(session('success'))
                    <div class="relative px-4 py-3 mb-4 text-green-700 bg-green-100 border border-green-400 rounded">
                        {{ session('success') }}
                    </div>
                    @endif

                    <form method="POST" action="{{ route('register.submit') }}" class="w-full max-w-2xl">
                        @csrf

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-6 gap-y-4">
                            <!-- Nama Lengkap -->
                            <div>
                                <label class="block mb-1 font-semibold">Nama Lengkap</label>
                                <input type="text" name="nama" placeholder="Masukkan Nama Lengkap Anda"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-full shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                            </div>


                            <!-- Jenis Kelamin -->
                            <div class="block sm:mb-1">
                                <label class="block mb-1 font-semibold">Jenis Kelamin</label>
                                <div class="flex items-center gap-6 mt-1">
                                    <label class="flex items-center gap-2">
                                        <input type="radio" name="jenis_kelamin" value="Laki-laki" class="accent-blue-500" required>
                                        <span>Laki-Laki</span>
                                    </label>
                                    <label class="flex items-center gap-2">
                                        <input type="radio" name="jenis_kelamin" value="Perempuan" class="accent-blue-500">
                                        <span>Perempuan</span>
                                    </label>
                                </div>
                            </div>

                            <!-- Kabupaten -->
                            <div class="form-group">
                                <label class="block mb-1 font-semibold">Kabupaten/Kota</label>
                                <select id="kabupaten" name="kabupaten" class="w-full px-4 py-2 border border-gray-300 rounded-full shadow-sm form-control focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                                    <option value="">Pilih Kabupaten</option>
                                    @foreach ($wilayah['kabupaten'] as $kab)
                                    <option value="{{ $kab['name'] }}">{{ $kab['name'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <!-- Email -->
                            <div>
                                <label class="block mb-1 font-semibold">Email</label>
                                <input type="email" name="email" placeholder="Masukkan Email"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-full shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                            </div>

                            <!-- Kecamatan -->
                            <div class="form-group">
                                <label class="block mb-1 font-semibold">Kecamatan</label>
                                <select id="kecamatan" name="kecamatan" class="w-full px-4 py-2 border border-gray-300 rounded-full shadow-sm form-control focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                                    <option value="">--Pilih Kecamatan--</option>
                                </select>
                            </div>
                            <!-- No HP -->
                            <div>
                                <label class="block mb-1 font-semibold">Nomor HP</label>
                                <input type="text" name="telp" placeholder="Masukkan Nomor HP"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-full shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                            </div>
                            <!-- Kelurahan -->
                            <div class="form-group">
                                <label class="block mb-1 font-semibold">Kelurahan</label>
                                <select id="kelurahan" name="kelurahan" class="w-full px-4 py-2 border border-gray-300 rounded-full shadow-sm form-control focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                                    <option value="">-- Pilih Kelurahan --</option>
                                </select>
                            </div>
                            <script>
                                const dataWilayah = @json($wilayah['kabupaten']);

                                const kabupatenSelect = document.getElementById('kabupaten');
                                const kecamatanSelect = document.getElementById('kecamatan');
                                const kelurahanSelect = document.getElementById('kelurahan');

                                kabupatenSelect.addEventListener('change', function() {
                                    const selectedKab = dataWilayah.find(kab => kab.name === this.value);
                                    kecamatanSelect.innerHTML = '<option value="">Pilih Kecamatan</option>';
                                    kelurahanSelect.innerHTML = '<option value="">Pilih Kelurahan</option>';
                                    kelurahanSelect.disabled = true;

                                    if (selectedKab) {
                                        selectedKab.kecamatan.forEach(kec => {
                                            const opt = document.createElement('option');
                                            opt.value = kec.name;
                                            opt.textContent = kec.name;
                                            kecamatanSelect.appendChild(opt);
                                        });
                                        kecamatanSelect.disabled = false;
                                    } else {
                                        kecamatanSelect.disabled = true;
                                    }
                                });

                                kecamatanSelect.addEventListener('change', function() {
                                    const selectedKab = dataWilayah.find(kab => kab.name === kabupatenSelect.value);
                                    const selectedKec = selectedKab?.kecamatan.find(kec => kec.name === this.value);

                                    kelurahanSelect.innerHTML = '<option value="">Pilih Kelurahan</option>';

                                    if (selectedKec) {
                                        selectedKec.kelurahan.forEach(kel => {
                                            const opt = document.createElement('option');
                                            opt.value = kel;
                                            opt.textContent = kel;
                                            kelurahanSelect.appendChild(opt);
                                        });
                                        kelurahanSelect.disabled = false;
                                    } else {
                                        kelurahanSelect.disabled = true;
                                    }
                                });
                            </script>



                            <!-- Password -->
                            <div>
                                <label class="block mb-1 font-semibold">Kata Sandi</label>
                                <input type="password" name="password" placeholder="Masukkan Kata Sandi"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-full shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                            </div>

                            <!-- Alamat -->
                            <div>
                                <label class="block mb-1 font-semibold">Alamat</label>
                                <input type="text" name="alamat_lengkap" placeholder="Masukkan Alamat Anda"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-full shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                            </div>

                            <!-- Konfirmasi Password -->
                            <div>
                                <label class="block mb-1 font-semibold">Konfirmasi Kata Sandi</label>
                                <input type="password" name="password_confirmation" placeholder="Ulangi Kata Sandi"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-full shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                            </div>

                            <!-- NIK -->
                            <div>
                                <label class="block mb-1 font-semibold">NIK (Nomor Induk Kependudukan)</label>
                                <input type="text" name="nik" placeholder="Masukkan NIK Anda"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-full shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                            </div>

                            <!-- NIB -->
                            <div>
                                <label class="block mb-1 font-semibold">NIB (Nomor Induk Berusaha)</label>
                                <input type="text" name="nib" placeholder="Masukkan NIB Anda (Opsional)"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-full shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                            </div>
                        </div>
                        <!-- Tombol -->
                        <div class="flex justify-center col-span-2 mt-6">
                            <button type="submit"
                                class="w-[150px] bg-secondary hover:bg-secondary-dark text-white font-semibold py-2 rounded-full shadow transition duration-200">
                                Daftar
                            </button>
                        </div>
                        @if ($errors->any())
                        <div class="p-4 mb-4 text-red-700 bg-red-100 border border-red-400 rounded">
                            <ul class="pl-5 list-disc">
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif

                    </form>
                </div>
                <!-- Kanan -->
                <div class="flex flex-col items-center justify-center w-full p-8 text-white sm:w-1/2 bg-primary">
                    <div class="flex justify-center w-full mt-6 mb-6">
                        <img src="{{ asset('/assets/img/icon/logo.png') }}" alt="Logo" class="w-28">
                    </div>


                    <div class="flex flex-col items-center justify-center h-full">
                        <h2 class="mb-2 text-2xl font-bold text-center">Selamat Datang Kembali!</h2>
                        <p class="mb-4 text-center">Masukkan informasi akun Anda untuk melanjutkan!</p>
                        <a href="{{ route('login') }}"
                            class="block text-center w-[150px] text-white font-semibold py-2 -mt-33 rounded-full shadow transition duration-200"
                            style="background-color: rgba(33, 148, 243, 1);"
                            onmouseover="this.style.backgroundColor='rgba(81, 161, 227, 1)';"
                            onmouseout="this.style.backgroundColor='rgba(33, 148, 243, 1)';">
                            Masuk
                        </a>
                    </div>
                </div>
                
                <!-- Kabupaten -->
                <div class="form-group">
                    <label class="font-semibold mb-1 block">Kabupaten/Kota</label>
                    <select id="kabupaten" name="kabupaten" class="form-control w-full px-4 py-2 border border-gray-300 rounded-full shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500"required>
                        <option value="">Pilih Kabupaten</option>
                        @foreach ($wilayah['kabupaten'] as $kab)
                            <option value="{{ $kab['name'] }}">{{ $kab['name'] }}</option>
                        @endforeach
                    </select>
                </div>
                <!-- Email -->
                <div>
                    <label class="font-semibold mb-1 block">Email</label>
                    <input type="email" name="email" placeholder="Masukkan Email"
                        class="w-full px-4 py-2 border border-gray-300 rounded-full shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500"required>
                </div>
            
                <!-- Kecamatan -->
                <div class="form-group">
                    <label class="font-semibold mb-1 block">Kecamatan</label>
                    <select id="kecamatan" name="kecamatan" class="form-control w-full px-4 py-2 border border-gray-300 rounded-full shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500"required>
                        <option value="">--Pilih Kecamatan--</option>
                    </select>
                </div>
                <!-- No HP -->
                <div>
                    <label class="font-semibold mb-1 block">Nomor HP</label>
                    <input type="text" name="telp" placeholder="Masukkan Nomor HP"
                        class="w-full px-4 py-2 border border-gray-300 rounded-full shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500"required>
                </div>
                <!-- Kelurahan -->
                <div class="form-group">
                    <label class="font-semibold mb-1 block">Kelurahan</label>
                    <select id="kelurahan" name="kelurahan" class="form-control w-full px-4 py-2 border border-gray-300 rounded-full shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500"required>
                        <option value="">-- Pilih Kelurahan --</option>
                    </select>
                </div>
                <script>
                    const dataWilayah = @json($wilayah['kabupaten']);
                
                    const kabupatenSelect = document.getElementById('kabupaten');
                    const kecamatanSelect = document.getElementById('kecamatan');
                    const kelurahanSelect = document.getElementById('kelurahan');
                
                    kabupatenSelect.addEventListener('change', function() {
                        const selectedKab = dataWilayah.find(kab => kab.name === this.value);
                        kecamatanSelect.innerHTML = '<option value="">Pilih Kecamatan</option>';
                        kelurahanSelect.innerHTML = '<option value="">Pilih Kelurahan</option>';
                        kelurahanSelect.disabled = true;
                
                        if (selectedKab) {
                            selectedKab.kecamatan.forEach(kec => {
                                const opt = document.createElement('option');
                                opt.value = kec.name;
                                opt.textContent = kec.name;
                                kecamatanSelect.appendChild(opt);
                            });
                            kecamatanSelect.disabled = false;
                        } else {
                            kecamatanSelect.disabled = true;
                        }
                    });
                
                    kecamatanSelect.addEventListener('change', function() {
                        const selectedKab = dataWilayah.find(kab => kab.name === kabupatenSelect.value);
                        const selectedKec = selectedKab?.kecamatan.find(kec => kec.name === this.value);
                
                        kelurahanSelect.innerHTML = '<option value="">Pilih Kelurahan</option>';
                
                        if (selectedKec) {
                            selectedKec.kelurahan.forEach(kel => {
                                const opt = document.createElement('option');
                                opt.value = kel;
                                opt.textContent = kel;
                                kelurahanSelect.appendChild(opt);
                            });
                            kelurahanSelect.disabled = false;
                        } else {
                            kelurahanSelect.disabled = true;
                        }
                    });
                </script>
                    
                        

                <!-- Password -->
                <div>
                    <label class="font-semibold mb-1 block">Kata Sandi</label>
                    <input type="password" name="password" placeholder="Masukkan Kata Sandi"
                        class="w-full px-4 py-2 border border-gray-300 rounded-full shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500"required>
                </div>

                <!-- Alamat -->
                <div>
                    <label class="font-semibold mb-1 block">Alamat</label>
                    <input type="text" name="alamat_lengkap" placeholder="Masukkan Alamat Anda"
                        class="w-full px-4 py-2 border border-gray-300 rounded-full shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500"required>
                </div>
                       
                <!-- Konfirmasi Password -->
                <div>
                    <label class="font-semibold mb-1 block">Konfirmasi Kata Sandi</label>
                    <input type="password" name="password_confirmation" placeholder="Ulangi Kata Sandi"
                        class="w-full px-4 py-2 border border-gray-300 rounded-full shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500"required>
                </div>

                <!-- NIK -->
                <div>
                    <label class="font-semibold mb-1 block">NIK (Nomor Induk Kependudukan)</label>
                    <input type="text" name="nik" placeholder="Masukkan NIK Anda"
                        class="w-full px-4 py-2 border border-gray-300 rounded-full shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500"required>
                </div>
            
                <!-- NIB -->
                <div>
                    <label class="font-semibold mb-1 block">NIB (Nomor Induk Berusaha)</label>
                    <input type="text" name="nib" placeholder="Masukkan NIB Anda (Opsional)"
                        class="w-full px-4 py-2 border border-gray-300 rounded-full shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
            </div>  
            <!-- Tombol -->
            <div class="col-span-2 flex justify-center mt-6">
               <button type="submit"
                   class="w-[150px] bg-secondary hover:bg-[var(--secondary-dark)] text-white font-semibold py-2 rounded-full shadow transition duration-200">
                   Daftar
               </button>
            </div>

        </body>

</html>
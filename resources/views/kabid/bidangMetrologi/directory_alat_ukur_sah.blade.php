                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium">Keterangan</label>
                            <p id="detailKeterangan" class="mt-1"></p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium">Sertifikat</label>
                            <p id="detailSertifikat" class="mt-1">
                                <span class="text-gray-500">Belum di upload oleh admin</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

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

<script>
    function getDetail(id) {
        fetch(`/kabid/metrologi/detail/${id}`)
            .then(response => response.json())
            .then(data => {
                document.getElementById('detailTanggalMulai').textContent = data.tanggal_penginputan || '-';
                document.getElementById('detailNoRegistrasi').textContent = data.no_registrasi || '-';
                document.getElementById('detailNamaUsaha').textContent = data.nama_usaha || '-';
                document.getElementById('detailJenisAlat').textContent = data.jenis_alat || '-';
                document.getElementById('detailNamaAlat').textContent = data.nama_alat || '-';
                document.getElementById('detailMerkType').textContent = data.merk_type || '-';
                document.getElementById('detailNomorSeri').textContent = data.nomor_seri || '-';
                document.getElementById('detailAlatPenguji').textContent = data.alat_penguji || '-';
                document.getElementById('detailCtt').textContent = data.ctt || '-';
                document.getElementById('detailSptKeperluan').textContent = data.spt_keperluan || '-';
                document.getElementById('detailTanggalSelesai').textContent = data.tanggal_selesai || '-';
                document.getElementById('detailTerapan').textContent = data.terapan ? 'Ya' : 'Tidak';
                document.getElementById('detailKeterangan').textContent = data.keterangan || '-';
                
                // Update certificate display
                const sertifikatElement = document.getElementById('detailSertifikat');
                if (data.sertifikat_path) {
                    sertifikatElement.innerHTML = `<a href="/storage/${data.sertifikat_path}" target="_blank" class="text-blue-600 hover:text-blue-800">Lihat Sertifikat</a>`;
                } else {
                    sertifikatElement.innerHTML = '<span class="text-gray-500">Belum di upload oleh admin</span>';
                }

                document.getElementById('modalDetail').classList.remove('hidden');
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Terjadi kesalahan saat mengambil data');
            });
    }

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
        
        fetch(`/kabid/metrologi/detail/${id}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken
            },
            body: JSON.stringify({ id: id })
        })
        .then(response => response.json())
        .then(data => {
            document.getElementById('popupNoReg').textContent = data.no_registrasi;
            
            const detailBody = document.getElementById('popupDetailBody');
            detailBody.innerHTML = `
                <tr><td class="py-2 font-semibold">Jenis Alat</td><td class="py-2">: ${data.jenis_alat ?? '-'}</td></tr>
                <tr><td class="py-2 font-semibold">Nama Usaha</td><td class="py-2">: ${data.nama_usaha ?? '-'}</td></tr>
                <tr><td class="py-2 font-semibold">Merk/Type</td><td class="py-2">: ${data.merk_type ?? '-'}</td></tr>
                <tr><td class="py-2 font-semibold">Kapasitas</td><td class="py-2">: ${data.nama_alat ?? '-'}</td></tr>
                <tr><td class="py-2 font-semibold">Nomor Seri</td><td class="py-2">: ${data.nomor_seri ?? '-'}</td></tr>
                <tr><td class="py-2 font-semibold">Alat Penguji</td><td class="py-2">: ${data.alat_penguji ?? '-'}</td></tr>
                <tr><td class="py-2 font-semibold">Cap Tanda Tera</td><td class="py-2">: ${data.ctt ?? '-'}</td></tr>
                <tr><td class="py-2 font-semibold">No Surat Perintah Tugas</td><td class="py-2">: ${data.spt_keperluan ?? '-'}</td></tr>
                <tr><td class="py-2 font-semibold">Tanggal Tera</td><td class="py-2">: ${new Date(data.tanggal_penginputan ?? '-').toLocaleDateString('id-ID', {day: 'numeric', month: 'long', year: 'numeric'})}</td></tr>
                <tr><td class="py-2 font-semibold">Tanggal Selesai</td><td class="py-2">: ${new Date(data.tanggal_selesai ?? '-').toLocaleDateString('id-ID', {day: 'numeric', month: 'long', year: 'numeric'})}</td></tr>
                <tr><td class="py-2 font-semibold">Keterangan</td><td class="py-2">: ${data.keterangan || '-'}</td></tr>
                <tr><td class="py-2 font-semibold">Sertifikat</td><td class="py-2">: ${data.sertifikat_path ? `<a href="/storage/${data.sertifikat_path}" target="_blank" class="text-blue-600 hover:text-blue-800">Lihat Sertifikat</a>` : '<span class="text-gray-500">Belum di upload oleh admin</span>'}</td></tr>
            `;
            
            togglePopup(true);
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Terjadi kesalahan saat memuat detail alat');
        });
    }
</script> 
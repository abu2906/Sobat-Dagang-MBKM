document.addEventListener('DOMContentLoaded', () => {
    const btnAjukan = document.getElementById('btn-ajukan');
    const btnDraft = document.getElementById('draftPerdagangan'); // tombol draft baru
    const modalVerifikasi = document.getElementById('modal-verifikasi');
    const modalDraft = document.getElementById('modal-draft');

    // Buka modal Ajukan
    if (btnAjukan && modalVerifikasi) {
        btnAjukan.addEventListener('click', function () {
            modalVerifikasi.classList.remove('hidden');
        });
    }

    // Buka modal Draft
    if (btnDraft && modalDraft) {
        btnDraft.addEventListener('click', function () {
            modalDraft.classList.remove('hidden');
        });
    }

    // Fungsi untuk tutup semua modal (verifikasi + draft)
    window.closeModal = function () {
        modalVerifikasi.classList.add('hidden');
        modalDraft.classList.add('hidden');
    };

    // Modal untuk Balasan (Lihat / Unduh PDF) pada riwayat surat
    function openModal(url) {
        // Tampilkan modal
        const modal = document.getElementById('modal');
        const modalContent = document.getElementById('modalContent');
        const downloadBtn = document.getElementById('downloadBtn');

        // Ubah iframe untuk menampilkan URL PDF
        modalContent.src = url;
        downloadBtn.href = url;

        // Tampilkan modal
        modal.classList.remove('hidden');
    }

    // Tutup modal saat tombol close diklik (modal PDF)
    document.getElementById('closeModal').addEventListener('click', function() {
        const modal = document.getElementById('modal');
        modal.classList.add('hidden');
    });

    // Tutup modal jika pengguna mengklik di luar modal (modal PDF)
    document.getElementById('modal').addEventListener('click', function(e) {
        if (e.target === this) {
            this.classList.add('hidden');
        }
    });
});

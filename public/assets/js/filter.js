
document.addEventListener('DOMContentLoaded', function () {
    // Ambil elemen-elemen filter
    const statusFilter = document.getElementById('statusFilter');
    const dateFilter = document.getElementById('dateFilter');
    const searchInput = document.getElementById('searchInput');
    const tableRows = document.querySelectorAll('#riwayatPermohonan tbody tr');

    // Fungsi untuk memfilter tabel
    function filterTable() {
        const statusValue = statusFilter.value.toLowerCase();
        const dateValue = dateFilter.value;
        const searchValue = searchInput.value.toLowerCase();

        tableRows.forEach(function (row) {
            const statusCell = row.querySelector('td:nth-child(3)').innerText.toLowerCase();
            const dateCell = row.querySelector('td:nth-child(2)').innerText.toLowerCase();
            const searchText = row.innerText.toLowerCase();

            // Cek apakah baris cocok dengan filter
            const matchesStatus = !statusValue || statusCell.includes(statusValue);
            const matchesDate = !dateValue || dateCell.includes(dateValue);
            const matchesSearch = !searchValue || searchText.includes(searchValue);

            // Menampilkan atau menyembunyikan baris berdasarkan filter
            if (matchesStatus && matchesDate && matchesSearch) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    }

    // Event listener untuk filter
    statusFilter.addEventListener('change', filterTable);
    dateFilter.addEventListener('change', filterTable);
    searchInput.addEventListener('input', filterTable);
});

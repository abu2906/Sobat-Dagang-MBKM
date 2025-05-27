    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // ================================
                // KONFIGURASI DAN KONSTANTA
                // ================================
                const tabs = document.querySelectorAll('.tab-button');
                const contents = {
                    'btn-data-ikm': document.getElementById('form-data-ikm'),
                    'btn-persentase-pemilik': document.getElementById('form-persentase-pemilik'),
                    'btn-karyawan': document.getElementById('form-karyawan'),
                    'btn-pemakaian-bahan': document.getElementById('form-pemakaian-bahan'),
                    'btn-penggunaan-air': document.getElementById('form-penggunaan-air'),
                    'btn-pengeluaran': document.getElementById('form-pengeluaran'),
                    'btn-bahan-bakar': document.getElementById('form-bahan-bakar'),
                    'btn-listrik': document.getElementById('form-listrik'),
                    'btn-mesin-produksi': document.getElementById('form-mesin-produksi'),
                    'btn-produksi': document.getElementById('form-produksi'),
                    'btn-persediaan': document.getElementById('form-persediaan'),
                    'btn-pendapatan': document.getElementById('form-pendapatan'),
                    'btn-modal': document.getElementById('form-modal'),
                    'btn-bentuk-pengelolaan': document.getElementById('form-bentuk-pengelolaan'),
                };

                const formIds = Object.values(contents).map(el => el?.id).filter(Boolean);

                // ================================
                // TAB SWITCHING FUNCTIONALITY
                // ================================
                function showForm(idToShow) {
                    Object.entries(contents).forEach(([key, section]) => {
                        const tab = document.getElementById(key);
                        if (!section || !tab) return;

                        const isActive = key === idToShow;
                        section.classList.toggle('hidden', !isActive);
                        section.classList.toggle('grid', isActive);

                        tab.classList.remove(
                            'bg-white', 'text-[#083458]', 'font-bold', 'border-b-4', 'border-[#083458]',
                            'bg-[#083458]', 'text-white', 'hover:bg-blue-200', 'hover:text-[#083458]',
                            'hover:border-[#083458]'
                        );

                        if (isActive) {
                            tab.classList.add('bg-white', 'text-[#083458]', 'font-bold', 'border-b-4',
                                'border-[#083458]');
                        } else {
                            tab.classList.add('bg-[#083458]', 'text-white', 'hover:bg-blue-200',
                                'hover:text-[#083458]', 'hover:border-[#083458]');
                        }
                    });
                }

                showForm('btn-data-ikm');

                function initTabSwitching() {
                    tabs.forEach(tab => {
                        tab.addEventListener('click', () => {
                            showForm(tab.id);
                        });
                    });
                }

                initTabSwitching();
                showForm('btn-data-ikm');

                // ================================
                // WILAYAH (KECAMATAN & KELURAHAN)
                // ================================
                function initWilayahDropdown() {
                    const dataWilayah = @json($wilayah['kabupaten'] ?? []);
                    const parepareKabupaten = dataWilayah.find(kab => kab.name === "Kota Parepare");
                    const kecamatanSelect = document.getElementById('kecamatan');
                    const kelurahanSelect = document.getElementById('kelurahan');

                    if (parepareKabupaten && kecamatanSelect) {
                        // Populate kecamatan options
                        parepareKabupaten.kecamatan.forEach(kec => {
                            const opt = document.createElement('option');
                            opt.value = kec.name;
                            opt.textContent = kec.name;
                            kecamatanSelect.appendChild(opt);
                        });

                        // Handle kecamatan change
                        kecamatanSelect.addEventListener('change', function() {
                            const selectedKec = parepareKabupaten.kecamatan.find(kec => kec.name === this
                                .value);
                            kelurahanSelect.innerHTML =
                                '<option value="" disabled selected>Pilih Kelurahan</option>';

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
                    }
                }

                // ================================
                // FORM NAVIGATION (NEXT/PREV)
                // ================================
                document.addEventListener('DOMContentLoaded', () => {
                    const formIds = [
                        'form-data-ikm', 'form-persentase-pemilik', 'form-karyawan',
                        'form-pemakaian-bahan', 'form-penggunaan-air', 'form-pengeluaran',
                        'form-bahan-bakar', 'form-listrik', 'form-mesin-produksi',
                        'form-produksi', 'form-persediaan', 'form-pendapatan',
                        'form-modal', 'form-bentuk-pengelolaan'
                    ];

                    function showForm(idToShow) {
                        formIds.forEach(id => {
                            const el = document.getElementById(id);
                            const tabBtn = document.getElementById('btn-' + id.replace('form-', ''));
                            if (!el) return;

                            if (id === idToShow) {
                                el.classList.remove('hidden');
                                el.classList.add('grid');
                                if (tabBtn) {
                                    tabBtn.classList.add('bg-blue-100', 'text-black', 'font-bold');
                                    tabBtn.classList.remove('bg-[#083458]');
                                }
                            } else {
                                el.classList.add('hidden');
                                el.classList.remove('grid');
                                if (tabBtn) {
                                    tabBtn.classList.remove('bg-blue-100', 'text-black', 'font-bold');
                                    tabBtn.classList.add('bg-[#083458]');
                                }
                            }
                        });
                    }

                    function goToForm(currentId, direction) {
                        const currentIndex = formIds.indexOf(currentId);
                        const newIndex = currentIndex + direction;
                        if (newIndex >= 0 && newIndex < formIds.length) {
                            showForm(formIds[newIndex]);
                        }
                    }

                    // Validasi sebelum lanjut
                    function validasiFormSebelumLanjut(currentFormId) {
                        const currentForm = document.getElementById(currentFormId);
                        const inputs = currentForm.querySelectorAll('input, select, textarea');

                        for (let input of inputs) {
                            if (input.hasAttribute('required') && !input.disabled && !input.value.trim()) {
                                let labelText = input.closest('div')?.querySelector('label')?.textContent
                                ?.trim();
                                if (!labelText) {
                                    labelText = input.name.replaceAll('_', ' ');
                                }

                                const root = document.querySelector('[x-data]');
                                if (root && root.__x) {
                                    root.__x.$data.alertMessage = `Bagian "${labelText}" wajib diisi.`;
                                    root.__x.$data.showAlert = true;
                                }

                                input.focus();
                                return false;
                            }
                        }
                        return true;
                    }

                    // Tombol navigasi tab manual (jika ada tombol tab)
                    document.querySelectorAll('.tab-button').forEach(tabBtn => {
                        tabBtn.addEventListener('click', () => {
                            const target = tabBtn.id.replace('btn-', 'form-');
                            showForm(target);
                        });
                    });

                    // Tombol "Selanjutnya" dengan validasi
                    document.querySelectorAll('button[id^="next-"]').forEach(button => {
                        button.addEventListener('click', function(e) {
                            e.preventDefault();
                            const currentFormId = this.id.replace('next-', 'form-');
                            if (validasiFormSebelumLanjut(currentFormId)) {
                                goToForm(currentFormId, 1);
                            }
                        });
                    });

                    // Tombol "Sebelumnya"
                    formIds.forEach(id => {
                        const section = document.getElementById(id);
                        const prevBtn = section?.querySelector('button.prev');
                        if (prevBtn) {
                            prevBtn.addEventListener('click', e => {
                                e.preventDefault();
                                goToForm(id, -1);
                            });
                        }
                    });

                    // Tampilkan form pertama saat load
                    showForm(formIds[0]);
                });



                // ================================
                // DYNAMIC FORM MANAGEMENT
                // ================================
                function initDynamicForms() {
                    // Bahan Management
                    function tambahFormBahan() {
                        const container = document.getElementById("form-bahan-container");
                        const template = document.getElementById("bahan-template");
                        const clone = template.cloneNode(true);
                        clone.removeAttribute("id");
                        clone.querySelectorAll("input, select").forEach(el => {
                            el.tagName === "SELECT" ? el.selectedIndex = 0 : el.value = "";
                        });
                        container.appendChild(clone);
                        updateIndexBahan();
                        updateTombolHapusBahan();
                    }

                    function updateIndexBahan() {
                        const items = document.querySelectorAll("#form-bahan-container .bahan-item");
                        items.forEach((item, idx) => {
                            const judul = item.querySelector("div.font-semibold");
                            if (judul) judul.textContent = "Bahan " + (idx + 1);
                        });
                    }

                    function updateTombolHapusBahan() {
                        const items = document.querySelectorAll("#form-bahan-container .bahan-item");
                        items.forEach(item => {
                            const hapusBtn = item.querySelector(".hapus-item");
                            if (!hapusBtn) return;
                            hapusBtn.classList.toggle("hidden", items.length === 1);
                            hapusBtn.onclick = function() {
                                item.remove();
                                updateIndexBahan();
                                updateTombolHapusBahan();
                            };
                        });
                    }

                    // Bahan Bakar Management
                    function tambahBahanBakar() {
                        const container = document.getElementById("bahan-bakar-container");
                        const template = document.getElementById("bahan-bakar-template");
                        const clone = template.cloneNode(true);
                        clone.removeAttribute("id");
                        clone.querySelectorAll("input, select").forEach(el => {
                            el.tagName === "SELECT" ? el.selectedIndex = 0 : el.value = "";
                        });
                        container.appendChild(clone);
                        updateIndexBahanBakar();
                        updateTombolHapusBahanBakar();
                    }

                    function updateIndexBahanBakar() {
                        const items = document.querySelectorAll("#bahan-bakar-container .bahan-bakar-item");
                        items.forEach((item, idx) => {
                            const judul = item.querySelector(".judul-bahan-bakar");
                            if (judul) judul.textContent = "Bahan Bakar " + (idx + 1);
                        });
                    }

                    function updateTombolHapusBahanBakar() {
                        const items = document.querySelectorAll("#bahan-bakar-container .bahan-bakar-item");
                        items.forEach(item => {
                            const hapusBtn = item.querySelector(".hapus-item");
                            if (!hapusBtn) return;
                            hapusBtn.classList.toggle("hidden", items.length === 1);
                            hapusBtn.onclick = function() {
                                item.remove();
                                updateIndexBahanBakar();
                                updateTombolHapusBahanBakar();
                            };
                        });
                    }

                    // Initialize dynamic forms
                    updateTombolHapusBahan();
                    updateTombolHapusBahanBakar();

                    // Make functions globally accessible if needed
                    window.tambahFormBahan = tambahFormBahan;
                    window.tambahBahanBakar = tambahBahanBakar;
                }

                // ================================
                // FORM PREFILL (DUMMY DATA)
                // ================================
                function prefillDummyData() {
                    const form = document.getElementById('form-ikm');
                    form?.querySelectorAll('input')?.forEach(el => {
                        if (el.name !== '_token' && el.type !== 'hidden') {
                            if (el.type === 'number') {
                                el.value = el.id.includes('tahun') ? Math.max(el.value, 1900) : 98;
                            } else if (el.type === 'tel') {
                                el.value = '081234567890';
                            } else {
                                el.value = 'Contoh';
                            }
                        }
                    });
                }

                // ================================
                // FORM VALIDATION & SUBMISSION
                // ================================
                function initFormValidation() {
                    const submitButton = document.getElementById('submit-semua');
                    if (!submitButton) return;

                    submitButton.addEventListener('click', function(e) {
                        e.preventDefault();

                        // Skip jika ada error backend
                        if (document.querySelector('[data-error-konsistensi]')) {
                            return;
                        }

                        // Validasi semua form
                        for (let formId of formIds) {
                            const section = document.getElementById(formId);
                            if (!section) continue;

                            const inputs = section.querySelectorAll('input, select, textarea');
                            for (let input of inputs) {
                                if (input.hasAttribute('required') && !input.disabled && !input.value.trim()) {
                                    const label = input.closest('div')?.querySelector('label')?.textContent
                                        ?.trim() || input.name;

                                    Swal.fire({
                                        icon: 'warning',
                                        title: 'Isian belum lengkap',
                                        text: `Bagian "${label}" wajib diisi.`,
                                        confirmButtonText: 'Oke, isi dulu',
                                        confirmButtonColor: '#F49F1E'
                                    }).then(() => {
                                        // Pindah ke tab yang bermasalah
                                        const tabBtn = document.getElementById('btn-' + formId.replace(
                                            'form-', ''));
                                        if (tabBtn) tabBtn.click();

                                        // Focus ke input bermasalah
                                        setTimeout(() => {
                                            input.scrollIntoView({
                                                behavior: 'smooth',
                                                block: 'center'
                                            });
                                            input.focus();
                                        }, 300);
                                    });
                                    return;
                                }
                            }
                        }

                        // Jika semua validasi berhasil
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: 'Data berhasil disubmit!',
                            confirmButtonText: 'Oke',
                            confirmButtonColor: '#22c55e'
                        }).then(() => {
                            submitButton.closest('form').submit();
                        });
                    });
                }

                // ================================
                // INISIALISASI SEMUA FUNGSI
                // ================================
                function init() {
                    initTabSwitching();
                    initWilayahDropdown();
                    initFormNavigation();
                    initDynamicForms();
                    prefillDummyData();
                    initFormValidation();

                    // Show first form
                    if (formIds.length > 0) {
                        showForm('btn-' + formIds[0].replace('form-', ''));
                    }
                }

                // Jalankan inisialisasi
                init();
            });
        </script>
    @endpush

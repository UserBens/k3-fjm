<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Data Tenaga Kerja</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body class="bg-gray-100 font-sans leading-normal tracking-normal">

    <div class="container mx-auto p-6">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Data Pegawai & KIB</h1>
            <button id="btnSync" onclick="syncData()" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded shadow transition duration-200">
                🔄 Sinkronisasi API
            </button>
        </div>

        <div id="alertBox" class="hidden mb-4 p-4 rounded shadow border"></div>

        <div class="bg-white p-4 rounded-lg shadow mb-6 grid grid-cols-1 md:grid-cols-4 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Cari Nama / NIK</label>
                <input type="text" id="search" oninput="fetchData()" placeholder="Ketik nama atau NIK..." class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Filter Status</label>
                <select id="filterStatus" onchange="fetchData()" class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:outline-none">
                    <option value="">Semua Status</option>
                    <option value="Aktif">Aktif</option>
                    <option value="Non-Aktif">Non-Aktif</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Filter Departemen</label>
                <select id="filterDepartemen" onchange="fetchData()" class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:outline-none">
                    <option value="">Semua Departemen</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Tampilkan per Halaman</label>
                <select id="perPage" onchange="fetchData()" class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:outline-none">
                    <option value="10">10</option>
                    <option value="25">25</option>
                    <option value="50">50</option>
                </select>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 text-sm">
                <thead class="bg-gray-50 text-gray-700 uppercase font-semibold text-xs tracking-wider">
                    <tr>
                        <th class="px-6 py-3 text-left">Pegawai</th>
                        <th class="px-6 py-3 text-left">Jabatan / Dept</th>
                        <th class="px-6 py-3 text-left">Nomor KIB</th>
                        <th class="px-6 py-3 text-left">Masa Berlaku KIB</th>
                        <th class="px-6 py-3 text-left">Sisa Hari</th>
                        <th class="px-6 py-3 text-left">Status KIB</th>
                        <th class="px-6 py-3 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody id="tableBody" class="divide-y divide-gray-200 text-gray-600">
                    </tbody>
            </table>
        </div>

        <div class="flex justify-between items-center mt-4">
            <span id="paginationInfo" class="text-sm text-gray-600">Menampilkan 0 sampai 0 dari 0 data</span>
            <div id="paginationButtons" class="inline-flex space-x-1"></div>
        </div>
    </div>

    <div id="updateModal" class="fixed inset-0 bg-black/50 z-50 flex items-center justify-center hidden opacity-0 transition-opacity duration-300">
        <div class="bg-white rounded-lg shadow-xl w-full max-w-md p-6 transform scale-95 transition-transform duration-300">
            <div class="flex justify-between items-center mb-4 border-b pb-2">
                <h3 class="text-lg font-bold text-gray-800">Update Data KIB</h3>
                <button onclick="closeModal()" class="text-gray-400 hover:text-gray-600 font-bold text-xl">&times;</button>
            </div>
            
            <form id="formUpdateKib" onsubmit="submitUpdateKib(event)">
                <input type="hidden" id="edit_id">
                
                <div class="mb-4">
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Nama Pegawai</label>
                    <input type="text" id="edit_nama" disabled class="w-full bg-gray-100 border border-gray-300 rounded px-3 py-2 text-sm text-gray-500">
                </div>

                <div class="mb-4">
                    <label for="nomor_kib" class="block text-sm font-semibold text-gray-700 mb-1">Nomor KIB</label>
                    <input type="text" id="nomor_kib" required class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
                </div>

                <div class="mb-4">
                    <label for="masa_berlaku_kib" class="block text-sm font-semibold text-gray-700 mb-1">Masa Berlaku KIB</label>
                    <input type="date" id="masa_berlaku_kib" required class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
                </div>

                <div class="mb-4">
                    <label for="status_kib" class="block text-sm font-semibold text-gray-700 mb-1">Status KIB</label>
                    <select id="status_kib" required class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
                        <option value="Aktif">Aktif</option>
                        <option value="Non-Aktif">Non-Aktif</option>
                        <option value="Suspend">Suspend</option>
                        <option value="Proses Perpanjangan">Proses Perpanjangan</option>
                    </select>
                </div>

                <div class="flex justify-end space-x-2 pt-4 border-t">
                    <button type="button" onclick="closeModal()" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded text-sm font-semibold">Batal</button>
                    <button type="submit" id="btnSubmitForm" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded text-sm font-semibold">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        let currentPage = 1;
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        // Panggil data pertama kali halaman dimuat
        document.addEventListener('DOMContentLoaded', () => {
            fetchData();
        });

        // Menampilkan pesan alert web
        function showAlert(status, message) {
            const alertBox = document.getElementById('alertBox');
            alertBox.className = `mb-4 p-4 rounded shadow border ${status === 'success' ? 'bg-green-100 border-green-400 text-green-700' : 'bg-red-100 border-red-400 text-red-700'}`;
            alertBox.innerHTML = message;
            alertBox.classList.remove('hidden');
            setTimeout(() => alertBox.classList.add('hidden'), 5000);
        }

        // Ambil Data dari API Server Terintegrasi
        function fetchData(page = 1) {
            currentPage = page;
            const search = document.getElementById('search').value;
            const status = document.getElementById('filterStatus').value;
            const departemen = document.getElementById('filterDepartemen').value;
            const perPage = document.getElementById('perPage').value;

            const url = `/tenaga/api?page=${page}&search=${search}&status=${status}&departemen=${departemen}&per_page=${perPage}`;

            fetch(url)
                .then(res => res.json())
                .then(response => {
                    renderTable(response.data);
                    renderPagination(response.meta);
                    populateFilterOptions(response.filter_options);
                })
                .catch(err => console.error("Error fetching data:", err));
        }

        // Render data ke dalam tabel HTML
        function renderTable(data) {
            const tbody = document.getElementById('tableBody');
            tbody.innerHTML = '';

            if (data.length === 0) {
                tbody.innerHTML = `<tr><td colspan="7" class="text-center py-6 text-gray-400">Tidak ada data pegawai ditemukan.</td></tr>`;
                return;
            }

            data.forEach(item => {
                // Memberikan style warna pada kolom Sisa Hari & Status KIB agar lebih interaktif
                const isExpired = item.sisa_hari_kib.includes('Kedaluwarsa');
                const badgeHariColor = isExpired ? 'bg-red-100 text-red-700' : (item.sisa_hari_kib === '-' ? 'bg-gray-100 text-gray-500' : 'bg-green-100 text-green-700');

                tbody.innerHTML += `
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4">
                            <div class="font-bold text-gray-800">${item.nama}</div>
                            <div class="text-xs text-gray-400">NIK: ${item.nik}</div>
                        </td>
                        <td class="px-6 py-4">
                            <div>${item.jabatan}</div>
                            <div class="text-xs text-gray-500">${item.departemen}</div>
                        </td>
                        <td class="px-6 py-4 font-mono text-gray-700">${item.nomor_kib}</td>
                        <td class="px-6 py-4">${item.masa_berlaku_kib ? item.masa_berlaku_kib : '-'}</td>
                        <td class="px-6 py-4">
                            <span class="px-2 py-1 text-xs font-semibold rounded-full ${badgeHariColor}">${item.sisa_hari_kib}</span>
                        </td>
                        <td class="px-6 py-4 font-semibold">${item.status_kib}</td>
                        <td class="px-6 py-4 text-center">
                            <button onclick='openModal(${JSON.stringify(item)})' class="bg-amber-500 hover:bg-amber-600 text-white font-medium py-1 px-3 rounded text-xs transition shadow-sm">
                                📝 Edit KIB
                            </button>
                        </td>
                    </tr>
                `;
            });
        }

        // Sinkronisasi data dinamis opsi filter departemen agar tidak hardcoded
        let filterPopulated = false;
        function populateFilterOptions(options) {
            if (filterPopulated) return; // Mencegah looping opsi saat render ulang data
            const selectDept = document.getElementById('filterDepartemen');
            options.departemen.forEach(dept => {
                const opt = document.createElement('option');
                opt.value = dept;
                opt.innerText = dept;
                selectDept.appendChild(opt);
            });
            filterPopulated = true;
        }

        // Render tombol navigasi pagination
        function renderPagination(meta) {
            document.getElementById('paginationInfo').innerText = `Menampilkan ${meta.from ?? 0} sampai ${meta.to ?? 0} dari ${meta.total} data`;
            const container = document.getElementById('paginationButtons');
            container.innerHTML = '';

            // Tombol Previous
            if (meta.current_page > 1) {
                container.innerHTML += `<button onclick="fetchData(${meta.current_page - 1})" class="px-3 py-1 bg-gray-200 hover:bg-gray-300 rounded text-xs font-medium">&laquo; Prev</button>`;
            }

            // Tombol Nomor Halaman
            for (let i = 1; i <= meta.last_page; i++) {
                const activeClass = i === meta.current_page ? 'bg-blue-600 text-white' : 'bg-gray-200 hover:bg-gray-300';
                container.innerHTML += `<button onclick="fetchData(${i})" class="px-3 py-1 ${activeClass} rounded text-xs font-medium">${i}</button>`;
            }

            // Tombol Next
            if (meta.current_page < meta.last_page) {
                container.innerHTML += `<button onclick="fetchData(${meta.current_page + 1})" class="px-3 py-1 bg-gray-200 hover:bg-gray-300 rounded text-xs font-medium">Next &raquo;</button>`;
            }
        }

        // Fungsi Sinkronisasi Utama ke Perintah Artisan Laravel
        function syncData() {
            const btn = document.getElementById('btnSync');
            btn.disabled = true;
            btn.innerText = '⏳ Memproses Sinkronisasi...';

            fetch('/tenaga/sync', {
                method: 'POST',
                headers: { 'X-CSRF-TOKEN': csrfToken, 'Content-Type': 'application/json' }
            })
            .then(res => res.json())
            .then(data => {
                showAlert(data.status, data.message);
                fetchData(currentPage);
            })
            .catch(err => {
                showAlert('error', 'Gagal memicu sinkronisasi.');
                console.error(err);
            })
            .finally(() => {
                btn.disabled = false;
                btn.innerText = '🔄 Sinkronisasi API';
            });
        }

        // Buka Modal Edit & Isi Data Awal Form
        function openModal(item) {
            document.getElementById('edit_id').value = item.id;
            document.getElementById('edit_nama').value = item.nama;
            document.getElementById('nomor_kib').value = item.nomor_kib === '-' ? '' : item.nomor_kib;
            document.getElementById('masa_berlaku_kib').value = item.masa_berlaku_kib ?? '';
            document.getElementById('status_kib').value = item.status_kib === '-' ? 'Aktif' : item.status_kib;

            const modal = document.getElementById('updateModal');
            modal.classList.remove('hidden');
            setTimeout(() => {
                modal.classList.remove('opacity-0');
                modal.querySelector('div').classList.remove('scale-95');
            }, 50);
        }

        // Tutup Jendela Modal
        function closeModal() {
            const modal = document.getElementById('updateModal');
            modal.classList.add('opacity-0');
            modal.querySelector('div').classList.add('scale-95');
            setTimeout(() => modal.classList.add('hidden'), 300);
        }

        // submit form update KIB via AJAX (PUT request)
        function submitUpdateKib(event) {
            event.preventDefault();
            const id = document.getElementById('edit_id').value;
            const btnSubmit = document.getElementById('btnSubmitForm');

            const payload = {
                nomor_kib: document.getElementById('nomor_kib').value,
                masa_berlaku_kib: document.getElementById('masa_berlaku_kib').value,
                status_kib: document.getElementById('status_kib').value,
            };

            btnSubmit.disabled = true;
            btnSubmit.innerText = 'Menyimpan...';

            fetch(`/tenaga/${id}`, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                },
                body: JSON.stringify(payload)
            })
            .then(res => res.json())
            .then(data => {
                showAlert(data.status, data.message);
                closeModal();
                fetchData(currentPage); // Refresh tabel agar sisa hari langsung ter-update otomatis
            })
            .catch(err => {
                showAlert('error', 'Gagal memperbarui data KIB.');
                console.error(err);
            })
            .finally(() => {
                btnSubmit.disabled = false;
                btnSubmit.innerText = 'Simpan Perubahan';
            });
        }
    </script>
</body>
</html>
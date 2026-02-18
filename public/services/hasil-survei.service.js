class HasilSurveiController {
    constructor() {
        this.tableId = '#surveiTable';
        this.bodyId = '#surveiBody';
        this.headerId = '#surveiHeader';
        this.wrapperId = '#surveiTableWrapper';
        this.apiJadwalUrl = `${appUrl}/survei/jadwal/`;
        this.apiPenilaianUrl = `${appUrl}/survei/penilaian/`;
        this.apiSemesterUrl = `${appUrl}/survei/semester/`;
        this.apiProdiUrl = `${appUrl}/survei/programstudi/`;
        this.apiKriteriaUrl = `${appUrl}/survei/kriteria/`;

        this.allJadwalData = [];
        this.allSurveiData = [];
        this.allKriteriaData = [];

        this.currentPage = 1;
        this.pageSize = 10;
        this.filteredData = [];
    }

    ajaxRequest(url, method, data = null, isJson = false) {
        return new Promise((resolve, reject) => {
            $.ajax({
                url,
                method,
                data: isJson ? JSON.stringify(data) : data,
                processData: isJson ? false : true,
                contentType: isJson ? 'application/json' : 'application/x-www-form-urlencoded; charset=UTF-8',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: (response) => {
                    resolve(response);
                },
                error: (xhr) => {
                    reject(xhr);
                }
            });
        });
    }

    async hitungMarcos() {
        const prodiId = $('#filter_program_studi').val();
        const semesterId = $('#filter_semester').val();

        if (!prodiId || !semesterId) {
            warningAlert('Silakan pilih Program Studi dan Semester!');
            return;
        }

        const submitButton = $('#btnHitungMarcos');
        const originalText = submitButton.html();

        try {
            submitButton.attr('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Menghitung...');

            const url = `${appUrl}/survei/marcos/create`;
            const data = { prodi_id: prodiId, semester_id: semesterId };

            const response = await this.ajaxRequest(url, 'POST', data, true);
            console.log(response);

            if (response.status === 'success') {
                this.renderRankingTable(response.data);
                $('#hasilMarcosSection').show();
                $('html, body').animate({ scrollTop: $("#hasilMarcosSection").offset().top }, 500);
                successAlert('Perhitungan Selesai!');

                window.rankingDataGlobal = response.data;
            } else {
                throw new Error(response.message);
            }

        } catch (error) {
            console.error(error);
            warningAlert(error.responseJSON?.message || 'Gagal menghitung.');
        } finally {
            submitButton.attr('disabled', false).html(originalText);
        }
    }

    renderRankingTable(data) {
        const tbody = $('#rankingBody');
        tbody.empty();

        if (!data || data.length === 0) {
            tbody.html('<tr><td colspan="3" class="text-center">Tidak ada data.</td></tr>');
            return;
        }
        data.sort((a, b) => b['F(Ki)'] - a['F(Ki)']);

        data.forEach((item, index) => {
            const row = `
            <tr>
                <td class="text-center font-weight-bold">${index + 1}</td>
                <td>${item.dosen}</td>
                <td class="text-center font-weight-bold text-primary">
                    ${parseFloat(item['F(Ki)']).toFixed(2)}
                </td>
            </tr>
        `;
            tbody.append(row);
        });
    }

    // public/services/survei.service.js

    async simpanHistory() {
        if (!window.rankingDataGlobal || window.rankingDataGlobal.length === 0) {
            warningAlert('Tidak ada data ranking untuk disimpan.');
            return;
        }

        confirmAlert1(
            'Simpan History?',
            'Data ranking ini akan disimpan ke dalam history.',
            async () => {

                const payload = {
                    program_studi_id: $('#filter_program_studi').val(),
                    semester_id: $('#filter_semester').val(),
                    data_ranking: window.rankingDataGlobal
                };

                const submitButton = $('#btnSimpanHistory');
                const originalText = submitButton.html();

                try {
                    loadingAllert('Menyimpan', 'Sedang menyimpan data ke history...');
                    submitButton.attr('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Menyimpan...');

                    const url = `${appUrl}/survei/history/create`;
                    const response = await this.ajaxRequest(url, 'POST', payload, true);

                    if (response.status === 'success') {
                        successAlert('History berhasil disimpan.').then(() => {
                            realoadBrowser();
                        });
                    } else {
                        throw new Error(response.message);
                    }
                } catch (error) {
                    console.error(error);
                    Swal.close();
                    warningAlert('Gagal menyimpan history.');
                } finally {
                    submitButton.attr('disabled', false).html(originalText);
                }
            }
        );
    }

    async init() {
        await this.loadFilters();
        await this.loadKriteria(); // Load data kriteria
        this.bindEvents();
        await this.fetchAllSurveiData();
        // Render awal dengan data yang ada
        this.applyFilter();
    }

    async loadKriteria() {
        try {
            const response = await this.ajaxRequest(this.apiKriteriaUrl, 'GET');
            if (response.code === 200) {
                // Urutkan kriteria berdasarkan kode (C1, C2, C3, ...)
                this.allKriteriaData = response.data.sort((a, b) => {
                    const numA = parseInt(a.kode_kriteria.replace(/\D/g, ''));
                    const numB = parseInt(b.kode_kriteria.replace(/\D/g, ''));
                    return numA - numB;
                });
            }
        } catch (error) {
            console.error('Error loading kriteria:', error);
            this.allKriteriaData = [];
        }
    }

    async fetchAllSurveiData() {
        try {
            const response = await this.ajaxRequest(this.apiPenilaianUrl, 'GET');
            if (response.code === 200) {
                this.allSurveiData = response.data;
            }
        } catch (error) {
            console.error('Error fetching data:', error);
            this.allSurveiData = [];
        }
    }

    async loadFilters() {
        try {
            // --- FILTER SEMESTER AKTIF SAJA ---
            const resSemester = await this.ajaxRequest(this.apiSemesterUrl, 'GET');
            if (resSemester.code === 200) {
                // Filter hanya yang is_active == 1
                const semesterAktif = resSemester.data.filter(item => item.is_active == 1);

                let options = '<option value="">-- Pilih Semester Aktif --</option>';
                semesterAktif.forEach(item => {
                    options += `<option value="${item.id}">${item.nama_semester}</option>`;
                });
                $('#filter_semester').html(options);
            }

            const resProdi = await this.ajaxRequest(this.apiProdiUrl, 'GET');
            if (resProdi.code === 200) {
                let options = '<option value="">-- Semua Prodi --</option>';
                resProdi.data.forEach(item => {
                    options += `<option value="${item.id}">${item.nama_prodi}</option>`;
                });
                $('#filter_program_studi').html(options);
            }

        } catch (error) {
            console.error('Error loading filters:', error);
        }
    }

    bindEvents() {
        $('#btnTampilkan').on('click', (e) => {
            e.preventDefault();
            this.applyFilter();
        });

        $('#btnHitungMarcos').on('click', (e) => {
            e.preventDefault();
            this.hitungMarcos();
        });

        // Event untuk pagination
        $('#prevPage').on('click', (e) => {
            e.preventDefault();
            if (this.currentPage > 1) {
                this.currentPage--;
                this.renderMatrixTable(this.filteredData);
            }
        });

        $('#nextPage').on('click', (e) => {
            e.preventDefault();
            const totalPages = Math.ceil(this.filteredData.length / this.pageSize);
            if (this.currentPage < totalPages) {
                this.currentPage++;
                this.renderMatrixTable(this.filteredData);
            }
        });

        $('#pageSize').on('change', (e) => {
            this.pageSize = parseInt(e.target.value);
            this.currentPage = 1;
            this.renderMatrixTable(this.filteredData);
        });

        $('#searchInput').on('keyup', () => {
            this.currentPage = 1;
            this.renderMatrixTable(this.filteredData);
        });
    }

    applyFilter() {
        const prodiId = $('#filter_program_studi').val();
        const semesterId = $('#filter_semester').val();

        let filteredData = this.allSurveiData;

        // Logika filter fleksibel dengan pengecekan relasi aman
        if (prodiId) filteredData = filteredData.filter(item => item.kelas && item.kelas.program_studi_id === prodiId);
        if (semesterId) filteredData = filteredData.filter(item => item.kelas && item.kelas.semester_id === semesterId);

        this.filteredData = filteredData;
        this.currentPage = 1;
        this.renderMatrixTable(filteredData);
    }



    searchData(data, searchTerm) {
        if (!searchTerm) return data;

        searchTerm = searchTerm.toLowerCase();
        return data.filter(item => {
            return (item.nim && item.nim.toLowerCase().includes(searchTerm)) ||
                (item.nama_mahasiswa && item.nama_mahasiswa.toLowerCase().includes(searchTerm));
        });
    }

    renderMatrixTable(data) {
        const searchTerm = $('#searchInput').val();
        let filteredData = this.searchData(data, searchTerm);

        // Cari container table-responsive
        const $tableContainer = $('.table-responsive');

        // --- TAMPILAN DATA KOSONG ---
        if (!filteredData || filteredData.length === 0) {
            // Sembunyikan semua komponen tabel dan pagination
            $(this.tableId).hide();
            $('#surveiTableWrapper').hide();
            $('.pagination-container').hide();
            $('#pageSize').closest('.row').hide();

            // Hapus header dan body
            $(this.headerId).empty();
            $(this.bodyId).empty();

            // Tampilkan empty state yang menarik
            const emptyStateHtml = `
            <div class="text-center py-5 empty-state">
                <div class="mb-4">
                    <i class="fa fa-chart-bar fa-4x text-muted"></i>
                </div>
                <h4 class="text-muted mb-3">Belum Ada Data Survei</h4>
                <div class="alert alert-info d-inline-block">
                    <i class="fa fa-info-circle mr-2"></i>
                    Silakan pilih filter lain atau coba kembali nanti
                </div>
                <div class="mt-3">
                    <button class="btn btn-sm btn-outline-secondary" onclick="$('#filter_program_studi, #filter_semester').val('').trigger('change'); $('#btnTampilkan').click();">
                        <i class="fa fa-undo mr-2"></i>Reset Filter
                    </button>
                </div>
            </div>
        `;

            // Tampilkan empty state di container
            $tableContainer.html(emptyStateHtml);

            // Update info pagination ke 0
            this.updatePaginationInfo(0, 0, 0);

            return;
        }

        // --- ADA DATA, TAMPILKAN TABEL ---

        // Sembunyikan empty state jika ada
        $tableContainer.find('.empty-state').remove();

        // Pastikan tabel dan kontrol pagination terlihat
        $(this.tableId).show();
        $('#surveiTableWrapper').show();
        $('.pagination-container').show();
        $('#pageSize').closest('.row').show();

        // Hitung total halaman
        const totalPages = Math.ceil(filteredData.length / this.pageSize);

        // Potong data untuk halaman saat ini
        const start = (this.currentPage - 1) * this.pageSize;
        const end = start + this.pageSize;
        const pageData = filteredData.slice(start, end);

        // Pastikan struktur tabel ada
        if ($tableContainer.find(this.tableId).length === 0) {
            $tableContainer.html(`
            <table id="surveiTable" class="table table-bordered table-striped table-hover mb-0" style="min-width: 100%;">
                <thead id="surveiHeader"></thead>
                <tbody id="surveiBody"></tbody>
            </table>
        `);
        }

        // 1. Ekstrak data unik untuk Header (Dosen) dan Body (Mahasiswa)
        const dosenSet = new Set();
        const mahasiswaMap = new Map();

        // Gunakan filteredData (semua data) untuk membangun struktur
        filteredData.forEach(item => {
            let dosenNama = item.kelas && item.kelas.dosen ? item.kelas.dosen.nama_lengkap : 'Dosen Unknown';
            dosenSet.add(dosenNama);

            const mhsKey = `${item.nim}-${item.nama_mahasiswa}`;
            if (!mahasiswaMap.has(mhsKey)) {
                mahasiswaMap.set(mhsKey, {
                    nama: item.nama_mahasiswa,
                    nim: item.nim,
                    skorDosen: {}
                });
            }

            const mhsData = mahasiswaMap.get(mhsKey);
            if (!mhsData.skorDosen[dosenNama]) {
                mhsData.skorDosen[dosenNama] = {};
            }

            if (item.kriteria) {
                mhsData.skorDosen[dosenNama][item.kriteria.kode_kriteria] = item.skor;
            }
        });

        const listDosen = Array.from(dosenSet).sort();
        const listKriteria = this.allKriteriaData.map(k => k.kode_kriteria);

        // Buat array mahasiswa dari Map
        const allMahasiswa = Array.from(mahasiswaMap.values());

        // Filter untuk halaman saat ini
        const pageMahasiswa = allMahasiswa.slice(start, end);

        // 2. Render Header Dinamis dengan 2 baris
        let headerHtml = '';

        // Baris pertama - Nama Dosen
        headerHtml += '<tr class="bg-light text-center">';
        headerHtml += '<th rowspan="2" class="align-middle" style="min-width: 100px; vertical-align: middle;">NIM</th>';
        headerHtml += '<th rowspan="2" class="align-middle" style="min-width: 150px; vertical-align: middle;">Nama Mahasiswa</th>';

        listDosen.forEach(dosen => {
            headerHtml += `<th colspan="${listKriteria.length}" class="border-left text-center" style="min-width: ${listKriteria.length * 60}px;">${dosen}</th>`;
        });
        headerHtml += '</tr>';

        // Baris kedua - Kriteria
        headerHtml += '<tr class="bg-light text-center">';

        listDosen.forEach((dosen, index) => {
            listKriteria.forEach((kode, idx) => {
                const kriteria = this.allKriteriaData.find(k => k.kode_kriteria === kode);
                const tooltip = kriteria ? `${kriteria.nama_kriteria} (${kriteria.jenis}) - Bobot: ${kriteria.bobot}` : kode;
                const borderClass = idx === 0 ? 'border-left' : '';
                headerHtml += `<th class="${borderClass}" style="min-width: 60px;" data-toggle="tooltip" title="${tooltip}">${kode}</th>`;
            });
        });
        headerHtml += '</tr>';

        $(this.headerId).html(headerHtml);

        // 3. Render Body Dinamis
        let bodyHtml = '';
        pageMahasiswa.forEach(mhs => {
            let row = '<tr>';
            row += `<td class="font-weight-bold">${mhs.nim || '-'}</td>`;
            row += `<td>${mhs.nama || '-'}</td>`;

            listDosen.forEach((dosen, dosenIndex) => {
                const skor = mhs.skorDosen[dosen] || {};

                listKriteria.forEach((kode, kriteriaIndex) => {
                    const nilai = skor[kode];
                    const getSkorClass = (s) => {
                        if (s >= 4) return 'text-success font-weight-bold';
                        if (s <= 2 && s !== undefined && s !== null && s !== '-') return 'text-danger';
                        return '';
                    };

                    const borderClass = kriteriaIndex === 0 ? 'border-left' : '';
                    const valueClass = getSkorClass(nilai);

                    row += `<td class="text-center ${borderClass} ${valueClass}">${nilai !== undefined && nilai !== null ? nilai : '-'}</td>`;
                });
            });
            row += '</tr>';
            bodyHtml += row;
        });

        $(this.bodyId).html(bodyHtml);

        // 4. Update informasi pagination
        this.updatePaginationInfo(start + 1, Math.min(end, allMahasiswa.length), allMahasiswa.length);

        // 5. Update status tombol pagination
        this.updatePaginationButtons(totalPages);

        // 6. Inisialisasi tooltip Bootstrap
        if (typeof $().tooltip === 'function') {
            $('[data-toggle="tooltip"]').tooltip();
        }
    }

    updatePaginationInfo(start, end, total) {
        $('#pageInfo').html(`Menampilkan ${start} sampai ${end} dari ${total} data`);
    }

    updatePaginationButtons(totalPages) {
        $('#prevPage').prop('disabled', this.currentPage <= 1);
        $('#nextPage').prop('disabled', this.currentPage >= totalPages);

        if (this.currentPage <= 1) {
            $('#prevPage').addClass('disabled');
        } else {
            $('#prevPage').removeClass('disabled');
        }

        if (this.currentPage >= totalPages) {
            $('#nextPage').addClass('disabled');
        } else {
            $('#nextPage').removeClass('disabled');
        }
    }
}

export default HasilSurveiController;

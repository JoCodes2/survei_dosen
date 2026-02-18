// public/services/history.service.js

class HistoryService {
    constructor() {
        this.container = $('#historyContainer');
        this.apiBaseUrl = `${appUrl}/survei/history/`;
        this.allData = [];
    }

    ajaxRequest(url, method, data = null) {
        return new Promise((resolve, reject) => {
            $.ajax({
                url,
                method,
                data,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: (response) => {
                    if (response.code === 409) {
                        reject({ status: 409, responseJSON: response });
                    } else {
                        resolve(response);
                    }
                },
                error: (xhr) => {
                    reject(xhr);
                }
            });
        });
    }

    async loadFilters() {
        try {
            const resSemester = await this.ajaxRequest(`${appUrl}/survei/semester/`, 'GET');
            if (resSemester.code === 200) {
                let options = '<option value="">-- Semua Semester --</option>';
                resSemester.data.forEach(item => {
                    options += `<option value="${item.id}">${item.nama_semester}</option>`;
                });
                $('#filter_semester').html(options);
            }

            const resProdi = await this.ajaxRequest(`${appUrl}/survei/programstudi/`, 'GET');
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

    async fetchAllData() {
        try {
            const responseData = await this.ajaxRequest(this.apiBaseUrl, 'GET');
            if (responseData.code === 200) {
                this.allData = responseData.data;
            } else {
                this.allData = [];
            }
        } catch (error) {
            this.allData = [];
        }
    }

    filterAndRender(prodiId, semesterId) {
        const filteredData = this.allData.filter(item => {
            let matchProdi = prodiId === "" || item.program_studi_id == prodiId;
            let matchSemester = semesterId === "" || item.semester_id == semesterId;
            return matchProdi && matchSemester;
        });

        this.renderGroupedHistory(filteredData);
    }

    renderEmptyState(message, subMessage) {
        this.container.html(`
            <div class="text-center py-5">
                <i class="fa-solid fa-folder-open fa-4x text-muted mb-3"></i>
                <h5 class="text-muted font-weight-bold">${message}</h5>
                <p class="text-muted small">${subMessage}</p>
            </div>
        `);
    }

    renderGroupedHistory(data) {
        this.container.empty();

        if (this.allData.length === 0) {
            this.renderEmptyState("Belum ada data history", "Lakukan perhitungan MARCOS terlebih dahulu.");
            return;
        }

        if (!data || data.length === 0) {
            this.renderEmptyState("Data tidak ditemukan", "Silakan ubah filter pencarian Anda.");
            return;
        }

        // 1. Kelompokkan data berdasarkan tanggal
        const groupedData = data.reduce((acc, item) => {
            const date = item.created_at.split(' ')[0];
            if (!acc[date]) acc[date] = [];
            acc[date].push(item);
            return acc;
        }, {});

        // 2. Sort kelompok tanggal secara descending
        const sortedDates = Object.keys(groupedData).sort().reverse();

        sortedDates.forEach(date => {
            const formattedDate = new Date(date).toLocaleDateString('id-ID', {
                weekday: 'long', year: 'numeric', month: 'long', day: 'numeric'
            });

            // 3. Urutkan item di dalam grup berdasarkan peringkat ASC
            groupedData[date].sort((a, b) => a.peringkat - b.peringkat);

            // Membuat Card untuk setiap kelompok tanggal
            let html = `
                <div class="card shadow-sm mb-4 border-left-primary">
                    <div class="card-header bg-white py-3">
                        <h6 class="m-0 font-weight-bold text-primary">
                            <i class="fa-solid fa-calendar-days mr-2"></i> ${formattedDate}
                        </h6>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover table-striped table-sm mb-0">
                                <thead class="bg-light">
                                    <tr>
                                        <th class="text-center" style="width: 10%">Peringkat</th>
                                        <th>Nama Dosen</th>
                                        <th class="text-center">Nilai Akhir (F)</th>
                                        <th class="text-center">Nilai Ideal (K+)</th>
                                        <th class="text-center">Nilai Buruk (K-)</th>
                                    </tr>
                                </thead>
                                <tbody>
            `;

            groupedData[date].forEach((item) => {
                // Styling peringkat berdasarkan nilai menggunakan class button (btn)
                let rankBtn = '';
                if (item.peringkat == 1) rankBtn = '<button class="btn btn-warning btn-sm btn-circle font-weight-bold"><i class="fa-solid fa-crown"></i></button>';
                else if (item.peringkat == 2) rankBtn = '<button class="btn btn-secondary btn-sm btn-circle font-weight-bold">2</button>';
                else if (item.peringkat == 3) rankBtn = '<button class="btn btn-danger btn-sm btn-circle font-weight-bold">3</button>';
                else rankBtn = `<button class="btn btn-light btn-sm btn-circle font-weight-bold text-dark" style="border: 1px solid #ddd;">${item.peringkat}</button>`;

                html += `
                    <tr>
                        <td class="text-center">${rankBtn}</td>
                        <td class="font-weight-bold text-dark align-middle">${item.dosen ? item.dosen.nama_lengkap : '-'}</td>
                        <td class="text-center text-success font-weight-bold align-middle">${parseFloat(item.nilai_akhir_f).toFixed(2)}</td>
                        <td class="text-center text-muted small align-middle">${parseFloat(item.nilai_si_ideal).toFixed(2)}</td>
                        <td class="text-center text-muted small align-middle">${parseFloat(item.nilai_si_buruk).toFixed(2)}</td>
                    </tr>
                `;
            });

            html += `
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            `;

            this.container.append(html);
        });
    }
}

export default HistoryService;

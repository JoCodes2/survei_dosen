class kelasService {
    constructor() {
        this.table = $('#kelasTable');
        this.apiBaseUrl = `${appUrl}/survei/jadwal/`;
        this.allData = [];
    }


    ajaxRequest(url, method, data = null) {
        return new Promise((resolve, reject) => {
            $.ajax({
                url,
                method,
                data,
                processData: false,
                contentType: false,
                success: (response) => resolve(response),
                error: (error) => reject(error),
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

    async fetchData() {
        try {
            const responseData = await this.ajaxRequest(this.apiBaseUrl, 'GET');
            if (responseData.code === 200) {
                this.allData = responseData.data;
            } else {
                this.allData = [];
            }
        } catch (error) {
            console.error('Error fetching data:', error);
            this.allData = [];
        }
    }

    async getAllData() {
        if (!$.fn.dataTable.isDataTable(this.table)) {
            this.table.DataTable({
                pageLength: 10,
                responsive: true,
                language: {
                    // Konfigurasi pesan kustom saat data kosong
                    emptyTable: `
                        <div class="py-5 text-muted text-center">
                            <i class="fa-solid fa-chalkboard fa-3x mb-3"></i><br>
                            Data kelas tidak ditemukan .
                        </div>`
                }
            });
        }
        let datatable = this.table.DataTable();

        if (this.allData.length === 0) {
            await this.fetchData();
        }

        const prodiId = $('#filter_program_studi').val();
        const semesterId = $('#filter_semester').val();

        const filteredData = this.allData.filter(item => {
            let matchProdi = prodiId === "" || item.program_studi_id === prodiId;
            let matchSemester = semesterId === "" || item.semester_id === semesterId;

            return matchProdi && matchSemester;
        });

        datatable.clear();

        if (filteredData.length > 0) {
            filteredData.forEach((item, index) => {
                const actions = `
                    <div class="d-flex justify-content-center gap-2">
                        <button class="btn btn-info btn-sm btnEdit" data-id="${item.id}" title="Edit">
                            <i class="fa fa-edit text-white"></i>
                        </button>
                        <button class="btn btn-danger btn-sm btnHapus" data-id="${item.id}" title="Hapus">
                            <i class="fa fa-trash"></i>
                        </button>
                    </div>`;

                datatable.row.add([
                    `<div class="text-center">${index + 1}</div>`,
                    `<div class="text-center fw-bold text-primary">${item.kelas}</div>`,
                    `<div>
                        <strong>${item.dosen ? item.dosen.nama_lengkap : '-'}</strong><br>
                        <small class="text-muted">NIDN: ${item.dosen ? item.dosen.nidn : '-'}</small>
                     </div>`,
                    `<div>${item.program_studi ? item.program_studi.nama_prodi : '-'}</div>`,
                    `<div>${item.semester ? item.semester.nama_semester : '-'}</div>`,
                    actions
                ]);
            });

            datatable.draw();
        } else {
            console.log('data not found');
        }
    }


    async upsertData(formElement, checkingEdit) {
        const submitButton = $('#btnSimpanGelombang');
        const originalText = submitButton.html();

        try {
            const formData = new FormData(formElement);

            if (!$('#is_aktif').is(':checked')) {
                formData.set('is_aktif', 0);
            }

            submitButton.attr('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Loading...');

            let responseData;
            if (checkingEdit()) {
                const id = $('#id').val();
                responseData = await this.ajaxRequest(`${appUrl}/survei/jadwal/update/${id}`, 'POST', formData);
            } else {
                responseData = await this.ajaxRequest(`${appUrl}/survei/jadwal/create`, 'POST', formData);
            }

            successAlert().then(() => {
                $('#modalTambahGelombang').modal('hide');
                realoadBrowser();
                submitButton.attr('disabled', false).html(originalText);
            });

        } catch (error) {
            submitButton.attr('disabled', false).html(originalText);

            if (error.status === 422 || error.response?.status === 422) {
                warningAlert();
                const errors = error.responseJSON?.data ?? error.response?.data;
                const validator = $('#formGelombang').validate();

                const errorList = {};
                $.each(errors, function (field, messages) {
                    errorList[field] = messages[0];
                });
                validator.showErrors(errorList);
                return;
            }

            console.error("Detail Error:", error);
            errorAlert();
        }
    }



    async getDataById(id) {
        try {
            const responseData = await this.ajaxRequest(`${appUrl}/survei/jadwal/get/${id}`, 'GET');

            const item = responseData.data;

            $('#modalTambahGelombang').modal('show');

            $('#modalTambahGelombang .modal-title').text('Edit Gelombang Pengajuan');

            $('#id').val(item.id);
            $('#tahun_ajaran').val(item.tahun_ajaran);
            $('#semester').val(item.semester);
            $('#gelombang_ke').val(item.gelombang_ke);
            $('#tgl_mulai').val(item.tgl_mulai);
            $('#tgl_selesai').val(item.tgl_selesai);

            if (item.is_aktif == 1) {
                $('#is_aktif').prop('checked', true);
            } else {
                $('#is_aktif').prop('checked', false);
            }

            $('#formGelombang').validate().resetForm();
            $('#formGelombang .form-control').removeClass('is-invalid');

        } catch (error) {
            console.error('Error saat mengambil data:', error);
            errorAlert("Gagal mengambil data detail gelombang.");
        }
    }

    async deleteData(id) {
        // Memanggil confirmAlert1 dengan parameter: title, text, dan callback
        confirmAlert1(
            "Hapus Data",
            "Apakah Anda yakin ingin menghapus data gelombang ini?",
            async () => {
                // Bagian ini adalah callback yang dijalankan jika user menekan "Ya"
                try {
                    const responseData = await this.ajaxRequest(`${appUrl}/survei/jadwal/delete/${id}`, 'DELETE');

                    if (responseData.code === 200) {
                        // Jika sukses, tampilkan successAlert lalu reload
                        await successAlert();
                        realoadBrowser();
                    } else {
                        // Jika gagal dari sisi server
                        errorAlert(responseData.message || "Gagal menghapus data");
                    }
                } catch (error) {
                    // Jika terjadi error pada request (network, dll)
                    console.error('Error delete:', error);
                    errorAlert("Terjadi kesalahan sistem");
                }
            }
        );
    }

}

export default kelasService;

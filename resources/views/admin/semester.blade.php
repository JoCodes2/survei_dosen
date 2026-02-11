@extends('Layouts.Base')
@section('content')
    <div class="card">
        <div class="card-header py-3 d-flex align-items-center justify-content-between">
            <h3 class="m-0 font-weight-bold">
                <i class="fa-solid fa-calendar-alt pr-2"></i> Semester
            </h3>

            <button type="button" class="btn btn-primary btn-sm" id="btnTambah">
                <i class="fa fa-plus"></i> Tambah
            </button>
        </div>

        <div class="card-body py-2">
            <div class="py-3">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Semester</th>
                            <th>Tahun Akademik</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="tBody">
                        <tr>
                            <td colspan="5" class="text-center">Memuat data...</td>
                        </tr>
                    </tbody>
                </table>
            </div>


        </div>



    </div>

    {{-- Modal --}}
    <div class="modal fade" id="DataModal" tabindex="-1" aria-labelledby="DataModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="DataModalLabel">Data Semester</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <form id="upsertdataForm" method="POST">
                        @csrf
                        <input type="hidden" id="id" name="id">

                        {{-- Kode Kriteria --}}
                        <div class="mb-3">
                            <label for="nama_semester" class="form-label">Nama Semester</label>
                            <input type="text" class="form-control" name="nama_semester" id="nama_semester"
                                maxlength="10" placeholder="Ganjil/Genap/Semester">
                            <div class="invalid-feedback" id="nama_semester-error"></div>
                        </div>

                        {{-- Nama Kriteria --}}
                        <div class="mb-3">
                            <label for="tahun_akademik" class="form-label">Tahun Akademik</label>
                            <input type="text" class="form-control" name="tahun_akademik" id="tahun_akademik"
                                maxlength="100" placeholder="Masukkan tahun akademik">
                            <div class="invalid-feedback" id="tahun_akademik-error"></div>
                        </div>

                    </form>
                </div>


                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-primary" id="simpanData">Simpan</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {

            function showX(val) {
                return val && val.trim() !== '' ?
                    val :
                    "<span class='text-danger fw-bold'>x</span>";
            }


            // Ambil data user
            function getData() {
                $.ajax({
                    url: "/survei/semester",
                    method: "GET",
                    dataType: "json",
                    success: function(response) {
                        console.log(response);
                        let tableBody = "";
                        $.each(response.data, function(index, item) {
                            tableBody += "<tr>";
                            tableBody += "<td>" + (index + 1) + "</td>";
                            tableBody += "<td>" + item.nama_semester + "</td>";
                            tableBody += "<td>" + item.tahun_akademik + "</td>";
                            tableBody +=
                                "<td><input type='checkbox' class='form-check-input toggle-active' data-id='" +
                                item.id + "' " + (item.is_active ? 'checked' : '') + "></td>";

                            tableBody += "<td>";
                            tableBody +=
                                "<button type='button' class='btn btn-outline-primary btn-sm edit-btn' data-id='" +
                                item.id + "'><i class='fas fa-edit'></i></button> ";
                            tableBody +=
                                "<button type='button' class='btn btn-outline-danger btn-sm delete-confirm' data-id='" +
                                item.id + "'><i class='fas fa-trash'></i></button>";
                            tableBody += "</td>";
                            tableBody += "</tr>";
                        });

                        $("#tBody").html(tableBody);

                        $('#tBody').closest('table').DataTable({
                            destroy: true,
                            paging: true,
                            searching: true,
                            ordering: true,
                            info: true,
                            order: []
                        });
                    },
                    error: function() {
                        console.log("Gagal mengambil data dari server");
                    }
                });
            }

            getData();

            // create & update
            $(document).on('click', '#simpanData', function(e) {
                e.preventDefault();
                clearErrors();

                let id = $('#id').val();
                let formData = new FormData($('#upsertdataForm')[0]);
                let url = id ? `/survei/semester/update/${id}` : '/survei/semester/create';

                loadingAllert();

                $.ajax({
                    type: 'POST',
                    url: url,
                    data: formData,
                    contentType: false,
                    processData: false,

                    success: function(response) {
                        Swal.close();

                        // ✅ SUCCESS SAJA
                        if (response.code === 200 || response.status === 'success') {
                            successAlert(response.message ?? 'Data berhasil disimpan!');
                            $('#DataModal').modal('hide');

                            setTimeout(() => {
                                location.reload();
                            }, 1000);
                        }
                    },

                    error: function(xhr) {
                        Swal.close();

                        // ✅ VALIDASI FORM (INI INTINYA)
                        if (xhr.status === 422) {
                            let errors = xhr.responseJSON.data; // 🔥 PENTING

                            $.each(errors, function(key, value) {
                                let input = $('#' + key);
                                let errorEl = $('#' + key + '-error');

                                input.addClass('is-invalid');
                                errorEl.text(value[0]);
                            });

                            return;
                        }

                        console.error(xhr.responseText);
                        errorAlert();
                    }
                });
            });

            // // Edit data button click handler
            $(document).on('click', '.edit-btn', function() {
                let id = $(this).data('id');
                $.ajax({
                    url: `/survei/semester/get/${id}`,
                    method: "GET",
                    dataType: "json",
                    success: function(response) {
                        console.log(response);
                        $('#DataModal').modal('show');
                        $('#DataModalLabel').text('Edit Semester');
                        $('#id').val(response.data.id);
                        $('#nama_semester').val(response.data.nama_semester);
                        $('#tahun_akademik').val(response.data.tahun_akademik);
                        $('#is_active').val(response.data.is_active);

                    },
                    error: function(xhr, status, error) {
                        console.error('Error fetching data for edit:', error);
                        errorAlert();
                    }
                });
            });

            // Delete data button click handler
            $(document).on('click', '.delete-confirm', function() {
                let id = $(this).data('id');

                function deleteData() {
                    $.ajax({
                        type: 'DELETE',
                        url: `/survei/semester/delete/${id}`,
                        dataType: 'json',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            console.log(response);

                            if (response.code === 200 || response.status === "success") {
                                successAlert('Data berhasil dihapus!');

                                // 🔥 AUTO RELOAD BROWSER
                                setTimeout(() => {
                                    location.reload();
                                }, 1000);

                            } else {
                                errorAlert();
                            }
                        },
                        error: function(xhr) {
                            console.error('Error:', xhr.responseText);
                            errorAlert();
                        }
                    });
                }

                confirmAlert('Apakah Anda yakin ingin menghapus data?', deleteData);
            });



            function clearErrors() {
                $('.is-invalid').removeClass('is-invalid');
                $('.invalid-feedback').text('');
            }

            $(document).on('input change', '#upsertdataForm input, #upsertdataForm textarea', function() {
                $(this).removeClass('is-invalid');
                $('#' + this.id + '-error').text('');
            });

            // Tampilkan modal tambah
            $(document).on('click', '#btnTambah', function() {
                $('#upsertdataForm')[0].reset(); // reset form
                $('#id').val('');
                clearErrors();
                $('#DataModalLabel').text('Tambah Dosen');
                $('#DataModal').modal('show');
            });

            // Reset saat modal ditutup
            $('#DataModal').on('hidden.bs.modal', function() {
                $('#upsertdataForm')[0].reset();
                $('#id').val('');
                clearErrors();
            });

            // Toggle active status
            $(document).on('change', '.toggle-active', function() {
                let checkbox = $(this);
                let id = checkbox.data('id');
                let isChecked = checkbox.is(':checked');

                checkbox.prop('disabled', true);

                $.ajax({
                    type: 'POST',
                    url: `/survei/semester/toggle-active/${id}`,
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        if (response.code === 200 || response.status === 'success') {
                            // Success, checkbox already toggled
                        } else {
                            // Revert on failure
                            checkbox.prop('checked', !isChecked);
                            errorAlert('Gagal mengubah status!');
                        }
                    },
                    error: function(xhr) {
                        // Revert on error
                        checkbox.prop('checked', !isChecked);
                        errorAlert('Terjadi kesalahan saat mengubah status!');
                    },
                    complete: function() {
                        checkbox.prop('disabled', false);
                    }
                });
            });

        });
    </script>
@endsection

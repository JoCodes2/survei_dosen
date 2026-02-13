import kelasService from "../services/kelas.service.js";


$(document).ready(function () {
    const kelas = new kelasService();
    kelas.loadFilters();
    kelas.getAllData();
    kelas.loadOptions();
    $(document).on('click', '#btnFilter', function () {
        kelas.getAllData();
    });

    $('#btnTambahKelas').on('click', function () {
        $('#formKelas')[0].reset();
        $('#id').val('');
        $('#dosen_id').val('');
        $('#program_studi_id').val('');
        $('#semester').val('');

        $('#formKelas .form-control').removeClass('is-valid is-invalid');
        $('.error-msg').text('');

        $('#modalTambahKelas').modal('show');
    });

    // Fungsi Validasi
    function validation() {
        $('#formKelas').validate({
            rules: {
                kelas: { required: true },
                semester_id: { required: true },
                program_studi_id: { required: true },
                dosen_id: { required: true },

            },
            messages: {
                kelas: { required: "Kelas tidak boleh kosong" },
                semester_id: { required: "Pilih semester" },
                program_studi_id: { required: "Pilih program studi" },
                dosen_id: { required: "Pilih dosen" },
            },
            errorElement: 'small',
            errorPlacement: function (error, element) {
                error.addClass('text-danger');
                const errorId = '#error-' + element.attr('name');
                if ($(errorId).length) {
                    $(errorId).html(error);
                } else {
                    error.insertAfter(element);
                }
            },
            highlight: function (element) {
                $(element).addClass('is-invalid').removeClass('is-valid');
            },
            unhighlight: function (element) {
                $(element).removeClass('is-invalid').addClass('is-valid');
            }
        });
    }

    validation();

    $('#semester_id, #program_studi_id, #dosen_id').on('change input', function () {
        $(this).valid();
    });

    function checkingEdit() {
        return $('#id').val() ? true : false;
    }

    $('#btnSimpanKelas').on('click', function (e) {
        e.preventDefault();
        if ($('#formKelas').valid()) {
            kelas.upsertData($('#formKelas')[0], checkingEdit);
        }
    });

    $(document).on('click', '.btnEditKelas', function () {
        const id = $(this).data('id');
        kelas.getDataById(id);

    });

    $(document).on('click', '.btnHapusKelas', function () {
        const id = $(this).data('id');
        kelas.deleteData(id);
    });

    $('#modaTambahKelas').on('hidden.bs.modal', function () {
        $('#formGelombang')[0].reset();
        $('.form-control').removeClass('is-invalid is-valid');
        $('.error-msg').text('');
    });
});

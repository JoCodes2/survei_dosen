// public/controllers/penilaian.controller.js

import SurveiService from "../services/penilaian.service.js";

const surveiService = new SurveiService();

$(document).ready(function () {
    initPage();
    setupEventListeners();
    setupRealtimeValidation();
});

async function initPage() {
    const initialData = await surveiService.getInitialData();
    renderDropdown('#f_prodi', initialData.prodi, 'nama_prodi');
    renderDropdown('#f_semester', initialData.semester, 'nama_semester');

    const kriteria = await surveiService.getKriteria();
    renderQuestions(kriteria);
}

function setupEventListeners() {
    $('#f_prodi, #f_semester').on('change', updateDosenDropdown);
}

function setupRealtimeValidation() {
    $('#f_nim').on('input', function () {
        let sanitized = $(this).val().replace(/[^0-9]/g, '');
        $(this).val(sanitized);

        if (sanitized.trim() !== "") {
            $(this).removeClass('border-red-500').addClass('border-green-500');
            $('#f_nim-error').hide();
        } else {
            $(this).removeClass('border-green-500').addClass('border-red-500');
        }
    });

    $('#f_nama').on('input', function () {
        if ($(this).val().trim() !== "") {
            $(this).removeClass('border-red-500').addClass('border-green-500');
            $('#f_nama-error').hide();
        } else {
            $(this).removeClass('border-green-500').addClass('border-red-500');
        }
    });

    $('#f_prodi, #f_semester').on('change', function () {
        if ($(this).val() !== null && $(this).val() !== "") {
            $(this).removeClass('border-red-500').addClass('border-green-500');
            $(`#${$(this).attr('id')}-error`).hide();
        } else {
            $(this).removeClass('border-green-500').addClass('border-red-500');
        }
    });
}
// ---------------------------------------

function renderDropdown(selector, data, nameField) {
    let options = '<option value="" disabled selected>— Pilih —</option>';
    data.forEach(item => {
        options += `<option value="${item.id}">${item[nameField]}</option>`;
    });
    $(selector).html(options);
}

function renderQuestions(kriteria) {
    const container = $('#questionContainer');
    container.empty();

    kriteria.forEach((krit, index) => {
        const qNum = index + 1;
        const html = `
            <div class="question-item border border-[rgba(27,79,216,0.2)] rounded-2xl p-4 transition-all hover:border-[#1B4FD8]/30 hover:shadow-md">
                <div class="flex items-start gap-3 mb-4">
                    <span class="w-6 h-6 bg-[#1B4FD8] text-white rounded-lg text-[11px] font-bold flex items-center justify-center shrink-0 mt-0.5">${qNum}</span>
                    <div class="flex-1">
                        <p class="text-xs font-bold text-[#1B4FD8] uppercase tracking-wider mb-1">Pertanyaan</p>
                        <p class="text-sm font-semibold text-[#0B2A4A] leading-relaxed">${krit.nama_kriteria} ?</p>
                    </div>
                </div>
                <div class="rating-wrap flex gap-2">
                    <input type="radio" name="skor_kriteria[${krit.id}]" id="q${qNum}v1" value="1" required><label for="q${qNum}v1">1</label>
                    <input type="radio" name="skor_kriteria[${krit.id}]" id="q${qNum}v2" value="2" required><label for="q${qNum}v2">2</label>
                    <input type="radio" name="skor_kriteria[${krit.id}]" id="q${qNum}v3" value="3" required><label for="q${qNum}v3">3</label>
                    <input type="radio" name="skor_kriteria[${krit.id}]" id="q${qNum}v4" value="4" required><label for="q${qNum}v4">4</label>
                    <input type="radio" name="skor_kriteria[${krit.id}]" id="q${qNum}v5" value="5" required><label for="q${qNum}v5">5</label>
                </div>
            </div>
        `;
        container.append(html);
    });
}

async function updateDosenDropdown() {
    const prodiId = $('#f_prodi').val();
    const semId = $('#f_semester').val();
    const container = $('#dosenList');
    container.empty();

    if (prodiId && semId) {
        container.html('<p class="text-sm text-center text-slate-400">Memuat data dosen...</p>');
        const dataJadwal = await surveiService.getDosenByProdiSemester(prodiId, semId);

        container.empty();
        if (dataJadwal.length === 0) {
            container.html('<p class="text-sm text-center text-slate-400">Tidak ada jadwal untuk prodi/semester ini.</p>');
            return;
        }

        dataJadwal.forEach(item => {
            const namaDosen = item.dosen ? item.dosen.nama_lengkap : 'Dosen Tidak Diketahui';
            const idJadwal = item.id;

            const html = `
                <div class="dosen-card" onclick="selectDosen(this, '${namaDosen}', '${idJadwal}')">
                    <div class="w-10 h-10 bg-[rgba(27,79,216,0.08)] rounded-xl flex items-center justify-center text-[#1B4FD8] text-sm shrink-0">
                        <i class="fas fa-user-tie"></i>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="font-bold text-[#0B2A4A] text-sm truncate">${namaDosen}</p>
                    </div>
                    <i class="fas fa-circle-check text-white opacity-0 text-lg transition-opacity" style="color: #1B4FD8;"></i>
                </div>
            `;
            container.append(html);
        });
    }
}

window.selectDosen = function (element, namaDosen, idJadwal) {
    $('.dosen-card').removeClass('selected').find('.fa-circle-check').css('opacity', '0');
    $(element).addClass('selected').find('.fa-circle-check').css('opacity', '1');

    if ($('#selected_kelas_id').length === 0) {
        $('#formPenilaian').append('<input type="hidden" name="kelas_id" id="selected_kelas_id">');
    }

    $('#selected_kelas_id').val(idJadwal);
    window.selectedDosenName = namaDosen;
    $('#err_dosen').hide();

    // Beri efek visual bahwa step 2 selesai
    $('#step2Indicator').addClass('text-green-600').removeClass('text-slate-400');
}

window.submitSurvei = async function () {
    const nama = $('#f_nama').val();
    const nim = $('#f_nim').val();
    const prodi = $('#f_prodi').val();
    const semester = $('#f_semester').val();
    const kelasId = $('#selected_kelas_id').val();

    let skorKriteria = {};
    $('#questionContainer .rating-wrap').each(function () {
        const radioChecked = $(this).find('input[type="radio"]:checked');
        if (radioChecked.length > 0) {
            const nameAttr = radioChecked.attr('name');
            const kriteriaId = nameAttr.match(/\[(.*?)\]/)[1];
            skorKriteria[kriteriaId] = radioChecked.val();
        }
    });

    const payload = {
        nama_mahasiswa: nama,
        nim: nim,
        kelas_id: kelasId,
        skor_kriteria: skorKriteria
    };

    confirmAlert('Apakah Anda yakin data yang diisi sudah benar dan ingin mengirim survei ini?', async () => {
        try {
            loadingAllert();
            const response = await surveiService.submitPenilaianJSON(payload);
            Swal.close();

            if (response && (response.code === 200 || response.code === 201)) {
                successAlert('Survei berhasil dikirim.');
                goStep(5);
                $('#final_score').text(window.currentAverageScore || '—');
            } else if (response && response.code === 422) {
                let errorMessages = [];
                $.each(response.data, function (key, messages) {
                    errorMessages.push(messages[0]);
                });
                warningAlert(errorMessages.join('\n'));
            } else {
                errorAlert();
            }
        } catch (error) {
            Swal.close();
            errorAlert('Terjadi kesalahan sistem.');
        }
    });
}

window.goStep = function (step, validationFn = null) {
    if (validationFn && !validationFn()) return;

    $('.step-panel').removeClass('active');
    $(`#step${step}`).addClass('active');

    for (let i = 1; i <= 4; i++) {
        if (i < step) {
            $(`#dot${i}`).css('width', '8px').removeClass('bg-[#1B4FD8]').addClass('bg-[#1B4FD8]/30');
        } else if (i === step) {
            $(`#dot${i}`).css('width', '28px').addClass('bg-[#1B4FD8]').removeClass('bg-[#1B4FD8]/30');
        } else {
            $(`#dot${i}`).css('width', '8px').removeClass('bg-[#1B4FD8]').addClass('bg-[rgba(27,79,216,0.15)]');
        }
    }
    $('#stepLabel').text(`Langkah ${step} / 4`);

    if (step === 4) populateReview();
}

window.validateStep1 = function () {
    let valid = true;
    const fields = ['#f_nama', '#f_nim', '#f_prodi', '#f_semester'];

    fields.forEach(field => {
        if (!$(field).val()) {
            $(field).addClass('border-red-500 shake').removeClass('border-green-500');
            $(`${field}-error`).show();
            valid = false;

            setTimeout(() => $(field).removeClass('shake'), 500);
        } else {
            $(field).removeClass('border-red-500').addClass('border-green-500');
            $(`${field}-error`).hide();
        }
    });

    return valid;
}

window.validateStep2 = function () {
    const selectedDosenId = $('#selected_kelas_id').val();
    if (!selectedDosenId || selectedDosenId === 'undefined') {
        $('#dosenList').addClass('border-2 border-red-500 rounded-2xl p-2 shake');
        $('#err_dosen').show();

        setTimeout(() => $('#dosenList').removeClass('shake'), 500);
        return false;
    }
    $('#dosenList').removeClass('border-2 border-red-500').addClass('border-green-500');
    $('#err_dosen').hide();
    return true;
}

window.validateStep3 = function () {
    let valid = true;
    let totalScore = 0;
    let questionCount = 0;

    $('.question-item').removeClass('border-red-500').addClass('border-[rgba(27,79,216,0.2)]');

    $('#questionContainer .rating-wrap').each(function () {
        questionCount++;
        const val = $(this).find('input[type="radio"]:checked').val();
        if (!val) {
            valid = false;
            $(this).closest('.question-item').removeClass('border-[rgba(27,79,216,0.2)]').addClass('border-red-500 shake');
        } else {
            totalScore += parseInt(val);
        }
    });

    if (!valid) {
        $('#err_questions').show();
        setTimeout(() => $('.question-item').removeClass('shake'), 500);
        return false;
    }
    $('#err_questions').hide();

    window.currentAverageScore = (totalScore / questionCount).toFixed(1);
    return true;
}
// ------------------------------------------

function populateReview() {
    $('#rev_nama').text($('#f_nama').val());
    $('#rev_nim').text($('#f_nim').val());
    $('#rev_prodi').text(`${$('#f_prodi option:selected').text()} / ${$('#f_semester option:selected').text()}`);
    $('#rev_dosen').text(window.selectedDosenName);
    $('#rev_score').text(window.currentAverageScore);
}

window.resetForm = function () {
    document.getElementById('formPenilaian').reset();
    $('.dosen-card').removeClass('selected');
    $('input, select').removeClass('border-red-500 border-green-500');
    goStep(1);
}

import HistoryService from "../services/history.service.js";

$(document).ready(function () {
    const service = new HistoryService();

    // Inisialisasi
    initPage(service);

    // Event Submit Form Filter
    $('#formFilterData').on('submit', function (e) {
        e.preventDefault();

        // Ambil filter dan jalankan filter di sisi klien
        const prodiId = $('#filter_program_studi').val();
        const semesterId = $('#filter_semester').val();
        service.filterAndRender(prodiId, semesterId);
    });
});

async function initPage(service) {
    $('#loadingOverlay').show();
    await service.loadFilters(); // Load opsi dropdown
    await service.fetchAllData(); // Ambil SEMUA data sekali saja
    $('#loadingOverlay').hide();
}

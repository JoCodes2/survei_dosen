import HasilSurveiController from "../services/hasil-survei.service.js";

$(document).ready(function () {
    const hasil = new HasilSurveiController();
    hasil.init();
});

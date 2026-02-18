// public/controllers/hasil-survei.controller.js

import HasilSurveiService from "../services/hasil-survei.service.js";

$(document).ready(function () {
    const survei = new HasilSurveiService();

    if (typeof survei.init === 'function') {
        survei.init();
    }

    $(document).on('click', '#btnTampilkan', function (e) {
        e.preventDefault();
    });

    $(document).on('click', '#btnHitungMarcos', function () {
        survei.hitungMarcos();
    });
    $(document).on('click', '#btnSimpanHistory', function () {
        survei.simpanHistory();
    });
});


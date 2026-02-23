/**
 * Global Helper Alert SICICI
 * Theme: Blue & White
 */

// reload browser
function realoadBrowser() {
    window.location.reload();
}

// alert confirm message (Versi General)
function confirmAlert(message, callback) {
    Swal.fire({
        title: '<span style="font-size: 20px; font-weight: 600;">Konfirmasi</span>',
        text: message,
        icon: 'question',
        showCancelButton: true,
        showConfirmButton: true,
        cancelButtonText: 'Tidak',
        confirmButtonText: 'Ya, Lanjutkan',
        reverseButtons: true,
        confirmButtonColor: '#0026ff', // Biru Utama SICICI
        cancelButtonColor: '#ffffff', // Putih
        customClass: {
            cancelButton: 'border text-dark', // Beri border agar tombol putih terlihat
            popup: 'rounded-4'
        }
    }).then((result) => {
        if (result.isConfirmed && typeof callback === "function") {
            callback();
        }
    });
}

// alert success message
function successAlert(message) {
    return Swal.fire({
        title: '<span style="font-weight: 600;">Berhasil!</span>',
        text: message,
        icon: 'success',
        iconColor: '#0026ff',
        showConfirmButton: false,
        timer: 1500,
        customClass: {
            popup: 'rounded-4'
        }
    });
}

// alert error message
function errorAlert(message = 'Terjadi kesalahan!') {
    return Swal.fire({
        title: '<span style="font-weight: 600;">Error</span>',
        text: message,
        icon: 'error',
        showConfirmButton: true,
        confirmButtonColor: '#0026ff',
        customClass: {
            popup: 'rounded-4'
        }
    });
}

// alert warning message
function warningAlert(message) {
    Swal.fire({
        title: '<span style="font-weight: 600;">Peringatan!</span>',
        text: message,
        icon: 'warning',
        showConfirmButton: true,
        confirmButtonText: 'Ok',
        confirmButtonColor: '#0026ff',
        customClass: {
            popup: 'rounded-4'
        }
    });
}

// alert login error
function emailOrPasswordWrong() {
    return Swal.fire({
        title: 'Gagal Login',
        text: 'Username atau password anda salah!',
        icon: 'warning',
        confirmButtonColor: '#0026ff',
        customClass: {
            popup: 'rounded-4'
        }
    });
}

// loading alert
const loadingAllert = (title = 'Mohon Tunggu', text = 'Sedang memproses data...') => {
    return Swal.fire({
        title: title,
        text: text,
        allowOutsideClick: false,
        allowEscapeKey: false,
        allowEnterKey: false,
        showConfirmButton: false,
        didOpen: () => {
            Swal.showLoading();
            // Menyesuaikan warna loader ke biru
            const loader = Swal.getHtmlContainer().querySelector('.swal2-loader');
            if (loader) loader.style.borderTopColor = '#0026ff';
        }
    });
};

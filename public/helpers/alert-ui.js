// reload browser
function realoadBrowser() {
    window.location.reload();
}

// alert success message - Tema Biru Putih
function successAlert(message) {
    return Swal.fire({
        title: '<span class="font-playfair text-2xl" style="color: #0B2A4A;">Berhasil!</span>',
        text: message,
        icon: 'success',
        iconColor: '#1B4FD8', // Biru Utama
        showConfirmButton: false,
        timer: 1500,
        customClass: {
            popup: 'rounded-2xl shadow-xl',
        }
    });
}

// alert confirm message - Tema Biru Putih
function confirmAlert(message, callback) {
    Swal.fire({
        title: '<span class="font-playfair text-xl" style="color: #0B2A4A;">Konfirmasi!</span>',
        text: message,
        icon: 'question',
        iconColor: '#1B4FD8', // Biru Utama
        showCancelButton: true,
        confirmButtonText: 'Ya, Lanjutkan',
        cancelButtonText: 'Batal',
        reverseButtons: true,
        confirmButtonColor: '#1B4FD8', // Biru Utama
        cancelButtonColor: '#F3F4F6', // Abu-abu muda
        customClass: {
            popup: 'rounded-2xl',
            confirmButton: 'rounded-lg px-6 py-2 font-medium',
            cancelButton: 'rounded-lg px-6 py-2 font-medium text-gray-700'
        }
    }).then((result) => {
        if (result.isConfirmed && typeof callback === "function") {
            callback();
        }
    });
}

// alert loading message - Tema Biru Putih
const loadingAllert = (title = 'Mohon Tunggu', text = 'Sedang memproses data...') => {
    return Swal.fire({
        title: `<span class="font-playfair text-xl" style="color: #0B2A4A;">${title}</span>`,
        text: text,
        allowOutsideClick: false,
        allowEscapeKey: false,
        allowEnterKey: false,
        showConfirmButton: false,
        // Untuk spinner loading, kita atur warnanya via CSS
        didOpen: () => {
            Swal.showLoading();
            // Memaksa warna spinner menjadi biru
            $('.swal2-loader').css('border-color', '#1B4FD8 transparent #1B4FD8 transparent');
        },
        customClass: {
            popup: 'rounded-2xl',
        }
    });
};

// alert warning message - Tema Biru Putih
function warningAlert(message) {
    return Swal.fire({
        title: '<span class="font-playfair text-xl" style="color: #0B2A4A;">Peringatan!</span>',
        text: message,
        icon: 'warning',
        iconColor: '#FFAD46', // Kuning/Oranye tetap cocok untuk peringatan
        timer: 5000,
        showConfirmButton: true,
        confirmButtonText: 'Ok',
        confirmButtonColor: '#1B4FD8', // Biru Utama
        customClass: {
            popup: 'rounded-2xl',
            confirmButton: 'rounded-lg px-8 py-2'
        }
    });
}

// alert error message - Tema Biru Putih
function errorAlert(message = 'Terjadi kesalahan!') {
    return Swal.fire({
        title: '<span class="font-playfair text-xl" style="color: #0B2A4A;">Error</span>',
        text: message,
        icon: 'error',
        iconColor: '#ef4444', // Merah tetap cocok untuk error
        showConfirmButton: false,
        timer: 2000,
        customClass: {
            popup: 'rounded-2xl',
        }
    });
}

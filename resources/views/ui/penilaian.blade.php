<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Survei Kepuasan Mahasiswa – STMIK Adhi Guna</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('helpers/survei.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script>
        let appUrl = '{{ env('APP_URL') }}';
    </script>
</head>

<body class="min-h-screen bg-slate-50">

    <div class="hero-grad relative overflow-hidden px-5 pt-10 pb-16 sm:pt-14 sm:pb-20">
        <div class="hero-circle-1"></div>
        <div class="hero-circle-2"></div>

        <div class="max-w-lg mx-auto relative z-10">
            <div class="flex items-center gap-3 mb-5">
                <div class="w-12 h-12 bg-white/15 border border-white/20 rounded-2xl flex items-center justify-center text-xl text-white shrink-0">
                    <img src="{{ asset('assets/assets/stmik.png') }}" alt="Logo STMIK" class="w-12 h-12 object-contain">
                </div>
                <div>
                    <p class="text-white/50 text-xs font-medium">STMIK Adhi Guna</p>
                    <p class="text-white font-bold text-sm">Sistem Analisis Interaksi Akademik Mahasiswa dan Dosen STMIK Adhi Guna menggunakan Metode MARCOS</p>
                </div>
            </div>

            <h1 class="text-3xl sm:text-4xl font-extrabold text-white leading-tight mb-3">
                Nilai <span class="text-[#7BC9FF]">Dosen</span> Anda,<br>Bangun Kampus Lebih Baik
            </h1>
            <p class="text-white/50 text-sm leading-relaxed">Penilaian jujur Anda membantu meningkatkan kualitas pengajaran dan interaksi dosen–mahasiswa.</p>
        </div>
    </div>

    <div class="max-w-lg mx-auto px-4 pb-16 -mt-10 relative z-20">

        <div class="bg-white rounded-2xl shadow-card px-6 py-4 mb-4 flex items-center gap-4">
            <div class="flex items-center gap-1.5 flex-1">
                <div id="dot1" class="h-2 w-7 rounded-full bg-[#1B4FD8] transition-all duration-500"></div>
                <div id="dot2" class="h-2 w-2 rounded-full bg-[rgba(27,79,216,0.15)] transition-all duration-500"></div>
                <div id="dot3" class="h-2 w-2 rounded-full bg-[rgba(27,79,216,0.15)] transition-all duration-500"></div>
                <div id="dot4" class="h-2 w-2 rounded-full bg-[rgba(27,79,216,0.15)] transition-all duration-500"></div>
            </div>
            <span id="stepLabel" class="text-xs font-bold text-[#1B4FD8] whitespace-nowrap">Langkah 1 / 4</span>
        </div>

        <form id="formPenilaian">
            @csrf

            <div id="step1" class="step-panel active">
                <div class="bg-white rounded-3xl shadow-card p-6 sm:p-8">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-11 h-11 bg-[rgba(27,79,216,0.08)] rounded-2xl flex items-center justify-center text-[#1B4FD8] shrink-0">
                            <i class="fas fa-user-graduate text-lg"></i>
                        </div>
                        <div>
                            <p class="text-[11px] font-bold uppercase tracking-widest text-[#1B4FD8]/60">Langkah 1</p>
                            <h2 class="text-lg font-bold text-[#0B2A4A]">Data Mahasiswa</h2>
                        </div>
                    </div>
                    <div class="space-y-6">
                        <div>
                            <label class="block text-[11px] font-bold uppercase tracking-widest text-slate-400 mb-1.5">Nama Lengkap <span class="text-red-400">*</span></label>
                            <input id="f_nama" name="nama_mahasiswa" type="text" class="field-input" placeholder="Masukkan nama lengkap Anda">
                            <p id="err_nama" class="text-red-400 text-xs mt-1 hidden"><i class="fas fa-circle-exclamation mr-1"></i>Nama wajib diisi</p>
                        </div>
                        <div>
                            <label class="block text-[11px] font-bold uppercase tracking-widest text-slate-400 mb-1.5">NIM <span class="text-red-400">*</span></label>
                            <input id="f_nim" name="nim" type="text" class="field-input" placeholder="Contoh: 201011000">
                            <p id="err_nim" class="text-red-400 text-xs mt-1 hidden"><i class="fas fa-circle-exclamation mr-1"></i>NIM wajib diisi</p>
                        </div>
                        <div class="grid grid-cols-2 gap-5">
                            <div>
                                <label class="block text-[11px] font-bold uppercase tracking-widest text-slate-400 mb-1.5">Program Studi <span class="text-red-400">*</span></label>
                                <select id="f_prodi" name="prodi_id" class="field-select">
                                    <option value="" disabled selected>— Pilih —</option>
                                </select>
                                <p id="err_prodi" class="text-red-400 text-xs mt-1 hidden"><i class="fas fa-circle-exclamation mr-1"></i>Wajib dipilih</p>
                            </div>
                            <div>
                                <label class="block text-[11px] font-bold uppercase tracking-widest text-slate-400 mb-1.5">Semester <span class="text-red-400">*</span></label>
                                <select id="f_semester" name="semester_id" class="field-select">
                                    <option value="" disabled selected>— Pilih —</option>
                                </select>
                                <p id="err_semester" class="text-red-400 text-xs mt-1 hidden"><i class="fas fa-circle-exclamation mr-1"></i>Wajib dipilih</p>
                            </div>
                        </div>
                    </div>
                    <button type="button" onclick="goStep(2, validateStep1)" class="w-full mt-8 bg-[#1B4FD8] hover:bg-[#2F62EC] active:scale-95 text-white font-bold py-4 rounded-2xl flex items-center justify-center gap-2 transition-all duration-200 shadow-[0_10px_25px_-5px_rgba(27,79,216,0.4)]">
                        Lanjut <i class="fas fa-arrow-right text-sm"></i>
                    </button>
                </div>
            </div>

            <div id="step2" class="step-panel">
                <div class="bg-white rounded-3xl shadow-card p-6 sm:p-8">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-11 h-11 bg-[#E6F2FF] rounded-2xl flex items-center justify-center text-[#7BC9FF] shrink-0">
                            <i class="fas fa-chalkboard-user text-lg"></i>
                        </div>
                        <div>
                            <p class="text-[11px] font-bold uppercase tracking-widest text-[#7BC9FF]/70">Langkah 2</p>
                            <h2 class="text-lg font-bold text-[#0B2A4A]">Pilih Dosen</h2>
                        </div>
                    </div>
                    <p class="text-sm text-slate-400 mb-5">Pilih dosen yang ingin Anda nilai pada survei ini.</p>
                    <div class="space-y-3" id="dosenList">
                        </div>
                    <p id="err_dosen" class="text-red-400 text-xs mt-3 hidden"><i class="fas fa-circle-exclamation mr-1"></i>Pilih satu dosen terlebih dahulu</p>
                    <div class="flex gap-3 mt-7">
                        <button type="button" onclick="goStep(1)" class="flex-1 bg-[#F1F5F9] hover:bg-[rgba(27,79,216,0.08)] border-2 border-[rgba(27,79,216,0.2)] text-[#1B4FD8] font-bold py-3.5 rounded-2xl transition-all active:scale-95">
                            <i class="fas fa-arrow-left mr-2 text-sm"></i>Kembali
                        </button>
                        <button type="button" onclick="goStep(3, validateStep2)" class="flex-[2] bg-[#1B4FD8] hover:bg-[#2F62EC] text-white font-bold py-3.5 rounded-2xl flex items-center justify-center gap-2 transition-all shadow-[0_10px_25px_-5px_rgba(27,79,216,0.4)] active:scale-95">
                            Lanjut <i class="fas fa-arrow-right text-sm"></i>
                        </button>
                    </div>
                </div>
            </div>

            <div id="step3" class="step-panel">
                <div class="bg-white rounded-3xl shadow-card p-6 sm:p-8">
                    <div class="space-y-6" id="questionContainer">

                    </div>
                    <p id="err_questions" class="text-red-400 text-xs mt-4 hidden"><i class="fas fa-circle-exclamation mr-1"></i>Harap jawab semua pertanyaan</p>
                    <div class="flex gap-3 mt-7">
                        <button type="button" onclick="goStep(2)" class="flex-1 bg-[#F1F5F9] hover:bg-[rgba(27,79,216,0.08)] border-2 border-[rgba(27,79,216,0.2)] text-[#1B4FD8] font-bold py-3.5 rounded-2xl transition-all active:scale-95">
                            <i class="fas fa-arrow-left mr-2 text-sm"></i>Kembali
                        </button>
                        <button type="button" onclick="goStep(4, validateStep3)" class="flex-[2] bg-[#1B4FD8] hover:bg-[#2F62EC] text-white font-bold py-3.5 rounded-2xl flex items-center justify-center gap-2 transition-all shadow-[0_10px_25px_-5px_rgba(27,79,216,0.4)] active:scale-95">
                            Lanjut <i class="fas fa-arrow-right text-sm"></i>
                        </button>
                    </div>
                </div>
            </div>

            <div id="step4" class="step-panel">
                <div class="bg-white rounded-3xl shadow-card p-6 sm:p-8">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-11 h-11 bg-[#D1FAE5] rounded-2xl flex items-center justify-center text-[#10B981] shrink-0">
                            <i class="fas fa-paper-plane text-lg"></i>
                        </div>
                        <div>
                            <p class="text-[11px] font-bold uppercase tracking-widest text-[#10B981]/60">Langkah 4</p>
                            <h2 class="text-lg font-bold text-[#0B2A4A]">Review & Kirim</h2>
                        </div>
                    </div>
                    <div class="bg-[#F1F5F9] rounded-2xl p-5 mb-6 space-y-3">
                        <div class="flex items-center justify-between">
                            <span class="text-xs font-bold text-slate-400 uppercase tracking-wide">Mahasiswa</span>
                            <span id="rev_nama" class="text-sm font-bold text-[#0B2A4A] text-right max-w-[55%] truncate"></span>
                        </div>
                        <div class="h-px bg-[rgba(27,79,216,0.15)]"></div>
                        <div class="flex items-center justify-between">
                            <span class="text-xs font-bold text-slate-400 uppercase tracking-wide">NIM</span>
                            <span id="rev_nim" class="text-sm font-bold text-[#0B2A4A]"></span>
                        </div>
                        <div class="h-px bg-[rgba(27,79,216,0.15)]"></div>
                        <div class="flex items-center justify-between">
                            <span class="text-xs font-bold text-slate-400 uppercase tracking-wide">Prodi / Semester</span>
                            <span id="rev_prodi" class="text-sm font-bold text-[#0B2A4A] text-right"></span>
                        </div>
                        <div class="h-px bg-[rgba(27,79,216,0.15)]"></div>
                        <div class="flex items-center justify-between">
                            <span class="text-xs font-bold text-slate-400 uppercase tracking-wide">Dosen Dinilai</span>
                            <span id="rev_dosen" class="text-sm font-bold text-[#0B2A4A] text-right max-w-[55%] truncate"></span>
                        </div>
                    </div>
                    <div class="bg-[#1B4FD8] rounded-2xl p-5 mb-6 flex items-center gap-4">
                        <div class="w-14 h-14 bg-white/15 rounded-2xl flex items-center justify-center shrink-0">
                            <span id="rev_score" class="text-2xl font-extrabold text-white">—</span>
                        </div>
                        <div>
                            <p class="text-white/60 text-xs font-semibold">Rata-rata Penilaian Anda</p>
                            <p class="text-white font-bold text-sm mt-0.5">dari total pertanyaan</p>
                        </div>
                        <div id="rev_stars" class="ml-auto text-yellow-300 text-base tracking-tight"></div>
                    </div>
                    <div class="flex items-start gap-3 bg-[#D1FAE5] border border-[#10B981]/20 rounded-2xl px-4 py-3 mb-7">
                        <i class="fas fa-shield-halved text-[#10B981] mt-0.5 shrink-0"></i>
                        <p class="text-xs text-emerald-700 leading-relaxed">Respons Anda <strong>100% anonim</strong> dan hanya digunakan untuk kepentingan peningkatan kualitas akademik STMIK Adhi Guna.</p>
                    </div>
                    <div class="flex gap-3">
                        <button type="button" onclick="goStep(3)" class="flex-1 bg-[#F1F5F9] hover:bg-[rgba(27,79,216,0.08)] border-2 border-[rgba(27,79,216,0.2)] text-[#1B4FD8] font-bold py-3.5 rounded-2xl transition-all active:scale-95">
                            <i class="fas fa-arrow-left mr-2 text-sm"></i>Edit
                        </button>
                        <button type="button" onclick="submitSurvei()" class="flex-[2] bg-[#10B981] hover:bg-emerald-600 text-white font-bold py-3.5 rounded-2xl flex items-center justify-center gap-2 transition-all shadow-lg shadow-emerald-200 active:scale-95">
                            <i class="fas fa-paper-plane text-sm"></i> Kirim Sekarang
                        </button>
                    </div>
                </div>
            </div>

            <div id="step5" class="step-panel">
                <div class="bg-white rounded-3xl shadow-card p-8 text-center">
                    <div class="w-20 h-20 bg-[#D1FAE5] rounded-full flex items-center justify-center mx-auto mb-5 animate-pop-in">
                        <i class="fas fa-check text-3xl text-[#10B981]"></i>
                    </div>
                    <h2 class="text-2xl font-extrabold text-[#0B2A4A] mb-2">Terima Kasih!</h2>
                    <p class="text-slate-400 text-sm leading-relaxed mb-8">Penilaian Anda telah berhasil dikirim. Kontribusi Anda sangat berarti bagi kemajuan STMIK Adhi Guna.</p>
                    <div class="bg-[#F1F5F9] rounded-2xl p-5 mb-6">
                        <p class="text-xs font-bold uppercase tracking-widest text-slate-400 mb-1">Nilai Rata-rata yang Anda Berikan</p>
                        <p id="final_score" class="text-4xl font-extrabold text-[#1B4FD8] mt-1"></p>
                        <p id="final_stars" class="text-yellow-400 text-xl mt-1 tracking-tight"></p>
                        <p id="final_dosen" class="text-xs text-slate-400 mt-2 font-medium"></p>
                    </div>
                    <div class="flex gap-3">
                        <a href="/" class="flex-1 bg-[#F1F5F9] hover:bg-[rgba(27,79,216,0.08)] border-2 border-[rgba(27,79,216,0.2)] text-[#1B4FD8] font-bold py-3.5 rounded-2xl transition-all text-sm text-center">
                            Beranda
                        </a>
                        <button type="button" onclick="resetForm()" class="flex-[2] bg-[#1B4FD8] hover:bg-[#2F62EC] text-white font-bold py-3.5 rounded-2xl text-sm transition-all shadow-[0_10px_25px_-5px_rgba(27,79,216,0.4)] active:scale-95">
                            <i class="fas fa-rotate-left mr-2"></i>Isi Survei Lagi
                        </button>
                    </div>
                </div>
            </div>
        </form>
        </div><div class="text-center text-xs text-slate-300 pb-8">
        &copy; 2026 STMIK Adhi Guna &nbsp;·&nbsp; Sistem Survei Akademik
    </div>

    <script src="{{ asset('assets/assets/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.21.0/jquery.validate.min.js"></script>
    <script src="{{ asset('helpers/alert-ui.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script type="module" src="{{ asset('controllers/penilaian.controller.js') }}"></script>
</body>
</html>

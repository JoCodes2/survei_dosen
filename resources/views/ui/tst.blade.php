<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Survei Kepuasan Mahasiswa – STMIK Adhi Guna</title>
 <script src="https://cdn.tailwindcss.com"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Inter:wght@400;500;600&display=swap');

        .font-playfair {
            font-family: 'Playfair Display', serif;
        }

        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
    <script>
        let appUrl = '{{ env('APP_URL') }}';
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script>
    tailwind.config = {
    theme: {
        extend: {
        fontFamily: { jakarta: ['"Plus Jakarta Sans"', 'sans-serif'] },
        colors: {
            brand:      '#1B4FD8',
            'brand-dk': '#0F2E8A',
            'brand-lt': '#3B6EF8',
            'brand-xs': '#EEF3FF',
            'brand-sm': '#DDEAFF',
            sky:        '#0EA5E9',
            'sky-lt':   '#E0F5FF',
            navy:       '#0B1D45',
            'slate-f':  '#F4F7FE',
            success:    '#10B981',
            'suc-lt':   '#D1FAE5',
        },
        boxShadow: {
            'brand': '0 8px 32px -4px rgba(27,79,216,0.28)',
            'card':  '0 2px 20px 0 rgba(11,29,69,0.07)',
            'card-hover': '0 8px 40px 0 rgba(11,29,69,0.13)',
        },
        keyframes: {
            slideIn: { from:{ opacity:'0', transform:'translateX(32px)' }, to:{ opacity:'1', transform:'translateX(0)' } },
            slideOut:{ from:{ opacity:'1', transform:'translateX(0)' }, to:{ opacity:'0', transform:'translateX(-32px)' } },
            popIn:   { '0%':{ opacity:'0', transform:'scale(0.85)' }, '70%':{ transform:'scale(1.05)' }, '100%':{ opacity:'1', transform:'scale(1)' } },
            pulse2:  { '0%,100%':{ opacity:'1' }, '50%':{ opacity:'.6' } },
            confetti:{ from:{ transform:'translateY(0) rotate(0deg)', opacity:'1' }, to:{ transform:'translateY(100vh) rotate(720deg)', opacity:'0' } },
        },
        animation: {
            'slide-in':  'slideIn 0.38s cubic-bezier(.4,0,.2,1) both',
            'pop-in':    'popIn 0.35s cubic-bezier(.4,0,.2,1) both',
            'pulse2':    'pulse2 2s ease-in-out infinite',
            'confetti':  'confetti 2.5s ease-in forwards',
        },
        }
    }
    }
    </script>

    <style>
    * { -webkit-tap-highlight-color: transparent; }
    body { font-family: 'Plus Jakarta Sans', sans-serif; }

    /* Hero gradient */
    .hero-grad { background: linear-gradient(145deg, #0B1D45 0%, #1B4FD8 60%, #3B6EF8 100%); }

    /* Decorative circles on hero */
    .hero-circle-1 {
        position:absolute; width:340px; height:340px; border-radius:50%;
        background: radial-gradient(circle, rgba(59,110,248,.3) 0%, transparent 70%);
        top:-80px; right:-80px; pointer-events:none;
    }
    .hero-circle-2 {
        position:absolute; width:200px; height:200px; border-radius:50%;
        background: radial-gradient(circle, rgba(14,165,233,.2) 0%, transparent 70%);
        bottom:-40px; left:20px; pointer-events:none;
    }

    /* Step transition */
    .step-panel { display:none; }
    .step-panel.active { display:block; animation: slideIn 0.38s cubic-bezier(.4,0,.2,1) both; }

    /* Progress bar */
    .prog-fill { transition: width 0.5s cubic-bezier(.4,0,.2,1); background: linear-gradient(90deg, #1B4FD8, #0EA5E9); }

    /* Radio block buttons */
    .rating-wrap input[type="radio"] { display:none; }
    .rating-wrap label {
        display:flex; align-items:center; justify-content:center;
        width:52px; height:52px; border-radius:14px;
        border:2px solid #DDEAFF; background:#F4F7FE;
        font-size:17px; font-weight:700; color:#6B84B8; cursor:pointer;
        font-family:'Plus Jakarta Sans',sans-serif;
        transition: all 0.18s cubic-bezier(.4,0,.2,1);
        user-select:none; position:relative;
    }
    .rating-wrap label:hover {
        border-color:#3B6EF8; color:#1B4FD8; background:#EEF3FF;
        transform:translateY(-3px) scale(1.05);
        box-shadow:0 6px 18px rgba(27,79,216,.18);
    }
    .rating-wrap input[type="radio"]:checked + label {
        border-color:#1B4FD8; background:#1B4FD8; color:#fff;
        transform:translateY(-3px) scale(1.08);
        box-shadow:0 6px 20px rgba(27,79,216,.35);
    }

    /* Input underline */
    .field-input {
        width:100%; background:transparent;
        border:none; border-bottom:2px solid #DDEAFF;
        padding:10px 0; font-size:15px; font-weight:600;
        color:#0B1D45; font-family:'Plus Jakarta Sans',sans-serif;
        outline:none; transition:border-color .2s;
    }
    .field-input::placeholder { color:#9AB0D4; font-weight:400; }
    .field-input:focus { border-color:#1B4FD8; }

    /* Select */
    .field-select {
        width:100%; background:transparent;
        border:none; border-bottom:2px solid #DDEAFF;
        padding:10px 0; font-size:15px; font-weight:600;
        color:#0B1D45; font-family:'Plus Jakarta Sans',sans-serif;
        outline:none; transition:border-color .2s; cursor:pointer;
        -webkit-appearance:none; appearance:none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='14' height='14' viewBox='0 0 24 24' fill='none' stroke='%239AB0D4' stroke-width='2.5'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E");
        background-repeat:no-repeat; background-position:right 4px center;
        padding-right:28px;
    }
    .field-select:focus { border-color:#1B4FD8; }

    /* Dosen card select */
    .dosen-card {
        border:2px solid #DDEAFF; border-radius:16px; padding:14px 18px;
        cursor:pointer; transition:all .2s; background:#fff; display:flex; align-items:center; gap:14px;
    }
    .dosen-card:hover { border-color:#3B6EF8; background:#EEF3FF; }
    .dosen-card.selected { border-color:#1B4FD8; background:#1B4FD8; }
    .dosen-card.selected .dc-name { color:#fff; }
    .dosen-card.selected .dc-sub { color:rgba(255,255,255,.7); }
    .dosen-card.selected .dc-icon { background:rgba(255,255,255,.2); color:#fff; }

    /* Confetti */
    .confetti-piece {
        position:fixed; width:10px; height:10px; border-radius:2px;
        animation: confetti 2.5s ease-in forwards;
        pointer-events:none; z-index:9999;
    }
    </style>
</head>

<body class="bg-slate-f font-jakarta min-h-screen">

<!-- ══════════════════════════════════ -->
<!--  HERO HEADER                       -->
<!-- ══════════════════════════════════ -->
<div class="hero-grad relative overflow-hidden px-5 pt-10 pb-16 sm:pt-14 sm:pb-20">
  <div class="hero-circle-1"></div>
  <div class="hero-circle-2"></div>

  <div class="max-w-lg mx-auto relative z-10">
    <!-- School -->
    <div class="flex items-center gap-3 mb-5">
      <div class="w-12 h-12 bg-white/15 border border-white/20 rounded-2xl flex items-center justify-center text-xl text-white shrink-0">
        <img src="{{ asset('assets/assets/stmik.png') }}" alt="Logo STMIK" class="w-12 h-12 object-contain">
      </div>
      <div>
        <p class="text-white/50 text-xs font-medium">STMIK Adhi Guna</p>
        <p class="text-white font-bold text-sm">Sistem Survei Kepuasan Mahasiswa</p>
      </div>
    </div>

    <!-- Title -->
    <h1 class="text-3xl sm:text-4xl font-extrabold text-white leading-tight mb-3">
      Nilai <span class="text-sky">Dosen</span> Anda,<br>Bangun Kampus Lebih Baik
    </h1>
    <p class="text-white/50 text-sm leading-relaxed">Penilaian jujur Anda membantu meningkatkan kualitas pengajaran dan interaksi dosen–mahasiswa.</p>

    <!-- Stats row -->
    <div class="flex gap-5 mt-7">
      <div class="bg-white/10 rounded-2xl px-4 py-3 flex items-center gap-3">
        <div class="w-8 h-8 bg-sky/20 rounded-xl flex items-center justify-center text-sky text-xs"><i class="fas fa-list-check"></i></div>
        <div><p class="text-white font-bold text-base">8</p><p class="text-white/45 text-[10px] uppercase tracking-wider">Pertanyaan</p></div>
      </div>
      <div class="bg-white/10 rounded-2xl px-4 py-3 flex items-center gap-3">
        <div class="w-8 h-8 bg-sky/20 rounded-xl flex items-center justify-center text-sky text-xs"><i class="fas fa-clock"></i></div>
        <div><p class="text-white font-bold text-base">&lt;3'</p><p class="text-white/45 text-[10px] uppercase tracking-wider">Waktu Isi</p></div>
      </div>
      <div class="bg-white/10 rounded-2xl px-4 py-3 flex items-center gap-3">
        <div class="w-8 h-8 bg-sky/20 rounded-xl flex items-center justify-center text-sky text-xs"><i class="fas fa-shield-halved"></i></div>
        <div><p class="text-white font-bold text-base">100%</p><p class="text-white/45 text-[10px] uppercase tracking-wider">Anonim</p></div>
      </div>
    </div>
  </div>
</div>

<!-- ══════════════════════════════════ -->
<!--  WIZARD CONTAINER                  -->
<!-- ══════════════════════════════════ -->
<div class="max-w-lg mx-auto px-4 -mt-6 pb-16">

  <!-- Step indicator + progress -->
  <div class="bg-white rounded-2xl shadow-card px-6 py-4 mb-4 flex items-center gap-4">
    <!-- Steps dots -->
    <div class="flex items-center gap-1.5 flex-1">
      <div id="dot1" class="h-2 rounded-full bg-brand transition-all duration-500" style="width:28px"></div>
      <div id="dot2" class="h-2 w-2 rounded-full bg-brand-sm transition-all duration-500"></div>
      <div id="dot3" class="h-2 w-2 rounded-full bg-brand-sm transition-all duration-500"></div>
      <div id="dot4" class="h-2 w-2 rounded-full bg-brand-sm transition-all duration-500"></div>
    </div>
    <span id="stepLabel" class="text-xs font-bold text-brand whitespace-nowrap">Langkah 1 / 4</span>
  </div>

  <!-- ─────────────────────────────── -->
  <!--  STEP 1 — IDENTITAS            -->
  <!-- ─────────────────────────────── -->
  <div id="step1" class="step-panel active">
    <div class="bg-white rounded-3xl shadow-card p-6 sm:p-8">

      <div class="flex items-center gap-3 mb-6">
        <div class="w-11 h-11 bg-brand-xs rounded-2xl flex items-center justify-center text-brand shrink-0">
          <i class="fas fa-user-graduate text-lg"></i>
        </div>
        <div>
          <p class="text-[11px] font-bold uppercase tracking-widest text-brand/60">Langkah 1</p>
          <h2 class="text-lg font-bold text-navy">Data Mahasiswa</h2>
        </div>
      </div>

      <div class="space-y-6">
        <!-- Nama -->
        <div>
          <label class="block text-[11px] font-bold uppercase tracking-widest text-slate-400 mb-1.5">Nama Lengkap <span class="text-red-400">*</span></label>
          <input id="f_nama" type="text" class="field-input" placeholder="Masukkan nama lengkap Anda">
          <p id="err_nama" class="text-red-400 text-xs mt-1 hidden"><i class="fas fa-circle-exclamation mr-1"></i>Nama wajib diisi</p>
        </div>

        <!-- NIM -->
        <div>
          <label class="block text-[11px] font-bold uppercase tracking-widest text-slate-400 mb-1.5">NIM <span class="text-red-400">*</span></label>
          <input id="f_nim" type="text" class="field-input" placeholder="Contoh: 201011000">
          <p id="err_nim" class="text-red-400 text-xs mt-1 hidden"><i class="fas fa-circle-exclamation mr-1"></i>NIM wajib diisi</p>
        </div>

        <!-- Prodi & Semester -->
        <div class="grid grid-cols-2 gap-5">
          <div>
            <label class="block text-[11px] font-bold uppercase tracking-widest text-slate-400 mb-1.5">Program Studi <span class="text-red-400">*</span></label>
            <select id="f_prodi" class="field-select">
              <option value="" disabled selected>— Pilih —</option>
              <option value="TI">Teknik Informatika</option>
              <option value="SI">Sistem Informasi</option>
              <option value="MI">Manajemen Informatika</option>
            </select>
            <p id="err_prodi" class="text-red-400 text-xs mt-1 hidden"><i class="fas fa-circle-exclamation mr-1"></i>Wajib dipilih</p>
          </div>
          <div>
            <label class="block text-[11px] font-bold uppercase tracking-widest text-slate-400 mb-1.5">Semester <span class="text-red-400">*</span></label>
            <select id="f_semester" class="field-select">
              <option value="" disabled selected>— Pilih —</option>
              <option>1</option><option>2</option><option>3</option><option>4</option>
              <option>5</option><option>6</option><option>7</option><option>8</option>
            </select>
            <p id="err_semester" class="text-red-400 text-xs mt-1 hidden"><i class="fas fa-circle-exclamation mr-1"></i>Wajib dipilih</p>
          </div>
        </div>
      </div>

      <button onclick="goStep(2, validateStep1)" class="w-full mt-8 bg-brand hover:bg-brand-lt active:scale-95 text-white font-bold py-4 rounded-2xl flex items-center justify-center gap-2 transition-all duration-200 shadow-brand">
        Lanjut <i class="fas fa-arrow-right text-sm"></i>
      </button>
    </div>
  </div>

  <!-- ─────────────────────────────── -->
  <!--  STEP 2 — PILIH DOSEN          -->
  <!-- ─────────────────────────────── -->
  <div id="step2" class="step-panel">
    <div class="bg-white rounded-3xl shadow-card p-6 sm:p-8">

      <div class="flex items-center gap-3 mb-6">
        <div class="w-11 h-11 bg-sky-lt rounded-2xl flex items-center justify-center text-sky shrink-0">
          <i class="fas fa-chalkboard-user text-lg"></i>
        </div>
        <div>
          <p class="text-[11px] font-bold uppercase tracking-widest text-sky/70">Langkah 2</p>
          <h2 class="text-lg font-bold text-navy">Pilih Dosen</h2>
        </div>
      </div>

      <p class="text-sm text-slate-400 mb-5">Pilih dosen yang ingin Anda nilai pada survei ini.</p>

      <div class="space-y-3" id="dosenList">
        <!-- Dosen cards -->
        <div class="dosen-card" onclick="selectDosen(this, 'Dr. Ahmad Fauzan', 'Basis Data')">
          <div class="dc-icon w-10 h-10 bg-brand-xs rounded-xl flex items-center justify-center text-brand text-sm shrink-0">
            <i class="fas fa-database"></i>
          </div>
          <div class="flex-1 min-w-0">
            <p class="dc-name font-bold text-navy text-sm truncate">Dr. Ahmad Fauzan</p>
            <p class="dc-sub text-xs text-slate-400 mt-0.5">Basis Data</p>
          </div>
          <i class="dc-check fas fa-circle-check text-white opacity-0 text-lg transition-opacity"></i>
        </div>

        <div class="dosen-card" onclick="selectDosen(this, 'Dr. Siti Rahayu', 'Pemrograman Web')">
          <div class="dc-icon w-10 h-10 bg-brand-xs rounded-xl flex items-center justify-center text-brand text-sm shrink-0">
            <i class="fas fa-code"></i>
          </div>
          <div class="flex-1 min-w-0">
            <p class="dc-name font-bold text-navy text-sm truncate">Dr. Siti Rahayu</p>
            <p class="dc-sub text-xs text-slate-400 mt-0.5">Pemrograman Web</p>
          </div>
          <i class="dc-check fas fa-circle-check text-white opacity-0 text-lg transition-opacity"></i>
        </div>

        <div class="dosen-card" onclick="selectDosen(this, 'M. Rizky, M.T', 'Algoritma & Pemrograman')">
          <div class="dc-icon w-10 h-10 bg-brand-xs rounded-xl flex items-center justify-center text-brand text-sm shrink-0">
            <i class="fas fa-diagram-project"></i>
          </div>
          <div class="flex-1 min-w-0">
            <p class="dc-name font-bold text-navy text-sm truncate">M. Rizky, M.T</p>
            <p class="dc-sub text-xs text-slate-400 mt-0.5">Algoritma & Pemrograman</p>
          </div>
          <i class="dc-check fas fa-circle-check text-white opacity-0 text-lg transition-opacity"></i>
        </div>

        <div class="dosen-card" onclick="selectDosen(this, 'Nurul Hidayah, M.Kom', 'Jaringan Komputer')">
          <div class="dc-icon w-10 h-10 bg-brand-xs rounded-xl flex items-center justify-center text-brand text-sm shrink-0">
            <i class="fas fa-network-wired"></i>
          </div>
          <div class="flex-1 min-w-0">
            <p class="dc-name font-bold text-navy text-sm truncate">Nurul Hidayah, M.Kom</p>
            <p class="dc-sub text-xs text-slate-400 mt-0.5">Jaringan Komputer</p>
          </div>
          <i class="dc-check fas fa-circle-check text-white opacity-0 text-lg transition-opacity"></i>
        </div>

        <div class="dosen-card" onclick="selectDosen(this, 'Dr. Wahyu Pratama', 'Rekayasa Perangkat Lunak')">
          <div class="dc-icon w-10 h-10 bg-brand-xs rounded-xl flex items-center justify-center text-brand text-sm shrink-0">
            <i class="fas fa-gears"></i>
          </div>
          <div class="flex-1 min-w-0">
            <p class="dc-name font-bold text-navy text-sm truncate">Dr. Wahyu Pratama</p>
            <p class="dc-sub text-xs text-slate-400 mt-0.5">Rekayasa Perangkat Lunak</p>
          </div>
          <i class="dc-check fas fa-circle-check text-white opacity-0 text-lg transition-opacity"></i>
        </div>
      </div>

      <p id="err_dosen" class="text-red-400 text-xs mt-3 hidden"><i class="fas fa-circle-exclamation mr-1"></i>Pilih satu dosen terlebih dahulu</p>

      <div class="flex gap-3 mt-7">
        <button onclick="goStep(1)" class="flex-1 bg-slate-f hover:bg-brand-xs border-2 border-brand-sm text-brand font-bold py-3.5 rounded-2xl transition-all active:scale-95">
          <i class="fas fa-arrow-left mr-2 text-sm"></i>Kembali
        </button>
        <button onclick="goStep(3, validateStep2)" class="flex-[2] bg-brand hover:bg-brand-lt text-white font-bold py-3.5 rounded-2xl flex items-center justify-center gap-2 transition-all shadow-brand active:scale-95">
          Lanjut <i class="fas fa-arrow-right text-sm"></i>
        </button>
      </div>
    </div>
  </div>

  <!-- ─────────────────────────────── -->
  <!--  STEP 3 — PERTANYAAN           -->
  <!-- ─────────────────────────────── -->
  <div id="step3" class="step-panel">
    <div class="bg-white rounded-3xl shadow-card p-6 sm:p-8">

      <div class="flex items-center gap-3 mb-2">
        <div class="w-11 h-11 bg-brand-xs rounded-2xl flex items-center justify-center text-brand shrink-0">
          <i class="fas fa-star-half-stroke text-lg"></i>
        </div>
        <div>
          <p class="text-[11px] font-bold uppercase tracking-widest text-brand/60">Langkah 3</p>
          <h2 class="text-lg font-bold text-navy">Penilaian</h2>
        </div>
      </div>

      <!-- Selected dosen info -->
      <div id="dosenInfo" class="flex items-center gap-3 bg-brand-xs border border-brand-sm rounded-2xl px-4 py-3 mb-6 mt-4">
        <i class="fas fa-chalkboard-user text-brand"></i>
        <div>
          <p class="text-xs text-brand/60 font-semibold">Menilai dosen:</p>
          <p id="dosenInfoName" class="text-sm font-bold text-navy"></p>
        </div>
      </div>

      <p class="text-xs text-slate-400 mb-6 flex items-center gap-2">
        <i class="fas fa-info-circle text-brand"></i>
        Pilih angka <strong class="text-navy">1</strong> (Sangat Tidak Setuju) hingga <strong class="text-navy">5</strong> (Sangat Setuju)
      </p>

      <div class="space-y-6" id="questionContainer">

        <!-- Template question — repeated -->
        <!-- Q1 -->
        <div class="border border-brand-sm rounded-2xl p-4 transition-all hover:border-brand/30 hover:shadow-md">
          <div class="flex items-start gap-3 mb-4">
            <span class="w-6 h-6 bg-brand text-white rounded-lg text-[11px] font-bold flex items-center justify-center shrink-0 mt-0.5">1</span>
            <div class="flex-1">
              <p class="text-sm font-semibold text-navy leading-relaxed">Dosen menyampaikan materi kuliah dengan jelas dan mudah dipahami.</p>
              <span class="inline-flex items-center gap-1 mt-1.5 text-[10px] font-bold uppercase tracking-wide px-2 py-0.5 rounded-full bg-sky-lt text-sky">
                <i class="fas fa-book-open-reader text-[9px]"></i> Pengajaran
              </span>
            </div>
          </div>
          <div class="rating-wrap flex gap-2">
            <input type="radio" name="q1" id="q1v1" value="1"><label for="q1v1">1</label>
            <input type="radio" name="q1" id="q1v2" value="2"><label for="q1v2">2</label>
            <input type="radio" name="q1" id="q1v3" value="3"><label for="q1v3">3</label>
            <input type="radio" name="q1" id="q1v4" value="4"><label for="q1v4">4</label>
            <input type="radio" name="q1" id="q1v5" value="5"><label for="q1v5">5</label>
          </div>
          <div class="flex justify-between mt-2 px-0.5 text-[10px] text-slate-300 font-medium">
            <span>Sangat Tidak Setuju</span><span>Sangat Setuju</span>
          </div>
        </div>

        <!-- Q2 -->
        <div class="border border-brand-sm rounded-2xl p-4 transition-all hover:border-brand/30 hover:shadow-md">
          <div class="flex items-start gap-3 mb-4">
            <span class="w-6 h-6 bg-brand text-white rounded-lg text-[11px] font-bold flex items-center justify-center shrink-0 mt-0.5">2</span>
            <div class="flex-1">
              <p class="text-sm font-semibold text-navy leading-relaxed">Dosen menggunakan metode pembelajaran yang bervariasi dan menarik.</p>
              <span class="inline-flex items-center gap-1 mt-1.5 text-[10px] font-bold uppercase tracking-wide px-2 py-0.5 rounded-full bg-sky-lt text-sky">
                <i class="fas fa-book-open-reader text-[9px]"></i> Pengajaran
              </span>
            </div>
          </div>
          <div class="rating-wrap flex gap-2">
            <input type="radio" name="q2" id="q2v1" value="1"><label for="q2v1">1</label>
            <input type="radio" name="q2" id="q2v2" value="2"><label for="q2v2">2</label>
            <input type="radio" name="q2" id="q2v3" value="3"><label for="q2v3">3</label>
            <input type="radio" name="q2" id="q2v4" value="4"><label for="q2v4">4</label>
            <input type="radio" name="q2" id="q2v5" value="5"><label for="q2v5">5</label>
          </div>
          <div class="flex justify-between mt-2 px-0.5 text-[10px] text-slate-300 font-medium">
            <span>Sangat Tidak Setuju</span><span>Sangat Setuju</span>
          </div>
        </div>

        <!-- Q3 -->
        <div class="border border-brand-sm rounded-2xl p-4 transition-all hover:border-brand/30 hover:shadow-md">
          <div class="flex items-start gap-3 mb-4">
            <span class="w-6 h-6 bg-brand text-white rounded-lg text-[11px] font-bold flex items-center justify-center shrink-0 mt-0.5">3</span>
            <div class="flex-1">
              <p class="text-sm font-semibold text-navy leading-relaxed">Dosen hadir dan memulai perkuliahan tepat waktu sesuai jadwal.</p>
              <span class="inline-flex items-center gap-1 mt-1.5 text-[10px] font-bold uppercase tracking-wide px-2 py-0.5 rounded-full bg-sky-lt text-sky">
                <i class="fas fa-book-open-reader text-[9px]"></i> Pengajaran
              </span>
            </div>
          </div>
          <div class="rating-wrap flex gap-2">
            <input type="radio" name="q3" id="q3v1" value="1"><label for="q3v1">1</label>
            <input type="radio" name="q3" id="q3v2" value="2"><label for="q3v2">2</label>
            <input type="radio" name="q3" id="q3v3" value="3"><label for="q3v3">3</label>
            <input type="radio" name="q3" id="q3v4" value="4"><label for="q3v4">4</label>
            <input type="radio" name="q3" id="q3v5" value="5"><label for="q3v5">5</label>
          </div>
          <div class="flex justify-between mt-2 px-0.5 text-[10px] text-slate-300 font-medium">
            <span>Sangat Tidak Setuju</span><span>Sangat Setuju</span>
          </div>
        </div>

        <!-- Q4 -->
        <div class="border border-brand-sm rounded-2xl p-4 transition-all hover:border-brand/30 hover:shadow-md">
          <div class="flex items-start gap-3 mb-4">
            <span class="w-6 h-6 bg-brand text-white rounded-lg text-[11px] font-bold flex items-center justify-center shrink-0 mt-0.5">4</span>
            <div class="flex-1">
              <p class="text-sm font-semibold text-navy leading-relaxed">Dosen bersikap terbuka dan ramah saat mahasiswa mengajukan pertanyaan.</p>
              <span class="inline-flex items-center gap-1 mt-1.5 text-[10px] font-bold uppercase tracking-wide px-2 py-0.5 rounded-full bg-brand-xs text-brand">
                <i class="fas fa-comments text-[9px]"></i> Interaksi
              </span>
            </div>
          </div>
          <div class="rating-wrap flex gap-2">
            <input type="radio" name="q4" id="q4v1" value="1"><label for="q4v1">1</label>
            <input type="radio" name="q4" id="q4v2" value="2"><label for="q4v2">2</label>
            <input type="radio" name="q4" id="q4v3" value="3"><label for="q4v3">3</label>
            <input type="radio" name="q4" id="q4v4" value="4"><label for="q4v4">4</label>
            <input type="radio" name="q4" id="q4v5" value="5"><label for="q4v5">5</label>
          </div>
          <div class="flex justify-between mt-2 px-0.5 text-[10px] text-slate-300 font-medium">
            <span>Sangat Tidak Setuju</span><span>Sangat Setuju</span>
          </div>
        </div>

        <!-- Q5 -->
        <div class="border border-brand-sm rounded-2xl p-4 transition-all hover:border-brand/30 hover:shadow-md">
          <div class="flex items-start gap-3 mb-4">
            <span class="w-6 h-6 bg-brand text-white rounded-lg text-[11px] font-bold flex items-center justify-center shrink-0 mt-0.5">5</span>
            <div class="flex-1">
              <p class="text-sm font-semibold text-navy leading-relaxed">Dosen mendorong mahasiswa untuk aktif berdiskusi dan berpendapat di kelas.</p>
              <span class="inline-flex items-center gap-1 mt-1.5 text-[10px] font-bold uppercase tracking-wide px-2 py-0.5 rounded-full bg-brand-xs text-brand">
                <i class="fas fa-comments text-[9px]"></i> Interaksi
              </span>
            </div>
          </div>
          <div class="rating-wrap flex gap-2">
            <input type="radio" name="q5" id="q5v1" value="1"><label for="q5v1">1</label>
            <input type="radio" name="q5" id="q5v2" value="2"><label for="q5v2">2</label>
            <input type="radio" name="q5" id="q5v3" value="3"><label for="q5v3">3</label>
            <input type="radio" name="q5" id="q5v4" value="4"><label for="q5v4">4</label>
            <input type="radio" name="q5" id="q5v5" value="5"><label for="q5v5">5</label>
          </div>
          <div class="flex justify-between mt-2 px-0.5 text-[10px] text-slate-300 font-medium">
            <span>Sangat Tidak Setuju</span><span>Sangat Setuju</span>
          </div>
        </div>

        <!-- Q6 -->
        <div class="border border-brand-sm rounded-2xl p-4 transition-all hover:border-brand/30 hover:shadow-md">
          <div class="flex items-start gap-3 mb-4">
            <span class="w-6 h-6 bg-brand text-white rounded-lg text-[11px] font-bold flex items-center justify-center shrink-0 mt-0.5">6</span>
            <div class="flex-1">
              <p class="text-sm font-semibold text-navy leading-relaxed">Dosen memberikan umpan balik yang membangun atas tugas dan ujian.</p>
              <span class="inline-flex items-center gap-1 mt-1.5 text-[10px] font-bold uppercase tracking-wide px-2 py-0.5 rounded-full bg-emerald-50 text-emerald-600">
                <i class="fas fa-clipboard-check text-[9px]"></i> Penilaian
              </span>
            </div>
          </div>
          <div class="rating-wrap flex gap-2">
            <input type="radio" name="q6" id="q6v1" value="1"><label for="q6v1">1</label>
            <input type="radio" name="q6" id="q6v2" value="2"><label for="q6v2">2</label>
            <input type="radio" name="q6" id="q6v3" value="3"><label for="q6v3">3</label>
            <input type="radio" name="q6" id="q6v4" value="4"><label for="q6v4">4</label>
            <input type="radio" name="q6" id="q6v5" value="5"><label for="q6v5">5</label>
          </div>
          <div class="flex justify-between mt-2 px-0.5 text-[10px] text-slate-300 font-medium">
            <span>Sangat Tidak Setuju</span><span>Sangat Setuju</span>
          </div>
        </div>

        <!-- Q7 -->
        <div class="border border-brand-sm rounded-2xl p-4 transition-all hover:border-brand/30 hover:shadow-md">
          <div class="flex items-start gap-3 mb-4">
            <span class="w-6 h-6 bg-brand text-white rounded-lg text-[11px] font-bold flex items-center justify-center shrink-0 mt-0.5">7</span>
            <div class="flex-1">
              <p class="text-sm font-semibold text-navy leading-relaxed">Sistem penilaian yang diterapkan dosen terasa adil dan transparan.</p>
              <span class="inline-flex items-center gap-1 mt-1.5 text-[10px] font-bold uppercase tracking-wide px-2 py-0.5 rounded-full bg-emerald-50 text-emerald-600">
                <i class="fas fa-clipboard-check text-[9px]"></i> Penilaian
              </span>
            </div>
          </div>
          <div class="rating-wrap flex gap-2">
            <input type="radio" name="q7" id="q7v1" value="1"><label for="q7v1">1</label>
            <input type="radio" name="q7" id="q7v2" value="2"><label for="q7v2">2</label>
            <input type="radio" name="q7" id="q7v3" value="3"><label for="q7v3">3</label>
            <input type="radio" name="q7" id="q7v4" value="4"><label for="q7v4">4</label>
            <input type="radio" name="q7" id="q7v5" value="5"><label for="q7v5">5</label>
          </div>
          <div class="flex justify-between mt-2 px-0.5 text-[10px] text-slate-300 font-medium">
            <span>Sangat Tidak Setuju</span><span>Sangat Setuju</span>
          </div>
        </div>

        <!-- Q8 -->
        <div class="border border-brand-sm rounded-2xl p-4 transition-all hover:border-brand/30 hover:shadow-md">
          <div class="flex items-start gap-3 mb-4">
            <span class="w-6 h-6 bg-brand text-white rounded-lg text-[11px] font-bold flex items-center justify-center shrink-0 mt-0.5">8</span>
            <div class="flex-1">
              <p class="text-sm font-semibold text-navy leading-relaxed">Dosen menunjukkan sikap profesional dan menghormati semua mahasiswa tanpa diskriminasi.</p>
              <span class="inline-flex items-center gap-1 mt-1.5 text-[10px] font-bold uppercase tracking-wide px-2 py-0.5 rounded-full bg-violet-50 text-violet-600">
                <i class="fas fa-hand-holding-heart text-[9px]"></i> Sikap & Etika
              </span>
            </div>
          </div>
          <div class="rating-wrap flex gap-2">
            <input type="radio" name="q8" id="q8v1" value="1"><label for="q8v1">1</label>
            <input type="radio" name="q8" id="q8v2" value="2"><label for="q8v2">2</label>
            <input type="radio" name="q8" id="q8v3" value="3"><label for="q8v3">3</label>
            <input type="radio" name="q8" id="q8v4" value="4"><label for="q8v4">4</label>
            <input type="radio" name="q8" id="q8v5" value="5"><label for="q8v5">5</label>
          </div>
          <div class="flex justify-between mt-2 px-0.5 text-[10px] text-slate-300 font-medium">
            <span>Sangat Tidak Setuju</span><span>Sangat Setuju</span>
          </div>
        </div>

      </div><!-- /questionContainer -->

      <p id="err_questions" class="text-red-400 text-xs mt-4 hidden"><i class="fas fa-circle-exclamation mr-1"></i>Harap jawab semua pertanyaan sebelum melanjutkan</p>

      <div class="flex gap-3 mt-7">
        <button onclick="goStep(2)" class="flex-1 bg-slate-f hover:bg-brand-xs border-2 border-brand-sm text-brand font-bold py-3.5 rounded-2xl transition-all active:scale-95">
          <i class="fas fa-arrow-left mr-2 text-sm"></i>Kembali
        </button>
        <button onclick="goStep(4, validateStep3)" class="flex-[2] bg-brand hover:bg-brand-lt text-white font-bold py-3.5 rounded-2xl flex items-center justify-center gap-2 transition-all shadow-brand active:scale-95">
          Review <i class="fas fa-arrow-right text-sm"></i>
        </button>
      </div>
    </div>
  </div>

  <!-- ─────────────────────────────── -->
  <!--  STEP 4 — REVIEW & SUBMIT      -->
  <!-- ─────────────────────────────── -->
  <div id="step4" class="step-panel">
    <div class="bg-white rounded-3xl shadow-card p-6 sm:p-8">

      <div class="flex items-center gap-3 mb-6">
        <div class="w-11 h-11 bg-suc-lt rounded-2xl flex items-center justify-center text-success shrink-0">
          <i class="fas fa-paper-plane text-lg"></i>
        </div>
        <div>
          <p class="text-[11px] font-bold uppercase tracking-widest text-success/60">Langkah 4</p>
          <h2 class="text-lg font-bold text-navy">Review & Kirim</h2>
        </div>
      </div>

      <!-- Summary card -->
      <div class="bg-slate-f rounded-2xl p-5 mb-6 space-y-3">
        <div class="flex items-center justify-between">
          <span class="text-xs font-bold text-slate-400 uppercase tracking-wide">Mahasiswa</span>
          <span id="rev_nama" class="text-sm font-bold text-navy text-right max-w-[55%] truncate"></span>
        </div>
        <div class="h-px bg-brand-sm"></div>
        <div class="flex items-center justify-between">
          <span class="text-xs font-bold text-slate-400 uppercase tracking-wide">NIM</span>
          <span id="rev_nim" class="text-sm font-bold text-navy"></span>
        </div>
        <div class="h-px bg-brand-sm"></div>
        <div class="flex items-center justify-between">
          <span class="text-xs font-bold text-slate-400 uppercase tracking-wide">Prodi / Semester</span>
          <span id="rev_prodi" class="text-sm font-bold text-navy text-right"></span>
        </div>
        <div class="h-px bg-brand-sm"></div>
        <div class="flex items-center justify-between">
          <span class="text-xs font-bold text-slate-400 uppercase tracking-wide">Dosen Dinilai</span>
          <span id="rev_dosen" class="text-sm font-bold text-navy text-right max-w-[55%] truncate"></span>
        </div>
      </div>

      <!-- Score average -->
      <div class="bg-brand rounded-2xl p-5 mb-6 flex items-center gap-4">
        <div class="w-14 h-14 bg-white/15 rounded-2xl flex items-center justify-center shrink-0">
          <span id="rev_score" class="text-2xl font-extrabold text-white">—</span>
        </div>
        <div>
          <p class="text-white/60 text-xs font-semibold">Rata-rata Penilaian Anda</p>
          <p class="text-white font-bold text-sm mt-0.5">dari total 8 pertanyaan</p>
        </div>
        <div id="rev_stars" class="ml-auto text-yellow-300 text-base tracking-tight"></div>
      </div>

      <!-- Privacy note -->
      <div class="flex items-start gap-3 bg-suc-lt border border-success/20 rounded-2xl px-4 py-3 mb-7">
        <i class="fas fa-shield-halved text-success mt-0.5 shrink-0"></i>
        <p class="text-xs text-emerald-700 leading-relaxed">Respons Anda <strong>100% anonim</strong> dan hanya digunakan untuk kepentingan peningkatan kualitas akademik STMIK Adhi Guna.</p>
      </div>

      <div class="flex gap-3">
        <button onclick="goStep(3)" class="flex-1 bg-slate-f hover:bg-brand-xs border-2 border-brand-sm text-brand font-bold py-3.5 rounded-2xl transition-all active:scale-95">
          <i class="fas fa-arrow-left mr-2 text-sm"></i>Edit
        </button>
        <button onclick="submitSurvei()" class="flex-[2] bg-success hover:bg-emerald-600 text-white font-bold py-3.5 rounded-2xl flex items-center justify-center gap-2 transition-all shadow-lg shadow-emerald-200 active:scale-95">
          <i class="fas fa-paper-plane text-sm"></i> Kirim Sekarang
        </button>
      </div>
    </div>
  </div>

  <!-- ─────────────────────────────── -->
  <!--  STEP 5 — SUCCESS              -->
  <!-- ─────────────────────────────── -->
  <div id="step5" class="step-panel">
    <div class="bg-white rounded-3xl shadow-card p-8 text-center">
      <div class="w-20 h-20 bg-suc-lt rounded-full flex items-center justify-center mx-auto mb-5 animate-pop-in">
        <i class="fas fa-check text-3xl text-success"></i>
      </div>
      <h2 class="text-2xl font-extrabold text-navy mb-2">Terima Kasih!</h2>
      <p class="text-slate-400 text-sm leading-relaxed mb-8">Penilaian Anda telah berhasil dikirim. Kontribusi Anda sangat berarti bagi kemajuan STMIK Adhi Guna.</p>

      <!-- Score display -->
      <div class="bg-slate-f rounded-2xl p-5 mb-6">
        <p class="text-xs font-bold uppercase tracking-widest text-slate-400 mb-1">Nilai Rata-rata yang Anda Berikan</p>
        <p id="final_score" class="text-4xl font-extrabold text-brand mt-1"></p>
        <p id="final_stars" class="text-yellow-400 text-xl mt-1 tracking-tight"></p>
        <p id="final_dosen" class="text-xs text-slate-400 mt-2 font-medium"></p>
      </div>

      <div class="flex gap-3">
        <a href="/" class="flex-1 bg-slate-f hover:bg-brand-xs border-2 border-brand-sm text-brand font-bold py-3.5 rounded-2xl transition-all text-sm text-center">
          Beranda
        </a>
        <button onclick="resetForm()" class="flex-[2] bg-brand hover:bg-brand-lt text-white font-bold py-3.5 rounded-2xl text-sm transition-all shadow-brand active:scale-95">
          <i class="fas fa-rotate-left mr-2"></i>Isi Survei Lagi
        </button>
      </div>
    </div>
  </div>

</div><!-- /container -->

<!-- Footer -->
<div class="text-center text-xs text-slate-300 pb-8">
  &copy; 2026 STMIK Adhi Guna &nbsp;·&nbsp; Sistem Survei Akademik
</div>

 <script src="{{ asset('assets/assets/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.21.0/jquery.validate.min.js"
        integrity="sha512-KFHXdr2oObHKI9w4Hv1XPKc898mE4kgYx58oqsc/JqqdLMDI4YjOLzom+EMlW8HFUd0QfjfAvxSL6sEq/a42fQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="{{ asset('assets/assets/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.21.0/jquery.validate.min.js"
        integrity="sha512-KFHXdr2oObHKI9w4Hv1XPKc898mE4kgYx58oqsc/JqqdLMDI4YjOLzom+EMlW8HFUd0QfjfAvxSL6sEq/a42fQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{ asset('helpers/alert-ui.js') }}"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
  let currentStep = 1;
  let selectedDosen = null;

  // ── STEP NAVIGATION ──
  function goStep(n, validator) {
    if (validator && !validator()) return;
    document.getElementById('step' + currentStep).classList.remove('active');
    currentStep = n;
    const next = document.getElementById('step' + currentStep);
    next.classList.add('active');
    updateDots(n);
    window.scrollTo({ top: 0, behavior: 'smooth' });
    if (n === 4) buildReview();
  }

  function updateDots(n) {
    const total = 4;
    document.getElementById('stepLabel').textContent = `Langkah ${Math.min(n, 4)} / 4`;
    for (let i = 1; i <= total; i++) {
      const dot = document.getElementById('dot' + i);
      if (i < n) {
        dot.className = 'h-2 rounded-full bg-brand transition-all duration-500';
        dot.style.width = '20px';
      } else if (i === n) {
        dot.className = 'h-2 rounded-full bg-brand transition-all duration-500';
        dot.style.width = '28px';
      } else {
        dot.className = 'h-2 w-2 rounded-full bg-brand-sm transition-all duration-500';
        dot.style.width = '';
      }
    }
    if (n === 5) document.querySelector('[id^="dot"]').closest('.bg-white').style.display = 'none';
  }

  // ── DOSEN SELECTION ──
  function selectDosen(el, name, matkul) {
    document.querySelectorAll('.dosen-card').forEach(c => {
      c.classList.remove('selected');
      c.querySelector('.dc-check').style.opacity = '0';
    });
    el.classList.add('selected');
    el.querySelector('.dc-check').style.opacity = '1';
    selectedDosen = { name, matkul };
    document.getElementById('dosenInfoName').textContent = name + ' — ' + matkul;
    document.getElementById('err_dosen').classList.add('hidden');
  }

  // ── VALIDATORS ──
  function validateStep1() {
    let ok = true;
    const fields = [
      { id: 'f_nama', err: 'err_nama' },
      { id: 'f_nim', err: 'err_nim' },
      { id: 'f_prodi', err: 'err_prodi' },
      { id: 'f_semester', err: 'err_semester' },
    ];
    fields.forEach(({ id, err }) => {
      const el = document.getElementById(id);
      const errEl = document.getElementById(err);
      if (!el.value.trim()) {
        errEl.classList.remove('hidden');
        el.closest('.field-input, div').querySelector('input,select')?.classList.add('border-red-300');
        ok = false;
      } else {
        errEl.classList.add('hidden');
      }
    });
    return ok;
  }

  function validateStep2() {
    if (!selectedDosen) {
      document.getElementById('err_dosen').classList.remove('hidden');
      return false;
    }
    return true;
  }

  function validateStep3() {
    for (let i = 1; i <= 8; i++) {
      if (!document.querySelector(`input[name="q${i}"]:checked`)) {
        document.getElementById('err_questions').classList.remove('hidden');
        // scroll to first unanswered
        document.getElementById('err_questions').scrollIntoView({ behavior: 'smooth', block: 'center' });
        return false;
      }
    }
    document.getElementById('err_questions').classList.add('hidden');
    return true;
  }

  // ── BUILD REVIEW ──
  function buildReview() {
    const prodi = document.getElementById('f_prodi');
    const prodiText = prodi.options[prodi.selectedIndex]?.text || '';
    document.getElementById('rev_nama').textContent  = document.getElementById('f_nama').value;
    document.getElementById('rev_nim').textContent   = document.getElementById('f_nim').value;
    document.getElementById('rev_prodi').textContent = `${prodiText} / Sem ${document.getElementById('f_semester').value}`;
    document.getElementById('rev_dosen').textContent = selectedDosen ? selectedDosen.name : '';

    const avg = getAvgScore();
    document.getElementById('rev_score').textContent = avg.toFixed(1);
    document.getElementById('rev_stars').textContent = renderStars(avg);
  }

  function getAvgScore() {
    let total = 0;
    for (let i = 1; i <= 8; i++) {
      const checked = document.querySelector(`input[name="q${i}"]:checked`);
      total += checked ? parseInt(checked.value) : 0;
    }
    return total / 8;
  }

  function renderStars(avg) {
    const full  = Math.floor(avg);
    const half  = avg - full >= 0.5;
    let s = '★'.repeat(full);
    if (half) s += '½';
    s += '☆'.repeat(5 - full - (half ? 1 : 0));
    return s;
  }

  // ── SUBMIT ──
  function submitSurvei() {
    const btn = event.currentTarget;
    btn.disabled = true;
    btn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Mengirim...';

    // Simulate submit delay (replace with real fetch/form submit)
    setTimeout(() => {
      launchConfetti();
      const avg = getAvgScore();
      document.getElementById('final_score').textContent = avg.toFixed(1) + ' / 5';
      document.getElementById('final_stars').textContent = renderStars(avg);
      document.getElementById('final_dosen').textContent = `Untuk: ${selectedDosen?.name} — ${selectedDosen?.matkul}`;
      goStep(5);
      document.querySelector('[id^="dot"]').closest('.bg-white').style.display = 'none';
    }, 1200);
  }

  // ── CONFETTI ──
  function launchConfetti() {
    const colors = ['#1B4FD8','#0EA5E9','#10B981','#F59E0B','#8B5CF6','#EC4899'];
    for (let i = 0; i < 60; i++) {
      const el = document.createElement('div');
      el.className = 'confetti-piece';
      el.style.cssText = `
        left:${Math.random()*100}vw;
        top:-10px;
        background:${colors[Math.floor(Math.random()*colors.length)]};
        width:${6+Math.random()*8}px;
        height:${6+Math.random()*8}px;
        border-radius:${Math.random()>0.5?'50%':'2px'};
        animation-delay:${Math.random()*1}s;
        animation-duration:${2+Math.random()*1.5}s;
      `;
      document.body.appendChild(el);
      setTimeout(() => el.remove(), 4000);
    }
  }

  // ── RESET ──
  function resetForm() {
    selectedDosen = null;
    document.getElementById('f_nama').value = '';
    document.getElementById('f_nim').value = '';
    document.getElementById('f_prodi').value = '';
    document.getElementById('f_semester').value = '';
    document.querySelectorAll('.dosen-card').forEach(c => {
      c.classList.remove('selected');
      c.querySelector('.dc-check').style.opacity = '0';
    });
    document.querySelectorAll('input[type="radio"]').forEach(r => r.checked = false);
    document.querySelector('[id^="dot"]').closest('.bg-white').style.display = '';
    currentStep = 1;
    document.querySelectorAll('.step-panel').forEach(p => p.classList.remove('active'));
    document.getElementById('step1').classList.add('active');
    updateDots(1);
    window.scrollTo({ top: 0, behavior: 'smooth' });
  }
</script>

</body>
</html>

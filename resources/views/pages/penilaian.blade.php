@extends('Layouts.Base')

@section('content')
<div class="card">

    <x-base-header title="Hasil Survei & Perhitungan MARCOS" icon="fa-solid fa-poll-h">
    </x-base-header>

    <x-base-body>
        <div class="alert alert-secondary border-0 small mb-4">
            <i class="fa-solid fa-circle-info mr-1"></i>
            Silakan pilih filter dan klik 'Tampilkan Data' untuk melihat rata-rata hasil survei. Klik 'Hitung MARCOS' untuk memproses ranking.
        </div>

        {{-- Form Filter --}}
        <form id="formFilterData">
            <div class="row mb-3 bg-light p-2 rounded">
                <div class="col-md-3">
                    <label for="filter_program_studi" class="form-label font-weight-bold small">Program Studi</label>
                    <select class="form-control form-control-sm" id="filter_program_studi" name="program_studi_id" required>
                        <option value="">-- Pilih Prodi --</option>
                        {{-- Data Prodi dari API --}}
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="filter_semester" class="form-label font-weight-bold small">Semester</label>
                    <select class="form-control form-control-sm" id="filter_semester" name="semester_id" required>
                        <option value="">-- Pilih Semester --</option>
                        {{-- Data Semester dari API --}}
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="filter_kelas" class="form-label font-weight-bold small">Kelas</label>
                    <select class="form-control form-control-sm" id="filter_kelas" name="kelas_id">
                        <option value="">-- Semua Kelas --</option>
                        {{-- Data Kelas dari API --}}
                    </select>
                </div>
                <div class="col-md-3 d-flex align-items-end">
                    <div class="btn-group w-100" role="group">
                        <button type="submit" class="btn btn-secondary btn-sm" id="btnTampilkan">
                            <i class="fa-solid fa-eye"></i> Tampilkan
                        </button>
                        <button type="button" class="btn btn-primary btn-sm ml-2" id="btnHitungMarcos">
                            <i class="fa-solid fa-calculator"></i> Hitung MARCOS
                        </button>
                    </div>
                </div>
            </div>
        </form>
        {{-- End Form Filter --}}

        {{-- Section 1: Tabel Hasil Survei (Data Mentah Rata-rata) --}}
        <h5 class="font-weight-bold text-secondary mb-3">
            <i class="fa-solid fa-table"></i> Data Survei Dosen
        </h5>

        {{-- Kontrol Pencarian dan Pagination --}}
        <div class="row mb-3 align-items-center">
            <div class="col-md-6">
                <div class="d-flex align-items-center">
                    <label class="me-2 mb-0 small font-weight-bold">Tampilkan</label>
                    <select id="pageSize" class="form-control form-control-sm" style="width: 70px;">
                        <option value="5">5</option>
                        <option value="10" selected>10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                    <label class="ms-2 mb-0 small">data</label>
                </div>
            </div>
            <div class="col-md-6">
                <div class="d-flex justify-content-end">
                    <div class="input-group input-group-sm" style="width: 250px;">
                        <input type="text" id="searchInput" class="form-control" placeholder="Cari NIM atau Nama...">
                        <div class="input-group-append">
                            <span class="input-group-text bg-white">
                                <i class="fa-solid fa-search text-muted"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Tabel Utama --}}
        <div class="table-responsive mb-3" style="overflow-x: auto; border: 1px solid #dee2e6; border-radius: 4px;">
            <table id="surveiTable" class="table table-bordered table-striped table-hover mb-0" style="min-width: 100%;">
                <thead id="surveiHeader" class="bg-light">
                    {{-- Header akan diisi oleh JavaScript --}}
                </thead>
                <tbody id="surveiBody">
                    {{-- Body akan diisi oleh JavaScript --}}
                </tbody>
            </table>
        </div>

        {{-- Pagination Info dan Tombol --}}
        <div class="row mt-3 align-items-center">
            <div class="col-md-6">
                <div id="pageInfo" class="text-muted small">
                    Menampilkan 0 sampai 0 dari 0 data
                </div>
            </div>
            <div class="col-md-6">
                <nav aria-label="Page navigation">
                    <ul class="pagination pagination-sm justify-content-end mb-0">
                        <li class="page-item" id="prevPage">
                            <a class="page-link" href="#" tabindex="-1" aria-disabled="true">
                                <i class="fa-solid fa-chevron-left"></i> Sebelumnya
                            </a>
                        </li>
                        <li class="page-item" id="nextPage">
                            <a class="page-link" href="#">
                                Selanjutnya <i class="fa-solid fa-chevron-right"></i>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
        {{-- End Section 1 --}}

        {{-- Section 2: Tabel Hasil Perhitungan MARCOS (Hidden by Default) --}}
        <div id="hasilMarcosSection" style="display: none;">
            <hr class="my-4">
            <h5 class="font-weight-bold text-primary mb-3">
                <i class="fa-solid fa-trophy"></i> Hasil Perhitungan MARCOS (Ranking)
            </h5>
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover table-sm" id="rankingTable">
                    <thead class="thead-light">
                        <tr>
                            <th class="text-center" style="width: 80px;">Peringkat</th>
                            <th>Nama Dosen</th>
                            <th class="text-center" style="width: 150px;">Nilai Akhir $F(Ki)$</th>
                        </tr>
                    </thead>
                    <tbody id="rankingBody">
                        {{-- Data Ranking dari JS --}}
                    </tbody>
                </table>
            </div>
        </div>
        {{-- End Section 2 --}}

    </x-base-body>
</div>

{{-- Loading Overlay --}}
<div id="loadingOverlay" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(255,255,255,0.8); z-index: 9999; text-align: center; padding-top: 20%;">
    <div class="spinner-border text-primary" role="status">
        <span class="sr-only">Loading...</span>
    </div>
    <div class="mt-2 text-primary">Memuat data...</div>
</div>

@endsection

@section('styles')
<style>
    /* Styling tambahan untuk tabel */
    #surveiTable {
        width: 100% !important;
        border-collapse: collapse;
    }

    #surveiTable th,
    #surveiTable td {
        padding: 0.5rem;
        vertical-align: middle;
        white-space: nowrap;
    }

    #surveiTable th {
        background-color: #f8f9fa;
        font-weight: 600;
        border-bottom: 2px solid #dee2e6;
    }

    #surveiTable td.border-left {
        border-left: 1px solid #dee2e6 !important;
    }

    /* Hover effect */
    #surveiTable tbody tr:hover {
        background-color: #f5f5f5;
    }

    /* Styling untuk nilai */
    .text-success {
        color: #28a745 !important;
    }

    .text-danger {
        color: #dc3545 !important;
    }

    .text-dark {
        color: #343a40 !important;
    }

    .font-weight-bold {
        font-weight: 600 !important;
    }

    /* Pagination styling */
    .pagination .page-link {
        color: #6c757d;
        border: 1px solid #dee2e6;
        padding: 0.3rem 0.75rem;
    }

    .pagination .page-item.disabled .page-link {
        color: #adb5bd;
        pointer-events: none;
        background-color: #e9ecef;
        border-color: #dee2e6;
    }

    .pagination .page-item:not(.disabled) .page-link:hover {
        background-color: #007bff;
        color: white;
        border-color: #007bff;
    }

    /* Card styling */
    .bg-light {
        background-color: #f8f9fc !important;
    }

    /* Alert styling */
    .alert-secondary {
        background-color: #f1f5f9;
        border-left: 4px solid #6c757d;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .d-flex.align-items-center {
            margin-bottom: 10px;
        }

        .justify-content-end {
            justify-content: flex-start !important;
        }

        .input-group {
            width: 100% !important;
        }
    }

    /* Loading overlay */
    #loadingOverlay {
        transition: all 0.3s ease;
    }

    /* Tooltip styling */
    [data-tooltip] {
        position: relative;
        cursor: help;
    }

    [data-tooltip]:before {
        content: attr(data-tooltip);
        position: absolute;
        bottom: 100%;
        left: 50%;
        transform: translateX(-50%);
        padding: 4px 8px;
        background: rgba(0,0,0,0.8);
        color: white;
        font-size: 12px;
        border-radius: 4px;
        white-space: nowrap;
        display: none;
        z-index: 1000;
    }

    [data-tooltip]:hover:before {
        display: block;
    }

    /* Border left untuk kolom dosen */
    .border-left {
        border-left: 2px solid #dee2e6 !important;
    }

    /* Styling untuk header tabel */
    #surveiHeader tr:first-child th {
        border-bottom: 2px solid #adb5bd;
        font-size: 0.9rem;
    }

    #surveiHeader tr:last-child th {
        font-size: 0.85rem;
        background-color: #e9ecef;
    }

    /* Empty state styling */
    .text-center.py-5 {
        background-color: #fafafa;
    }

    .fa-folder-open-o {
        opacity: 0.5;
    }
</style>
@endsection

@section('scripts')
<script type="module" src="{{ asset('controllers/hasil-survei.controller.js') }}"></script>

@endsection

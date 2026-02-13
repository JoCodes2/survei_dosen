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
            <div class="row mb-3 bg-light ">
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
                    <div class="btn-group w-100 " role="group">
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
        <div class="table-responsive mb-5">
            <table class="table table-bordered table-striped table-sm" id="surveiTable">
                <thead class="thead-dark">
                    <tr>
                        <th rowspan="2" class="align-middle text-center">No</th>
                        <th rowspan="2" class="align-middle text-center">Nama Dosen</th>
                        <th colspan="4" class="text-center">Kriteria (Skor Rata-rata)</th>
                    </tr>
                    <tr>
                        <th class="text-center">C1</th>
                        <th class="text-center">C2</th>
                        <th class="text-center">C3</th>
                        <th class="text-center">C4</th>
                    </tr>
                </thead>
                <tbody id="surveiBody">
                    <tr>
                        <td colspan="6" class="text-center">Pilih filter dan klik 'Tampilkan'</td>
                    </tr>
                </tbody>
            </table>
        </div>
        {{-- End Section 1 --}}

        {{-- Section 2: Tabel Hasil Perhitungan MARCOS (Hidden by Default) --}}
        <div id="hasilMarcosSection" style="display: none;">
            <hr>
            <h5 class="font-weight-bold text-primary mb-3">
                <i class="fa-solid fa-trophy"></i> Hasil Perhitungan MARCOS (Ranking)
            </h5>
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-sm" id="rankingTable">
                    <thead class="thead-light">
                        <tr>
                            <th class="text-center">Peringkat</th>
                            <th>Nama Dosen</th>
                            <th class="text-center">Nilai Akhir $F(Ki)$</th>
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

@endsection

@section('scripts')
<script type="module" src="{{ asset('controllers/hasil-survei.controller.js') }}"></script>
@endsection

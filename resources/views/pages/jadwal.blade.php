@extends('Layouts.Base')

@section('content')
<div class="card">

    <x-base-header title="Manajemen Penugasan Dosen" icon="fa-solid fa-person-chalkboard">
        <div class="d-flex gap-2">
            <button type="button" class="btn btn-primary btn-sm" id="btnTambahKelas">
                <i class="fa fa-plus"></i> Tambah Penugasan Dosen
            </button>
        </div>
    </x-base-header>

    <x-base-body>
        <div class="alert alert-secondary border-0 small mb-4">
            <i class="fa-solid fa-circle-info mr-1"></i>
            Halaman ini digunakan untuk mengatur data penugasan  dosen.
        </div>

        {{-- Section Filter --}}
        <div class="row mb-3  bg-light rounded">
            <div class="col-md-4">
                <label for="filter_program_studi" class="form-label font-weight-bold small">Filter Program Studi</label>
                <select class="form-control form-control-sm" id="filter_program_studi">
                    <option value="">-- Semua Prodi --</option>
                    {{-- Isi options dari Controller --}}
                </select>
            </div>
            <div class="col-md-4">
                <label for="filter_semester" class="form-label font-weight-bold small">Filter Semester</label>
                <select class="form-control form-control-sm" id="filter_semester">
                    <option value="">-- Semua Semester --</option>
                    {{-- Isi options dari Controller --}}
                </select>
            </div>
            <div class="col-md-4 d-flex align-items-end">
                <button type="button" class="btn btn-secondary btn-sm w-100" id="btnFilter">
                    <i class="fa-solid fa-filter"></i> Terapkan Filter
                </button>
            </div>
        </div>
        {{-- End Section Filter --}}

        @php
            // Menyesuaikan header tabel
            $headers = ['No', 'Doden', 'Program Studi', 'Semester', 'Aksi'];
        @endphp

        <x-base-table :headers="$headers" id="kelasTable">
            <tbody id="kelasBody">
            </tbody>
        </x-base-table>
    </x-base-body>
</div>

{{-- Bagian Modal (Tetap sama) --}}
<x-base-modal
    id="modalTambahKelas"
    title="Form Kelas"
    btnId="btnSimpanKelas"
    btnText="Simpan Kelas"
>
    <form id="formKelas" method="POST">
        @csrf
        <input type="hidden" name="id" id="id">
        <div class="mb-3">
            <label for="dosen_id" class="form-label font-weight-bold">Dosen</label>
            <select class="form-control select2" id="dosen_id" name="dosen_id" style="width: 100%;">
                <option value="">-- Pilih Dosen --</option>
            </select>
            <small class="text-danger error-msg" id="error-dosen_id"></small>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="program_studi_id" class="form-label font-weight-bold">Program Studi</label>
                <select class="form-control" id="program_studi_id" name="program_studi_id">
                    <option value="">-- Pilih Prodi --</option>
                </select>
                <small class="text-danger error-msg" id="error-program_studi_id"></small>
            </div>
            <div class="col-md-6 mb-3">
                <label for="semester_id" class="form-label font-weight-bold">Semester</label>
                <select class="form-control" id="semester_id" name="semester_id">
                    <option value="">-- Pilih Semester --</option>
                </select>
                <small class="text-danger error-msg" id="error-semester_id"></small>
            </div>
        </div>
    </form>
</x-base-modal>
@endsection

@section('scripts')
<script type="module" src="{{ asset('controllers/kelas.controller.js') }}"></script>
@endsection

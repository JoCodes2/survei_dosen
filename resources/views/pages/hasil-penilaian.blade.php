@extends('Layouts.Base')

@section('content')
<div class="card">
    <x-base-header title="History Perhitungan MARCOS Dosen" icon="fa-solid fa-history"></x-base-header>

    <x-base-body>
        <div class="alert alert-secondary border-0 small mb-4">
            <i class="fa-solid fa-circle-info mr-1"></i>
            Silakan pilih filter Program Studi dan Semester untuk melihat history.
        </div>

        {{-- Form Filter --}}
        <form id="formFilterData">
            <div class="row mb-3 bg-light p-2 rounded">
                <div class="col-md-5">
                    <label class="form-label font-weight-bold small">Program Studi</label>
                    <select class="form-control form-control-sm" id="filter_program_studi" name="program_studi_id" required>
                        <option value="">-- Pilih Prodi --</option>
                    </select>
                </div>
                <div class="col-md-5">
                    <label class="form-label font-weight-bold small">Semester</label>
                    <select class="form-control form-control-sm" id="filter_semester" name="semester_id" required>
                        <option value="">-- Pilih Semester --</option>
                    </select>
                </div>
                <div class="col-md-2 d-flex align-items-end">
                    <button type="submit" class="btn btn-secondary btn-sm w-100" id="btnTampilkan">
                        <i class="fa-solid fa-eye"></i> Tampilkan
                    </button>
                </div>
            </div>
        </form>

        {{-- Container untuk Hasil Pengelompokan --}}
        <div id="historyContainer">
            <div class="text-center text-muted py-5">
                <i class="fa-solid fa-folder-open fa-3x mb-3"></i>
                <p>Silakan pilih filter dan klik 'Tampilkan'</p>
            </div>
        </div>
    </x-base-body>
</div>

{{-- Loading Overlay --}}
<div id="loadingOverlay" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(255,255,255,0.8); z-index: 9999; text-align: center; padding-top: 20%;">
    <div class="spinner-border text-primary" role="status">
        <span class="sr-only">Loading...</span>
    </div>
</div>
@endsection

@section('styles')
<style>
    .date-group-header {
        background-color: #e9ecef;
        padding: 10px 15px;
        font-weight: bold;
        border-radius: 4px;
        margin-top: 20px;
        display: flex;
        align-items: center;
        border-left: 4px solid #6c757d;
    }
    .table-history {
        margin-top: 5px;
        border: 1px solid #dee2e6;
    }
    .table-history th {
        background-color: #f8f9fa;
    }

</style>
<style>
    .btn-circle {
        width: 30px;
        height: 30px;
        padding: 6px 0px;
        border-radius: 15px;
        text-align: center;
        font-size: 12px;
        line-height: 1.42857;
    }
    .border-left-primary {
        border-left: 0.25rem solid #4e73df !important;
    }
</style>
@endsection

@section('scripts')
<script type="module" src="{{ asset('controllers/history.controller.js') }}"></script>
@endsection

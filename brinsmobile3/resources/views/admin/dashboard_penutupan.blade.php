@extends('layouts.admin')

@section('title', 'Dashboard Admin')

@section('content')
<div class="container dashboard-container">
    <div class="total-container">
        <div class="card total-card shadow-sm">
            <div class="card-content">
                <p><b>Total Permohonan</b></p>
                <h2>{{ $permohonan }}</h2>
            </div>
        </div>
        <div class="card total-card shadow-sm">
            <div class="card-content">
                <p><b>Total Permohonan disetujui</b></p>
                <h2>{{ $approved }}</h2>
            </div>
        </div>
        <div class="card total-card shadow-sm">
            <div class="card-content">
                <p><b>Total Permohonan Ditolak</b></p>
                <h2>{{ $rejected }}</h2>
            </div>
        </div>
        <div class="card total-card shadow-sm">
            <div class="card-content">
                <p><b>Total permohonan pending</b></p>
                <h2>{{ $pending }}</h2>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="filter">
            <div class="filter-items">
                <label for="searchStatus">Status</label>
                <select class="filter-box" id="searchStatus" name="seardchStatus">
                    <option value="">Semua</option>
                    <option value="Pending">Pending</option>
                    <option value="Disetujui">Disetujui</option>
                    <option value="Ditolak">Ditolak</option>
                </select>
            </div>
            <div class="filter-items">
                <label for="searchTanggalPengajuan">Tanggal Pengajuan</label>
                <input class="filter-box" type="date" id="searchTanggalPengajuan" name="searchTanggalPengajuan">
            </div>
            <button class="filter-button">Search</button>
            <button class="filter-button">reset</button>
        </div>
        <div class="datatables-wrapper">
            {{$dataTable->table()}}
        </div>
    </div>
</div>
@endsection

@push('scripts')
    {{$dataTable->scripts()}}
@endpush

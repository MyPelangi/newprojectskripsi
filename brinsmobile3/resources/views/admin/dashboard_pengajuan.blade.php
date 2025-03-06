@extends('layouts.admin')

@section('title', 'Dashboard Admin')

@section('content')
<div class="container dashboard-container">
    <div class="total-container">
        <div class="card total-card">
            <div class="card-content">
                <p><b>Jumlah Proses</b></p>
                <h2>{{ $proses }}</h2>
            </div>
        </div>
        <div class="card total-card">
            <div class="card-content">
                <p><b>Jumlah Menunggu Pembayaran</b></p>
                <h2>{{ $menunggupembayaran }}</h2>
            </div>
        </div>
        <div class="card total-card">
            <div class="card-content">
                <p><b>Jumlah Selesai</b></p>
                <h2>{{ $selesai }}</h2>
            </div>
        </div>
    </div>
    <hr>
    <div class="filter">
        <div class="filter-items">
            <label for="searchNamaUser">Nama</label>
            <input class="filter-box" type="text" id="searchNamaUser" placeholder="Cari Nama User">
        </div>
        <div class="filter-items">
            <label for="searchTanggalPengajuan">Tanggal Pengajuan</label>
            <input class="filter-box" type="date" id="searchTanggalPengajuan">
        </div>
        <button class="filter-button">Search</button>
        <button class="filter-button">reset</button>
    </div>
    {{$dataTable->table()}}
</div>
@endsection

@push('scripts')
    {{$dataTable->scripts()}}
@endpush

@extends('layouts.main')

@section('content')
<div class="container">
    <h1 class="produk-title"><b>PROFIL</b></h1>
    <br>
    <div class="card">
        <div class="container">
            <div class="card-content-split">
                <div class="detail-container">
                    <p>Nama</p>
                    <p><b>{{ Auth::user()->nama }}</b></p>
                </div>
                <div class="detail-container">
                    <p>Nama ibu kandung</p>
                    <p><b>{{ Auth::user()->nama_ibu }}</b></p>
                </div>
                <div class="detail-container">
                    <p>Gender</p>
                    <p><b>{{ Auth::user()->gender }}</b></p>
                </div>
                <div class="detail-container">
                    <p>Pekerjaan</p>
                    <p><b>{{ Auth::user()->pekerjaan }}</b></p>
                </div>
                <div class="detail-container">
                    <p>Tempat lahir</p>
                    <p><b>{{ Auth::user()->tempat_lahir }}</b></p>
                </div>
                <div class="detail-container">
                    <p>Sumber pendapatan</p>
                    <p><b>{{ Auth::user()->sumber_pendapatan }}</b></p>
                </div>
                <div class="detail-container">
                    <p>Tanggal lahir</p>
                    <p><b>{{ \Carbon\Carbon::parse(Auth::user()->tgl_lahir)->translatedFormat('d F Y') }}</b></p>
                </div>
                <div class="detail-container">
                    <p>Rata-rata pendapatan per tahun</p>
                    <p><b>Rp{{ number_format(Auth::user()->pendapatan_tahunan, 0, ',', '.') }}</b></p>
                </div>
                <div class="detail-container">
                    <p>Nomor KTP</p>
                    <p><b>{{ Auth::user()->no_ktp }}</b></p>
                </div>
                <div class="detail-container">
                    <p>Tujuan/hubungan bisnis</p>
                    <p><b>{{ Auth::user()->tujuan }}</b></p>
                </div>
                <div class="detail-container">
                    <p>Kewarganegaraan</p>
                    <p><b>{{ Auth::user()->kewarganegaraan }}</b></p>
                </div>
                <div class="detail-container">
                    <p>Nama penerima manfaat</p>
                    <p><b>{{ Auth::user()->nama_penerima }}</b></p>
                </div>
                <div class="detail-container">
                    <p>Status menikah</p>
                    <p><b>{{ Auth::user()->status_menikah }}</b></p>
                </div>
                <div class="detail-container">
                    <p>Kantor cabang terdekat</p>
                    <p><b>{{ Auth::user()->kantor_cabang }}</b></p>
                </div>
            </div>
        </div>
    </div>
    <br>
    <div class="card">
        <div class="container">
            <h5 class="card-title">Kontak</h5>
            <div class="card-content-split">
                <div class="detail-container">
                    <p>Email</p>
                    <p><b>{{ Auth::user()->email }}</b></p>
                </div>
                <div class="detail-container">
                    <p>Kecamatan/Kelurahan</p>
                    <p><b>{{ Auth::user()->kecamatan_kelurahan }}</b></p>
                </div>
                <div class="detail-container">
                    <p>Nomor telepon</p>
                    <p><b>{{ Auth::user()->no_telp }}</b></p>
                </div>
                <div class="detail-container">
                    <p>Alamat lengkap</p>
                    <p><b>{{ Auth::user()->alamat_lengkap }}</b></p>
                </div>
                <div class="detail-container">
                    <p>Kode pos</p>
                    <p><b>{{ Auth::user()->kode_pos }}</b></p>
                </div>
                <div class="detail-container">
                    <p>Alamat kantor</p>
                    <p><b>{{ Auth::user()->alamat_kantor }}</b></p>
                </div>
                <div class="detail-container">
                    <p>Provinsi</p>
                    <p><b>{{ Auth::user()->provinsi }}</b></p>
                </div>
                <div class="detail-container">
                    <p>Nomor telepon kantor</p>
                    <p><b>{{ Auth::user()->no_telp_kantor }}</b></p>
                </div>
                <div class="detail-container">
                    <p>Kota</p>
                    <p><b>{{ Auth::user()->kota }}</b></p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


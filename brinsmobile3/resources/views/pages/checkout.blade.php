@extends('layouts.main')

@section('content')
<div class="containers">
    <div class="header">
        <img src="/img/sepeda.png" alt="">
        <div class="header-title">
            <h1>Checkout</h1>
        </div>
    </div>
    <div class="container">
        <div class="card" style="margin-top: 40px">
            <div class="card-body">
                <h5 class="card-title">Detail</h5>
                <div class="card-content-split">
                    <div class="price-section">
                        <div class="detail-container">
                            <p>Premi</p>
                            <p><b>Rp {{ number_format($pengajuan->premi ?? 0, 0, ',', '.') }}</b></p>
                        </div>
                        <div class="detail-container">
                            <p>Biaya Administrasi</p>
                            <p><b>Rp 20.000</b></p>
                        </div>
                    </div>
                    <div class="price-section">
                        <p>Total</p>
                        <h5 class="price" id="total"><b>Rp {{ number_format($pengajuan->total ?? 0, 0, ',', '.') }}</b></h5>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <button class="showtransaksi">Lihat Detail Transaksi >></button>
        <br>
        <div id="showdetail" class="card" style="display: none; margin-top: 20px;">
            <div class="card-body">
                <h5 class="card-title">Rangkuman</h5>
                <div class="card-content-split">
                    <div class="detail-container">
                        <p>Produk</p>
                        <p><b>Sepeda</b></p>
                    </div>
                    <div class="detail-container">
                        <p>Seri Sepeda</p>
                        <p><b>{{ $pengajuan->seri_sepeda ?? '-' }}</b></p>
                    </div>
                    <div class="detail-container">
                        <p>Paket</p>
                        <p><b>{{ $pengajuan->plan ?? '-' }}</b></p>
                    </div>
                    <div class="detail-container">
                        <p>Warna Sepeda</p>
                        <p><b>{{ $pengajuan->warna_sepeda ?? '-' }}</b></p>
                    </div>
                    <div class="detail-container">
                        <p>Premi</p>
                        <p><b>Rp {{ number_format($pengajuan->premi ?? 0, 0, ',', '.') }}</b></p>
                    </div>
                    <div class="detail-container">
                        <p>Nomor Rangka Sepeda</p>
                        <p><b>{{ $pengajuan->no_rangka_sepeda ?? '-' }}</b></p>
                    </div>
                    <div class="detail-container">
                        <p>Harga Sepeda</p>
                        <p><b>Rp {{ number_format($pengajuan->harga_sepeda ?? 0, 0, ',', '.') }}</b></p>
                    </div>
                    <div class="detail-container">
                        <p>Tahun Produksi Sepeda</p>
                        <p><b>{{ $pengajuan->tahun_produksi ?? '-' }}</b></p>
                    </div>
                    <div class="detail-container">
                        <p>Merek Sepeda</p>
                        <p><b>{{ $pengajuan->merek_sepeda ?? '-' }}</b></p>
                    </div>
                    <div class="detail-container">
                        <p>Nomor Invoice Pembelian</p>
                        <p><b>{{ $pengajuan->no_invoice_pembelian ?? '-' }}</b></p>
                    </div>
                    <div class="detail-container">
                        <p>Tipe Sepeda</p>
                        <p><b>{{ $pengajuan->tipe_sepeda ?? '-' }}</b></p>
                    </div>
                    <div class="detail-container">
                        <p>Kode Promo</p>
                        <p><b>{{ $pengajuan->kode_promo ?? '-' }}</b></p>
                    </div>
                    <div class="detail-container">
                        <p>Model Sepeda</p>
                        <p><b>{{ $pengajuan->model_sepeda ?? '-' }}</b></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="card" style="margin-top: 20px;">
            <div class="card-body">
                <h5 class="card-title">Metode Pembayaran</h5>
                <div class="card-content">
                    <div class="metode metode-brimo" data-method="BRI Mobile">
                        <img src="/img/logo_brimo.png" alt="" width="40px">
                        <p>Brimo</p>
                    </div>
                    <div class="metode metode-qris" data-method="QRIS">
                        <img src="/img/logo_qris.png" alt="" width="85px">
                        <p>QRIS</p>
                    </div>
                    <div class="metode metode-bank" data-method="Bank Transfer">
                        <i class="fa-solid fa-money-check" style="font-size: 40px"></i>
                        <p>Transfer Bank</p>
                    </div>
                    <div class="metode metode-merchant" data-method="Merchant">
                        <i class="fa-solid fa-store" style="font-size: 40px"></i>
                        <p>Merchant</p>
                    </div>
                </div>
            </div>
        </div>
        <button type="button" id="btn-lanjutkan" class="btn upload-button">Lanjutkan ke Pembayaran</button>
    </div>
</div>
@endsection

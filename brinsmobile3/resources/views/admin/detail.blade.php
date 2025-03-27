@extends('layouts.admin')

@section('title', 'Dashboard Admin')

@section('content')
<div class="container dashboard-container">
    <h1><b>Informasi Polis</b></h1>
    <br>
    <div class="detail-step">
        <div class="section choose">
            <p>Tertanggung</p>
        </div>
        <div class="section">
            <p>Informasi Objek</p>
        </div>
        <div class="section">
            <p>Dokumen Pendukung</p>
        </div>
        <div class="section">
            <p>Informasi Pembayaran</p>
        </div>
    </div>
    <br>

    <div class="detail-section">
        <div class="card">
            <div class="container">
                <div class="card-content-split">
                    <div class="detail-container">
                        <p>Nama</p>
                        <p><b>{{ $data->user->nama }}</b></p>
                    </div>
                    <div class="detail-container">
                        <p>Nama ibu kandung</p>
                        <p><b>{{ $data->user->nama_ibu }}</b></p>
                    </div>
                    <div class="detail-container">
                        <p>Gender</p>
                        <p><b>{{ $data->user->gender }}</b></p>
                    </div>
                    <div class="detail-container">
                        <p>Pekerjaan</p>
                        <p><b>{{ $data->user->pekerjaan }}</b></p>
                    </div>
                    <div class="detail-container">
                        <p>Tempat lahir</p>
                        <p><b>{{ $data->user->tempat_lahir }}</b></p>
                    </div>
                    <div class="detail-container">
                        <p>Sumber pendapatan</p>
                        <p><b>{{ $data->user->sumber_pendapatan }}</b></p>
                    </div>
                    <div class="detail-container">
                        <p>Tanggal lahir</p>
                        <p><b>{{ \Carbon\Carbon::parse($data->user->tgl_lahir)->format('d M Y') }}</b></p>
                    </div>
                    <div class="detail-container">
                        <p>Rata-rata pendapatan per tahun</p>
                        <p><b>Rp {{ number_format($data->user->pendapatan_tahunan, 0, ',', '.') }}</b></p>
                    </div>
                    <div class="detail-container">
                        <p>Nomor KTP</p>
                        <p><b>{{ $data->user->no_ktp }}</b></p>
                    </div>
                    <div class="detail-container">
                        <p>Tujuan/hubungan bisnis</p>
                        <p><b>{{ $data->user->tujuan }}</b></p>
                    </div>
                    <div class="detail-container">
                        <p>Kewarganegaraan</p>
                        <p><b>{{ $data->user->kewarganegaraan }}</b></p>
                    </div>
                    <div class="detail-container">
                        <p>Nama penerima manfaat</p>
                        <p><b>{{ $data->user->nama_penerima }}</b></p>
                    </div>
                    <div class="detail-container">
                        <p>Status menikah</p>
                        <p><b>{{ $data->user->status_menikah }}</b></p>
                    </div>
                    <div class="detail-container">
                        <p>Kantor cabang terdekat</p>
                        <p><b>{{ $data->user->kantor_cabang }}</b></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="detail-section">
        <div class="card">
            <div class="container">
                <div class="card-content-split">
                    <div class="detail-container">
                        <p>Produk</p>
                        <p><b>{{ $data->produk }}</b></p>
                    </div>
                    <div class="detail-container">
                        <p>Seri Sepeda</p>
                        <p><b>{{ $data->seri_sepeda }}</b></p>
                    </div>
                    <div class="detail-container">
                        <p>Paket</p>
                        <p><b>{{ $data->plan }}</b></p>
                    </div>
                    <div class="detail-container">
                        <p>Warna Sepeda</p>
                        <p><b>{{ $data->warna_sepeda }}</b></p>
                    </div>
                    <div class="detail-container">
                        <p>Premi</p>
                        <p><b>Rp {{ $data->premi }}</b></p>
                    </div>
                    <div class="detail-container">
                        <p>Nomor Rangka Sepeda</p>
                        <p><b>{{ $data->no_rangka_sepeda }}</b></p>
                    </div>
                    <div class="detail-container">
                        <p>Harga Sepeda</p>
                        <p><b>Rp {{ $data->harga_sepeda }}</b></p>
                    </div>
                    <div class="detail-container">
                        <p>Tahun Produksi Sepeda</p>
                        <p><b>{{ $data->tahun_produksi }}</b></p>
                    </div>
                    <div class="detail-container">
                        <p>Merek Sepeda</p>
                        <p><b>{{ $data->merek_sepeda }}</b></p>
                    </div>
                    <div class="detail-container">
                        <p>Nomor Invoice Pembelian</p>
                        <p><b>{{ $data->no_invoice_pembelian }}</b></p>
                    </div>
                    <div class="detail-container">
                        <p>Tipe Sepeda</p>
                        <p><b>{{ $data->TipeSepeda->tipe_sepeda }}</b></p>
                    </div>
                    <div class="detail-container">
                        <p>Kode Promo</p>
                        <p><b>{{ $data->kode_promo }}</b></p>
                    </div>
                    <div class="detail-container">
                        <p>Model Sepeda</p>
                        <p><b>{{ $data->model_sepeda }}</b></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="detail-section">
        <div class="card">
            <div class="container">
                <div class="card-content-split">
                    @if(!empty($data->dok_ktp) || !empty($data->dok_invoice_pembelian))
                        <div class="detail-container">
                            <label><b>Ktp <span class="badge badge-valid">{{ $data->status }}</span></b></label>
                            <img class="upload-box" src="http://127.0.0.1:5000/flaskapi/{{ basename($data->dok_ktp) }}" alt="KTP">
                        </div>
                        <div class="detail-container">
                            <label><b>Invoice Pembelian <span class="badge badge-valid">{{ $data->status }}</span></b></label>
                            <img class="upload-box" src="http://127.0.0.1:5000/flaskapi/{{ basename($data->dok_invoice_pembelian) }}" alt="Invoice">
                        </div>
                    @else
                        <p>Belum ada dokumen yang diunggah.</p>
                    @endif

                    @if($data->prediksi->isNotEmpty())
                        @foreach($data->prediksi as $prediksi)
                            <div class="detail-container">
                                <label><b>{{ $prediksi->jenis_gambar }} <span class="badge badge-valid">{{ $prediksi->status }}</span></b></label>
                                <img class="upload-box" src="http://127.0.0.1:5000/flaskapi/{{ basename($prediksi->path_gambar) }}" alt="Prediksi Gambar">
                            </div>
                        @endforeach
                    @else
                        <p>Belum ada data prediksi.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="detail-section">
        <div class="card">
            <div class="container">
                <div class="card-content-split">
                    @if($data->pembayaran)
                        <div class="detail-container">
                            <p>Metode Pembayaran</p>
                            <p><b>{{ $data->pembayaran->metode_pembayaran }}</b></p>
                        </div>
                        <div class="detail-container">
                            <p>Nomor Virtual Account</p>
                            <p><b>{{ $data->pembayaran->nomor_va }}</b></p>
                        </div>
                        <div class="detail-container">
                            <p>Total</p>
                            <p><b>Rp {{ number_format($data->pembayaran->total, 0, ',', '.') }}</b></p>
                        </div>
                        <div class="detail-container">
                            <p>Tanggal Pembayaran</p>
                            <p><b>{{ $data->pembayaran->updated_at }}</b></p>
                        </div>
                    @else
                        <p>Belum ada pembayaran.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

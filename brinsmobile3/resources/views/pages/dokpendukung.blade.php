@extends('layouts.main')

@section('content')
<div class="containers">
    <div class="header">
        <img src="img/sepeda.png" alt="">
        <div class="header-title">
            <h1>Sepeda</h1>
            <h4>Tahunan</h4>
        </div>
    </div>
    <div class="container">
        <div class="step-container">
            <div class="step active">
                <div class="circle">1</div>
                <span>Kalukasi Premi</span>
            </div>
            <div class="step active">
                <div class="circle">2</div>
                <span>Kode Promo</span>
            </div>
            <div class="step active">
                <div class="circle">3</div>
                <span>Hasil Kalkulasi</span>
            </div>
            <div class="step active">
                <div class="circle">4</div>
                <span>Informasi Objek</span>
            </div>
            <div class="step current">
                <div class="circle">5</div>
                <span>Dokumen Pendukung</span>
            </div>
            <div class="step">
                <div class="circle">6</div>
                <span>Detail Transaksi</span>
            </div>
            <div class="step">
                <div class="circle">7</div>
                <span>Syarat & Ketentuan</span>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Dokumen Pendukung</h5>
                <p class="card-text">Lampirkan foto yang diperlukan.</p>
                <form action="{{ url('/api/store') }}" id="imageForm" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card-content">
                        <div class="image-upload">
                            <label>KTP*</label>
                            <div class="upload-box">
                                <input type="file" accept="image/*" id="ktp" name="images[ktp]" required>
                                <img id="preview-ktp" alt="Preview" style="display:none;">
                                <span>Unggah Gambar</span>
                            </div>
                        </div>
                        <div class="image-upload">
                            <label>Invoice Pembelian*</label>
                            <div class="upload-box">
                                <input type="file" accept="image/*" id="invoice" name="images[invoice]" required>
                                <img id="preview-invoice" alt="Preview" style="display:none;">
                                <span>Unggah Gambar</span>
                            </div>
                        </div>
                        <div class="image-upload">
                            <label>Tampak Depan* <span id="result-tampak_depan" class="badge"></span></label>
                            <div class="upload-box">
                                <input type="file" accept="image/*" id="depan" name="images[depan]" required>
                                <img id="preview-depan" alt="Preview" style="display:none;">
                                <span>Unggah Gambar</span>
                            </div>
                        </div>
                        <div class="image-upload">
                            <label>Tampak Kiri* <span id="result-tampak_kiri" class="badge"></span></label>
                            <div class="upload-box">
                                <input type="file" accept="image/*" id="kiri" name="images[kiri]" required>
                                <img id="preview-kiri" alt="Preview" style="display:none;">
                                <span>Unggah Gambar</span>
                            </div>
                        </div>
                        <div class="image-upload">
                            <label>Tampak Kanan* <span id="result-tampak_kanan" class="badge"></span></label>
                            <div class="upload-box">
                                <input type="file" accept="image/*" id="kanan" name="images[kanan]" required>
                                <img id="preview-kanan" alt="Preview" style="display:none;">
                                <span>Unggah Gambar</span>
                            </div>
                        </div>
                        <div class="image-upload">
                            <label>Tampak Belakang* <span id="result-tampak_belakang" class="badge"></span></label>
                            <div class="upload-box">
                                <input type="file" accept="image/*" id="belakang" name="images[belakang]" required>
                                <img id="preview-belakang" alt="Preview" style="display:none;">
                                <span>Unggah Gambar</span>
                            </div>
                        </div>
                        <div id="loading" style="display: none;">
                            <p>Predicting... Please wait</p>
                            <img src="img/loading2.gif" alt="Loading" />
                        </div>
                        <button type="submit" class="btn upload-button">Unggah</button>
                    </div>
                </form>

                <h3>Prediction Results:</h3>
                <pre id="result"></pre>

            </div>
        </div>

    </div>
</div>

@endsection
{{-- <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script> --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script type="module" src="{{ asset('js/script.js') }}"></script>

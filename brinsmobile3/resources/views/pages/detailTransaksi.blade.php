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
            <div class="step active" data-step="1" id="step-1">
                <div class="circle">1</div>
                <span>Kalukasi Premi</span>
            </div>
            <div class="step active" data-step="2" id="step-2">
                <div class="circle">2</div>
                <span>Kode Promo</span>
            </div>
            <div class="step active" data-step="3" id="step-3">
                <div class="circle">3</div>
                <span>Hasil Kalkulasi</span>
            </div>
            <div class="step active" data-step="4" id="step-4">
                <div class="circle">4</div>
                <span>Informasi Objek</span>
            </div>
            <a href="/" class="step active" data-step="5" id="step-5">
                <div class="circle">5</div>
                <span>Dokumen Pendukung</span>
            </a>
            <div class="step current" data-step="6" id="step-6">
                <div class="circle">6</div>
                <span>Detail Transaksi</span>
            </div>
            <div class="step" data-step="7" id="step-7">
                <div class="circle">7</div>
                <span>Syarat & Ketentuan</span>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Detail Transaksi</h5>
                <p class="card-text">Detail informasi aset.</p>
            </div>
        </div>
    </div>
</div>

@endsection
{{-- <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script> --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script type="module" src="{{ asset('js/script.js') }}"></script>

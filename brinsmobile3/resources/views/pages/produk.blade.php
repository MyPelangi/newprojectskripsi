@extends('layouts.main')

@section('content')
<div class="container">
    <h1 class="produk-title"><b>PRODUK<span> ASURANSI</span></b></h1>
    <h4><b>Lihat semua produk</b></h4>
    <h5>Periode Tahunan</h5>
    <br>
    <div class="row product-container">
        <div class="col product shadow">
            <div class="products-title">
                <img src="img/logo_produk/sepeda.png" alt="">
                <b>SEPEDA</b>
            </div>
            <div class="products-desc">
                <p>BRINS Sepeda adalah perlindungan yang memberikan ganti rugi kepada tertanggung terhadap kerugian atas dan/atau kerusakan pada sepeda dan/atau kepentingan yang diasuransikan.</p>
            </div>
            <a href="/product/sepeda/pengajuan" class="btn products-button">Beli</a>
        </div>
        <div class="col product shadow">
            <div class="products-title">
                <img src="img/logo_produk/oto.png" alt="">
                <b>OTO</b>
            </div>
            <div class="products-desc">
                <p>Melindungi kendaraan bermotor roda 4 (empat) Anda dari kehilangan dan kerusakan yang disebabkan oleh risiko tidak terduga (yaitu: tabrakan, benturan, terbalik, tergilincir atau terperosok, perbuatan jahat.</p>
            </div>
            <a href="" class="btn products-button">Beli</a>
        </div>
        <div class="col product shadow">
            <div class="products-title">
                <img src="img/logo_produk/asri.png" alt="">
                <b>ASRI</b>
            </div>
            <div class="products-desc">
                <p>Lindungi properti dan tempat tinggal Anda dari kehilangan dan kerusakan yang disebabkan oleh risiko yang tidak terduga (yaitu: kebakaran, petir, ledakan, dampak pesawat jatuh dan asap).</p>
            </div>
            <a href="" class="btn products-button">Beli</a>
        </div>
        <div class="col product shadow">
            <div class="products-title">
                <img src="img/logo_produk/diri.png" alt="">
                <b>DIRI</b>
            </div>
            <div class="products-desc">
                <p>Melindungi diri Anda dari risiko tidak terduga yang diakibatkan oleh kecelakaan (yaitu: meninggal dunia, cacat tetap total atau cacat tetap sebagian dan biaya pengobatan).</p>
            </div>
            <a href="" class="btn products-button">Beli</a>
        </div>
    </div>

</div>
@endsection


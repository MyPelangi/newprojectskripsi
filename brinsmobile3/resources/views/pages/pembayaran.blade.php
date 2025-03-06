@extends('layouts.main')

@section('content')
<div class="containers">
    <div class="header">
        <img src="/img/sepeda.png" alt="">
        <div class="header-title">
            <h1>Pembayaran</h1>
        </div>
    </div>
    <div class="container">
        <div class="card" style="margin-top: 40px">
            <div class="card-body">
                <h5 class="card-title">Informasi Pembelian</h5>
                <div class="card-content">
                    <h2><b>{{ $pembayaran->metode_pembayaran }}</b></h2>
                    <div class="detail-container">
                        <p>Nomor Virtual Account</p>
                        <p class="pembayaran-item"><b>{{ $pembayaran->nomor_va }}</b></p>
                    </div>
                    <div class="detail-container">
                        <p>Total Pembayaran</p>
                        <p class="pembayaran-item"><b>Rp {{ number_format($pembayaran->total, 0, ',', '.') }}</b></p>
                    </div>
                    <div class="detail-container">
                        <p>Pembayaran kadaluarsa pada</p>
                        <p class="pembayaran-item"><b id="countdown"></b></p>
                    </div>
                </div>
            </div>
            <button type="button" class="btn upload-button">Konfirmasi Pembayaran</button>
        </div>
    </div>
</div>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script type="module" src="{{ asset('js/script.js') }}" defer></script>
<script>
    let countdownTime = {{ strtotime($pembayaran->batas_waktu) - time() }}; // Hitung mundur dalam detik
    function updateCountdown() {
        let hours = Math.floor(countdownTime / 3600);
        let minutes = Math.floor((countdownTime % 3600) / 60);
        let seconds = countdownTime % 60;
        document.getElementById("countdown").innerText = `${hours}j ${minutes}m ${seconds}d`;
        countdownTime--;
        if (countdownTime >= 0) setTimeout(updateCountdown, 1000);
    }
    updateCountdown();
</script>
@endsection

<!DOCTYPE html>
<html>
<head>
    <title>BRINS MOBILE | Pesanan Anda Diterima</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
    <div class="email-container">
        <div class="email-content">
            <div class="email-title-container">
                <div class="email-title">
                    <h1>SPPA</h1>
                    <p>Surat Permintaan Penutupan Asuransi</p>
                </div>
                <div class="email-logo">
                    <img src="{{ asset('img/logobrins.png') }}" alt="">
                </div>
            </div>
            <br>
            <h2>Hai,</h2>
            <p>Satu langkah lagi untuk mendapatkan proteksimu!</p>
            <p>Surat Permintaan Penutupan Asuransi Anda dengan Ref No. {{ $permohonan->ref_penutupan }} melalui Aplikasi BRINSmobile telah kami terima.</p>
            <p>Berikut adalah detail proteksi yang Anda pilih:</p>

                <div class="card">
                    <table width="100%">
                        <tr>
                            <td width="50%">
                                <p>Produk</p>
                                <p>Paket</p>
                                <p>Periode Paket</p>
                                <p>Periode Asuransi</p>
                                <p>Nilai Pertanggungan</p>
                                <p>Premi</p>
                            </td>
                            <td width="50%">
                                <p>{{ $permohonan->produk }}</p>
                                <p>{{ $permohonan->paket }}</p>
                                <p>{{ $permohonan->periode_paket }}</p>
                                <p>{{ $permohonan->tanggal_berlaku->format('d-m-Y') }}</p>
                                <p>{{ $permohonan->tanggal_berakhir->format('d-m-Y') }}</p>
                                <p>Rp {{ number_format($permohonan->nilai_pertanggungan, 0, ',', '.') }}</p>
                                <p>Rp {{ number_format($permohonan->premi, 0, ',', '.') }}</p>
                            </td>
                        </tr>
                    </table>
                </div>
            <a class="email-button" href="{{ route('checkout') }}">Lanjutkan ke Pembayaran</a>
            <p>Untuk mengaktifkan polis, Anda bisa langsung klik tombol "Lanjutkan ke Pembayaran" di atas atau dengan masuk ke menu <b>Keranjang (Menunggu Pembayaran)</b> yang tersedia di Aplikasi BRINSmobile.</p>

            <p>Permohonanmu akan otomatis dibatalkan apabile tidak melakukan pembayaran. Jika membutuhkan bantuan silahkan hubungi kami di 14081</p>
        </div>
    </div>
</body>
</html>

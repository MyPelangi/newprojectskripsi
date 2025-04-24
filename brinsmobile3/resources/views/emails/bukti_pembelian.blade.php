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
                </div>
                <div class="email-logo">
                    <img src="{{ asset('img/logobrins.png') }}" alt="">
                </div>
            </div>
            <br>
            
            <p>Pembayaran Pembelian Penutupan Asuransi Anda dengan Ref No. {{ $penutupan->ref_penutupan }} melalui Aplikasi BRINSMobile telah kami terima. </p>
            <p>Berikut adalah detail proteksi yang Anda pilih:</p>

            <div class="email-card" style="border: 1px solid #00529C; border-radius: 10px; padding: 20px 40px;">
                <table width="100%">
                    <tr>
                        <td width="50%">
                            <p>Produk</p>
                            <p>Paket</p>
                            <p>Periode Paket</p>
                            <p>Periode Asuransi</p>
                            <p>Objek Pertanggungan</p>
                            <p>Nilai Pertanggungan</p>
                            <p>Premi</p>
                        </td>
                        <td width="50%">
                            <p>{{ $polis->jenis_asuransi }}</p>
                            <p>{{ $polis->paket }}</p>
                            <p>{{ $polis->periode_paket }}</p>
                            <p>{{ $polis->periode_asuransi }}</p>
                            <p>Sepeda</p>
                            <p>Rp {{ number_format($polis->nilai_pertanggungan, 0, ',', '.') }}</p>
                            <p>Rp {{ number_format($polis->premi, 0, ',', '.') }}</p>
                        </td>
                    </tr>
                </table>
            </div>
            <p>Untuk Penerbitan polis yang telah dibeli, Mohon Anda dapat menunggu dalam waktu 1x24 Jam atau dengan masuk ke menu Polis yang tersedia di Aplikasi BRINSmobile.</p>
            <p>Salam, <br>Tim BRINSmobile</p>
        </div>
    </div>
</body>
</html>

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
            <p>Kepada Yth,</p>
            <p><b>Bapak/Ibu {{ $polis->nama_pemegang }}</b></p>
            <p>Di Tempat,</p>
            <p>Terima kasih atas kepercayaan Anda kepada PT. BRI ASURANSI INDONESIA untuk memberikan perlindungan asuransi.</p>
            <p>Terlampir kami sampaikan E-Policy untuk Anda.</p>
            <p>Berikut adalah detail proteksi yang Anda pilih:</p>

            <p>Password standar E-Policy Anda adalah ddmmyyyy, di mana : <br>
                - dd    : dua digit tanggal lahir anda <br>
                - mm  : dua digit bulan lahir anda <br>
                - yyyy : empat digit tahun lahir anda</p>

            <p>Contoh : Password 02031983</p>

            <p>Informasi Penting : <br>
                Demi kenyamanan anda dan untuk menghindari permasalahan dikemudian hari, Polis beserta lampiran-lampirannya wajib dibaca secara lengkap dan teliti. Apabila anda membutuhkan penjelasan lebih lanjut mengenai perlindungan asuransi ini atau terdapat data yang tidak sesuai, segera hubungi Call Center BRINS 14081</p>

            <p>Terima kasih,</p>
            <p>PT. BRI ASURANSI INDONESIA</p>

            <p>Jika terdapat informasi / data yang tidak sesuai harap segera hubungi <br>Call Centre : 14081.</p>

            <p>*Informasi dan data yang terdapat dalam E-Policy terlampir bersifat Pribadi dan Rahasia. Pemegang Polis bertanggung jawab sepenuhnya atas segala akibat penyalahgunaan isi dan data pada E-Policy baik yang disengaja maupun tidak disengaja oleh Pemegang Polis.
            <br>
            Pemegang Polis dengan ini membebaskan BRINS General Insurance dari segala macam klaim, tuntutan dan gugatan dari pihak manapun atas penyalahgunaan informasi dan data dalam E-Policy.
            </p>
        </div>
    </div>
</body>
</html>

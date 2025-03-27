<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cover Note</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            padding: 10px;
        }
        table {
            border: none;
        }
        table p {
            margin: 5px 0;
        }
        .header-desc strong {
            text-align: right;
            font-size: 12px;
        }
        .header-desc p {
            text-align: right;
            font-size: 10px;
        }
        img {
            width: 200px;
        }
        p{
            font-size: 12px
        }
        h1 {
            color: #004aad;
            margin-bottom: 0px;
        }
        .cover-note {
            color: #004aad;
            margin-top: 0px;
            margin-bottom: 20px;
        }
        .title {
            font-size: 22px;
            font-weight: bold;
            color: #FF6600;
            text-align: center;
            margin-top: 20px;
        }
        .sub-title {
            text-align: center
        }
        .section {
            margin-bottom: 20px;
        }
        .section-title {
            font-weight: bold;
            color: #004aad;
            text-transform: uppercase;
            padding-bottom: 5px;
        }
        strong{
            font-weight: bold;
            color: #004aad;
            font-size: 16px
        }
    </style>
</head>
<body>
    <table width="100%">
        <tr>
            <td width="50%">
                <img src="{{ public_path('img/PT-BRI-Asuransi-Indonesia.png') }}" alt="">
            </td>
            <td width="50%">
                <div class="header-desc">
                    <p><strong>PT.BRI Asuransi Indonesia</strong></p>
                    <p>Jl.Mampang Prapatan Raya No. 18, Jakarta Selatan, 12790 Indonesia
                        <br>
                        Telp: +62 81180 14081
                        <br>
                        Email: callbrins@brins.co.id
                        <br>
                        Call Center: 14081 Website: www.brins.co.id
                    </p>
                </div>
            </td>
        </tr>
    </table>
    <h1>Cover Note</h1>
    <p class="cover-note">Bukti Pembelian Asuransi</p>

    <p>Yth. Bapak/Ibu {{ $polis->user->nama }}</p>
    <p>Terima kasih atas pembelian polis Anda kepada kami. Berikut ini adalah ringkasan informasi pemegang polis, objek pertanggungan dan informasi polis Anda.</p>

    <div class="title">{{ $polis->jenis_asuransi }}<br>{{ $polis->periode_paket }}</div>

    <p class="sub-title"><strong>Nomor Referensi : {{ $penutupan->ref_penutupan }}<br>Tanggal Pembelian : {{ $pembayaran->updated_at }}</strong></p>

    <div class="section">
        <div class="section-title">Informasi Pemegang Polis / Policy Holder Information</div>
        <table width="100%">
            <tr>
                <td width="50%">
                    <p>Nama Pemegang Polis/ Policy Holder Name</p>
                    <p>Nomor Identitas/ Identification Number</p>
                    <p>Alamat/ Address</p>
                    <p>Nomor Handphone/ Phone Number</p>
                    <p>Alamat Email/ Email</p>
                </td>
                <td width="50%">
                    <p>{{ $polis->user->nama }}</p>
                    <p>{{ $polis->user->no_ktp }}</p>
                    <p>{{ $polis->user->alamat_lengkap }}</p>
                    <p>{{ $polis->user->no_telp }}</p>
                    <p>{{ $polis->user->email }}</p>
                </td>
            </tr>
        </table>
    </div>

    <div class="section">
        <div class="section-title">Objek Pertanggungan / Object Information</div>
        <table width="100%">
            <tr>
                <td width="50%">
                    <p>Jenis Objek Pertanggungan/ Object Type</p>
                    <p>Jaminan/ Coverage</p>
                    <p>Nilai Pertanggungan</p>
                </td>
                <td width="50%">
                    <p>Sepeda</p>
                    <p>Sepeda Tahunan</p>
                    <p>Rp {{ $polis->nilai_pertanggungan }}</p>
                </td>
            </tr>
        </table>
    </div>

    <div class="section">
        <div class="section-title">Informasi Polis / Policy Information</div>
        <table width="100%">
            <tr>
                <td width="50%">
                    <p>Periode Polis/ Policy Period</p>
                    <p>Premi Polis/ Premium</p>
                </td>
                <td width="50%">
                    <p>{{ $polis->periode_asuransi }}</p>
                    <p>Rp {{ $polis->premi }}</p>
                </td>
            </tr>
        </table>
    </div>

    <div class="footer">
        <p><strong>Catatan Penting</strong></p>
        <p>Cover Note ini merupakan bagian yang tidak terpisahkan dari polis pertanggungan. Ringkasan polis merupakan ringkasan dan pertanggungan Tertanggung. Untuk keterangan lebih lengkap, silakan membaca dan mempelajari polis Anda.</p>
        <p>Dokumen ini merupakan dokumen resmi dari PT BRI Asuransi Indonesia yang diproses secara elektronik dan disajikan sesuai aslinya, sehingga tidak memerlukan tanda tangan dan berlaku sebagai alat bukti yang sah.</p>
    </div>
</body>
</html>

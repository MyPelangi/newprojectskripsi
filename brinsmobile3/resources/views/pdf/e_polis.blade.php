<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-POLIS</title>
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

        td{
            vertical-align: top;
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
            width: 150px;
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
            font-size: 16px;
            font-weight: bold;
            text-align: center;
            margin-top: 20px;
        }
        .sub-title {
            text-align: center;
            font-size: 12px;
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
        </tr>
    </table>
    <div class="section">
        <div class="title">IKHTISAN PERTANGGUNGAN<br>ASURANSI SEPEDA</div>
        <hr>
        <table width="100%">
            <tr>
                <td width="25%">
                    <p>NOMOR POLIS</p>
                </td>
                <td width="60%">
                    <p>: {{ $polis->nomor_polis }}</p>
                </td>
                <td width="15%">
                    <p>(New)</p>
                </td>
            </tr>
            <tr>
                <td width="25%">
                    <p>JAMINAN</p>
                </td>
                <td width="60%">
                    <p>: {{ $polis->jenis_asuransi }} {{ $polis->paket }}</p>
                </td>
                <td width="15%">
                    <p></p>
                </td>
            </tr>
            <tr>
                <td width="25%">
                    <p>NAMA TERTANGGUNG</p>
                </td>
                <td width="60%">
                    <p>: {{ $polis->user->nama }}</p>
                </td>
                <td width="15%">
                    <p></p>
                </td>
            </tr>
            <tr>
                <td width="25%">
                    <p>ALAMAT TERTANGGUNG</p>
                </td>
                <td width="60%">
                    <p>: {{ $polis->user->alamat_lengkap }}</p>
                </td>
                <td width="15%">
                    <p></p>
                </td>
            </tr>
        </table><br>
        <div class="sub-title"><b>- DETAIL OBJEK PERTANGGUNGAN -</b></div>
        <table width="100%">
            <tr>
                <td width="25%">
                    <p>JANGKA WAKTU PERTANGGUNGAN</p>
                </td>
                <td width="60%">
                    <p>: Mulai dari {{ $polis->periode_asuransi }}</p>
                </td>
                <td width="15%">
                    <p></p>
                </td>
            </tr>
            <tr>
                <td width="25%">
                    <p>HARGA PERTANGGUNGAN</p>
                </td>
                <td width="60%">
                    <p>: -sepeda</p>
                </td>
                <td width="15%">
                    <p>IDR {{ number_format($polis->nilai_pertanggungan, 0, ',', '.') }}</p>
                </td>
            </tr>
            <tr>
                <td width="25%">
                    <p></p>
                </td>
                <td width="60%">
                    <p><b>TOTAL Harga Pertanggungan</b></p>
                </td>
                <td width="15%"><hr>
                    <p>IDR {{ number_format($polis->nilai_pertanggungan, 0, ',', '.') }}</p>
                </td>
            </tr>
            <tr>
                <td width="25%">
                    <p>MERK</p>
                </td>
                <td width="60%">
                    <p>: {{ $pengajuan->merek_sepeda }}</p>
                </td>
                <td width="15%">
                    <p></p>
                </td>
            </tr>
            <tr>
                <td width="25%">
                    <p>TYPE</p>
                </td>
                <td width="60%">
                    <p>: {{ $pengajuan->tipe_sepeda }}</p>
                </td>
                <td width="15%">
                    <p></p>
                </td>
            </tr>
            <tr>
                <td width="25%">
                    <p>MODEL</p>
                </td>
                <td width="60%">
                    <p>: {{ $pengajuan->model_sepeda }}</p>
                </td>
                <td width="15%">
                    <p></p>
                </td>
            </tr>
            <tr>
                <td width="25%">
                    <p>SERI</p>
                </td>
                <td width="60%">
                    <p>: {{ $pengajuan->seri_sepeda }}</p>
                </td>
                <td width="15%">
                    <p></p>
                </td>
            </tr>
            <tr>
                <td width="25%">
                    <p>NO. RANGKA</p>
                </td>
                <td width="60%">
                    <p>: {{ $pengajuan->no_rangka_sepeda }}</p>
                </td>
                <td width="15%">
                    <p></p>
                </td>
            </tr>
            <tr>
                <td width="25%">
                    <p>WARNA</p>
                </td>
                <td width="60%">
                    <p>: {{ $pengajuan->warna_sepeda }}</p>
                </td>
                <td width="15%">
                    <p></p>
                </td>
            </tr>
            <tr>
                <td width="25%">
                    <p>TAHUN PRODUKSI</p>
                </td>
                <td width="60%">
                    <p>: {{ $pengajuan->tahun_produksi }}</p>
                </td>
                <td width="15%">
                    <p></p>
                </td>
            </tr>
            <tr>
                <td width="25%">
                    <p>NOMOR INVOICE</p>
                </td>
                <td width="60%">
                    <p>: {{ $pengajuan->no_invoice_pembelian }}</p>
                </td>
                <td width="15%">
                    <p></p>
                </td>
            </tr>
            <tr>
                <td width="25%">
                    <p>URAIAN JAMINAN</p>
                </td>
                <td width="60%">
                    <p>: </p>
                </td>
                <td width="15%">
                    <p></p>
                </td>
            </tr>
            <tr>
                <td width="25%">
                    <p>TARIF PREMI</p>
                </td>
                <td width="60%">
                    <p>: {{ number_format($pengajuan->premi, 0, ',', '.') }}</p>
                </td>
                <td width="15%">
                    <p></p>
                </td>
            </tr>
        </table><br>
        <div class="sub-title"><b>- RISIKO DAN KLAUSULA -</b></div>
        <table width="100%">
            <tr>
                <td width="25%">
                    <p>KLAUSULA</p>
                </td>
                <td width="1%">
                    <p>:</p>
                </td>
                <td width="74%">
                    <p>-Clean Loss Record for the last (3 years) <br>
                        -Dispute Clause <br>
                        -Good Condition, maintenance and operation <br>
                        -KLAUSUL PENCURIAN DENGAN KEKERASAN <br>
                        -Klausul Pengesampingan <br>
                        -KLAUSUL PERLENGKAPAN TAMBAHAN <br>
                        -Subject to Tidak Disewakan <br>
                        -Warranty Payment Clause (30 days)
                    </p>
                </td>
            </tr>
            <tr>
                <td width="25%">
                    <p>RISIKO SENDIRI</p>
                </td>
                <td width="1%">
                    <p>:</p>
                </td>
                <td width="74%">
                    <p>Total Loss Only : 10 % of Claim minimum : IDR 1,000,000.00 untuk resiko selain kecelakaan diri</p>
                </td>
            </tr>
        </table><br><br>
        <div class="sub-title"><b>- PREMI -</b></div>
        <table width="100%">
            <tr>
                <td width="25%">
                    <p>PERHITUNGAN PREMI</p>
                </td>
                <td width="60%">
                    <p>:</p>
                </td>
                <td width="15%">
                </td>
            </tr>
            <tr>
                <td width="25%">
                    <p></p>
                </td>
                <td width="60%">
                    <p>Pesonal Accident : 0 x 0.22000% = 0.00</p>
                    <p>Paket Sepeda 1 : {{ number_format($polis->nilai_pertanggungan, 0, ',', '.') }} x 2.54000% = {{ number_format($polis->premi, 0, ',', '.') }}</p>
                    <p>Third Party Liability : 0 x 0.25000% = 0.00</p>
                    <p>{{ $polis->periode_asuransi }}</p>
                </td>
                <td width="15%">
                    <p>IDR {{ number_format($polis->premi, 0, ',', '.') }}</p>
                </td>
            </tr>
            <tr>
                <td width="25%">
                    <p></p>
                </td>
                <td width="60%">
                    <p><b>PREMIUM</b></p>
                </td>
                <td width="15%"><hr>
                    <p>IDR {{ number_format($polis->premi, 0, ',', '.') }}</p>
                </td>
            </tr>
            <tr>
                <td width="25%">
                    <p></p>
                </td>
                <td width="60%">
                    <p>Discount/Diskon (%)</p>
                    <p>Biaya Administrasi</p>
                </td>
                <td width="15%">
                    <p>IDR -0.00</p>
                    <p>IDR 20,000.00</p>
                </td>
            </tr>
            <tr>
                <td width="25%">
                    <p></p>
                </td>
                <td width="60%">
                    <p><b>TOTAL</b></p>
                </td>
                <td width="15%"><hr>
                    <p>IDR {{ number_format($pembayaran->total, 0, ',', '.') }}</p>
                </td>
            </tr>
        </table>

        <p>Dengan kesaksian yang bertandatangan dibawah ini yang diberi wewenang sepatutnya oleh Penanggung dan atas nama Penanggung telah membubuhkan tanda tangannya.</p>
    </div>

</body>
</html>

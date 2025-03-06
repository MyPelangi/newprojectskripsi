@extends('layouts.main')

@section('content')
<div class="container">
    <h1 class="produk-title"><b>KERANJANG</b></h1>
    <h4><b>Daftar Keranjang</b></h4>
    <br>
    <div class="register-step">
        <div class="section choose">
            <p>Draft</p>
        </div>
        <div class="section">
            <p>Menunggu Pembayaran</p>
        </div>
    </div>
    <br>
    <div class="keranjang-section">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col"></th>
                    <th scope="col">Nama</th>
                    <th scope="col">Paket</th>
                    <th scope="col">Premi</th>
                    <th scope="col">Tanggal Pengajuan</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pengajuans as $pengajuan)
                <tr class="clickable-row" data-href="{{ route('pengajuan.edit', ['id' => $pengajuan->id]) }}">
                    <th>
                        <div class="polis-items">
                            <img src="/img/logo_produk/sepeda.png" alt="" class="polis-icon">
                            <b class="polis-label">SEPEDA</b>
                        </div>
                    </th>
                    <td><b>{{ $pengajuan->nama }}</b></td>
                    <td>{{ $pengajuan->plan }}</td>
                    <td>Rp {{ number_format($pengajuan->premi, 0, ',', '.') }}</td>
                    <td>{{ \Carbon\Carbon::parse($pengajuan->tanggal_pengajuan)->format('d M Y') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="keranjang-section" style="display: none">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col"></th>
                    <th scope="col">Nama</th>
                    <th scope="col">Nomor Polis</th>
                    <th scope="col">Paket</th>
                    <th scope="col">Premi</th>
                    <th scope="col">Tanggal Pengajuan</th>
                    <th scope="col">Metode</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pembayarans as $pembayaran)
                <tr>
                    <th>
                        <div class="polis-items">
                            <img src="/img/logo_produk/sepeda.png" alt="" class="polis-icon">
                            <b class="polis-label">SEPEDA</b>
                        </div>
                    </th>
                    <td><b>{{ $pembayaran->nama }}</b></td>
                    <td>{{ $pembayaran->nomor_polis }}</td>
                    <td>{{ $pembayaran->plan }}</td>
                    <td>Rp {{ number_format($pembayaran->premi, 0, ',', '.') }}</td>
                    <td>{{ \Carbon\Carbon::parse($pembayaran->tanggal_pengajuan)->format('d M Y') }}</td>
                    <td>{{ $pembayaran->metode }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>
@endsection


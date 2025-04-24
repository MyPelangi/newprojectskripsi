@extends('layouts.main')

@section('content')
<div class="container">
    <h1 class="produk-title"><b>RIWAYAT PENGAJUAN</b></h1>
    <h4><b>Daftar Pengajuan</b></h4>
    <br>
    <div class="register-step">
        <div class="section choose">
            <p>Draft</p>
        </div>
        <div class="section">
            <p>Menunggu Persetujuan</p>
        </div>
        <div class="section">
            <p>Menunggu Pembayaran</p>
        </div>
    </div>
    <br>
    {{-- draft --}}
    <div class="keranjang-section">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col"></th>
                    <th scope="col">Nama</th>
                    <th scope="col">Paket</th>
                    <th scope="col">Premi</th>
                    <th scope="col">Tanggal Pengajuan</th>
                    <th scope="col">Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pengajuans as $pengajuan)
                <tr class="clickable-row" data-href="{{ route('pengajuan.edit', ['id' => $pengajuan->id]) }}">
                    <td>
                        <div class="polis-items">
                            <img src="/img/logo_produk/sepeda.png" alt="" class="polis-icon">
                            <b class="polis-label">SEPEDA</b>
                        </div>
                    </td>
                    <td><b class="draft-name">{{ $pengajuan->nama }}</b></td>
                    <td>{{ $pengajuan->plan }}</td>
                    <td>Rp {{ number_format($pengajuan->premi, 0, ',', '.') }}</td>
                    <td>{{ \Carbon\Carbon::parse($pengajuan->tanggal_pengajuan)->format('d M Y') }}</td>
                    <td>
                        @if ($pengajuan->status === 'pending_ocr')
                            <div class="status_pendingocr">
                                <span>25%</span>
                            </div>
                        @else
                            {{ $pengajuan->status }}
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    {{-- menunggu persetujuan --}}
    <div class="keranjang-section" style="display: none">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col"></th>
                    <th scope="col">Nama</th>
                    <th scope="col">No Referensi</th>
                    <th scope="col">Paket</th>
                    <th scope="col">Premi</th>
                    <th scope="col">Tanggal Pengajuan</th>
                    <th scope="col">Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($permohonan as $permohonans)
                <tr>
                    <th>
                        <div class="polis-items">
                            <img src="/img/logo_produk/sepeda.png" alt="" class="polis-icon">
                            <b class="polis-label">SEPEDA</b>
                        </div>
                    </th>
                    <td><b class="draft-name">{{ $permohonans->nama }}</b></td>
                    <td>{{ $permohonans->ref_penutupan }}</td>
                    <td>{{ $permohonans->paket }}</td>
                    <td>Rp {{ number_format($permohonans->premi, 0, ',', '.') }}</td>
                    <td>{{ \Carbon\Carbon::parse($permohonans->tanggal_pengajuan)->format('d M Y') }}</td>
                    <td><p class="status_permohonan">{{ $permohonans->status_permohonan }}</p></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    {{-- menunggu pembayaran --}}
    <div class="keranjang-section" style="display: none">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col"></th>
                    <th scope="col">Nama</th>
                    <th scope="col">No Referensi</th>
                    <th scope="col">Paket</th>
                    <th scope="col">Premi</th>
                    <th scope="col">Tanggal Pengajuan</th>
                    <th scope="col">Metode</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pembayarans as $pembayaran)
                <tr class="clickable-row" data-href="{{ route('pembayaran.show', ['id' => $pembayaran->id]) }}">
                    <th>
                        <div class="polis-items">
                            <img src="/img/logo_produk/sepeda.png" alt="" class="polis-icon">
                            <b class="polis-label">SEPEDA</b>
                        </div>
                    </th>
                    <td><b class="draft-name">{{ $pembayaran->nama }}</b></td>
                    <td>{{ $pembayaran->ref_penutupan }}</td>
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


@extends('layouts.main')

@section('content')
<div class="container">
    <h1 class="produk-title"><b>POLIS<span> ASURANSI</span></b></h1>
    <h4><b>Daftar Polis</b></h4>
    <br>
    <div class="register-step">
        <div class="section choose">
            <p>Aktif</p>
        </div>
        <div class="section">
            <p>Segera Berakhir</p>
        </div>
        <div class="section">
            <p>Tidak Aktif</p>
        </div>
    </div>
    <br>
    <div class="polis-section">
        <table class="table">
            <thead>
            <tr>
                <th scope="col"></th>
                <th scope="col">Nomor Polis</th>
                <th scope="col">Paket</th>
                <th scope="col">Premi</th>
                <th scope="col">Tanggal Berlaku</th>
                <th scope="col">Tanggal Berakhir</th>
                <th scope="col">Status</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <th>
                    <div class="polis-items">
                        <img src="/img/logo_produk/sepeda.png" alt="" class="polis-icon">
                        <b class="polis-label">SEPEDA</b>
                    </div>
                </th>
                <td>Mark</td>
                <td>Otto</td>
                <td>@mdo</td>
                <td>@mdo</td>
                <td>@mdo</td>
                <td>Aktif</td>
            </tr>
            </tbody>
        </table>
    </div>
    <div class="polis-section" style="display: none">
        <table class="table">
            <thead>
            <tr>
                <th scope="col"></th>
                <th scope="col">Nomor Polis</th>
                <th scope="col">Paket</th>
                <th scope="col">Premi</th>
                <th scope="col">Tanggal Berlaku</th>
                <th scope="col">Tanggal Berakhir</th>
                <th scope="col">Status</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <th>
                    <div class="polis-items">
                        <img src="/img/logo_produk/sepeda.png" alt="" class="polis-icon">
                        <b class="polis-label">SEPEDA</b>
                    </div>
                </th>
                <td>Mark</td>
                <td>Otto</td>
                <td>@mdo</td>
                <td>@mdo</td>
                <td>@mdo</td>
                <td>Segera Berakhir</td>
            </tr>
            </tbody>
        </table>
    </div>
    <div class="polis-section" style="display: none">
        <table class="table">
            <thead>
            <tr>
                <th scope="col"></th>
                <th scope="col">Nomor Polis</th>
                <th scope="col">Paket</th>
                <th scope="col">Premi</th>
                <th scope="col">Tanggal Berlaku</th>
                <th scope="col">Tanggal Berakhir</th>
                <th scope="col">Status</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <th>
                    <div class="polis-items">
                        <img src="/img/logo_produk/sepeda.png" alt="" class="polis-icon">
                        <b class="polis-label">SEPEDA</b>
                    </div>
                </th>
                <td>Mark</td>
                <td>Otto</td>
                <td>@mdo</td>
                <td>@mdo</td>
                <td>@mdo</td>
                <td>Tidak Aktif</td>
            </tr>
            </tbody>
        </table>
    </div>

</div>
@endsection


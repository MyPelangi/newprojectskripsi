@extends('layouts.main')

@section('content')
<div class="register-container">
    <div class="register">
        <img style="width: 250px" src="img/logobrins.png" alt="">
        <div class="login-title">
            <h3>REGISTER</h3>
        </div>
        <br>
        <form action="/register/createAccount" method="POST">
            @csrf
            <div class="register-step">
                <div class="section choose">
                    <p>Indentitas Diri</p>
                </div>
                <div class="section">
                    <p>kontak</p>
                </div>
            </div>
            <div class="register-section">
                <div class="card-content-split">
                    <div class="input-text">
                        <label>Nama</label>
                        <input class="form-control" type="text" id="nama" name="nama" required>
                    </div>
                    <div class="input-text">
                        <label>Nama Ibu Kandung</label>
                        <input class="form-control" type="text" id="nama_ibu" name="nama_ibu" required>
                    </div>
                    <div class="input-text">
                        <label>Gender</label>
                        <div class="form-check">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gender" id="laki-laki" value="Laki-laki">
                                <label class="form-check-label" for="Laki-laki">Laki-laki</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gender" id="perempuan" value="Perempuan">
                                <label class="form-check-label" for="Perempuan">Perempuan</label>
                            </div>
                        </div>
                    </div>
                    <div class="input-text">
                        <label>Pekerjaan</label>
                        <input class="form-control" type="text" id="pekerjaan" name="pekerjaan" required>
                    </div>
                    <div class="input-text">
                        <label>Tempat lahir</label>
                        <input class="form-control" type="text" id="tempat_lahir" name="tempat_lahir" required>
                    </div>
                    <div class="input-text">
                        <label>Sumber pendapatan</label>
                        <select id="sumber_pendapatan" name="sumber_pendapatan" class="text-box">
                            <option value="">Pilih sumber pendapatan anda</option>
                            <option value="Gaji">Gaji</option>
                            <option value="Usaha">Usaha</option>
                            <option value="Investasi">Investasi</option>
                            <option value="Lainnya">Lainnya</option>
                        </select>
                    </div>
                    <div class="input-text">
                        <label>Tanggal lahir</label>
                        <input class="form-control" type="date" id="tgl_lahir" name="tgl_lahir" required>
                    </div>
                    <div class="input-text">
                        <label>Rata-rata pendapatan per tahun</label>
                        <input class="form-control" type="text" id="pendapatan_tahunan" name="pendapatan_tahunan" required>
                    </div>
                    <div class="input-text">
                        <label>Nomor KTP</label>
                        <input class="form-control" type="text" id="no_ktp" name="no_ktp" required>
                    </div>
                    <div class="input-text">
                        <label>Tujuan/hubungan bisnis</label>
                        <input class="form-control" type="text" id="tujuan" name="tujuan" required>
                    </div>
                    <div class="input-text">
                        <label>Kewarganegaraan</label>
                        <div class="form-check">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="kewarganegaraan" id="wni" value="WNI">
                                <label class="form-check-label" for="wni">WNI</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="kewarganegaraan" id="wna" value="WNA">
                                <label class="form-check-label" for="wna">WNA</label>
                            </div>
                        </div>
                    </div>
                    <div class="input-text">
                        <label>Nama penerima manfaat</label>
                        <input class="form-control" type="text" id="nama_penerima" name="nama_penerima" required>
                    </div>
                    <div class="input-text">
                        <label>Status menikah</label>
                        <select id="status_menikah" name="status_menikah" class="text-box">
                            <option value="">Pilih status menikah anda</option>
                            <option value="Belum Menikah">Belum Menikah</option>
                            <option value="Menikah">Menikah</option>
                            <option value="Cerai">Cerai</option>
                        </select>
                    </div>
                    <div class="input-text">
                        <label>Kantor cabang terdekat</label>
                        <input class="form-control" type="text" id="kantor_cabang" name="kantor_cabang" required>
                    </div>
                </div>
            </div>
            <div class="register-section" style="display: none;">
                <div class="card-content-split">
                    <div class="input-text">
                        <label>Email</label>
                        <input class="form-control" type="text" id="email" name="email" required>
                    </div>
                    <div class="input-text">
                        <label>Kota</label>
                        <input class="form-control" type="text" id="kota" name="kota" required>
                    </div>
                    <div class="input-text">
                        <label>Password</label>
                        <input class="form-control" type="password" id="password" name="password" required>
                    </div>
                    <div class="input-text">
                        <label>Kecamatan/kelurahan</label>
                        <input class="form-control" type="text" id="kecamatan_kelurahan" name="kecamatan_kelurahan" required>
                    </div>
                    <div class="input-text">
                        <label>Nomor telepon</label>
                        <input class="form-control" type="text" id="no_telp" name="no_telp" required>
                    </div>
                    <div class="input-text">
                        <label>Alamat lengkap</label>
                        <input class="form-control" type="text" id="alamat_lengkap" name="alamat_lengkap" required>
                    </div>
                    <div class="input-text">
                        <label>Kode pos</label>
                        <input class="form-control" type="text" id="kode_pos" name="kode_pos" required>
                    </div>
                    <div class="input-text">
                        <label>Alamat kantor</label>
                        <input class="form-control" type="text" id="alamat_kantor" name="alamat_kantor" required>
                    </div>
                    <div class="input-text">
                        <label>Provinsi</label>
                        <input class="form-control" type="text" id="provinsi" name="provinsi" required>
                    </div>
                    <div class="input-text">
                        <label>Nomor telepon kantor</label>
                        <input class="form-control" type="text" id="no_telp_kantor" name="no_telp_kantor" required>
                    </div>
                </div>
                <div class="mb-3">
                <button type="submit" class="btn upload-button w-100">Register</button>
                </div>
            </div>
        </form>
        <p class="sudahpunyaakun">Sudah punya akun?<a href="/"> Login</a></p>
    </div>
</div>
@endsection

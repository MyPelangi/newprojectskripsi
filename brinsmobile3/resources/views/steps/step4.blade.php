<div class="form-section" id="step-4">
    <h5 class="card-title">Informasi Objek</h5>
    <p class="card-text">Lengkapi kolom dibawah ini.</p>
    <div class="card-content-split">
        <div class="input-text">
            <label>Merek Sepeda*</label>
            <input class="text-box" type="text" id="mereksepeda" name="merek_sepeda" value="{{ $pengajuan->merek_sepeda ?? '' }}" required>
        </div>
        <div class="input-text">
            <label>Warna Sepeda*</label>
            <input class="text-box" type="text" id="warnasepeda" name="warna_sepeda" value="{{ $pengajuan->warna_sepeda ?? '' }}" required>
        </div>
        <div class="input-text">
            <label>Tipe Sepeda*</label>
            @if(isset($tipesepeda) && count($tipesepeda) > 0)
                <select id="tipesepeda" name="tipe_sepeda" value="{{ $pengajuan->tipe_sepeda ?? '' }}" class="text-box">
                    <option value="">Pilih tipe sepeda anda</option>
                    @foreach ($tipesepeda as $tipe)
                        <option value="{{ $tipe->id }}" {{ old('tipe_sepeda') == $tipe->id ? 'selected' : '' }}>
                            {{ $tipe->tipe_sepeda }}
                        </option>
                    @endforeach
                </select>
            @else
                <p>Tipe sepeda tidak tersedia.</p>
            @endif
        </div>
        <div class="input-text">
            <label>Nomor Rangka Sepeda*</label>
            <input class="text-box" type="text" id="rangkasepeda" name="no_rangka_sepeda" value="{{ $pengajuan->no_rangka_sepeda ?? '' }}" required>
        </div>
        <div class="input-text">
            <label>Model Sepeda*</label>
            <input class="text-box" type="text" id="modelsepeda" name="model_sepeda" value="{{ $pengajuan->model_sepeda ?? '' }}" required>
        </div>
        <div class="input-text">
            <label>Tahun Produksi Sepeda*</label>
            <select id="tahunproduksi" name="tahun_produksi" value="{{ $pengajuan->tahun_produksi ?? '' }}" class="text-box">
                <option value="">Pilih tahun produksi sepeda anda</option>
                <option value="2025">2025</option>
                <option value="2024">2024</option>
                <option value="2023">2023</option>
            </select>
        </div>
        <div class="input-text">
            <label>Seri Sepeda*</label>
            <input class="text-box" type="text" id="serisepeda" name="seri_sepeda" value="{{ $pengajuan->seri_sepeda ?? '' }}" required>
        </div>
        <div class="input-text">
            <label>Nomor Invoice Pembelian*</label>
            <input class="text-box" type="text" id="no_invoice_pembelian" name="no_invoice_pembelian" value="{{ $pengajuan->no_invoice_pembelian ?? '' }}" required>
        </div>
    </div>
    <button type="button" id="submit-data" class="btn upload-button" onclick="nextStep()">Lanjutkan</button>
</div>

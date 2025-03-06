<div class="form-section" id="step-2">
    <h5 class="card-title">Kode Promo</h5>
    <p class="card-text">Lengkapi kolom dibawah ini.</p>
    <div class="input-text">
        <label>Kode Promo</label>
        <input class="text-box" type="text" id="kodepromo" name="kode_promo" value="{{ $pengajuan->kode_promo ?? '' }}">
        <p class="card-text">*Catatan: kosongkan jika ingin melewati.</p>
    </div>
    <button type="button" class="btn upload-button" onclick="nextStep()">Verifikasi</button>
</div>


<div class="form-section" id="step-1">
    <h5 class="card-title">Nilai Pertanggungan</h5>
    <p class="card-text">Lengkapi kolom dibawah ini.</p>
    <div class="input-text">
        <input type="hidden" id="id_pengajuan" value="">
        <label>Harga Sepeda*</label>
        <div class="input-container">
            <p class="rp">Rp</p>
            <input class="text-box" type="text" id="hargasepeda" name="harga_sepeda" value="{{ $pengajuan->harga_sepeda ?? '' }}" required>
        </div>
    </div>
    <button type="button" class="btn upload-button" onclick="nextStep()">Lanjutkan</button>
</div>



<div class="form-section" id="step-5">
    <h5 class="card-title">Dokumen Pendukung</h5>
    <p class="card-text">Lampirkan foto yang diperlukan.</p>
    <div class="card-content-split">
        <div class="image-upload">
            <label>KTP* <span id="status-ktp" class="badge"></span></label>
            <div class="upload-box">
                <input type="file" accept="image/*" id="ktp" name="images[ktp]" required>
                <img id="preview-ktp" alt="Preview" style="display:none;">
                <span>Unggah Gambar</span>
            </div>
        </div>
        <div class="image-upload">
            <label>Invoice Pembelian* <span id="status-invoice" class="badge"></span></label>
            <div class="upload-box">
                <input type="file" accept="image/*" id="invoice" name="images[invoice]" required>
                <img id="preview-invoice" alt="Preview" style="display:none;">
                <span>Unggah Gambar</span>
            </div>
        </div>
        <div class="image-upload">
            <label>Tampak Depan* <span id="result-tampak_depan" class="badge"></span></label>
            <div class="upload-box">
                <input type="file" accept="image/*" id="depan" name="images[depan]" required>
                <img id="preview-depan" alt="Preview" style="display:none;">
                <span>Unggah Gambar</span>
            </div>
        </div>
        <div class="image-upload">
            <label>Tampak Kiri* <span id="result-tampak_kiri" class="badge"></span></label>
            <div class="upload-box">
                <input type="file" accept="image/*" id="kiri" name="images[kiri]" required>
                <img id="preview-kiri" alt="Preview" style="display:none;">
                <span>Unggah Gambar</span>
            </div>
        </div>
        <div class="image-upload">
            <label>Tampak Kanan* <span id="result-tampak_kanan" class="badge"></span></label>
            <div class="upload-box">
                <input type="file" accept="image/*" id="kanan" name="images[kanan]" required>
                <img id="preview-kanan" alt="Preview" style="display:none;">
                <span>Unggah Gambar</span>
            </div>
        </div>
        <div class="image-upload">
            <label>Tampak Belakang* <span id="result-tampak_belakang" class="badge"></span></label>
            <div class="upload-box">
                <input type="file" accept="image/*" id="belakang" name="images[belakang]" required>
                <img id="preview-belakang" alt="Preview" style="display:none;">
                <span>Unggah Gambar</span>
            </div>
        </div>
        <div id="loading" style="display: none;">
            <p>Predicting... Please wait</p>
            <img src="/img/loading2.gif" alt="Loading" />
        </div>
    </div>
    <button type="button" id="submit-form" class="btn upload-button" onclick="nextStep()">Lanjutkan</button>

    <h3>Prediction Results:</h3>
    <pre id="result"></pre>
</div>

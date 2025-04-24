<div class="form-section" id="step-5">
    <h5 class="card-title">Dokumen Pendukung</h5>
    <p class="card-text">Lampirkan foto yang diperlukan.</p>
    <div class="card-content-split">
        <div class="image-upload">
            <label>KTP* <span id="status-ktp" class="badge"></span></label>
            <div class="upload-box">
                <input type="file" accept="image/*" id="ktp" name="images[ktp]" required>
                {{-- <div class="image-container"> --}}
                    <img id="preview-ktp" alt="Preview" style="display:none;">
                    <img id="loading-ktp" src="/img/loading2.gif" alt="Loading" class="loading-spinner" style="display:none;">
                {{-- </div> --}}
                <span>Unggah Gambar</span>
            </div>
        </div>
        <div class="image-upload">
            <label>Invoice Pembelian* <span id="status-invoice" class="badge"></span></label>
            <div class="upload-box">
                <input type="file" accept="image/*" id="invoice" name="images[invoice]" required>
                {{-- <div class="image-container"> --}}
                    <img id="preview-invoice" alt="Preview" style="display:none;">
                    <img id="loading-invoice" src="/img/loading2.gif" alt="Loading" class="loading-spinner" style="display:none;">
                {{-- </div> --}}
                <span>Unggah Gambar</span>
            </div>
        </div>
        <div class="image-upload">
            <label>Tampak Depan* <span id="result-tampak_depan" class="badge"></span></label>
            <div class="upload-box">
                <input type="file" accept="image/*" id="depan" name="images[depan]" required>
                {{-- <div class="image-container"> --}}
                    <img id="preview-depan" alt="Preview" style="display:none;">
                    <img id="loading-tampak_depan" src="/img/loading2.gif" alt="Loading" class="loading-spinner" style="display:none;">
                {{-- </div> --}}
                <span>Unggah Gambar</span>
            </div>
        </div>
        <div class="image-upload">
            <label>Tampak Kiri* <span id="result-tampak_kiri" class="badge"></span></label>
            <div class="upload-box">
                <input type="file" accept="image/*" id="kiri" name="images[kiri]" required>
                {{-- <div class="image-container"> --}}
                    <img id="preview-kiri" alt="Preview" style="display:none;">
                    <img id="loading-tampak_kiri" src="/img/loading2.gif" alt="Loading" class="loading-spinner" style="display:none;">
                {{-- </div> --}}
                <span>Unggah Gambar</span>
            </div>
        </div>
        <div class="image-upload">
            <label>Tampak Kanan* <span id="result-tampak_kanan" class="badge"></span></label>
            <div class="upload-box">
                <input type="file" accept="image/*" id="kanan" name="images[kanan]" required>
                {{-- <div class="image-container"> --}}
                    <img id="preview-kanan" alt="Preview" style="display:none;">
                    <img id="loading-tampak_kanan" src="/img/loading2.gif" alt="Loading" class="loading-spinner" style="display:none;">
                {{-- </div> --}}
                <span>Unggah Gambar</span>
            </div>
        </div>
        <div class="image-upload">
            <label>Tampak Belakang* <span id="result-tampak_belakang" class="badge"></span></label>
            <div class="upload-box">
                <input type="file" accept="image/*" id="belakang" name="images[belakang]" required>
                {{-- <div class="image-container"> --}}
                    <img id="preview-belakang" alt="Preview" style="display:none;">
                    <img id="loading-tampak_belakang" src="/img/loading2.gif" alt="Loading" class="loading-spinner" style="display:none;">
                {{-- </div> --}}
                <span>Unggah Gambar</span>
            </div>
        </div>
    </div>
    <button type="button" id="submit-form" class="btn upload-button" onclick="nextStep()">Lanjutkan</button>
</div>

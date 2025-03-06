<div class="form-section" id="step-3">
    <div class="card-content-split">
        <div class="deskripsi-paket">
            <h5 class="card-title">Deskripsi</h5>
            <p class="card-text">BRINS Sepeda adalah perlindungan yang memberikan ganti rugi kepada tertanggung terhadap kerugian atas dan/atau kerusakan pada sepeda dan/atau kepentingan yang dipertanggungkan.</p>
        </div>
        <div class="plan-options">
            <div class="plan" onclick="selectPlan(this, 'Silver')">
                <img class="image-plan" src="/img/silverpackage.png" alt="">
                <p><b>Silver</b></p>
            </div>
            <div class="plan" onclick="selectPlan(this, 'Gold')">
                <img class="image-plan" src="/img/goldpackage.png" alt="">
                <p><b>Gold</b></p>
            </div>
            <div class="plan" onclick="selectPlan(this, 'Platinum')">
                <img class="image-plan" src="/img/platinumpackage.png" alt="">
                <p><b>Platinum</b></p>
            </div>
        </div>
    </div>

    <!-- Hidden Inputs -->
    <input type="hidden" id="planInput" name="plan" value="{{ $pengajuan->plan ?? '' }}">
    <input type="hidden" id="premiInput" name="premi" value="{{ $pengajuan->premi ?? '' }}">
    <input type="hidden" id="totalInput" name="total" value="{{ $pengajuan->total ?? '' }}">

    <div class="card little-card">
        <div class="little-card-split">
            <div class="risks" id="risks"></div>
            <div class="vl"></div>
            <div class="coverages" id="coverages"></div>
        </div>
    </div>

    <h5 class="card-title">Nilai Pertanggungan</h5>
    <div class="card-content-split">
        <div class="price-section">
            <div class="detail-container">
                <p>Premi</p>
                <p id="premi">></p>
            </div>
            <div class="detail-container">
                <p>Biaya Administrasi</p>
                <p><b>Rp 20.000</b></p>
            </div>
        </div>
        <div class="price-section">
            <p>Total</p>
            <h5 class="price" id="total"></h5>
        </div>
    </div>
    <button type="button" class="btn upload-button" onclick="prepareDataAndNextStep()">Verifikasi</button>
</div>

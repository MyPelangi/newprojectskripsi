document.addEventListener("DOMContentLoaded", function () {
    $(document).on("click", ".passwordshow", function () {
        const input = $(this).siblings(".form-control").length
            ? $(this).siblings(".form-control")
            : $("#password");
        const type = input.attr("type") === "password" ? "text" : "password";
        input.attr("type", type);
        $(this).toggleClass('fa-eye fa-eye-slash');
    });
});

document.addEventListener("DOMContentLoaded", function () {
    const sections = document.querySelectorAll(".register-section");
    const steps = document.querySelectorAll(".register-step .section");

    // Menyembunyikan semua section kecuali yang pertama
    sections.forEach((section, index) => {
        if (index !== 0) section.style.display = "none";
    });

    steps.forEach((step, index) => {
        step.addEventListener("click", function () {
            // Hapus class choose dari semua steps
            steps.forEach(s => s.classList.remove("choose"));
            // Tambahkan class choose ke step yang diklik
            step.classList.add("choose");

            // Sembunyikan semua register-section
            sections.forEach(section => section.style.display = "none");
            // Tampilkan section yang sesuai
            sections[index].style.display = "block";
        });
    });
});

document.addEventListener("DOMContentLoaded", function () {
    const sections = document.querySelectorAll(".polis-section");
    const steps = document.querySelectorAll(".register-step .section");

    // Menyembunyikan semua section kecuali yang pertama
    sections.forEach((section, index) => {
        if (index !== 0) section.style.display = "none";
    });

    steps.forEach((step, index) => {
        step.addEventListener("click", function () {
            // Hapus class choose dari semua steps
            steps.forEach(s => s.classList.remove("choose"));
            // Tambahkan class choose ke step yang diklik
            step.classList.add("choose");

            // Sembunyikan semua register-section
            sections.forEach(section => section.style.display = "none");
            // Tampilkan section yang sesuai
            sections[index].style.display = "block";
        });
    });
});

document.addEventListener("DOMContentLoaded", function () {
    const sections = document.querySelectorAll(".keranjang-section");
    const steps = document.querySelectorAll(".register-step .section");

    // Menyembunyikan semua section kecuali yang pertama
    sections.forEach((section, index) => {
        if (index !== 0) section.style.display = "none";
    });

    steps.forEach((step, index) => {
        step.addEventListener("click", function () {
            // Hapus class choose dari semua steps
            steps.forEach(s => s.classList.remove("choose"));
            // Tambahkan class choose ke step yang diklik
            step.classList.add("choose");

            // Sembunyikan semua register-section
            sections.forEach(section => section.style.display = "none");
            // Tampilkan section yang sesuai
            sections[index].style.display = "block";
        });
    });
});

document.addEventListener("DOMContentLoaded", function () {
    let button = document.querySelector(".showtransaksi");
    let detailDiv = document.getElementById("showdetail");

    if (!button || !detailDiv) {
        console.error("Elemen tombol atau detail transaksi tidak ditemukan!");
        return;
    }

    // Pastikan detail transaksi tersembunyi saat halaman dimuat
    detailDiv.style.display = "none";

    button.addEventListener("click", function () {
        if (detailDiv.style.display === "none") {
            detailDiv.style.display = "block";
            button.innerText = "Tutup Detail Transaksi <<";
        } else {
            detailDiv.style.display = "none";
            button.innerText = "Lihat Detail Transaksi >>";
        }
    });
});

document.addEventListener("DOMContentLoaded", function () {

    let selectedMethod = null;

    document.querySelectorAll(".metode").forEach(item => {
        item.addEventListener("click", function () {
            selectedMethod = this.getAttribute("data-method");

            document.querySelectorAll('.metode').forEach(el => el.classList.remove("pilih"));
            this.classList.add("pilih");
        });
    });

    let btnLanjutkan = document.getElementById("btn-lanjutkan");
    if (btnLanjutkan) {
        btnLanjutkan.addEventListener("click", function () {
            if (!selectedMethod) {
                alert("Silakan pilih metode pembayaran terlebih dahulu!");
                return;
            }

            fetch("/prosesCheckout", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({ metode_pembayaran: selectedMethod })
            })
            .then(response => response.json())
            .then(data => {
                window.location.href = `/pembayaran/${data.id}`;
            })
            .catch(error => console.error("Error:", error));
        });
    }

});


document.addEventListener("DOMContentLoaded", function () {
    let currentStep = 1;

    function updateStepIndicator(step) {
        const steps = document.querySelectorAll(".step");

        steps.forEach((stepElement, index) => {
            if (index + 1 < step) {
                stepElement.classList.add("active"); // Step sebelumnya menjadi active
                stepElement.classList.remove("current");
            } else if (index + 1 === step) {
                stepElement.classList.add("current"); // Step yang sedang dikerjakan
                stepElement.classList.remove("active");
            } else {
                stepElement.classList.remove("active", "current"); // Reset step lainnya
            }
        });
    }

    window.nextStep = function () {
        const totalSteps = document.querySelectorAll(".step").length;

        if (validateCurrentStep() && currentStep < totalSteps) {
            goToStep(currentStep + 1);  // Pindah ke step berikutnya
        }
    };

    window.prepareDataAndNextStep = function () {
        document.getElementById('premiInput').value = document.getElementById('premi').innerText.replace('Rp ', '').replace('.', '');
        document.getElementById('totalInput').value = document.getElementById('total').innerText.replace('Rp ', '').replace('.', '');

        nextStep();
    };

    function goToStep(step) {
        let currentElement = document.getElementById(`step-${currentStep}`);
        let targetElement = document.getElementById(`step-${step}`);

        if (currentElement && targetElement) {
            // Sembunyikan step sebelumnya
            currentElement.style.display = 'none';

            // Perbarui currentStep sebelum menampilkan step baru
            currentStep = step;

            // Tampilkan step baru
            targetElement.style.display = 'block';

            // Update step indicator
            updateStepIndicator(currentStep);
        } else {
            console.error("Step not found");
        }
    }

    function validateCurrentStep() {
        let currentElement = document.getElementById(`step-${currentStep}`);
        let inputs = currentElement.querySelectorAll("input[required], select[required], textarea[required]");

        let isValid = true;

        inputs.forEach(input => {
            if (!input.value.trim()) {
                isValid = false;
                input.classList.add("is-invalid"); // Tambahkan class invalid jika kosong
            } else {
                input.classList.remove("is-invalid");
            }
        });

        if (!isValid) {
            alert("Harap isi semua field yang diperlukan sebelum melanjutkan.");
        }

        return isValid;
    }

    // Event listener agar bisa klik step secara manual
    document.querySelectorAll('.step').forEach(step => {
        step.addEventListener('click', function () {
            let stepNumber = parseInt(this.getAttribute('data-step'));

            if (stepNumber > currentStep && !validateCurrentStep()) {
                return; // Tidak lanjut jika step sekarang belum valid
            }

            goToStep(stepNumber);
        });
    });

    // Set tampilan awal hanya step pertama yang muncul
    document.querySelectorAll(".form-section").forEach((section, index) => {
        section.style.display = index === 0 ? "block" : "none";
    });
});


document.addEventListener("DOMContentLoaded", function () {
    const rows = document.querySelectorAll(".clickable-row");
    rows.forEach(row => {
        row.addEventListener("click", function () {
            window.location.href = this.dataset.href;
        });
    });
});

async function loadData(idPengajuan) {
    try {
        let response = await fetch(`/getPengajuan/${idPengajuan}`);
        let data = await response.json();

        if (data) {
            document.getElementById("hargasepeda").value = data.harga_sepeda;
            document.getElementById("kodepromo").value = data.kode_promo;
            document.getElementById("planInput").value = data.plan;
            document.getElementById("premiInput").value = data.premi;
            document.getElementById("totalInput").value = data.total;
            document.getElementById("mereksepeda").value = data.merek_sepeda;
            document.getElementById("warnasepeda").value = data.warna_sepeda;
            document.getElementById("tipesepeda").value = data.tipe_sepeda;
            document.getElementById("rangkasepeda").value = data.no_rangka_sepeda;
            document.getElementById("modelsepeda").value = data.model_sepeda;
            document.getElementById("tahunproduksi").value = data.tahun_produksi;
            document.getElementById("serisepeda").value = data.seri_sepeda;
            document.getElementById("no_invoice_pembelian").value = data.no_invoice_pembelian;
        }
    } catch (error) {
        console.error("Gagal mengambil data:", error);
    }
}

// Panggil fungsi saat halaman dimuat
document.addEventListener("DOMContentLoaded", function () {
    let idPengajuan = document.getElementById("id_pengajuan").value;
    if (idPengajuan) {
        loadData(idPengajuan);
    }
});


document.addEventListener("DOMContentLoaded", function () {
    const plans = {
        Silver: {
            risks: ['✔ Kerugian total', '✔ Pencurian dengan kekerasan', '✘ Bencana alam', '✘ Kerusuhan dan huru hara', '✘ Terorisme dan sabotase'],
            coverages: ['✔ Jaminan Total Loss Only (TLO)', '100% dari nilai pertanggungan', '✔ Pencurian dengan kekerasan', '100% dari nilai pertanggungan'],
        },
        Gold: {
            risks: ['✔ Kerugian total', '✔ Pencurian dengan kekerasan', '✔ Bencana alam', '✘ Kerusuhan dan huru hara', '✘ Terorisme dan sabotase'],
            coverages: ['✔ Jaminan Total Loss Only (TLO)', '100% dari nilai pertanggungan', '✔ Pencurian dengan kekerasan', '100% dari nilai pertanggungan', '✔ Bencana alam', '100% dari nilai pertanggungan'],
        },
        Platinum: {
            risks: ['✔ Kerugian total', '✔ Pencurian dengan kekerasan', '✔ Bencana alam', '✔ Kerusuhan dan huru hara', '✔ Terorisme dan sabotase'],
            coverages: ['✔ Jaminan Total Loss Only (TLO)', '100% dari nilai pertanggungan', '✔ Pencurian dengan kekerasan', '100% dari nilai pertanggungan', '✔ Bencana alam', '100% dari nilai pertanggungan', '✔ Kerusuhan dan huru hara', '100% dari nilai pertanggungan', '✔ Terorisme dan sabotase', '100% dari nilai pertanggungan'],
        }
    };

    window.selectPlan = async function (element, plan) {
        // Hapus class 'active' dari semua plan
        document.querySelectorAll('.plan').forEach(el => el.classList.remove('active'));
        element.classList.add('active');

        // Update input hidden plan (jika ada)
        let planInput = document.getElementById('planInput');
        if (planInput) {
            planInput.value = plan;
        }

        // Ambil nilai harga sepeda dari input
        let hargaSepedaInput = document.getElementById('hargasepeda');
        let hargaSepeda = hargaSepedaInput ? parseFloat(hargaSepedaInput.value) || 0 : 0;

        // Perbarui UI dan hitung premi dari backend
        updateRisks(plan);
        if (hargaSepeda > 0) {
            await hitungPremiBackend(hargaSepeda, plan);
        } else {
            console.warn("Harga sepeda belum diisi atau tidak valid.");
        }
    };

    function updateRisks(plan) {
        const risksDiv = document.getElementById('risks');
        risksDiv.innerHTML = `<ul>${plans[plan].risks.map(risk => `<li>${risk}</li>`).join('')}</ul>`;

        const coveragesDiv = document.getElementById('coverages');
        coveragesDiv.innerHTML = `<ul>${plans[plan].coverages.map(coverage => `<li>${coverage}</li>`).join('')}</ul>`;

        // Kosongkan premi sebelum dihitung ulang dari backend
        document.getElementById('premi').innerHTML = `<b>Rp -</b>`;
        document.getElementById('total').innerHTML = `<b>Rp -</b>`;
    }

    async function hitungPremiBackend(hargaSepeda, plan) {
        try {
            let response = await fetch('/hitung-premi', {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({
                    harga_sepeda: hargaSepeda,
                    plan: plan // Sesuaikan dengan format di Laravel
                })
            });

            let data = await response.json();

            // Update UI dengan hasil dari backend
            document.getElementById('premi').innerHTML = `<b>Rp ${data.premi.toLocaleString('id-ID')}</b>`;
            document.getElementById('total').innerHTML = `<b>Rp ${(data.premi + 20000).toLocaleString('id-ID')}</b>`;

        } catch (error) {
            console.error("Error fetching premi:", error);
        }
    }

    // Set default ke paket Silver saat halaman dimuat
    updateRisks('Silver');

});


function setupImagePreview(inputId, previewId) {
    const inputElement = document.getElementById(inputId);
    const previewImage = document.getElementById(previewId);
    const uploadSpan = inputElement.closest(".upload-box").querySelector("span");
    const allowedExtensions = ['jpg', 'jpeg', 'png'];

    inputElement.addEventListener("change", (event) => {
        const file = event.target.files[0];
        if (file) {
            const fileExtension = file.name.split('.').pop().toLowerCase();
            if (!allowedExtensions.includes(fileExtension)) {
                alert('Only JPG, JPEG, or PNG files are allowed.');
                inputElement.value = ''; // Reset file input
                return;
            }

            const reader = new FileReader();
            reader.onload = (e) => {
                previewImage.src = e.target.result;
                previewImage.style.display = "block";
                uploadSpan.style.display = "none";
            };
            reader.readAsDataURL(file);
        }
    });
}


// Initialize image previews for all input-preview pairs
const imageInputs = [
    { inputId: "ktp", previewId: "preview-ktp" },
    { inputId: "invoice", previewId: "preview-invoice" },
    { inputId: "depan", previewId: "preview-depan" },
    { inputId: "kiri", previewId: "preview-kiri" },
    { inputId: "kanan", previewId: "preview-kanan" },
    { inputId: "belakang", previewId: "preview-belakang" },
];

imageInputs.forEach(({ inputId, previewId }) => {
    setupImagePreview(inputId, previewId);
});

document.addEventListener("DOMContentLoaded", function () {
    let idPengajuan = null; // Simpan ID pengajuan setelah dibuat pertama kali

    const images = {
        "tampak_depan": "depan",
        "tampak_kiri": "kiri",
        "tampak_kanan": "kanan",
        "tampak_belakang": "belakang"
    };

    let validationResults = {
        "tampak_depan": false,
        "tampak_kiri": false,
        "tampak_kanan": false,
        "tampak_belakang": false
    };

    // step 4
    document.getElementById("submit-data").addEventListener("click", function () {
        buatPengajuan();
    });

    function buatPengajuan() {
        let idPengajuanElement = document.getElementById("id_pengajuan");
        let idPengajuan = idPengajuanElement ? idPengajuanElement.value : localStorage.getItem("id_pengajuan") || "";

        let hargaSepeda = document.getElementById("hargasepeda")?.value || "";
        let kodePromo = document.getElementById("kodepromo")?.value || "";
        let plan = document.getElementById("planInput")?.value || "";
        let premi = document.getElementById("premiInput")?.value || "";
        let total = document.getElementById("totalInput")?.value || "";
        let mereksepeda = document.getElementById("mereksepeda")?.value || "";
        let warnaSepeda = document.getElementById("warnasepeda")?.value || "";
        let tipeSepeda = document.getElementById("tipesepeda")?.value || "";
        let noRangkaSepeda = document.getElementById("rangkasepeda")?.value || "";
        let modelSepeda = document.getElementById("modelsepeda")?.value || "";
        let tahunProduksi = document.getElementById("tahunproduksi")?.value || "";
        let seriSepeda = document.getElementById("serisepeda")?.value || "";
        let noInvoicePembelian = document.getElementById("no_invoice_pembelian")?.value || "";

        let formData = new FormData();
        formData.append("harga_sepeda", hargaSepeda);
        formData.append("kode_promo", kodePromo);
        formData.append("plan", plan);
        formData.append("premi", premi);
        formData.append("total", total);
        formData.append("merek_sepeda", mereksepeda);
        formData.append("warna_sepeda", warnaSepeda);
        formData.append("tipe_sepeda", tipeSepeda);
        formData.append("no_rangka_sepeda", noRangkaSepeda);
        formData.append("model_sepeda", modelSepeda);
        formData.append("tahun_produksi", tahunProduksi);
        formData.append("seri_sepeda", seriSepeda);
        formData.append("no_invoice_pembelian", noInvoicePembelian);

        // **Cek apakah ID pengajuan sudah ada**
        let endpoint;
        let method;
        if (idPengajuan) {
            // Jika ID ada, lakukan UPDATE ke /updatePengajuan
            formData.append("id_pengajuan", idPengajuan);
            endpoint = "/updatePengajuan";
            method = "POST"; // Atau "PUT" jika API mendukung
        } else {
            // Jika ID belum ada, lakukan INSERT ke /storePengajuan
            endpoint = "/api/storePengajuan";
            method = "POST";
        }

        fetch(endpoint, {
            method: method,
            body: formData,
        })
        .then((response) => response.json())
        .then((data) => {
            if (data.success) {
                localStorage.setItem("id_pengajuan", data.id_pengajuan); // Simpan ID pengajuan di browser
                if (idPengajuanElement) idPengajuanElement.value = data.id_pengajuan; // Update input hidden jika ada
            } else {
                alert("Gagal membuat pengajuan: " + data.message);
            }
        })
        .catch((error) => {
            console.error("Error:", error);
        });
    }




    // step 5 Simpan status unggahan file
    let ktpUploaded = false;
    let invoiceUploaded = false;
    let existingKtp = localStorage.getItem("uploaded_ktp");
    let existingInvoice = localStorage.getItem("uploaded_invoice");

    document.getElementById("ktp").addEventListener("change", function () {
        ktpUploaded = true;
        runOCRIfBothUploaded();  // Cek apakah kedua file sudah ada
    });

    document.getElementById("invoice").addEventListener("change", function () {
        invoiceUploaded = true;
        runOCRIfBothUploaded();  // Cek apakah kedua file sudah ada
    });

    function runOCRIfBothUploaded() {
        let idPengajuan = localStorage.getItem("id_pengajuan");

        if (!idPengajuan) {
            alert("ID pengajuan tidak ditemukan. Silakan ulangi dari Step 4.");
            return;
        }

        let ktpFile = document.getElementById("ktp").files[0];
        let invoiceFile = document.getElementById("invoice").files[0];

        // **Jalankan OCR hanya jika kedua file telah diunggah**
        if (!ktpFile || !invoiceFile) return;

        let formData = new FormData();
        formData.append("id_pengajuan", idPengajuan);
        formData.append("ktp", ktpFile);
        formData.append("invoice", invoiceFile);

        // Tampilkan GIF loading
        document.getElementById("loading-ktp").style.display = "inline-block";
        document.getElementById("loading-invoice").style.display = "inline-block";

        fetch("http://localhost:5000/ocr", {
            method: "POST",
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            console.log(data);
            if (data.success) {
                alert("OCR berhasil! " + data.message);

                // Simpan path file KTP & Invoice yang valid di localStorage
                if (data.path_ktp) {
                    localStorage.setItem("uploaded_ktp", data.path_ktp);
                }
                if (data.path_invoice) {
                    localStorage.setItem("uploaded_invoice", data.path_invoice);
                }

                updateOCRStatus(data);
                simpanHasilOCR(idPengajuan, data);
            } else {
                alert("OCR gagal: " + data.message + ". Silakan unggah ulang dokumen yang benar.");
            }
        })
        .catch(error => console.error("Error:", error))
        .finally(() => {
            // Sembunyikan GIF loading setelah proses selesai
            document.getElementById("loading-ktp").style.display = "none";
            document.getElementById("loading-invoice").style.display = "none";
        });
    }

    function updateOCRStatus(data) {
        const ocrKtpElement = document.getElementById("status-ktp");
        const ocrInvoiceElement = document.getElementById("status-invoice");

        if (data.status === "valid") {
            ocrKtpElement.innerText = "✅ Valid";
            ocrKtpElement.classList.remove("badge-invalid");
            ocrKtpElement.classList.add("badge-valid");

            ocrInvoiceElement.innerText = "✅ Valid";
            ocrInvoiceElement.classList.remove("badge-invalid");
            ocrInvoiceElement.classList.add("badge-valid");
        } else {
            if (data.nama_ktp.toLowerCase() !== data.nama_invoice.toLowerCase()) {
                ocrKtpElement.innerText = "❌ Invalid";
                ocrKtpElement.classList.remove("badge-valid");
                ocrKtpElement.classList.add("badge-invalid");

                ocrInvoiceElement.innerText = "❌ Invalid";
                ocrInvoiceElement.classList.remove("badge-valid");
                ocrInvoiceElement.classList.add("badge-invalid");
            } else if (data.path_ktp) {
                ocrKtpElement.innerText = "✅ Valid";
                ocrKtpElement.classList.remove("badge-invalid");
                ocrKtpElement.classList.add("badge-valid");
            } else if (data.path_invoice) {
                ocrInvoiceElement.innerText = "✅ Valid";
                ocrInvoiceElement.classList.remove("badge-invalid");
                ocrInvoiceElement.classList.add("badge-valid");
            }
        }
    }


    function simpanHasilOCR(idPengajuan, data) {
        if (!data.path_ktp || !data.path_invoice) {
            console.error("Path dokumen tidak tersedia.");
            return;
        }

        let formData = new FormData();
        formData.append("id_pengajuan", idPengajuan);
        formData.append("path_ktp", data.path_ktp);
        formData.append("path_invoice", data.path_invoice);

        fetch("/api/storeOCR", {
            method: "POST",
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                console.log("Dokumen berhasil disimpan!");
            } else {
                alert("Gagal menyimpan dokumen.");
            }
        })
        .catch(error => console.error("Error saat menyimpan ke Laravel:", error));
    }

    Object.keys(images).forEach((posisi) => {
        document.getElementById(images[posisi]).addEventListener("change", function (event) {
            const file = event.target.files[0];
            if (file) {
                uploadGambar(file, posisi);
            }
        });
    });

    function uploadGambar(file, posisi) {
        let idPengajuan = localStorage.getItem("id_pengajuan");
        if (!idPengajuan) {
            alert("ID pengajuan tidak ditemukan.");
            return;
        }

        let formData = new FormData();
        formData.append("image", file);
        formData.append("jenis_gambar", posisi);
        formData.append("id_pengajuan", idPengajuan);

        // Tampilkan GIF loading
        let loadingElement = document.getElementById(`loading-${posisi}`);
        if (loadingElement) loadingElement.style.display = "inline-block";

        fetch("http://127.0.0.1:5000/predict", {
            method: "POST",
            body: formData,
        })
        .then((response) => response.json())
        .then((data) => {
            console.log(`Prediksi ${posisi}:`, data);

            const resultElement = document.getElementById(`result-${posisi}`);

            if (!resultElement) {
                console.error(`Elemen result-${posisi} tidak ditemukan di HTML.`);
                return;
            }

            if(data.success){
                if (data.prediction.status === "valid") {
                    resultElement.innerText = "✅ Valid";
                    resultElement.classList.remove("badge-invalid");
                    resultElement.classList.add("badge-valid");
                    validationResults[posisi] = true;
                } else {
                    resultElement.innerText = "❌ Invalid";
                    resultElement.classList.remove("badge-valid");
                    resultElement.classList.add("badge-invalid");
                    validationResults[posisi] = false;
                }
                simpanHasilPrediksi(idPengajuan, data, posisi);
            } else {
                alert("Gagal memproses gambar!");
            }

            checkAllValid();
        })
        .catch((error) => {
            console.error("Error:", error);
            const resultElement = document.getElementById(`result-${posisi}`);
            resultElement.innerText = "❌ Error";
            resultElement.classList.remove("badge-valid");
            resultElement.classList.add("badge-invalid");
            validationResults[posisi] = false;
            checkAllValid();
        })
        .finally(() => {
            // Sembunyikan GIF loading setelah proses selesai
            if (loadingElement) loadingElement.style.display = "none";
        });
    }



    function checkAllValid() {
        const allValid = Object.values(validationResults).every((val) => val);
        document.getElementById("submit-form").disabled = !allValid; // Aktifkan tombol submit jika valid
    }

    function simpanHasilPrediksi(idPengajuan, prediction, posisi) {
        if (!idPengajuan || !prediction || !prediction.prediction) {
            console.error("Data tidak lengkap, tidak dapat menyimpan hasil prediksi.");
            return;
        }

        let hasilDeteksi = {
            front_wheel_confidence: prediction.prediction.front_wheel_confidence || null,
            handlebar_confidence: prediction.prediction.handlebar_confidence || null,
            pedal_confidence: prediction.prediction.pedal_confidence || null,
            rear_wheel_confidence: prediction.prediction.rear_wheel_confidence || null,
            saddle_confidence: prediction.prediction.saddle_confidence || null,
            status: prediction.prediction.status || "Tidak diketahui"
        };

        let formData = new FormData();
        formData.append("id_pengajuan", idPengajuan);
        formData.append("jenis_gambar", posisi);
        formData.append("hasil_deteksi", JSON.stringify(hasilDeteksi)); // Simpan dalam format JSON
        formData.append("status", hasilDeteksi.status);
        formData.append("path_gambar", prediction.image_path || "");

        fetch("/api/storePrediksi", {
            method: "POST",
            headers: { "Accept": "application/json" },
            body: formData
        })
        .then(response => {
            if (!response.ok) {
                return response.json().then(err => { throw new Error(err.message || "Terjadi kesalahan"); });
            }
            return response.json();
        })
        .then(data => {
            console.log("Prediksi berhasil disimpan:", data);
        })
        .catch(error => console.error("Error saat kirim ke Laravel:", error));
    }



    // step 6
    document.getElementById("submit-form").addEventListener("click", function () {
        ambilDataPengajuan(idPengajuan);
    });

    function ambilDataPengajuan() {
        let idPengajuan = localStorage.getItem("id_pengajuan");  // Ambil ID pengajuan dari localStorage

        if (!idPengajuan) {
            console.error("ID pengajuan tidak ditemukan.");
            alert("ID pengajuan tidak ditemukan, silakan ulangi proses pengajuan.");
            return;
        }

        fetch(`/api/getPengajuanPrediksi/${idPengajuan}`)
        .then(response => response.json())
        .then(data => {
            console.log("Data Pengajuan & Prediksi:", data);

            if (!data.success) {
                console.error("Gagal mengambil data pengajuan.");
                return;
            }

            // Tampilkan informasi pengajuan
            document.getElementById("pengajuan-info").innerHTML = `
                <div class="detail-container">
                    <p>Produk</p>
                    <p><b>Sepeda</b></p>
                </div>
                <div class="detail-container">
                    <p>Seri Sepeda</p>
                    <p><b>${data.pengajuan.seri_sepeda || "-"}</b></p>
                </div>
                <div class="detail-container">
                    <p>Paket</p>
                    <p><b>${data.pengajuan.plan || "-"}</b></p>
                </div>
                <div class="detail-container">
                    <p>Warna Sepeda</p>
                    <p><b>${data.pengajuan.warna_sepeda || "-"}</b></p>
                </div>
                <div class="detail-container">
                    <p>Premi</p>
                    <p><b>Rp ${data.pengajuan.premi || "0"}</b></p>
                </div>
                <div class="detail-container">
                    <p>Nomor Rangka Sepeda</p>
                    <p><b>${data.pengajuan.no_rangka_sepeda || "-"}</b></p>
                </div>
                <div class="detail-container">
                    <p>Harga Sepeda</p>
                    <p><b>Rp ${data.pengajuan.harga_sepeda || "0"}</b></p>
                </div>
                <div class="detail-container">
                    <p>Tahun Produksi Sepeda</p>
                    <p><b>${data.pengajuan.tahun_produksi || "-"}</b></p>
                </div>
                <div class="detail-container">
                    <p>Merek Sepeda</p>
                    <p><b>${data.pengajuan.merek_sepeda || "-"}</b></p>
                </div>
                <div class="detail-container">
                    <p>Nomor Invoice Sepeda</p>
                    <p><b>${data.pengajuan.no_invoice_pembelian || "-"}</b></p>
                </div>
                <div class="detail-container">
                    <p>Tipe Sepeda</p>
                    <p><b>${data.pengajuan.tipe_sepeda || "-"}</b></p>
                </div>
                <div class="detail-container">
                    <p>Kode Promo</p>
                    <p><b>${data.pengajuan.kode_promo || "-"}</b></p>
                </div>
                <div class="detail-container">
                    <p>Model Sepeda</p>
                    <p><b>${data.pengajuan.model_sepeda || "-"}</b></p>
                </div>
            `;

            tampilkanPrediksiValid(data.prediksi, data.pengajuan);
        })
        .catch(error => console.error("Error mengambil semua prediksi:", error));
    }

    function tampilkanPrediksiValid(prediksiData, pengajuanData) {
        const posisiValid = ["tampak_depan", "tampak_kiri", "tampak_kanan", "tampak_belakang"];
        let prediksiHTML = "";

        // **Ambil path & status OCR dari database `pengajuans`**
        let pathKtp = pengajuanData.dok_ktp ? `${pengajuanData.dok_ktp}` : "/img/default-ktp.jpg";
        let pathInvoice = pengajuanData.dok_invoice_pembelian ? `${pengajuanData.dok_invoice_pembelian}` : "/img/default-invoice.jpg";
        let statusOCR = pengajuanData.status || "Belum Diproses"; // Ambil status dari database

        // **Tampilkan hasil OCR KTP**
        prediksiHTML += `
            <div class="document-container">
                <p>KTP</p>
                <p>${pathKtp}</p>
                <div class="badge-${statusOCR === "valid" ? "sukses" : "gagal"}">${statusOCR}</div>
            </div>
            <div class="hl"></div>
        `;

        // **Tampilkan hasil OCR Invoice**
        prediksiHTML += `
            <div class="document-container">
                <p>Invoice</p>
                <p>${pathInvoice}</p>
                <div class="badge-${statusOCR === "valid" ? "sukses" : "gagal"}">${statusOCR}</div>
            </div>
            <div class="hl"></div>
        `;

        posisiValid.forEach(posisi => {
            let prediksiPosisi = prediksiData.find(p => p.jenis_gambar === posisi && p.status === "valid");
            if (prediksiPosisi) {
                let pathGambar = prediksiPosisi.path_gambar ? `${prediksiPosisi.path_gambar}` : "/img/default-image.jpg";

                prediksiHTML += `
                    <div class="document-container">
                        <p>${posisi}</p>
                        <p>${pathGambar}</p>
                        <div class="badge-sukses">${prediksiPosisi.status} </div>
                    </div>
                    <div class="hl"></div>
                `;
            }
        });

        document.getElementById("prediksi-info").innerHTML = prediksiHTML || "<p>Tidak ada prediksi valid.</p>";
    }

    // step 7
    document.getElementById("update-snk").addEventListener("click", function () {
        let isChecked = document.getElementById("snk-checkbox").checked; // Ambil status checkbox
        updatesnk(isChecked);
    });

    function updatesnk(isChecked) {
        let idPengajuan = localStorage.getItem("id_pengajuan");  // Ambil ID pengajuan dari localStorage

        if (!idPengajuan) {
            alert("ID pengajuan tidak ditemukan. Silakan ulangi proses pengajuan.");
            return;
        }

        let snkValue = isChecked ? 1 : 0; // Jika dicentang, ubah jadi 1; jika tidak, tetap 0

        fetch("/api/updateSnk", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "Accept": "application/json",
                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({ id_pengajuan: idPengajuan, snk: snkValue })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                buatPermohonanPenutupan(idPengajuan);
                window.location.href = "/checkout"; // Redirect ke halaman checkout
            } else {
                alert("Gagal menyimpan persetujuan. Coba lagi!");
            }
        })
        .catch(error => console.error("Gagal memperbarui SNK:", error));
    }

    function buatPermohonanPenutupan(idPengajuan) {
        fetch(`/api/Penutupan/${idPengajuan}`, {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({ id_pengajuan: idPengajuan })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert("Permohonan Penutupan berhasil dibuat! Detail telah dikirim ke email Anda.");
            } else {
                alert("Gagal membuat permohonan: " + data.message);
            }
        })
        .catch(error => console.error("Error:", error));
    }

});









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
    const uploadButton = document.querySelector('.upload-button');
    if (uploadButton) {
        uploadButton.addEventListener("click", sendImagesForPrediction);
    }
});

function sendImagesForPrediction(event) {
    $('#loading').show(); // Tampilkan loading
    event.preventDefault(); // Mencegah form dari submit default

    var formData = new FormData();
    var imageInputs = {
        'tampak_depan': document.querySelector('#depan').files[0],
        'tampak_kiri': document.querySelector('#kiri').files[0],
        'tampak_kanan': document.querySelector('#kanan').files[0],
        'tampak_belakang': document.querySelector('#belakang').files[0]
    };

    // Menambahkan hanya gambar tampak sepeda ke dalam formData
    Object.keys(imageInputs).forEach((key) => {
        if (imageInputs[key]) {
            formData.append(key, imageInputs[key]);
        }
    });

    // Log data untuk debugging
    console.log('Mengirim data ke Flask:', formData);

    // Mengirim AJAX request ke Flask API
    $.ajax({
        url: 'http://localhost:5000/predict',  // Pastikan Flask berjalan di localhost:5000
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
            $('#loading').hide();
            console.log('Response dari Flask:', response);

            // Menampilkan hasil deteksi ke badge masing-masing gambar
            Object.keys(response.predictions).forEach((view) => {
                const prediction = response.predictions[view];
                const badgeElement = document.querySelector(`#result-${view}`);

                if (badgeElement) {
                    badgeElement.classList.remove('badge-valid', 'badge-invalid');

                    if (prediction.status === 'valid') {
                        badgeElement.textContent = 'Valid';
                        badgeElement.classList.add('badge-valid');
                    } else {
                        badgeElement.textContent = 'Invalid';
                        badgeElement.classList.add('badge-invalid');
                    }
                }
            });

            // Setelah Flask memproses, kirim data ke Laravel
            // sendToLaravel(response.predictions);
            $('#result').text(JSON.stringify(response, null, 2));
        },
        error: function(error) {
            $('#loading').hide();
            console.error('Error saat menghubungi Flask:', error);
            $('#result').text('Terjadi kesalahan saat memproses gambar.');
        }
    });
}


function sendToLaravel(flaskResponse, images) {
    var formData = new FormData();
    var keys = ['ktp', 'invoice', 'depan', 'kiri', 'kanan', 'belakang'];

    // Menambahkan file gambar ke FormData
    images.forEach((input, index) => {
        if (input.files[0]) {
            // Menggunakan template string dengan benar
            formData.append(`images[${keys[index]}]`, input.files[0]);
        }
    });

    // Tambahkan hasil prediksi ke FormData
    formData.append('results', JSON.stringify(flaskResponse));
    console.log('Added results:', flaskResponse);

    // Debug: Log semua isi FormData
    for (let pair of formData.entries()) {
        console.log(`${pair[0]}:`, pair[1]);
    }

    // Kirim data ke Laravel melalui AJAX
    $.ajax({
        url: 'http://localhost:8000/api/store', // Endpoint Laravel
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function (laravelResponse) {
            console.log('Response from Laravel:', laravelResponse);
            // alert('Data and files saved successfully!');
        },
        error: function (error) {
            console.error('Error from Laravel:', error);
            if (error.responseJSON) {
                alert('Error: ' + JSON.stringify(error.responseJSON));
            } else {
                alert('An error occurred while saving data!');
            }
        }
    });
}


document.addEventListener('DOMContentLoaded', function () {
    // Tangkap klik pada step 5
    document.getElementById('step-5').addEventListener('click', function () {
        // Panggil endpoint /api/form-data
        fetch('/api/form-data')
            .then(response => response.json())
            .then(data => {
                console.log('Data loaded:', data);

                // Tampilkan data gambar dan badge di form
                if (data.images && data.results) {
                    data.images.forEach(image => {
                        const previewElement = document.querySelector(`#preview-${image.view}`);
                        if (previewElement) {
                            previewElement.src = `/${image.image_path}`;
                            previewElement.style.display = 'block';
                        }
                    });

                    data.results.forEach(result => {
                        const badgeElement = document.querySelector(`#result-${result.view}`);
                        if (badgeElement) {
                            badgeElement.classList.remove('badge-valid', 'badge-invalid');
                            badgeElement.textContent = result.status === 'valid' ? 'Valid' : 'Invalid';
                            badgeElement.classList.add(result.status === 'valid' ? 'badge-valid' : 'badge-invalid');
                        }
                    });
                }
            })
            .catch(error => {
                console.error('Error loading data:', error);
            });
    });
});



document.querySelectorAll('input[type="file"]').forEach(input => {
    input.addEventListener('change', function(event) {
        const file = event.target.files[0];
        if (file) {
            const previewId = `preview-${event.target.id}`;
            const previewElement = document.querySelector(`#${previewId}`);
            if (previewElement) {
                previewElement.src = URL.createObjectURL(file);
                previewElement.style.display = 'block';
            }
        }
    });
});








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
    let sidebarItems = document.querySelectorAll(".sidebar-items");

    sidebarItems.forEach(item => {
        if (item.href === window.location.href) {
            item.parentElement.classList.add("active");
        }
    });
});


document.addEventListener("DOMContentLoaded", function () {
    $(document).ready(function () {

        var table = $('#permohonanpenutupan-table').DataTable();

        // Trigger search saat klik tombol Search
        $('.filter-button').first().on('click', function () {
            table.column(5).search($('#searchStatus').val());
            table.column(1).search($('#searchTanggalPengajuan').val());
            table.draw();
        });

        // Tombol Reset
        $('.filter-button').last().on('click', function () {
            $('#searchTanggalPengajuan').val('');
            $('#searchStatus').val('');
            table.search('').columns().search('').draw();
        });
    });
});

document.addEventListener("DOMContentLoaded", function () {
    $(document).ready(function () {
        let table = $('#pengajuans-table').DataTable();

        // Event saat tombol "Search" ditekan
        $('.filter-button').eq(0).on('click', function () {
            let namaUser = $('#searchNamaUser').val();
            let tanggalPengajuan = $('#searchTanggalPengajuan').val();

            // Terapkan filter DataTables
            table.column(1).search(namaUser); // Kolom ke-1 = Nama User
            table.column(5).search(tanggalPengajuan); // Kolom ke-5 = Tanggal Pengajuan

            table.draw();
        });

        // Event saat tombol "Reset" ditekan
        $('.filter-button').eq(1).on('click', function () {
            $('#searchNamaUser').val('');
            $('#searchTanggalPengajuan').val('');

            // Reset filter DataTables
            table.search('').columns().search('').draw();
        });

        $('#pengajuans-table tbody').on('click', 'tr', function() {
            let data = table.row(this).data();
            console.log(data); // Cek data yang diklik di console

            if (data) {
                let id = data.DT_RowId; // Pastikan ID ada di kolom pertama
                console.log("Selected ID:", id); // Debugging
                window.location.href = "/admin/detail/" + id;
            }
        });
    });

});

document.addEventListener("DOMContentLoaded", function () {
    $(document).ready(function () {
        let table = $('#pembayarans-table').DataTable();

        // Event saat tombol "Search" ditekan
        $('.filter-button').eq(0).on('click', function () {
            let namaUser = $('#searchNamaUser').val();
            let tanggalPengajuan = $('#searchTanggalPengajuan').val();

            // Terapkan filter DataTables
            table.column(2).search(namaUser); // Kolom ke-1 = Nama User
            table.column(1).search(tanggalPengajuan); // Kolom ke-5 = Tanggal Pengajuan

            table.draw();
        });

        // Event saat tombol "Reset" ditekan
        $('.filter-button').eq(1).on('click', function () {
            $('#searchNamaUser').val('');
            $('#searchTanggalPengajuan').val('');

            // Reset filter DataTables
            table.search('').columns().search('').draw();
        });

        $('#pembayarans-table tbody').on('click', 'tr', function() {
            let data = table.row(this).data();
            console.log(data); // Cek data yang diklik di console

            if (data) {
                let id = data.DT_RowId; // Pastikan ID ada di kolom pertama
                console.log("Selected ID:", id); // Debugging
                window.location.href = "/admin/detail/" + id;
            }
        });
    });

});

document.addEventListener("DOMContentLoaded", function () {
    const sections = document.querySelectorAll(".detail-section");
    const steps = document.querySelectorAll(".detail-step .section");

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

            // Sembunyikan semua detail-section
            sections.forEach(section => section.style.display = "none");
            // Tampilkan section yang sesuai
            sections[index].style.display = "block";
        });
    });
});

document.addEventListener("DOMContentLoaded", function () {
    const ctx = document.getElementById('totalAccuracyChart');
    const ctx2 = document.getElementById('predictionChart');
    const ctx3 = document.getElementById('myChart').getContext('2d');
    const ctx4 = document.getElementById('accuracyChart').getContext('2d');

    if (ctx && chartData.values.length > 0) {
        new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: chartData.labels,
                datasets: [{
                    label: 'Average Accuracy (%)',
                    data: chartData.values,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.7)',
                        'rgba(54, 162, 235, 0.7)',
                        'rgba(255, 206, 86, 0.7)',
                        'rgba(75, 192, 192, 0.7)',
                        'rgba(153, 102, 255, 0.7)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false },
                    title: {
                        display: true,
                        text: `${chartData.totalAvg}%`,
                        font: { size: 36 }
                    }
                }
            }
        });
    } else {
        console.error("Chart data tidak tersedia.");
    }

    if (ctx2 && chartDataPrediksi.values.length > 0) {
        new Chart(ctx2, {
            type: 'doughnut',
            data: {
                labels: chartDataPrediksi.labels,
                datasets: [{
                    data: chartDataPrediksi.values,
                    backgroundColor: ['rgba(75, 192, 192, 0.7)', 'rgba(255, 99, 132, 0.7)'],
                    borderColor: ['rgba(75, 192, 192, 1)', 'rgba(255, 99, 132, 1)'],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false }, // Sembunyikan legend default
                    title: {
                        display: true,
                        text: `${chartDataPrediksi.total}`,
                        font: { size: 36 }
                    }
                }
            }
        });
    } else {
        console.error("Chart data tidak tersedia.");
    }

    new Chart(ctx3, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [{
                label: 'Prediksi Valid',
                data: valuesvalid,
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 2,
                // fill: true
            }, {
                label: 'Prediksi Invalid',
                data: valuesinvalid,
                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                borderColor: 'rgba(255, 99, 132, 1)',
                borderWidth: 2,
                // fill: true
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    new Chart(ctx4, {
        type: 'line',
        data: {
            labels: accuracyLabels,
            datasets: [{
                label: 'Rata-rata Akurasi Prediksi (%)',
                data: accuracyValues,
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 2,
                fill: true
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    max: 100
                }
            }
        }
    });

});



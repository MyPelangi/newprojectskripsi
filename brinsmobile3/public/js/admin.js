document.addEventListener("DOMContentLoaded", function () {
    let sidebarItems = document.querySelectorAll(".sidebar-items a");

    sidebarItems.forEach(item => {
        if (item.href === window.location.href) {
            item.parentElement.classList.add("active");
        }
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
    });

});

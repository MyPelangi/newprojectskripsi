@extends('layouts.admin')

@section('title', 'Dashboard Admin')

@section('content')
<div class="container dashboard-container">
    <div class="total-container">
        <div class="card total-card shadow-sm">
            <div class="card-content">
                <p><b>Total Pengajuan Polis</b></p>
                <h2>{{ $pengajuan }}</h2>
            </div>
        </div>
        <div class="card total-card shadow-sm">
            <div class="card-content">
                <p><b>Tingkat Akurasi Prediksi</b></p>
                <h2>{{ number_format($totalAvgAccuracy, 2) }}%</h2>
            </div>
        </div>
        <div class="card total-card shadow-sm">
            <div class="card-content">
                <p><b>Total Permohonan Polis</b></p>
                <h2>{{ $permohonan }}</h2>
            </div>
        </div>
        <div class="card total-card shadow-sm">
            <div class="card-content">
                <p><b>Total Penutupan Polis</b></p>
                <h2>{{ $penutupan }}</h2>
            </div>
        </div>
    </div>
    {{-- <br> --}}
    <div class="total-container">
        <div class="card total-card shadow-sm">
            <h5><b>Total Pengajuan</b></h5>
            <div class="chart-container">
                <div class="chart">
                    <canvas id="doughnutChart" width="250" height="180"></canvas>
                </div>
            </div>
        </div>
        <div class="card total-card shadow-sm">
            <h5><b>Total Permohonan Ditolak</b></h5>
            <div class="chart-container">
                <div class="chart">
                    <canvas id="chartDitolak" width="250" height="180"></canvas>
                </div>
            </div>
        </div>
        <div class="card total-card shadow-sm">
            <h5><b>Total Permohonan Diterima</b></h5>
            <div class="chart-container">
                <div class="chart">
                    <canvas id="chartDisetujui" width="250" height="180"></canvas>
                </div>
            </div>
        </div>
    </div>
    {{-- <br> --}}
    <div class="card chart-card shadow-sm">
        <canvas id="chartPengajuanHarian" ></canvas>
    </div>
</div>
@endsection

@push('scripts')
<script>
    const ctx = document.getElementById('doughnutChart').getContext('2d');
    const doughnutChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: {!! json_encode($labels) !!},
            datasets: [{
                label: 'Jumlah Pengajuan',
                data: {!! json_encode($totals) !!},
                backgroundColor: [
                    '#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF',
                    '#FF9F40', '#66ff66', '#ff6666', '#6699ff', '#ffcc66'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'right'
                }
            }
        }
    });

    // Chart Ditolak
    new Chart(document.getElementById('chartDitolak').getContext('2d'), {
        type: 'doughnut',
        data: {
            labels: {!! json_encode($labels_ditolak) !!},
            datasets: [{
                label: 'Jumlah Ditolak',
                data: {!! json_encode($data_ditolak) !!},
                backgroundColor: [
                    '#FF6384', '#FF9F40', '#FFCD56', '#FF6384', '#ff6666'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { position: 'right' }
            }
        }
    });

    // Chart Diterima
    new Chart(document.getElementById('chartDisetujui').getContext('2d'), {
        type: 'doughnut',
        data: {
            labels: {!! json_encode($labels_disetujui) !!},
            datasets: [{
                label: 'Jumlah Diterima',
                data: {!! json_encode($data_disetujui) !!},
                backgroundColor: [
                    '#36A2EB', '#4BC0C0', '#9966FF', '#66ff66', '#6699ff'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { position: 'right' }
            }
        }
    });

        // Chart Garis - Total Pengajuan Polis Per Hari
    new Chart(document.getElementById('chartPengajuanHarian').getContext('2d'), {
        type: 'line',
        data: {
            labels: {!! json_encode($tanggalpengajuan) !!},
            datasets: [{
                label: 'Total Pengajuan',
                data: {!! json_encode($totalpengajuan) !!},
                borderColor: 'rgba(75, 192, 192, 1)',
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                fill: true,
                tension: 0.4,
                borderWidth: 2,
                pointBackgroundColor: 'rgba(75, 192, 192, 1)'
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top'
                },
                title: {
                    display: true,
                    text: 'Grafik Pengajuan Polis Per Hari'
                }
            },
            scales: {
                x: {
                    title: {
                        display: true,
                        text: 'Tanggal'
                    }
                },
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Jumlah Pengajuan'
                    }
                }
            }
        }
    });
</script>
@endpush

@extends('layouts.admin')

@section('title', 'Dashboard Admin')

@section('content')
<div class="container dashboard-container">
    <div class="info-container">
        <div class="total-container">
            <div class="card total-card shadow-sm">
                <div class="card-content">
                    <h4><b>Tingkat Akurasi Prediksi</b></h4>
                    <div class="chart-container">
                        <div class="chart-labels">
                            <ul>
                                <li><span class="color-box frontwheel"></span> Front Wheel</li>
                                <li><span class="color-box handlebar"></span> Handlebar</li>
                                <li><span class="color-box pedal"></span> Pedal</li>
                                <li><span class="color-box rearwheel"></span> Rear Wheel</li>
                                <li><span class="color-box saddle"></span> Saddle</li>
                            </ul>
                        </div>
                        <div class="chart-area">
                            <canvas id="totalAccuracyChart" width="200" height="200"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card total-card shadow-sm">
                <h4><b>Total Prediksi</b></h4>
                <div class="chart-container">
                    <div class="chart-labels">
                        <ul>
                            <li><span class="color-box valid"></span> Valid</li>
                            <li><span class="color-box invalid"></span> Invalid</li>
                        </ul>
                    </div>
                    <div class="chart-area">
                        <canvas id="predictionChart" width="250" height="250"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="chart-content">
            <div class="card total-card">
                <canvas id="accuracyChart"></canvas>
            </div>
            <div class="card total-card">
                <canvas id="myChart"></canvas>
            </div>
        </div>
    </div>
    <br>
    <div class="card">
        <div class="datatables-wrapper">
            {{$dataTable->table()}}
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    var chartData = @json($chartData);

    var chartDataPrediksi = @json($chartDataPrediksi);

    const labels = @json($labels);
    const valuesvalid = @json($valuesvalid);
    const valuesinvalid = @json($valuesinvalid);

    const accuracyLabels = @json($accuracyLabels);
    const accuracyValues = @json($accuracyValues);
</script>

{{$dataTable->scripts()}}

@endpush

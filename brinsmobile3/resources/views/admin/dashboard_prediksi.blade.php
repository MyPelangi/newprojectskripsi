@extends('layouts.admin')

@section('title', 'Dashboard Admin')

@section('content')
<div class="container dashboard-container">
    <div class="total-container">
        <div class="card total-card">
            <div class="card-content">
                <p><b>Tingkat Akurasi</b></p>
                <h2>{{ number_format($totalAvgAccuracy, 2) }}%</h2>
            </div>
        </div>
        <div class="card total-card">
            <div class="card-content">
                <p><b>Valid</b></p>
                <h2>{{ $prediksiValid }}</h2>
            </div>
        </div>
        <div class="card total-card">
            <div class="card-content">
                <p><b>Invalid</b></p>
                <h2>{{ $prediksiInvalid }}</h2>
            </div>
        </div>
    </div>
    <br>
    {{$dataTable->table()}}
</div>
@endsection

@push('scripts')
    {{$dataTable->scripts()}}
@endpush

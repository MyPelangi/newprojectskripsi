@extends('layouts.main')

@section('content')
@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

<div class="containers">
    <div class="header">
        <img src="/img/sepeda.png" alt="">
        <div class="header-title">
            <h1>Sepeda</h1>
            <h4>Periode Tahunan</h4>
        </div>
    </div>
    <div class="container">
        <div class="step-container">
            @foreach ([
                'Kalkulasi Premi', 'Kode Promo', 'Hasil Kalkulasi', 'Informasi Objek',
                'Dokumen Pendukung', 'Detail Transaksi', 'Syarat & Ketentuan'
            ] as $index => $step)
            <div class="step" data-step="{{ $index + 1 }}" onclick="validateAndGoToStep({{ $index + 1 }})">
                <div class="circle">{{ $index + 1 }}</div>
                <span>{{ $step }}</span>
            </div>
            @endforeach
        </div>
        <div class="card">
            <div class="card-body">
                <form action="" method="POST" id="form-pengajuan" enctype="multipart/form-data">
                    @csrf
                    <div class="card-content">
                        @include('steps.step1')
                        @include('steps.step2')
                        @include('steps.step3')
                        @include('steps.step4', ['tipesepeda' => $tipesepeda])
                        @include('steps.step5')
                        @include('steps.step6')
                        @include('steps.step7')
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    var storeUrl = "{{ url('api/store') }}";
</script>
@endpush

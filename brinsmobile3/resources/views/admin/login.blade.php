@extends('layouts.admin')

@section('content')
<div class="login-container">
    <div class="login">
        <div class="login-title">
            <img src="/img/logobrins.png" alt="">
            <h3>DASHBOARD</h3>
            <h3>LOGIN</h3>
        </div>
        <form action="{{ route('admin.login') }}" method="POST">
            @csrf
            <div class="mb-3">
                <div class="form-group">
                    <label for="username" class="form-label">Email</label>
                    <input type="text" placeholder="Masukkan email" value="{{ old('email')}}" id="email" name="email" class="form-control">
                    @error('email')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>
            <div class="mb-3">
                <div class="form-group">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" placeholder="Masukkan password" name="password" id="password" class="form-control">
                    <i class="fa fa-eye passwordshow"></i>
                    @error('password')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>
            <div class="mb-3">
                <button type="submit" class="btn upload-button w-100">Login</button>
            </div>
        </form>
        <p>Tidak memiliki akses? Hubungi Divisi TSI.</p>
    </div>
</div>
@endsection

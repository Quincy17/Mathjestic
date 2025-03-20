@extends('layouts.app')
@section('content')
@if(Auth::check() && Auth::user()->role === 'admin')
        @include('admin.sidebar')  
    @endif
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <p>{{ __('Selamat Datang di OlympiApp') }}</p>

                    <!-- Tombol daftar soal di bagian kanan bawah -->
                    <div class="d-flex justify-content-end mt-3">
                        <a href="{{ route('soal.index') }}" class="btn btn-outline-dark">Klik untuk daftar modul</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

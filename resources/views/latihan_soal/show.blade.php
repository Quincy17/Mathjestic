@extends('layouts.app')
@section('content')
@if(Auth::check() && Auth::user()->role === 'murid')
    @include('admin.sidebar-user') 
@else
    @include('admin.sidebar')
@endif
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-9">
            <br><br>
            <h2>{{ $latihanSoal->judul }}</h2>
            <div class="card mb-3"  style="box-shadow: 0 0 10px rgba(0, 0, 0, 0.3); padding: 20px;">
            <p><strong>Deskripsi:</strong> {{ $latihanSoal->deskripsi }}</p>
            </div>
            <div class="card mb-3"  style="box-shadow: 0 0 10px rgba(0, 0, 0, 0.3); padding: 20px;">
            <p><strong>Soal:</strong></p>
            </div>
            <div class="card mb-3"  style="box-shadow: 0 0 10px rgba(0, 0, 0, 0.3); padding: 20px;">
            <pre>{{ $latihanSoal->soal }}</pre>
            </div>
            <a href="{{ route('latihan-soal.index') }}" class="btn btn-outline-primary">Kembali</a>
        </div>
    </div>
</div>
@endsection

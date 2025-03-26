@extends('layouts.app')

@section('content')
@if(Auth::check() && Auth::user()->role === 'murid')
    @include('admin.sidebar-user') 
@else
    @include('admin.sidebar')
@endif

<div class="container">
    <h2>Detail Jawaban</h2>
    <div class="card shadow p-4">
        <p><strong>Nama Murid:</strong> {{ optional($jawaban->murid)->name ?? 'Tidak Diketahui' }}</p>
        <br>
        <p><strong>Judul Soal:</strong> {{ optional($jawaban->latihanSoal)->judul ?? 'Tidak Diketahui' }}</p>
        <br>
        <p><strong>Jawaban:</strong></p>
        <div class="border p-3 bg-light">
            {!! nl2br(e($jawaban->jawaban)) !!}
        </div>
        <br>
        <p><strong>Hasil Koreksi:</strong> 
            @if($jawaban->status === 'benar')
                <span class="badge bg-success">Benar</span>
            @else
                <span class="badge bg-danger">Salah</span>
            @endif
        </p>
        <br>
        <p><strong>Tanggal:</strong> {{ $jawaban->created_at->format('d-m-Y H:i') }}</p>
        <br>
        <a href="{{ route('admin.arsip-jawaban') }}" class="btn btn-secondary">Kembali</a>
    </div>
</div>
@endsection

@extends('layouts.app')

@section('content')
@if(Auth::check() && Auth::user()->role === 'murid')
    @include('admin.sidebar-user') 
@endif

<div class="container">
    <h2>Jawaban Terkirim</h2>
    
    <div class="alert alert-success">
        <p>Terima kasih telah mengerjakan soal. Jawaban Anda telah dikirim!</p>
    </div>

    <a href="{{ route('latihan_soal.index') }}" class="btn btn-primary">Kembali ke Daftar Soal</a>
</div>
@endsection

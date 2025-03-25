@extends('layouts.app')
@section('content')
@if(Auth::check() && Auth::user()->role === 'murid')
    @include('admin.sidebar-user') 
@else
    @include('admin.sidebar')
@endif
<div class="container">
    <h2>Edit Latihan Soal</h2>
    <form action="{{ route('latihan-soal.update', $latihanSoal->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="judul" class="form-label">Judul</label>
            <input type="text" class="form-control" id="judul" name="judul" value="{{ $latihanSoal->judul }}" required>
        </div>
        <div class="mb-3">
            <label for="deskripsi" class="form-label">Deskripsi</label>
            <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" required>{{ $latihanSoal->deskripsi }}</textarea>
        </div>
        <div class="mb-3">
            <label for="soal" class="form-label">Soal</label>
            <textarea class="form-control" id="soal" name="soal" rows="5" required>{{ $latihanSoal->soal }}</textarea>
        </div>
        <div class="mb-3">
            <label for="jawaban" class="form-label">Jawaban</label>
            <textarea class="form-control" id="jawaban" name="jawaban" rows="5" required>{{ $latihanSoal->soal }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection

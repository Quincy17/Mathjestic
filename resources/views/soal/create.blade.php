@extends('layouts.app')
@section('content')
@if(Auth::check() && Auth::user()->role === 'admin')
        @include('admin.sidebar')  
    @endif

<div class="container">
    <br><br>
    <h2>Upload Modul Baru</h2>
    <form action="{{ route('soal.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label>Kategori</label>
            <textarea name="description" class="form-control" required></textarea>
        </div>
        <div class="form-group">
            <label>File Soal</label>
            <input type="file" name="files[]" class="form-control" required multiple>
        </div>
        <a href="../soal" class="btn btn-primary" style="margin-top: 10px;">Kembali</a>
        <button type="submit" class="btn btn-primary" style="margin-top: 10px; float:right;">Upload</button>
    </form>
</div>
@endsection

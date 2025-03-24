@extends('layouts.app')

@section('content')
    @if(Auth::check() && Auth::user()->role === 'admin')
        @include('admin.sidebar')  
    @endif

<div class="container">
    <h2>Edit Blog</h2>
    <form action="{{ route('blogs.update', $blog->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- Input Judul -->
        <div class="mb-3">
            <label for="title" class="form-label">Judul</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $blog->title) }}" required>
        </div>

        <!-- Input Kategori -->
        <div class="mb-3">
            <label for="category" class="form-label">Kategori</label>
            <input type="text" class="form-control" id="category" name="category" value="{{ old('category', $blog->category) }}" required>
        </div>    

        <!-- Input Konten -->
        <div class="mb-3">
            <label for="content" class="form-label">Konten</label>
            <textarea name="content" id="content" class="form-control" rows="20" required>{{ old('content', $blog->content) }}</textarea>
        </div>

        <!-- Input Gambar -->
        <div class="mb-3">
            <label for="image" class="form-label">Gambar (Opsional)</label>
            <input type="file" class="form-control" id="image" name="image">
        </div>

        <!-- Tombol Submit & Batal -->
        <button type="submit" class="btn btn-outline-primary">Simpan Perubahan</button>
        <a href="{{ route('blogs.index') }}" class="btn btn-outline-secondary">Batal</a>
    </form>
</div>

@endsection

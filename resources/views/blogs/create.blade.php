@extends('layouts.app')
@section('content')
    @if(Auth::check() && Auth::user()->role === 'admin')
        @include('admin.sidebar')  
    @endif
    
<div class="container">
    <h2>Tulis Blog</h2>
    <form action="{{ route('blogs.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="title" class="form-label">Judul</label>
            <input type="text" class="form-control" id="title" name="title" required>
        </div>
        <div class="mb-3">
            <label for="category" class="form-label">Kategori</label>
            <input type="text" class="form-control" id="category" name="category" value="{{ old('category', $blog->category ?? '') }}" required>
        </div>        
        <div class="mb-3">
            <label for="content">Konten:</label>
            <textarea name="content" id="content" class="form-control" rows="20" required placeholder="Gunakan $$ ... $$ untuk persamaan blok dan $ ... $ untuk persamaan inline"></textarea>
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Gambar (Opsional)</label>
            <input type="file" class="form-control" id="image" name="image">
        </div>
        <button type="submit" class="btn btn-outline-primary">Posting</button>
    </form>
</div>

@endsection

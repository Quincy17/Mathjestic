@extends('layouts.app')
@section('content')
    @if(Auth::check() && Auth::user()->role === 'admin')
        @include('admin.sidebar')  
    @endif

<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Daftar Blog</h2>
    <a href="{{ route('blogs.create') }}" class="btn btn-primary mb-3">Tulis Blog</a>
    </div>
    @foreach ($blogs as $blog)
        <div class="card mb-3">
            <div class="card-body">
                <h5 class="card-title">{{ $blog->title }}</h5>
                <p class="card-text">{{ Str::limit($blog->content, 100) }}</p>
                @if ($blog->image)
                    <img src="{{ asset('storage/' . $blog->image) }}" alt="Blog Image" class="img-fluid d-block mb-2" style="max-width: 200px;">
                @endif

                <a href="{{ route('blogs.show', $blog->id) }}" class="btn btn-outline-primary" style="margin-top: 10px;">Baca Selengkapnya</a>
                @if(Auth::id() === $blog->user_id)
                <a href="{{ route('blogs.edit', $blog) }}" class="btn btn-outline-success" style="margin-top: 10px;">Edit</a>
                    <form action="{{ route('blogs.destroy', $blog) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-outline-danger" style="margin-top: 10px;">Hapus</button>
                    </form>
                @endif
            </div>
        </div>
    @endforeach
    <div class="d-flex justify-content-center mt-3" style="float: right; margin-right: 20px;">
        {{ $blogs->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection

@extends('layouts.app')
@section('content')
    @if(Auth::check() && Auth::user()->role === 'admin')
        @include('admin.sidebar')  
    @else
        @include('admin.sidebar-user')  
    @endif

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h2 style="font-family: 'Poppins', sans-serif;">Daftar Blog</h2>
                @if(Auth::check() && Auth::user()->role === 'admin')
                    <a href="{{ route('blogs.create') }}" class="btn btn-primary">Tulis Blog</a>
                @endif
            </div>
        </div>
    </div>

    <div class="row justify-content-center pb-5">
        <div class="col-md-7">
            @if($blogs->isEmpty())
                <p class="text-muted">Belum ada artikel yang diposting.</p>
            @else
                @foreach ($blogs as $blog)
                    <div class="card mb-3" style="box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);">
                        <div class="card-body">
                            <h5 class="card-title">{{ $blog->title }}</h5>
                            <p class="text-muted">Ditulis oleh {{ $blog->user->name }} pada {{ $blog->created_at->format('d M Y') }}</p>

                            @if ($blog->image)
                                <img src="{{ asset('storage/' . $blog->image) }}" alt="Blog Image" class="img-fluid mb-3">
                            @endif

                            <div  class="markdown-body" >{!! Str::limit($blog->content, 200) !!}</div>
                            <a href="{{ route('blogs.show', $blog->id) }}" class="btn btn-outline-primary">Baca Selengkapnya</a>

                            @if(Auth::id() === $blog->user_id)
                                <a href="{{ route('blogs.edit', $blog) }}" class="btn btn-outline-success">Edit</a>
                                <form action="{{ route('blogs.destroy', $blog) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger">Hapus</button>
                                </form>
                            @endif
                        </div>
                    </div>
                @endforeach
            @endif
        </div>

        <div class="row justify-content-center">
            <div class="col-md-7">
                <div class="d-flex justify-content-end me-3 mt-3">
                    {{ $blogs->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Render MathJax setelah halaman dimuat -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        MathJax.typeset();
    });
</script>

@endsection

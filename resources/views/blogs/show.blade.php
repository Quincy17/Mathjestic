@extends('layouts.app')
@section('content')
    @if(Auth::check() && Auth::user()->role === 'admin')
        @include('admin.sidebar') 
    @else
        @include('admin.sidebar-user')
    @endif
    
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="card mb-3" style="box-shadow: 0 0 10px rgba(0, 0, 0, 0.3); padding: 20px;">
                <h2 style="word-wrap: break-word; overflow-wrap: break-word;">{{ $blog->title }}</h2>
                <p class="text-muted">Ditulis oleh {{ $blog->user->name }} pada {{ $blog->created_at->format('d M Y') }}</p>
                
                <p style="word-wrap: break-word; overflow-wrap: break-word;">{{ $blog->content }}</p>

                @if ($blog->image)
                    <img src="{{ asset('storage/' . $blog->image) }}" alt="Blog Image" 
                        class="img-fluid mb-3" style="max-width: 400px; height: auto;">
                @endif
                <br>
            </div>
            <a href="{{ route('blogs.index') }}" class="btn btn-outline-primary">Kembali</a>
        </div>
    </div>
    
</div>
@endsection

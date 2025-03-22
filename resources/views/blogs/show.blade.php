@extends('layouts.app')
@section('content')
    @if(Auth::check() && Auth::user()->role === 'admin')
        @include('admin.sidebar') 
    @else
        @include('admin.sidebar-user')
    @endif
    
<div class="container">
    <h2>{{ $blog->title }}</h2>
    <p class="text-muted">Ditulis oleh {{ $blog->user->name }} pada {{ $blog->created_at->format('d M Y') }}</p>
    @if ($blog->image)
        <img src="{{ asset('storage/' . $blog->image) }}" alt="Blog Image" class="img-fluid mb-3">
        <br>
    @endif
    <p>{{ $blog->content }}</p>
    <a href="{{ route('blogs.index') }}" class="btn btn-outline-primary">Kembali</a>
</div>
@endsection

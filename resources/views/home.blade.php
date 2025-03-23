@extends('layouts.app')
@section('content')
@if(Auth::check() && Auth::user()->role === 'murid')
    @include('admin.sidebar-user') 
@else
    @include('admin.sidebar')
@endif
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <p>{{ __('Selamat Datang di OlympiApp') }}</p>

                    <!-- Tombol daftar soal di bagian kanan bawah -->
                    <div class="d-flex justify-content-end mt-3">
                        <a href="{{ route('soal.index') }}" class="btn btn-outline-dark">Klik untuk daftar modul</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Menampilkan daftar blog -->
    <div class="row mt-4">
        <div class="col-md-8 offset-md-2">
            <h3 style="font-family: 'Poppins', sans-serif; margin-left:10px;" >Artikel Terbaru</h3>

            @if($blogs->isEmpty())
                <p class="text-muted">Belum ada artikel yang diposting.</p>
            @else
                @foreach($blogs as $blog)
                    <div class="card mb-3">
                        <div class="card-body">
                            <h5 class="card-title">{{ $blog->title }}</h5>
                            <p class="text-muted">Ditulis oleh {{ $blog->user->name }} pada {{ $blog->created_at->format('d M Y') }}</p>

                            @if ($blog->image)
                                <img src="{{ asset('storage/' . $blog->image) }}" alt="Blog Image" class="img-fluid mb-3">
                            @endif

                            <p>{{ Str::limit($blog->content, 100) }}</p>
                            <a href="{{ route('blogs.show', $blog->id) }}" class="btn btn-outline-primary">Baca Selengkapnya</a>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</div>
@endsection

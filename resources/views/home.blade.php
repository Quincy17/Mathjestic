@extends('layouts.app')
@section('content')
@if(Auth::check() && Auth::user()->role === 'murid')
    @include('admin.sidebar-user') 
@else
    @include('admin.sidebar')
@endif
<style>
    body {
        font-family: 'Poppins', sans-serif;
    }

    .hero-section {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 60px;
    }

    .fade-in {
        opacity: 0;
        transform: translateX(-20px);
        animation: fadeIn 1s ease-in-out forwards;
    }

    @keyframes fadeIn {
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    .contact-btn {
        border: 2px solid black;
        padding: 10px 20px;
        font-weight: bold;
        background: none;
        cursor: pointer;
        text-decoration: none;
        color: black;
        display: inline-block;
        margin-top: 10px;
    }

    .contact-btn:hover {
        background: black;
        color: white;
    }

    @media (max-width: 768px) {
        .hero-section {
            flex-direction: column;
            text-align: center;
        }

        .hero-section div {
            margin-bottom: 20px;
        }
    }

    .container .d-flex {
        overflow-x: auto;
        gap: 20px;
        padding-bottom: 10px;
    }

    .container .card {
        flex: 0 0 auto;
    }

</style>

<div class="container">
    <div class="hero-section">
        <!-- Bagian Kiri -->
        <div>
            <h1><strong>Mathjestic</strong></h1>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
            <a href="https://wa.me/6282132570837" class="contact-btn">Contact Me</a>
        </div>

        <!-- Bagian Kanan (Foto & Efek Fade) -->
        <div class="fade-in">
            <img src="{{ asset('storage/home_files/profile.png') }}" alt="Foto Profil" width="200">
        </div>
    </div>
    <!-- Bagian Visi -->
    <br><br>
    <div class="mt-4">
        <h2 class="fw-bold text-center">Visi</h2>
        <hr style="height: 3px; background-color: black; ">
        <p class="text-center" style="font-size: 18px; color: #000000;">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Ex, dolore totam nostrum velit aperiam veniam omnis, libero maxime delectus nobis temporibus natus amet debitis. Officia modi veritatis sint voluptate ex!</p>
    </div>


    <!-- Bagian Blog Terbaru -->
    <br><br>
    <div class="container mt-4">
        <h3 class="text-center" style="font-family: 'Poppins', sans-serif;">Artikel Terbaru</h3>
        <br><br>
        <div class="d-flex justify-content-center align-items-center flex-nowrap overflow-auto pb-3" style="gap: 20px;">
            @if($blogs->isEmpty())
                <p class="text-muted">Belum ada artikel yang diposting.</p>
            @else
                @foreach($blogs->take(3) as $blog)
                    <a href="{{ route('blogs.show', $blog->id) }}" class="text-decoration-none text-dark ">
                        <div class="card shadow-sm" style="width: 18rem; border-radius: 15px; overflow: hidden;">
                            @if ($blog->image)
                                <img src="{{ asset('storage/' . $blog->image) }}" alt="Blog Image" class="img-fluid" style="height: 150px; object-fit: cover;">
                            @else
                                <div class="d-flex align-items-center justify-content-center bg-light" style="height: 150px;">
                                    <span class="text-muted">No Preview Image</span>
                                </div>
                            @endif
                            <div class="card-body">
                                <h5 class="fw-bold">{{ $blog->title }}</h5>
                                <p class="text-muted small">Ditulis oleh {{ $blog->user->name }} pada {{ $blog->created_at->format('d M Y') }}</p>
                                <p class="mb-0">{{ Str::limit($blog->content, 100) }}</p>
                            </div>
                        </div>
                    </a>
                @endforeach
            @endif
        </div>
    </div>   
    <!-- Bagian Post Matematika Terbaru -->
    <!--<br><br>
    <div class="container mt-4">
        <h3 class="text-center" style="font-family: 'Poppins', sans-serif;">Post Matematika</h3>
        <br><br>
        <div class="d-flex justify-content-center align-items-center flex-nowrap overflow-auto pb-3" style="gap: 20px;">
            @if($blogs->isEmpty())
                <p class="text-muted">Belum ada artikel tentang Matematika.</p>
            @else
                @foreach($blogs as $blog)
                    <a href="{{ route('blogs.show', $blog->id) }}" class="text-decoration-none text-dark ">
                        <div class="card shadow-sm" style="width: 18rem; border-radius: 15px; overflow: hidden;">
                            @if ($blog->image)
                                <img src="{{ asset('storage/' . $blog->image) }}" alt="Blog Image" class="img-fluid" style="height: 150px; object-fit: cover;">
                            @else
                                <div class="d-flex align-items-center justify-content-center bg-light" style="height: 150px;">
                                    <span class="text-muted">No Preview Image</span>
                                </div>
                            @endif
                            <div class="card-body">
                                <h5 class="fw-bold">{{ $blog->title }}</h5>
                                <p class="text-muted small">Ditulis oleh {{ $blog->user->name }} pada {{ $blog->created_at->format('d M Y') }}</p>
                                <p class="mb-0">{{ Str::limit($blog->content, 100) }}</p>
                            </div>
                        </div>
                    </a>
                @endforeach
            @endif
        </div>
    </div>--> 
</div>

@include('admin.footer')

@endsection

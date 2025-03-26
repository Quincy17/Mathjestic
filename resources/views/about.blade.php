@extends('layouts.app')
@section('content')
@if(Auth::check() && Auth::user()->role === 'murid')
    @include('admin.sidebar-user') 
@else
    @include('admin.sidebar')
@endif
<style>
    .hero-section {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 60px;
        flex-wrap: wrap; /* Memastikan elemen turun jika ruang tidak cukup */
    }

    .wrapper {
        display: flex;
        flex-direction: column;
        min-height: 20vh;
    }
    
    .hero-section div {
        flex: 1; /* Membagi ruang agar seimbang */
        min-width: 300px; /* Membatasi ukuran minimum agar tidak terlalu kecil */
        max-width: 600px; /* Membatasi agar tidak terlalu lebar */
    }

    body{
        height: 100vh;
        background: white;
        color: black;
        font-style: 'Poppins', sans-serif;
        background-attachment: fixed; /* ✅ Background tetap saat scroll */
        background-size: cover; /* ✅ Pastikan mencakup seluruh halaman */
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
        
    @media (max-width: 768px) {
        .hero-section {
            flex-direction: column;
            text-align: center;
        }

        .hero-section div {
            margin-bottom: 20px;
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
</style>
@section('content')
    <div class="container" style="color: black; font-family: 'Poppins', sans-serif;">
        <br><br>
        <h1 style="font-family: 'Poppins', sans-serif;">Tentang Saya</h1>
        <div class="hero-section">
            <!-- Bagian Kiri -->
            <div class="fade-in">
                <img src="{{ asset('storage/home_files/logo2.png') }}" alt="logo.png" width="400" style="margin-right: 40px;">
            </div>
            
            <!-- Bagian Kanan (Foto & Efek Fade) -->
            <div>
                <h1><strong>Visi    </strong></h1>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nam dolor ipsam quibusdam beatae dolores amet sequi quos minima ad assumenda? Impedit, nam! Laudantium ducimus libero quos dolor accusamus perspiciatis laboriosam!
                Blanditiis, dolor. Nobis at, tempore quam ad similique quaerat doloribus facilis suscipit eius quod officiis optio possimus illum nesciunt veniam omnis nihil animi sapiente doloremque in rem impedit ipsa. Velit.
                Voluptas distinctio asperiores quos tempore voluptate dolor aspernatur quidem? Qui itaque debitis tempora molestias numquam quis provident reiciendis inventore, consequatur, eaque quia, dolore modi quam aliquid rem sequi distinctio similique?</p>
            </div>
        </div>
        <div class="hero-section">
            <!-- Bagian Kiri -->
            <div style="margin-top: 100px;">
                <h1><strong>Siapa saya?</strong></h1>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Totam qui nulla corrupti atque cupiditate necessitatibus dignissimos asperiores, vitae obcaecati esse aperiam expedita nesciunt nam optio natus quisquam, impedit beatae aliquid?
                Perferendis deserunt numquam aperiam? A maiores dolore porro, itaque neque culpa! Incidunt consectetur sunt veritatis officia adipisci nobis maiores? Delectus dolorem reprehenderit explicabo voluptate consequatur repellendus commodi quod quasi nostrum!
                Odit explicabo suscipit animi maxime sequi cupiditate quae dolorum, amet magnam rem et nesciunt voluptate dicta velit impedit labore voluptates sunt harum! Iste rem sed accusantium, optio debitis eligendi adipisci.</p>
                <a href="https://wa.me/6282132570837" class="contact-btn">Contact Me</a>
            </div>
    
            <!-- Bagian Kanan (Foto & Efek Fade) -->
            <div class="fade-in">
                <img src="{{ asset('storage/home_files/profile.png') }}" alt="Foto Profil" width="200" style="float: right; margin-right: 40px;">
            </div>
        </div>
    </div>

    <div class="wrapper">
        <main class="content">
            @yield('content')
        </main>
        @include('admin.footer')
    </div>
@endsection

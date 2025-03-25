<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <title>Mathjestic</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600&display=swap" rel="stylesheet">

    <!-- Tambahkan GitHub Flavored Markdown Styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/github-markdown-css/5.1.0/github-markdown-light.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <!-- MathJax -->
    <script>
        window.MathJax = {
            tex: { inlineMath: [['$', '$'], ['\\(', '\\)']] },
            svg: { fontCache: 'global' }
        };
    </script>
    <script async src="https://polyfill.io/v3/polyfill.min.js?features=es6"></script>
    <script async src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>

    <!-- Highlight.js untuk syntax highlighting -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.7.0/styles/github.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.7.0/highlight.min.js"></script>
    <script>hljs.highlightAll();</script>

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <style>
        body {
            padding-top: 70px;
        }

        h2, #judul {
            font-family: 'Poppins', sans-serif;
            font-weight: 600;
        }
        
        #navbar {
            margin-top: 10px;
            background-color: transparent !important; /* Buat transparan */
            box-shadow: none !important; /* Hapus bayangan */
        }

        .nav-item:hover{
            background-color: #3E42B5;
            border-radius: 10%;
        }
        .thumbnail-a:hover {
            background-color: #3E42B5;
            border-radius: 10%;
        }

        .nav-item {
            position: relative;
            z-index: 2; /* Pastikan di atas efek blur */
            margin-right: 20px;
        }

        .nav-item::after {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            backdrop-filter: blur(3px);
            background: rgba(255, 255, 255, 0.2);
            border-radius: 10px;
            z-index: -1;
            opacity: 0;
            transition: opacity 0.3s ease-in-out;
        }

        .nav-item.blur-active::after {
            opacity: 1;
        }


    </style>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm fixed-top" id="navbar">
            <div class="container">
                <a href="{{ route('home') }}" class="nav-item">
                    <img src="{{ asset('storage/home_files/logoo.png') }}" alt="logo.png" width="150" height="50">
                </a>
                    
                </img>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item">
                                <a class="nav-link text-light" style="margin-right: 10px; margin-left:10px;" href="{{ route('latihan-soal.index') }}">Soal</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-light" style="margin-right: 10px; margin-left:10px;" href="{{ route('blogs.index') }}">Blogs</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-light" style="margin-right: 10px;  margin-left:10px;" href="{{ route('about.index') }}">About</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" style=" margin-left:10px;" class="nav-link dropdown-toggle text-light" href="#" role="button" 
                                data-bs-toggle="dropdown" aria-expanded="false">
                                    {{ Auth::user()->name }}
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <li>
                                        <a class="dropdown-item" href="{{ route('profile') }}">
                                            Profile
                                        </a>
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>
                                    </li>
                                </ul>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </li>                        
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        
        <main class="pt-4" >
            @yield('content')
        </main>
    </div>
    
</body>
<script>
    document.addEventListener("DOMContentLoaded", function () {
    const navItems = document.querySelectorAll(".nav-item");

    function checkBlurEffect() {
        navItems.forEach(item => {
            const rect = item.getBoundingClientRect();
            const centerX = rect.left + rect.width / 2;
            const centerY = rect.bottom + 5; // Cek sedikit di bawah item
            
            // Cek elemen yang berada tepat di belakang nav-item
            const elementBehind = document.elementFromPoint(centerX, centerY);

            // Jika elemen bukan body atau html (background kosong), aktifkan blur
            if (elementBehind && !['BODY', 'HTML'].includes(elementBehind.tagName)) {
                item.classList.add("blur-active");
            } else {
                item.classList.remove("blur-active");
            }
        });
    }

    window.addEventListener("scroll", checkBlurEffect);
    window.addEventListener("resize", checkBlurEffect);
    checkBlurEffect(); // Jalankan saat halaman dimuat
});

    </script>
    
</html>

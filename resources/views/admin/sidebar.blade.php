<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    
    <style>
        /* Styling Sidebar */
        .sidebar {
            width: 250px;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            background-color: #3b3737;
            color: white;
            padding: 15px;
            z-index: 1051; /* ✅ Lebih tinggi dari navbar */
        }

        /* Agar konten tidak tertutup sidebar */
        .content {
            margin-top: 10px;
            margin-left: 250px;
            padding: 20px;
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <nav class="sidebar">
        <h4>Admin Panel</h4>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a href="{{ route('soal.index') }}" class="nav-link text-white">Daftar Soal</a>
            </li>
            <li class="nav-item">
                <a href="{{ route('soal.create') }}" class="nav-link text-white">Upload Soal</a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.dataWebsite') }}" class="nav-link text-white">Data Website</a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.logs') }}" class="nav-link text-white">Logs Aktivitas</a>
            </li>
        </ul>
    </nav>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm fixed-top" style="z-index: 1049;">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">OlympiApp</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto">
                    @guest
                        @if (Route::has('login'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">Login</a>
                            </li>
                        @endif
                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">Register</a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                                {{ Auth::user()->name }}
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    Logout
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="content">
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

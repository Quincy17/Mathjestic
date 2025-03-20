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
            background-color: #f3f3f3;
            color: white;
            padding: 15px;
            z-index: 1051; /* ✅ Lebih tinggi dari navbar */
            transition: all 0.3s ease;
        }

        .toggle-btn {
            position: absolute;
            border-radius: 70%;
            top: 10px;
            right: 20px; /* Pindahkan tombol ke luar sidebar */
            background: rgb(255, 255, 255);
            color: rgb(0, 0, 0);
            border: none;
            padding: 8px 12px;
            cursor: pointer;
            transition: right 0.3s ease;
        }

        .sidebar.hidden {
            margin-left: -250px; /* Sembunyikan sidebar */
        }

        .sidebar.hidden .toggle-btn {
            right: -50px; /* Tetap di luar sidebar */
        }

        /* Agar konten tidak tertutup sidebar */
        .content {
            margin-top: 10px;
            margin-left: 250px;
            padding: 20px;
            transition: margin-left 0.3s ease;
        }

        .content.full {
            margin-left: 0;
        }
        
        .sidebar .nav-item {
            border-top: 1px solid rgba(0, 0, 0, 0); /* Garis atas */
            border-bottom: 1px solid rgba(0, 0, 0, 0.2); /* Garis bawah */
        }

        .sidebar .nav-link {
            color: rgb(126, 126, 126) !important; /* Warna teks tetap hitam */
            padding: 10px 15px; /* Tambahkan ruang agar terlihat lebih rapi */
            transition: background-color 0.3s ease-in-out; /* Animasi efek hover */
        }

        .sidebar .nav-link:hover {
            background-color: rgb(51, 50, 50); /* Warna latar belakang saat hover */
            color: white !important; /* Warna teks berubah jadi putih */
        }

        h4, .judul {
            font-family: 'Poppins', sans-serif;
            font-weight: 600;
        }

        .toggle-btn:hover {
            
            transition: all 0.1s ease-in;
        }

    </style>
</head>
<body>
    
    <!-- Sidebar -->
    <nav class="sidebar">
        <button class="toggle-btn" onclick="toggleSidebar()">☰</button>
        <h4 class="text-dark">Admin Panel</h4>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a href="{{ route('home') }}" class="nav-link text-dark">Home</a>
            </li>
            <li class="nav-item">
                <a href="{{ route('soal.index') }}" class="nav-link text-dark">Daftar Modul</a>
            </li>
            <li class="nav-item">
                <a href="{{ route('soal.create') }}" class="nav-link text-dark">Upload Modul</a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.dataWebsite') }}" class="nav-link text-dark">Data Website</a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.logs') }}" class="nav-link text-dark">Log Aktivitas</a>
            </li>
        </ul>
    </nav>

    <script>
        function toggleSidebar() {
            document.querySelector(".sidebar").classList.toggle("hidden");
            document.querySelector(".content").classList.toggle("full");
            document.querySelector(".toggle-btn").classList.toggle("hidden");
        }
    </script>
</body>
</html>

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
        }

        /* Agar konten tidak tertutup sidebar */
        .content {
            margin-top: 10px;
            margin-left: 250px;
            padding: 20px;
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

    </style>
</head>
<body>
    <!-- Sidebar -->
    <nav class="sidebar">
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
                <a href="{{ route('admin.logs') }}" class="nav-link text-dark">Logs Aktivitas</a>
            </li>
        </ul>
    </nav>
</body>
</html>

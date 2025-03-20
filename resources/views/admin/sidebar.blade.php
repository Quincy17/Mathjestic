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
</body>
</html>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="d-flex">
        <!-- Sidebar -->
        <nav class="bg-dark text-white vh-100 p-3" style="width: 250px;">
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

        <!-- Main Content -->
        <div class="p-4" style="flex-grow: 1;">
            @yield('content')
        </div>
    </div>
</body>
</html>

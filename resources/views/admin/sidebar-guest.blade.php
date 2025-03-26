<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/@tabler/icons@latest/icons.min.js"></script>

    <style>
        /* Styling Sidebar */
        .sidebar {
            width: 250px;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            background-color: #ffffff;
            color: white;
            padding: 15px;
            z-index: 1051; /* ✅ Lebih tinggi dari navbar */
            transition: all 0.3s ease;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5); /* Efek bayangan */
        }

        .sidebar .nav-link {
            font-size: 16px; /* Ubah ukuran font sesuai keinginan */
        }

        .sidebar .nav-link svg {
            width: 18px; /* Sesuaikan ukuran ikon */
            height: 18px;
            margin-right: 8px; /* Beri sedikit jarak antara ikon dan teks */
            vertical-align: middle; /* Posisi sejajar */
        }

        #app {
            background: linear-gradient(135deg, #ffffff, #ffffff);
            color: black;
            font-style: 'Poppins', sans-serif;
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

        .sidebar.show {
            margin-left: 0; /* Ditampilkan */
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

        .sidebar .nav-link {
            color: rgb(126, 126, 126) !important; /* Warna teks tetap hitam */
            padding: 10px 15px; /* Tambahkan ruang agar terlihat lebih rapi */
            transition: background-color 0.3s ease-in-out; /* Animasi efek hover */
            border-radius: 5%;
        }

        .sidebar .nav-link:hover {
            background-color: #6268c5; /* Warna latar belakang saat hover */
            color: white !important; /* Warna teks berubah jadi putih */
            border-radius: 5%;
        }

        h4, .judul {
            font-family: 'Poppins', sans-serif;
            font-weight: 600;
        }

        .toggle-btn:hover {
            
            transition: all 0.1s ease-in;
        }

        .sidebar .nav-link.active {
            background-color: #4D55CC !important; /* Latar belakang hitam */
            color: white !important; /* Teks putih */
            font-weight: bold; /* Tebalkan teks */
            border-radius: 5%;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.8); /* Efek bayangan */
        }   

    </style>
</head>
<body onload="hideSidebar()">
    
    <!-- Sidebar -->
    <nav class="sidebar">
        <button class="toggle-btn" style="background-color: #4D55CC; color:#ffffff" onclick="toggleSidebar()">☰</button>
        <h4 class="text-dark">Mathjestic</h4>
        <ul class="nav flex-column">
            <li class="nav-item" style="margin-top: 10px;">
                <a href="{{ route('home') }}" 
                   class="nav-link text-dark {{ request()->routeIs('home') ? 'active' : '' }}" style="margin-bottom: 5px;">
                   <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-home"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 12l-2 0l9 -9l9 9l-2 0" /><path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" /><path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" /></svg>
                   Home
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('blogs.index') }}" 
                   class="nav-link text-dark {{ request()->routeIs('blogs.index') ? 'active' : '' }}" style="margin-bottom: 5px;">
                   <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-message"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M8 9h8" /><path d="M8 13h6" /><path d="M18 4a3 3 0 0 1 3 3v8a3 3 0 0 1 -3 3h-5l-5 3v-3h-2a3 3 0 0 1 -3 -3v-8a3 3 0 0 1 3 -3h12z" /></svg>
                    Blog
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('soal.index') }}" 
                   class="nav-link text-dark {{ request()->routeIs('soal.index') ? 'active' : '' }}" style="margin-bottom: 5px;">
                   <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-book-2"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M19 4v16h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h12z" /><path d="M19 16h-12a2 2 0 0 0 -2 2" /><path d="M9 8h6" /></svg>
                   Daftar Modul
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('latihan_soal.index') }}" 
                   class="nav-link text-dark {{ request()->routeIs('latihan_soal.index') ? 'active' : '' }}" style="margin-bottom: 5px;">
                   <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-file"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M14 3v4a1 1 0 0 0 1 1h4" /><path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z" /></svg>
                   Daftar Soal
                </a>
            </li>
        </ul>
        
    </nav>

    <script>
        function hideSidebar() {
            document.querySelector(".sidebar").classList.add("hidden");
            document.querySelector(".content").classList.add("full");
        }

        function toggleSidebar() {
            document.querySelector(".sidebar").classList.toggle("hidden");
            document.querySelector(".content").classList.toggle("full");
            document.querySelector(".toggle-btn").classList.toggle("hidden");
        }
    </script>
</body>
</html>

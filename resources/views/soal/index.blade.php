@extends('layouts.app')
@section('content')
@if(Auth::check() && Auth::user()->role === 'admin')
    @include('admin.sidebar')  
@else
    @include('admin.sidebar-user')  
@endif

    <style>
        .table {
            border-radius: 10px; /* Sesuaikan radius untuk tingkat kelengkungan */
            overflow: hidden; /* Agar sudut tetap melengkung meskipun ada border */
        }   
        .table th, .table td {
            padding-left: 20px; /* Sesuaikan padding untuk kenyamanan */
        }
    </style>
<div class="container pb-5">
    <br><br>
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Daftar Modul</h2>
        
        <!-- Form Searching -->
        <form action="{{ route('soal.index') }}" method="GET" class="d-flex">
            <input type="text" name="search" class="form-control me-2 " placeholder="Cari soal..." value="{{ request('search') }}">
            <button type="submit" class="btn btn-outline-primary">Cari</button>
        </form>
    </div>

    <!-- Tombol Upload Soal -->
    <div class="d-flex justify-content-between mb-3">
        <div></div> <!-- Agar tombol tetap di kanan -->
        @if(Auth::check() && Auth::user()->role === 'admin')
            <a href="{{ route('soal.create') }}" class="btn btn-primary shadow">Upload Soal</a>
        @endif
    </div>

    <table class="table shadow">
        <thead>
            <tr>
                <th style="max-width: 250px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">Title</th>
                <th>Kategori</th>
                <th>Download</th>
                @if(Auth::check() && Auth::user()->role === 'admin')
                <th>Action</th>
                @endif
            </tr>
        </thead>
        <tbody>
            @forelse ($soals as $soal)
            <tr>
                <td style="max-width: 250px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                    {{ $soal->title }}
                </td>                
                <td>{{ $soal->description }}</td>
                <td><a href="{{ route('soal.download', $soal->soal_id) }}" class="btn btn-outline-primary">Download</a></td>

                @if(Auth::check() && Auth::user()->role === 'admin')
                <td>
                    <!-- Tombol Edit -->
                    <a href="{{ route('soal.edit', $soal->soal_id) }}" class="btn btn-primary btn-sm">Edit</a>
                    <!-- Tombol Delete dengan Form -->
                    <form action="{{ route('soal.destroy', $soal->soal_id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus soal ini?')">Delete</button>
                    </form>
                </td>
                @endif
            </tr>
            @empty
            <tr>
                <td colspan="4" class="text-center">Tidak ada soal ditemukan.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
    <a href="{{ route('home') }}" class="btn btn-primary" style="margin-top: 10px;">Kembali</a>
    <div class="d-flex justify-content-center mt-3" style="float: right; margin-right: 20px;">
        {{ $soals->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection

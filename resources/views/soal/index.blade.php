@extends('layouts.app')
@section('content')
@if(Auth::check() && Auth::user()->role === 'admin')
    @include('admin.sidebar')  
    @endif

<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Daftar Modul</h2>
        
        <!-- Form Searching -->
        <form action="{{ route('soal.index') }}" method="GET" class="d-flex">
            <input type="text" name="search" class="form-control me-2" placeholder="Cari soal..." value="{{ request('search') }}">
            <button type="submit" class="btn btn-outline-primary">Cari</button>
        </form>
    </div>

    <!-- Tombol Upload Soal -->
    <div class="d-flex justify-content-between mb-3">
        <div></div> <!-- Agar tombol tetap di kanan -->
        @if(Auth::check() && Auth::user()->role === 'admin')
            <a href="{{ route('soal.create') }}" class="btn btn-primary">Upload Soal</a>
        @endif
    </div>

    <table class="table">
        <thead>
            <tr>
                <th>Title</th>
                <th>Description</th>
                <th>Download</th>
                @if(Auth::check() && Auth::user()->role === 'admin')
                <th>Action</th>
                @endif
            </tr>
        </thead>
        <tbody>
            @forelse ($soals as $soal)
            <tr>
                <td>{{ $soal->title }}</td>
                <td>{{ $soal->description }}</td>
                <td><a href="{{ asset('storage/soal_files/' . $soal->file_path) }}" download>{{ $soal->original_filename }} Download</a></td>

                @if(Auth::check() && Auth::user()->role === 'admin')
                <td>
                    <!-- Tombol Edit -->
                    <a href="{{ route('soal.edit', $soal) }}" class="btn btn-primary btn-sm">Edit</a>
                    <!-- Tombol Delete dengan Form -->
                    <form action="{{ route('soal.destroy', $soal) }}" method="POST" style="display:inline;">
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
</div>
@endsection

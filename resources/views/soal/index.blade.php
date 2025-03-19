@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Daftar Soal Olimpiade</h2>
     <!-- Tombol Upload Soal di Sebelah Kanan -->
     <div class="d-flex justify-content-between mb-3">
        <div></div> <!-- Untuk membuat tombol tetap di kanan -->
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
            @foreach ($soals as $soal)
            <tr>
                <td>{{ $soal->title }}</td>
                <td>{{ $soal->description }}</td>
                <td><a href="{{ asset('storage/soal_files/' . $soal->file_path) }}" download>{{ $soal->original_filename }}Download</a></td>

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
            @endforeach
        </tbody>
    </table>
</div>
@endsection

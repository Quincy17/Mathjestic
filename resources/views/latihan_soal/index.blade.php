@extends('layouts.app')

@section('content')
@if(Auth::check() && Auth::user()->role === 'murid')
    @include('admin.sidebar-user') 
@else
    @include('admin.sidebar')
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

<div class="container">
    <br>    
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Daftar Latihan Soal</h2>
    <!-- Form Searching -->
            <form action="{{ route('latihan_soal.index') }}" method="GET" class="mb-4">
                <div class="input-group shadow">
                    <input type="text" name="search" class="form-control" placeholder="Cari soal..." value="{{ request('search') }}">
                    <button type="submit" class="btn btn-primary">Cari</button>
                </div>
            </form>
    </div>  

        <!-- Tombol Upload Soal -->
    <div class="d-flex justify-content-between mb-3">
        <div></div> <!-- Agar tombol tetap di kanan -->
        @if(Auth::check() && Auth::user()->role === 'admin')
            <a href="{{ route('latihan_soal.create') }}" class="btn btn-primary">Tambah Soal</a>
        @endif
    </div>

    <table class="table mt-3 shadow">
        <tr>
            <th>Judul</th>
            <th>Soal</th>
            <th>Aksi</th>
        </tr>
        @foreach ($latihanSoal as $soal)
            <tr>
                <td>{{ $soal->judul }}</td>
                <td>{{ Str::limit($soal->soal, 50, '...') }}</td>  {{-- Batasi panjang soal --}}
                @if(Auth::check() && Auth::user()->role === 'admin')
                <td>
                    <a href="{{ route('latihan_soal.show', $soal->id) }}" class="btn btn-outline-primary">Lihat</a>
                    <a href="{{ route('latihan_soal.edit', $soal->id) }}" class="btn btn-outline-success">Edit</a>
                    <form action="{{ route('latihan_soal.destroy', $soal->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-outline-danger" onclick="return confirm('Yakin ingin menghapus soal ini?')">Hapus</button>
                    </form>
                </td>
                @else
                <td>
                    <a href="{{ route('latihan_soal.kerjakan', $soal->id) }}" class="btn btn-outline-primary">Kerjakan</a>
                </td>
                @endif
            </tr>
        @endforeach
    </table>
</div>
@endsection

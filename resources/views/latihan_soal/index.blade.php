@extends('layouts.app')

@section('content')
@if(Auth::check() && Auth::user()->role === 'murid')
    @include('admin.sidebar-user') 
@else
    @include('admin.sidebar')
@endif

<style>
    .table {
        border-radius: 10px;
        overflow: hidden;
    }   
    .table th, .table td {
        padding: 10px 5px 20px 20px;
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
    <div class="d-flex justify-content-between mb-3" style="float:right;">
        @if(Auth::check() && Auth::user()->role === 'admin')
            <div>
                <a href="{{ route('latihan_soal.create') }}" class="btn btn-primary me-2">Tambah Soal</a>
                <a href="{{ route('paket-soal.create') }}" class="btn btn-primary">Buat Paket Soal</a>
            </div>
        @endif
    </div>
    
    <!-- Daftar Paket Soal -->
    <h3>Paket Soal</h3>
    <table class="table mt-3 shadow">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Paket</th>
                <th>Deskripsi</th>
                <th>Jumlah Soal</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($paketSoal as $index => $paket)
            <tr>
                <td>{{ $index + 1 }}</td>   
                <td>{{ $paket->nama_paket }}</td>   
                <td>{{ $paket->deskripsi }}</td>    
                <td>{{ $paket->soal ? $paket->soal->count() : 0 }}</td>
                @if(Auth::check() && Auth::user()->role === 'admin')
                <td>
                    <a href="{{ route('paket-soal.show', $paket->id) }}" class="btn btn-outline-primary">Lihat</a>
                    <a href="{{ route('paket-soal.edit', $paket->id) }}" class="btn btn-outline-success">Edit</a>
                    <form action="{{ route('paket-soal.destroy', $paket->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-outline-danger" onclick="return confirm('Yakin ingin menghapus soal ini?')">Hapus</button>
                    </form>
                </td>
                @else
                <td>
                    <a href="{{ route('paket-soal.kerjakan', $paket->id) }}" class="btn btn-outline-primary">Kerjakan</a>
                </td>
                @endif

            </tr>
            @endforeach
        </tbody>
    </table>
    <br><br>
    <!-- Daftar Soal Individu -->
    @if(Auth::check() && Auth::user()->role === 'admin')
    <h3>Soal Individu</h3>
    <table class="table mt-3 shadow" style="margin-bottom: 10px;">
        <thead>
            <tr>
                <th>Judul</th>
                <th>Deskripsi</th>
                <th>Soal</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($latihanSoal as $soal)
                <tr>
                    <td>{{ $soal->judul }}</td>
                    <td>{{ $soal->deskripsi }}</td>
                    <td>{{ Str::limit($soal->soal, 50, '...') }}</td>
                    
                    <td>
                        <a href="{{ route('latihan_soal.show', $soal->id) }}" class="btn btn-outline-primary">Lihat</a>
                        <a href="{{ route('latihan_soal.edit', $soal->id) }}" class="btn btn-outline-success">Edit</a>
                        <form action="{{ route('latihan_soal.destroy', $soal->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger" onclick="return confirm('Yakin ingin menghapus soal ini?')">Hapus</button>
                        </form>
                    </td>  
                    <!--<td>
                        <a href="{{ route('latihan_soal.kerjakan', $soal->id) }}" class="btn btn-outline-primary">Kerjakan</a>
                    </td>-->
                    
                </tr>
            @endforeach
        </tbody>
    </table>
    @endif
    <!-- Pagination -->
    <div class="d-flex justify-content-center mt-3" style="float: right; margin-right: 20px;">
        {{ $latihanSoal->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection

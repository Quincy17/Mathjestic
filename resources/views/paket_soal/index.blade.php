@extends('layouts.app')

@section('content')
    @if(Auth::check() && Auth::user()->role === 'admin')
        @include('admin.sidebar')  
    @endif
    <style>
        .table th, .table td {
            padding: 10px 5px 20px 20px;
        }
    </style>
    <div class="container">
        <br><br>
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2>Paket Soal</h2>
            <a href="{{ route('paket-soal.create') }}" class="btn btn-primary mb-3">Buat Paket Soal</a>
        </div>
        <table class="table shadow">
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
                            @if(isset($paket->id))
                                <a href="{{ route('paket-soal.show', $paket->id) }}" class="btn btn-outline-primary">Lihat</a>
                            @endif
                            @if(isset($paket->id))
                            <a href="{{ route('paket-soal.edit', $paket->id) }}" class="btn btn-outline-success">Edit</a>
                            @endif
                            @if(isset($paket->id))
                            <form action="{{ route('paket-soal.destroy', $paket->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger" onclick="return confirm('Yakin ingin menghapus soal ini?')">Hapus</button>
                            </form>
                            @endif
                        </td>
                    @endif
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

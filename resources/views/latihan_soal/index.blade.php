@extends('layouts.app')
@section('content')
@if(Auth::check() && Auth::user()->role === 'murid')
    @include('admin.sidebar-user') 
@else
    @include('admin.sidebar')
@endif
<div class="container">
    <h2>Daftar Latihan Soal</h2>
    <a href="{{ route('latihan_soal.create') }}" class="btn btn-primary">Tambah Soal</a>
    <table class="table mt-3">
        <tr>
            <th>Judul</th>
            <th>Soal</th>
            <th>Jawaban</th>
            <th>Aksi</th>
        </tr>
        @foreach($soal as $item)
        <tr>
            <td>{{ $item->judul }}</td>
            <td>{{ $item->soal }}</td>
            <td>{{ $item->jawaban }}</td>
            <td>
                <a href="{{ route('latihan_soal.edit', $item->id) }}" class="btn btn-warning">Edit</a>
                <form action="{{ route('latihan_soal.destroy', $item->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Yakin?')">Hapus</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
</div>
@endsection
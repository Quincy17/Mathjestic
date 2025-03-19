@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Daftar Soal Olimpiade</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Judul</th>
                <th>Deskripsi</th>
                <th>Unduh</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($soals as $soal)
            <tr>
                <td>{{ $soal->title }}</td>
                <td>{{ $soal->description }}</td>
                <td><a href="{{ asset('storage/' . $soal->file_path) }}" download>Unduh</a></td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

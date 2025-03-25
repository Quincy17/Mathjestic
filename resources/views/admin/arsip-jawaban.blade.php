@extends('layouts.app')

@section('content')
    @if(Auth::check() && Auth::user()->role === 'admin')
        @include('admin.sidebar')  
    @endif

    <div class="container">
        <div>
        <br><br>
            <h2>Arsip Jawaban Murid</h2>
            <br>
            <div class="card mb-3" style="padding:20px;">
                <table class="table shadow">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Murid</th>
                            <th>Judul Soal</th>
                            <th>Jawaban</th>
                            <th>Hasil Koreksi</th>
                            <th>Tanggal</th>
                        </tr>
                    </thead>        
                    <tbody>
                        @foreach ($jawabanMurid as $index => $jawaban)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ optional($jawaban->murid)->name ?? 'Tidak Diketahui' }}</td>
                            <td>{{ optional($jawaban->latihanSoal)->judul ?? 'Tidak Diketahui' }}</td>
                            <td>{{ $jawaban->jawaban }}</td>
                            <td>
                                @if($jawaban->status === 'benar')
                                    <span class="badge bg-success">Benar</span>
                                @else
                                    <span class="badge bg-danger">Salah</span>
                                @endif
                            </td>
                            <td>{{ $jawaban->created_at->format('d-m-Y H:i') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

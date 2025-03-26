@extends('layouts.app')

@section('content')
    @if(Auth::check() && Auth::user()->role === 'admin')
        @include('admin.sidebar')  
    @endif

    <div class="container">
        <div>
        <br><br>
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2>Arsip Jawaban Murid</h2>
            <br>
            <form action="{{ route('admin.arsip-jawaban') }}" method="GET" class="mb-3">
                <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Cari jawaban..." value="{{ request('search') }}">
                    <button type="submit" class="btn btn-primary">Cari</button>
                </div>
            </form>
        </div>
            <div class="card mb-3" style="padding:20px;">
                <table class="table shadow">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Murid</th>
                            <th>Judul Soal</th>
                            <th style="max-width: 250px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">Jawaban</th>
                            <th>Hasil Koreksi</th>
                            <th>Tanggal</th>
                            <th>Action</th>
                        </tr>
                    </thead>        
                    <tbody> 
                        @foreach ($jawabanMurid as $index => $jawaban)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ optional($jawaban->murid)->name ?? 'Tidak Diketahui' }}</td>
                            <td>{{ optional($jawaban->latihanSoal)->judul ?? 'Tidak Diketahui' }}</td>
                            <td style="max-width: 250px; max-height:10px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">{{ $jawaban->jawaban }}</td>
                            <td>
                                @if($jawaban->status === 'benar')
                                    <span class="badge bg-success">Benar</span>
                                @else
                                    <span class="badge bg-danger">Salah</span>
                                @endif
                            </td>
                            <td>{{ $jawaban->created_at->format('d-m-Y H:i') }}</td>
                            <td>
                                <a href="{{ route ('latihan_soal.show-jawaban' , $jawaban->id)}}" class="btn btn-outline-primary">Detail</a>
                            </td>    
                        </tr>
                        @endforeach
                    </tbody>
                </table>    
            </div>
        </div>
        <div class="d-flex justify-content-center mt-3" style="float: right; margin-right: 20px;">
            {{ $jawabanMurid->links('pagination::bootstrap-5') }}
        </div>
    </div>
@endsection

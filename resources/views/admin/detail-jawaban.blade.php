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
        <h2>Detail Jawaban - {{ $paketSoal }}</h2>
        <h5>Nama Murid: {{ $murid }}</h5>
        <br>

        <div class="card mb-3" style="padding:20px;">
            <table class="table shadow">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Soal</th>
                        <th>Jawaban Murid</th>
                        <th>Status</th>
                        <th>Poin</th>
                    </tr>
                </thead>        
                <tbody> 
                    @foreach ($jawabanMurid as $index => $jawaban)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ optional($jawaban->latihanSoal)->judul ?? '-' }}</td>
                        <td>{{ $jawaban->jawaban }}</td>
                        <td>{{ ucfirst($jawaban->status) }}</td>
                        <td>{{ $jawaban->poin_didapat }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>    
        </div>

        <a href="{{ route('admin.arsip-jawaban') }}" class="btn btn-primary">Kembali</a>
    </div>
@endsection

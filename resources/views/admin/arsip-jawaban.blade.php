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
            <h2>Arsip Jawaban Murid</h2>
            <form action="{{ route('admin.arsip-jawaban') }}" method="GET" class="mb-3">
                <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Cari murid atau paket..." value="{{ request('search') }}">
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
                        <th>Paket Soal</th>
                        <th>Total Poin</th>
                        <th>Action</th>
                    </tr>
                </thead>        
                <tbody> 
                    @foreach ($arsip as $index => $data)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $data->name }}</td>
                        <td>{{ $data->nama_paket }}</td>
                        <td>{{ $data->jumlah_poin }}</td>
                        <td>
                            <a href="{{ route('admin.detail-jawaban', ['paket_soal_id' => $data->paket_soal_id, 'user_id' => $data->user_id]) }}" 
                                class="btn btn-outline-primary">
                                Detail
                            </a>
                        </td>    
                    </tr>
                    @endforeach
                </tbody>
            </table>    
        </div>

        <div class="d-flex justify-content-center mt-3" style="float: right; margin-right: 20px;">
            {{ $arsip->links('pagination::bootstrap-5') }}
        </div>
    </div>
@endsection

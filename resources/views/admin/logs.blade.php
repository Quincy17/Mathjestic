@extends('layouts.app')
@section('content')
@if(Auth::check() && Auth::user()->role === 'admin')
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

<div class="container pb-5">
    <h2>Activity Control</h2>
    <br>
    <table class="table shadow">
        <thead>
            <tr>
                <th>User</th>
                <th>Aktivitas</th>
                <th>Deskripsi</th>
                <th>Waktu</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($logs as $log)
            <tr>
                <td>{{ $log->user ? $log->user->name : 'Guest' }}</td>
                <td>{{ $log->activity }}</td>
                <td>{{ $log->description }}</td>
                <td>{{ $log->created_at }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="d-flex justify-content-center mt-3" style="float: right; margin-right: 20px;">
        {{ $logs->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection

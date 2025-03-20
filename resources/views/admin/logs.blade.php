@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Monitoring Aktivitas</h2>
    <table class="table">
        <thead>
            <tr>
                <th>User</th>
                <th>Aksi</th>
                <th>Deskripsi</th>
                <th>Waktu</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($logs as $log)
            <tr>
                <td>{{ $log->user->name ?? 'Guest' }}</td>
                <td>{{ $log->action }}</td>
                <td>{{ $log->description }}</td>
                <td>{{ $log->created_at }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

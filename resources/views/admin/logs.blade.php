@extends('layouts.app')
@extends('admin.dashboard')
@section('content')
<div class="container">
    <h2>Activity Control</h2>
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
                <td>{{ $log->user ? $log->user->name : 'Guest' }}</td>
                <td>{{ $log->activity }}</td>
                <td>{{ $log->description }}</td>
                <td>{{ $log->created_at }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

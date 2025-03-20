@extends('layouts.app')
@extends('admin.dashboard')
@section('content')
<h2>Data Website</h2>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Jenis Data</th>
            <th>Jumlah</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>Total Soal</td>
            <td>{{ $totalSoal }}</td>
        </tr>
        <tr>
            <td>Total Aktivitas yang Tercatat</td>
            <td>{{ $totalLogs }}</td>
        </tr>
        <tr>
            <td>Total Unduhan Soal</td>
            <td>{{ $totalUnduhan }}</td>
        </tr>
    </tbody>
</table>
@endsection

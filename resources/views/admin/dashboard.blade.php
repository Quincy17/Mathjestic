@extends('layouts.app')
@section('content')
    @if(Auth::check() && Auth::user()->role === 'admin')
        @include('admin.sidebar')  
    @endif

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<div class="container mt-4">
    <h2 class="mb-4">Admin Dashboard</h2>

    <!-- Statistik -->
    <div class="row">
        <div class="col-md-4">
            <div class="card text-center shadow" style="height: 250px; display: flex; flex-direction: column; justify-content: center; align-items: center;">
                <div class="card-body">
                    <br><br>
                    <h5 class="card-title">Jumlah Modul</h5>
                    <h3>{{ $totalSoal }}</h3>
                    <a href="{{ route('soal.index') }}" class="btn btn-outline-primary">Lihat Detail</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-center shadow" style="height: 250px; display: flex; flex-direction: column; justify-content: center; align-items: center;">
                <div class="card-body">
                    <br><br>
                    <h5 class="card-title">Jumlah Aktivitas</h5>
                    <h3>{{ $totalLogs }}</h3>
                    <a href="{{ route('admin.logs') }}" class="btn btn-outline-danger">Lihat Detail</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-center shadow" style="height: 250px; display: flex; flex-direction: column; justify-content: center; align-items: center;">
                <div class="card-body">
                    <h5 class="card-title">Statistik Upload Soal per Bulan</h5>
                    <canvas id="soalChart" width="300" height="200"></canvas>
                </div>
            </div>
        </div>
    </div>
    


    <!-- Log Aktivitas -->
    <div class="row mt-4">
        <div class="col">
            <div class="card shadow">
                <div class="card-body">
                    <h5 class="card-title">Log Aktivitas</h5>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>User</th>
                                <th>Aktivitas</th>
                                <th>Waktu</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($logs as $log)
                            <tr>
                                <td>{{ $log->user->name }}</td>
                                <td>{{ $log->activity }}</td>
                                <td>{{ $log->created_at }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <a href="{{ route('admin.logs') }}" class="btn btn-outline-secondary">Lihat Semua</a>
                </div>
            </div>
        </div>
    </div>
    <script>
        var ctx = document.getElementById('soalChart').getContext('2d');
        var soalChart = new Chart(ctx, {
            type: 'line', // Gunakan grafik garis
            data: {
                labels: {!! json_encode(array_keys($soalPerBulan->toArray())) !!}, 
                datasets: [{
                    label: 'Jumlah Soal',
                    data: {!! json_encode(array_values($soalPerBulan->toArray())) !!},
                    borderColor: 'rgba(54, 162, 235, 1)',
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderWidth: 2,
                    tension: 0.3
                }]
            },
            options: {
                responsive: false,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</div>



@endsection

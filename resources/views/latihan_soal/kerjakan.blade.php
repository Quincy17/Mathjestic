@extends('layouts.app')

@section('content')
@if(Auth::check() && Auth::user()->role === 'murid')
    @include('admin.sidebar-user') 
@endif

<div class="container">
    <h2>Kerjakan Soal</h2>
    <div class="card mt-3">
        <div class="card-body">
            <h4>{{ $latihanSoal->judul }}</h4>
            <p>{!! $parsedown->text($latihanSoal->soal) !!}</p> {{-- Markdown Support --}}
        </div>
    </div>

    <form action="{{ route('latihan_soal.submit', $latihanSoal->id) }}" method="POST">
        @csrf
        <div class="form-group mt-3">
            <label for="jawaban">Jawaban Anda:</label>
            <textarea name="jawaban" class="form-control" rows="4" required></textarea>
        </div>
        <button type="submit" class="btn btn-outline-primary mt-4">Kirim Jawaban</button>
    </form>
</div>

{{-- MathJax untuk soal matematika --}}
<script>
    window.onload = function () {
        if (window.MathJax) {
            MathJax.typeset();
        }
    };
</script>
@endsection

@extends('layouts.app')
@section('content')
    @if(Auth::check() && Auth::user()->role === 'admin')
        @include('admin.sidebar')  
    @endif

<div class="container">
    <br><br>
    <h2>Paket Soal: {{ $judul }}</h2>
    <form action="{{ route('paket-soal.submit', ['id' => $paket->id]) }}" method="POST">
        @csrf
        @foreach ($soalPaket as $index => $soal)
            <div class="card mb-3 p-3">
                <p><strong>Soal {{ $index + 1 }}:</strong> {!! Str::markdown($soal->soal) !!}</p>
                <textarea name="jawaban_murid[{{ $soal->id }}]" class="form-control" rows="3" required></textarea>
            </div>
        @endforeach
        <button type="submit" class="btn btn-success">Kirim Jawaban</button>
    </form>
</div>
@endsection

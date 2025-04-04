@extends('layouts.app')
@section('content')
    @if(Auth::check() && Auth::user()->role === 'admin')
        @include('admin.sidebar')  
    @endif

<div class="container">
    <br><br>
    <h2>Paket Soal: {{ $judul }}</h2>
    <form action="{{ route('paket-soal.submit', $paket->id) }}" method="POST">
        @csrf
        @foreach($paket->soal as $soal)
            <div class="mb-4">
                <h5>{{ $soal->judul }}</h5>
                <p>{!! $soal->soal !!}</p>
                <input type="text" name="jawaban[{{ $soal->id }}]" class="form-control" placeholder="Jawaban Anda" required>
            </div>
        @endforeach
    
        <button type="submit" class="btn btn-success">Kirim Jawaban</button>
    </form>
    
</div>
@endsection

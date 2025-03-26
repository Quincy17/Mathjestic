@extends('layouts.app')
@section('content')
    @if(Auth::check() && Auth::user()->role === 'admin')
        @include('admin.sidebar')  
    @endif

    <div class="container">
        <h2>Nama Paket: {{ $paket->nama_paket }}</h2>
        <p>{{ $paket->deskripsi }}</p>

        <h4>Soal :</h4>
        @if ($paket->soal->isEmpty())
            <p>Tidak ada soal dalam paket ini.</p>
        @else
            @foreach ($paket->soal as $soal)
                <div class="card mb-3 p-3">
                    <p><strong>Soal:</strong> {!! Str::markdown($soal->soal) !!}</p>
                </div>
            @endforeach
        @endif



        <a href="{{ route('latihan_soal.index') }}" class="btn btn-outline-primary">Kembali</a>
    </div>
    <script>
        MathJax = {
            tex: {inlineMath: [['$', '$'], ['\\(', '\\)']]},
            svg: {fontCache: 'global'}
        };
    </script>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=es6"></script>
    <script id="MathJax-script" async src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>
@endsection

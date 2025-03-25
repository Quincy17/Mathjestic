@extends('layouts.app')

@section('content')
@if(Auth::check() && Auth::user()->role === 'murid')
    @include('admin.sidebar-user') 
@else
    @include('admin.sidebar')
@endif

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-9">
            <br><br>
            <h2 class="mb-3">{{ $latihanSoal->judul }}</h2>

            <div class="card mb-3 shadow-sm p-3">
                <p><strong>Deskripsi:</strong> {!! Str::markdown($latihanSoal->deskripsi) !!}</p>
            </div>

            <div class="card mb-3 shadow-sm p-3">
                <p><strong>Soal:</strong></p>
                <div class="border p-3" id="mathjax-content">
                    {!! Str::markdown($latihanSoal->soal) !!}
                </div>
            </div>

            <div class="card mb-3 shadow-sm p-3">
                <p><strong>Jawaban:</strong></p>
                <div class="border p-3" id="mathjax-content">
                    {!! Str::markdown($latihanSoal->jawaban) !!}
                </div>
            </div>

            <a href="{{ route('latihan_soal.index') }}" class="btn btn-outline-primary">Kembali</a>
        </div>
    </div>
</div>

{{-- Tambahkan MathJax untuk mendukung persamaan matematika --}}
<script>
    MathJax = {
        tex: {inlineMath: [['$', '$'], ['\\(', '\\)']]},
        svg: {fontCache: 'global'}
    };
</script>
<script src="https://polyfill.io/v3/polyfill.min.js?features=es6"></script>
<script id="MathJax-script" async src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>
@endsection

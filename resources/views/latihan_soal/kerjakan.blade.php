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
            <h2>{{ $latihanSoal->judul }}</h2>

            <div class="card p-3 shadow-sm mb-3">
                <p><strong>Deskripsi:</strong> {!! Str::markdown($latihanSoal->deskripsi) !!}</p>
            </div>

            <div class="card p-3 shadow-sm mb-3">
                <p><strong>Soal:</strong></p>
                <div class="border p-3">
                    {!! Str::markdown($latihanSoal->soal) !!}
                </div>
            </div>

            <h4>Jawaban Anda:</h4>
            <form action="{{ route('jawaban_murid.store', $latihanSoal->id) }}" method="POST">
                @csrf
                <div class="mb-3">
                    <textarea name="jawaban" class="form-control" rows="5" required></textarea>
                </div>
                <button type="submit" class="btn btn-success" style="float: right;">Kirim Jawaban</button>
            </form>

            <a href="{{ route('latihan_soal.index') }}" class="btn btn-primary mt-3">Kembali</a>
        </div>
    </div>
</div>

<script>
    MathJax = { tex: {inlineMath: [['$', '$'], ['\\(', '\\)']]}, svg: {fontCache: 'global'} };
</script>
<script src="https://polyfill.io/v3/polyfill.min.js?features=es6"></script>
<script id="MathJax-script" async src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>
@endsection

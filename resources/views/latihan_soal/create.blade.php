@extends('layouts.app')

@section('content')
@if(Auth::check() && Auth::user()->role === 'murid')
    @include('admin.sidebar-user') 
@else
    @include('admin.sidebar')
@endif

<div class="container">
    <h2>Buat Latihan Soal Baru</h2>
    <form action="{{ route('latihan-soal.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="judul" class="form-label">Judul</label>
            <input type="text" class="form-control" id="judul" name="judul" required>
        </div>

        <div class="mb-3">
            <label for="deskripsi" class="form-label">Deskripsi (Markdown)</label>
            <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" required oninput="updatePreview('deskripsi')"></textarea>
            <div class="mt-2 border p-2 bg-light">
                <strong>Preview:</strong>
                <div id="deskripsi-preview" class="p-2"></div>
            </div>
        </div>

        <div class="mb-3">
            <label for="soal" class="form-label">Soal (Markdown & MathJax)</label>
            <textarea class="form-control" id="soal" name="soal" rows="5" required oninput="updatePreview('soal')"></textarea>
            <div class="mt-2 border p-2 bg-light">
                <strong>Preview:</strong>
                <div id="soal-preview" class="p-2"></div>
            </div>
        </div>

        <div class="mb-3">
            <label for="jawaban" class="form-label">Jawaban (Markdown & MathJax)</label>
            <textarea class="form-control" id="jawaban" name="jawaban" rows="5" required oninput="updatePreview('jawaban')"></textarea>
            <div class="mt-2 border p-2 bg-light">
                <strong>Preview:</strong>
                <div id="jawaban-preview" class="p-2"></div>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>

{{-- MathJax & Markdown --}}
<script src="https://polyfill.io/v3/polyfill.min.js?features=es6"></script>
<script id="MathJax-script" async src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>
<script src="https://cdn.jsdelivr.net/npm/marked/marked.min.js"></script>

<script>
    function updatePreview(field) {
        let inputText = document.getElementById(field).value;
        let preview = document.getElementById(field + '-preview');
        preview.innerHTML = marked.parse(inputText);  
        MathJax.typesetPromise([preview]); 
    }
</script>

@endsection

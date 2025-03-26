@extends('layouts.app')

@section('content')
@if(Auth::check() && Auth::user()->role === 'admin')
    @include('admin.sidebar')
@endif

<div class="container">
    <h2>Edit Paket Soal</h2>

    <form action="{{ route('paket-soal.update', $paket->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Nama Paket</label>
            <input type="text" name="nama_paket" class="form-control" value="{{ $paket->nama_paket }}" required>
        </div>

        <div class="mb-3">
            <label>Deskripsi</label>
            <textarea name="deskripsi" class="form-control">{{ $paket->deskripsi }}</textarea>
        </div>

        <!-- Daftar Soal dengan Checkbox -->
        <div class="border p-3 rounded" id="soalList">
            @foreach($soal as $s)
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="soal[]" value="{{ $s->id }}" id="soal-{{ $s->id }}">
                    <label class="form-check-label soal-item" for="soal-{{ $s->id }}">
                        {{ $s->judul }}
                    </label>
                </div>
            @endforeach
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection

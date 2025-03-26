@extends('layouts.app')

@section('content')
@if(Auth::check() && Auth::user()->role === 'admin')
    @include('admin.sidebar')
@endif

<div class="container">
    <br><br>
    <h2>Buat Paket Soal</h2>
    
    <form action="{{ route('paket-soal.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>Nama Paket</label>
            <input type="text" name="nama_paket" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Deskripsi</label>
            <textarea name="deskripsi" class="form-control"></textarea>
        </div>

        <div class="mb-3">
            <label>Pilih Soal</label>
            
            <!-- Input Pencarian -->
            <input type="text" id="searchSoal" class="form-control mb-2" placeholder="Cari soal...">
            
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
        </div>
        
        

        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>

<script>
    document.getElementById("searchSoal").addEventListener("keyup", function() {
        let searchValue = this.value.toLowerCase();
        let soalItems = document.querySelectorAll(".soal-item");

        soalItems.forEach(function(item) {
            let text = item.textContent.toLowerCase();
            let parentDiv = item.closest(".form-check"); // Ambil elemen parent checkbox
            
            if (text.includes(searchValue)) {
                parentDiv.style.display = "";
            } else {
                parentDiv.style.display = "none";
            }
        });
    });
</script>

@endsection

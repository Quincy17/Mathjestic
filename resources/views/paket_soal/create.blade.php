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
                        <input class="form-check-input soal-checkbox" type="checkbox" name="soal[]" value="{{ $s->id }}" id="soal-{{ $s->id }}" data-soal="{{ $s->soal }}">
                        <label class="form-check-label soal-item" for="soal-{{ $s->id }}">
                            {{ $s->judul }}
                        </label>
                        <!-- Input poin, hanya aktif jika soal dicentang -->
                        <input type="number" name="poin[{{ $s->id }}]" class="form-control ms-3 poin-input mt-2 mb-2" style="width: 100px;" min="1" max="100" disabled placeholder="Poin">
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Preview Soal -->
        <div id="previewSoal" class="p-3 border rounded bg-light" style="display: none; margin-top: 10px;">
            <strong>Preview Soal:</strong>
            <p id="soalContent"></p>
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Filter pencarian soal
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

        // Preview soal saat checkbox diklik
        let checkboxes = document.querySelectorAll(".soal-checkbox");
        checkboxes.forEach(checkbox => {
            checkbox.addEventListener("change", function() {
                let previewDiv = document.getElementById("previewSoal");
                let soalContent = document.getElementById("soalContent");
                let poinInput = this.closest(".form-check").querySelector(".poin-input");

                if (this.checked) {
                    soalContent.innerHTML = this.dataset.soal;
                    previewDiv.style.display = "block";
                    poinInput.disabled = false; // Aktifkan input poin
                    poinInput.value = 10; // Default poin
                } else {
                    previewDiv.style.display = "none";
                    poinInput.disabled = true; // Matikan input poin
                    poinInput.value = ""; // Kosongkan
                }
            });
        });
    });
</script>

@endsection

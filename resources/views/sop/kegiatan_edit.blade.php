@extends('layouts.app')

@section('content')

<h5>Edit Kegiatan SOP</h5>

<form action="/sop/{{ $sop->id }}/kegiatan/update" method="POST">
@csrf

<div id="wrapper">

@foreach($sop->kegiatan as $i => $k)

<div class="item border p-3 mb-3">

    <!-- KEGIATAN -->
    <label>Nama Kegiatan</label>

    <textarea
        name="nama_kegiatan[]"
        class="form-control mb-2"
        placeholder="Input Nama Kegiatan">{{ $k->nama_kegiatan }}</textarea>

    <!-- MUTU BAKU -->
    <input type="text"
        name="kelengkapan[]"
        value="{{ $k->kelengkapan }}"
        class="form-control mb-2"
        placeholder="Kelengkapan (opsional)">

    <input type="text"
        name="waktu[]"
        value="{{ $k->waktu }}"
        class="form-control mb-2"
        placeholder="Waktu (opsional)">

    <input type="text"
        name="output[]"
        value="{{ $k->output }}"
        class="form-control mb-2"
        placeholder="Output (opsional)">

    <!-- KETERANGAN -->
    <textarea
        name="keterangan[]"
        class="form-control mb-2"
        placeholder="Keterangan tambahan">{{ $k->keterangan }}</textarea>

    <hr>

    <!-- PELAKSANA -->
    <h6>Pelaksana</h6>

    <select
        name="pelaksana[{{ $i }}][]"
        class="pelaksana-select form-control mb-2"
        multiple>

        @foreach($pelaksana as $p)
            <option value="{{ $p->id }}"
                @if($k->pelaksana->contains($p->id)) selected @endif>
                {{ $p->nama }}
            </option>
        @endforeach

    </select>

    <!-- TIPE -->
    <label>Tipe Flowchart</label>

    <select
        name="tipe[{{ $i }}]"
        class="form-control mb-2"
        required>

        <option value="">-- Pilih Tipe --</option>

        <option value="start"
            @if($k->tipe == 'start') selected @endif>
            🟢 Mulai
        </option>

        <option value="proses"
            @if($k->tipe == 'proses') selected @endif>
            🟦 Proses
        </option>

        <option value="decision"
            @if($k->tipe == 'decision') selected @endif>
            🔶 Decision
        </option>

        <option value="end"
            @if($k->tipe == 'end') selected @endif>
            🔴 Selesai
        </option>

    </select>

    <!-- INFO -->
    <div class="alert alert-success p-2 mt-2"
        style="font-size:12px;">

        🔶 Decision otomatis:<br>

        ✔ YA → lanjut ke langkah berikutnya<br>

        ✔ TIDAK → kembali ke langkah sebelumnya

    </div>

    <button
        type="button"
        onclick="hapus(this)"
        class="btn btn-danger btn-sm mt-2">
        Hapus Kegiatan Ini
    </button>

</div>

@endforeach

</div>

<!-- BUTTON -->
<button
    type="button"
    onclick="tambah()"
    class="btn btn-secondary btn-sm">

    + Tambah Kegiatan

</button>

<button class="btn btn-success btn-sm">
    Update
</button>

</form>

<link href="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/css/tom-select.bootstrap5.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/js/tom-select.complete.min.js"></script>

<script>

let index = {{ $sop->kegiatan->count() }};

// =========================
// INIT TOM SELECT
// =========================
function initPelaksanaSelect(el){
    return new TomSelect(el, {
        plugins: ['remove_button'],
        create: true,
        createOnBlur: true,
        persist: false,
        maxOptions: null,
        placeholder: 'Cari atau pilih pelaksana...'
    });
}

// Init semua select yang udah ada (dari loop kegiatan)
document.querySelectorAll('.pelaksana-select').forEach(initPelaksanaSelect);

// =========================
// TAMBAH FORM
// =========================
function tambah(){

    let wrapper = document.getElementById('wrapper');

    let item = document.querySelector('.item').cloneNode(true);

    // RESET TEXT & TEXTAREA
    item.querySelectorAll('input[type="text"], textarea')
        .forEach(el => el.value = '');

    // BERSIHKAN Tom Select hasil clone
    item.querySelectorAll('.ts-wrapper').forEach(el => el.remove());

    // RESET & rename pelaksana select
    let pelaksanaSelect = item.querySelector('select[name^="pelaksana"]');
    pelaksanaSelect.name = "pelaksana["+index+"][]";
    pelaksanaSelect.querySelectorAll('option').forEach(opt => opt.selected = false);
    pelaksanaSelect.style.display = '';
    pelaksanaSelect.classList.remove('tomselected', 'ts-hidden-accessible');

    // RESET TIPE
    item.querySelectorAll('select[name^="tipe"]').forEach(el => {
        el.name = "tipe["+index+"]";
        el.selectedIndex = 0;
    });

    wrapper.appendChild(item);

    // Init Tom Select di form baru
    initPelaksanaSelect(pelaksanaSelect);

    index++;
}

// =========================
// HAPUS FORM
// =========================
function hapus(btn){
    btn.closest('.item').remove();
}

</script>

@endsection
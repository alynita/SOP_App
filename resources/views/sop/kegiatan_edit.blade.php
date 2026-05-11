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

    @foreach($pelaksana as $p)

        <div>
            <input type="checkbox"
                name="pelaksana[{{ $i }}][]"
                value="{{ $p->id }}"

                @if($k->pelaksana->contains($p->id))
                    checked
                @endif
            >

            {{ $p->nama }}
        </div>

    @endforeach

    <input type="text"
        name="pelaksana_baru[{{ $i }}][]"
        class="form-control mt-2"
        placeholder="Tambah pelaksana baru (pisah koma)">

    <hr>

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

<script>

let index = {{ $sop->kegiatan->count() }};

// =========================
// TAMBAH FORM
// =========================
function tambah(){

    let wrapper =
        document.getElementById('wrapper');

    let item =
        document.querySelector('.item')
        .cloneNode(true);

    // RESET TEXT & TEXTAREA
    item.querySelectorAll(
        'input[type="text"], textarea'
    ).forEach(el => el.value = '');

    // RESET CHECKBOX
    item.querySelectorAll(
        'input[type="checkbox"]'
    ).forEach(el => {

        el.checked = false;

        el.name =
            "pelaksana["+index+"][]";
    });

    // RESET PELAKSANA BARU
    item.querySelectorAll(
        'input[name^="pelaksana_baru"]'
    ).forEach(el => {

        el.value = '';

        el.name =
            "pelaksana_baru["+index+"][]";
    });

    // RESET TIPE
    item.querySelectorAll(
        'select[name^="tipe"]'
    ).forEach(el => {

        el.name =
            "tipe["+index+"]";

        el.selectedIndex = 0;
    });

    wrapper.appendChild(item);

    index++;
}

</script>

@endsection
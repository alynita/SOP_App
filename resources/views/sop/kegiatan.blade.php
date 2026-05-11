@extends('layouts.app')

@section('content')

<h5>Input Kegiatan SOP</h5>

<form action="/sop/{{ $sop->id }}/kegiatan" method="POST">
@csrf

<div id="wrapper">

    <div class="item border p-3 mb-3">

        <!-- KEGIATAN -->
        <label>Nama Kegiatan</label>

        <textarea
            name="nama_kegiatan[]"
            class="form-control mb-2"
            placeholder="Input Nama Kegiatan"></textarea>

        <!-- MUTU BAKU -->
        <input type="text"
            name="kelengkapan[]"
            class="form-control mb-2"
            placeholder="Kelengkapan (opsional)">

        <input type="text"
            name="waktu[]"
            class="form-control mb-2"
            placeholder="Waktu (opsional)">

        <input type="text"
            name="output[]"
            class="form-control mb-2"
            placeholder="Output (opsional)">

        <!-- KETERANGAN -->
        <textarea
            name="keterangan[]"
            class="form-control mb-2"
            placeholder="Keterangan tambahan"></textarea>

        <hr>

        <!-- PELAKSANA -->
        <h6>Pelaksana</h6>

        @foreach($pelaksana as $p)

            <div>
                <input type="checkbox"
                    name="pelaksana[0][]"
                    value="{{ $p->id }}">

                {{ $p->nama }}
            </div>

        @endforeach

        <input type="text"
            name="pelaksana_baru[0][]"
            class="form-control mt-2"
            placeholder="Tambah pelaksana (pisah koma)">

        <hr>

        <!-- TIPE -->
        <label>Tipe Flowchart</label>

        <select
            name="tipe[0]"
            class="form-control mb-2"
            required>

            <option value="">-- Pilih Tipe --</option>

            <option value="start">
                🟢 Mulai
            </option>

            <option value="proses">
                🟦 Proses
            </option>

            <option value="decision">
                🔶 Decision
            </option>

            <option value="end">
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

</div>

<!-- BUTTON -->
<button
    type="button"
    onclick="tambah()"
    class="btn btn-secondary btn-sm">

    + Tambah Kegiatan

</button>

<button class="btn btn-success btn-sm">
    Simpan
</button>

</form>

<script>

let index = 1;

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

    // FIX PELAKSANA BARU
    item.querySelectorAll(
        'input[name^="pelaksana_baru"]'
    ).forEach(el => {

        el.value = '';

        el.name =
            "pelaksana_baru["+index+"][]";
    });

    // FIX TIPE
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
@extends('layouts.app')

@section('content')

<link href="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/css/tom-select.bootstrap5.min.css" rel="stylesheet">

<h5>Input Kegiatan SOP</h5>

<form action="/sop/{{ $sop->id }}/kegiatan" method="POST">
@csrf

<div id="wrapper">

    <div class="item border p-3 mb-3">

        <!-- HEADER + TOMBOL HAPUS -->
        <div class="d-flex justify-content-between align-items-center mb-2">
            <strong>Kegiatan</strong>
        </div>

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

        <select
            name="pelaksana[0][]"
            class="pelaksana-select form-control mb-2"
            multiple>

            @foreach($pelaksana as $p)
                <option value="{{ $p->id }}">{{ $p->nama }}</option>
            @endforeach

        </select>

        <!-- TIPE -->
        <label>Tipe Flowchart</label>

        <select
            name="tipe[0]"
            class="form-control mb-2"
            required>

            <option value="">
                -- Pilih Jenis Kegiatan --
            </option>

            <option value="start">
                🟢 Mulai Proses
            </option>

            <option value="proses">
                🟦 Aktivitas / Proses Kerja
            </option>

            <option value="decision">
                🔶 Pemeriksaan / Percabangan (Ya/Tidak)
            </option>

            <option value="end">
                🔴 Selesai
            </option>

        </select>

        <!-- INFO -->
        <div class="alert alert-info p-2 mt-2"
            style="font-size:12px;">

            <b>Petunjuk Pemilihan:</b><br><br>

            🟢 Mulai Proses → digunakan untuk awal SOP<br>

            🟦 Aktivitas / Proses Kerja → digunakan untuk kegiatan biasa<br>

            🔶 Pemeriksaan / Percabangan → digunakan jika ada kondisi Ya / Tidak<br>

            🔴 Selesai → digunakan untuk akhir SOP

        </div>

        <!-- TOMBOL HAPUS -->
        <button
            type="button"
            onclick="hapus(this)"
            class="btn btn-danger btn-sm hapus-btn mt-2"
            style="display:none;">

            Hapus Kegiatan Ini

        </button>

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

<script src="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/js/tom-select.complete.min.js"></script>

<script>

let index = 1;

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

document.querySelectorAll('.pelaksana-select').forEach(initPelaksanaSelect);

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

    // BERSIHKAN sisa Tom Select hasil clone
    item.querySelectorAll('.ts-wrapper').forEach(el => el.remove());

    let pelaksanaSelect = item.querySelector('select[name^="pelaksana"]');
    pelaksanaSelect.name = "pelaksana["+index+"][]";
    pelaksanaSelect.querySelectorAll('option').forEach(opt => opt.selected = false);
    pelaksanaSelect.style.display = '';
    pelaksanaSelect.classList.remove('tomselected', 'ts-hidden-accessible');

    // RESET TIPE
    item.querySelectorAll(
        'select[name^="tipe"]'
    ).forEach(el => {

        el.name =
            "tipe["+index+"]";

        el.selectedIndex = 0;
    });

    // TAMPILKAN TOMBOL HAPUS pada baris baru
    let hapusBtn = item.querySelector('.hapus-btn');
    hapusBtn.style.display = 'inline-block';

    wrapper.appendChild(item);

    initPelaksanaSelect(pelaksanaSelect);

    index++;
}

// =========================
// HAPUS FORM
// =========================
function hapus(btn){

    let item = btn.closest('.item');

    item.remove();
}

</script>
@endsection
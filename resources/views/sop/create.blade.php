@extends('layouts.app')

@section('content')

<div class="container-box mt-3">

<h5 class="judul">FORM DATA SOP</h5>
<hr>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if($sopLama)
    <div class="alert alert-warning">
        Kamu sedang membuat <b>revisi</b> dari SOP: <b>{{ $sopLama->nama_sop }}</b>
    </div>
@endif

<form action="/sop/store" method="POST">
@csrf

@if($sopLama)
    <input type="hidden" name="sop_induk_id" value="{{ $sopLama->id }}">
@endif

<!-- ================= DATA SOP ================= -->
<table class="table table-bordered">

<tr>
    <td>No SOP</td>
    <td>
        <input type="text" name="no_sop" class="form-control form-control-sm" readonly>
    </td>
</tr>

<tr>
    <td>Nama SOP</td>
    <td>
        <input type="text" name="nama_sop" class="form-control form-control-sm"
               value="{{ $sopLama->nama_sop ?? '' }}" required>
    </td>
</tr>

<tr>
    <td>Tanggal Pembuatan</td>
    <td>
        <input type="date" name="tgl_pembuatan" class="form-control form-control-sm" required>
    </td>
</tr>

<tr>
    <td>Tanggal Revisi</td>
    <td>
        <input type="date" name="tgl_revisi" class="form-control form-control-sm" readonly>
    </td>
</tr>

<tr>
    <td>Tanggal Efektif</td>
    <td>
        <input type="date" name="tgl_efektif" class="form-control form-control-sm" readonly>
    </td>
</tr>

</table>

<hr>

<!-- ================= DASAR HUKUM ================= -->
<h6>Dasar Hukum</h6>
<div id="dasar-hukum">
    @forelse(($sopLama->dasarHukum ?? []) as $index => $d)
        <div class="d-flex mb-2 gap-2">
            <input type="text" name="dasar_hukum[]" value="{{ $d->isi }}" class="form-control form-control-sm" required>
            @if($index > 0)
                <button type="button" class="btn btn-danger btn-sm" onclick="hapusBaris(this)">Hapus</button>
            @endif
        </div>
    @empty
        <input type="text" name="dasar_hukum[]" class="form-control form-control-sm mb-2" placeholder="Isi dasar hukum" required>
    @endforelse
</div>
<button type="button" onclick="tambah('dasar-hukum','dasar_hukum[]')" class="btn btn-secondary btn-sm mb-3">
    + Tambah
</button>

<!-- ================= KUALIFIKASI ================= -->
<h6>Kualifikasi Pelaksana</h6>
<div id="kualifikasi">
    @forelse(($sopLama->kualifikasis ?? []) as $index => $k)
        <div class="d-flex mb-2 gap-2">
            <input type="text" name="kualifikasi[]" value="{{ $k->isi }}" class="form-control form-control-sm" required>
            @if($index > 0)
                <button type="button" class="btn btn-danger btn-sm" onclick="hapusBaris(this)">Hapus</button>
            @endif
        </div>
    @empty
        <input type="text" name="kualifikasi[]" class="form-control form-control-sm mb-2" placeholder="Isi kualifikasi pelaksana" required>
    @endforelse
</div>
<button type="button" onclick="tambah('kualifikasi','kualifikasi[]')" class="btn btn-secondary btn-sm mb-3">
    + Tambah
</button>

<!-- ================= KETERKAITAN ================= -->
<h6>Keterkaitan</h6>
<div id="keterkaitan">
    @forelse(($sopLama->keterkaitans ?? []) as $index => $k)
        <div class="d-flex mb-2 gap-2">
            <input type="text" name="keterkaitan[]" value="{{ $k->isi }}" class="form-control form-control-sm" required>
            @if($index > 0)
                <button type="button" class="btn btn-danger btn-sm" onclick="hapusBaris(this)">Hapus</button>
            @endif
        </div>
    @empty
        <input type="text" name="keterkaitan[]" class="form-control form-control-sm mb-2" placeholder="Isi keterkaitan" required>
    @endforelse
</div>
<button type="button" onclick="tambah('keterkaitan','keterkaitan[]')" class="btn btn-secondary btn-sm mb-3">
    + Tambah
</button>

<!-- ================= PERALATAN ================= -->
<h6>Peralatan</h6>
<div id="peralatan">
    @forelse(($sopLama->peralatans ?? []) as $index => $p)
        <div class="d-flex mb-2 gap-2">
            <input type="text" name="peralatan[]" value="{{ $p->isi }}" class="form-control form-control-sm" required>
            @if($index > 0)
                <button type="button" class="btn btn-danger btn-sm" onclick="hapusBaris(this)">Hapus</button>
            @endif
        </div>
    @empty
        <input type="text" name="peralatan[]" class="form-control form-control-sm mb-2" placeholder="Isi peralatan" required>
    @endforelse
</div>
<button type="button" onclick="tambah('peralatan','peralatan[]')" class="btn btn-secondary btn-sm mb-3">
    + Tambah
</button>

<!-- ================= PERINGATAN ================= -->
<h6>Peringatan</h6>
<div id="peringatan">
    @forelse(($sopLama->peringatans ?? []) as $index => $p)
        <div class="d-flex mb-2 gap-2">
            <input type="text" name="peringatan[]" value="{{ $p->isi }}" class="form-control form-control-sm" required>
            @if($index > 0)
                <button type="button" class="btn btn-danger btn-sm" onclick="hapusBaris(this)">Hapus</button>
            @endif
        </div>
    @empty
        <input type="text" name="peringatan[]" class="form-control form-control-sm mb-2" placeholder="Isi peringatan" required>
    @endforelse
</div>
<button type="button" onclick="tambah('peringatan','peringatan[]')" class="btn btn-secondary btn-sm mb-3">
    + Tambah
</button>

<!-- ================= PENCATATAN ================= -->
<h6>Pencatatan</h6>
<div id="pencatatan">
    @forelse(($sopLama->pencatatans ?? []) as $index => $p)
        <div class="d-flex mb-2 gap-2">
            <input type="text" name="pencatatan[]" value="{{ $p->isi }}" class="form-control form-control-sm" required>
            @if($index > 0)
                <button type="button" class="btn btn-danger btn-sm" onclick="hapusBaris(this)">Hapus</button>
            @endif
        </div>
    @empty
        <input type="text" name="pencatatan[]" class="form-control form-control-sm mb-2" placeholder="Isi pencatatan" required>
    @endforelse
</div>
<button type="button" onclick="tambah('pencatatan','pencatatan[]')" class="btn btn-secondary btn-sm mb-3">
    + Tambah
</button>

<hr>

<button class="btn btn-dark btn-sm">
    Simpan SOP
</button>

</form>

</div>

<script>
function tambah(wrapperId, name) {

    let wrapper = document.getElementById(wrapperId);

    let inputs = wrapper.querySelectorAll('input');

    for (let input of inputs) {
        if (input.value.trim() === '') {
            alert('Isi dulu kolom yang masih kosong!');
            input.focus();
            return;
        }
    }

    let div = document.createElement('div');

    div.classList.add('d-flex', 'mb-2', 'gap-2');

    div.innerHTML = `
        <input type="text"
                name="${name}"
                class="form-control form-control-sm"
                required>

        <button type="button"
                class="btn btn-danger btn-sm"
                onclick="hapusBaris(this)">
            Hapus
        </button>
    `;

    wrapper.appendChild(div);
}

function hapusBaris(button) {
    button.parentElement.remove();
}

document.querySelector('form').addEventListener('submit', function(e){

    let inputs = document.querySelectorAll('input[type="text"]');

    for (let input of inputs) {
        if (input.value.trim() === '') {
            e.preventDefault();
            alert('Semua kolom wajib diisi!');
            input.focus();
            return;
        }
    }

});
</script>

@endsection
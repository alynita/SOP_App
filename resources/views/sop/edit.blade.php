@extends('layouts.app')

@section('content')

<h5 class="mb-3">Edit SOP</h5>

<form action="/sop/{{ $sop->id }}/update" method="POST">
@csrf

<!-- ================= DATA SOP ================= -->
<div class="card mb-3">
<div class="card-body">

<table class="table table-bordered">
<tr>
    <td width="30%">No SOP</td>
    <td><input type="text" name="no_sop" value="{{ $sop->no_sop }}" class="form-control form-control-sm"></td>
</tr>
<tr>
    <td>Nama SOP</td>
    <td><input type="text" name="nama_sop" value="{{ $sop->nama_sop }}" class="form-control form-control-sm"></td>
</tr>
<tr>
    <td>Tanggal Pembuatan</td>
    <td><input type="date" name="tgl_pembuatan" value="{{ $sop->tgl_pembuatan }}" class="form-control form-control-sm"></td>
</tr>
<tr>
    <td>Tanggal Revisi</td>
    <td><input type="date" name="tgl_revisi" value="{{ $sop->tgl_revisi }}" class="form-control form-control-sm"></td>
</tr>
<tr>
    <td>Tanggal Efektif</td>
    <td><input type="date" name="tgl_efektif" value="{{ $sop->tgl_efektif }}" class="form-control form-control-sm"></td>
</tr>
</table>

</div>
</div>

<!-- ================= DASAR HUKUM ================= -->
<div class="card mb-3">
<div class="card-body">
<h6>Dasar Hukum</h6>

<div id="dasar-hukum-wrapper">
@if(($sop->dasarHukum ?? collect())->count() > 0)
    @foreach($sop->dasarHukum as $d)
        <input type="text" name="dasar_hukum[]" value="{{ $d->isi }}" class="form-control form-control-sm mb-2">
    @endforeach
@else
    <input type="text" name="dasar_hukum[]" class="form-control form-control-sm mb-2" placeholder="Isi dasar hukum">
@endif
</div>

<button type="button" onclick="tambahField('dasar-hukum-wrapper','dasar_hukum[]','Isi dasar hukum')" class="btn btn-secondary btn-sm">
+ Tambah
</button>
</div>
</div>

<!-- ================= KUALIFIKASI ================= -->
<div class="card mb-3">
<div class="card-body">
<h6>Kualifikasi Pelaksana</h6>

<div id="kualifikasi-wrapper">
@if(($sop->kualifikasis ?? collect())->count() > 0)
    @foreach($sop->kualifikasis as $k)
        <input type="text" name="kualifikasi[]" value="{{ $k->isi }}" class="form-control form-control-sm mb-2">
    @endforeach
@else
    <input type="text" name="kualifikasi[]" class="form-control form-control-sm mb-2" placeholder="Isi kualifikasi">
@endif
</div>

<button type="button" onclick="tambahField('kualifikasi-wrapper','kualifikasi[]','Isi kualifikasi')" class="btn btn-secondary btn-sm">
+ Tambah
</button>
</div>
</div>

<!-- ================= KETERKAITAN ================= -->
<div class="card mb-3">
<div class="card-body">
<h6>Keterkaitan</h6>

<div id="keterkaitan-wrapper">
@if(($sop->keterkaitans ?? collect())->count() > 0)
    @foreach($sop->keterkaitans as $k)
        <input type="text" name="keterkaitan[]" value="{{ $k->isi }}" class="form-control form-control-sm mb-2">
    @endforeach
@else
    <input type="text" name="keterkaitan[]" class="form-control form-control-sm mb-2" placeholder="Isi keterkaitan">
@endif
</div>

<button type="button" onclick="tambahField('keterkaitan-wrapper','keterkaitan[]','Isi keterkaitan')" class="btn btn-secondary btn-sm">
+ Tambah
</button>
</div>
</div>

<!-- ================= PERALATAN ================= -->
<div class="card mb-3">
<div class="card-body">
<h6>Peralatan</h6>

<div id="peralatan-wrapper">
@if(($sop->peralatans ?? collect())->count() > 0)
    @foreach($sop->peralatans as $p)
        <input type="text" name="peralatan[]" value="{{ $p->isi }}" class="form-control form-control-sm mb-2">
    @endforeach
@else
    <input type="text" name="peralatan[]" class="form-control form-control-sm mb-2" placeholder="Isi peralatan">
@endif
</div>

<button type="button" onclick="tambahField('peralatan-wrapper','peralatan[]','Isi peralatan')" class="btn btn-secondary btn-sm">
+ Tambah
</button>
</div>
</div>

<!-- ================= PERINGATAN ================= -->
<div class="card mb-3">
<div class="card-body">
<h6>Peringatan</h6>

<div id="peringatan-wrapper">
@if(($sop->peringatans ?? collect())->count() > 0)
    @foreach($sop->peringatans as $p)
        <input type="text" name="peringatan[]" value="{{ $p->isi }}" class="form-control form-control-sm mb-2">
    @endforeach
@else
    <input type="text" name="peringatan[]" class="form-control form-control-sm mb-2" placeholder="Isi peringatan">
@endif
</div>

<button type="button" onclick="tambahField('peringatan-wrapper','peringatan[]','Isi peringatan')" class="btn btn-secondary btn-sm">
+ Tambah
</button>
</div>
</div>

<!-- ================= PENCATATAN ================= -->
<div class="card mb-3">
<div class="card-body">
<h6>Pencatatan</h6>

<div id="pencatatan-wrapper">
@if(($sop->pencatatans ?? collect())->count() > 0)
    @foreach($sop->pencatatans as $p)
        <input type="text" name="pencatatan[]" value="{{ $p->isi }}" class="form-control form-control-sm mb-2">
    @endforeach
@else
    <input type="text" name="pencatatan[]" class="form-control form-control-sm mb-2" placeholder="Isi pencatatan">
@endif
</div>

<button type="button" onclick="tambahField('pencatatan-wrapper','pencatatan[]','Isi pencatatan')" class="btn btn-secondary btn-sm">
+ Tambah
</button>
</div>
</div>

<button class="btn btn-primary btn-sm">Update</button>

</form>

<!-- ================= SCRIPT ================= -->
<script>
function tambahField(wrapperId, fieldName, placeholderText) {
    let wrapper = document.getElementById(wrapperId);

    let input = document.createElement('input');
    input.type = 'text';
    input.name = fieldName;
    input.className = 'form-control form-control-sm mb-2';
    input.placeholder = placeholderText;

    wrapper.appendChild(input);
}
</script>

@endsection
@extends('layouts.app')

@section('content')

<div class="container-box mt-3">

<!-- HEADER -->
<div class="text-center mb-3">
    <div style="font-weight:bold;">PEMERINTAH REPUBLIK INDONESIA</div>
    <div>KEMENTERIAN KESEHATAN</div>
    <div>BALAI BESAR PELATIHAN KESEHATAN JAKARTA</div>
</div>

<h5 class="judul">FORM DATA SOP</h5>
<hr>

<form action="/sop/store" method="POST">
@csrf

<table class="table table-bordered">
<tr>
    <td width="30%">No SOP</td>
    <td><input type="text" name="no_sop" class="form-control form-control-sm"></td>
</tr>
<tr>
    <td>Nama SOP</td>
    <td><input type="text" name="nama_sop" class="form-control form-control-sm"></td>
</tr>
<tr>
    <td>Tanggal Pembuatan</td>
    <td><input type="date" name="tgl_pembuatan" class="form-control form-control-sm"></td>
</tr>
<tr>
    <td>Tanggal Revisi</td>
    <td><input type="date" name="tgl_revisi" class="form-control form-control-sm"></td>
</tr>
<tr>
    <td>Tanggal Efektif</td>
    <td><input type="date" name="tgl_efektif" class="form-control form-control-sm"></td>
</tr>
</table>

<button class="btn btn-dark btn-sm">Next</button>

</form>

</div>

@endsection
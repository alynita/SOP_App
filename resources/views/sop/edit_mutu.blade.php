@extends('layouts.app')

@section('content')

<h5>Lengkapi Data SOP</h5>

<form action="/sop/{{ $sop->id }}/update-mutu" method="POST">
@csrf

<div class="mb-3">
    <label>No SOP</label>
    <input type="text"
        name="no_sop"
        class="form-control"
        value="{{ $sop->no_sop }}">
</div>

<div class="mb-3">
    <label>Tanggal Revisi</label>
    <input type="date"
        name="tgl_revisi"
        class="form-control"
        value="{{ $sop->tgl_revisi }}">
</div>

<div class="mb-3">
    <label>Tanggal Efektif</label>
    <input type="date"
        name="tgl_efektif"
        class="form-control"
        value="{{ $sop->tgl_efektif }}">
</div>

<button class="btn btn-success">
    Simpan
</button>

</form>

@endsection
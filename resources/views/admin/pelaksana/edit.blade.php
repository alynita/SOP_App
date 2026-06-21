@extends('layouts.app')

@section('content')

<h5>Edit Pelaksana</h5>

<form action="/admin/pelaksana/{{ $pelaksana->id }}" method="POST">
    @csrf
    @method('PUT')

    <div class="mb-2">
        <label>Nama Pelaksana</label>
        <input type="text" name="nama" class="form-control" value="{{ $pelaksana->nama }}" required>
    </div>

    <button class="btn btn-success btn-sm">Simpan</button>
    <a href="/admin/pelaksana" class="btn btn-secondary btn-sm">Batal</a>

</form>

@endsection
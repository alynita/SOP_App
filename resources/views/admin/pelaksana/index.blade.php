@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-3">
    <h5>Kelola Data Pelaksana</h5>

    <a href="/admin/pelaksana/create" class="btn btn-primary btn-sm">
        + Tambah Pelaksana
    </a>
</div>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

@if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
@endif

<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th style="width:60px;">No</th>
            <th>Nama Pelaksana</th>
            <th style="width:150px;">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @forelse($pelaksana as $p)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $p->nama }}</td>
            <td>
                <a href="/admin/pelaksana/{{ $p->id }}/edit" class="btn btn-sm btn-warning">
                    Edit
                </a>

                <form action="/admin/pelaksana/{{ $p->id }}" method="POST" class="d-inline"
                    onsubmit="return confirm('Hapus pelaksana ini?')">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-sm btn-danger">Hapus</button>
                </form>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="4" class="text-center">Belum ada data pelaksana</td>
        </tr>
        @endforelse
    </tbody>
</table>

@endsection
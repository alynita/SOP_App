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

{{-- SEARCH BAR --}}
<div class="mb-3">
    <input
        type="text"
        id="searchInput"
        class="form-control"
        placeholder="Cari nama pelaksana...">
</div>

<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th style="width:60px;">No</th>
            <th>Nama Pelaksana</th>
            <th style="width:150px;">Aksi</th>
        </tr>
    </thead>
    <tbody id="tableBody">
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

<script>
document.getElementById('searchInput').addEventListener('keyup', function() {
    let keyword = this.value.toLowerCase();
    let rows = document.querySelectorAll('#tableBody tr');

    rows.forEach(row => {
        let nama = row.cells[1]?.textContent.toLowerCase() ?? '';
        row.style.display = nama.includes(keyword) ? '' : 'none';
    });
});
</script>

@endsection
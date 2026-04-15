@extends('layouts.app')

@section('content')

<h5 class="mb-3">Dashboard</h5>

<!-- STATISTIK -->
<div class="row mb-3">
    <div class="col-md-3">
        <div class="card text-center">
            <div class="card-body">
                <h6>Total SOP</h6>
                <h4>{{ $total }}</h4>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card text-center">
            <div class="card-body">
                <h6>SOP Aktif</h6>
                <h4>{{ $aktif }}</h4>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card text-center">
            <div class="card-body">
                <h6>SOP Draft</h6>
                <h4>{{ $draft }}</h4>
            </div>
        </div>
    </div>
</div>

<!-- AKSI CEPAT -->
<div class="mb-3">
    <a href="/" class="btn btn-primary btn-sm">+ Buat SOP</a>
    <a href="/sop" class="btn btn-secondary btn-sm">Data SOP</a>
</div>

<!-- DATA TERBARU -->
<div class="card">
    <div class="card-header">
        SOP Terbaru
    </div>
    <div class="card-body">

        <table class="table table-sm table-bordered">
            <tr>
                <th>No SOP</th>
                <th>Nama SOP</th>
                <th>Tanggal</th>
                <th>Aksi</th>
            </tr>

            @foreach($sops as $s)
            <tr>
                <td>{{ $s->no_sop }}</td>
                <td>{{ $s->nama_sop }}</td>
                <td>{{ $s->tgl_pembuatan }}</td>
                <td>
                    <a href="/sop/{{ $s->id }}" class="btn btn-info btn-sm">Lihat</a>
                </td>
            </tr>
            @endforeach

        </table>

    </div>
</div>

@endsection
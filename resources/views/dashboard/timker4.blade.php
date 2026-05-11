@extends('layouts.app')

@section('content')

<h5 class="mb-3">Dashboard Penjamin Mutu (Timker 4)</h5>

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
        <div class="card text-center bg-warning">
            <div class="card-body">
                <h6>Menunggu Approval</h6>
                <h4>{{ $menunggu }}</h4>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card text-center bg-success">
            <div class="card-body">
                <h6>Disetujui</h6>
                <h4>{{ $disetujui }}</h4>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card text-center bg-danger">
            <div class="card-body">
                <h6>Ditolak</h6>
                <h4>{{ $ditolak }}</h4>
            </div>
        </div>
    </div>

</div>

<!-- DATA SOP MASUK -->
<div class="card">
    <div class="card-header">
        SOP Menunggu Persetujuan
    </div>

    <div class="card-body">

        <table class="table table-bordered table-sm">
            <tr>
                <th>No SOP</th>
                <th>Nama SOP</th>
                <th>Tanggal</th>
                <th>Pengirim</th>
                <th>Aksi</th>
            </tr>

            @foreach($sopMasuk as $s)
            <tr>
                <td>{{ $s->no_sop }}</td>
                <td>{{ $s->nama_sop }}</td>
                <td>{{ $s->tgl_pembuatan }}</td>
                <td>Timker {{ $s->timker_id }}</td>

                <td>
                    <a href="/sop/{{ $s->id }}" class="btn btn-info btn-sm">Lihat</a>

                    <!-- APPROVE -->
                    <form action="/sop/{{ $s->id }}/approve" method="POST" style="display:inline;">
                        @csrf
                        <button class="btn btn-success btn-sm">Approve</button>
                    </form>

                    <!-- REJECT -->
                    <form action="/sop/{{ $s->id }}/reject" method="POST" style="display:inline;">
                        @csrf
                        <button class="btn btn-danger btn-sm">Tolak</button>
                    </form>
                </td>
            </tr>
            @endforeach

        </table>

    </div>
</div>

@endsection
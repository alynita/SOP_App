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
                <td>
                    Timker {{ $s->timker_id }}

                    <br>

                    @if($s->status == 'disetujui')
                        <span class="text-success">✔ Approved</span>
                    @elseif($s->status == 'ditolak')
                        <span class="text-danger">✖ Rejected</span>
                    @else
                        <span class="text-warning">⏳ Pending</span>
                    @endif

                    @if($s->timker_approved_at)
                        <br>
                        <small>{{ $s->timker_approved_at }}</small>
                    @endif
                </td>

                <td>
                    <a href="/sop/{{ $s->id }}" class="btn btn-info btn-sm">Lihat</a>

                    <!-- APPROVE -->
                    <form action="/sop/{{ $s->id }}/approve" method="POST" style="display:inline;">
                        @csrf
                        <button class="btn btn-success btn-sm">Approve</button>
                    </form>

                    <!-- REJECT -->
                    <button
                        type="button"
                        class="btn btn-danger btn-sm"
                        onclick="showReject({{ $s->id }})">

                        Tolak

                    </button>

                    <!-- FORM REJECT -->
                    <div id="reject-form-{{ $s->id }}"
                        style="display:none; margin-top:5px;">

                        <form action="/sop/{{ $s->id }}/reject"
                            method="POST">

                            @csrf

                            <textarea
                                name="catatan_revisi"
                                class="form-control mb-2"
                                placeholder="Catatan revisi..."
                                required></textarea>

                            <button class="btn btn-danger btn-sm">
                                Simpan Penolakan
                            </button>

                        </form>

                    </div>
                </td>
            </tr>
            @endforeach

        </table>

    </div>
</div>

<script>

function showReject(id){

    document.getElementById(
        'reject-form-' + id
    ).style.display = 'block';

}

</script>

@endsection
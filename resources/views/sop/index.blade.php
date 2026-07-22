@extends('layouts.app')

@section('content')

<h5>Data SOP</h5>

<form method="GET" action="/sop" class="mb-2">
    <input type="text" name="search" placeholder="Cari SOP..." class="form-control form-control-sm" style="width:200px; display:inline;">
    <button class="btn btn-secondary btn-sm">Cari</button>
</form>

<table class="table table-bordered table-sm">
    <tr>
        <th>No</th>
        <th>No SOP</th>
        <th>Tanggal Pembuatan</th>
        <th>Nama SOP</th>
        <th>Aksi</th>
    </tr>

    @foreach($sops as $sop)
    <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $sop->no_sop }}</td>
        <td>{{ $sop->tgl_pembuatan }}</td>
        <td>{{ $sop->nama_sop }}</td>
        <td>
            <a href="/sop/{{ $sop->id }}"
            class="btn btn-info btn-sm">
                Detail
            </a>

            @if($sop->status === 'disahkan')
                <a href="/sop/{{ $sop->id }}/revisi"
                class="btn btn-warning btn-sm">
                    Revisi
                </a>
            @endif

            <a href="/sop/{{ $sop->id }}/pdf"
            class="btn btn-success btn-sm">
                PDF
            </a>

            <a href="/sop/{{ $sop->id }}/delete"
            class="btn btn-danger btn-sm">
                Hapus
            </a>
        </td>
    </tr>
    @endforeach

</table>

@endsection
@extends('layouts.app')

@section('content')

<h5>Proses SOP</h5>

<table class="table table-bordered table-sm">

    <tr>
        <th>No</th>
        <th>Nama SOP</th>
        <th>Status</th>
        <th>Aksi</th>
    </tr>

    @foreach($sops as $sop)

    <tr>

        <td>{{ $loop->iteration }}</td>

        <td>{{ $sop->nama_sop }}</td>

        <td>
            @if($sop->status == 'draft')
                <span class="badge bg-secondary">Draft</span>
            @elseif($sop->status == 'diajukan')
                <span class="badge bg-warning">Diajukan</span>
            @elseif($sop->status == 'disetujui')
                <span class="badge bg-success">Disetujui</span>
            @elseif($sop->status == 'ditolak')
                <span class="badge bg-danger">Ditolak</span>
            @endif
        </td>

        <!-- INI YANG KURANG -->
        <td>

            <a href="/sop/{{ $sop->id }}" class="btn btn-info btn-sm">Detail</a>

            <a href="/sop/{{ $sop->id }}/kegiatan/edit"
            class="btn btn-warning btn-sm">
                Edit
            </a>

            @if($sop->status == 'draft' || $sop->status == 'ditolak')

            <form action="/sop/{{ $sop->id }}/submit"
                method="POST"
                style="display:inline;">
                @csrf

                <button class="btn btn-success btn-sm">
                    Ajukan
                </button>

            </form>

            @endif

        </td>

    </tr>

    @endforeach

</table>

@endsection
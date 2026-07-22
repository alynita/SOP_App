@extends('layouts.app')

@section('content')

<h5>Dokumen Kadaluarsa</h5>
<p class="text-muted">SOP yang sudah pernah disahkan, namun telah digantikan oleh versi revisi terbaru.</p>

<table class="table table-bordered table-sm">
    <tr>
        <th>No</th>
        <th>No SOP</th>
        <th>Nama SOP</th>
        <th>Digantikan Oleh</th>
        <th>Aksi</th>
    </tr>

    @foreach($sops as $sop)
    <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $sop->no_sop }}</td>
        <td>{{ $sop->nama_sop }}</td>
        <td>
            @if($sop->sopRevisi)
                <a href="/sop/{{ $sop->sopRevisi->id }}">{{ $sop->sopRevisi->no_sop }}</a>
            @else
                -
            @endif
        </td>
        <td>
            <a href="/sop/{{ $sop->id }}" class="btn btn-info btn-sm">Detail</a>
            <a href="/sop/{{ $sop->id }}/pdf" class="btn btn-success btn-sm">PDF</a>
        </td>
    </tr>
    @endforeach

</table>

@endsection
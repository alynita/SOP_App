@extends('layouts.app')

@section('content')

<h4 class="mb-3">Arsip SOP Disetujui</h4>

<div class="card">
    <div class="card-body">

        <table class="table table-bordered">
            <tr>
                <th>No SOP</th>
                <th>Nama SOP</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>

            @foreach($arsip as $s)
            <tr>
                <td>{{ $s->no_sop }}</td>
                <td>{{ $s->nama_sop }}</td>
                <td>
                    <span class="badge bg-success">
                        Disetujui
                    </span>
                </td>
                <td>
                    <a href="/sop/{{ $s->id }}"
                       class="btn btn-info btn-sm">
                        Lihat
                    </a>
                </td>
            </tr>
            @endforeach

        </table>

    </div>
</div>

@endsection
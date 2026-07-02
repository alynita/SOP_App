@extends('layouts.app')

@section('content')

<h5>SOP Revisi</h5>

<table class="table table-bordered">
    <tr>
        <th>No SOP</th>
        <th>Nama SOP</th>
        <th>Pengaju</th>
        <th>Catatan Revisi</th>
        <th>Aksi</th>
    </tr>

    @foreach($sop as $s)
    <tr>
        <td>{{ $s->no_sop }}</td>
        <td>{{ $s->nama_sop }}</td>
        <td>{{ $s->user->name ?? '-' }}</td>
        <td>{{ $s->catatan_revisi }}</td>

        <td>
            {{-- LOCK EDIT --}}
            @if($s->is_editing_by && $s->is_editing_by !== auth()->user()->role)
                <button class="btn btn-secondary" disabled>
                    Sedang diedit
                </button>
            @else
                <a href="/sop/{{ $s->id }}/edit" class="btn btn-primary">
                    Edit
                </a>
            @endif

            {{-- LIHAT DETAIL --}}
            <a href="/sop/{{ $s->id }}"
                class="btn btn-info btn-sm">
                Lihat
            </a>
        </td>
    </tr>
    @endforeach

</table>

@endsection
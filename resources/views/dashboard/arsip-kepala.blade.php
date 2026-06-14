@extends('layouts.app')

@section('content')

<h4 class="mb-4">
    Arsip SOP Disahkan
</h4>

<div class="card shadow-sm border-0">

    <div class="card-body">

        <table class="table table-bordered table-hover">

            <tr class="table-light">

                <th>No SOP</th>
                <th>Nama SOP</th>
                <th>Status</th>
                <th>Tanggal Disahkan</th>
                <th>Aksi</th>

            </tr>

            @forelse($sops as $s)

            <tr>

                <td>{{ $s->no_sop }}</td>

                <td>{{ $s->nama_sop }}</td>

                <td>
                    <span class="badge bg-success">
                        Disahkan
                    </span>
                </td>

                <td>
                    {{ $s->updated_at }}
                </td>

                <td>

                    <a href="/sop/{{ $s->id }}"
                        class="btn btn-primary btn-sm">

                        Detail

                    </a>

                </td>

            </tr>

            @empty

            <tr>

                <td colspan="5"
                    class="text-center">

                    Belum ada SOP yang disahkan

                </td>

            </tr>

            @endforelse

        </table>

    </div>

</div>

@endsection
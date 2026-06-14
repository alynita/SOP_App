@extends('layouts.app')

@section('content')

<h4 class="mb-4">
    Persetujuan SOP Kepala BBPK
</h4>

<div class="card">

    <div class="card-body">

        <table class="table table-bordered">

            <tr>
                <th>No SOP</th>
                <th>Nama SOP</th>
                <th>Pengusul</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>

            @forelse($sops as $s)

            <tr>

                <td>{{ $s->no_sop }}</td>

                <td>{{ $s->nama_sop }}</td>

                <td>
                    {{ str_replace('timker','Timker ', $s->user->role) }}
                </td>

                <td>
                    <span class="badge bg-success">
                        Diverifikasi PM
                    </span>
                </td>

                <td>

                    <a href="/sop/{{ $s->id }}"
                        class="btn btn-info btn-sm">
                        Detail
                    </a>

                    <form action="/kepala/sop/{{ $s->id }}/approve"
                        method="POST"
                        style="display:inline">

                        @csrf

                        <button class="btn btn-success btn-sm">
                            E-TTD
                        </button>

                    </form>

                </td>

            </tr>

            @empty

            <tr>

                <td colspan="5"
                    class="text-center">

                    Belum ada SOP yang menunggu pengesahan

                </td>

            </tr>

            @endforelse

        </table>

    </div>

</div>

@endsection
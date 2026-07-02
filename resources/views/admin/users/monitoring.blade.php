@extends('layouts.app')

@section('content')

<h4 class="mb-4">
    Monitoring SOP
</h4>

<!-- FILTER -->
<form method="GET"
    action="/admin/monitoring"
    class="row mb-4">

    <!-- STATUS -->
    <div class="col-md-3">

        <select
            name="status"
            class="form-control">

            <option value="">
                Semua Status
            </option>

            <option value="draft">
                Draft
            </option>

            <option value="diajukan">
                Diajukan
            </option>

            <option value="disetujui">
                Disetujui
            </option>

            <option value="ditolak">
                Ditolak
            </option>

            <option value="disahkan">
                Disahkan
            </option>

        </select>

    </div>

    <!-- TIMKER -->
    <div class="col-md-3">

        <select
            name="timker"
            class="form-control">

            <option value="">
                Semua Timker
            </option>

            <option value="1">Timker 1</option>
            <option value="2">Timker 2</option>
            <option value="3">Timker 3</option>
            <option value="4">Timker 4</option>
            <option value="5">Timker 5</option>
            <option value="6">Timker 6</option>

        </select>

    </div>

    <!-- BUTTON -->
    <div class="col-md-2">

        <button class="btn btn-success">
            Filter
        </button>

    </div>

</form>

<!-- TABEL -->
<div class="card shadow-sm border-0">

    <div class="card-body">

        <table class="table table-bordered table-hover">

            <tr class="table-light">

                <th>No SOP</th>

                <th>Nama SOP</th>

                <th>Timker</th>

                <th>Status</th>

                <th>Tanggal</th>

                <th>Aksi</th>

            </tr>

            @forelse($sops as $s)

            <tr>

                <td>{{ $s->no_sop }}</td>

                <td>{{ $s->nama_sop }}</td>

                <td>
                    {{ $s->user->name }}
                </td>

                <td>
                    @if($s->status == 'draft')

                        <span class="badge bg-success">
                            draft
                        </span>

                    @elseif($s->status == 'disetujui')

                        <span class="badge bg-success">
                            Disetujui
                        </span>

                    @elseif($s->status == 'ditolak')

                        <span class="badge bg-danger">
                            Ditolak
                        </span>

                    @elseif($s->status == 'disahkan')

                        <span class="badge bg-warning text-dark">
                            Disahkan
                        </span>

                    @else

                        <span class="badge bg-warning text-dark">
                            Disahkan
                        </span>

                    @endif

                </td>

                <td>
                    {{ $s->created_at }}
                </td>

                <td>

                    <a href="/sop/{{ $s->id }}"
                        class="btn btn-info btn-sm">

                        Detail

                    </a>

                </td>

            </tr>

            @empty

            <tr>

                <td colspan="6"
                    class="text-center">

                    Belum ada data SOP

                </td>

            </tr>

            @endforelse

        </table>

    </div>

</div>

@endsection
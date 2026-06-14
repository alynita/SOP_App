@extends('layouts.app')

@section('content')

<h4 class="mb-4">
    Dashboard Kepala BBPK
</h4>

<div class="row">

    <div class="col-md-4 mb-3">
        <div class="card shadow-sm border-0 text-center">

            <div class="card-body">

                <div style="font-size:35px;">
                    📝
                </div>

                <h6 class="mt-2">
                    Menunggu Pengesahan
                </h6>

                <h3>
                    {{ $menunggu }}
                </h3>

            </div>

        </div>
    </div>

    <div class="col-md-4 mb-3">
        <div class="card shadow-sm border-0 text-center bg-success text-white">

            <div class="card-body">

                <div style="font-size:35px;">
                    ✅
                </div>

                <h6 class="mt-2">
                    SOP Disahkan
                </h6>

                <h3>
                    {{ $disahkan }}
                </h3>

            </div>

        </div>
    </div>

    <div class="col-md-4 mb-3">
        <div class="card shadow-sm border-0 text-center">

            <div class="card-body">

                <div style="font-size:35px;">
                    📄
                </div>

                <h6 class="mt-2">
                    Total SOP
                </h6>

                <h3>
                    {{ $totalSop }}
                </h3>

            </div>

        </div>
    </div>

</div>

<div class="card shadow-sm border-0 mt-4">

    <div class="card-header bg-white">

        <b>
            SOP Menunggu Pengesahan
        </b>

    </div>

    <div class="card-body">

        <table class="table table-bordered">

            <tr class="table-light">

                <th>No SOP</th>
                <th>Nama SOP</th>
                <th>Status</th>
                <th>Aksi</th>

            </tr>

            @forelse($sops as $s)

            <tr>

                <td>{{ $s->no_sop }}</td>

                <td>{{ $s->nama_sop }}</td>

                <td>
                    <span class="badge bg-warning text-dark">
                        Menunggu Pengesahan
                    </span>
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

                <td colspan="4"
                    class="text-center">

                    Tidak ada SOP yang menunggu pengesahan

                </td>

            </tr>

            @endforelse

        </table>

    </div>

</div>

<div class="mt-4">

    <a href="/kepala/persetujuan"
        class="btn btn-success">

        ✍️ Persetujuan SOP

    </a>

    <a href="/kepala/arsip"
        class="btn btn-secondary">

        🗂 Arsip SOP

    </a>

</div>

@endsection
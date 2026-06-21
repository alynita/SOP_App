@extends('layouts.app')

@section('content')

<h4 class="mb-4">Dashboard Administrator</h4>

<!-- ================= STATISTIK ================= -->
<div class="row">

    <div class="col-md-3 mb-3">
        <div class="card shadow-sm border-0 text-center">
            <div class="card-body">
                <div style="font-size:35px;">👥</div>

                <h6 class="mt-2">Total User</h6>

                <h3>{{ $totalUser }}</h3>
            </div>
        </div>
    </div>

    <div class="col-md-3 mb-3">
        <div class="card shadow-sm border-0 text-center">
            <div class="card-body">
                <div style="font-size:35px;">📄</div>

                <h6 class="mt-2">Total SOP</h6>

                <h3>{{ $totalSop }}</h3>
            </div>
        </div>
    </div>

    <div class="col-md-3 mb-3">
        <div class="card shadow-sm border-0 text-center bg-success text-white">
            <div class="card-body">
                <div style="font-size:35px;">✔</div>

                <h6 class="mt-2">Disetujui</h6>

                <h3>{{ $disetujui }}</h3>
            </div>
        </div>
    </div>

    <div class="col-md-3 mb-3">
        <div class="card shadow-sm border-0 text-center bg-danger text-white">
            <div class="card-body">
                <div style="font-size:35px;">✖</div>

                <h6 class="mt-2">Ditolak</h6>

                <h3>{{ $ditolak }}</h3>
            </div>
        </div>
    </div>

    <div class="col-md-3 mb-3">
        <div class="card shadow-sm border-0 text-center bg-success text-white">
            <div class="card-body">
                <div style="font-size:35px;">✔</div>

                <h6 class="mt-2">Disahkan</h6>

                <h3>{{ $disahkan }}</h3>
            </div>
        </div>
    </div>

</div>

<!-- ================= GRAFIK ================= -->
<div class="card shadow-sm border-0 mt-4">

    <div class="card-header bg-white">
        <b>📊 Grafik Status SOP</b>
    </div>

    <div class="card-body">

        <canvas id="chartSop" height="90"></canvas>

    </div>

</div>

<!-- ================= AKTIVITAS TERBARU ================= -->
<div class="card shadow-sm border-0 mt-4">

    <div class="card-header bg-white">
        <b>🕒 Aktivitas SOP Terbaru</b>
    </div>

    <div class="card-body">

        <table class="table table-bordered table-hover">

            <tr class="table-light">
                <th>No SOP</th>
                <th>Nama SOP</th>
                <th>Timker</th>
                <th>Status</th>
                <th>Tanggal</th>
            </tr>

            @forelse($sops as $s)

            <tr>

                <td>{{ $s->no_sop }}</td>

                <td>{{ $s->nama_sop }}</td>

                <td>Timker {{ $s->timker_id }}</td>

                <td>

                    @if($s->status == 'disetujui')

                        <span class="badge bg-success">
                            Disetujui
                        </span>

                    @elseif($s->status == 'ditolak')

                        <span class="badge bg-danger">
                            Ditolak
                        </span>

                    @elseif($s->status == 'disahkan')

                        <span class="badge bg-success">
                            Disahkan
                        </span>
                    

                    @else

                        <span class="badge bg-warning text-dark">
                            Diajukan
                        </span>

                    @endif

                </td>

                <td>{{ $s->created_at }}</td>

            </tr>

            @empty

            <tr>
                <td colspan="5" class="text-center">
                    Belum ada data SOP
                </td>
            </tr>

            @endforelse

        </table>

    </div>

</div>

<!-- ================= QUICK INFO ================= -->
<div class="row mt-4">

    <div class="col-md-6 mb-3">

        <div class="card border-0 shadow-sm h-100">

            <div class="card-header bg-white">
                <b>📌 Informasi Sistem</b>
            </div>

            <div class="card-body">

                <p class="mb-2">
                    Total SOP aktif dalam sistem:
                    <b>{{ $totalSop }}</b>
                </p>

                <p class="mb-2">
                    Total user terdaftar:
                    <b>{{ $totalUser }}</b>
                </p>

                <p class="mb-2">
                    Total Pelaksana:
                    <b>{{ $totalPelaksana }}</b>
                </p>

                <p class="mb-0">
                    SOP yang sudah diverifikasi:
                    <b>{{ $disahkan }}</b>
                </p>

            </div>

        </div>

    </div>

    <div class="col-md-6 mb-3">

        <div class="card border-0 shadow-sm h-100">

            <div class="card-header bg-white">
                <b>⚡ Quick Menu</b>
            </div>

            <div class="card-body">

                <a href="/admin/users"
                    class="btn btn-outline-success btn-sm mb-2">

                    👥 Kelola User

                </a>

                <br>

                <a href="/admin/pelaksana"
                    class="btn btn-outline-success btn-sm mb-2">

                    🧑‍💼 Data Pelaksana

                </a>

                <br>

                <a href="/admin/monitoring"
                    class="btn btn-outline-primary btn-sm mb-2">

                    📊 Monitoring SOP

                </a>

                <br>

                <a href="/sop"
                    class="btn btn-outline-dark btn-sm">

                    📄 Lihat Semua SOP

                </a>

            </div>

        </div>

    </div>

</div>

<!-- ================= CHART JS ================= -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>

const ctx =
    document.getElementById('chartSop');

new Chart(ctx, {

    type: 'bar',

    data: {

        labels: [
            'Diajukan',
            'Disetujui',
            'Ditolak',
            'Disahkan'
        ],

        datasets: [{

            label: 'Jumlah SOP',

            data: [
                {{ $diajukan }},
                {{ $disetujui }},
                {{ $ditolak }},
                {{ $disahkan }}
            ],

            borderWidth: 1

        }]
    },

    options: {

        responsive: true,

        plugins: {

            legend: {
                display: false
            }

        }

    }

});

</script>

@endsection
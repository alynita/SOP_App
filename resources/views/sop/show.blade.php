@extends('layouts.app')

@section('content')

<style>
    .sop-table td, .sop-table th {
        border: 1px solid black;
        padding: 5px;
        vertical-align: top;
        font-size: 12px;
    }

    /* CELL BIAR RAPI */
    .flow-cell {
        position: relative;
        height: 100px;
        text-align: center;
        vertical-align: middle;
    }

    /* KOTAK PROSES */
    .flow.proses {
        width: 60px;
        height: 30px;
        border: 2px solid black;
        position: absolute;
        top: 10px;
        left: 50%;
        transform: translateX(-50%);
    }

    /* DIAMOND */
    .flow.decision {
        width: 40px;
        height: 40px;
        border: 2px solid black;
        transform: rotate(45deg) translateX(-50%);
        position: absolute;
        top: 10px;
        left: 50%;
    }

    /* GARIS KE BAWAH */
    .line-v {
        position: absolute;
        top: 45px;
        left: 50%;
        width: 2px;
        height: 55px;
        background: black;
    }

    /* GARIS KE KANAN */
    .line-h {
        position: absolute;
        top: 25px;
        left: 50%;
        width: 50%;
        height: 2px;
        background: black;
    }

    /* PANAH BAWAH */
    .arrow-down::after {
        content: "";
        position: absolute;
        top: 95px;
        left: calc(50% - 4px);
        border: 5px solid transparent;
        border-top-color: black;
    }

    /* TEXT YA/TIDAK */
    .label-flow {
        position: absolute;
        font-size: 10px;
    }

    .label-ya {
        top: 50px;
        left: 55%;
    }

    .label-tidak {
        top: 25px;
        right: 5px;
    }
    </style>

<div class="card">
<div class="card-body">

<table class="sop-table w-100">

    <tr>
        <!-- KIRI -->
        <td width="60%" style="text-align:center;">
            <br><br>
            <b>KEMENTERIAN KESEHATAN REPUBLIK INDONESIA</b><br>
            SEKRETARIAT JENDERAL<br>
            BALAI BESAR PELATIHAN KESEHATAN JAKARTA
        </td>

        <!-- KANAN -->
        <td width="40%">
            <table class="w-100">
                <tr>
                    <td>Nomor SOP</td>
                    <td>: {{ $sop->no_sop }}</td>
                </tr>
                <tr>
                    <td>Tgl. Pembuatan</td>
                    <td>: {{ $sop->tgl_pembuatan }}</td>
                </tr>
                <tr>
                    <td>Tgl. Revisi</td>
                    <td>: {{ $sop->tgl_revisi }}</td>
                </tr>
                <tr>
                    <td>Tgl. Efektif</td>
                    <td>: {{ $sop->tgl_efektif }}</td>
                </tr>

                <tr>
                    <td>Disahkan oleh</td>
                    <td>: </td>
                </tr>
                <tr>
                    <td colspan="2" class="text-center">
                        Kepala BBPK Jakarta
                        <br><br><br><br>
                        <b>{{ $sop->disahkan_oleh }}</b><br>
                        NIP. ....................
                    </td>
                </tr>

                <tr>
                    <td>Nama SOP</td>
                    <td>: {{ $sop->nama_sop }}</td>
                </tr>
            </table>
        </td>
    </tr>

</table>

<br>

<table class="sop-table w-100">

    <tr>
        <td>
            <b>Dasar Hukum</b>
            <ol>
                @foreach($sop->dasarHukum ?? [] as $d)
                    <li>{{ $d->isi }}</li>
                @endforeach
            </ol>
        </td>

        <td>
            <b>Kualifikasi Pelaksana</b>
            <ol>
                @foreach($sop->kualifikasis ?? [] as $k)
                    <li>{{ $k->isi }}</li>
                @endforeach
            </ol>
        </td>
    </tr>

    <tr>
        <td>
            <b>Keterkaitan</b>
            <ol>
                @foreach($sop->keterkaitans ?? [] as $k)
                    <li>{{ $k->isi }}</li>
                @endforeach
            </ol>
        </td>

        <td>
            <b>Peralatan</b>
            <ol>
                @foreach($sop->peralatans ?? [] as $p)
                    <li>{{ $p->isi }}</li>
                @endforeach
            </ol>
        </td>
    </tr>

    <tr>
        <td>
            <b>Peringatan</b>
            <ol>
                @foreach($sop->peringatans ?? [] as $p)
                    <li>{{ $p->isi }}</li>
                @endforeach
            </ol>
        </td>

        <td>
            <b>Pencatatan</b>
            <ol>
                @foreach($sop->pencatatans ?? [] as $p)
                    <li>{{ $p->isi }}</li>
                @endforeach
            </ol>
        </td>
    </tr>

</table>

<table class="table table-bordered">

<tr>
    <th rowspan="2">No</th>
    <th rowspan="2">Kegiatan</th>

    <th colspan="{{ count($pelaksanas) }}">Pelaksana</th>

    <th colspan="3">Mutu Baku</th>

    <th rowspan="2">Keterangan</th>
</tr>

<tr>
    @foreach($pelaksanas as $p)
        <th>{{ $p->nama }}</th>
    @endforeach

    <th>Kelengkapan</th>
    <th>Waktu</th>
    <th>Output</th>
</tr>

@foreach($sop->kegiatan as $k)
<tr>
    <td>{{ $k->no_urutan }}</td>
    <td>{{ $k->nama_kegiatan }}</td>

    @foreach($pelaksanas as $p)
    <td class="flow-cell">

    @if($k->pelaksana->contains($p->id))

        {{-- PROSES --}}
        @if($k->tipe == 'proses')
            <div class="flow proses"></div>

            @if(!$loop->parent->last)
                <div class="line-v"></div>
            @endif

            @if(!$loop->last)
                <div class="line-h"></div>
            @endif

        {{-- DECISION --}}
        @elseif($k->tipe == 'decision')

            <div class="flow decision"></div>

            {{-- YA (turun) --}}
            <div class="label-flow label-ya">YA</div>
            <div class="line-v arrow-down"></div>

            {{-- TIDAK (kanan) --}}
            <div class="label-flow label-tidak">TIDAK →</div>
            <div class="line-h"></div>

        @endif

    @endif

    </td>
    @endforeach

    <td>{{ $k->kelengkapan }}</td>
    <td>{{ $k->waktu }}</td>
    <td>{{ $k->output }}</td>
    <td>{{ $k->keterangan }}</td>
</tr>
@endforeach

</table>

</div>
</div>

@endsection
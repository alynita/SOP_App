@extends('layouts.app')

@section('content')

<style>
.sop-table td, .sop-table th {
    border: 1px solid black;
    padding: 5px;
    vertical-align: top;
    font-size: 12px;
}

.flow-cell {
    position: relative;
    height: 180px;
    text-align: center;
}

.flow.proses {
    width: 60px;
    height: 30px;
    border: 2px solid black;
    position: absolute;
    top: 40px;
    left: 50%;
    transform: translateX(-50%);
    background: white;
}

.flow.start, .flow.end {
    border-radius: 20px;
    line-height: 30px;
    font-size: 10px;
}

.flow.decision {
    width: 40px;
    height: 40px;
    border: 2px solid black;
    transform: translate(-50%, 0) rotate(45deg);
    position: absolute;
    top: 40px;
    left: 50%;
    background: white;
}

th {
    text-align: center;
    vertical-align: middle;
}

.leader-line {
    z-index: 9999 !important;
}

#flow-table td {
    min-width: 200px; /* 🔥 bikin kolom lebih lebar */
}
</style>

<div class="card">
    <div class="card-body">
        
    <div class="card">
        <div class="card-body">
            
        <table class="sop-table w-100">
            <tr>
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
    
    <br>
    
    <div id="flow-wrapper">
        
    <table class="table table-bordered">
        <thead>
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
        </thead>
        
        <tbody>
            @foreach($sop->kegiatan as $k)
            <tr>
                <td>{{ $k->no_urutan }}</td>
                <td>{{ $k->nama_kegiatan }}</td>
                
                @foreach($pelaksanas as $p)
                <td class="flow-cell">
                    
                @if($k->pelaksana->contains($p->id))
                @php $nodeId = "node-{$k->id}-{$p->id}"; @endphp
                
                @if($k->tipe == 'start')
                <div id="{{ $nodeId }}" class="flow proses start">Mulai</div>

                @elseif($k->tipe == 'end')
                <div id="{{ $nodeId }}" class="flow proses end">Selesai</div>

                @elseif($k->tipe == 'decision')
                <div id="{{ $nodeId }}" class="flow decision"></div>

                @else
                <div id="{{ $nodeId }}" class="flow proses"></div>
                @endif
                
                @endif
            </td>
            @endforeach

<td>{{ $k->kelengkapan }}</td>
<td>{{ $k->waktu }}</td>
<td>{{ $k->output }}</td>
<td>{{ $k->keterangan ?? '-' }}</td>

</tr>
@endforeach
</tbody>

</table>
</div>

</div>
</div>

{{-- ================= LEADERLINE ================= --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/leader-line/1.0.7/leader-line.min.js"></script>

<script>
window.addEventListener("load", function () {

    function createMidPoint(x, y) {
        let el = document.createElement('div');
        el.style.position = 'absolute';
        el.style.left = x + 'px';
        el.style.top = y + 'px';
        el.style.width = '1px';
        el.style.height = '1px';
        document.body.appendChild(el);
        return el;
    }

let kegiatanNodes = {};
let kegiatanFirstNode = {};

/* ===============================
   SIMPAN SEMUA NODE PER KEGIATAN
=============================== */
@foreach($sop->kegiatan as $k)
kegiatanNodes[{{ $k->id }}] = [
    @foreach($k->pelaksana as $p)
    document.getElementById("node-{{ $k->id }}-{{ $p->id }}"),
    @endforeach
].filter(n => n);

kegiatanFirstNode[{{ $k->id }}] = kegiatanNodes[{{ $k->id }}][0] ?? null;
@endforeach


/* ===============================
   FLOW NORMAL ANTAR KEGIATAN
=============================== */
@foreach($sop->kegiatan as $index => $k)

@if($k->tipe != 'decision' && isset($sop->kegiatan[$index+1]))
if(kegiatanFirstNode[{{ $k->id }}] && kegiatanFirstNode[{{ $sop->kegiatan[$index+1]->id }}]){
    new LeaderLine(
        kegiatanFirstNode[{{ $k->id }}],
        kegiatanFirstNode[{{ $sop->kegiatan[$index+1]->id }}],
        {
            color: 'black',
            size: 2,
            path: 'grid',
            startSocket: 'bottom',
            endSocket: 'top',
            endPlug: 'arrow'
        }
    );
}
@endif

@endforeach


/* ===============================
   MULTI PELAKSANA (KIRI-KANAN)
=============================== */
Object.values(kegiatanNodes).forEach(row => {

    if (row.length > 1) {

        for (let i = 0; i < row.length; i++) {
            for (let j = i + 1; j < row.length; j++) {

                let a = row[i];
                let b = row[j];

                if(a && b){

                    // A → B
                    new LeaderLine(a, b, {
                        color: 'black',
                        size: 2,
                        path: 'straight',
                        startSocket: 'right',
                        endSocket: 'left',
                        startSocketGravity: -30,
                        endSocketGravity: -30,
                        endPlug: 'arrow'
                    });

                    // B → A
                    new LeaderLine(b, a, {
                        color: 'black',
                        size: 2,
                        path: 'straight',
                        startSocket: 'left',
                        endSocket: 'right',
                        startSocketGravity: 30,
                        endSocketGravity: 30,
                        endPlug: 'arrow'
                    });

                }
            }
        }

    }

});


/* ===============================
   DECISION YA / TIDAK
=============================== */
@foreach($sop->kegiatan as $k)

@if($k->tipe == 'decision')

let decisionNode{{ $k->id }} = kegiatanFirstNode[{{ $k->id }}];

@if($k->next_yes)
let yesTarget{{ $k->id }} = kegiatanFirstNode[{{ $k->next_yes }}];

if(decisionNode{{ $k->id }} && yesTarget{{ $k->id }}){

    new LeaderLine(
        decisionNode{{ $k->id }},
        yesTarget{{ $k->id }},
        {
            color: 'black',
            size: 2,
            path: 'grid',
            startSocket: 'right',   // 👉 selalu ke kanan
            endSocket: 'top',
            endPlug: 'arrow',
            middleLabel: LeaderLine.captionLabel('Ya')
        }
    );
}
@endif


@if($k->next_no)
let noTarget{{ $k->id }} = kegiatanFirstNode[{{ $k->next_no }}];

if(decisionNode{{ $k->id }} && noTarget{{ $k->id }}){

    new LeaderLine(
        decisionNode{{ $k->id }},
        noTarget{{ $k->id }},
        {
            color: 'red', // 🔥 sementara biar keliatan
            size: 2,
            path: 'grid',
            startSocket: 'left',
            endSocket: 'top', // 🔥 ganti ini
            startSocketGravity: [-200, 0],
            endSocketGravity: [0, -30],
            endPlug: 'arrow',
            middleLabel: LeaderLine.captionLabel('Tidak')
        }
    );
}
@endif

@endif

@endforeach
});
</script>

@endsection
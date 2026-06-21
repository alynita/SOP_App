@extends('layouts.app')

@section('content')

<style>
    body{
        font-family: Arial, sans-serif;
        font-size: 12px;
    }

    .sop-table td, .sop-table th {
        border: 1px solid black;
        padding: 5px;
        font-size: 12px;
    }

    .flow-cell{
        position: relative;

        width: 140px;
        min-width: 140px;

        height: 120px;

        text-align:center;
        vertical-align:middle;
    }

    .flow-node{
        position:absolute;
        top:50%;
        left:50%;

        transform:translate(-50%, -50%);

        z-index:20;

        background:white;

        overflow:hidden;
    }

    /* PROCESS */
    .flow-process{
        width:70px;
        min-height:40px;

        border:2px solid black;
        border-radius:6px;

        padding:4px;
    }

    /* START END */
    .flow-start,
    .flow-end{
        width:80px;
        min-height:35px;

        border:2px solid black;
        border-radius:25px;

        padding:4px;
    }

    /* DECISION */
    .flow-decision{
        width:50px;
        height:50px;

        border:2px solid black;

        transform:
            translate(-50%, -50%)
            rotate(45deg);

        background:white;
    }

    /* SVG */
    #flow-wrapper{
        position:relative;
        overflow:auto;
        padding:40px;
    }

    #flow-svg{
        position:absolute;
        top:0;
        left:0;
        width:100%;
        height:100%;
        pointer-events:none;
        z-index:5;
    }

    #flow-table{
        table-layout: fixed;
        min-width: max-content;
    }

</style>

<div class="card">
    <div class="card-body">
        
    <div class="card">
        <div class="card-body">
            
        <table class="sop-table w-100">
            <tr>
                <td width="60%" style="text-align:center;">

                    <img src="{{ asset('logo.png') }}"
                        width="150"
                        class="mb-2">

                    <br>

                    <b>KEMENTERIAN KESEHATAN </b><br>
                    SEKRETARIAT JENDERAL<br>
                    PUSAT PENGEMBANGAN KOMPETENSI APARATUR (P2KA) <br>
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

                        <!-- ================= TIMKER 4 ================= -->
                        <tr>
                            <td>Disetujui</td>
                            <td>:</td>
                        </tr>

                        <tr>
                            <td colspan="2" class="text-center">

                                Penjaminan Mutu

                                <br><br>

                                @if($sop->status == 'disetujui' || $sop->status == 'disahkan')

                                    <img
                                        src="{{ asset('ttd-pm.jpg') }}"
                                        width="120">

                                    <br>

                                    <b>{{ $sop->timker_approved_by ?? '-' }}</b>

                                    <br>

                                    <small>
                                        {{ $sop->timker_approved_at ?? '-' }}
                                    </small>

                                @else

                                    <br><br>

                                    <em style="color:red;">
                                        Menunggu persetujuan Timker 4
                                    </em>

                                @endif

                            </td>
                        </tr>

                        <tr>
                            <td>Disahkan oleh</td>
                            <td>:</td>
                        </tr>

                        <tr>
                            <td colspan="2" class="text-center">

                                Kepala BBPK Jakarta

                                <br><br>

                                @if($sop->status == 'disahkan')

                                    <img
                                        src="{{ asset('ttd-kepala.jpg') }}"
                                        width="120">

                                    <br>

                                    <b>{{ $sop->disahkan_oleh }}</b>

                                    <br>

                                    NIP. {{ $sop->nip_pengesah }}

                                @else

                                    <br><br>

                                    <span style="color:red;">
                                        Menunggu Pengesahan
                                    </span>

                                @endif

                            </td>
                        </tr>

                        <!-- ================= NAMA SOP ================= -->
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
    
    @if($sop->kegiatan->count() > 0)

    <br>

    <div id="flow-wrapper" style="position:relative;">

    <svg id="flow-svg" 
        style="
            position:absolute;
            top:0;
            left:0;
            width:100%;
            height:100%;
            min-height:800px;
            pointer-events:none;
        ">
    </svg>

    <table id="flow-table" class="table table-bordered">
        <thead>
            <tr>
                <th rowspan="2" style="width:50px;">No</th>
                <th rowspan="2" style="width:350px;">Kegiatan</th>

                <th colspan="{{ count($pelaksanas) }}">Pelaksana</th>

                <th colspan="3">Mutu Baku</th>

                <th rowspan="2">Keterangan</th>
            </tr>
            
            <tr>
                @php
                    $urutanPelaksana = [];

                    foreach($sop->kegiatan as $k){

                        foreach($k->pelaksana as $p){

                            if(!collect($urutanPelaksana)->contains('id', $p->id)){

                                $urutanPelaksana[] = $p;

                            }
                        }
                    }
                @endphp

                @foreach($urutanPelaksana as $p)
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
                <td style="
                    min-width:350px;
                    width:350px;
                    white-space:normal;
                ">
                    {{ $k->nama_kegiatan }}
                </td>
                
                @foreach($urutanPelaksana as $p)
                <td class="flow-cell">
                    
                @if($k->pelaksana->contains($p->id))
                @php $nodeId = "node-{$k->id}-{$p->id}"; @endphp
                
                @if($k->tipe == 'start')
                <div id="{{ $nodeId }}" class="flow-node flow-start"></div>

                @elseif($k->tipe == 'end')
                <div id="{{ $nodeId }}" class="flow-node flow-end"></div>

                @elseif($k->tipe == 'decision')
                <div id="{{ $nodeId }}" class="flow-node flow-decision"></div>

                @else
                <div id="{{ $nodeId }}" class="flow-node flow-process"></div>
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
@endif

</div>
</div>

<script>

window.addEventListener("load", () => {

    const svg = document.getElementById("flow-svg");
    const wrapper = document.getElementById("flow-wrapper");

    const GAP = 6;

    // JARAK LOOP
    const LOOP_OFFSET = 180;

    // =========================
    // GET NODE
    // =========================
    function getNode(id){
        return document.querySelector(`[id^="node-${id}-"]`);
    }

    // =========================
    // CLEAR SVG
    // =========================
    function clearSvg(){
        svg.innerHTML = '';
    }

    // =========================
    // RESIZE SVG
    // =========================
    function resizeSvg(){

        svg.setAttribute(
            "width",
            wrapper.scrollWidth
        );

        svg.setAttribute(
            "height",
            wrapper.scrollHeight
        );

        svg.style.width =
            wrapper.scrollWidth + 'px';

        svg.style.height =
            wrapper.scrollHeight + 'px';
    }

    // =========================
    // SVG DEFS
    // =========================
    function createDefs(){

        const defs = document.createElementNS("http://www.w3.org/2000/svg", "defs");

        // marker hitam (Ya)
        const marker = document.createElementNS("http://www.w3.org/2000/svg", "marker");
        marker.setAttribute("id", "arrow");
        marker.setAttribute("markerWidth", "6");
        marker.setAttribute("markerHeight", "6");
        marker.setAttribute("refX", "5");
        marker.setAttribute("refY", "3");
        marker.setAttribute("orient", "auto");
        marker.setAttribute("markerUnits", "strokeWidth");

        const arrow = document.createElementNS("http://www.w3.org/2000/svg", "path");
        arrow.setAttribute("d", "M0,0 L0,6 L6,3 z");
        arrow.setAttribute("fill", "#000");

        marker.appendChild(arrow);
        defs.appendChild(marker);

        // marker merah (Tidak)
        const markerRed = document.createElementNS("http://www.w3.org/2000/svg", "marker");
        markerRed.setAttribute("id", "arrow-red");
        markerRed.setAttribute("markerWidth", "6");
        markerRed.setAttribute("markerHeight", "6");
        markerRed.setAttribute("refX", "5");
        markerRed.setAttribute("refY", "3");
        markerRed.setAttribute("orient", "auto");
        markerRed.setAttribute("markerUnits", "strokeWidth");

        const arrowRed = document.createElementNS("http://www.w3.org/2000/svg", "path");
        arrowRed.setAttribute("d", "M0,0 L0,6 L6,3 z");
        arrowRed.setAttribute("fill", "red");

        markerRed.appendChild(arrowRed);
        defs.appendChild(markerRed);

        // append defs ke svg setelah semua marker siap
        svg.appendChild(defs);
    }
    // =========================
    // GET RECT
    // =========================
    function getRect(el){

        const parent =
            wrapper.getBoundingClientRect();

        const rect =
            el.getBoundingClientRect();

        return {

            left:
                rect.left - parent.left,

            right:
                rect.right - parent.left,

            top:
                rect.top - parent.top,

            bottom:
                rect.bottom - parent.top,

            centerX:
                rect.left +
                rect.width / 2 -
                parent.left,

            centerY:
                rect.top +
                rect.height / 2 -
                parent.top
        };
    }

    // =========================
    // CREATE PATH
    // =========================
    function createPath(d, color = '#000'){

        const path = document.createElementNS("http://www.w3.org/2000/svg", "path");

        path.setAttribute("d", d);
        path.setAttribute("fill", "none");
        path.setAttribute("stroke", color);
        path.setAttribute("stroke-width", "1");
        path.setAttribute("stroke-linecap", "round");
        path.setAttribute("stroke-linejoin", "round");
        path.setAttribute("marker-end", color === 'red' ? "url(#arrow-red)" : "url(#arrow)");

        svg.appendChild(path);
    }

    // =========================
    // CREATE LABEL
    // =========================
    function createLabel(x, y, text, color = '#000'){

        const label = document.createElementNS("http://www.w3.org/2000/svg", "text");

        label.setAttribute("x", x);
        label.setAttribute("y", y);
        label.setAttribute("font-size", "8");
        label.setAttribute("font-family", "Arial");
        label.setAttribute("font-weight", "600");
        label.setAttribute("fill", color);
        label.textContent = text;

        svg.appendChild(label);
    }

    // =========================
    // PANAH BOLAK BALIK
    // =========================
    function drawTwoWay(from, to){

        if(!from || !to) return;

        const a = getRect(from);
        const b = getRect(to);

        const y = a.centerY;

        // KE KANAN
        const path1 = `
            M ${a.right} ${y - 8}
            L ${b.left} ${y - 8}
        `;

        createPath(path1);

        // KE KIRI
        const path2 = `
            M ${b.left} ${y + 8}
            L ${a.right} ${y + 8}
        `;

        createPath(path2);
    }

    // =========================
    // FLOW NORMAL
    // =========================
    function drawNormal(from, to){

        if(!from || !to) return;

        const a = getRect(from);
        const b = getRect(to);

        // =====================================
        // TITIK AWAL & AKHIR
        // =====================================

        const startX = a.centerX;
        const startY = a.bottom;

        const endX = b.centerX;
        const endY = b.top;

        // =====================================
        // MID AREA
        // =====================================

        const midY = startY + (
            (endY - startY) / 2
        );

        // =====================================
        // PATH
        // =====================================

        const d = `
            M ${startX} ${startY}

            L ${startX} ${midY}

            L ${endX} ${midY}

            L ${endX} ${endY}
        `;

        createPath(d);
    }

    // =========================
    // DECISION YES
    // =========================
    function drawYes(from, to){

        if(!from || !to) return;

        const a = getRect(from);
        const b = getRect(to);

        const x1 = a.centerX;
        const y1 = a.bottom - GAP;

        const x2 = b.centerX;
        const y2 = b.top + GAP;

        const midY = (y1 + y2) / 2;

        const d = `
            M ${x1} ${y1}
            L ${x1} ${midY}
            L ${x2} ${midY}
            L ${x2} ${y2}
        `;

        createPath(d);

        createLabel(
            x1 + 10,
            y1 + 15,
            'Ya'
        );
    }

    // =========================
    // DECISION NO SMART
    // =========================
    function drawNo(from, to){

        if(!from || !to) return;

        const a = getRect(from);
        const b = getRect(to);

        const startY = a.centerY;
        const endY = b.centerY;

        const targetIsLeft =
            b.centerX < a.centerX;

        let d = '';

        // posisi tulisan
        let labelX = 0;
        let labelY = startY - 10;

        // =====================================
        // LOOP KIRI
        // =====================================

        if(targetIsLeft){

            const startX = a.left;
            const endX = b.right;

            // keluar lebih jauh
            const loopX = startX - 60;

            d = `
                M ${startX} ${startY}

                L ${loopX} ${startY}

                L ${loopX} ${endY}

                L ${endX} ${endY}
            `;

            // tulisan ikut ke kiri
            labelX = loopX - 40;
        }

        // =====================================
        // LOOP KANAN
        // =====================================

        else{

            const startX = a.right;
            const endX = b.left;

            // keluar lebih jauh
            const loopX = startX + 60;

            d = `
                M ${startX} ${startY}

                L ${loopX} ${startY}

                L ${loopX} ${endY}

                L ${endX} ${endY}
            `;

            // tulisan ikut ke kanan
            labelX = loopX + 10;
        }

        createPath(d, 'red');

        createLabel(labelX, labelY, 'Tidak', 'red');
    }

    // =========================
    // RENDER
    // =========================
    function render(){

        clearSvg();

        resizeSvg();

        createDefs();

        // =========================
        // ANTAR PELAKSANA
        // =========================
        @foreach($sop->kegiatan as $k)

            @if($k->pelaksana->count() > 1)

                @php
                    $pel = $k->pelaksana->values();
                @endphp

                drawTwoWay(
                    document.querySelector(
                        '#node-{{ $k->id }}-{{ $pel[0]->id }}'
                    ),
                    document.querySelector(
                        '#node-{{ $k->id }}-{{ $pel[1]->id }}'
                    )
                );

            @endif

        @endforeach

        // =========================
        // FLOW NORMAL
        // =========================
        @foreach($sop->kegiatan as $index => $k)

            @if($index < count($sop->kegiatan)-1)

                @php
                    $next =
                    $sop->kegiatan[$index+1];
                @endphp

                @if($k->tipe != 'decision')

                    drawNormal(
                        getNode({{ $k->id }}),
                        getNode({{ $next->id }})
                    );

                @endif

            @endif

        @endforeach

        // =========================
        // FLOW DECISION
        // =========================
        @foreach($sop->kegiatan as $index => $k)

            @if($k->tipe == 'decision')

                @php
                    $next = $sop->kegiatan[$index + 1] ?? null;
                    $prev = $sop->kegiatan[$index - 1] ?? null;
                @endphp

                const decision{{ $k->id }} =
                    getNode({{ $k->id }});

                // YA
                @if($next)

                    drawYes(
                        decision{{ $k->id }},
                        getNode({{ $next->id }})
                    );

                @endif

                // TIDAK
                @if($prev)

                    drawNo(
                        decision{{ $k->id }},
                        getNode({{ $prev->id }})
                    );

                @endif

            @endif

        @endforeach
    }

    render();

    window.addEventListener(
        "resize",
        render
    );

    // =========================
    // SAVE FLOWCHART PNG
    // =========================

    setTimeout(async () => {

        const canvas = await html2canvas(wrapper,{
            scale:2
        });

        const image =
            canvas.toDataURL('image/png');

        fetch('/sop/{{ $sop->id }}/save-flowchart',{

            method:'POST',

            headers:{
                'Content-Type':'application/json',
                'X-CSRF-TOKEN':'{{ csrf_token() }}'
            },

            body:JSON.stringify({
                image:image
            })

        });

    }, 1000);

});

</script>

@endsection
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">

<style>

body{
    font-family: Arial, sans-serif;
    font-size:12px;
}

.sop-table{
    width:100%;
    border-collapse:collapse;
}

.sop-table td,
.sop-table th{
    border:1px solid black;
    padding:5px;
    vertical-align:top;
    font-size:11px;
}

.text-center{
    text-align:center;
}

.page-break{
    page-break-before:always;
}

.flow-box{
    width:60px;
    height:25px;
    border:2px solid black;
    margin:auto;
}

.flow-start,
.flow-end{
    width:70px;
    height:25px;
    border:2px solid black;
    border-radius:20px;
    margin:auto;
}

.flow-decision{
    width:35px;
    height:35px;
    border:2px solid black;
    transform:rotate(45deg);
    margin:auto;
}

</style>

</head>

<body>

<!-- ================= HALAMAN 1 ================= -->

<table class="sop-table">
    <tr>
        <td width="60%" class="text-center" style="vertical-align:middle;">
            <div style="text-align:center;">
                <img src="{{ public_path('logo.png') }}" width="150" style="display:block; margin:0 auto;">
                <br>
                <b>KEMENTERIAN KESEHATAN</b><br>
                SEKRETARIAT JENDERAL<br>
                PUSAT PENGEMBANGAN KOMPETENSI APARATUR (P2KA)<br>
                BALAI BESAR PELATIHAN KESEHATAN JAKARTA
            </div>
        </td>
        
        <td width="40%">
            <table style="width:100%; border-collapse:collapse;">
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
                    <td>Disetujui Oleh</td>
                    <td>:</td>
                </tr>

                <tr>
                    <td colspan="2" class="text-center">
                        Penjaminan Mutu
                        <br>

                        <img
                            src="{{ public_path('ttd-pm.jpg') }}"
                            width="50">
                        <br>
                        <b>
                            {{ $sop->timker_approved_by ?? '-' }}
                        </b>
                    </td>
                </tr>
                
                <tr>
                    <td>Disahkan Oleh</td>
                    <td>:</td>
                </tr>
                
                <tr>
                    <td colspan="2" class="text-center">
                        Kepala BBPK Jakarta
                        <br>
                        <img
                            src="{{ public_path('ttd-kepala.jpg') }}"
                            width="50">
                        <br>
                        <b>
                            {{ $sop->disahkan_oleh ?? '-' }}
                        </b>
                        <br>
                        NIP.
                        {{ $sop->nip_pengesah ?? '-' }}
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

<table class="sop-table">
    <tr>
        <td width="50%">
            <b>Dasar Hukum</b>
            <ol>
                @foreach($sop->dasarHukum as $d)
                <li>{{ $d->isi }}</li>
                @endforeach
            </ol>
        </td>
        
        <td width="50%">
            <b>Kualifikasi Pelaksana</b>
            <ol>
                @foreach($sop->kualifikasis as $k)
                <li>{{ $k->isi }}</li>
                @endforeach
            </ol>
        </td>
    </tr>
    
    <tr>
        <td>
            <b>Keterkaitan</b>
            <ol>
                @foreach($sop->keterkaitans as $k)
                <li>{{ $k->isi }}</li>
                @endforeach
            </ol>
        </td>
        
        <td>
            <b>Peralatan</b>
            <ol>
                @foreach($sop->peralatans as $p)
                <li>{{ $p->isi }}</li>
                @endforeach
            </ol>
        </td>
    </tr>
    
    <tr>
        <td>
            <b>Peringatan</b>
            <ol>
                @foreach($sop->peringatans as $p)
                <li>{{ $p->isi }}</li>
                @endforeach
            </ol>
        </td>
        
        <td>
            <b>Pencatatan</b>
            <ol>
                @foreach($sop->pencatatans as $p)
                <li>{{ $p->isi }}</li>
                @endforeach
            </ol>
        </td>
    </tr>
</table>

<!-- ================= HALAMAN 2 ================= -->



<img
    src="{{ public_path('flowcharts/flowchart_'.$sop->id.'.png') }}"
    style="width:100%;"
>

</body>
</html>
@extends('layouts.app')

@section('content')
<head>
    <title>SOP App</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            font-family: "Times New Roman", serif;
            font-size: 13px;
            background-color: #f8f9fa;
        }
        .container-box {
            background: white;
            padding: 20px;
            border: 1px solid #000;
        }
        .judul {
            font-weight: bold;
            text-align: center;
        }
        table td {
            vertical-align: middle;
        }
    </style>
</head>
<body>

<div class="container mt-4">
<div class="container-box">

<!-- HEADER -->
<div class="text-center mb-3">
    <div style="font-weight:bold;">PEMERINTAH REPUBLIK INDONESIA</div>
    <div>KEMENTERIAN KESEHATAN</div>
    <div>RUMAH SAKIT / INSTANSI</div>
</div>

<h5 class="judul">STANDAR OPERASIONAL PROSEDUR (SOP)</h5>
<hr>
<form action="/sop/{{ $id }}/peralatan" method="POST">
@csrf

<h6>Peralatan</h6>

<div id="wrapper">
<input type="text" name="peralatan[]" class="form-control form-control-sm mb-2" placeholder="Isi peralatan">
</div>

<button type="button" onclick="tambah()" class="btn btn-secondary btn-sm">Tambah</button>
<button class="btn btn-dark btn-sm">Next</button>

</form>

<script>
function tambah(){
    let w=document.getElementById('wrapper');
    let i=document.createElement('input');
    i.type='text';
    i.name='peralatan[]';
    i.className='form-control form-control-sm mb-2';
    i.placeholder='Isi peralatan';
    w.appendChild(i);
}
</script>

@endsection
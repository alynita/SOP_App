@extends('layouts.app')

@section('content')

<h5>Input Kegiatan SOP</h5>

<form action="/sop/{{ $sop->id }}/kegiatan" method="POST">
@csrf

<div id="wrapper">

    <div class="item border p-3 mb-3">

        <textarea name="nama_kegiatan[]" class="form-control mb-2" placeholder="Nama Kegiatan"></textarea>

        <input type="text" name="kelengkapan[]" class="form-control mb-2" placeholder="Kelengkapan">

        <input type="text" name="waktu[]" class="form-control mb-2" placeholder="Waktu">

        <input type="text" name="output[]" class="form-control mb-2" placeholder="Output">

        <textarea name="keterangan[]" class="form-control mb-2" placeholder="Keterangan"></textarea>

        <hr>

        <h6>Pelaksana</h6>

        @foreach($pelaksana as $p)
            <div>
                <input type="checkbox" name="pelaksana[0][]" value="{{ $p->id }}">
                {{ $p->nama }}
            </div>
        @endforeach

    </div>

</div>

<button type="button" onclick="tambah()" class="btn btn-secondary btn-sm">
    + Tambah Kegiatan
</button>

<button class="btn btn-dark btn-sm">
    Simpan
</button>

</form>

<script>
let index = 1;

function tambah(){
    let wrapper = document.getElementById('wrapper');
    let item = document.querySelector('.item').cloneNode(true);

    // reset value input
    item.querySelectorAll('input, textarea').forEach(el => {
        el.value = '';
        if(el.type === 'checkbox') el.checked = false;
    });

    // update name pelaksana index
    item.querySelectorAll('input[type="checkbox"]').forEach(el => {
        el.name = "pelaksana["+index+"][]";
    });

    wrapper.appendChild(item);
    index++;
}
</script>

@endsection
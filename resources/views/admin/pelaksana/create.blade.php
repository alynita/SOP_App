@extends('layouts.app')

@section('content')

<h5>Tambah Pelaksana</h5>

<form action="/admin/pelaksana/store" method="POST">
    @csrf

    <div id="pelaksana">

        <div class="mb-2">
            <label>Nama Pelaksana</label>
            <input type="text"
                name="nama[]"
                class="form-control"
                placeholder="Contoh: Pejabat Pengadaan"
                required>
        </div>

    </div>

    <button type="button"
        onclick="tambah('pelaksana','nama[]')"
        class="btn btn-secondary btn-sm mb-3">

        + Tambah

    </button>

    <br>

    <button type="submit" class="btn btn-success btn-sm">
        Simpan
    </button>

    <a href="/admin/pelaksana" class="btn btn-secondary btn-sm">
        Batal
    </a>

</form>

<script>

function tambah(wrapperId, name) {

    let wrapper = document.getElementById(wrapperId);

    let div = document.createElement('div');
    div.classList.add('mb-2');

    div.innerHTML = `
        <div class="d-flex gap-2">

            <input type="text"
                name="${name}"
                class="form-control"
                placeholder="Contoh: Pejabat Pengadaan"
                required>

            <button type="button"
                class="btn btn-danger"
                onclick="hapus(this)">

                Hapus

            </button>

        </div>
    `;

    wrapper.appendChild(div);
}

function hapus(btn) {
    btn.closest('.mb-2').remove();
}

</script>

@endsection
@extends('layouts.app')

@section('content')

<h4 class="mb-3">Tambah User</h4>

<form action="/admin/users/store" method="POST">
@csrf

<input type="text"
        name="name"
        class="form-control mb-2"
        placeholder="Nama">

<input type="email"
        name="email"
        class="form-control mb-2"
        placeholder="Email">

<input type="password"
        name="password"
        class="form-control mb-2"
        placeholder="Password">

<select name="role"
        class="form-control mb-3">

        <option value="admin">Admin</option>
        <option value="timker1">Timker 1</option>
        <option value="timker2">Timker 2</option>
        <option value="timker3">Timker 3</option>
        <option value="timker4">Timker 4</option>
        <option value="timker5">Timker 5</option>
        <option value="timker6">Timker 6</option>

</select>

<button class="btn btn-success">
        Simpan
</button>

</form>

@endsection
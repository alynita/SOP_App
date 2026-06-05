@extends('layouts.app')

@section('content')

<h4>Edit User</h4>

<form action="/admin/users/{{ $user->id }}"
    method="POST">

    @csrf
    @method('PUT')

    <input type="text"
        name="name"
        value="{{ $user->name }}"
        class="form-control mb-2">

    <input type="email"
        name="email"
        value="{{ $user->email }}"
        class="form-control mb-2">

    <select name="role"
        class="form-control mb-2">

        <option value="admin">Admin</option>
        <option value="timker1">Timker 1</option>
        <option value="timker2">Timker 2</option>
        <option value="timker3">Timker 3</option>
        <option value="timker4">Timker 4</option>
        <option value="timker5">Timker 5</option>
        <option value="timker6">Timker 6</option>

    </select>

    <button class="btn btn-success">
        Update
    </button>

</form>

@endsection
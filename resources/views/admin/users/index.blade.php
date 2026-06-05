@extends('layouts.app')

@section('content')

<h4 class="mb-3">Data User</h4>

<a href="/admin/users/create"
    class="btn btn-primary btn-sm mb-3">

    + Tambah User

</a>

<table class="table table-bordered table-hover">

    <tr class="table-light">
        <th>Nama</th>
        <th>Email</th>
        <th>Role</th>
        <th width="180">Aksi</th>
    </tr>

    @foreach($users as $u)

    <tr>

        <td>{{ $u->name }}</td>

        <td>{{ $u->email }}</td>

        <td>
            <span class="badge bg-secondary">
                {{ $u->role }}
            </span>
        </td>

        <td>

            <!-- EDIT -->
            <a href="/admin/users/{{ $u->id }}/edit"
                class="btn btn-warning btn-sm">

                Edit

            </a>

            <!-- HAPUS -->
            <form action="/admin/users/{{ $u->id }}"
                method="POST"
                style="display:inline;">

                @csrf
                @method('DELETE')

                <button
                    type="submit"
                    class="btn btn-danger btn-sm"
                    onclick="return confirm('Hapus user ini?')">

                    Hapus

                </button>

            </form>

        </td>

    </tr>

    @endforeach

</table>

@endsection
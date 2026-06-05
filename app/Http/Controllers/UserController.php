<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Sop;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::latest()->get();

        return view(
            'admin.users.index',
            compact('users')
        );
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        User::create([

            'name' => $request->name,

            'email' => $request->email,

            'password' =>
                Hash::make($request->password),

            'role' => $request->role,

        ]);

        return redirect('/admin/users')
            ->with(
                'success',
                'User berhasil ditambahkan'
            );
    }

    // ================= EDIT =================
    public function edit($id)
    {
        $user = User::findOrFail($id);

        return view(
            'admin.users.edit',
            compact('user')
        );
    }

    // ================= UPDATE =================
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $user->name = $request->name;

        $user->email = $request->email;

        $user->role = $request->role;

        // password opsional
        if($request->password){

            $user->password =
                Hash::make($request->password);
        }

        $user->save();

        return redirect('/admin/users')
            ->with(
                'success',
                'User berhasil diupdate'
            );
    }

    // ================= DELETE =================
    public function destroy($id)
    {
        $user = User::findOrFail($id);

        $user->delete();

        return back()->with(
            'success',
            'User berhasil dihapus'
        );
    }

    public function monitoring(Request $request)
    {
        $query = Sop::query();

        // FILTER STATUS
        if($request->status){

            $query->where(
                'status',
                $request->status
            );
        }

        // FILTER TIMKER
        if($request->timker){

            $query->where(
                'timker_id',
                $request->timker
            );
        }

        $sops = $query->latest()->get();

        return view(
            'admin.users.monitoring',
            compact('sops')
        );
    }
}
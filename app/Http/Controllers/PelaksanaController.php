<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pelaksana;

class PelaksanaController extends Controller
{
    public function index()
    {
        $pelaksana = Pelaksana::orderBy('urutan')->get();

        return view('admin.pelaksana.index', compact('pelaksana'));
    }

    public function create()
    {
        return view('admin.pelaksana.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|array',
            'nama.*' => 'required|string|max:255',
        ]);

        foreach ($request->nama as $nama) {

            Pelaksana::create([
                'nama' => $nama,
            ]);

        }

        return redirect('/admin/pelaksana')
            ->with('success', 'Pelaksana berhasil ditambahkan');
    }

    public function edit($id)
    {
        $pelaksana = Pelaksana::findOrFail($id);

        return view('admin.pelaksana.edit', compact('pelaksana'));
    }

    public function update(Request $request, $id)
    {
        $pelaksana = Pelaksana::findOrFail($id);

        $request->validate([
            'nama'   => 'required|string|max:255',
            'urutan' => 'nullable|integer',
        ]);

        $pelaksana->update([
            'nama'   => $request->nama,
            'urutan' => $request->urutan,
        ]);

        return redirect('/admin/pelaksana')->with('success', 'Pelaksana berhasil diperbarui');
    }

    public function destroy($id)
    {
        $pelaksana = Pelaksana::findOrFail($id);

        // cek apakah pelaksana masih dipakai di kegiatan manapun
        if ($pelaksana->kegiatan()->exists()) {
            return back()->with('error', 'Pelaksana tidak dapat dihapus karena masih digunakan pada kegiatan SOP');
        }

        $pelaksana->delete();

        return redirect('/admin/pelaksana')->with('success', 'Pelaksana berhasil dihapus');
    }
}
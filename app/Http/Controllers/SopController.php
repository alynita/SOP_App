<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sop;
use App\Models\DasarHukum;
use App\Models\KualifikasiPelaksana;
use App\Models\Keterkaitan;
use App\Models\Peralatan;
use App\Models\Peringatan;
use App\Models\Pencatatan;
use App\Models\Kegiatan;
use App\Models\Pelaksana;

class SopController extends Controller
{
    // STEP 1 - FORM SOP
    public function create()
    {
        return view('sop.create');
    }

    // SIMPAN STEP 1
    public function store(Request $request)
    {
        $sop = Sop::create($request->all());

        // 👉 lanjut ke dasar hukum
        return redirect('/sop/' . $sop->id . '/dasar-hukum');
    }

    // ========================
    // STEP 2 - DASAR HUKUM
    public function dasarHukum($id)
    {
        return view('sop.dasar_hukum', compact('id'));
    }

    public function storeDasarHukum(Request $request, $id)
    {
        foreach ($request->dasar_hukum as $item) {
            if ($item) {
                DasarHukum::create([
                    'sop_id' => $id,
                    'isi' => $item
                ]);
            }
        }

        return redirect('/sop/' . $id . '/kualifikasi');
    }

    // ========================
    // STEP 3 - KUALIFIKASI
    public function kualifikasi($id)
    {
        return view('sop.kualifikasi', compact('id'));
    }

    public function storeKualifikasi(Request $request, $id)
    {
        foreach ($request->kualifikasi as $item) {
            if ($item) {
                KualifikasiPelaksana::create([
                    'sop_id' => $id,
                    'isi' => $item
                ]);
            }
        }

        return redirect('/sop/' . $id . '/keterkaitan');
    }

    // ========================
    // STEP 4 - KETERKAITAN
    public function keterkaitan($id)
    {
        return view('sop.keterkaitan', compact('id'));
    }

    public function storeKeterkaitan(Request $request, $id)
    {
        foreach ($request->keterkaitan as $item) {
            if ($item) {
                Keterkaitan::create([
                    'sop_id' => $id,
                    'isi' => $item
                ]);
            }
        }

        return redirect('/sop/' . $id . '/peralatan');
    }

    // ========================
    // STEP 5 - PERALATAN
    public function peralatan($id)
    {
        return view('sop.peralatan', compact('id'));
    }

    public function storePeralatan(Request $request, $id)
    {
        foreach ($request->peralatan as $item) {
            if ($item) {
                Peralatan::create([
                    'sop_id' => $id,
                    'isi' => $item
                ]);
            }
        }

        return redirect('/sop/' . $id . '/peringatan');
    }

    // ========================
    // STEP 6 - PERINGATAN
    public function peringatan($id)
    {
        return view('sop.peringatan', compact('id'));
    }

    public function storePeringatan(Request $request, $id)
    {
        foreach ($request->peringatan as $item) {
            if ($item) {
                Peringatan::create([
                    'sop_id' => $id,
                    'isi' => $item
                ]);
            }
        }

        return redirect('/sop/' . $id . '/pencatatan');
    }

    // ========================
    // STEP 7 - PENCATATAN
    public function pencatatan($id)
    {
        return view('sop.pencatatan', compact('id'));
    }

    public function storePencatatan(Request $request, $id)
    {
        foreach ($request->pencatatan as $item) {
            if ($item) {
                Pencatatan::create([
                    'sop_id' => $id,
                    'isi' => $item
                ]);
            }
        }

        // 👉 terakhir ke OUTPUT
        return redirect('/sop/' . $id);
    }

    // ========================
    // OUTPUT FINAL
    public function show($id)
    {
        $sop = Sop::with([
            'kegiatan.pelaksana',
            'dasarHukum',
            'kualifikasis',
            'keterkaitans',
            'peralatans',
            'peringatans',
            'pencatatans'
        ])->findOrFail($id);

        $pelaksanas = Pelaksana::all();

        return view('sop.show', compact('sop', 'pelaksanas'));
    }

    public function dashboard()
    {
        return view('sop.dashboard', [
            'total' => Sop::count(),
            'aktif' => Sop::count(), // nanti bisa pakai status
            'draft' => 0,
            'sops' => Sop::latest()->take(5)->get()
        ]);
    }

    public function index(Request $request)
    {
        $search = $request->search;

        $sops = Sop::where('nama_sop', 'like', "%$search%")
                    ->orWhere('no_sop', 'like', "%$search%")
                    ->get();

        return view('sop.index', compact('sops'));
    }

    public function edit($id)
    {
        $sop = Sop::findOrFail($id);
        return view('sop.edit', compact('sop'));
    }

    public function update(Request $request, $id)
    {
        $sop = Sop::findOrFail($id);
        $sop->update($request->all());

        // hapus lama dulu
        DasarHukum::where('sop_id', $id)->delete();

        // simpan ulang
        foreach ($request->dasar_hukum as $item) {
            if ($item) {
                DasarHukum::create([
                    'sop_id' => $id,
                    'isi' => $item
                ]);
            }
        }

        KualifikasiPelaksana::where('sop_id', $id)->delete();

        foreach ($request->kualifikasi as $item) {
            if ($item) {
                KualifikasiPelaksana::create([
                    'sop_id' => $id,
                    'isi' => $item
                ]);
            }
        }

        Keterkaitan::where('sop_id', $id)->delete();

        foreach ($request->keterkaitan as $item) {
            if ($item) {
                Keterkaitan::create([
                    'sop_id' => $id,
                    'isi' => $item
                ]);
            }
        }

        Peralatan::where('sop_id', $id)->delete();

        foreach ($request->peralatan as $item) {
            if ($item) {
                Peralatan::create([
                    'sop_id' => $id,
                    'isi' => $item
                ]);
            }
        }

        Peringatan::where('sop_id', $id)->delete();

        foreach ($request->peringatan as $item) {
            if ($item) {
                Peringatan::create([
                    'sop_id' => $id,
                    'isi' => $item
                ]);
            }
        }

        Pencatatan::where('sop_id', $id)->delete();

        foreach ($request->pencatatan as $item) {
            if ($item) {
                Pencatatan::create([
                    'sop_id' => $id,
                    'isi' => $item
                ]);
            }
        }

        return redirect('/sop')->with('success', 'Data berhasil diupdate');
    }

    public function delete($id)
    {
        $sop = Sop::findOrFail($id);
        $sop->delete();

        return redirect('/sop')->with('success', 'Data berhasil dihapus');
    }

    public function kegiatan($id)
    {
        $sop = Sop::findOrFail($id);
        $pelaksana = \App\Models\Pelaksana::all();

        return view('sop.kegiatan', compact('sop', 'pelaksana'));
    }

    public function storeKegiatan(Request $request, $id)
    {
        $last = Kegiatan::where('sop_id', $id)->max('no_urutan');
        $no = $last ? $last + 1 : 1;

        foreach ($request->nama_kegiatan as $i => $nama) {

            if ($nama) {

                $kegiatan = Kegiatan::create([
                    'sop_id' => $id,
                    'no_urutan' => $no++,
                    'nama_kegiatan' => $nama,
                    'kelengkapan' => $request->kelengkapan[$i] ?? null,
                    'waktu' => $request->waktu[$i] ?? null,
                    'output' => $request->output[$i] ?? null,
                    'keterangan' => $request->keterangan[$i] ?? null,
                    'tipe' => 'proses'
                ]);

                // simpan pelaksana sesuai index
                if (isset($request->pelaksana[$i])) {
                    $kegiatan->pelaksana()->sync($request->pelaksana[$i]);
                }
            }
        }

        return redirect('/sop/' . $id);
    }

    public function diagram($id)
    {
        $sop = Sop::with('kegiatan')->findOrFail($id);
        return view('sop.diagram', compact('sop'));
    }
}
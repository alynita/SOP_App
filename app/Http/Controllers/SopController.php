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
use App\Models\Notification;

use Barryvdh\DomPDF\Facade\Pdf;

class SopController extends Controller
{
    public function dashboard()
    {
        $userId = auth()->id();

        $total = Sop::where('user_id', $userId)->count();

        $aktif = Sop::where('user_id', $userId)
                    ->where('status', 'disetujui')
                    ->count();

        $draft = Sop::where('user_id', $userId)
                    ->where('status', 'draft')
                    ->count();

        $revisi = Sop::where('user_id', $userId)
                    ->where('status', 'ditolak')
                    ->count();

        $sops = Sop::where('user_id', $userId)
            ->where('status', '!=', 'disahkan')
            ->latest()
            ->take(5)
            ->get();

                    

        // 🔔 AMBIL NOTIF (hanya yang belum dibaca)
        $notifications = Notification::where('user_id', auth()->id())
            ->where('is_read', false)
            ->latest()
            ->get();

        return view(
            'sop.dashboard',
            compact(
                'total',
                'aktif',
                'draft',
                'revisi',
                'sops',
                'notifications'
            )
        );
    }

    public function create()
    {
        return view('sop.create');
    }

    public function store(Request $request)
    {
        // ======================
        // VALIDASI DULU
        // ======================
        $request->validate([
            'nama_sop' => 'required',
            'tgl_pembuatan' => 'required',

            'dasar_hukum' => 'required|array|min:1',
            'dasar_hukum.*' => 'required',

            'kualifikasi' => 'required|array|min:1',
            'kualifikasi.*' => 'required',

            'keterkaitan' => 'required|array|min:1',
            'keterkaitan.*' => 'required',

            'peralatan' => 'required|array|min:1',
            'peralatan.*' => 'required',

            'peringatan' => 'required|array|min:1',
            'peringatan.*' => 'required',

            'pencatatan' => 'required|array|min:1',
            'pencatatan.*' => 'required',
        ]);

        // ======================
        // DATA SOP
        // ======================
        $data = $request->all();

        $data['status'] = 'draft';
        $data['user_id'] = auth()->id();
        $data['timker_id'] = auth()->user()->role;

        $data['no_sop'] = null;
        $data['tgl_revisi'] = null;
        $data['tgl_efektif'] = null;

        $sop = Sop::create($data);

        // ======================
        // DASAR HUKUM
        // ======================
        foreach ($request->dasar_hukum as $item) {
            DasarHukum::create([
                'sop_id' => $sop->id,
                'isi' => $item
            ]);
        }

        // ======================
        // KUALIFIKASI
        // ======================
        foreach ($request->kualifikasi as $item) {
            KualifikasiPelaksana::create([
                'sop_id' => $sop->id,
                'isi' => $item
            ]);
        }

        // ======================
        // KETERKAITAN
        // ======================
        foreach ($request->keterkaitan as $item) {
            Keterkaitan::create([
                'sop_id' => $sop->id,
                'isi' => $item
            ]);
        }

        // ======================
        // PERALATAN
        // ======================
        foreach ($request->peralatan as $item) {
            Peralatan::create([
                'sop_id' => $sop->id,
                'isi' => $item
            ]);
        }

        // ======================
        // PERINGATAN
        // ======================
        foreach ($request->peringatan as $item) {
            Peringatan::create([
                'sop_id' => $sop->id,
                'isi' => $item
            ]);
        }

        // ======================
        // PENCATATAN
        // ======================
        foreach ($request->pencatatan as $item) {
            Pencatatan::create([
                'sop_id' => $sop->id,
                'isi' => $item
            ]);
        }

        return redirect('/sop/' . $sop->id)
                ->with('success', 'SOP berhasil disimpan');
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

        $pelaksanas = \App\Models\Pelaksana::whereIn('id', 
            \DB::table('kegiatan_pelaksana')
                ->join('kegiatan', 'kegiatan.id', '=', 'kegiatan_pelaksana.kegiatan_id')
                ->where('kegiatan.sop_id', $sop->id)
                ->pluck('pelaksana_id')
        )
        ->orderBy('urutan', 'asc') 
        ->get();

        return view('sop.show', compact('sop', 'pelaksanas'));
    }

    public function index(Request $request)
    {
        $search = $request->search;
        $userId = auth()->id(); 

        $sops = Sop::where('user_id', $userId)
                    ->where(function ($query) use ($search) {
                        $query->where('nama_sop', 'like', "%$search%")
                            ->orWhere('no_sop', 'like', "%$search%");
                    })
                    ->get();

        return view('sop.index', compact('sops'));
    }

    public function proses()
    {
        $sops = Sop::where('user_id', auth()->id())
            ->where('status', '!=', 'disetujui')
            ->latest()
            ->get();

        return view('sop.proses', compact('sops'));
    }

    public function editKegiatan($id)
    {
        $sop = Sop::with('kegiatan.pelaksana')->findOrFail($id);

        $pelaksana = Pelaksana::all();

        return view(
            'sop.kegiatan_edit',
            compact('sop', 'pelaksana')
        );
    }

    public function updateKegiatan(Request $request, $id)
    {
        $sop = Sop::findOrFail($id);

        // hapus lama
        $sop->kegiatan()->delete();

        // input ulang
        foreach($request->nama_kegiatan as $i => $nama){

            $kegiatan = Kegiatan::create([
                'sop_id' => $sop->id,
                'no_urutan' => $i + 1,
                'nama_kegiatan' => $nama,
                'kelengkapan' => $request->kelengkapan[$i] ?? null,
                'waktu' => $request->waktu[$i] ?? null,
                'output' => $request->output[$i] ?? null,
                'keterangan' => $request->keterangan[$i] ?? null,
                'tipe' => $request->tipe[$i],
            ]);

            // pelaksana lama
            if(isset($request->pelaksana[$i])){
                $kegiatan->pelaksana()->attach(
                    $request->pelaksana[$i]
                );
            }
        }

        return redirect('/proses-sop')
            ->with('success', 'Proses SOP berhasil diupdate');
    }

    public function edit($id)
    {
        $sop = Sop::findOrFail($id);

        // kalau sudah dikunci orang lain
        if ($sop->is_editing_by && $sop->is_editing_by !== auth()->user()->role) {
            return redirect('/sop')->with('error', 'SOP sedang diedit oleh pihak lain');
        }

        // kunci oleh user yang sedang edit
        $sop->is_editing_by = auth()->user()->role;
        $sop->save();

        return view('sop.edit', compact('sop'));
    }

    public function update(Request $request, $id)
    {
        $sop = Sop::findOrFail($id);

        // =========================
        // 1. UPDATE SOP UTAMA
        // =========================
        $sop->update($request->all());

        // =========================
        // 2. SIMPAN DETAIL ULANG
        // =========================

        DasarHukum::where('sop_id', $id)->delete();
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

        // =========================
        // 3. STATUS LOGIC (DIPERBAIKI)
        // =========================

        $user = auth()->user();

        if ($sop->status == 'ditolak') {

            if (in_array($user->role, ['timker1','timker2','timker3','timker5','timker6'])) {
                $sop->status = 'draft';

            } elseif ($user->role == 'timker4') {
                $sop->status = 'diajukan';
            }

        } else {
            $sop->status = 'draft';
        }

        // =========================
        // 4. LEPAS LOCK EDIT
        // =========================
        $sop->is_editing_by = null;

        $sop->save();

        // =========================
        // 5. REDIRECT SESUAI ROLE
        // =========================

        if (in_array($user->role, ['timker1','timker2','timker3','timker4','timker5','timker6'])) {
            return redirect('/dashboard')->with('success', 'SOP berhasil diperbarui');
        }

        if ($user->role == 'pm') {
            return redirect('/dashboard-timker4')->with('success', 'SOP berhasil diperbarui, silakan klik Setujui jika sudah sesuai');
        }

        return redirect('/dashboard')->with('success', 'SOP berhasil diperbarui');
    }

    public function delete($id)
    {
        $sop = Sop::findOrFail($id);
        $sop->delete();

        return redirect('/sop')->with('success', 'Data berhasil dihapus');
    }

    public function submit($id)
    {
        $sop = Sop::findOrFail($id);

        $sop->status = 'diajukan';
        $sop->save();

        Notification::create([
            'user_id' => 3,
            'pesan' => 'Dokumen SOP baru telah diajukan dan menunggu proses verifikasi.',
            'url' => '/dashboard-timker4'
        ]);

        return redirect('/sop')->with('success', 'SOP berhasil diajukan');
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
                    'tipe' => !empty($request->tipe[$i]) ? $request->tipe[$i] : 'proses',
                ]);

                $pelaksanaIds = [];

                // =======================
                // DARI TOM SELECT (gabungan: ID lama + nama baru)
                if (isset($request->pelaksana[$i]) && is_array($request->pelaksana[$i])) {

                    foreach ($request->pelaksana[$i] as $value) {

                        if (empty($value)) {
                            continue;
                        }

                        if (is_numeric($value)) {
                            // pelaksana yang sudah ada di database
                            $pelaksanaIds[] = $value;

                        } else {
                            // pelaksana baru yang diketik user (Tom Select create: true)
                            $namaBaru = trim($value);

                            if ($namaBaru) {

                                $existing = Pelaksana::where('nama', $namaBaru)->first();

                                if ($existing) {
                                    $pelaksanaIds[] = $existing->id;
                                } else {
                                    $baru = Pelaksana::create([
                                        'nama' => $namaBaru
                                    ]);

                                    $pelaksanaIds[] = $baru->id;
                                }
                            }
                        }
                    }
                }

                // =======================
                // BERSIHKAN
                $pelaksanaIds = array_filter($pelaksanaIds);
                $pelaksanaIds = array_values($pelaksanaIds);

                // =======================
                // SIMPAN
                if (!empty($pelaksanaIds)) {
                    $kegiatan->pelaksana()->sync($pelaksanaIds);
                }
            }
        }

        return redirect('/sop/' . $id);
    }

    public function editMutu($id)
    {
        $sop = Sop::findOrFail($id);

        return view('sop.edit_mutu', compact('sop'));
    }

    public function updateMutu(Request $request, $id)
    {
        $sop = Sop::findOrFail($id);

        $sop->update([
            'no_sop' => $request->no_sop,
            'tgl_revisi' => $request->tgl_revisi,
            'tgl_efektif' => $request->tgl_efektif,
        ]);

        return redirect('/dashboard-timker4')
            ->with('success', 'Data SOP berhasil dilengkapi');
    }

    public function pdf($id)
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

        // URUTAN PELAKSANA
        $urutanPelaksana = [];

        foreach($sop->kegiatan as $k){

            foreach($k->pelaksana as $p){

                if(!collect($urutanPelaksana)->contains('id', $p->id)){

                    $urutanPelaksana[] = $p;

                }
            }
        }

        return Pdf::loadView(
            'sop.pdf',
            compact('sop', 'urutanPelaksana')
        )
        ->setPaper('a4', 'landscape')
        ->download('sop.pdf');
    }

    public function saveFlowchart(Request $request, $id)
    {
        $image = $request->image;

        $image = str_replace(
            'data:image/png;base64,',
            '',
            $image
        );

        $image = str_replace(
            ' ',
            '+',
            $image
        );

        $data = base64_decode($image);

        // folder flowcharts
        if(!file_exists(public_path('flowcharts'))){

            mkdir(
                public_path('flowcharts'),
                0777,
                true
            );

        }

        // simpan png
        file_put_contents(

            public_path(
                'flowcharts/flowchart_'.$id.'.png'
            ),

            $data
        );

        return response()->json([
            'success' => true
        ]);
    }
}
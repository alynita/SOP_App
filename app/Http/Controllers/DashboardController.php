<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sop;
use App\Models\User;
use App\Models\Notification;
use App\Models\Pelaksana;

class DashboardController extends Controller
{

    public function index()
    {
        $total = Sop::count();
        $aktif = 0;
        $draft = 0;

        $sops = Sop::latest()->take(5)->get(); // 🔥 WAJIB (biar ga error lagi)

        return view('sop.dashboard', compact('total', 'aktif', 'draft', 'sops'));
    }

    public function dashboardTimker4()
    {
        return view('dashboard.timker4', [
            'total' => Sop::count(),
            'menunggu' => Sop::where('status', 'diajukan')->count(),
            'disetujui' => Sop::where('status', 'disetujui')->count(),
            'ditolak' => Sop::where('status', 'ditolak')->count(),

            'sopMasuk' => Sop::where('status', 'diajukan')
                ->latest()
                ->get()
        ]);
    }

    public function dashboardAdmin()
    {
        return view('admin.dashboard', [

            'totalUser' => User::count(),

            'totalSop' => Sop::count(),

            'totalPelaksana' => Pelaksana::count(),

            'draft' => Sop::where('status', 'draft')->count(),

            'disetujui' => Sop::where('status', 'disetujui')->count(),

            'ditolak' => Sop::where('status', 'ditolak')->count(),

            'diajukan' => Sop::where('status', 'diajukan')->count(),

            'disahkan' => Sop::where('status', 'disahkan')->count(),

            'sops' => Sop::latest()->take(5)->get()

        ]);
    }

    public function approve($id)
    {
        $sop = Sop::findOrFail($id);

        $user = auth()->user();

        $sop->status = 'disetujui';

        $sop->timker_approved_by = $user->name;
        $sop->timker_approved_at = now();

        $sop->save();

        // =========================
        // NOTIFIKASI KE TIM KERJA (pengaju)
        // =========================
        Notification::create([
            'user_id' => $sop->user_id,
            'pesan' => 'Dokumen SOP yang Anda ajukan telah disetujui oleh Penjaminan Mutu.',
            'url' => '/sop/' . $sop->id
        ]);

        // =========================
        // NOTIFIKASI KE KEPALA BBPK
        // =========================
        $kepalaUsers = User::where('role', 'kepala')->get();

        foreach ($kepalaUsers as $kepala) {
            Notification::create([
                'user_id' => $kepala->id,
                'pesan' => 'Dokumen SOP baru telah disetujui Penjaminan Mutu dan menunggu pengesahan Anda.',
                'url' => '/dashboard-kepala'
            ]);
        }

        return back()->with('success', 'SOP disetujui Timker 4');
    }

    public function reject(Request $request, $id)
    {
        $sop = Sop::findOrFail($id);

        $sop->status = 'ditolak';

        $sop->catatan_revisi = $request->catatan_revisi;

        $sop->save();

        Notification::create([
            'user_id' => $sop->user_id,
            'pesan' => 'Dokumen SOP yang Anda ajukan memerlukan revisi. Silakan periksa kembali catatan yang diberikan.',
            'url' => '/sop/edit' . $sop->id
        ]);

        return back()->with(
            'success',
            'SOP berhasil ditolak'
        );
    }

    public function revisi()
    {
        $sop = Sop::where('status', 'ditolak')
            ->latest()
            ->get();

        return view('sop.revisi', compact('sop'));
    }

    public function arsip()
    {
        $arsip = Sop::whereIn('status', ['disetujui', 'ditolak'])
            ->latest()
            ->get();

        return view('dashboard.arsip', compact('arsip'));
    }

    public function dashboardKepala()
    {
        $menunggu = Sop::where('status', 'disetujui')->count();

        $disahkan = Sop::where('status', 'disahkan')->count();

        $totalSop = Sop::count();

        $sops = Sop::where('status', 'disetujui')
                    ->latest()
                    ->take(5)
                    ->get();

        return view(
            'dashboard.kepala',
            compact(
                'menunggu',
                'disahkan',
                'totalSop',
                'sops'
            )
        );
    }

    public function persetujuanKepala()
    {
        $sops = Sop::where('status', 'disetujui')
            ->latest()
            ->get();

        return view(
            'dashboard.persetujuan',
            compact('sops')
        );
    }


    public function approveKepala($id)
    {
        $sop = Sop::findOrFail($id);

        $user = auth()->user();

        $sop->status = 'disahkan';

        $sop->disahkan_oleh = $user->name;

        $sop->nip_pengesah = $user->nip;

        $sop->save();

        Notification::create([
            'user_id' => $sop->user_id,
            'pesan' => 'SOP kamu telah disahkan.',
            'url' => '/sop/' . $sop->id
        ]);

        return back()->with(
            'success',
            'SOP berhasil disahkan'
        );
    }

    public function arsipKepala()
    {
        $sops = Sop::where('status', 'disahkan')
                    ->latest()
                    ->get();

        return view(
            'dashboard.arsip-kepala',
            compact('sops')
        );
    }
}
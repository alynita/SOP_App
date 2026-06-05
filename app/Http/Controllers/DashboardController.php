<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sop;
use App\Models\User;

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

            'disetujui' => Sop::where('status', 'disetujui')->count(),

            'ditolak' => Sop::where('status', 'ditolak')->count(),

            'diajukan' => Sop::where('status', 'diajukan')->count(),

            'sops' => Sop::latest()->take(5)->get()

        ]);
    }

    public function approve($id)
    {
        $sop = Sop::findOrFail($id);

        $sop->status = 'disetujui';

        $sop->timker_approved_by = auth()->user()->name;
        $sop->timker_approved_at = now();

        $sop->save();

        return back()->with('success', 'SOP disetujui Timker 4');
    }

    public function reject(Request $request, $id)
    {
        $sop = Sop::findOrFail($id);

        $sop->status = 'ditolak';

        $sop->catatan_revisi =
            $request->catatan_revisi;

        $sop->save();

        return back()->with(
            'success',
            'SOP ditolak'
        );
    }

    public function arsip()
    {
        $arsip = Sop::whereIn('status', ['disetujui', 'ditolak'])
            ->latest()
            ->get();

        return view('dashboard.arsip', compact('arsip'));
    }
}
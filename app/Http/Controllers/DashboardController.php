<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sop;

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

    public function approve($id)
    {
        $sop = Sop::find($id);
        $sop->status = 'disetujui';
        $sop->save();

        return back()->with('success', 'SOP disetujui');
    }

    public function reject($id)
    {
        $sop = Sop::find($id);
        $sop->status = 'ditolak';
        $sop->save();

        return back()->with('success', 'SOP ditolak');
    }
}
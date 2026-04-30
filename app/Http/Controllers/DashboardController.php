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

    public function mutu()
    {
        return view('dashboard-mutu');
    }
}
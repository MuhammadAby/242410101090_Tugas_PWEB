<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProgramDonasi;
use App\Models\Donasi;
use App\Models\Donatur;
use App\Models\User;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $totalDonasi = Donasi::where(
            'status',
            'terverifikasi'
        )->sum('nominal');

        $totalProgram = ProgramDonasi::count();

        // hitung jumlah email unik
        $totalDonatur = Donasi::distinct('email')->count('email');

        $donasiTerbaru = Donasi::with('programDonasi')
            ->latest()
            ->take(5)
            ->get();

        $programs = ProgramDonasi::latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalDonasi',
            'totalProgram',
            'totalDonatur',
            'donasiTerbaru',
            'programs'
        ));
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProgramDonasi;

class DashboardController extends Controller
{
    public function index()
    {
        $kunjungan = session('kunjungan', 0);
        $pertama = session('pertama');
        $terakhir = now();

        $kunjungan++;

        if (!$pertama) {
            $pertama = now();
        }

        session([
            'kunjungan' => $kunjungan,
            'pertama' => $pertama,
            'terakhir' => $terakhir
        ]);

        $programs = ProgramDonasi::latest()->get();

        return view('dashboard', compact(
            'programs',
            'kunjungan',
            'pertama',
            'terakhir'
        ));
    }
}


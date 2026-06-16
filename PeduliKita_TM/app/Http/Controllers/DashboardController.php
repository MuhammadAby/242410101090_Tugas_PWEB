<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProgramDonasi;
use App\Models\Donasi;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        /*
        |--------------------------------------------------------------------------
        | Statistik Kunjungan
        |--------------------------------------------------------------------------
        */

        $kunjungan = session('kunjungan', 0);
        $pertama = session('pertama');
        $terakhir = now();

        $kunjungan++;

        if (!$pertama) {
            $pertama = now();
        }

        session([
            'kunjungan' => $kunjungan,
            'pertama'   => $pertama,
            'terakhir'  => $terakhir,
        ]);


        /*
        |--------------------------------------------------------------------------
        | Program Donasi
        |--------------------------------------------------------------------------
        */

        $programs = ProgramDonasi::whereColumn(
            'terkumpul',
            '<',
            'target'
        )->latest()->get();


        /*
        |--------------------------------------------------------------------------
        | Statistik Dashboard
        |--------------------------------------------------------------------------
        */

        $totalProgram = ProgramDonasi::count();

        $totalTarget = ProgramDonasi::sum('target');

        $programAktif = ProgramDonasi::whereColumn(
            'terkumpul',
            '<',
            'target'
        )->count();

        $totalDonasi = Donasi::sum('nominal');

        $totalDonatur = User::where('role', 'user')->count();


        return view('dashboard', compact(
            'programs',
            'kunjungan',
            'pertama',
            'terakhir',
            'totalProgram',
            'totalTarget',
            'programAktif',
            'totalDonasi',
            'totalDonatur'
        ));
    }
}

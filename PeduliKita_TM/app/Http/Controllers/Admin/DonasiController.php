<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Donasi;
use App\Models\ProgramDonasi;

class DonasiController extends Controller
{
    public function index()
    {
        $donasis = Donasi::with('programDonasi')
            ->latest()
            ->get();

        return view(
            'admin.donasi.index',
            compact('donasis')
        );
    }

    // public function verifikasi(
    //     Donasi $donasi,
    //     Request $request
    // )
    // {
    //     $donasi->update([
    //         'status' => $request->status
    //     ]);

    //     return back()->with(
    //         'success',
    //         'Status donasi berhasil diperbarui.'
    //     );
    // }

    public function verifikasi(Donasi $donasi, Request $request)
    {
        // $donasi = Donasi::findOrFail($id);

        // $donasi->update([
        //     'status' => $request->status ?? 'pending'
        // ]);

        // return back()->with('success', 'Status donasi berhasil diperbarui.');

        $statusLama = $donasi->status;

        $donasi->update([
            'status' => $request->status
        ]);

        if (
            $statusLama != 'terverifikasi' &&
            $request->status == 'terverifikasi'
        ) {

            $donasi->programDonasi
                ->increment(
                    'terkumpul',
                    $donasi->nominal
                );
        }

        return back()->with(
            'success',
            'Donasi berhasil diverifikasi'
        );
    }
}

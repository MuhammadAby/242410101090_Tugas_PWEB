<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KontakController extends Controller
{
    public function kirim(Request $request)
    {
        $request->validate([
            'nama' => 'required|max:255',
            'email' => 'required|email',
            'pesan' => 'required|max:1000',
        ]);

        PesanKontak::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'pesan' => $request->pesan,
        ]);

        return back()->with(
            'success',
            'Pesan berhasil dikirim.'
        );
    }
}

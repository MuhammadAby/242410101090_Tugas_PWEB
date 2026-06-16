<?php

namespace App\Http\Controllers;

use App\Models\Donasi;
use App\Models\ProgramDonasi;
use Illuminate\Http\Request;

class DonasiController extends Controller
{
    public function create(ProgramDonasi $program)
    {
        return view('donasi.create', compact('program'));
    }

    public function store(Request $request, ProgramDonasi $program)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email',
            'nominal' => 'required|numeric|min:10000',
            'metode' => 'required|string',
            'bukti_pembayaran' => 'required|image|max:5120',
            'pesan' => 'nullable|string',
        ]);

        $bukti = $request->file('bukti_pembayaran')
            ->store('bukti-transfer', 'public');

        Donasi::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'program_donasi_id' => $program->id,
            'nominal' => $request->nominal,
            'metode' => $request->metode,
            'pesan' => $request->pesan,
            'bukti_transfer' => $bukti,
            'status' => 'pending',
        ]);

        // Langsung update dana terkumpul
        // $program->increment('terkumpul', $request->nominal);

        return redirect('/')
            ->with(
                'success',
                'Terima kasih. Donasi Anda berhasil dikirim.'
            );
    }
}

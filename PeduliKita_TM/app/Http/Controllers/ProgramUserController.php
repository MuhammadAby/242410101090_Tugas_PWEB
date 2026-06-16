<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProgramDonasi;
use App\Models\Donasi;

class ProgramUserController extends Controller
{
    public function index()
    {
        $programs = ProgramDonasi::whereColumn(
            'terkumpul',
            '<',
            'target'
        )->latest()->get();

        return view('dashboard', compact('programs'));
    }

    public function create(ProgramDonasi $program)
    {
        return view(
            'donasi.create',
            compact('program')
        );
    }

    public function store(
        Request $request,
        ProgramDonasi $program
    )
    {
        $request->validate([

            'nominal' => 'required|numeric|min:10000',

            'metode_pembayaran' => 'required',

            'pesan' => 'nullable'

        ]);

        Donasi::create([

            'user_id' => auth()->id(),

            'program_donasi_id' => $program->id,

            'nominal' => $request->nominal,

            'metode_pembayaran'
                => $request->metode_pembayaran,

            'pesan' => $request->pesan,

            'status' => 'berhasil'

        ]);

        $program->increment(
            'terkumpul',
            $request->nominal
        );

        return redirect()

            ->route('dashboard')

            ->with(
                'success',
                'Donasi berhasil.'
            );
    }

    public function show($id)
    {
        $program = ProgramDonasi::findOrFail($id);

        return view(
            'program.show',
            compact('program')
        );
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProgramDonasi;
use App\Http\Controllers\Controller;

class ProgramDonasiController extends Controller
{
    public function index()
    {
        $programs = ProgramDonasi::latest()->paginate(10);

        return view('program-donasi.index', compact('programs'));
    }

    public function show(ProgramDonasi $programDonasi)
    {
        return view('program-donasi.show', compact('programDonasi'));
    }

    public function create()
    {
        return view('program-donasi.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|min:3',
            'kategori' => 'required|in:Bencana Alam,Anak Yatim,Pendidikan,Masjid,Kesehatan',
            'target' => 'required|numeric',
            'tanggal_mulai' => 'required|date',
            'gambar' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
        ]);

        $gambar = null;

        if ($request->hasFile('gambar')) {

            $gambar = $request->file('gambar')
                            ->store('gambar-program', 'public');
        }

        ProgramDonasi::create([
            'nama' => $request->nama,
            'kategori' => $request->kategori,
            'target' => $request->target,
            'terkumpul' => 0,
            'tanggal_mulai' => $request->tanggal_mulai,
            'gambar' => $gambar,
        ]);

        return redirect()
                ->route('program-donasi.index')
                ->with('success', 'Program donasi berhasil ditambahkan');
    }

    public function edit(ProgramDonasi $programDonasi)
    {
        return view('program-donasi.edit', compact('programDonasi'));
    }

    public function update(Request $request, ProgramDonasi $programDonasi)
    {
        $request->validate([
            'nama' => 'required|min:3',
            'kategori' => 'required|in:Bencana Alam,Anak Yatim,Pendidikan,Masjid,Kesehatan',
            'target' => 'required|numeric',
        ]);

        $programDonasi->update([
            'nama' => $request->nama,
            'kategori' => $request->kategori,
            'target' => $request->target,
        ]);

        return redirect()
                ->route('program-donasi.index')
                ->with('success', 'Program donasi berhasil diupdate');
    }

    public function destroy(ProgramDonasi $programDonasi)
    {
        $programDonasi->delete();

        return redirect()
                ->route('program-donasi.index')
                ->with('success', 'Program donasi berhasil dihapus');
    }

    public function search(Request $request)
    {
        $keyword = $request->keyword;

        $programs = ProgramDonasi::where('nama', 'like', "%$keyword%")
            ->orWhere('kategori', 'like', "%$keyword%")
            ->get();

        return view('program-donasi.search', compact('programs'));
    }
}


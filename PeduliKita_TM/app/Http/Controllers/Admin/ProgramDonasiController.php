<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Models\ProgramDonasi;
use Illuminate\Http\Request;

class ProgramDonasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $programs = ProgramDonasi::latest()->paginate(10);

        return view('admin.program-donasi.index', compact('programs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.program-donasi.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'nama' => 'required',
            'kategori' => 'required',
            'target' => 'required|numeric',
            'tanggal_mulai' => 'required',
            'gambar' => 'nullable|image',
        ]);

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')
                ->store('program-donasi', 'public');
        }

        $data['user_id'] = auth()->id();

        ProgramDonasi::create($data);

        return redirect()
            ->route('admin.program-donasi.index')
            ->with('success', 'Program donasi berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $programDonasi = ProgramDonasi::findOrFail($id);

        return view(
            'admin.program-donasi.show',
            compact('program')
        );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $programDonasi = ProgramDonasi::findOrFail($id);

        return view(
            'admin.program-donasi.edit',
            compact('program')
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ProgramDonasi $programDonasi)
    {
        $data = $request->validate([
            'nama'=>'required',
            'kategori'=>'required',
            'target'=>'required',
            'tanggal_mulai'=>'required',
            'gambar'=>'nullable|image'
        ]);

        if($request->hasFile('gambar')){

            $data['gambar'] =
                $request->file('gambar')
                        ->store('program','public');
        }

        $programDonasi->update($data);

        return redirect()
                ->route('admin.program-donasi.index')
                ->with('success',
                    'Program berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $programDonasi = ProgramDonasi::findOrFail($id);

        $programDonasi->delete();

        return redirect()
                ->route('admin.program-donasi.index')
                ->with('success',
                    'Program berhasil dihapus');
    }

    public function search(Request $request)
    {
        $programs = ProgramDonasi::where(
                'nama',
                'like',
                '%' . $request->keyword . '%'
            )
            ->latest()
            ->get();

        return view(
            'admin.program-donasi.search',
            compact('programs')
        );
    }

    public function detail($id)
    {
        $program = ProgramDonasi::findOrFail($id);

        return response()->json($program);
    }

    public function editData($id)
    {
        $program = ProgramDonasi::findOrFail($id);

        return response()->json($program);
    }

    public function ajaxUpdate(Request $request, $id)
    {
        $program = ProgramDonasi::findOrFail($id);

        $data = $request->validate([
            'nama' => 'required',
            'kategori' => 'required',
            'target' => 'required|numeric',
            'tanggal_mulai' => 'required|date',
            'gambar' => 'nullable|image|max:2048'
        ]);

        if ($request->hasFile('gambar')) {

            if ($program->gambar) {

                Storage::disk('public')
                    ->delete($program->gambar);
            }

            $data['gambar'] = $request
                ->file('gambar')
                ->store('program-donasi', 'public');
        }

        $program->update($data);

        return response()->json([
            'success' => true
        ]);
    }

    public function donasis()
    {
        return $this->hasMany(
            Donasi::class,
            'program_donasi_id'
        );
    }

    public function getTerkumpulAttribute()
    {
        return $this->donasis()
            ->where('status', 'terverifikasi')
            ->sum('nominal');
    }
}

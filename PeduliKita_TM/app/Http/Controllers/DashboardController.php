<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProgramDonasi;

class DashboardController extends Controller
{
    public function index()
    {
        $programs = ProgramDonasi::latest()->get();

        return view('dashboard', compact('programs'));
    }
}

return redirect()->route('dashboard')
    ->with('success', 'Program berhasil ditambahkan!');



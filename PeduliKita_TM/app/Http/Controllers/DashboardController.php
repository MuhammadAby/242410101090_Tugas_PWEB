<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard');
    }
}

return redirect()->route('dashboard')
    ->with('success', 'Program berhasil ditambahkan!');



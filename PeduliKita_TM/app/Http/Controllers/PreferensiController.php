<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PreferensiController extends Controller
{
    public function simpan(Request $request)
    {
        return response()->json([
            'status' => 'success',
            'theme' => $request->theme,
            'font' => $request->font
        ]);
    }
}


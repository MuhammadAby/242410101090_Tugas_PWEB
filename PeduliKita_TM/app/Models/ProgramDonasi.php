<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProgramDonasi extends Model
{
    protected $fillable = [
    'nama',
    'kategori',
    'target',
    'terkumpul',
    'tanggal_mulai',
    'gambar',
    ];

    protected $casts = [
    'target' => 'integer',
    'terkumpul' => 'integer',
    'tanggal_mulai' => 'date',
    ];

    public function scopeAktif($query)
    {
    return $query->whereColumn('terkumpul', '<', 'target');
    }
}


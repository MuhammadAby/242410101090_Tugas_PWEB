<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\ProgramDonasi;

class Donasi extends Model
{
    protected $fillable = [

        'nama',
        'email',
        'program_donasi_id',
        'nominal',
        'metode',
        'pesan',
        'bukti_transfer',
        'status',

    ];

    // public function donatur()
    // {
    //     return $this->belongsTo(User::class, 'donatur_id');
    // }

    public function programDonasi()
    {
        return $this->belongsTo(
            ProgramDonasi::class,
            'program_donasi_id'
        );
    }

    // public function program()
    // {
    //     return $this->belongsTo(
    //         ProgramDonasi::class,
    //         'program_donasi_id'
    //     );
    // }
}

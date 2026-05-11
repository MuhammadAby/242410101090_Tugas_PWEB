<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Donatur extends Model
{
    public function programDonasis()
    {
    return $this->belongsToMany(ProgramDonasi::class, 'donasis')
                ->withPivot('jumlah')
                ->withTimestamps();
    }
}

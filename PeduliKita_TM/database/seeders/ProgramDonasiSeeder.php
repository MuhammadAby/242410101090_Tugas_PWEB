<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ProgramDonasi;

class ProgramDonasiSeeder extends Seeder
{
    public function run(): void
    {
        ProgramDonasi::create([
            'nama' => 'Bantuan Erupsi Gunung Semeru',
            'kategori' => 'Bencana Alam',
            'target' => 50000000,
            'terkumpul' => 11000000,
            'tanggal_mulai' => '2026-01-10',
        ]);

        ProgramDonasi::create([
            'nama' => 'Beasiswa Anak Yatim 2026',
            'kategori' => 'Anak Yatim',
            'target' => 50000000,
            'terkumpul' => 30000000,
            'tanggal_mulai' => '2026-01-15',
        ]);

        ProgramDonasi::create([
            'nama' => 'Buku untuk Pelosok Negeri',
            'kategori' => 'Pendidikan',
            'target' => 30000000,
            'terkumpul' => 22500000,
            'tanggal_mulai' => '2026-02-01',
        ]);

        ProgramDonasi::create([
            'nama' => 'Renovasi Masjid Al-Ikhlas',
            'kategori' => 'Masjid',
            'target' => 100000000,
            'terkumpul' => 17500000,
            'tanggal_mulai' => '2026-02-10',
        ]);

        ProgramDonasi::create([
            'nama' => 'Banjir Kalimantan',
            'kategori' => 'Bencana Alam',
            'target' => 20000000,
            'terkumpul' => 27500000,
            'tanggal_mulai' => '2026-02-10',
        ]);
    }
}




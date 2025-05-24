<?php

namespace Database\Seeders;

use App\Models\Presensi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PresensiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Presensi::create([
            'nik' => '123',
            'tgl_presensi' => '2025-05-14',
            'jam_in' => '06:00:00',
            'jam_out' => '19:00:00',
            'foto_in' => '123-2025-05-14-in.png',
            'foto_out' => '123-2025-05-14-out.png',
            'lokasi_in' => '-6.4284191,107.0221877',
            'lokasi_out' => '-6.4284191,107.0221877',
        ]);
        Presensi::create([
            'nik' => '321',
            'tgl_presensi' => '2025-05-05',
            'jam_in' => '07:00:00',
            'jam_out' => '15:00:00',
            'foto_in' => '321-2025-05-05-in.png',
            'foto_out' => '321-2025-05-05-out.png',
            'lokasi_in' => '-6.4284191,107.0221877',
            'lokasi_out' => '-6.4284191,107.0221877',
        ]);
    }
}

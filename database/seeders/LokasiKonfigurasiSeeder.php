<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\LokasiKonfigurasi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class LokasiKonfigurasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        LokasiKonfigurasi::create([
            'lokasi_kantor' => '-6.42841491250009, 107.02217665164454',
            'radius' => '50'
        ]);
    }
}

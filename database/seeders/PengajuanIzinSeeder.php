<?php

namespace Database\Seeders;

use App\Models\PengajuanIzin;
use Illuminate\Database\Seeder;

class PengajuanIzinSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        PengajuanIzin::create([
            'nik' => '123',
            'tgl_izin' => '2025-05-21',
            'status' => 'i',
            'keterangan' => 'acara keluarga',
            'status_approved' => '0'
        ]);
        PengajuanIzin::create([
            'nik' => '123',
            'tgl_izin' => '2025-05-20',
            'status' => 's',
            'keterangan' => 'muntaber',
            'status_approved' => '1'
        ]);
        PengajuanIzin::create([
            'nik' => '123',
            'tgl_izin' => '2025-05-19',
            'status' => 's',
            'keterangan' => 'gila',
            'status_approved' => '2'
        ]);
    }
}

<?php

namespace Database\Seeders;

use App\Models\Karyawan;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class KaryawanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Karyawan::create([
            'nik' => '123',
            'nama_lengkap' => 'Farros',
            'jabatan' => 'Head Of IT',
            'no_hp' => '082345',
            'foto' => '',
            'kode_dept' => 'IT',
            'password' => Hash::make('asd'),
        ]);

        Karyawan::create([
            'nik' => '321',
            'nama_lengkap' => 'Rizky',
            'jabatan' => 'Manager HRD',
            'no_hp' => '0899123456',
            'foto' => '',
            'kode_dept' => 'HRD',
            'password' => Hash::make('asd'),
        ]);
    }
}

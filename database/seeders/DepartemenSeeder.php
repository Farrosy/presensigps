<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Departemen; // Corrected the namespace for the model

class DepartemenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Departemen::create([
            'kode_dept' => 'MKT',
            'nama_dept' => 'Marketing',
        ]);

        // You can add more departments here if needed
        Departemen::create([
            'kode_dept' => 'HRD',
            'nama_dept' => 'Human Resources Development',
        ]);
        
        Departemen::create([
            'kode_dept' => 'IT',
            'nama_dept' => 'Information Technology',
        ]);
    }
}
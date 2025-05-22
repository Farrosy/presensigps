<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LokasiKonfigurasi extends Model
{
    public $timestamps = false;
    protected $table = "konfigurasi_lokasi";
    protected $fillable = [
        'lokasi_kantor',
        'radius'
    ];

}

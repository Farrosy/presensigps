<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PengajuanIzin extends Model
{
    //
    use HasFactory;
    public $timestamps = false;
    protected $table = 'pengajuan_izin';
}

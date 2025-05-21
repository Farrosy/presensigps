<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('karyawan', function (Blueprint $table) {
            $table->char('nik', 5)->primary();
            $table->string('nama_lengkap', 100);
            $table->string('jabatan');
            $table->string('no_hp',13);
            $table->char('foto', 30)->nullable();
            $table->string('kode_dept');
            $table->string('password', 255);
            $table->string('remember_token', 255)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('karyawan');
    }
};

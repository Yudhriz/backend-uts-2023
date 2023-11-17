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
        // Membuat table employees
        Schema::create('employees', function (Blueprint $table) {
            $table->id(); // ID Pegawai
            $table->string('nama'); // Nama Pegawai
            $table->char('gender'); // Jenis kelamin pegawai
            $table->string('phone'); // No Hp pegawai
            $table->text('address'); // Alamat pegawai
            $table->string('email'); // Email pegawai
            $table->string('status'); // Status pegawai
            $table->date('hired_on'); // Tanggal Masuk Kerja
            $table->timestamps(); //  Timestamp
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
